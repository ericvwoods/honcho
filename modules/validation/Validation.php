<?php
/**
 * Validation - form validation for v2-style modules ($this->validation).
 *
 * This app's engine runs legacy 1.x code and never had the stock v2
 * validation module, so this is a small stand-in with the same API:
 *
 *   $this->validation->set_rules('name', 'team name', 'required|max_length[100]|callback_name_check');
 *   if ($this->validation->run() !== true) { ...redisplay the form... }
 *
 * run() checks the CSRF token that form_close() adds before it looks at
 * any rules; a missing or wrong token redirects to BASE_URL. With no
 * rules set, run() does only the token check.
 *
 * Errors go into $_SESSION['form_submission_errors'][field][], which is
 * where the validation_errors() helper reads them.
 *
 * Rules: required, min_length[n], max_length[n], numeric, integer,
 * valid_email, valid_date (YYYY-MM-DD), callback_<method>.
 * Apart from required and callbacks, rules are skipped for empty values.
 * A callback is a public method on the calling controller that returns
 * true or an error message ({label} is replaced with the field label);
 * it should start with block_url('module/method').
 */
class Validation {

    private array $rules = [];

    public function __construct() {
        block_url_invocation('validation');
    }

    public function set_rules(string $field, string $label, string $rules): void {
        $this->rules[$field] = [
            'label' => $label,
            'rules' => array_filter(explode('|', $rules)),
        ];
    }

    public function run(): bool {
        $this->check_csrf_token();

        // The controller that called run() owns the callback_ methods
        $caller = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['object'] ?? null;

        $errors = [];
        foreach ($this->rules as $field => $set) {
            $value = post($field);
            $value = is_string($value) ? trim($value) : $value;

            foreach ($set['rules'] as $rule) {
                $error = $this->apply_rule($rule, $value, $caller);
                if ($error !== null) {
                    $errors[$field][] = str_replace('{label}', $set['label'], $error);
                    break; // one message per field
                }
            }
        }

        $this->rules = [];

        if (count($errors) > 0) {
            $_SESSION['form_submission_errors'] = $errors;
            return false;
        }

        unset($_SESSION['form_submission_errors']);
        return true;
    }

    private function check_csrf_token(): void {
        $posted = post('csrf_token');
        $stored = $_SESSION['csrf_token'] ?? '';

        if (!is_string($posted) || $stored === '' || !hash_equals($stored, $posted)) {
            redirect(BASE_URL);
            die();
        }
    }

    /**
     * @return string|null An error message, or null when the value passes.
     */
    private function apply_rule(string $rule, mixed $value, ?object $caller): ?string {
        $param = null;
        if (preg_match('/^(\w+)\[(.*)\]$/', $rule, $m)) {
            $rule  = $m[1];
            $param = $m[2];
        }

        if (str_starts_with($rule, 'callback_')) {
            $method = substr($rule, strlen('callback_'));
            if ($caller === null || !method_exists($caller, $method)) {
                throw new Exception("Validation callback not found: {$method}");
            }
            $result = $caller->$method($value);
            return ($result === true) ? null : (string) $result;
        }

        $is_empty = ($value === '' || $value === null || $value === []);

        if ($rule === 'required') {
            return $is_empty ? 'The {label} field is required.' : null;
        }

        if ($is_empty) {
            return null;
        }

        $str = is_scalar($value) ? (string) $value : '';

        switch ($rule) {
            case 'min_length':
                return (mb_strlen($str) < (int) $param)
                    ? 'The {label} field must be at least ' . (int) $param . ' characters long.' : null;
            case 'max_length':
                return (mb_strlen($str) > (int) $param)
                    ? 'The {label} field cannot be more than ' . (int) $param . ' characters long.' : null;
            case 'numeric':
                return is_numeric($str) ? null : 'The {label} field must be numeric.';
            case 'integer':
                return (filter_var($str, FILTER_VALIDATE_INT) !== false) ? null : 'The {label} field must be a whole number.';
            case 'valid_email':
                return (filter_var($str, FILTER_VALIDATE_EMAIL) !== false) ? null : 'The {label} field must be a valid email address.';
            case 'valid_date':
                $date = DateTime::createFromFormat('!Y-m-d', $str);
                return ($date !== false && $date->format('Y-m-d') === $str) ? null : 'The {label} field must be a valid date.';
        }

        throw new Exception("Unknown validation rule: {$rule}");
    }

}
