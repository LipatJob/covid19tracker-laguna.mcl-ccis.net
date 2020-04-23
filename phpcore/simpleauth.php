<?php
function require_auth() {
    $config = parse_ini_file(dirname(__FILE__).("/../phpcore/setup.ini")) or die("Website not initialized properly. Please contact the developers.");
    if($config["USER"] == "" || $config["PASS"] == ""){
      die("credentials not set. Contact developers");  
    }
    $AUTH_USER = $config["USER"];
    $AUTH_PASS = $config["PASS"];
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
    $is_not_authenticated = (
        !$has_supplied_credentials ||
        $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
        $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
    );
    if ($is_not_authenticated) {
        header('HTTP/1.1 401 Authorization Required');
        header('WWW-Authenticate: Basic realm="Access denied"');
        exit;
    }
}
?>