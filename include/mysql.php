<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          mysql.php
**          LastMod: 17:40 19.02.2007
** *********************************/
require_once 'config.php';
$queries = 0;

function db_connect ($db_name, $host = 'localhost', $user = 'root', $password = '') {
    $db = mysql_connect ($host, $user, $password);
    mysql_select_db ($db_name, $db);
    return $db;
}

//table query
function db_query ($sql) {
    $GLOBALS['queries']++;
    $res = mysql_query ($sql);
    $arr = array ();
    while ($row = mysql_fetch_assoc ($res))
        $arr [] = $row;
    return $arr;
}

function db_query1 ($sql) {
    $GLOBALS['queries']++;
    $res = mysql_query ($sql);
    $arr = array ();
    $row = mysql_fetch_assoc ($res);
    return $row;
}

function db_qquery ($sql) {
    $GLOBALS['queries']++;
    mysql_query ($sql);
    if (!db_error(true)) return true;
    else return false;
}

function db_arrquery ($sql, $keys = null) {
    $GLOBALS['queries']++;
    $res = mysql_query ($sql);
    $arr = array ();
    if (is_null($keys))
        while ($row = mysql_fetch_array ($res))
            $arr [] = $row[0];
    else
        while ($row = mysql_fetch_array ($res))
            $arr [$row[$keys]] = $row[0];
    return $arr;
}

function db_id () {
    return mysql_insert_id();
}

function db_error ($quiet = false) {
    if (mysql_errno () == 0) return 0;
    
    if (!$quiet)
        echo mysql_error ();
    return mysql_errno ();
}

function db_result ($sql) {
    $GLOBALS['queries']++;
    $res = mysql_query ($sql);
    return mysql_result ($res, 0);
}

$db = db_connect ($db_name, $db_host, $db_user, $db_pass);
?>