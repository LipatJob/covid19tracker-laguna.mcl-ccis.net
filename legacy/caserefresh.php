              <?php
				include 'phpcore/connection.php';
				$mylocation = $_GET['location'];
				if ($mylocation == 'LAGUNA') {
					$query1 = "SELECT * FROM individual_cases order by date_confirmed asc, barangay";
					$query2 = "SELECT COUNT(official_case_code) as mycount FROM individual_cases";
				} else {
					$query1 = "SELECT * FROM individual_cases where barangay = '$mylocation' order by date_confirmed asc, barangay";
					$query2 = "SELECT COUNT(official_case_code) as mycount FROM individual_cases where barangay = '$mylocation'";
				}
				$result2 = mysqli_query($con, $query2);
				$result1 = mysqli_query($con, $query1);
				while ($rows3 = mysqli_fetch_array($result2)) {
					$thiscount = $rows3['mycount'];
				}


				?>
              <div class="card-header" style="background-color: #354664; color: white; col-sm-12">
              	<h5 style="width: 50%; float:left"> INDIVIDUAL CASE INFORMATION</h5>
              	<h5 style="width: 50%; text-align:right; float:right; color: white; right:0;"><b>TOTAL CASES: <?php echo $thiscount; ?></b></h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<div class="parent-container-horizontal">

              		<?php
						?>

              		<?php
						while ($rows2 = mysqli_fetch_array($result1)) {
							$agelower = 0;
							$agehigher = 9;
							$flag = true;
						?>
              			<div class="col-lg-3 col-md-4 col-sm-6">
              				<div class="card bg-light m-2 " style="align: right;">

              					<div class="card-header text-muted border-bottom-0">
              						<b><?php echo $rows2['barangay']; ?></b>
              						<p class="small"><i class="fas fa fa-street-view"></i>Barangay: <?php if (!empty($rows2['city_municipality'])) {
																											echo $rows2['city_municipality'];
																										} else {
																											echo 'Not Specified';
																										} ?></p>


              					</div>

              					<div class="card-body pt-0">
              						<div class="row">
              							<div class="col-8">
              								<h2 class="lead"><b></b></h2>
              								<h4 class="lead"><b> <?php if (!empty($rows2['official_case_code'])) {
																		echo str_replace(" ", "", $rows2['official_case_code']);
																	} else {
																		echo 'NOT SPECFIED';
																	} ?></b><?php if (strlen($rows2['official_case_code']) <= 20) {
																																																			echo "<br></br>";
																																																		} ?></h2>
              									<ul class="ml-4 mb-0 fa-ul text-muted">
              										<li class="small"><span class="fa-li"><i class="fas fa fa-hourglass"></i></span>Age: <?php if ($rows2['age'] != -1) {
																																				echo $rows2['age'];
																																			} else {
																																				echo '*NOT SPECIFIED';
																																			} ?></li>
              										<li class="small"><span class="fa-li"><i class="fas fa fa-heart"></i></span>Gender: <?php if (!empty($rows2['gender'])) {
																																				echo $rows2['gender'];
																																			} else {
																																				echo '*NOT SPECIFIED';
																																			} ?></li>
              										<li class="small"><span class="fa-li"><i class="fas fa fa-id-card"></i></span>Confirmation Date:
              										<li class="small"><?php echo $rows2['date_confirmed']; ?></li>
              										<li class="small"><span class="fa-li"><i class="fas fa fa-id-card"></i></span>Status Date:</li>
              										<li class="small"><?php echo $rows2['date_of_status']; ?></li>
              									</ul>
              							</div>
              							<div class="col-4 text-center" style="position: absolute; float: right; right:0;">
              								<?php

												while ($flag == true) {
													if (empty($rows2['gender']) || $rows2['gender'] == '*NOT SPECIFIED') {
												?>
              										<img src="./imgs/noage.png" alt="" class="img-circle img-fluid border">
              									<?php
														$flag = false;
													} else if ($rows2['age'] == -1) {
													?>
													  <!-- <img src="./imgs/nogender_<?php echo $rows2['gender']; ?>.png" alt="" class="img-circle img-fluid border"> -->

													  <?php
														if ($rows2['gender'] == "*NOT SPECIFIED"){
													  ?>
													  		<img src="./imgs/noage.png" alt="" class="img-circle img-fluid border">
													  <?php
														}
														else {
													  ?>
													  	<img src="./imgs/nogender_<?php echo $rows2['gender']; ?>.png" alt="" class="img-circle img-fluid border">
													  <?php
														}
													  ?>
													  
													  
              									<?php
														$flag = false;
													} else if ($rows2['age'] >= 60) {
													?>
              										<img src="./imgs/60-up_<?php echo $rows2['gender']; ?>.png" alt="" class="img-circle img-fluid border">

              									<?php
														$flag = false;
													} else if ($rows2['age'] >= 30 && $rows2['age'] <= 59) {
													?>
              										<img src="./imgs/30-59_<?php echo $rows2['gender']; ?>.png" alt="" class="img-circle img-fluid border">
              									<?php
														$flag = false;
													} else if ($agelower <= $rows2['age'] && $agehigher >= $rows2['age']) {
													?>
              										<img src="./imgs/<?php echo $agelower; ?>-<?php echo $agehigher; ?>_<?php echo $rows2['gender']; ?>.png" alt="" class="img-circle img-fluid border">
              								<?php
														$flag = false;
													} else {
														$agelower = $agelower + 10;
														$agehigher = $agehigher + 10;
													}
												}
												$agelower = 0;
												$agehigher = 9;
												$flag = true;
												?>
              							</div>
              						</div>
              					</div>
              					<div class="card-footer" style="<?php if ($rows2['case_status'] == "RECOVERED") {
																		echo "background-color:green;color:white;";
																	} else if ($rows2['case_status'] == "DECEASED") {
																		echo "background-color:gray";
																	} ?>">
              						<div class="text-center"> <strong>STATUS: <?php echo $rows2['case_status']; ?></strong>
              						</div>
              					</div>
              				</div>
              			</div>


              		<?php
						}

						?>

              		<?php
						?>
              		<?php
						?>
              	</div>
              </div>
              <!-- /.card-body -->