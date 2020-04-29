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

                      <th>BARANGAY</th>
                      <th>TOTAL CASES</th>
                      <th>NEW CASES</th>
                      <th>ACTIVE CASES</th>
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
          $result1 = mysqli_query($con, $msql);

          //contents populate
          while ($row1 = mysqli_fetch_assoc($result1)) {
			 
              echo "<tr>";
			  if($testget != 'LAGUNA')
			    //echo '<td>'.$testget.'</td>';
              foreach ($row1 as $field => $value) {
                  echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
          }
            ?>
                

                </tbody>
                
                                <tfoot>
				<?php
				if($testget != 'LAGUNA')
				{
					
					 $result1 = mysqli_query($con,'SELECT 
                                                    barangay,
                                                    SUM(TOTAL_POSITIVE_CASES) AS POSCASES,
                                                    SUM(NEW_CASES) AS NEWPOS,
                                                    SUM(ACTIVE_CASES) AS ACTIVE,
                                                    SUM(TOTAL_RECOVERED) AS RECOVERED,
                                                    SUM(TOTAL_PUI) AS PUI,
                                                    SUM(TOTAL_PUM) AS PUM,
                                                    SUM(TOTAL_DECEASED) AS DECEASED
                                                    FROM ' .$testget.'_BRGY_DATA');
                                                    
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
</body>
