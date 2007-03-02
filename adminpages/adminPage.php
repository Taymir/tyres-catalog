<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          adminPage.php
**          LastMod: 23:57 02.03.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'include/tyres.php';
require_once 'include/disks.php';
require_once 'include/manfr.php';
require_once 'include/utils.php';
require_once 'include/buttons.php';
require_once 'include/validators.php';
require_once 'include/csvParser.php';

class adminPage {
    var $tpl;
    var $urlName = 'none';
    var $editForm = 'none';
    var $csvImportForm = 'none';
    var $validators = array ();
    var $filters = array ();
    
    function adminPage (&$tpl) {
        $GLOBALS['urlname'] = $this->urlName;
        $this->tpl = &$tpl;
    }
    
    function listPage () {
        tableout ($this->_getAllData (), $this->tpl, '?' . $this->urlName);
        $this->_insListButtons ();
    }
    
    function addPage () {
        //values are either empty or taken from POST array
        if ($this->isSubmited ()) {
            if ($this->validate ()) 
                $this->prc_addPage ();
            else
                $this->_editForm (&$_POST);
        } else {
            $this->_editForm ();
        }
    }
    function prc_addPage () {
        if ($this->_addPageQuery (&$_POST))
            showMsg ($this->tpl, 'Запись добавлена', 'Введенные вами данные добавленны в БД.');
        else
            showError ($this->tpl, 'Произошла ошибка при попытке добавления записи в БД.');
    }
    
    function _addPageQuery ($data) {
        //virtual
    }
    
    function editPage () {
        //values are taken either from db or from the POST array
        if ($this->isSubmited ()) {
            if ($this->validate ()) 
                $this->prc_editPage ();
            else
                $this->_editForm (&$_POST);
        } else {
            if (isset($_GET['id'])) 
                $this->_editForm ($this->_getDataById(sprintf('%d', $_GET['id'])), true);
            else
                showError ($this->tpl, 'В строке адреса не указан идентификатор записи.');
        }
    }
    function prc_editPage () {
        if ($this->_editPageQuery (&$_POST))
            showMsg ($this->tpl, 'Запись обновлена', 'Ваши данные были успешно сохранены в БД.'); 
        else
            showError ($this->tpl, 'Произошла ошибка при попытке обновления записи в БД.');
    }
    
    function _editPageQuery ($data) {
        //virtual
    }
    
    function _filterData (&$data) {
        foreach ($this->filters as $key=>$filter)
            if (isset ($data[$key]))
                switch ($filter) {
                    case 'rusnum':
                        $data[$key] = str_replace (',', '.', $data[$key]);
                    break;
                    case 'htmlsp':
                        $data[$key] = htmlspecialchars ($data[$key], ENT_QUOTES);
                    break;
                }
    }
    
    function validate () {
        $this->_filterData ($_POST);
        foreach ($this->validators as $fieldname=>$validator) {
            switch ($validator) {
                case 'num':
                    if (!vld_num(@$_POST[$fieldname])) { $this->_setVldError($fieldname, 'Число'); return false; }
                    break;
                case 'int':
                    if (!vld_int(@$_POST[$fieldname])) { $this->_setVldError($fieldname, 'Целое число'); return false; }
                    break;
                case 'notnull':
                    if (!vld_notnull(@$_POST[$fieldname])) { $this->_setVldError($fieldname, 'Не пустое'); return false; }
                    break;
                case 'image':
                    if ($this->_isFileUploaded ($fieldname)) {
                        if (!in_array ($_FILES[$fieldname]['type'], $GLOBALS['imageTypes'])) {
                            $this->_setVldError($fieldname, 'Изображение должно быть в формате gif, png или jpeg.');
                            return false;
                        }
                        if ($_FILES[$fieldname]['size'] > $GLOBALS['imageSize']) {
                            $this->_setVldError($fieldname, 'Изображение слишком большое');
                            return false;
                        }
                    } /*else {
                        $this->_setVldError($fieldname, 'Произошла ошибка загрузки файла');
                        return false;
                    }*/
                    break;
            }
        }
        return true;
    }
    
    var $vldField = '';
    var $vldMsg = '';
    
    function _setVldError ($fieldname, $msg) {
        $this->vldField = $fieldname;
        $this->vldMsg = $msg;
    }
    
    function _isVldError () {
        if (empty($this->vldField)) return false;
        return true;
    }
    
    function _parseVldMsg () {
        $this->tpl->assign ('vldmsg', "Значение поля {$this->vldField} не верно. Значение поля должно соответствовать условию: {$this->vldMsg}.");
        $this->tpl->parse ('main.' . $this->editForm . '.validator');
    }
    
    function isSubmited () {
            if (count($_POST) > 0) return true;
        return false;
    }
    
    function _getDataById ($id) {
        //virtual
    }
    
    function _getAllData () {
        //virtual
    }
    
    function _editForm ($data = null, $editMode = false) {
        $this->tpl->assign_file ('resultset', 'templates/' . $this->editForm . '.tpl');
        if ($editMode) $this->_editMode ($data['id']);
        
        $this->_initLists ($data);
        
        if ($this->_isVldError ())
            echo $this->_parseVldMsg ();
        
        $this->tpl->assign ('formurl', '');
        $this->_insEditButtons ();
        if (is_array ($data)) 
            foreach ($data as $key=>$value) 
                $this->tpl->assign ($key, $value);
        $this->tpl->parse ('main.' . $this->editForm);
    }
    
    function _initLists ($data = null) {
        //virtual
    }
    
    function delPage () {
        if ($this->isSubmited ())
            $this->prc_delPage ();
        else {
            if (isset($_GET['id'])) {
                $this->tpl->assign_file ('resultset', 'templates/del.tpl');
                $this->_editMode ($_GET['id']);
                $this->tpl->parse ('main.del');
                
                insert_button ($this->tpl, 'yes');
                insert_button ($this->tpl, 'no', $this->urlName);
            } else
                showError ($this->tpl, 'В строке адреса не указан идентификатор записи.');
        }
    }
    function prc_delPage () {
        if ($this->_delPageQuery ($_POST['id']))
            showMsg ($this->tpl, 'Запись удалена', 'Выбранная запись была удаленна из БД.');
        else
            showError ($this->tpl, 'Произошла ошибка при попытке удаления записи из БД.');
        
    }
    
    function _delPageQuery ($id) {
        //virtual
    }
    
    function _editMode ($id) {
        $this->tpl->assign ('id', $id);
        $this->tpl->parse ('main.edit');
    }
    
    function _insEditButtons () {
        insert_button ($this->tpl, 'back');
        insert_button ($this->tpl, 'submit');
        insert_button ($this->tpl, 'reset');
    }
    
    function _insListButtons () {
        insert_button ($this->tpl, 'back');
        insert_button ($this->tpl, 'add', $this->urlName);
        insert_button ($this->tpl, 'import', $this->urlName);
    }
    
    function _isFileUploaded ($filename) {
        if ($_FILES[$filename]['error'] == UPLOAD_ERR_OK)
            return true;
        return false;
    }
    
    function _saveFile ($filename) {
        global $uploadDir, $imageTypes, $imageSize;
        
        if (file_exists ($uploadDir . $_FILES[$filename]['name'])) {
            if (filesize ($uploadDir . $_FILES[$filename]['name']) == $uploadDir . $_FILES[$filename]['size'])
                return $_FILES[$filename]['name'];
            else {
                $tmpstr = 0;
                while (file_exists ($uploadDir . $tmpstr . $_FILES[$filename]['name'])) $tmpstr++;
                $name = $tmpstr . $_FILES[$filename]['name'];
                move_uploaded_file ($_FILES[$filename]['tmp_name'], $uploadDir . $name);
            }
        } else {
            $name = $_FILES[$filename]['name'];
            move_uploaded_file ($_FILES[$filename]['tmp_name'], $uploadDir . $name);
        }
        
        $this->_genThumbnail ($name);
        return $name;
    }
    
    function _genThumbnail ($filename) {
        global $uploadDir, $tmbDir,$tmbHeight , $tmbWidth, $tmbQuality;
        
        $fullname = $uploadDir . $filename;
        
        $properties = getimagesize ($fullname);
        $size = filesize ($fullname);
        switch($properties[2]){
            case IMAGETYPE_JPEG:
                $image = imagecreatefromJPEG($fullname);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromGIF($fullname);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefromPNG($fullname);
                break;
        }
        $srcH = $properties[1];
        $srcW = $properties[0];
        if ($srcH > $tmbHeight || $srcW > $tmbWidth) {
            $reductionH = $srcH / $tmbHeight;
            $reductionW = $srcW / $tmbWidth;
            $reduction = ($reductionH > $reductionW? $reductionH : $reductionW);
            $desW = $srcW / $reduction;
            $desH = $srcH / $reduction;
            $thumb = imagecreatetruecolor($desW, $desH);
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $desW, $desH, $srcW, $srcH);
            imagedestroy($image);
            $image = $thumb;
        }
        imagejpeg ($image, $tmbDir . $filename, $tmbQuality);
    }
    
    function importPage () {
        if ($this->isSubmited ()) {
            if (isset ($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {//проверка успешности загрузки файла
                $this->prc_importPage ();
            } else {
                showError ($this->tpl, 'Произошла ошибка при загрузке файла.');
            }
        } else {
            $this->_showImportForm ();
        }
    }
    
    function prc_importPage () {
        $csv = $this->_csvParse ();
        $this->tpl->assign_file ('resultset', 'templates/import-report.tpl');
        $this->tpl->assign ('added', count ($csv->added));
        $this->tpl->assign ('replaced', count ($csv->replaced));
        $this->tpl->assign ('errors', count ($csv->errors));
        
        foreach ($csv->added as $item) {
            $this->tpl->assign ('itemvalue', $item);
            $this->tpl->parse ('main.report.ins_row');
        }
        foreach ($csv->replaced as $item) {
            $this->tpl->assign ('itemvalue', $item);
            $this->tpl->parse ('main.report.upd_row');
        }
        foreach ($csv->errors as $item) {
            $this->tpl->assign ('itemvalue', $item);
            $this->tpl->parse ('main.report.err_row');
        }
        $this->tpl->parse ('main.report');
    }
    
    function _csvParse () {
        //virtual
    }
    
    function _showImportForm () {
        $this->tpl->assign_file ('resultset', 'templates/' . $this->csvImportForm . '.tpl');
        $this->tpl->parse ('main.' . $this->csvImportForm);
        $this->_insEditButtons ();
    }
}
?>