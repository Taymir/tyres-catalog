<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          tyreModelsPage.php
**          LastMod: 17:40 19.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'adminPage.php';

class tyreModelsPage extends adminPage {
    var $urlName = 'tmodelslist';
    var $editForm = 'add_tyre_model';
    var $csvImportForm = 'import_tyre_models';
    var $validators = array (
        'image' => 'image',
        'manufacturer' => 'int',
        'model' => 'notnull',
        'description' => 'notnull',
        );
    var $filters = array (
        'manufacturer' => 'htmlsp',
        'model' => 'htmlsp',
        'description' => 'htmlsp',
        );
    
    function _initLists ($data = null) {
        $seasons = array ('summer' => 'летн€€', 'winter' => 'зимн€€', 'spiked' => 'шипованна€');
        if (!is_null ($data)) {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_manfrs (), $data['manufacturer']);
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.season', $seasons, $data['season']);
            $this->tpl->parse ('main.' . $this->editForm . '.season');
        } else {
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm, select_manfrs ());
            fill_tpl_list ($this->tpl, 'main.' . $this->editForm . '.season', $seasons);
            $this->tpl->parse ('main.' . $this->editForm . '.season');
        }
    }
    
    function _getDataById ($id) {
        return select_tyre_models_byid ($id);
    }
    
    function _getAllData () {
        return select_tyre_models (true);
    }
    
    function _addPageQuery ($data) {
        if ($this->_isFileUploaded ('image')) {
            $imagename = $this->_saveFile ('image');
            return @add_tyre_models ($data['model'], $data['manufacturer'], $data['description'], $data['season'], $imagename);
        } else
            return @add_tyre_models ($data['model'], $data['manufacturer'], $data['description'], $data['season']);
    }
    
    function _editPageQuery ($data) {
        if ($this->_isFileUploaded ('image')) {
            $imagename = $this->_saveFile ('image');
            return @edit_tyre_models ($data['id'], $data['model'], $data['manufacturer'], $data['description'], $data['season'], $imagename);
        } else
            return @edit_tyre_models ($data['id'], $data['model'], $data['manufacturer'], $data['description'], $data['season']);
    }
    
    function _delPageQuery ($id) {
        return delete_tyre_models ($id);
    }
    
    function _csvParse () {
        return new csvTyreModels ($_FILES['file']['tmp_name'], $this->tpl);
    }
}
?>