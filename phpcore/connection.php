<?php
  $config = parse_ini_file(realpath("./phpcore/setup.ini"));
  $DB_HOST = $config["DB_HOST"];
  $DB_USER = $config["DB_USER"];
  $DB_PASS = $config["DB_PASS"];
  $DB_NAME = $config["DB_NAME"];

  $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

  if(!$con)
  {
    die( "Unable to select database");
  }


 ?>
