<?php
  $DB_HOST = 'localhost';
  $DB_USER = 'mclccisn';
  $DB_PASS = 'mclCCIS2020!';
  $DB_NAME = 'mclccisn_covid19tracker_devdb';

  $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

  if(!$con)
  {
    die( "Unable to select database");
  }


 ?>
