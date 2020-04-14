<head>
    <style>
        
        
        table td, th {
              border: 1px solid #ddd;
              padding: 8px;
            }
        

        table tr:nth-child(even){
            background-color: #FFFFFF;
            
        }
        
            
        table td{
            text-align: center;
            width: 11%;
            font-size: 18px;
            color: black;
        }
        
        table td:first-child {
            text-align: left;
            width: 20%;
        }
        

       thead{
            text-align: center; 
            background-color: #354664;
            font-size: 16px;
        }
        
        table tr:hover{
            border: 8px;
            border-style: solid;
            border-color: green;
            padding: 15px;
            background-color: #65AFDA;
        }
        

        
    </style>
    
</head>
<body>
<table id="checkthistable" class="table table-bordered table-striped dataTable" role="grid">
                  
                <thead>
                <tr role="row">

                      <th>CITY / MUNICIPALITY</th>
                      <th>TOTAL CASES</th>
                      <th>NEW CASES</th>
                      <th style="width: 14%">ACTIVE CASES</th>
                      <th>RECOVERED</th>
                      <th>P U I</th>
                      <th>P U M</th>
                      <th>DECEASED</th>
                 
                </tr>
                </thead>
                <tbody> 

                  <?php

            //config
            include_once('phpcore/connection.php');
          
         
          //fetch
          $msql9 = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_PUI, TOTAL_PUM, TOTAL_DECEASED FROM ALL_TOTAL";
          $result1 = mysqli_query($con, $msql9);

          //contents populate
          while ($row1 = mysqli_fetch_assoc($result1)) {
			 
              echo "<tr>";
			  if($testget != 'LAGUNA')
			   echo '<td>'.$testget.'</td>';
              foreach ($row1 as $field => $value) {
                  echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
          }
            ?>
                

                </tbody>
                <tfoot>
				<?php
				if($testget == 'LAGUNA')
				{
					
					 $result1 = mysqli_query($con,"SELECT SUM(TOTAL_POSITIVE_CASES) as POSCASES, SUM(NEW_POSITIVE_CASES) as NEWPOS, SUM(TOTAL_CURRENT_POSITIVE) as ACTIVE,SUM(TOTAL_RECOVERED) as RECOVERED,  SUM(TOTAL_PUI) as PUI,SUM(TOTAL_PUM) as PUM, SUM(TOTAL_DECEASED) as DECEASED FROM ALL_TOTAL");
					while($extract = mysqli_fetch_array($result1)){
					?>
				
                <tr style="color: green;"><th rowspan="1" colspan="1">TOTAL</th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['POSCASES'];?></th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['NEWPOS'];?></th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['ACTIVE'];?></th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['RECOVERED'];?></th>
                <th style="text-align: center; font-size: 19px;" rowspan="1" colspan="1"><?php echo $extract['PUI'];?></th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['PUM'];?></th>
                <th style="text-align: center; font-size: 19px;"  rowspan="1" colspan="1"><?php echo $extract['DECEASED'];?></th>
                </tr>
                <?php
				}
				}
				?>
				</tfoot>
              </table>


<script>
    
    $(document).ready(function() {
    $('#checkthistable').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "search": false;
    } );
} );
    
    
</script>
</body>
			  