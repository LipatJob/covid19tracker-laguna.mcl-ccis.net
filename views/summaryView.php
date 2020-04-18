<?php
include "../repository/queries.php";
date_default_timezone_set("Asia/Singapore");
$date = date('Y-m-d');
$data = getSummary($_GET["location"]);
?>

<style>
.small-box {
    margin: 0px;
}
</style>


<div class="parent-container-horizontal row">


    <div class="col-lg-2 col-md-6 col-sm-6">
        <!-- small card -->
        <div class="small-box" style="background-color: #1988C8;  color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["ConfirmedCases"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">CONFIRMED</p>
                <div class="parent-container-horizontal" style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; <?php if($date == $data["MaxDate"] || $data["MaxDate"] == "") echo "color: #1988C8;"; ?>"> <?php if($date > $data["MaxDate"] && $data["MaxDate"] != "") echo 'No new cases since '.$data["LookDate"].''; else echo "-" ?> </div>
              
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>


    <div class="col-lg-2 col-md-6 col-sm-6">
        <!-- small card -->
        <div class="small-box" style="background-color: #2ABB9B !important; color: white;">
            <div class="inner">
                <h1><?php echo $data["Recovered"]; ?></h1>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">RECOVERED</p>
                <div class="parent-container-horizontal"
                    style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; color: #2ABB9B"> - </div>
            </div>
            <div class="icon">
                <i class="fa fa-hand-holding-heart"></i>
            </div>
        </div>
    </div>


    <div class="col-lg-2 col-md-6 col-sm-6">
        <!-- small card -->
        <div class="small-box" style="background-color: #008080 !important; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["ActiveCases"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">ACTIVE CASES</p>
                <div class="parent-container-horizontal"
                    style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; color: #008080"> - </div>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-user"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">

        <div class="small-box" style="background-color: #FF712D; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["Suspect"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">SUSPECT</p>
                <div class="parent-container-horizontal"
                    style="width:100%; font-size: 12px; margin-top: -3px; padding-top: 3px; ">(PUI na di pa natetest)
                </div>
            </div>
            <div class="icon">
                <i class="fa fa-user-injured"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">
        <!-- small card -->
        <div class="small-box" style="background-color: #FF7F7F; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["Probable"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">PROBABLE</p>
                <div class="parent-container-horizontal"
                    style="width:100%; font-size: 12px; margin-top: -3px; padding-top: 3px;">(PUI na wala pang resulta
                    ang test)</div>
            </div>
            <div class="icon">
                <i class="fa fa-search"></i>
            </div>
        </div>
    </div>




    <div class="col-lg-2 col-md-6 col-sm-6">
        <!-- small card -->
        <div class="small-box" style="background-color: #7d7d7d;color: white;">
            <div class="inner">
                <h1><?php echo $data["Deceased"] ?></h1>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">DECEASED</p>
                <div class="parent-container-horizontal"
                    style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; color: #7d7d7d;">-</div>
            </div>
            <div class="icon">
                <i class="fa fa-skull-crossbones"></i>
            </div>
        </div>
    </div>


</div>