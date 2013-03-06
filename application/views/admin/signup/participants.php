<h1>Deltagare till <?php echo $list['name']; ?></h1>
<table>
    <thead>
        <tr>
            <th style="width: 300px">Namn</th>
            <?php echo ($list['require_moderation']) ? '<th style="width:100px">Godkänd?</th>' : ''; ?>
            <th style="width: 100px">Mod</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($participants as $p){ ?>
        <tr>
            <td><?php echo $p['fname'].' '. $p['lname']; ?></td>
            <?php echo ($list['require_moderation']) ? (($p['confirmed'] == 1) ? '<td style="background-color:lightgreen">Ja</td>' : '<td style="background-color:lightcoral">Nej</td>') : ''; ?>
            <td>
                <a href="/admin/signup/deleteparticipant/<?php echo $p['user'].'/'.$p['list_id']; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a>
                <?php if($p['confirmed'] == 0) { ?>
                    <a href="/admin/signup/confirmparticipant/<?php echo $p['user'].'/'.$p['list_id']; ?>">Godkänn</a>
                <?php } else { ?>
                    <a href="/admin/signup/unconfirmparticipant/<?php echo $p['user'].'/'.$p['list_id']; ?>">Underkänn</a>
                <?php }?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>