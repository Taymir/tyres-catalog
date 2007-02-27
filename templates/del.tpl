<form method="post" action="{formurl}">
<!-- BEGIN: edit --><input type="hidden" name="id" value="{id}" /><!-- END: edit -->
<!-- BEGIN: del -->
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Удаление записи</h2>
    </caption>
    <tr>
        <td valign="top" width="0%"><img src="images/alert.png" width="64" height="64">
        </td>
        <td width="100%">Вы уверены в том, что хотите удалить запись? Восстановить её будет невозможно!
        </td>
    </tr>

</table>
<!-- END: del -->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>