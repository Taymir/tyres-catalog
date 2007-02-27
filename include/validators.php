<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          validators.php
**          LastMod: 17:40 19.02.2007
** *********************************/
function vld_notnull ($value) {
    if (strlen(trim($value)) == 0)
        return false;
    return true;
}

function vld_num ($value) {
    //����� �� ����� ���� ������ �������
    if (!vld_notnull ($value)) return false;
    
    //�������� �� ������ ?
    if (!is_numeric ($value))
        return false;
    return true;
}

function is_whole_number($var){
    return (is_numeric($var)&&(intval($var)==floatval($var)));
}

function vld_int ($value, $min = null, $max = null) {
    //�������� �� ����� ?
    if (!is_whole_number ($value))
        return false;
    
    //�������� �� �� �����?
    if ($max !== null && $min !== null) {
        if (strlen ($value) > $min && strlen ($value) < $max)
            return true;
    } elseif ($max === null && $min !== null) {
        if (strlen ($value) == $min)
            return true;
    } else {
        return true;
    }
    return false;
}

function vld_season ($value) {
    switch ($value) {
        case 'summer':
        case 'winter':
        case 'spiked':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function vld_material ($value) {
    switch ($value) {
        case 'solid':
        case 'forged':
        case 'pressed':
            return true;
        break;
        default:
            return false;
        break;
    }
}

/*
function validate ($tpl, $fields) {
    $result = true;
    foreach ($fields as $fieldname=>$validator) {
        switch ($validator) {
            case 'num':
                if (!vld_num(@$_POST[$fieldname])) { _invalid_value($tpl, $fieldname, '�����'); $result = false; }
                break;
            case 'int':
                if (!vld_int(@$_POST[$fieldname])) { _invalid_value($tpl, $fieldname, '����� �����'); $result = false; }
                break;
            case 'notnull':
                if (!vld_notnull(@$_POST[$fieldname])) { _invalid_value($tpl, $fieldname, '�� ������'); $result = false; }
                break;
        }
    }
    return $result;
}

function _invalid_value ($tpl, $fieldname, $text) {
    $tpl->assign ('vldmsg', "�������� ���� $fieldname �� �����. �������� ���� ������ ��������������� �������: $text.");
    $tpl->parse ('main.add_tyre.validator');
}
*/

?>