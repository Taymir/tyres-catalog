<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          utils.php
**          LastMod: 19:30 22.03.2007
** *********************************/
require_once 'buttons.php';

function replace_null ($var, $replacement) {
    if (is_null ($var)) return '';
    else return $replacement;
}

function replace_bool ($var, $true, $false) {
    if ($var === true) return $true;
    else return $false;
}

function arr2ors ($arr, $enum_param) {
    if (is_array($arr) && count($arr) > 0) {
        $str = " AND (";
        foreach ($arr as $key=>$value)
            if ($value === true)
                $str .= "($enum_param = '$key') OR";
        if (substr($str, -3) == ' OR') $str = substr_replace ($str, '', -3);
        $str .= ")";
        return $str;
    } elseif (is_string($arr)) {
        return " AND $enum_param = '$arr'";
    } else
        return '';
}

function if_in_arr ($value, $array, $else_value = null) {
    if (in_array($value, $array)) return $value;
    return $else_value;
}

function fill_lists ($name, $arr) {
    $value = (isset($_REQUEST[$name])? $_REQUEST[$name] : null);
    $str = "<SELECT NAME=\"$name\">\n";
    $str .= "<OPTION value=\"All\">Все</OPTION>\n";
    foreach ($arr as $key=>$data) {
        if ($value === $data)
            $str .= "<OPTION SELECTED>$data</OPTION>\n";
        else
            $str .= "<OPTION>$data</OPTION>\n";
    }
    $str .= "</SELECT>\n";
    return $str;
}

function fill_tpl_list (&$tpl, $block, $arr, $value = null) {
    foreach ($arr as $key=>$data) {
        $tpl->assign ('id', $key);
        $tpl->assign ('value', $data);
        if ($value === $data || $value === $key)
            $tpl->parse ($block.'.option.chosen');
        $tpl->parse ($block.'.option');;
    }
}

function check2arr ($arr) {
    $ret = array ();
    foreach ($arr as $val)
        if (isset ($_REQUEST[$val]))
            $ret[$val] = true;
        /*else
            $ret[$val] = false;*/
    if (count($ret) == 0) $ret = null;
    return $ret;
}

function parseChecks (&$tpl, $block, $checks) {
    $count = 0;
    foreach ($checks as $check) {
        if (isset ($_REQUEST [$check])) {
            $tpl->parse ($block . '.check_' . $check);
            $count++;
        }
    }
    
    if ($count == 0) {
        foreach ($checks as $check) {
            $tpl->parse ($block . '.check_' . $check);
        }
    }
}

function tableout ($result, &$tpl, $url) {
    global $buttons;
    $tpl->assign_file ('resultset', 'templates/tableout.tpl');
    
    if (is_array ($result) && isset ($result[0])) {
        foreach (array_keys($result[0]) as $column) {
            $tpl->assign ('field', $column);
            $tpl->parse ('main.tableout.row.head');
        }
    
        $tpl->assign ('field', 'edit');
        $tpl->parse ('main.tableout.row.head');
        
        $tpl->assign ('field', 'del');
        $tpl->parse ('main.tableout.row.head');
        
        $tpl->parse ('main.tableout.row');
        foreach ($result as $row) {
            foreach ($row as $column) {
                $tpl->assign ('field', $column);
                $tpl->parse ('main.tableout.row.column');
            }
            
            $tpl->assign ('field', "<a href='$url&edit&id={$row['id']}'>{$buttons['edit']}</a>");
            $tpl->parse ('main.tableout.row.column');
            
            $tpl->assign ('field', "<a href='$url&del&id={$row['id']}'>{$buttons['del']}</a>");
            $tpl->parse ('main.tableout.row.column');
            
            $tpl->parse ('main.tableout.row');
        }
    }
    $tpl->parse ('main.tableout');
}

function showMsg (&$tpl, $header, $msg) {
    $tpl->assign_file ('resultset', 'templates/msg.tpl');
    
    $tpl->assign ('header', $header);
    $tpl->assign ('msg', $msg);
    $tpl->parse ('main.msg');
    
    //insert_button ($tpl, 'back');
    insert_button ($tpl, 'home', $GLOBALS['urlname']);
}

function showError (&$tpl, $msg) {
    $tpl->assign_file ('resultset', 'templates/error.tpl');
    
    $tpl->assign ('msg', $msg);
    $tpl->parse ('main.error');
    
    insert_button ($tpl, 'back');
    insert_button ($tpl, 'home', $GLOBALS['urlname']);
}

/*function isSubmited () {
    if (count($_POST) > 0) return true;
    return false;
}*/

/*function filter_int ($value) {
    return sprintf ('%i', $value);
}*/

/*function sortByModels (&$arr) {
    $ret = array ();
    $count = count ($arr);
    
    for ($i = 0; $i < $count; ++$i) {
        if ($i > 0 && $arr[$i]['model'] != $arr[$i-1]['model'])
}*/
?>