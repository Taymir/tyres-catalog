<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          diskModelsPage.php
**          LastMod: 17:40 19.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class diskModelsPage extends adminPage {
    var $urlName = 'dmodelslist';
    var $editForm = 'add_disk_model';
    var $csvImportForm = 'import_disk_models';
    var $validators = array (
        'image' => 'image',
        'manufacturer' => 'int',
        'model' => 'notnull',
        );
    var $filters = array (
        'manufacturer' => 'htmlsp',
        'model' => 'htmlsp',
        );
    
    function _initLists ($data = null) {
        $materials = array ('solid' => 'литой', 'forged' => 'кованный', 'pressed' => 'штампованный');
        if (!is_null ($data)) {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_manfrs (), $data['manufacturer']);
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.material', $materials, $data['material']);
            $this->tpl->parse ('main.' . $this->editForm . '.material');
        } else {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_manfrs ());
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.material', $materials);
            $this->tpl->parse ('main.' . $this->editForm . '.material');
        }
    }
    
    function _getDataById ($id) {
        return select_disk_models_byid ($id);
    }
    
    function _getAllData () {
        return select_disk_models (true);
    }
    
    function _addPageQuery ($data) {
        if ($this->_isFileUploaded ('image')) {
            $imagename = $this->_saveFile ('image');
            return @add_disk_models ($data['model'], $data['manufacturer'], $data['material'], $imagename);
        } else
            return @add_disk_models ($data['model'], $data['manufacturer'], $data['material']);
    }
    
    function _editPageQuery ($data) {
        if ($this->_isFileUploaded ('image')) {
            $imagename = $this->_saveFile ('image');
            return @edit_disk_models ($data['id'], $data['model'], $data['manufacturer'], $data['material'], $imagename);
        } else
            return @edit_disk_models ($data['id'], $data['model'], $data['manufacturer'], $data['material']);
    }
    
    function _delPageQuery ($id) {
        return delete_disk_models ($id);
    }
    
    function _csvParse () {
        return new csvDiskModels ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>