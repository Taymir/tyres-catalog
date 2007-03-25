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

function add_manfr ($name, $description, $type) {
    $sql = "INSERT INTO `manufacturers` (`name`, `description`, `type`) VALUES ('$name', '$description', '$type')";
    
    return db_qquery ($sql);
    //db_id ();
}

function add_manfr_csv ($name, $description, $type) {
    $sql = "INSERT INTO `manufacturers` (`name`, `description`, `type`) VALUES ('$name', '$description', '$type')";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function select_manfrs ($full = false, $type = null) {
    $fields = "name, id, type, description";
    $sql = "SELECT %s FROM `manufacturers` ";
    
    if (!is_null ($type))
        $sql .= "WHERE `type` = '$type' OR `type` = 'both'";
    
    $sql .= "ORDER BY name ASC";
    
    if (paginator_works () && $full) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    if ($full)
        return db_query (sprintf ($sql, $fields));
    return db_arrquery (sprintf ($sql, $fields), 'id');
}

function select_manfrs_byid ($id) {
    $sql = "SELECT name, description, type, id FROM `manufacturers` WHERE id = '$id'";
    
    return db_query1 ($sql);
}

function delete_manfr ($id) {
    $sql = "DELETE FROM `manufacturers` WHERE id = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function edit_manfr ($id, $name, $description = null, $type = null) {
    $sql = "UPDATE `manufacturers` SET `name` = '$name', `description` = '$description', `type` = '$type' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}
?>