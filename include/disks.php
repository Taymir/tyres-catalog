<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          disks.php
**          LastMod: 16:16 16.03.2007
** *********************************/
require_once 'mysql.php';
require_once 'utils.php';

function select_disks ($manfr = null, $holes = null, $distance = null, $radius = null, $material = null) {
    $fields = "manufacturers.name AS mnfrname, manufacturers.description AS mnfrdesc, models.*, disks.*, models.model AS model";
    $sql = "SELECT %s 
    FROM `manufacturers`, `disks`, `disk_models` AS `models`
    WHERE disks.model = models.id AND models.manufacturer = manufacturers.id";
    
    $sql .= replace_null ($manfr, " AND manufacturers.name = '$manfr'");
    $sql .= replace_null ($holes, " AND disks.holes = '$holes'");
    $sql .= replace_null ($distance, " AND disks.distance = '$distance'");
    $sql .= replace_null ($radius, " AND disks.radius = '$radius'");
    $sql .= arr2ors ($material, 'models.material');
    
    $sql .= ' ORDER BY manufacturers.name, models.model, disks.holes, disks.distance, disks.radius';
    
    if (paginator_works ()) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    return db_query (sprintf ($sql, $fields));
}

function select_disks_byid ($id) {
    $sql = "SELECT manufacturers.name AS mnfrname, manufacturers.description AS mnfrdesc, disks.*, models.*, disks.id AS id
    FROM `manufacturers`, `disks`, `disk_models` AS `models`
    WHERE disks.model = models.id AND models.manufacturer = manufacturers.id AND disks.id = '$id'";
    
    return db_query1 ($sql);
}

function add_disk ($model, $width = null, $radius = null, $holes = null, $distance = null, $e = null, $diameter = null, $price = null) {
    $sql = "INSERT INTO `disks` (`model`, `width`, `radius`, `holes`, `distance`, `e`, `diameter`, `price`)
VALUES ('$model', '$width', '$radius', '$holes', '$distance', '$e', '$diameter', '$price')";
    
    return db_qquery ($sql);
}

function add_disk_csv ($model, $width = null, $radius = null, $holes = null, $distance = null, $e = null, $diameter = null, $price = null) {
    $sql = "INSERT INTO `disks` (`model`, `width`, `radius`, `holes`, `distance`, `e`, `diameter`, `price`) VALUES ((SELECT `id` FROM `disk_models` WHERE `model` = '$model'), '$width', '$radius', '$holes', '$distance', '$e', '$diameter','$price') ON DUPLICATE KEY UPDATE `price` = '$price'";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function select_dholes () {
    $sql = "SELECT DISTINCT(holes) FROM `disks` WHERE 1 ORDER BY holes ASC";
    
    return db_arrquery ($sql);
}

function select_ddistances () {
    $sql = "SELECT DISTINCT(distance) FROM `disks` WHERE 1 ORDER BY distance ASC";
    
    return db_arrquery ($sql);
}

function select_dradiuses () {
    $sql = "SELECT DISTINCT(radius) FROM `disks` WHERE 1 ORDER BY radius ASC";
    
    return db_arrquery ($sql);
}

function delete_disk ($id) {
    $sql = "DELETE FROM `disks` WHERE id = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function edit_disk ($id, $model, $width = null, $radius = null, $holes = null, $distance = null, $e = null, $diameter = null, $price = null) {
    $sql = "UPDATE `disks` SET `model` = '$model', `width` = '$width', `radius` = '$radius', `holes` = '$holes', `distance` = '$distance', `e` = '$e', `diameter` = '$diameter', `price` = '$price' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function select_disk_models ($full = false) {
    $fields = "disk_models.model, disk_models.id, manufacturers.name AS manufacturer, disk_models.material, disk_models.image";
    $sql = "SELECT %s 
    FROM `disk_models`, `manufacturers` 
    WHERE disk_models.manufacturer = manufacturers.id 
    ORDER BY disk_models.model";
    
    if (paginator_works () && $full) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    if ($full)
        return db_query (sprintf ($sql, $fields));
    return db_arrquery (sprintf ($sql, $fields), 'id');
}

function select_disk_models_byid ($id) {
    $sql = "SELECT disk_models.model, manufacturers.name AS manufacturer, disk_models.material, disk_models.image, disk_models.id
    FROM `disk_models`, `manufacturers` 
    WHERE disk_models.manufacturer = manufacturers.id  AND disk_models.id = '$id'";
    
    return db_query1 ($sql);
}

function add_disk_models ($model, $manufacturer, $material = null, $image = null) {
    if (is_null ($image))
        $sql = "INSERT INTO `disk_models` (`model`, `manufacturer`, `material`)
VALUES ('$model', '$manufacturer', '$material')";
    else
        $sql = "INSERT INTO `disk_models` (`model`, `manufacturer`, `material`, `image`)
VALUES ('$model', '$manufacturer', '$material', '$image')";
    
    return db_qquery ($sql);
}

function add_disk_models_csv ($model, $manufacturer, $material = null) {
    $sql = "INSERT INTO `disk_models` (`model`, `manufacturer`, `material`) VALUES ('$model', (SELECT `id` FROM `manufacturers` WHERE `name` = '$manufacturer'), '$material') ON DUPLICATE KEY UPDATE `material` = '$material'";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function edit_disk_models ($id, $model, $manufacturer, $material = null, $image = null) {
    if (is_null ($image))
        $sql = "UPDATE `disk_models` SET `model` = '$model', `manufacturer` = '$manufacturer', `material` = '$material' WHERE `id` = '$id' LIMIT 1";
    else
        $sql = "UPDATE `disk_models` SET `model` = '$model', `manufacturer` = '$manufacturer', `material` = '$material', `image` = '$image' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function delete_disk_models ($id) {
    $sql = "DELETE FROM `disk_models` WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}
?>