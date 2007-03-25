<form enctype="multipart/form-data" method="post" action="{formurl}">
<!-- BEGIN: edit --><input type="hidden" name="id" value="{id}" /><!-- END: edit -->
<!-- BEGIN: add_manufacturer-->
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Добавление / изменение производителя</h2>
        {FILE "templates/validator.tpl"}
    </caption>
    <tr>
        <td>Название:</td>
        <td>
            <input type="text" name="name" maxlength="255" value="{name}" />
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Категория:</td>
        <td>
            <select name="type">
                <!-- BEGIN: type --><!-- BEGIN: option --><option value="{id}" <!-- BEGIN: chosen -->selected="selected"<!-- END: chosen -->>{value}</option><!-- END: option --><!-- END: type -->
            </select>
        </td>
    </tr>
    <tr>
        <td>Описание:</td>
        <td><textarea name="description" style="width:450px; height:100px">{description}</textarea></td>
    </tr>
</table>
<!-- END: add_manufacturer-->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>