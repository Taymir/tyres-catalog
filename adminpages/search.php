<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          search.php
**          LastMod: 19:04 22.03.2007
** *********************************/

// index page
function index_page (&$tpl) {
    $tpl->assign ('tmanufacturer', fill_lists ('tmanufacturer', select_manfrs (false, 'tyres')));
    $tpl->assign ('width', fill_lists ('width', select_twidths ()));
    $tpl->assign ('height', fill_lists ('height', select_theights ()));
    $tpl->assign ('radius', fill_lists ('radius', select_tradiuses ()));
    $tpl->parse ('main.panel.searchfields.tyres');

    $tpl->assign ('dmanufacturer', fill_lists ('dmanufacturer', select_manfrs (false, 'disks')));
    $tpl->assign ('holes', fill_lists ('holes', select_dholes ()));
    $tpl->assign ('distance', fill_lists ('distance', select_ddistances ()));
    $tpl->assign ('radius', fill_lists ('radius', select_dradiuses ()));
    $tpl->parse ('main.panel.searchfields.disks');

    $tpl->parse ('main.panel.searchfields');
    $tpl->parse ('main.panel');

    if (isset($_GET['tyres'])) include 'show_tyres.php';
    elseif (isset($_GET['disks'])) include 'show_disks.php';
}
?>