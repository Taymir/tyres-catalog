<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          csvParser.php
**          LastMod: 23:57 02.03.2007
** *********************************/
require_once 'mysql.php';
require_once 'validators.php';
require_once 'disks.php';
require_once 'tyres.php';
require_once 'manfr.php';
require_once 'xtemplate.class.php';
require_once 'utils.php';


class csvParser {
    var $fields = array (); //fieldname => number
    var $validators = array ();
    var $filters = array ();
    var $headers = array ();
    var $hasHeader = 'autodetect'; //'yes' | 'no' | 'autodetect'
    var $data = array ();
    var $tpl;
    
    
    function csvParser ($filename, &$tpl, $hasHeader = 'autodetect') {
        $this->hasHeader = $hasHeader;
        if (!file_exists ($filename)) {
            showError ($tpl, 'Загруженный файл не найден');
            return null;
        }
        $fp = fopen ($filename, 'r');
        while (($data = fgetcsv($fp, 4000, ";")) !== FALSE) {
            $this->data[] = $data;
        }
        fclose($fp);
        if (count ($this->fields) != count ($this->data[0])){
            showError ($tpl, 'Количество полей csv-файла не сходится с форматом.');
            return null;
        }
        
        $this->_checkHeadAndValidate ();
    }
    
    function _checkHeadAndValidate () {
        $rowNum = 0;
        if ($this->hasHeader == 'autodetect') {
            if (!$this->validateRow ($this->data[0], 0) OR $this->data[0] == $this->headers) {
                unset ($this->data[0]);
                $this->_clearVldErrors ();
                $rowNum = 1;
            }
        } elseif ($this->hasHeader == 'yes') {
            unset ($this->data[0]);
            $this->_clearVldErrors ();
            $rowNum = 1;
        }
        
        $this->validate ($rowNum);
        $this->saveData ($rowNum);
    }
    
    function _filterData (&$data) {
        foreach ($this->filters as $key=>$filter) {
            if (isset ($data[$this->fields[$key]])) {
                switch ($filter) {
                    case 'rusnum':
                        $data[$this->fields[$key]] = str_replace (',', '.', $data[$this->fields[$key]]);
                    break;
                    case 'htmlsp':
                        $data[$this->fields[$key]] = htmlspecialchars ($data[$this->fields[$key]], ENT_QUOTES);
                    break;
                }
            }
        }
    }
    
    function validateRow (&$row, $num) {
        $this->_filterData ($row);
        
        foreach ($this->validators as $fieldname=>$validator) {
            @$field = &$row[$this->fields[$fieldname]];
            switch ($validator) {
                case 'num':
                    if (!vld_num($field)) { $this->_addVldError($fieldname, 'Число', $num); return false; }
                    break;
                case 'int':
                    if (!vld_int($field)) { $this->_addVldError($fieldname, 'Целое число', $num); return false; }
                    break;
                case 'notnull':
                    if (!vld_notnull($field)) { $this->_addVldError($fieldname, 'Не пустое', $num); return false; }
                    break;
                case 'material':
                    if (!vld_material($field)) { $this->_addVldError($fieldname, 'Материал [solid|pressed|forged]', $num); return false; }
                    break;
                case 'season':
                    if (!vld_season($field)) { $this->_addVldError($fieldname, 'Сезон [summer|winter|spiked]', $num); return false; }
                    break;
            }
        }
        return true;
    }
    
    function _getNamesFromId () {
        //virtual
    }
    
    function validate ($startRow = 0) {
        $max = count ($this->data) + $startRow;
        for ($i = $startRow; $i < $max; $i++) {
            if (!$this->validateRow ($this->data[$i], $i))
                unset ($this->data[$i]);
        }
    }
    
    var $errors = array ();
    
    function _addVldError ($fieldname, $msg, $num) {
        $this->errors[] = "Ошибка в строке #$num, поле: $fieldname. Значение поля должно соответствовать условию: $msg.";
    }
    
    function _numVldErrors () {
        return count ($this->errors);
    }
    
    function _clearVldErrors () {
        $this->errors = array ();
    }
    
    function saveData ($startRow = 0) {
        $max = count ($this->data) + $startRow;
        for ($i = $startRow; $i < $max; $i++) {
            if (!isset ($this->data[$i])) continue;
            $res = $this->_insertData ($this->data[$i]);
            if ($res < 1)
                $this->logError ($i, mysql_error ());
            elseif ($res == 1)
                $this->logAdded ($i);
            else
                $this->logReplaced ($i);
        }
    }
    
    function _insertData ($row) {
        //virtual
    }
    
        var $added = array ();
        var $replaced = array ();
    
    function logAdded ($rowNum) {
        $this->added[] = "Добавлена запись #$rowNum.";
    }
    
    function logReplaced ($rowNum) {
        $this->replaced[] = "Запись #$rowNum обновлена.";
    }
    
    function logError ($rowNum, $error) {
        $this->errors[] = "Ошибка при обработке базой данных в строке: #$rowNum. $error";
    }
};

class csvTyres extends csvParser {
    var $fields = array ('model' => 0, 'width' => 1, 'height' => 2, 'radius' => 3, 'load' => 4, 'speed' => 5, 'price' => 6);
    var $validators = array (
        'model' => 'notnull',
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
    
    function _insertData ($row) {
        return add_tyre_csv ($row[$this->fields['model']], $row[$this->fields['width']], $row[$this->fields['height']], $row[$this->fields['radius']], $row[$this->fields['load']], $row[$this->fields['speed']], $row[$this->fields['price']]);
    }
};

class csvDisks extends csvParser {
    var $fields = array ('model' => 0, 'width' => 1, 'radius' => 2, 'holes' => 3, 'distance' => 4, 'e' => 5, 'diameter' => 6, 'price' => 7);
    var $validators = array (
        'model' => 'notnull',
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
        
    
    function _insertData ($row) {
        return add_disk_csv ($row[$this->fields['model']], $row[$this->fields['width']], $row[$this->fields['radius']], $row[$this->fields['holes']], $row[$this->fields['distance']], $row[$this->fields['e']], $row[$this->fields['diameter']], $row[$this->fields['price']]);
    }
};

class csvTyreModels extends csvParser {
    var $fields = array ('manufacturer' => 0, 'model' => 1, 'description' => 2, 'season' => 3);
    var $validators = array (
        'manufacturer' => 'notnull',
        'model' => 'notnull',
        'season' => 'season',
        );
    var $filters = array (
        'manufacturer' => 'htmlsp',
        'model' => 'htmlsp',
        'description' => 'htmlsp',
        );
    
    function _insertData ($row) {
        return add_tyre_models_csv ($row[$this->fields['model']], $row[$this->fields['manufacturer']], $row[$this->fields['description']], $row[$this->fields['season']]);
    }
};

class csvDiskModels extends csvParser {
    var $fields = array ('model' => 0, 'manufacturer' => 1, 'material' => 2);
    var $validators = array (
        'manufacturer' => 'notnull',
        'model' => 'notnull',
        'material' => 'material',
        );
    var $filters = array (
        'manufacturer' => 'htmlsp',
        'model' => 'htmlsp',
        );
    
    function _insertData ($row) {
        return add_disk_models_csv ($row[$this->fields['model']], $row[$this->fields['manufacturer']], $row[$this->fields['material']]);
    }
};

class csvManfrs extends csvParser {
    var $fields = array ('name' => 0, 'description' => 1);
    var $headers = array ('Производитель', 'Описание');
    var $validators = array (
        'name' => 'notnull',
        );
    var $filters = array (
        'name' => 'htmlsp',
        'description' => 'htmlsp',
        );
    
    function _insertData ($row) {
        return add_manfr_csv ($row[$this->fields['name']], $row[$this->fields['description']]);
    }
};
?>