<?php
include 'phpcore/connection.php';
$c = 0;
if(isset($_POST['submit3']))
	{


		if($_FILES['barangayfile']['name'])
		{
			$filename = explode(".", $_FILES['barangayfile']['name']);
			if($filename[1] == 'csv')
			{
				$handle = fopen($_FILES['barangayfile']['tmp_name'], "r");
				while($data = fgetcsv($handle))
				{
					$item1 = mysqli_real_escape_string($con, $data[0]);
					$item2 = mysqli_real_escape_string($con, $data[1]);
					$item3 = mysqli_real_escape_string($con, $data[2]);
					$item4 = mysqli_real_escape_string($con, $data[3]);
					$item5 = mysqli_real_escape_string($con, $data[4]);
					
					$item6 = mysqli_real_escape_string($con, $data[5]);
					$item7 = mysqli_real_escape_string($con, $data[6]);
					$item8 = mysqli_real_escape_string($con, $data[7]);
					$item9 = mysqli_real_escape_string($con, $data[8]);
					$item10 = mysqli_real_escape_string($con, $data[9]);
					$sql = "INSERT INTO barangay_history values('$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10')";
					mysqli_query($con,$sql);
					$c = $c + 1;
				}
				
				fclose($handle);
				
				$message="Import Finished";
				echo "<script type='text/javascript'>alert('$message $c');</script>";
			}
		}
	}

  if(isset($_POST['submit_delete']))
  {

        $city_municipality = $_POST['citymun'];
        $city_municipality = strtoupper($city_municipality);

        if($city_municipality == "NULL")
        {
             $sql = "DELETE FROM `barangay_history` WHERE `city_municipality` = '' AND `barangay` = ''";
             mysqli_query($con,$sql);
        }


          $sql = "DELETE FROM `barangay_history` WHERE `city_municipality` = '$city_municipality'";
          mysqli_query($con,$sql);

        $message="Records deleted for ";
        echo "<script type='text/javascript'>alert('$message $city_municipality');</script>";

  }

	
	
	if(isset($_POST['submit4']))
	{


		if($_FILES['patientfile']['name'])
		{
			$filename = explode(".", $_FILES['patientfile']['name']);
			if($filename[1] == 'csv')
			{
				$handle = fopen($_FILES['patientfile']['tmp_name'], "r");
				while($data = fgetcsv($handle))
				{
					$item1 = mysqli_real_escape_string($con, $data[0]);
					$item2 = mysqli_real_escape_string($con, $data[1]);
					$item3 = mysqli_real_escape_string($con, $data[2]);
					$item4 = mysqli_real_escape_string($con, $data[3]);
					$item5 = mysqli_real_escape_string($con, $data[4]);
					
					$item6 = mysqli_real_escape_string($con, $data[5]);
					$item7 = mysqli_real_escape_string($con, $data[6]);
					$item8 = mysqli_real_escape_string($con, $data[7]);
					$sql = "INSERT INTO individual_cases values('$item1','$item2','$item3','$item4','$item5','$item6','$item7', '$item8')";
					mysqli_query($con,$sql);
				}
				
				fclose($handle);
				
				$message="Import Finished";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    < <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

         <!-- daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
      <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

              <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link rel="stylesheet" href="dist/css/adminlte.css">
        <link rel="stylesheet" href="css/flexme.css">


    <title>COVID-19: LAGUNA</title>
    
    <style> body {overflow: hidden; height:100%; width:100%;}</style>


  </head>
  <body>
    <!-- As a link -->
<nav class="navbar navbar-light" id="title">
  <a style="color: white; font-size: 1.3em;">COVID-19 : DASHBOARD</a>
</nav>

<nav id="navtop" class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarText">
  <ul class="navbar-nav mr-auto">

    </ul>
    <span class="navbar-text">
      Submission / update Date : 4/5/2020 
    </span>
  </div>
</nav>
    <div class="parent-container-vertical" style="padding-left: 15px; padding-right: 15px; height: 100%;">
    <div class="parent-container-horizontal">
    <div class="item-container" style="padding-top: 10px;">
    <h1>Welcome encoder</h1>
    </div></div>

           <!-- TAB MENU -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">DATA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Uploader</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Encoding</a>
          </li>
        </ul>

         <!-- TAB CONTENTS-->
        <div class="tab-content" id="pills-tabContent">

          <!-- -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="parent-container-horizontal" style="padding: 20px;">

              <div class="item-container" style="width: 60%;">
              <div class="table-responsive">  
              <?php include('phpcore/table_search.php');?>
              </div>
               </div>


              <div class="item-container">
                <div class="parent-container-vertical" >

                                    <div class="item-container">
                                        <div class="parent-container-horizontal">
                                            <div class="item-container">

                                            </div>

                                             <div class="item-container">

                                            </div>
                                        </div>
                                    </div>


                                     <div class="item-container">
                                            <div class="card card-danger">
                                      <div class="card-header">
                                        <h3 class="card-title">City / Municipality</h3>
                                      </div>
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-7">
                                            <form action="" method="POST">

                                            <input type="text" class="form-control" name="citymun" placeholder="city_municipality" required/>
                                          </div>
                                          <div class="col-5">
                                           <button type="submit" name="submit_delete" class="btn btn-block btn-outline-danger" >DELETE</button></form>
                       
                                         </div>
                                        </div>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    </div>
                                    <!-- script -->
                     <!-- FLEX MIDDLE SECTION CARD 2-->
                            <div class="item-container">
                               <div class="card card-warning">
                                  <div class="card-header">
                                    <h3 class="card-title">CITY - BARANGAY UPLOADER</h3>
                                  </div>
                                  <div class="card-body">                                               
                                          <div class="form-group">
                                      <div class="input-group">
                                        <div class="custom-file">
                          <form method="POST" enctype = "multipart/form-data">
                                          <input type="file" class="custom-file-input" name="barangayfile">
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                                        </div>
                                        <div class="input-group-append">
                                          <input class="input-group-text" type = "submit" name = "submit3" value = "Upload">
                            </form>
                                        </div> 
                                            
                                           
                                            
                                      </div>
                                    </div>

                                </div>
                            
                              </div></div><!-- FLEX MIDDLE SECTION CARD 2-->

                 



                </div>
               </div>
        
            </div>
          </div>

          <!-- -->
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
             <div class="parent-container-vertical" style="width: 70%;">

                  <!-- FLEX MIDDLE SECTION CARD 2-->
              
                </div>
            </div>
          </div>

          <!-- -->
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="parent-container-horizontal">

                <!-- CARD 1-->
                <div class="item-container">
                <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Individual Case Submission : Patient Logs</h3>
                      </div>
                      <div class="card-body">
                            <!-- FROM HERE -->
                            <select id='city1'  class="form-control">
                                  <option>CITY</option>
                                  <?php
                                    $string = "SELECT city_municipality FROM `barangay_history` GROUP BY city_municipality";

                                    $result = $result1 = mysqli_query($con,$string);
                                    while($extract = mysqli_fetch_array($result)){
                                      echo "<option value=" . str_replace(" ","%20",json_encode($extract['city_municipality'])) . ">" . $extract['city_municipality'] . "</option>";

                                    }

                                  ?>
                                </select> <br>

                              <select id='brgy1' class="form-control">
                                  <option>Barangay</option>
                                </select> <br>
                                <!-- AND HERE -->
                     
                        <div class="parent-container-horizontal">
                        <div class="item-container"><input class="form-control" type="text" placeholder="Gender"></div>
                        <div class="item-container"><input class="form-control" type="text" placeholder="Age"></div>
                        </div> <br>
                        
                        <input class="form-control" type="text" placeholder="Date Confirmed">
                        <br>
                        
                        <select class="form-control">
                            <option>ADMITTED</option>
                            <option>DECEASED</option>
                            <option>RECOVERED</option>
                            
                        </select>
                        <br>

                        

                        <input class="form-control" type="text" placeholder="Date of Status">
                        <br>
             
                      <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                  <button type="submit" name="submit_individual" class="btn btn-primary">Submit</button>
                  </div>
                  </div>

            </div><!-- CARD 1 END-->

                  <!-- CARD 2-->
                <div class="item-container">
                <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Single Insert : Barangay History </h3>
                      </div>
                      <div class="card-body">

                        <!-- FROM HERE -->
                            <select id='city2' class="form-control">
                                  <option>CITY</option>
                                  <?php
                                    $string = "SELECT city_municipality FROM `barangay_history` GROUP BY city_municipality";

                                    $result = $result1 = mysqli_query($con,$string);
                                    while($extract = mysqli_fetch_array($result)){
                                      echo "<option value=" . str_replace(" ","%20",json_encode($extract['city_municipality'])) . ">" . $extract['city_municipality'] . "</option>";

                                    }

                                  ?>
                                </select> <br>

                              <select id='brgy2' class="form-control">
                                  <option>Barangay</option>
                                </select> <br>
                                <!-- AND HERE -->
                                
                     
                        <input class="form-control" type="text" placeholder="Number of PUM">
                        <br>

                        <input class="form-control" type="text" placeholder="Number of PUI">
                        <br>

                        <input class="form-control" type="text" placeholder="Number of DECEASED">
                        <br>

                        <input class="form-control" type="text" placeholder="Number of RECOVERED">
                        <br>

                      
             
                      <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                  <button type="submit" name="submit_barangay" class="btn btn-primary">Submit</button>
                  </div>
                  </div>

            </div> <!-- END-->




        
            </div>
          </div>

        </div>
         <!-- TAB ENDS HERE -->

      <!-- -->
      <div class="parent-container-horizontal"></div>
  
    <!-- -->
    <div class="parent-container-horizontal"></div>
        
    <!-- -->
  </div>

   <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small style="color: white;">welcome :) cheers</small>
    </div>
  </footer>








<!-- INADD KO REN TONG DIV -->
<div id ='loadScript1'>
</div>
<div id ='loadScript2'>
</div>
<!-- UNTIL HERE -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <!-- App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <!-- date-range-picker -->
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Select2 -->
      <script src="plugins/select2/js/select2.full.min.js"></script>

      <!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>


  <!-- ADD THIS SCRIPT -->
   <script>
    $(document).ready(function() {
    $('#table_search').DataTable();
    } );
  </script>
  </body>
</html>