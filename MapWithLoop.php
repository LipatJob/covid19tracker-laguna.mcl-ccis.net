<html>
<head>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script> 

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<script>
function recenter(){
   
    mymap.setView(new L.LatLng(14.250,121.28), 10.115);
     f=0;
     mymap.closePopup();
    }
	
</script>

<style>
p {
  font-style: bold;
  font-weight: 900;
  font-size: 13;
  color: #45433d;
  line-height:4px;
}
span {
  font-style: bold;
  font-weight: 900;
  font-size: 13;
  color: #216b40;
  line-height:4px;
}

p1 {
  font-style: bold;
  font-weight: 900;
  font-size: 8;
  line-height:4px;
}

p3 {
  font-style: bold;
  font-weight: 900;
  font-size: 12;
  line-height:4px;
   color:  #45433d;
}

#mapid { height: 100%;width:100% }

</style>
</head>

<body>
 
 <div id="mapid">

  <script>
     var mymap = L.map('mapid').setView(new L.LatLng(14.250,121.28), 10.115);

     L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGFtYXJ0aWxsYW5vIiwiYSI6ImNrOHd0OWJrODAwNXczbHFya3Q1cG81Z3AifQ.Vc0FW9YcAo3McS6JN3ngbg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v8',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGFtYXJ0aWxsYW5vIiwiYSI6ImNrOHd0OWJrODAwNXczbHFya3Q1cG81Z3AifQ.Vc0FW9YcAo3McS6JN3ngbg'
    }).addTo(mymap);



    mymap.on('click', function(){ 
            mymap.closePopup();
            mymap.setView(new L.LatLng(14.250,121.28), 10.115);
            f=0;
    });


</script>


 <?php
  $DB_HOST = 'localhost';
  $DB_USER = 'mclccisn';
  $DB_PASS = 'mclCCIS2020!';
  $DB_NAME = 'mclccisn_covid19tracker_db';

  $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

  if(!$con)
  {
    die( "Unable to select database");
  }

           
          $msql = "SELECT * FROM COMBINED_DATA_MAP ORDER BY CityName ";
          //fetch
          $result1 = mysqli_query($con, $msql);
          $longT=[];
		  $latT=[];
		  $cases=[];
		  $cities=[];
		  $Probable=[];
		  $Suspect=[];
		  $recovered=[];
		  $death=[];
		  $x=0;
          //contents populate
          while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) { 
		   $cities[$x]=$row[0];
		   $cases[$x]=$row[1];
		   $Suspect[$x]=$row[2];
		   $Probable[$x]=$row[3];
           $longT[$x]=$row[6];
		   $latT[$x]=$row[7];
		   $death[$x]=$row[4];
		   $recovered[$x]=$row[5];
		   $x++;
          }
		   
   $indi = array("ALAMINOS", "BAY", "BINAN", "CABUYAO","CALAMBA","CALAUAN","CAVINTI","FAMY","KALAYAAN","LILIW","LOS BANOS","LUISIANA","LUMBAN","MABITAC","MAGDALENA","MAJAYJAY","NAGCARLAN","PAETE","PAGSANJAN","PAKIL","PANGIL","PILA","RIZAL","SAN PABLO","SAN PEDRO","SANTA CRUZ","SANTA MARIA","SANTA ROSA","SINILOAN","VICTORIA");	   
   $src="";	
   $stat="";
   $allindi=[];
		for($p=0;$p<30;$p++){

		   
		 	  
		   $startT= "<table style='width:100%'>";				
		   $endT=   "</table>";
		 
		   
		   $msql2 = "SELECT * FROM individual_cases where barangay='".$indi[$p]."' ORDER BY official_case_code";	 
		   $pdata="";
		   $pdata=  "<tr>";			
		   $x=0;
           $result2 = mysqli_query($con, $msql2);   
		   $cnt = mysqli_num_rows($result2);
		   
		   if($cnt>0) {
		
		    while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) { 
				 $caseCode= "  ".$row2[2]."  ";
				 $brgy=$row2[1];
		         $gender=$row2[3];
				 $age=$row2[4];
				 $dateCon=$row2[5];
				 $status=$row2[6];
				 
				 if($status=="RECOVERED"){ $stat=";color: green";}
				 else if($status=="DECEASED"){ $stat=";color: gray";}
				 else{ $stat=";color: #151563";}
				 
				 if($age==-1){$age="NA";$src="non.png";}
				 if($gender=="*NOT SPECIFIED"){$gender= "NA";$src="non.png";}
				 
				 if($age>=60 && $gender=="M")
					 $src="60-upYearsOld_MALE.png";
				 else if($age>=30 && $gender=="F")
					 $src="30-59YearsOld_FEMALE.png";
				 else if($age>=30 && $gender=="M")
					 $src="30-59YearsOld_MALE.png";
				 else if($age>=20 && $gender=="F")
					 $src="20-29YearsOld_FEMALE.png";
				 else if($age>=20 && $gender=="M")
					 $src="20-29YearsOld_MALE.png";
				 else if($age>=10 && $gender=="F")
					 $src="10-19YearsOld_FEMALE.png";
				 else if($age>=10 && $gender=="M")
					 $src="10-19YearsOld_MALE.png";
				 else if($age>=0 && $gender=="F")
					 $src="0-9YearsOld_FEMALE.png";
				 else if($age>=0 && $gender=="M")
					 $src="0-9YearsOld_MALE.png";
				 else
					 $src="non.png";
					 
				 if(($age=="NA" || $age==-1)&&($gender="M")){ $src="non.png";}
				 if(($age=="NA" || $age==-1)&&($gender="F")){ $src="non.png";}
				 
				 $bgcolor2 = "green";
				 $fcolor  = "white";
				 $bgcolor1 = "#090e9e";
				 
				 if($status == "RECOVERED")
				 {
				     $bgcolor1 = "green";
				 }
				 else if($status == "DECEASED")
				 {
				     $bgcolor1 = "#79808E";
				 }
				 else
				 {
				      $bgcolor1 = "#195387";
				 }
				    
				 

				$pdata=	$pdata.	"<td>".
								"<div style='width:auto;'>".
								       
								       	"<div style='background-color: ".$bgcolor1.";height: 20px; width: auto;color: white;font-size:13;'>".$caseCode."</div>".
								       	 "<p>        </p>".
										"<img align='left' src ='icons/". $src. "' width=35 height=35 margin: 0 0 0/>". "<p>        </p>".
										"<p style='font-size:11; font-style: bold;font-weight: 400;line-height:4px;color: black; margin: 0 0 8; ' >Gender : ".$gender."</p>".
										"<p style='font-size:11; font-style: bold;font-weight: 400;line-height:4px;color: black; margin: 0 0 8;' >Age     : ".$age."</p>".
										"<p style='font-size:10; font-style: bold;font-weight: 400;line-height:4px; color: black; margin:0 0 8' >".$dateCon."</p>".
										"<p>        </p>".
										"<div style='border-style: solid; border-width: thin;border-color: #626573;height: 20px; text-align:center; margin:0 0 8;font-size:11;padding: 5px;".$stat. "'> ".$status."</div>".
										"<p>        </p>".
								"</div>".
								"</td>";
				 //close row and open new row		
				 if ($x==1){
					 $pdata=$pdata."</tr><tr>";
					 $x=-1;
				 }		
		        $x++;
          }
		  //check is complete 2 in row, if not end table
		  if($x<1)
			 $pdata=$pdata."</tr>";
		  $pdata=$startT.$pdata.$endT;
          $allindi[$p]=$pdata;
		
		}
		  else
		{
			$allindi[$p]="NO DATA";
		}
	}

?>
<script>
//transfer php data from db to script
var alam=[<?php echo '"'.implode('","',  $allindi ).'"' ?>];
var longT=[<?php echo '"'.implode('","',  $longT ).'"' ?>]; 
var latT=[<?php echo '"'.implode('","',  $latT ).'"' ?>];
var cities=[<?php echo '"'.implode('","',  $cities ).'"' ?>];
var cases=[<?php echo '"'.implode('","',  $cases ).'"' ?>];
var Probable=[<?php echo '"'.implode('","',  $Probable ).'"' ?>];
var Suspect=[<?php echo '"'.implode('","',  $Suspect ).'"' ?>];
var Recovered=[<?php echo '"'.implode('","',  $recovered ).'"' ?>];
var Death=[<?php echo '"'.implode('","',  $death ).'"' ?>];
var RecoverRate=[];
var Percent=[];
var totalcases=0;
var totaldeath=0;
var patients=[];
var f=0;
var f1=0;


// compute total cases,total death, and recovery rate
for(x=0;x<cases.length;x++){
	totalcases=totalcases+Number(cases[x]);
	totaldeath=totaldeath+Number(Death[x]);
	if (Number(cases[x]>0))
        RecoverRate[x]=(Number(Recovered[x])/Number(cases[x])*100);
    else
        RecoverRate[x]=0;
	RecoverRate[x]=RecoverRate[x].toFixed(2);
}

//compute case raet
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
    //create circle and add to map    
    var circle1 = L.circle([longT[i],latT[i] ], {
        color: c,
        fillColor: f,
        fillOpacity: 0.5,
        radius: r
    }).addTo(mymap);
    
    //set flag to toggle zoom
    f=0;
    
    circle1.bindPopup("<center></br><p3><strong>"+cities[i]+ " INDIVIDUAL CASES: "+"</strong></p3></center></br>"+alam[i],{maxWidth: 450, minWidth: 300, maxHeight: 325, autoPan: true, autoPanPadding: [0, 0]});
    // put label in marker
    var marker1 = L.marker([longT[i],latT[i]]).addTo(mymap).bindTooltip("<center><p2>"+cities[i]+":"+ cases[i]+ " Cases</p2></center>", 
        {
            permanent: false, 
            direction: 'top'
        });
    marker1.closeTooltip();
    
    
        
      //put click event in marker	
    	marker1.on('click', onClick);
    	function onClick(e) {
    		if (f==0){
    			mymap.setView(new L.LatLng(e.latlng.lat, e.latlng.lng), 14);
    			f=1;
    		}
    		
    		else{
    			//mymap.closePopup();
    			mymap.setView(new L.LatLng(14.202753,121.3370074), 11);	
    			f=0;
    		}
    	}
    
    
    	//check if popup closes
    	circle1.on('popupclose', function (popup) {
            mymap.setView(new L.LatLng(14.202753,121.3370074), 11);
            f=0;
        });
        
         marker1.on('popupclose', function (popup) {
           
            f=0;
        });
    	
    
    	// create popup contents for marker
        var customPopup = "<span style='color: #1a4024;'><center>CASES: " + cases[i]+ " "+ "PROBABLE: " + Probable[i] +" "+ "SUSPECT: " + Suspect[i]+"</center></span><center><p><img src='https://media.giphy.com/media/MCAFTO4btHOaiNRO1k/giphy.gif' alt='maptime logo gif' width='75px'/></p><p>"+cities[i]+" has "+ Percent[i] + "% of Total Cases in LAGUNA</p><p> and records " +Death[i]+ " out of "+totaldeath+" death/s</p><span>*Current Recovery Rate is "+RecoverRate[i]+"%</span></br></br><h1><p1>*computed as total recovered over total cases times 100. 0% might mean patients are still waiting for results</i></p1></h1></center>";
       
        // specify popup options 
        var customOptions =
            {
            maxWidth:1000,
            maxHeight:1000
            }
    	
        //bind the popup made in marker
        marker1.bindPopup(customPopup,customOptions);

}
	
</script> 

</div>


<div class="row">
<div class="col col-lg-6 col-sm-6 col-md-6">
<button onclick="recenter()" style="width: 100%; font-weight: bold;">Re-Center</button></div>
<div class="col col-lg-6 col-sm-6 col-md-6">
<button type="button" data-toggle="modal" data-target="#exampleModalCenter" style="width: 100%;  font-weight: bold;">Instructions</button></div>
</div>
</body>
</html>