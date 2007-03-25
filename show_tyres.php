<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          show_tyres.php
**          LastMod: 19:03 22.03.2007
** *********************************/
$tpl->assign_file ('resultset', 'templates/tyres.tpl');

//валидация полученных данных
$manufacturer = if_in_arr (@$_REQUEST['tmanufacturer'], select_manfrs (false, 'tyres'));
$width = if_in_arr(@$_REQUEST['width'], select_twidths ());
$heigh = if_in_arr(@$_REQUEST['height'], select_theights ());
$radius = if_in_arr(@$_REQUEST['radius'], select_tradiuses ());

$seasons = check2arr (array('summer', 'winter', 'spiked'));

//запуск пагинатора
$pageNum = isset ($_GET['page']) ? $_GET['page'] : 1;
paginator_init ($pageNum);

//производится запрос к бд
$data = select_tyres ($manufacturer, $width, $heigh, $radius, $seasons);

$rows = 0;
for ($i = 0; $i < count ($data); $i++) {
    $tpl->insert_loop ('main.tyres.row', $data[$i]);
    $rows++;
    if ($data[$i]['model'] != @$data[$i+1]['model']) {
        $tpl->assign ('model', $data[$i]['model']);
        $tpl->assign ('mnfrname', $data[$i]['mnfrname']);
        if (empty ($data[$i]['image'])) $data[$i]['image'] = 'no_image.jpg';
        $tpl->assign ('image', $data[$i]['image']);
        $tpl->assign ('description', $data[$i]['description']);
        $tpl->parse ('main.tyres');
        $rows = 0;
    }
}
/*if ($rows > 0)
    $tpl->parse ('main.tyres');*/
    
//вывод строки пагинатора
paginator_parseTpl ($tpl);
?>
