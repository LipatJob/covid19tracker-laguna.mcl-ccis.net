<?php
  include 'phpcore/connection.php';
  $testingthis = $_GET['location'];
  $testget = str_replace("%20","",$testingthis);
  $testget = str_replace(" ","",$testingthis);
	
	
	$msql =  "SELECT 
        barangay,
        TOTAL_POSITIVE_CASES,
        NEW_CASES,
        ACTIVE_CASES,
        TOTAL_RECOVERED,
        TOTAL_PUI,
        TOTAL_PUM,
        TOTAL_DECEASED 
        FROM 
        " .$testget."_BRGY_DATA WHERE NOT (NEW_CASES = 0 AND ACTIVE_CASES = 0 AND TOTAL_POSITIVE_CASES = 0 AND TOTAL_DECEASED = 0 AND TOTAL_RECOVERED = 0 AND TOTAL_PUM = 0 AND TOTAL_PUI = 0) ORDER BY barangay REGEXP '^[^a-zA-A]' ASC";
    $msql2 = "SELECT 
        barangay,
        TOTAL_POSITIVE_CASES,
        NEW_CASES,
        ACTIVE_CASES,
        TOTAL_RECOVERED,
        TOTAL_PUI,
        TOTAL_PUM,
        TOTAL_DECEASED 
        FROM 
        " .$testget. "_BRGY_DATA WHERE NOT (NEW_CASES = 0 AND ACTIVE_CASES = 0 AND TOTAL_POSITIVE_CASES = 0 AND TOTAL_DECEASED = 0 AND TOTAL_RECOVERED = 0 AND TOTAL_PUM = 0 AND TOTAL_PUI = 0) ORDER BY barangay REGEXP '^[^a-zA-A]' ASC";
        
        
	if($testget == 'LAGUNA')
	{
		$msql = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_PUI, TOTAL_PUM, TOTAL_DECEASED FROM ALL_TOTAL";
		$msql2 = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_PUI, TOTAL_PUM, TOTAL_DECEASED FROM ALL_TOTAL";
	}
	
	

?>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
      <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!--<link rel="stylesheet" href="fontawesome/css/all.css">-->
    <!--<link rel="stylesheet" href="dist/css/adminlte.css">-->
   <!-- <link rel="stylesheet" href="css/flexme.css">-->

                <?php
                
                    if($testget == 'LAGUNA'){
                       include 'LdLaguna.php';
                    }
                    else
                    {
                       include 'LdBarangay.php';
                    }

                     ?>
                
                

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
<script>

/*
  $(function () {
    $('#checkthistable').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
  */
  /*
  $(function () {
    $('#checkthistable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  */
  
  if ( ! $.fn.DataTable.isDataTable( '#checkthistable' ) ) {
    //$('#checkthistable').dataTable();
    $('#checkthistable').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": true,
      "aaSorting": []
    });
}


</script>