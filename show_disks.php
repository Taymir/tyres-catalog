<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          show_disks.php
**          LastMod: 19:04 22.03.2007
** *********************************/
$tpl->assign_file ('resultset', 'templates/disks.tpl');

//валидация полученных данных
$manufacturer = if_in_arr (@$_REQUEST['dmanufacturer'], select_manfrs (false, 'disks'));
$holes = if_in_arr(@$_REQUEST['holes'], select_dholes ());
$distance = if_in_arr(@$_REQUEST['distance'], select_ddistances ());
$radius = if_in_arr(@$_REQUEST['radius'], select_dradiuses ());

$material = check2arr (array('solid', 'forged', 'pressed'));

//запуск пагинатора
$pageNum = isset ($_GET['page']) ? $_GET['page'] : 1;
paginator_init ($pageNum);

//производится запрос к бд
$data = select_disks ($manufacturer, $holes, $distance, $radius, $material);

$rows = 0;
for ($i = 0; $i < count ($data); $i++) {
    $tpl->insert_loop ('main.disks.row', $data[$i]);
    $rows++;
    if ($data[$i]['model'] != @$data[$i+1]['model']) {
        $tpl->assign ('model', $data[$i]['model']);
        $tpl->assign ('mnfrname', $data[$i]['mnfrname']);
        if (empty ($data[$i]['image'])) $data[$i]['image'] = 'no_image.jpg';
        $tpl->assign ('image', $data[$i]['image']);
        $tpl->assign ('description', $data[$i]['mnfrdesc']);
        $tpl->parse ('main.disks');
        $rows = 0;
    }
}
/*if ($rows > 0)
    $tpl->parse ('main.disks');*/

//вывод строки пагинатора
paginator_parseTpl ($tpl);
?>