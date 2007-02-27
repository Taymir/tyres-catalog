<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          manfr.php
**          LastMod: 17:17 24.02.2007
** *********************************/
require_once 'mysql.php';
require_once 'utils.php';

function add_manfr ($name, $description) {
    $sql = "INSERT INTO `manufacturers` (`name`, `description`) VALUES ('$name', '$description')";
    
    return db_qquery ($sql);
    //db_id ();
}

function add_manfr_csv ($name, $description) {
    $sql = "INSERT INTO `manufacturers` (`name`, `description`) VALUES ('$name', '$description')";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function select_manfrs ($full = false) {
    $fields = "name, id, description";
    $sql = "SELECT %s FROM `manufacturers` WHERE 1 ORDER BY name ASC";
    
    if (paginator_works () && $full) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    if ($full)
        return db_query (sprintf ($sql, $fields));
    return db_arrquery (sprintf ($sql, $fields), 'id');
}

function select_manfrs_byid ($id) {
    $sql = "SELECT name, description, id FROM `manufacturers` WHERE id = '$id'";
    
    return db_query1 ($sql);
}

function delete_manfr ($id) {
    $sql = "DELETE FROM `manufacturers` WHERE id = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function edit_manfr ($id, $name, $description = null) {
    $sql = "UPDATE `manufacturers` SET `name` = '$name', `description` = '$description' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}
?>