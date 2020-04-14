<html>
<head>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script> 

<script>
function recenter(){
    alert("center!");
    mymap.setView(new L.LatLng(14.202753,121.3370074), 11);
    }

</script>

<style>
#mapid { height: 100%;width:100% }
</style>

</head>
<body>
 <button onclick="recenter()">recenter</button>
 
 <div id="mapid">

  <script>
     var mymap = L.map('mapid').setView([14.202753,121.3370074], 11);
     L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGFtYXJ0aWxsYW5vIiwiYSI6ImNrOHd0OWJrODAwNXczbHFya3Q1cG81Z3AifQ.Vc0FW9YcAo3McS6JN3ngbg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGFtYXJ0aWxsYW5vIiwiYSI6ImNrOHd0OWJrODAwNXczbHFya3Q1cG81Z3AifQ.Vc0FW9YcAo3McS6JN3ngbg'
}).addTo(mymap);

</script>


 <?php
 include_once('phpcore/connection.php');
     
          $msql = "SELECT * FROM COMBINED_DATA_MAP ";
          //fetch
          $result1 = mysqli_query($con, $msql);
          $longT=[];
		  $latT=[];
		  $cases=[];
		  $cities=[];
		  $PUM=[];
		  $PUI=[];
		  $x=0;
          //contents populate
          while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) { 
		   $cities[$x]=$row[0];
		   $cases[$x]=$row[1];
		   $PUM[$x]=$row[2];
		   $PUI[$x]=$row[3];
           $longT[$x]=$row[6];
		   $latT[$x]=$row[7];
		   $x++;
          }
		  
		 ?>
<script>
var longT=[<?php echo '"'.implode('","',  $longT ).'"' ?>]; 
var latT=[<?php echo '"'.implode('","',  $latT ).'"' ?>];
var cities=[<?php echo '"'.implode('","',  $cities ).'"' ?>];
var cases=[<?php echo '"'.implode('","',  $cases ).'"' ?>];
var PUM=[<?php echo '"'.implode('","',  $PUM ).'"' ?>];
var PUI=[<?php echo '"'.implode('","',  $PUI ).'"' ?>];


for(i=0;i<29;i++){
var r=Number(cases[i])*100;
var circle1 = L.circle([longT[i],latT[i] ], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: r
}).addTo(mymap);
circle1.bindPopup(cities[i]+ "\n"+ "CASES: " + cases[i]+ "\n"+ "PUM: " + PUM[i] +"\n"+ "PUI: " + PUI[i]);
//
//
var marker1 = L.marker([longT[i],latT[i]]).addTo(mymap) .bindTooltip(cities[i]+" : "+ cases[i]+ " Cases)", 
    {
        permanent: true, 
        direction: 'right'
    });

marker1.bindPopup(cities[i]+ "\n"+ "CASES: " + cases[i]+ "\n"+ "PUM: " + PUM[i] +"\n"+ "PUI: " + PUI[i]);
	
	

}
</script> 


</body>
</html>