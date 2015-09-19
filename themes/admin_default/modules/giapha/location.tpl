<!-- BEGIN: main -->
	<!-- BEGIN: error -->	
		<blockquote class="error"><span>"{ERROR}"</span></blockquote>
	<!-- END: error -->

<!-- BEGIN: data -->
<div class="table-responsive">
<a href="{comeback}">{back}</a>
<table class="table table-striped table-bordered table-hover">
	<colgroup>
		<col class="w50">
		<col span="2">
		<col class="w150">
	</colgroup>
	 <thead>
	 	<tr class="text-center">
		    <th >{LANG.thutu}</th>
		    <th >{LANG.title_location}</th>
		   <th >{LANG.view}</th>
		    <th >{LANG.action}</th>
  		</tr>
	 
	 </thead>
	 <tbody {class}>
		<!-- BEGIN: loop -->
		<tr>
			
			<td>
			   <select id="change_weight_{cuid}" onchange="nv_chang_weight_location('{cuid}','{parentid}');">
				<!-- BEGIN: loop1 -->
					<option value="{stt}" {select}>{stt}</option>
				<!-- END: loop1 -->
				</select>
			</td>
			
			<td>
				<a href="{link_cu}">{title}</a><span style="color:#FF0000"> ({num})</span>
			</td>
			
			<td>
	    	<select id="change_status_{cuid}" onchange="nv_chang_status_location('{cuid}','{parentid}','status');">
			<!-- BEGIN: loop2 -->
				<option value="{key}" {sel}>{value}</option>
			<!-- END: loop2 -->
			</select>	    
	    </td>	       	
			<td>
				<span class="edit_icon"><a href="{editlink}#edit">{LANG.edit}</a></span> 
		       &nbsp;-&nbsp;
		       <span class="delete_icon"><a href="javascript:void(0);" onclick= "nv_del_location('{cuid}','{parentid}','{nu}');" >{LANG.del}</a></span>
	       </td>
			
		</tr>
		
		<!-- END: loop -->
	</tbody>
	
</table>
</div>
<!-- END: data -->

<div class="table-responsive">
<form action="{FORM_ACTION}" method="post" >
	<table class="table table-striped table-bordered table-hover" id="edit">
		<tbody>
		<tr>
			<td>{LANG.title_location} <strong>( {title_cata} )</strong></td>
			<td style="width:10px">(<span style="color:#FF0000">*</span>)</td>
			<td><input type="text" value="{title_cu}" name="title" style="width:350px" id="idtitle">
			<input type="hidden" value="{location_id}" name="cuid" style="width:350px">
			<input type="hidden" value="{parentid}" name="parentid_old" style="width:350px"></td>
		</tr>

		<tr>
			<td>{LANG.alias}</td> <td></td>
			<td><input type="text" value="{alias}" name="alias" style="width:350px" id="idalias"></td>
		</tr>

		<tr>
			<td>{LANG.danhmuc_location}</td>
			<td style="width:10px"></td>
			 <td><strong>{title_cata}</strong></td>
		</tr>

		<tr>
		 	<td colspan="3"><input type="submit" name="save" value="{LANG.save}"></td>
		 				 			
		 	</tr>
	</tbody>
	
	</table>
</form>
</div>
<script type="text/javascript">
//<![CDATA[
$("#idtitle").change(function() {
	get_alias();
});
//]]>
</script>
<!-- END: main -->