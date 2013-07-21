<div id="dynamic">
	<?php echo $data;?>
</div>
<?php
if(isset($_SESSION['user']) && $_SESSION['user']->isAdmin()){
?>
<br /><br /><br />
<a href="/dynamic/<?=$page; ?>/edit">Ändra</a>

<?php
}
?>