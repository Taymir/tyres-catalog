<form method="post" action="{formurl}">
<!-- BEGIN: edit --><input type="hidden" name="id" value="{id}" /><!-- END: edit -->
<!-- BEGIN: add_tyre -->
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
    req.send( { id: value, type: 'tmod' } );
}
</script>
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Добавление / изменение шин</h2>
        {FILE "templates/validator.tpl"}
    </caption>
    <tr>
        <td valign="top" width="30%">
            <p>
                Модель:
                <select name="model" id="modelSelection" onchange="doLoad(document.getElementById('modelSelection').value)">
                    <!-- BEGIN: option --><option value="{id}" <!-- BEGIN: chosen -->selected="selected"<!-- END: chosen -->>{value}</option><!-- END: option -->
                </select>
                <script type="text/javascript" language="JavaScript">doLoad(document.getElementById('modelSelection').value);</script>
            </p>
            <p><a href="?tmodelslist&add" target="_blank">[Добавление модели]</a></p>
        </td>
        <td width="70%">
            <fieldset>
                <legend>Описание модели&nbsp;</legend>
                <div id="preview"></div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Размеры:</td>
        <td>
            <input name="width" type="text" size="3" maxlength="4" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{width}" />
            <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif"> / </span>
            <input name="height" type="text" size="3" maxlength="4" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{height}" />
            <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif"> R </span>
            <input name="radius" type="text" size="3" maxlength="4" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{radius}" />
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Нагрузка:</td>
        <td><input type="text" name="load"  maxlength="8" value="{load}" /></td>
    </tr>
    <tr>
        <td>Скорость</td>
        <td><input type="text" name="speed" maxlength="1" value="{speed}" /></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Цена:</td>
        <td>
            <input type="text" name="price" maxlength="8" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{price}" />
            <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif">руб.</span>
        </td>
    </tr>
</table>
<!-- END: add_tyre -->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>