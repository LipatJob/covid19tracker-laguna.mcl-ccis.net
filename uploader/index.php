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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <form action="upload.php" method="POST">
      <input type="submit" name="submitButton" value = "updateIndividualCases">
      <input type="submit" name="submitButton" value = "updateBarangayHistory">
      <input type="submit" name="submitButton" value = "updateBarangayHistoryNew">
      <input type="submit" name="submitButton" value = "updateBarangayHistoryNew">
      <input type="button" name="submitButton" value = "Upload Today" onclick="updateToday()">
      <p>Date: <input type="text" id="datepicker"></p>
      <input type="button" name="submitButton" value = "Upload Specific Date" onclick="updateDate()">   
      <input type="submit" name="submitButton" value = "clearCache" >
    </form>
    <br>
    <p>
    Notice: <br> 
    - Updating may take up to 3 minutes. <br>
    - Updating will truncate the table and reinsert data from the CSV files. <br>
    - It is recommended to edit the data from the database directly for small edits
    </p>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.rawgit.com/mgalante/jquery.redirect/master/jquery.redirect.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function(){
            $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());

            var doQuery = function(functionName){
                return function(data = null){
                    $.redirect('uploadAction.php', {'func': functionName, 'data': data});
                }   
            }

            updateDate = function(){
                var date = $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).val();
                updateSpecificDate(date);
            }
            
            updateIndividualCases = doQuery("updateIndividualCases");
            updateBarangayHistory = doQuery("updateBarangayHistory");
            updateBarangayHistoryNew = doQuery("updateBarangayHistoryNew");
            updateSpecificDate = doQuery("updateSpecificDate");
            updateToday = doQuery("updateToday");
            clearCache = doQuery("clearCache");
            setUploadingInterface = doQuery("setUploadingInterface");
            
        });
    </script>
</body>
</html>