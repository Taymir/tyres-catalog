<html>
<head>
<title>�������� ������� ��� ���������������� ������</title>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
</head>
<body>
<form name="form1" method="post" action="?">
    <p>������ �������� ������� ��� ���������������� ������</p>
    <table border="0" cellspacing="2" cellpadding="2">
        <tr>
            <th scope="col">�����</th>
            <th scope="col">������</th>
            <th scope="col">��������� ������ </th>
        </tr>
        <tr>
            <td><input type="text" name="login[]"></td>
            <td><input type="password" name="pass1[]"></td>
            <td><input type="password" name="pass2[]"></td>
        </tr>
        <tr>
            <td><input type="text" name="login[]"></td>
            <td><input type="password" name="pass1[]"></td>
            <td><input type="password" name="pass2[]"></td>
        </tr>
        <tr>
            <td><input type="text" name="login[]"></td>
            <td><input type="password" name="pass1[]"></td>
            <td><input type="password" name="pass2[]"></td>
        </tr>
        <tr>
            <td><input type="text" name="login[]"></td>
            <td><input type="password" name="pass1[]"></td>
            <td><input type="password" name="pass2[]"></td>
        </tr>
    </table>
    <p>
        <input type="submit" name="submit">
    </p>
</form>
<?php
require_once './../include/config.php';
if (isset ($_POST['submit'])) {
    echo "<hr><h4>���������� �������� ��� � ���� <b>include/admincfg.php</b></h4>";
    $logins = array ();
    for ($i = 0; $i < count(@$_POST['login']); $i++) {
        if (empty ($_POST['login'][$i])) continue;
        if ($_POST['pass1'][$i] != $_POST['pass2'][$i]) die ("������, ������ �� ��������� � ������ $i.");
        $logins[] = array ($_POST['login'][$i], md5( $salt . $_POST['pass1'][$i] ));
    }
    
    $str = "<?php\n
///////// � ���� ����� �������� ������ ��������� ��� ����� � ������ ������������� �����   ////////// \n\n
\$adm_accounts = array ();\n";
    
    $i = 0;
    foreach ($logins as $login) {
        $str .= "\$adm_accounts[$i]['login'] = '$login[0]';\n";
        $str .= "\$adm_accounts[$i]['password'] = '$login[1]';\n\n";
        $i++;
    }
    $str .= "\n?>";
    highlight_string ($str);
};

?>
</body>
</html>