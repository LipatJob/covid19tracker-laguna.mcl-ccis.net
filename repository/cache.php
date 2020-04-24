<?php

/**
* WARNING:
* THIS CODE IS WORK IN PROGRESS
*/


function getCacheFile($functionKey){
    
}

function writeCacheFile($functionKey){
}

function isCached($functionKey){
    
    return False;
}

function doCache($data, $functionKey){
    
}

function getCache($functionKey){
    
}

/**
* @param Function $functionToCache an annonymous function that is to be cached
* @param String $functionKey a unique string to identify cached data in storage 
*/
function getCached($functionToCache, $functionKey){
    $data = [];
    if(isCached($functionKey)){
        $data =  getCache($functionKey);
    }else{
        $data = $functionToCache();
        doCache($data, $functionKey);
    }
    return $data;
}
?>