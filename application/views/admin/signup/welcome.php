<a href="/admin/signup/create">Skapa ny Lista</a>
<table>
<tr>
    <th style="width: 150px;">Name</th>
    <th style="width: 150px;">Antal</th>
    <th style="width: 75px;">Öppen</th>
    <th style="width: 75px;">Synlig</th>
    <th style="width: 75px;">Mod</th>
</tr>
<?php foreach($lists as $list){ ?>
<tr>
    <td><a href="/admin/signup/list/<?php echo $list['idlist']; ?>"><?php echo $list['name']; ?></a></td>
    <td><a href="/admin/signup/participants/<?php echo $list['idlist']; ?>"><?php echo $list['count']; ?> Deltagare</a></td>
    <?php echo (($list['open'] == 1) ? '<td style="background-color:lightgreen">Ja</td>' : '<td style="background-color:lightcoral">Nej</td>'); ?>
    <?php echo (($list['visible'] == 1) ? '<td style="background-color:lightgreen">Ja</td>' : '<td style="background-color:lightcoral">Nej</td>'); ?>
    <td><a href="/admin/signup/deleteList/<?php echo $list['idlist']; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a></td>
<?php }?>
</table>