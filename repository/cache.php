<?php

/**
* WARNING:
* THIS CODE IS WORK IN PROGRESS
*
* @author Job Lipat
*/

/**
 * Gets the metadata of the cached items. The metadata will be used to check if the cache exists or if the cache has expired
 * 
 * @return Array the metadata of the cached items
 */
function getMetaData(){
    $metaLocation = dirname(__FILE__).("/cached/cachedmeta.json");
    if (file_exists($metaLocation)){
        fopen($metaLocation, 'w') or die("Cannot create meta file");
    }
    return json_decode(file_get_contents($metaLocation), true);
}
/**
 * Saves the metadata to cachemeta.json. The metadata contains the date and time when the resource has been cached.
 * 
 * @param Array $metaData the metadata to be stored
 */
function saveMetaData($metaData){
    $metaFile = fopen($metaLocation, 'w') or die("Cannot create write to meta file");
    fwrite($metaFile, json_encode($metaData));
}

function getCacheFile($functionKey){
    $cacheLocation = dirname(__FILE__).("/cached/".$functionKey.".json");
    $cacheContent = json_decode(file_get_contents($cacheContent), true);
    return $cacheContent;
}

function writeCacheFile($data, $functionKey){
    $cacheLocation = dirname(__FILE__).("/cached/".$functionKey.".json");
    $cacheFile = fopen($cacheLocation, 'w') or die("Cannot find cached file");
    fwrite($cacheFile, json_encode($data));
}

/**
 * Checks if the given function key has been cached
 */
function isCached($functionKey){
    $metaData = getMetaData();
    return array_key_exists($functionKey, $metaData);
}

function doCache($data, $functionKey){
    $metaData = getMetaData();
    $currentDateTime = new DateTime(); //Set CacheDateTime as current DateTime
    $currentDateTime->format("Y-m-d H:i:s"); // Convert date time
    $metaData[$functionKey] = $currentDateTime;
    writeCacheFile($data, $functionKey);
    saveMetaData($metaData); //Save meta data
}

function getCache($functionKey){
    $file = getCacheFile($functionKey);

}


/**
 * Returns the difference between two dates in minutes.
 * 
 * @param DateTime $date1 First date time to get difference of
 * @param DateTime $date2 Second date time to get difference of
 * @return Integer the difference between the dates
 */
function getMinuteDateDifference($date1, $date2){
    $dateDiff = $date1->diff($date2);
    $minuteDiff = 0;
    $minuteDiff += 43800 * $since_start->m;
    $minuteDiff += 1440 * $since_start->d;
    $minuteDiff += 60 * $since_start->h;
    $minuteDiff += $since_start->i;
    return $minuteDiff;
}

/**
 * Determines if the given functionKey's respective cache has expired
 * 
 * @param String $functionKey the key of the function
 * @return bool returns TRUE when the cache is expired and FALSE when the cache is not expired yet 
 */
function isCacheExpired($functionKey){
    //Get current DateTime
    $currentDateTime = new DateTime();
    $currentDateTime->format("Y-m-d H:i:s");
    //Get DateTime of cached data
    $cacheDateTime = new DateTime($data["DateTimeCached"]) or die("There was an error with the date format of the cached data");
    if(getMinuteDateDifference($cacheDateTime, $currentDateTime) <= 5){
        return FALSE;
    }
    return TRUE;
}

/**
* Returns the data given the function key. Executes the function and 
* caches the data if needed or gets the cached data if cache exists and is not expired
*
* @param Function $functionToCache an annonymous function that is to be cached
* @param String $functionKey a unique string to identify cached data in storage. The function key may only contain alphanumeric numbers.
*/
function getCached($functionToCache, $functionKey){
    //Validation
    validateFuntionKey($functionKey) or die("Invalid function key");
    //If the function is cached and data is not expired return the cached version of the data, 
    //else cache the function and return the data 
    $data = [];
    if(isCached($functionKey)){
        $data =  getCache($functionKey);
        //Cache again if cache is expired
        if(isCacheExpired($data)){
            $data = $functionToCache();
            doCache($data, $functionKey);
        }
    }else{
        $data = $functionToCache();
        doCache($data, $functionKey);
    }
    return $data;
}


function validateFuntionKey($functionKey){
    return ctype_alnum($functionKey);
}


function testCache(){
    echo "STARTING CACHE TEST";
    $passed = 0;
    $failed = 0;





    echo "PASSED:". $passed. ". FAILED: ".$failed;
}



?>