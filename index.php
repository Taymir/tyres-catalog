<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          index.php
**          LastMod: 17:40 19.02.2007
** *********************************/
require_once 'include/config.php';
require_once 'include/tyres.php';
require_once 'include/disks.php';
require_once 'include/manfr.php';
require_once 'include/mysql.php';
require_once 'include/utils.php';
require_once 'include/xtemplate.class.php';
require_once 'include/paginator.php';

$tpl = new XTemplate ('templates/main.tpl');

$tpl->assign ('manufacturer', fill_lists ('manufacturer', select_manfrs ()));
$tpl->assign ('width', fill_lists ('width', select_twidths ()));
$tpl->assign ('height', fill_lists ('height', select_theights ()));
$tpl->assign ('radius', fill_lists ('radius', select_tradiuses ()));
$tpl->parse ('main.searchfields.tyres');

$tpl->assign ('holes', fill_lists ('holes', select_dholes ()));
$tpl->assign ('distance', fill_lists ('distance', select_ddistances ()));
$tpl->assign ('radius', fill_lists ('radius', select_dradiuses ()));
$tpl->parse ('main.searchfields.disks');

$tpl->parse ('main.searchfields');

if (isset($_GET['tyres'])) include 'show_tyres.php';
elseif (isset($_GET['disks'])) include 'show_disks.php';

$tpl->parse ('main');
$tpl->out ('main');
?>