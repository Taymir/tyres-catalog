<form enctype="multipart/form-data" method="post" action="{formurl}">
<!-- BEGIN: edit --><input type="hidden" name="id" value="{id}" /><!-- END: edit -->
<!-- BEGIN: add_tyre_model-->
<script type="text/javascript" language="JavaScript" 
  src="client/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function doLoad(value) {
    // Create new JsHttpRequest object.
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            // Write result to page element ($_RESULT become responseJS). 
            document.getElementById('preview').innerHTML = req.responseText;
        }
    }
    // Prepare request object (automatically choose GET or POST).
    req.open(null, 'loader.php', true);
    // Send data to backend.
    req.send( { id: value, type: 'manf' } );
}
</script>
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Добавление / изменение моделей шин</h2>
        {FILE "templates/validator.tpl"}
    </caption>
    <tr>
        <td valign="top" width="30%">
            <p>
                Производитель: 
                <select name="manufacturer" id="modelSelection" onchange="doLoad(document.getElementById('modelSelection').value)">
                    <!-- BEGIN: option --><option value="{id}" <!-- BEGIN: chosen -->selected="selected"<!-- END: chosen -->>{value}</option><!-- END: option -->
                </select>
                <script type="text/javascript" language="JavaScript">doLoad(document.getElementById('modelSelection').value);</script>
            </p>
            <p><a href="?manfrlist&add" target="_blank">[Добавление производителя]</a></p>
        </td>
        <td width="70%">
            <fieldset>
                <legend>Описание производителя&nbsp;</legend>
                <div id="preview"></div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Модель:</td>
        <td><input type="text" name="model" maxlength="255" value="{model}" /></td>
    </tr>
    <tr>
        <td>Описание:</td>
        <td><textarea name="description" style="width:450px; height:100px">{description}</textarea></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Сезон:</td>
        <td>
            <select name="season">
                <!-- BEGIN: season --><!-- BEGIN: option --><option value="{id}" <!-- BEGIN: chosen -->selected="selected"<!-- END: chosen -->>{value}</option><!-- END: option --><!-- END: season -->
            </select>
        </td>
    </tr>
    <tr>
        <td>Изображение:</td>
        <td><input type="file" name="image" /></td>
    </tr>
</table>
<!-- END: add_tyre_model-->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>