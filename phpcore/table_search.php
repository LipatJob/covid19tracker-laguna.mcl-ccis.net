<table id="table_search" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>     
                      <th>Ref Date</th>  
                      <th>City / Municipality</th>
                      <th>Brgy</th>
                  </tr>
              </thead>
              <tbody>
                  <?php

            //config
            include_once('phpcore/connection.php');
          
         
          $msql = "SELECT `reference_date`,`city_municipality`,`barangay` FROM `barangay_history` ORDER BY `reference_date` DESC";
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
        </table>