<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          paginator.php
**          LastMod: 17:40 19.02.2007
** *********************************/

$paginator_go = false;
$paginator_page = null;
$paginator_per_page = 10;
$paginator_total = null;

function paginator_getSql () {
    if (!$GLOBALS['paginator_go']) return '';
    
    return sprintf (' LIMIT %d, %d', ($GLOBALS['paginator_page'] - 1) * $GLOBALS['paginator_per_page'], $GLOBALS['paginator_per_page']);
}

function paginator_works () {
    return $GLOBALS['paginator_go'];
};

function paginator_init ($page, $per_page = null) {
    if (is_null ($per_page)) $per_page = $GLOBALS['paginator_per_page'];
    if ($page < 1) $page = 1;
    $GLOBALS['paginator_go'] = true;
    $GLOBALS['paginator_page'] = $page;
}

function paginator_parseTpl (&$tpl) {
    $last_page = ceil ($GLOBALS['paginator_total'] / $GLOBALS['paginator_per_page']);
    if ($last_page > 1) {
        if ($GLOBALS['paginator_page'] > $last_page) $GLOBALS['paginator_page'] = $last_page;
        parse_str ($_SERVER['QUERY_STRING'], $params);
        
        for ($i = 1; $i <= $last_page; ++$i) {
            $params['page'] = $i;
            $tpl->assign ('page_url', $_SERVER['SCRIPT_NAME'] . '?' . unparse_str ($params) );
            $tpl->assign ('page_num', $i);
            if ($i == $GLOBALS['paginator_page'])
                $tpl->parse ('main.paginator.page.active');
            $tpl->parse ('main.paginator.page');
        }
        
        $tpl->parse ('main.paginator');
    }
    
    paginator_finish ();
}

function unparse_str (&$arr) {
    $str = '';
    foreach ($arr as $key => $value) {
        $str .= $key . '=' . $value;
        $str .= '&';
    }
    return substr($str, 0, -1);
}

function paginator_setTotal ($val) {
    $GLOBALS['paginator_total'] = $val;
}

function paginator_finish () {
    $GLOBALS['paginator_go'] = false;
}
?>