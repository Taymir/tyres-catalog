<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          manfrsPage.php
**          LastMod: 16:20 16.03.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class manfrsPage extends adminPage {
    var $urlName = 'manfrlist';
    var $editForm = 'add_manufacturer';
    var $csvImportForm = 'import_manfrs';
    var $validators = array (
        'name' => 'notnull',
        // @TODO: 'types' => 'types', валидатор не зарегистрирован!
        );
    var $filters = array (
        'name' => 'htmlsp',
        'description' => 'htmlsp',
        );
    
    function _initLists ($data = null) {
        $type = array ('tyres' => 'Производитель шин', 'disks' => 'Производитель дисков', 'both' => 'Производитель шин и дисков');
        if (!is_null ($data)) {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.type', $type, $data['type']);
            $this->tpl->parse ('main.' . $this->editForm . '.type');
        } else {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.type', $type);
            $this->tpl->parse ('main.' . $this->editForm . '.type');
        }
    }
    
    function _getDataById ($id) {
        return select_manfrs_byid ($id);
    }
    
    function _getAllData () {
        return select_manfrs (true);
    }
    
    function _addPageQuery ($data) {
        return @add_manfr ($data['name'], $data['description'], $data['type']);
    }
    
    function _editPageQuery ($data) {
        return @edit_manfr ($data['id'], $data['name'], $data['description'], $data['type']);
    }
    
    function _delPageQuery ($id) {
        return delete_manfr ($id);
    }
    
    function _csvParse () {
        return new csvManfrs ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>