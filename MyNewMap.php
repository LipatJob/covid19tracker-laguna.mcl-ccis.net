<html>
<head>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script> 

<script>
function recenter(){
   
    mymap.setView(new L.LatLng(14.202753,121.3370074), 11);
    }
	

</script>

<style>
p {
  font-style: bold;
  font-weight: 900;
  font-size: 11;
  color: #45433d;
  line-height:3.5px;
}
span {
  font-style: bold;
  font-weight: 900;
  font-size: 11;
  color: #216b40;
  line-height:3.5px;
}

p1 {
  font-style: bold;
  font-weight: 900;
  font-size: 6;
  line-height:4px;
}

p2 {
  font-style: bold;
  font-weight: 300;
  font-size: 9;
  color:  #45433d;
  line-height:4px;
}
p3 {
  font-style: normal;
  font-weight: 100;
  font-size: 6;
  line-height:4px;
}




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
    id: 'mapbox/streets-v8',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGFtYXJ0aWxsYW5vIiwiYSI6ImNrOHd0OWJrODAwNXczbHFya3Q1cG81Z3AifQ.Vc0FW9YcAo3McS6JN3ngbg'
}).addTo(mymap);

</script>


 <?php
 $DB_HOST = 'localhost';
  $DB_USER = 'mclccisn';
  $DB_PASS = 'mclCCIS2020!';
  $DB_NAME = 'mclccisn_covid19tracker_devdb';

  $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

  if(!$con)
  {
    die( "Unable to select database");
  }
     
          $msql = "SELECT city_municipality, total_positive_cases, current_pum, current_pui,  latT, longT, current_deceased, current_recovered FROM barangay_history JOIN City ON city_municipality = CityName  WHERE city_municipality = CityName";
          //fetch
          $result1 = mysqli_query($con, $msql);
          $longT=[];
		  $latT=[];
		  $cases=[];
		  $cities=[];
		  $PUM=[];
		  $PUI=[];
		  $recovered=[];
		  $death=[];
		  $x=0;
          //contents populate
          while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) { 
		   $cities[$x]=$row[0];
		   $cases[$x]=$row[1];
		   $PUM[$x]=$row[2];
		   $PUI[$x]=$row[3];
           $longT[$x]=$row[6];
		   $latT[$x]=$row[7];
		   $death[$x]=$row[4];
		   $recovered[$x]=$row[5];
		   $x++;
          }
		  
		   $msql = "SELECT city_municipality, total_positive_cases, current_pum, current_pui,  latT, longT, current_deceased, current_recovered FROM barangay_history JOIN City ON city_municipality = CityName  WHERE city_municipality = CityName";
          //fetch
          $result = mysqli_query($con, $msql);
      
		   $msql2 = "SELECT * FROM individual_cases ORDER BY barangay";
		   //fetch
           $result2 = mysqli_query($con, $msql2);
		   $indi=[[]];
		   $y=0;
		   $z=0;
		   while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) { 
		   
		    while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) { 
			     
			   if ($row[0]==$row2[0]){
				   $indi[$y][0]=$row2[0];
				   $indi[$y][1]=$row2[1];
				   $indi[$y][2]=$row2[2];
				   $indi[$y][3]=$row2[3];
				   $indi[$y][4]=$row2[4];
				   $indi[$y][5]=$row2[5];
				   $indi[$y][6]=$row2[6];
				   $indi[$y][7]=$row2[7];

				 $y++; 
			   }
			   else
			      break;
			  
			}
			 $z++;
		   }
		   
		    $s="";
		   $indiData=[];
		   for($i = 0; $i < count($indi); $i++) {
				$s="";
				for($ii = 0; $ii < count($indi[$i]); $ii++) {
					$s=$s.$indi[$i][$ii]. "|"."&emsp;";
				}
				$indiData[$i]= $s."</br>" ;
			}
		   
		   
		  
?>
<script>


var indiv=<?php echo json_encode($indi) ?>;
var indiData=[<?php echo '"'.implode('","',  $indiData ).'"' ?>]

var longT=[<?php echo '"'.implode('","',  $longT ).'"' ?>]; 
var latT=[<?php echo '"'.implode('","',  $latT ).'"' ?>];
var cities=[<?php echo '"'.implode('","',  $cities ).'"' ?>];
var cases=[<?php echo '"'.implode('","',  $cases ).'"' ?>];
var PUM=[<?php echo '"'.implode('","',  $PUM ).'"' ?>];
var PUI=[<?php echo '"'.implode('","',  $PUI ).'"' ?>];
var Recovered=[<?php echo '"'.implode('","',  $recovered ).'"' ?>];
var Death=[<?php echo '"'.implode('","',  $death ).'"' ?>];
var RecoverRate=[];
var Percent=[];
var totalcases=0;
var totaldeath=0;
var patients=[];
var f=0;

var p="";
for(jj=0;jj<cities.length;jj++){
	p="";
for(ii=0;ii<indiData.length;ii++){
	var s1=String(indiData[ii]);
	var s2=String(cities[jj]);
	if (s1.includes(s2)){
	 var s3 = s1.replace(s2+"|", "");
	 p=p+s3+"</br>";	
	}
}
patients[jj]=p;
}




for(x=0;x<cases.length;x++){
	totalcases=totalcases+Number(cases[x]);
	totaldeath=totaldeath+Number(Death[x]);
    RecoverRate[x]=(Number(Recovered[x])/Number(cases[x])*100);
	RecoverRate[x]=RecoverRate[x].toFixed(2);
}


for(x=0;x<cases.length;x++){
	Percent[x]=Number(cases[x])/totalcases*100;
    Percent[x]=Percent[x].toFixed(2);
	}


/*
var coronaIcon = L.icon({
    iconUrl: 'virus.png',
   // shadowUrl: 'shadow.png',

    iconSize:     [40, 55], // size of the icon
   // shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
   // shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
*/


for(i=0;i<longT.length;i++){
//set color for circle	
var r=Number(cases[i])*100;
if (cases[i]>=20){
	var c='red'
    var f='#f03'}
else if(cases[i]>=8){
	var c='#cf643a'
    var f='#943b18'}
else {
	var c='#ebba34'
    var f='#87640b'}
var circle1 = L.circle([longT[i],latT[i] ], {
    color: c,
    fillColor: f,
    fillOpacity: 0.5,
    radius: r
}).addTo(mymap);

f=0;

circle1.bindPopup("<p2>"+cities[i]+ " Individual CASES: "+"</p2></br></br><p3>"+ patients[i]+"</p3>");

// put label in marker
var marker1 = L.marker([longT[i],latT[i]]).addTo(mymap).bindTooltip("<center><p2>"+cities[i]+":"+ cases[i]+ " Cases</p2></center>", 
    {
        permanent: true, 
        direction: 'top'
    });
//put click event in marker	
	marker1.on('click', onClick);
	function onClick(e) {
		if (f==0){
			mymap.setView(new L.LatLng(e.latlng.lat, e.latlng.lng), 14);
			f=1;
		}
		
		else{
			mymap.setView(new L.LatLng(14.202753,121.3370074), 11);
			f=0;
		}
	}
		

	// create popup contents
   
    var customPopup = "<center>CASES: " + cases[i]+ " "+ "PUM: " + PUM[i] +" "+ "PUI: " + PUI[i]+"</center><center><img src='https://media.giphy.com/media/MCAFTO4btHOaiNRO1k/giphy.gif' alt='maptime logo gif' width='75px'/><p>"+cities[i]+" has "+ Percent[i] + "% of Total Cases in LAGUNA</p><p> and records " +Death[i]+ " out of "+totaldeath+" death/s</p><span>*Current Recovery Rate is "+RecoverRate[i]+"%</span><h1><p1>*computed as total recovered over total cases times 100. 0% might mean patients are still waiting for results</i></p1></center>";
    // specify popup options 
    var customOptions =
        {
        'maxWidth': '500',
        'className' : 'custom'
        }
	

//marker1.bindPopup(cities[i]+ "\n"+ "CASES: " + cases[i]+ "\n"+ "PUM: " + PUM[i] +"\n"+ "PUI: " + PUI[i]);
marker1.bindPopup(customPopup,customOptions);

	
	
}
	
</script> 

</div>




</body>
</html>