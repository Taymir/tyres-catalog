<form enctype="multipart/form-data" method="post" action="{formurl}">
<!-- BEGIN: import_tyre_models -->
<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Импорт списка моделей шин </h2>
        </caption>
    <tr>
        <td>Этот раздел позволяет импортировать данные в базу из csv-файла. Это может пригодиться, если прайс-лист составляется в программе MS Excel. </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="70%" align="center"><img src="images/xls_tyre_models.png" border="1"></td>
    </tr>
    <tr>
        <td><fieldset><legend>Подсказка</legend>
            Выше представлена структура прайс-листа. Чтобы сохранить прайс-лист в формат csv, выберит пункт меню Файл, затем Сохранить как, тип файла: csv. Помните, что сохраняется только первый лист xls-файла, так что если вы хотите сохранить несколько листов - нужно создать несколько csv-файлов.<br><br>
            Как и на скриншоте, первая строка может содержать названия столбцов (только не меняйте их порядок!).
            <br>
            <br>
            <b>Столбец "Сезон" может содержать только одно из трех значений: summer (летняя), winter (зимняя), spiked (зимняя шипованная)!</b>
            <br>
            <br>
            Если в базе уже имеются данные с теми параметрами, которые вы импортируете, то для них будут обновлены описания и сезоны.
        </fieldset>
            </td>
    </tr>
    <tr>
        <td>&nbsp;
        </td>
    </tr>
    <tr>
        <td><div align="center">Файл: 
                    <input name="file" type="file" size="50" />
        </div></td>
    </tr>
</table>
<!-- END: import_tyre_models -->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>
</form>