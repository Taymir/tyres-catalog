<!-- BEGIN: searchfields -->
<!-- BEGIN: tyres -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="50%">
<h4>����� ��� �� �������</h4><form action="?" method="get">
<table width="350" border="0" class="ftf">
<tr>
<td width="200"><b>�������������</b></td>
<td></td>
<td></td>
</tr>
<tr>
<td>
{tmanufacturer}
</td>
<td><input type="checkbox" name="summer" <!-- BEGIN: check_summer -->checked<!-- END:check_summer -->></td>
<td><b>������</b></td>
</tr>
<tr>
<td><b>������ ����</b></td>
<td><input type="checkbox" name="winter" <!-- BEGIN: check_winter -->checked<!-- END:check_winter -->></td>
<td><b>������</b></td>
</tr>
<tr>
<td>
{width}
<font size="+1">/</font>
{height}
<font size="+1">R</font>
{radius}
</td>
<td><input type="checkbox" name="spiked" <!-- BEGIN: check_spiked -->checked<!-- END:check_spiked -->></td>
<td><b>������ ���</b></td>
</tr>
<tr class="line">
<td align="right" colspan="3">
<input type="submit" value="�����">
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
<h4>����� ������ �� ����������</h4><form action="?" method="get">
<table width="370" border="0" class="fwf">
<tr>
<td width="300"><b>�������������</b></td>
<td></td>
<td></td>
</tr>
<tr>
<td>
{dmanufacturer}
</td>
<td><input type="checkbox" name="solid" <!-- BEGIN: check_solid -->checked<!-- END:check_solid -->></td>
<td><b>�����</b></td>
</tr>
<tr>
<td><b>��������� �����</b></td>
<td><input type="checkbox" name="forged" <!-- BEGIN: check_forged -->checked<!-- END:check_forged -->></td>
<td><b>�������</b></td>
</tr>
<tr>
<td>
{radius}
<font size="+1">"</font>
{holes}
<font size="+1">�</font>
{distance}
</td>
<td><input type="checkbox" name="pressed" <!-- BEGIN: check_pressed -->checked<!-- END:check_pressed -->></td>
<td><b>�����������</b></td>
</tr>
<tr>
<td align="right" colspan="3">
<input type="submit" value="�����">
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