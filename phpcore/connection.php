<?php
  $DB_HOST = 'mclcovid.joblipat.cf:3306';
  $DB_USER = 'joblipat_mclccis';
  $DB_PASS = 'wizarduser!';
  $DB_NAME = 'joblipat_coviddev';

  $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

  if(!$con)
  {
    die( "Unable to select database");
  }


 ?>
