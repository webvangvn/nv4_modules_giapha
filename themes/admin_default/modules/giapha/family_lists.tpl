<!-- BEGIN: main -->
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<colgroup>
			<col class="w50">
			<col span="2">
			<col class="w150">
			<col class="w250">
		</colgroup>
		<thead>
			<tr>
				<th>{LANG.weight}</th>
				<th class="text-center">ID</th>
				<th>{LANG.name}</th>
				<th class="text-center">{LANG.adddefaultblock}</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: loop -->
			<tr>
				<td class="text-center">
				<select  id="id_weight_{ROW.fid}" onchange="nv_chang_family('{ROW.fid}','weight');">
					<!-- BEGIN: weight -->
					<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
					<!-- END: weight -->
				</select></td>
				<td class="text-center"><strong>{ROW.fid}</strong></td>
				<td><a href="{ROW.link}">{ROW.title}</a> </td>
				<td class="text-center">
				<select id="id_status_{ROW.fid}" onchange="nv_chang_family('{ROW.fid}','status');">
					<!-- BEGIN: status -->
					<option value="{STATUS.key}"{STATUS.selected}>{STATUS.title}</option>
					<!-- END: status -->
				</select></td>
				<td class="text-center">
					<em class="fa fa-edit fa-lg">&nbsp;</em> <a href="{ROW.url_edit}">{GLANG.edit}</a> &nbsp;
					<em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="javascript:void(0);" onclick="nv_del_family({ROW.fid})">{GLANG.delete}</a>
				</td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
</div>
<!-- END: main -->