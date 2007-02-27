<!-- BEGIN: main -->
<html>
<head>
<title>Admin panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" type="text/css" href="client/admin.css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div class="menu">
<a href="?">Поиск шин и дисков</a> | 
<a href="?tyreslist">Список шин</a> | 
<a href="?diskslist">Список дисков</a> | 
<a href="?tmodelslist">Список моделей шин</a> | 
<a href="?dmodelslist">Список моделей дисков</a> | 
<a href="?manfrlist">Список производителей</a> | 
<a href="?logout">Выход</a>
</div>

<br />
<!-- BEGIN: panel -->
<table width="350" height="270" style="border: 1px solid #999; -moz-border-radius: 8px;" cellpadding="0" cellspacing="0" align="center" bgcolor="#EEEEEE">
<tr><td>
{FILE "templates/searchfields.tpl"}
</td></tr>
</table>
<!-- END: panel -->

<br />
{FILE {resultset}}
</body>
</html>
<!-- END: main -->