

<script>
<?php
  include 'phpcore/connection.php';
  $brgy = "#" . $_GET['brgy'];
  $city = $_GET['city'];
  $string = "SELECT barangay FROM `barangay_history` WHERE city_municipality = '$city' GROUP BY barangay";

  $result = $result1 = mysqli_query($con,$string);
  while($extract = mysqli_fetch_array($result)){
    echo "$(". json_encode($brgy) .").append('<option value=" . json_encode($extract['barangay']). ">" . $extract['barangay'] . "</option>');";
  }

  ?>
  </script>