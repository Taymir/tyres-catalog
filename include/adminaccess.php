<?php
/* *********************************
**                  Tyres & Disks
**              online web catalog
**                      u7@2007
**  
**          adminaccess.php
**          LastMod: 17:40 19.02.2007
** *********************************/
require_once 'config.php';
require_once 'admincfg.php';

if (!isset($_SERVER['PHP_AUTH_USER'])) {
   header('WWW-Authenticate: Basic realm="Authorize"');
   header('HTTP/1.0 401 Unauthorized');
   die ('Необходима авторизация');
} else {
   if (in_array (array ('login' => $_SERVER['PHP_AUTH_USER'], 'password' => md5($salt . $_SERVER['PHP_AUTH_PW'])), $adm_accounts)) {
        define ('ADMIN_ACCESS', 'authorized');
    } else {
        header('WWW-Authenticate: Basic realm="Authorize"');
        header('HTTP/1.0 401 Unauthorized');
        die ('Необходима авторизация');
    }
}

unset ($adm_accounts);
?>