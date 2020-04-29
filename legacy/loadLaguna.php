<?php ?>
<thead>
                <tr role="row">
                      <th>City Municipality</th>
                      <th>New Positive Case</th>
                      <th>Current Positve Case</th>
                      <th>Deceased</th>
                      <th>Recovered</th>
                      <th>Total Positive Cases</th>
                      <th>Current PUM</th>
                      <th>Current PUI</th>
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
              foreach ($row1 as $field => $value) {
                  echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
          }
            ?>
                

                </tbody>
                <tfoot>
				<?php
				$result1 = mysqli_query($con,"SELECT SUM(NEW_POSITIVE_CASES) as NEWPOS, SUM(TOTAL_CURRENT_POSITIVE) as CURRENTPOS, SUM(TOTAL_DECEASED) as DECEASED, SUM(TOTAL_RECOVERED) as RECOVERED, SUM(TOTAL_POSITIVE_CASES) as POSCASES, SUM(TOTAL_PUM) as PUM, SUM(TOTAL_PUI) as PUI FROM ALL_TOTAL");
					while($extract = mysqli_fetch_array($result1)){
					?>
               <tr style="color: green;"><th rowspan="1" colspan="1">TOTAL</th><th rowspan="1" colspan="1"><?php echo $extract['NEWPOS'];?></th><th rowspan="1" colspan="1"><?php echo $extract['CURRENTPOS'];?></th><th rowspan="1" colspan="1"><?php echo $extract['DECEASED'];?></th><th rowspan="1" colspan="1"><?php echo $extract['RECOVERED'];?></th><th rowspan="1" colspan="1"><?php echo $extract['POSCASES'];?></th><th rowspan="1" colspan="1"><?php echo $extract['PUM'];?></th><th rowspan="1" colspan="1"><?php echo $extract['PUI'];?></th></tr>
                <?php
					}
				?>
				</tfoot>