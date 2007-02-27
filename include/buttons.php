<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          buttons.php
**          LastMod: 17:40 19.02.2007
** *********************************/
require_once 'xtemplate.class.php';

$buttons = array (
    'submit' => '<input type="image" name="submit" src="images/buttons_06.gif" border="0" />',
    'reset' => '<input type="image" name="reset" src="images/buttons_03.png" onclick="this.form.reset(); return false;" border="0" />',
    'back' => '<a href="javascript:history.go(-1)"><img src="images/buttons_08.gif" border="0" /></a>',
    'home' => '<a href="admin.php?%s"><img src="images/buttons_14.gif" border="0" /></a>',
    'add' => '<a href="admin.php?%s&add"><img src="images/buttons_10.gif" border="0" /></a>',
    'import' => '<a href="admin.php?%s&import"><img src="images/buttons_12.gif" border="0" /></a>',
    'yes' => '<input type="image" name="submit" src="images/yes.gif" border="0" />',
    'no' => '<a href="admin.php?%s"><img src="images/no.gif" border="0" /></a>',
    'edit' => '<center><img src="images/edit.png" border="0" /></center>',
    'del' => '<center><img src="images/del.png" border="0" /></center>',
);

function insert_button (&$tpl, $button, $param = null) {
    global $buttons;
    $buttonvalue = $buttons[$button];
    if ($param !== null)
        $buttonvalue = sprintf ($buttonvalue, $param);
    $tpl->assign ('button', $buttonvalue);
    $tpl->parse ('main.buttonsblock');
}



?>