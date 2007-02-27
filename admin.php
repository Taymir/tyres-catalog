<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          admin.php
**          LastMod: 17:40 19.02.2007
** *********************************/
require_once 'include/adminaccess.php';
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once 'include/config.php';
require_once 'include/mysql.php';
require_once 'include/xtemplate.class.php';
require_once 'include/paginator.php';
require_once 'adminpages/adminPage.php';
require_once 'adminpages/manfrsPage.php';
require_once 'adminpages/diskModelsPage.php';
require_once 'adminpages/disksPage.php';
require_once 'adminpages/tyreModelsPage.php';
require_once 'adminpages/tyresPage.php';
require_once 'adminpages/search.php';

$tpl = new XTemplate ('templates/admin.tpl');
$urlname = '';


if (isset ($_GET['tyreslist']))
    $page = &new tyresPage ($tpl);
elseif (isset ($_GET['diskslist']))
    $page = &new disksPage ($tpl);
elseif (isset ($_GET['tmodelslist']))
    $page = &new tyreModelsPage ($tpl);
elseif (isset ($_GET['dmodelslist']))
    $page = &new diskModelsPage ($tpl);
elseif (isset ($_GET['manfrlist']))
    $page = &new manfrsPage ($tpl);
elseif (isset ($_GET['logout']))
    include ('adminpages/logout.php');
else
    index_page ($tpl);

if (isset ($page)) {
    if (isset ($_GET['add']))
        $page->addPage ();
    elseif (isset ($_GET['edit']))
        $page->editPage ();
    elseif (isset ($_GET['del']))
        $page->delPage ();
    elseif (isset ($_GET['import']))
        $page->importPage ();
    else {
        //запуск пагинатора
        $pageNum = isset ($_GET['page']) ? $_GET['page'] : 1;
        paginator_init ($pageNum);
        $page->listPage ();
        //вывод строки пагинатора
        paginator_parseTpl ($tpl);
    }
}
$tpl->parse ('main');
$tpl->out ('main');
?>