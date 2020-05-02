<?php
include "../repository/queries.php";
$data = getSummary($_GET["location"]);
$date = $data['MyDate'];
$pastdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));
$outputdate = date('M. d', strtotime($pastdate));
$number = 1;
$number2 = 1;
$number3 = 1;

?>

<style>
.small-box {
    margin: 0px;
}
</style>


<div class="row">


    <div class="col-lg-2 col-md-6 col-sm-12 p-1">
        <!-- small card -->
        <div class="small-box" style="background-color: #1988C8;  color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["ConfirmedCases"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">CONFIRMED</p>
                <div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; <?php if($date < $data["CountDays"] || $data["CountDays"] == "" || $data["ActiveCases"] == 0){ if($data['RecoverCheck'] != 0 || $data['DeceasedCheck'] != 0){}else { echo "color: #1988C8;";} }?>"><b> <?php if($data["ActiveCases"] == 0){ echo 'No new cases since '.$data["OutputConfirmed"].'&nbsp<span class="fas fa-grin-alt"></span>'; } else if($data["CountDays"] == $date){ echo ''.$data["TotalConfirmed"].' new case/s'; if($data["TotalConfirmed"] >= $number3){ echo " &nbsp<span class='fas fa-frown'></span>";}else if($data["TotalConfirmed"]==0){ echo " &nbsp<span class='fas fa-grin-alt'></span>"; }} else if($data["CountDays"] == $pastdate){ echo ''.$data["TotalConfirmed"].' new case/s since '.$outputdate.''; if($data["TotalConfirmed"] >= $number3){ echo " &nbsp<span class='fas fa-frown'></span>";}else{ echo " &nbsp<span class='fas fa-grin-alt'></span>";}} else if($date > $data["CountDays"] && $data["CountDays"] != "") echo 'No new cases since '.$data["OutputConfirmed"].'&nbsp<span class="fas fa-grin-alt"></span>'; else echo "-" ?> </b></div>
              
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-12 p-1">
        <!-- small card -->
        <div class="small-box" style="background-color: #2ABB9B !important; color: white;">
            <div class="inner">
                <h1><?php echo $data["Recovered"]; ?></h1>
				
                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">RECOVERED</p>
               <div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; <?php if($date < $data["RecoverDate"] || $data["RecoverDate"] == "" || $data["ActiveCases"] == 0) { if($data["RecoverCheck"] == 0){echo "color: #2ABB9B;";}} ?>"><b> <?php if($data["ActiveCases"] == 0 && $data["RecoverCheck"] != 0){ echo ''.$data["RecoverCheck"].' new recovered patient/s'; if($data["RecoverCheck"] >= $number) echo " &nbsp<span class='fas fa-grin-alt'></span>"; } else if($data["ActiveCases"] == 0){ echo "-"; } else if($data["RecoverDate"] == $date){ echo ''.$data["RecoverCheck"].' new recovered patient/s'; if($data["RecoverCheck"] >= $number) echo " &nbsp<span class='fas fa-grin-alt'></span>"; } else if($data["RecoverDate"] == $pastdate){ echo ''.$data["RecoverCheck"].' new recovered patient/s since '.$outputdate.''; if($data["RecoverCheck"] >= $number) echo " &nbsp<span class='fas fa-grin-alt'></span>"; } else echo ''.$data["RecoverCheck"].' new recovered patient/s'; ?> </b></div>
              
            </div>
            <div class="icon">
                <i class="fa fa-hand-holding-heart"></i>
            </div>
        </div>
    </div>


    <div class="col-lg-2 col-md-6 col-sm-12 p-1">
        <!-- small card -->
        <div class="small-box" style="background-color: #008080 !important; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["ActiveCases"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">ACTIVE CASES</p>
                <div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px;"><b> <?php if($data["ActiveCases"] == 0){ echo "COVID-FREE &nbsp<i class='fas fa-heart'></i>"; } else if($data['ActiveCheck'] == 0 ){ echo 'No changes in active case/s';} else if($data['ActiveCheck'] > 0){ echo '<i style = "font-size:14px;margin-top:-5px;">↑&nbsp</i>'.$data['ActiveCheck'].' in total active case/s';} else if($data['ActiveCheck'] < 0) { echo '<i style = "font-size:14px;margin-top:-5px;">↓&nbsp</i>'.abs($data['ActiveCheck']).' in total active case/s'; } ?> </b></div>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-user"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-12 p-1">

        <div class="small-box" style="background-color: #FF712D; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["Suspect"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">SUSPECT</p>
                                <div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px;"><b> <?php if($data['PUMCheck'] == 0 ){ echo 'No changes in suspected case/s';} else if($data['PUMCheck'] > 0){ echo '<i style = "font-size:14px;margin-top:-5px;">↑&nbsp</i>'.$data['PUMCheck'].' in total suspected case/s';} else if($data['PUMCheck'] < 0) { echo '<i style = "font-size:14px;margin-top:-5px;">↓&nbsp</i>'.abs($data['PUMCheck']).' in total suspected case/s'; } ?> </b></div>
            </div>
            <div class="icon">
                <i class="fa fa-user-injured"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-12 p-1">
        <!-- small card -->
        <div class="small-box" style="background-color: #FF7F7F; color: white;">
            <div class="inner">
                <strong>
                    <h1><?php echo $data["Probable"]; ?></h1>
                </strong>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">PROBABLE</p>
					
					<div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px;"><b> <?php if($data['PUICheck'] == 0 ){ echo 'No changes in probable case/s';} else if($data['PUICheck'] > 0){ echo '<i style = "font-size:14px;margin-top:-5px;">↑&nbsp</i>'.$data['PUICheck'].' in total probable case/s';} else if($data['PUICheck'] < 0) { echo '<i style = "font-size:14px;margin-top:-5px;">↓&nbsp</i>'.abs($data['PUICheck']).' in total probable case/s'; } ?> </b></div>
            </div>
            <div class="icon">
                <i class="fa fa-search"></i>
            </div>
        </div>
    </div>




    <div class="col-lg-2 col-md-6 col-sm-12 p-1">
        <!-- small card -->
        <div class="small-box" style="background-color: #7d7d7d;color: white;">
            <div class="inner">
                <h1><?php echo $data["Deceased"] ?></h1>

                <p style="margin-bottom:0px; padding-bottom:0px; padding-top: 0px;">DECEASED</p>
                <div style="width:100%; font-size: 14px; margin-top: -3px; padding-top: 3px; <?php if($date < $data["DeceasedDate"] || $data["DeceasedDate"] == "" || $data["ActiveCases"] == 0){ if($data["DeceasedCheck"] == 0){ echo "color: #7d7d7d;"; }}?>"><b> <?php if($data["ActiveCases"] == 0 && $data["DeceasedCheck"] != 0){ echo ''.$data["DeceasedCheck"].' new death/s'; if($data["DeceasedCheck"] >= $number2){ echo " &nbsp<span class='fas fa-frown'></span>";} else { echo ' &nbsp<span class="fas fa-grin-alt"></span>';} } else if($data["ActiveCases"] == 0){ echo "-"; } else if($data["DeceasedDate"] == $date){ echo ''.$data["DeceasedCheck"].' new death/s'; if($data["DeceasedCheck"] >= $number2){ echo " &nbsp<span class='fas fa-frown'></span>";} else { echo ' &nbsp<span class="fas fa-grin-alt"></span>';} } else if($data["DeceasedDate"] == $pastdate){ echo ''.$data["DeceasedCheck"].' new death/s since '.$outputdate.''; if($data["DeceasedCheck"] >= $number2){ echo " &nbsp<span class='fas fa-frown'></span>";} else { echo " &nbsp<span class='fas fa-grin-alt'></span>"; } } else if($date > $data["DeceasedDate"] && $data["DeceasedDate"] != ""){ echo 'No new deaths since '.$data["OutputDeceased"].' &nbsp<span class="fas fa-grin-alt"></span>';} else echo "-" ?> </b></div>
            </div>
            <div class="icon">
                <i class="fa fa-skull-crossbones"></i>
            </div>
        </div>
    </div>


</div>
