<?php
include "../phpcore/simpleauth.php";
require_auth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="POST">
      <input type="submit" name="submitButton" value = "updateIndividualCases">
      <input type="submit" name="submitButton" value = "updateBarangayHistory">
      <input type="submit" name="submitButton" value = "updateBarangayHistoryNew">
      <input type="submit" name="submitButton" value = "clearCache">
      <input type="submit" name="submitButton" value = "setUploadingInterface">
      <input type="submit" name="submitButton" value = "uploadSingleDay">
    </form>
    <br>
    <p>
    Notice: <br> 
    - Updating may take up to 3 minutes. <br>
    - Updating will truncate the table and reinsert data from the CSV files. <br>
    - It is recommended to edit the data from the database directly for small edits
    </p>
</body>
</html>