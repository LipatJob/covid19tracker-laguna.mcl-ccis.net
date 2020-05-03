<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'template/include_header.php' ?>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333333;

            color: white;
            text-align: center;

            color: white;
            padding-top: 20px;
            padding-bottom: 8px;
            margin-left: 0;
        }
    </style>
</head>

<body>
    <!-- INCLUDE NAVBAR-->
    <?php include_once 'template/navbar.php' ?>

    <?php
    include_once "./repository/queries.php";

    //Checks if Settings in DB is set to Uploading
    if (!isUploading()) {
        include_once "main.php";
    } else {
        include_once "uploading.php";
    }
    ?>
</body>

</html>