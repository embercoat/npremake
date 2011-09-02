<form method="post" id="userForm">
<fieldset>
	<table style="border: 1px solid black" id="users" class="display">
		<thead>
			<tr>
				<td style="width: 150px;">Efternamn</td>
				<td style="width: 150px;">Förnamn</td>
				<td style="width: 150px;">Användarnamn</td>
				<td style="width: 100px;">Modify</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($users as $u){
		    ?>
		    <tr>
		    	<td><?=$u['lname']?></td>
		    	<td><?=$u['fname']?></td>
		    	<td><?=$u['username']?></td>
		    	<td>
		    		<a href="/admin/user/editUser/<?=$u['user_id']; ?>/"><img src="/images/icon/edit.gif" /></a>
		    		<input type="checkbox" name="userids[]" value="<?=$u['user_id']; ?>" /></td>
		    </tr>
		    
		    <?
		}
		?>
		</tbody>
	</table>
</fieldset>
<div id="action" style="float:right;">
	<label for="action">What to do with these?</label>
	<select id="actionSelector" name="action">
		<option value="nil">Choose carefully</option>
		<option value="addToGroup">Add to Group...</option>
	</select>
	<button type="button" style="float: right; font-size: 16px;" onClick="performAction();">Do</button>
</div>
<div id="groupSelectForm" class="preHidden">
<label for="groupSelect">Select Group</label>
<select name="groupSelect" id="groupSelect">
</select>
<label for="membershiptypeSelect">Select Membership type</label>
<select name="membershiptypeSelect"" id="membershiptypeSelect">
</select>
<button type="submit" style="float: right;">Go for it!</button>
</div>
</form>
