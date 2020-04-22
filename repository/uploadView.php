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