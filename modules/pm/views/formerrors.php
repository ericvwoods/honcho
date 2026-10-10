<?php
/* Validation errors from the last failed submit, as one Bootstrap alert.
   validation_errors() returns nothing when there are no errors. */
$pm_errors = validation_errors();
if ($pm_errors) {
    echo '<div class="alert alert-danger"><strong>Please fix the following:</strong>' . $pm_errors . '</div>';
}
