<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}={OP}" method="post">
	<table class="table table-striped table-bordered">
		<caption>Thông tin chi họ</caption>
		<tbody>
			<tr>
				<td>{LANG.family_title}</td>
				<td>
				<select name="fid">
					<!-- BEGIN: family -->
					<option value="{fid}">{title}</option>
					<!-- END: family -->
				</select></td>
			</tr>
			<tr>
				<td>{LANG.genealogy_title}:</span></td>
				<td>
				<input name="title" value="{DATA.title}" maxlength="255" style="width: 450px;" type="text"> <span style="color: #CC0000">(*)</span>
				<br>
				<br>
				({LANG.genealogy_note})
				<br>
				</td>
			</tr>

			<tr>
				<td>{LANG.location_title}:</td>
				<td>
				<select name="locationid">
					<!-- BEGIN: location -->
					<option value="{locationid}" >{title}</option>
					<!-- END: location -->
				</select> <span style="color: #CC0000">(*)</span></td>
			</tr>
			<tr>
				<td colspan="2"><b>{LANG.description}</b> ({LANG.description_note})
				<br>
				<br>
				{DATA.description}</td>
			</tr>

			<tr>
				<td colspan="2"><b>{LANG.rule} </b>({LANG.rule_note})
				<br>
				<br>
				{DATA.rule}</td>
			</tr>

			<tr>
				<td colspan="2"><b>{LANG.content}</b>( {LANG.content_note})
				<br>
				<br>
				{DATA.content}</td>
			</tr>

			<tr>
				<td>{LANG.adddefaultblock}</td>
				<td>
				<input name="status" type="checkbox" {DATA.status_checked}>
				<br>
				</td>
			</tr>
<!--
			<tr>
				<td>{LANG.who_view}:</td>
				<td>
				<select name="who_view">
					<!-- BEGIN: who_view -->
					<option value="{WHO_VIEW.id}" {WHO_VIEW.selected}>{WHO_VIEW.title}</option>
					<!-- END: who_view -->
				</select> <span style="color: #CC0000">(*)</span></td>
			</tr>
-->
		</tbody>		
	</table>
	
	<table class="table table-striped table-bordered">
		<caption>{LANG.genealogy_year}</caption>		
		<tbody >
			<tr>
				<td>{LANG.genealogy_year}:</span></td>
				<td>
				<input name="years" value="{DATA.years}" maxlength="55" style="width: 200px;" type="text">
				</td>
			</tr>

			<tr>
				<td>{LANG.genealogy_author}:</span></td>
				<td>
				<input name="author" value="{DATA.author}" maxlength="255" style="width: 450px;" type="text">
				</td>
			</tr>

			<tr>
				<td>{LANG.genealogy_contact}:</span></td>
				<td>
				<input name="full_name" value="{DATA.full_name}" maxlength="255" style="width: 450px;" type="text">
				</td>
			</tr>

			<tr>
				<td>{LANG.genealogy_mobile}:</span></td>
				<td>
				<input name="telephone" value="{DATA.telephone}" maxlength="255" style="width: 200px;" type="text">
				</td>
			</tr>

			<tr>
				<td>{LANG.genealogy_email}:</span></td>
				<td>
				<input name="email" value="{DATA.email}" maxlength="255" style="width: 450px;" type="text">
				</td>
			</tr>
		</tbody>
	</table>
	<div style="text-align: center">
		<input name="gid" type="hidden" value="{DATA.gid}" />
		<input name="submit" type="submit" value="{LANG.save}" style="width: 200px;" />
	</div>
	<br/>
		{LANG.genealogy_note2}
		<br/><br/>
</form>
<!-- END: main -->
