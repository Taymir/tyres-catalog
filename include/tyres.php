<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          tyres.php
**          LastMod: 17:17 24.02.2007
** *********************************/
require_once ('mysql.php');
require_once ('utils.php');
require_once ('paginator.php');

function select_tyres ($manfr = null, $width = null, $height = null, $radius = null, $season = null) {
    $fields = "manufacturers.name AS mnfrname, manufacturers.description AS mnfrdesc, models.*, tyres.*, models.model AS model";
    $sql = "SELECT %s 
    FROM `tyres`, `manufacturers`, `tyre_models` AS `models`
    WHERE tyres.model = models.id AND models.manufacturer = manufacturers.id";
    
    $sql .= replace_null ($manfr, " AND manufacturers.name = '$manfr'");
    $sql .= replace_null ($width, " AND tyres.width = '$width'");
    $sql .= replace_null ($height, " AND tyres.height = '$height'");
    $sql .= replace_null ($radius, " AND tyres.radius = '$radius'");
    $sql .= arr2ors ($season, 'models.season');
    
    $sql .= ' ORDER BY manufacturers.name ASC, models.model ASC, tyres.width DESC, tyres.height DESC, tyres.radius DESC';
    
    if (paginator_works ()) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    return db_query (sprintf ($sql, $fields));
}

function select_tyres_byid ($id) {
    $sql = "SELECT manufacturers.name AS mnfrname, manufacturers.description AS mnfrdesc, tyres.*, models.*, tyres.id AS id
    FROM `tyres`, `manufacturers`, `tyre_models` AS `models`
    WHERE tyres.model = models.id AND models.manufacturer = manufacturers.id AND tyres.id = '$id'";
    
    return db_query1 ($sql);
}

function add_tyre ($model, $width = null, $height = null, $radius = null, $load = null, $speed = null, $price = null) {
    $sql = "INSERT INTO `tyres` (`model`, `width` , `height` , `radius` , `load` , `speed` , `price` )
VALUES ('$model', '$width', '$height', '$radius', '$load', '$speed', '$price')";
    
    return db_qquery ($sql);
}

function add_tyre_csv ($model, $width = null, $height = null, $radius = null, $load = null, $speed = null, $price = null) {
    $sql = "INSERT INTO `tyres` (`model`, `width`, `height`, `radius`, `load`, `speed`, `price`) VALUES ((SELECT `id` FROM `tyre_models` WHERE `model` = '$model'), '$width', '$height', '$radius', '$load', '$speed', '$price') ON DUPLICATE KEY UPDATE `price` = '$price'";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function select_theights () {
    $sql = "SELECT DISTINCT(height) FROM `tyres` WHERE 1 ORDER BY height ASC";
    
    return db_arrquery ($sql);
}

function select_twidths () {
    $sql = "SELECT DISTINCT(width) FROM `tyres` WHERE 1 ORDER BY width ASC";
    
    return db_arrquery ($sql);
}

function select_tradiuses () {
    $sql = "SELECT DISTINCT(radius) FROM `tyres` WHERE 1 ORDER BY radius ASC";
    
    return db_arrquery ($sql);
}

function delete_tyre ($id) {
    $sql = "DELETE FROM `tyres` WHERE `id` = $id LIMIT 1";
    
    return db_qquery ($sql);
}

function edit_tyre ($id, $model, $width = null, $height = null, $radius = null, $load = null, $speed = null, $price = null) {
    $sql = "UPDATE `tyres` SET `model` = '$model', `width` = '$width', `height` = '$height', `radius` = '$radius', `load` = '$load', `speed` = '$speed', `price` = '$price' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function select_tyre_models ($full = false) {
    $fields = "tyre_models.model, tyre_models.id, manufacturers.name AS manufacturer, tyre_models.description, tyre_models.season, tyre_models.image";
    $sql = "SELECT %s 
    FROM `tyre_models`, `manufacturers` 
    WHERE tyre_models.manufacturer = manufacturers.id 
    ORDER BY tyre_models.model";
    
    if (paginator_works () && $full) {
        paginator_setTotal (db_result(sprintf ($sql, 'COUNT(*)')));
        $sql .= paginator_getSql ();
    }
    
    if ($full)
        return db_query (sprintf ($sql, $fields));
    return db_arrquery (sprintf ($sql, $fields), 'id');
}

function select_tyre_models_byid ($id) {
    $sql = "SELECT tyre_models.model, manufacturers.name AS manufacturer, tyre_models.description, tyre_models.season, tyre_models.image, tyre_models.id
    FROM `tyre_models`, `manufacturers` 
    WHERE tyre_models.manufacturer = manufacturers.id AND tyre_models.id = '$id'";
    
    return db_query1 ($sql);
}

function add_tyre_models ($model, $manufacturer, $description = null, $season = null, $image = null) {
    if (is_null ($image))
        $sql = "INSERT INTO `tyre_models` (`model`, `manufacturer`, `description`, `season`)
VALUES ('$model', '$manufacturer', '$description', '$season')";
    else
        $sql = "INSERT INTO `tyre_models` (`model`, `manufacturer`, `description`, `season`, `image`)
VALUES ('$model', '$manufacturer', '$description', '$season', '$image')";
    
    return db_qquery ($sql);
}

function add_tyre_models_csv ($model, $manufacturer, $description = null, $season = null) {
    $sql = "INSERT INTO `tyre_models` (`model`, `manufacturer`, `description`, `season`) VALUES ('$model', (SELECT `id` FROM `manufacturers` WHERE `name` = '$manufacturer'), '$description', '$season') ON DUPLICATE KEY UPDATE `description` = '$description', `season` = '$season'";
    
    db_qquery ($sql);
    return mysql_affected_rows ();
}

function edit_tyre_models ($id, $model, $manufacturer, $description = null, $season = null, $image = null) {
    if (is_null ($image))
        $sql = "UPDATE `tyre_models` SET `model` = '$model', `manufacturer` = '$manufacturer', `description` = '$description', `season` = '$season' WHERE `id` = '$id' LIMIT 1";
    else
        $sql = "UPDATE `tyre_models` SET `model` = '$model', `manufacturer` = '$manufacturer', `description` = '$description', `season` = '$season', `image` = '$image' WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}

function delete_tyre_models ($id) {
    $sql = "DELETE FROM `tyre_models` WHERE `id` = '$id' LIMIT 1";
    
    return db_qquery ($sql);
}
?>