<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          logout.php
**          LastMod: 17:40 19.02.2007
** *********************************/
if (!defined ('ADMIN_ACCESS')) die ('Hack attempt');

require_once ('include/utils.php');
require_once ('include/xtemplate.class.php');

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';

header("Location: http://logout:logout@$host$uri/$extra");

showMsg ($tpl, 'Выход', 'Произведен выход из системы, для перехода на главную страницу сайта нажмите:
<br><a href="index.php">Перейти на главную страницу</a>');

?>