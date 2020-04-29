              <?php
			  include 'phpcore/connection.php';
			  $mylocation = $_GET['location'];
			   if($mylocation=='LAGUNA')
	  {
	  $query1 = "SELECT * FROM individual_cases order by date_of_status asc, barangay";
		$query2 = "SELECT COUNT(official_case_code) as mycount FROM individual_cases";
	  }
	else
	{
		$query1 = "SELECT * FROM individual_cases where barangay = '$mylocation' order by date_confirmed asc, barangay";
		$query2 = "SELECT COUNT(official_case_code) as mycount FROM individual_cases where barangay = '$mylocation'";
	}
	$result2 = mysqli_query($con,$query2);
	$result1 = mysqli_query($con,$query1);
	while($rows3 = mysqli_fetch_array($result2))
	{
		$thiscount = $rows3['mycount'];
	}
			  
			  
			  ?>
			  <div class="card-header" style="background-color: #354664; color: white; height:50px;">
                <h5 style = "width: 50%; float:left">  INDIVIDUAL CASE INFORMATION</h5>
				<h5 style="width: 50%; text-align:right; float:right; color: white; right:0;"><b>TOTAL CASES: <?php echo $thiscount; ?></b></h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                <div class="parent-container-horizontal">
      
 
            	  
            	   <div class="table-responsive">  
             <div style="width:80%;">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody> <!-- START PHP HERE -->
                        <tr>
                            <?php

                                //config
                                include_once('connection.php');
                              
                              $msql = "SELECT id_no,name,accstatus FROM minfo";
                              //fetch
                              $result = mysqli_query($con, $msql);
                    
                              //contents populate
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>";
                                  foreach ($row as $field => $value) {
                                      echo "<td>" . $value . "</td>";
                                  }
                                  echo "</tr>";
                              }
                                ?>      
                        </tr>       
                    </tbody> <!-- END PHP HERE -->
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>
              </div></div>
	  

              </div> 		  
              </div>

 <script>
    $(document).ready(function() {
    $('#example').DataTable();
    } );
  </script>
