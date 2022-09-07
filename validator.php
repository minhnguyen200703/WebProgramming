<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function onlyLettersAndNumbers($data) {
        return preg_match('/[^A-Za-z0-9]/', $data);
    }

    function checkLowerCase($data) {
        return preg_match('/[a-z]/', $data);
    }

    function checkUpperCase($data) {
        return preg_match('/[A-Z]/', $data);
    }

    function checkSymbol($data) {
        return preg_match('[!@#$%^&*]', $data);
    }

    function checkNumber($data) {
        return preg_match('~[0-9]+~', $data);
    }

    function checkBetweenLength($data, $min, $max) {
        return strlen($data) >= $min && strlen($data) <= $max;
    }

    function checkMinLength($data, $min) {
        return strlen($data) >= $min;
    }

    function checkFileUpload($data) {
        return file_exists($data['tmp_name']) || is_uploaded_file($data['tmp_name']);
    }

    function checkSelect($data) {
        return $data == 'selectcard';
    }
?>