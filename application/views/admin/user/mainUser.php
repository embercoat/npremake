<?php echo View::factory('designation/start'); ?>
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
		    	<td id="lname_<?php echo $u['user_id'];?>"><?php echo $u['lname']; ?></td>
		    	<td id="fname_<?php echo $u['user_id'];?>"><?php echo $u['fname']; ?></td>
		    	<td><?php echo $u['username']; ?></td>
		    	<td>
		    		<a href="/admin/user/editUser/<?=$u['user_id']; ?>/"><img src="/images/icon/edit.gif" /></a>
		    		<?php echo View::factory('designation/check')->set('userid', $u['user_id']); ?></td>

		    </tr>

		<?php } ?>
		</tbody>
	</table>

<?php echo View::factory('designation/end'); ?>