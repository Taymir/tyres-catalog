<div align="center" class="spec"><h3>РЕЗУЛЬТАТ ПОИСКА</h3></div>
<script>
<!--

function openWin2(param) {
  window.open("upload/images/" + param, "Изображение", "");
}

// -->
</script>
<!-- BEGIN: tyres -->
<table width="100%" border="0" cellpadding="10" cellspacing="0">
    <tr>
        <td width="100"><a href='javascript:openWin2("{image}")'><img src="upload/thumbnails/{image}" border="0"></a></td>
        <td valign="top">
        <h2>{mnfrname} {model}</h2>
        {description}
        </td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr bgcolor="#1a1a1a">
		 <td width="50%"><b>Наименование</b></td>
		 <td width="15%" align="right"><b>Кол-во</b></td>
		 <td width="20%" align="right"><b>Цена</b></td>
		 <td width="15%" align="right">&nbsp;</td>
    </tr>
    <!-- BEGIN: row -->
    <tr bgcolor="#444444">
         <td width="50%">{mnfrname} {model} {width}/{height} R{radius} {load}{speed}</td>
		 <td width="15%" align="right">
		 <input value="4" size="3">
		 </td>
		 <td width="20%" align="right">{price} р.</td>
		 <td width="15%" align="right">
		 <input type="submit" value="Заказать">
		 </td>
    </tr>
    <!-- END: row -->
</table>
<!-- END: tyres -->
<br><br>
{FILE "templates/paginator.tpl"}