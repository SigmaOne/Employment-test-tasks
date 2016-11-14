<?php
// Contains function for form validations :\
// Todo: Cosider removing

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
