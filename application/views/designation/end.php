<div id="action" style="float:right;">
	<label for="action">What to do with these?</label>
	<select id="actionSelector" name="action">
		<option value="nil">Choose carefully</option>
		<option value="addToGroup">Add to Group...</option>
		<option value="addToMission">Add to Mission...</option>
		<option value="addToOrganisation">Add to Organisation...</option>
	</select>
	<button type="button" style="float: right; font-size: 16px;" onClick="performAction();">Do</button>
</div>
<div id="groupSelectForm" class="detailSelectForm preHidden">
	<label for="groupSelect">Select Group</label>
	<select name="groupSelect" id="groupSelect"></select>

	<label for="membershiptypeSelect">Select Membership type</label>
	<select name="membershiptypeSelect"" id="membershiptypeSelect"></select>

	<button type="submit" style="float: right;">Go for it!</button>
</div>
<div id="missionSelectForm" class="detailSelectForm preHidden">
	<label for="missionSelect">Select Mission</label>
	<select name="missionSelect" id="missionSelect"></select>

	<button type="submit" style="float: right;">Go for it!</button>
</div>

<div id="organisationSelectForm" class="detailSelectForm preHidden">
	<label for="orgSelect">Select Organisation</label>
	<select name="orgSelect" id="orgSelect"></select>
	<table id="orgTable">
		<thead>
			<tr>
				<td>Name</td>
				<td>Role</td>
				<td>Make Admin</td>
			</tr>
		</thead>
		<tbody id="organisationList">
		</tbody>
	</table>

	<button type="submit" style="float: right;">Go for it!</button>
</div>

</form>