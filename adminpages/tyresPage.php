<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          tyresPage.php
**          LastMod: 23:00 23.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class tyresPage extends adminPage {
    var $urlName = 'tyreslist';
    var $editForm = 'add_tyre';
    var $csvImportForm = 'import_tyres';
    var $validators = array (
        'model' => 'int',
        'width' => 'int',
        'height' => 'int',
        'radius' => 'num',
        'load' => 'int',
        'speed' => 'notnull',
        'price' => 'num',
        );
    var $filters = array (
        'model' => 'htmlsp',
        'width' => 'htmlsp',
        'height' => 'htmlsp',
        'radius' => 'rusnum',
        'load' => 'htmlsp',
        'speed' => 'htmlsp',
        'price' => 'rusnum',
        );
    
    function _initLists ($data = null) {
        if (!is_null ($data))
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_tyre_models (), $data['model']);
        else
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_tyre_models ());
    }
    
    function _getDataById ($id) {
        return select_tyres_byid ($id);
    }
    
    function _getAllData () {
        return select_tyres ();
    }
    
    function _addPageQuery ($data) {
        return @add_tyre ($data['model'], $data['width'], $data['height'], $data['radius'], $data['load'], $data['speed'], $data['price']);
    }
    
    function _editPageQuery ($data) {
        return @edit_tyre ($data['id'], $data['model'], $data['width'], $data['height'], $data['radius'], $data['load'], $data['speed'], $data['price']);
    }
    
    function _delPageQuery ($id) {
        return delete_tyre ($id);
    }
    
    function _csvParse () {
        return new csvTyres ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>