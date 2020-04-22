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

<<<<<<< HEAD

/**
* Returns the data given the function key. Executes the function and
* caches the data if needed or gets the cached data if cache exists and is not expired
*
* @param Function $functionToCache an annonymous function that is to be cached
* @param string $functionKey a unique string to identify cached data in storage. The function key may only contain alphanumeric numbers.
*/
function getCached($functionKey, $functionToCache, $parameters){
    //Validation
    validateFunctionKey($functionKey) or die("Invalid function key");
    $data = [];
    if(isCached($functionKey)){ //If the function is cached and data is not expired return the cached version of the data,
        echo "CACHED FILE FOUND  <br>"; 
        $data = retrieveCache($functionKey);
        if(isCacheExpired($data)){ //Cache again if cache is expired
            echo "CACHED EXPIRED  <br>"; 
            $data = $functionToCache($parameters);
            doCache($functionKey, $data);
        }
    }else{ //else cache the function and return the data 
        echo "FUNCITON NOT CACHED <br>"; 
        $data = $functionToCache($parameters);
        doCache($functionKey, $data);
    }
    return $data;
}

/**
 * Perfoms caching on the data based on the function key. Does not contain the logic for storing the cached data.
 * 
 * @param array $data
 * @param string $functionKey
 */
function doCache($functionKey, $data){
    $currentDateTime = new DateTime(); //Set CacheDateTime as current DateTime
    $currentDateTime->format("Y-m-d H:i:s"); // Convert date time
    $data["DateTimeCached"] = $currentDateTime;
    writeCacheFile($functionKey, $data);
}

/**
 * Retrieved the cached file. Does not contain the logic for retrieving the cached data.
 * 
 * @param string $functionKey
 */
function retrieveCache($functionKey){
    $file = getCacheFile($functionKey);
    return $file;
}

/**
 * Checks if the given function key has been cached.
 * 
 * @param string $functionKey
 */
function isCached($functionKey){
    return file_exists(dirname(__FILE__).("/cached/".$functionKey.".json"));
}

/**
 * Determines if the given functionKey's respective cache has expired
 * 
 * @param array $data the cached data
 * @return bool returns TRUE when the cache is expired and FALSE when the cache is not expired yet 
 */
function isCacheExpired($data){
    //Get current DateTime
    $currentDateTime = new DateTime();
    $currentDateTime->format("Y-m-d H:i:s");
    //Get DateTime of cached data
    $cacheDateTime = new DateTime($data["DateTimeCached"]["date"]) or die("There was an error with the date format of the cached data");
    if(getMinuteDateDifference($cacheDateTime, $currentDateTime) <= 5){
        return FALSE;
    }
    return TRUE;
}

function getCacheFile($functionKey){
    $cacheLocation = dirname(__FILE__).("/cached/".$functionKey.".json");
    $cacheContent = json_decode(file_get_contents($cacheLocation), true);
    return $cacheContent;
}

function writeCacheFile($functionKey, $data){
    $cacheLocation = dirname(__FILE__).("/cached/".$functionKey.".json");
    $cacheFile = fopen($cacheLocation, 'w') or die("Cannot find cached file");
    fwrite($cacheFile, json_encode($data));
=======
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
>>>>>>> 46d6ee2324d302c21ff4867460a36c63f40846c9
}


/**
<<<<<<< HEAD
 * Returns the difference between two dates in minutes.
 * 
 * @param DateTime $date1 First date time to get difference of
 * @param DateTime $date2 Second date time to get difference of
 * @return int the difference between the dates
 */
function getMinuteDateDifference($date1, $date2){
    $dateDiff = $date1->diff($date2); //get difference
    $minuteDiff = 0;
    $minuteDiff += 43800 * $dateDiff->m; //month
    $minuteDiff += 1440 * $dateDiff->d; //day
    $minuteDiff += 60 * $dateDiff->h; //hour
    $minuteDiff += $dateDiff->i; //minutes
    return $minuteDiff;
}

/**
 * Validates wheter the function key is valid.
 * The function key is valid when it only contains aphanumeric characters.
 * 
 * @param string $functionKey the key to validate
 * @return bool returns TRUE when the key is valid and FALSE if the key is invalid
 */
function validateFunctionKey($functionKey){
    return ctype_alnum($functionKey);
}

function testCache(){
    echo "STARTING CACHE TEST <br>";
    $passed = 0;
    $failed = 0;
    include "queries.php";
    $newData = getCached("test2", 'getCasesByAgeGroup', "LAGUNA");
    print_r($newData);
    echo "cached created";

    echo "PASSED:". $passed. ". FAILED: ".$failed;
}
=======
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

>>>>>>> 46d6ee2324d302c21ff4867460a36c63f40846c9




<<<<<<< HEAD
=======
    echo "PASSED:". $passed. ". FAILED: ".$failed;
}


>>>>>>> 46d6ee2324d302c21ff4867460a36c63f40846c9

?>