<!-- BEGIN: searchfields -->
<!-- BEGIN: tyres -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="50%">
<h4>Поиск шин по размеру</h4><form action="?" method="get">
<table width="350" border="0" class="ftf">
<tr>
<td width="200"><b>Производитель</b></td>
<td></td>
<td></td>
</tr>
<tr>
<td>
{manufacturer}
</td>
<td><input type="checkbox" name="summer" checked></td>
<td><b>Летняя</b></td>
</tr>
<tr>
<td><b>Размер шины</b></td>
<td><input type="checkbox" name="winter" checked></td>
<td><b>Зимняя</b></td>
</tr>
<tr>
<td>
{width}
<font size="+1">/</font>
{height}
<font size="+1">R</font>
{radius}
</td>
<td><input type="checkbox" name="spiked" checked></td>
<td><b>Зимняя шип</b></td>
</tr>
<tr class="line">
<td align="right" colspan="3">
<input type="submit" value="НАЙТИ">
<input type="hidden" name="tyres" value="true">
</td>
<td></td>
<td></td>
</tr>
</table>
</form>
</td>
<!-- END: tyres -->
<!-- BEGIN: disks -->
<td width="50%" align="center">
<h4>Поиск дисков по параметрам</h4><form action="?" method="get">
<table width="370" border="0" class="fwf">
<tr>
<td width="300"><b>Производитель</b></td>
<td></td>
<td></td>
</tr>
<tr>
<td>
{manufacturer}
</td>
<td><input type="checkbox" name="solid" checked></td>
<td><b>Литой</b></td>
</tr>
<tr>
<td><b>Параметры диска</b></td>
<td><input type="checkbox" name="forged" checked></td>
<td><b>Кованый</b></td>
</tr>
<tr>
<td>
{radius}
<font size="+1">"</font>
{holes}
<font size="+1">Х</font>
{distance}
</td>
<td><input type="checkbox" name="pressed" checked></td>
<td><b>Штампованый</b></td>
</tr>
<tr>
<td align="right" colspan="3">
<input type="submit" value="НАЙТИ">
<input type="hidden" name="disks" value="true">
</td>
<td></td>
<td></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
<!-- END: disks -->
<!-- END: searchfields -->