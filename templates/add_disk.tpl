<form method="post" action="{formurl}">
<!-- BEGIN: edit --><input type="hidden" name="id" value="{id}" /><!-- END: edit -->
<!-- BEGIN: add_disk -->
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
    req.send( { id: value, type: 'dmod' } );
}
</script>
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Добавление / изменение дисков </h2>
        <!-- BEGIN: validator -->
        <p><table align="center" border="4px" bordercolor="gray" width="100%"><tr><td align="center"><span style="color: red; weigth: bold;">Ошибка!</span><p>{vldmsg}</td></tr></table></p>
        <!-- END: valdator -->
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
            <p><a href="?dmodelslist&add" target="_blank">[Добавление модели]</a></p>
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
        <td>Параметры:</td>
        <td>
            <input name="radius" type="text" size="3" maxlength="6" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{radius}" />
            <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif">&quot;</span>
            <input name="holes" type="text" size="3" maxlength="4" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{holes}" />
            <span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif"> X <span>
            <input name="distance" type="text" size="3" maxlength="6" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif" value="{distance}" />
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>ET:</td>
        <td><input type="text" name="e" maxlength="8" value="{e}" /></td>
    </tr>
    <tr>
        <td>Диаметр:</td>
        <td><input type="text" name="diameter"  maxlength="8" value="{diameter}" /></td>
    </tr>
    <tr>
        <td>Ширина:</td>
        <td><input type="text" name="width" maxlength="8" value="{width}" /></td>
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
<!-- END: add_disk -->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>