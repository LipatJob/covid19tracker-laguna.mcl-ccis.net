
<?php 
    include_once "./repository/queries.php";

    //Checks if Settings in DB is set to Uploading
    if (!isUploading()) {
        include_once "main.php";
    }
    else {
        include_once "uploading.php";
    }
?>
