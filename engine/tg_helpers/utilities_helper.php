<?php
/**
 * Blocks direct URL access to a module while allowing internal code access.
 * Optimized for maximum performance, case-insensitivity, and AI-readability.
 *
 * @param string $module_name The module name to protect (must be lowercase)
 * @return void
 */
function block_url_invocation(string $module_name): void {
    if ($module_name !== '' && strcasecmp(segment(1), $module_name) === 0) {
        http_response_code(403);
        die('403 Forbidden');
    }
}

/**
 * Blocks one public method from being visited as a page (Trongate v2).
 * Used by validation callbacks, which must be public so the validation
 * module can call them, but should never be reachable by URL.
 *
 * @param string $block_path The 'module/method' to protect, e.g. 'pm/team_check'
 * @return void
 */
function block_url(string $block_path): void {
    $current_path = strtolower(segment(1) . '/' . segment(2));
    if ($current_path === strtolower(trim($block_path, '/'))) {
        http_response_code(404);
        die('404 Not Found');
    }
}

/**
 * Limits a System page (Settings, Auditlog) to system admins.
 * Honcho deployed (HONCHO_MODULE = 1): only staff sysadmins (honcho/login).
 * Honcho Lite (HONCHO_MODULE = 0): only members with system_admin (welcome/login).
 * Internal calls such as $this->auditlogger->logevent() are not affected.
 *
 * @param string $module_name The module as it appears in the URL, e.g. 'system-settings'
 * @return void
 */
function system_admin_only(string $module_name): void {
    if (strcasecmp(segment(1), $module_name) !== 0) {
        return; // called by another module, not visited as a page
    }

    if (HONCHO_MODULE == 1) {
        $logged_in = !empty($_SESSION['honcho_logged_in']);
        $allowed   = $logged_in && !empty($_SESSION['honcho_sysadmin']);
        $home      = 'honcho';
    } else {
        $logged_in = !empty($_SESSION['ccmp_logged_in']);
        $allowed   = $logged_in && !empty($_SESSION['ccmps_system_admin']);
        $home      = 'welcome-ccmps/ccmphome';
    }

    if ($allowed) {
        return;
    }
    if ($logged_in) {
        set_flashdata('You are not authorized to use that page.');
        redirect($home);
    }
    if (!empty($_SESSION['honcho_logged_in'])) {
        set_flashdata('That page is for member system admins.');
        redirect('honcho');
    }
    if (!empty($_SESSION['ccmp_logged_in'])) {
        set_flashdata('You are not authorized to use that page.');
        redirect('welcome-ccmps/ccmphome');
    }
    redirect('welcome/logout'); // not logged in at all
}

/**
 * Outputs the given data as JSON in a prettified format, suitable for debugging and visualization.
 * This function is especially useful during development for inspecting data structures in a readable JSON format directly in the browser. 
 * It optionally allows terminating the script immediately after output, useful in API development for stopping further processing.
 *
 * @param mixed $data The data (e.g., array or object) to encode into JSON format. The data can be any type that is encodable into JSON.
 * @param bool|null $kill_script Optionally, whether to terminate the script after outputting the JSON. 
 *                                If true, the script execution is halted immediately after the JSON output.
 *                                Default is null, which means the script continues running unless specified otherwise.
 * @return void Does not return any value; the output is directly written to the output buffer.
 */
function json($data, ?bool $kill_script = null): void {
    echo '<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';

    if (isset($kill_script)) {
        die();
    }
}

/**
 * Get the client's IP address.
 *
 * @return string The client's IP address.
 */
function ip_address(): string {
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Display content view within a template
 * 
 * @param array $data Data containing view_module and view_file
 * @return void
 */
function display(array $data): void {
    // Auto-detect view_module from URL if not provided
    if (!isset($data['view_module'])) {
        $data['view_module'] = segment(1) ?? 'welcome';
    }
    
    // Default view_file if not provided
    if (!isset($data['view_file'])) {
        $data['view_file'] = 'index';
    }
    
    // Build path to content view
    $content_view_path = APPPATH . "modules/{$data['view_module']}/views/{$data['view_file']}.php";
    
    // Check if view exists
    if (!file_exists($content_view_path)) {
        echo "<div style='color: red; padding: 1rem; border: 2px solid red;'>";
        echo "<h2>View Not Found</h2>";
        echo "<p>Looking for: <code>{$content_view_path}</code></p>";
        echo "</div>";
        return;
    }
    
    // Extract data and include view
    extract($data);
    require $content_view_path;
}

/**
 * Extract file name and extension from a given file path.
 *
 * @param string $file_string The file path from which to extract information.
 * @return array An associative array containing the 'file_name' and 'file_extension'.
 */
function return_file_info(string $file_string): array {
    // Get the file extension
    $file_extension = pathinfo($file_string, PATHINFO_EXTENSION);
    // Get the file name without the extension
    $file_name = str_replace("." . $file_extension, "", $file_string);
    // Return an array containing the file name and file extension
    return array("file_name" => $file_name, "file_extension" => "." . $file_extension);
}

/**
 * Sorts an array of associative arrays by a specified property.
 *
 * @param array $array The array to be sorted.
 * @param string $property The property by which to sort the array.
 * @param string $direction The direction to sort ('asc' for ascending, 'desc' for descending). Default is 'asc'.
 * @return array The sorted array.
 */
function sort_by_property(array &$array, string $property, string $direction = 'asc'): array {
    usort($array, function($a, $b) use ($property, $direction) {
        // Determine the comparison method based on the property type
        if (is_string($a[$property])) {
            $result = strcasecmp($a[$property], $b[$property]);
        } else {
            $result = $a[$property] <=> $b[$property];
        }
        
        return ($direction === 'desc') ? -$result : $result;
    });
    return $array;
}

/**
 * Sorts an array of objects by a specified property.
 *
 * @param array $array The array of objects to be sorted.
 * @param string $property The property by which to sort the objects.
 * @param string $direction (Optional) The direction of sorting ('asc' or 'desc'). Defaults to 'asc'.
 * @return array The sorted array of objects.
 */
function sort_rows_by_property(array $array, string $property, string $direction = 'asc'): array {
    usort($array, function($a, $b) use ($property, $direction) {
        // Determine the comparison method based on the property type
        if (is_string($a->$property)) {
            $result = strcasecmp($a->$property, $b->$property);
        } else {
            $result = $a->$property <=> $b->$property;
        }
        
        return ($direction === 'desc') ? -$result : $result;
    });
    return $array;
}

/**
 * Checks if the HTTP request has been invoked by Trongate MX.
 *
 * @return bool True if the request has the X-Trongate-MX header set to 'true', otherwise false.
 */
function from_trongate_mx(): bool {
    if (isset($_SERVER['HTTP_TRONGATE_MX_REQUEST'])) {
        return true;
    } else {
        return false;
    }
}
/**
 * Trongate v2 Compatibility Shim: Loads a template file with optional data.
 *
 * Ported from Trongate v1's global load() helper (removed in v2) so that
 * this app's modules/templates/Templates.php -- which calls load('name', $data)
 * for every page render -- keeps working unchanged. Path updated to match
 * v2's flattened module layout (modules/templates/views/ instead of the old
 * top-level templates/views/).
 *
 * @param string $template_file The filename of the template to load.
 * @param array|null $data (Optional) Data to be passed to the template as an associative array.
 * @return void
 */
function load(string $template_file, ?array $data = null): void {
    if (defined('THEMES') && isset(THEMES[$template_file])) {
        $theme_dir = THEMES[$template_file]['dir'];
        $template = THEMES[$template_file]['template'];
        $file_path = APPPATH . 'public/themes/' . $theme_dir . '/' . $template;
        define('THEME_DIR', BASE_URL . 'themes/' . $theme_dir . '/');
    } else {
        $file_path = APPPATH . 'modules/templates/views/' . $template_file . '.php';
    }

    if (file_exists($file_path)) {
        if (isset($data)) {
            extract($data);
        }
        require_once($file_path);
    } else {
        die('<br><b>ERROR:</b> View file does not exist at: ' . $file_path);
    }
}
