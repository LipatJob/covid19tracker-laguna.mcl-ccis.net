<?php

$hdr = $_GET['city'];
$myText = "";

if($hdr == "LAGUNA")
{
    $myText = "Region IV-A: Province of Laguna";
}
else if ($hdr == "CABUYAO")
{
     $myText = "Region IV-A: City of CABUYAO";
}
else if ($hdr == "BINAN")
{
     $myText = "Region IV-A: City of BINAN";
}
else if ($hdr == "CALAMBA")
{
     $myText = "Region IV-A: City of CALAMBA";
}
else if ($hdr == "SAN PEDRO")
{
     $myText = "Region IV-A: City of SAN PEDRO";
}
else if ($hdr == "SANTA ROSA")
{
     $myText = "Region IV-A: City of SANTA ROSA";
}
else if ($hdr == "SAN PABLO")
{
     $myText = "Region IV-A: City of SAN PABLO";
}
else
{
     $myText = "Region IV-A: Municipality of ". $hdr . "";
}

     echo  $myText;

?>