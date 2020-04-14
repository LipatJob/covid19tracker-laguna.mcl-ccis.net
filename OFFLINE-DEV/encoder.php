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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="css/flexme.css">


    <title>COVID-19: LAGUNA</title>
    
    <style> body {overflow: hidden; height:100%; width:100%;}</style>
  </head>
  <body onload="onLoad()">
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


      <!-- -->
      <div class="parent-container-horizontal">

      </div>
  
    <!-- -->
    <div class="parent-container-horizontal">
        <!-- -->
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

            </div>
              <!-- FLEX -->

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

            <!-- FLEX MIDDLE SECTION-->
                  <div class="item-container" style="flex-grow: .4;">
                    <div class="parent-container-vertical">
                      <!-- FLEX MIDDLE SECTION CARD 1-->
                   <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">CSV Uploader per City / Barangay</h3>
                      </div>
                      <div class="card-body">

                                               
                              <div class="form-group">
                          <label for="exampleInputFile">File input</label>
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
                    <div class="card-footer">
                           <a href="/images/myw3schoolsimage.jpg" download>
                                  <i class="fa fa-file-csv"></i></I></I>SAMPLE FILE
                                </a>
                </div>
                  </div>


                  <!-- FLEX MIDDLE SECTION CARD 2-->
                   <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">CSV Uploader for PATIENT LOGS</h3>
                      </div>
                      <div class="card-body">                                               
                              <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
							<form method="POST" enctype = "multipart/form-data">
                              <input type="file" class="custom-file-input" name="patientfile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                            </div>
                            <div class="input-group-append">
                              <input class="input-group-text" type = "submit" name = "submit4" value = "Upload">
							  </form>
                            </div> 
                                
                               
                                
                          </div>
                        </div>

                    </div>
                    <div class="card-footer">
                         <br>
                                  <a href="/images/myw3schoolsimage.jpg" download>
                                  SAMPLE FILE
                                </a>
                </div>
                  </div>
                  
                  
                                   <!-- FLEX MIDDLE SECTION CARD 2-->
                   <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">CSV Uploader for PATIENT LOGS</h3>
                      </div>
                      <div class="card-body">        
                      
                      
                              <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
							<form method="POST" enctype = "multipart/form-data">
                              <input type="file" class="custom-file-input" name="patientfile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                            </div>
                            <div class="input-group-append">
                              <input class="input-group-text" type = "submit" name = "submit4" value = "Upload">
							  </form>
                            </div> 
                                
                               
                                
                          </div>
                        </div>

                    </div>
                    <div class="card-footer">
                         <br>
                                  <a href="/images/myw3schoolsimage.jpg" download>
                                  SAMPLE FILE
                                </a>
                </div>
                  </div>





            </div>
          </div><!-- FLEX MIDDLE SECTION END -->




  </div>
    <!-- -->
        
    <!-- -->
  </div>

   <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small style="color: white;">welcome :) cheers</small>
    </div>
  </footer>


  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>





<!-- INADD KO REN TONG DIV -->
<div id ='loadScript1'>
</div>
<div id ='loadScript2'>
</div>
<!-- UNTIL HERE -->

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- ADD THIS SCRIPT -->
  <script>


    $("#city1").on('change',function() {
      var selcity = document.getElementById('city1');
      var city = selcity.options[selcity.selectedIndex].value;
      $('#brgy1').empty();
      $("#loadScript1").load("loadBarangays.php?city=" + city + "&brgy=brgy1");
    });

    $("#city2").on('change',function() {
      var selcity = document.getElementById('city2');
      var city = selcity.options[selcity.selectedIndex].value;
      $('#brgy2').empty();
      $("#loadScript1").load("loadBarangays.php?city=" + city + "&brgy=brgy2");
    });
</script>
  </body>
</html>