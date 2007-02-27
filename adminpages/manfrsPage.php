<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          manfrsPage.php
**          LastMod: 17:40 19.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class manfrsPage extends adminPage {
    var $urlName = 'manfrlist';
    var $editForm = 'add_manufacturer';
    var $csvImportForm = 'import_manfrs';
    var $validators = array (
        'name' => 'notnull',
        );
    var $filters = array (
        'name' => 'htmlsp',
        'description' => 'htmlsp',
        );
    
    function _initLists ($data = null) {
        return; //empty
    }
    
    function _getDataById ($id) {
        return select_manfrs_byid ($id);
    }
    
    function _getAllData () {
        return select_manfrs (true);
    }
    
    function _addPageQuery ($data) {
        return @add_manfr ($data['name'], $data['description']);
    }
    
    function _editPageQuery ($data) {
        return @edit_manfr ($data['id'], $data['name'], $data['description']);
    }
    
    function _delPageQuery ($id) {
        return delete_manfr ($id);
    }
    
    function _csvParse () {
        return new csvManfrs ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>