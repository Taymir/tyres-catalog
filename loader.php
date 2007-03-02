<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          loader.php
**          LastMod: 23:57 02.03.2007
** *********************************/
require_once 'include/JsHttpRequest.php';
require_once 'include/config.php';
require_once 'include/tyres.php';
require_once 'include/disks.php';
require_once 'include/manfr.php';
require_once 'include/xtemplate.class.php';

$JsHttpRequest =& new JsHttpRequest("windows-1251");

switch (@$_REQUEST['type']) {
    case 'tmod':
        $data = select_tyre_models_byid (@$_REQUEST['id']);
        $tpl = &new XTemplate ('templates/prev_tmod.tpl');
    break;
    case 'dmod':
        $data = select_disk_models_byid (@$_REQUEST['id']);
        $tpl = &new XTemplate ('templates/prev_dmod.tpl');
    break;
    case 'manf':
        $data = select_manfrs_byid (@$_REQUEST['id']);
        $tpl = &new XTemplate ('templates/prev_manf.tpl');
    break;
};
$tpl->insert_loop ('main', $data);
$tpl->out ('main');
?>
