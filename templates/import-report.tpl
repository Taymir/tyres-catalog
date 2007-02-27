<!-- BEGIN: report -->
  <script language="javascript">
function handleClick(id) {
	var obj = "";	

		// Check browser compatibility
		if(document.getElementById)
			obj = document.getElementById(id);
		else if(document.all)
			obj = document.all[id];
		else if(document.layers)
			obj = document.layers[id];
		else
			return 1;

		if (!obj) {
			return 1;
		}
		else if (obj.style) 
		{			
			obj.style.display = ( obj.style.display != "none" ) ? "none" : "";
		}
		else 
		{ 
			obj.visibility = "show";
		}
}
</script>

<table align="center" bgcolor="#EEEEEE" cellpadding="5" style="border: 1px solid #999999" width="620">
    <caption align="top">
        <h2>Отчет об импортированных записях </h2>
    </caption>
    <tr>
        <td valign="top" width="0%"><img src="images/report.png" width="64" height="64">
        </td>
        <td width="100%"><p><a href="#" onClick="handleClick ('added')" style="color: #66CC33">{added} записей добавлено</a></p>
		<div style="display:none" id="added">
            <ul>
                <!-- BEGIN: ins_row --><li>{itemvalue}</li><!-- END: ins_row -->
            </ul>      
			</div>      
            <p><a href="#" onClick="handleClick ('replaced')" style="color: #3366FF">{replaced} записей обновлено</a></p>
			<div style="display:none" id="replaced">
            <ul>
                <!-- BEGIN: upd_row --><li>{itemvalue}</li><!-- END: upd_row -->
            </ul>     
			</div>       
        <p><a href="#" onClick="handleClick ('errors')" style="color: #CC3333">{errors} записей не обработано</a></p>
		<div style="display:none" id="errors">
        <ul>
            <!-- BEGIN: err_row --><li>{itemvalue}</li><!-- END: err_row -->
        </ul>
		</div>
		</td>
    </tr>

</table>
<!-- END: report -->
<p align="center">
    <!-- BEGIN: buttonsblock -->{button} <!-- END: buttonsblock -->
</p>

