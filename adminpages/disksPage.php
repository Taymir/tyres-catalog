<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          disksPage.php
**          LastMod: 23:00 23.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class disksPage extends adminPage {
    var $urlName = 'diskslist';
    var $editForm = 'add_disk';
    var $csvImportForm = 'import_disks';
    var $validators = array (
        'model' => 'int',
        'width' => 'num',
        'radius' => 'num',
        'holes' => 'int',
        'distance' => 'num',
        'e' => 'num',
        'diameter' => 'num',
        'price' => 'num',
        );
    var $filters = array (
        'model' => 'htmlsp',
        'width' => 'rusnum',
        'radius' => 'rusnum',
        'holes' => 'htmlsp',
        'distance' => 'rusnum',
        'e' => 'rusnum',
        'diameter' => 'rusnum',
        'price' => 'rusnum',
        );
        
    function _initLists ($data = null) {
        if (!is_null ($data))
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_disk_models (), $data['model']);
        else
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_disk_models ());
    }
    
    function _getDataById ($id) {
        return select_disks_byid ($id);
    }
    
    function _getAllData () {
        return select_disks ();
    }
    
    function _addPageQuery ($data) {
        return @add_disk ($data['model'], $data['width'], $data['radius'], $data['holes'], $data['distance'], $data['e'], $data['diameter'], $data['price']);
    }
    
    function _editPageQuery ($data) {
        return @edit_disk ($data['id'], $data['model'], $data['width'], $data['radius'], $data['holes'], $data['distance'], $data['e'], $data['diameter'], $data['price']);
    }
    
    function _delPageQuery ($id) {
        return delete_disk ($id);
    }
    
    function _csvParse () {
        return new csvDisks ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>