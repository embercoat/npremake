<h1>Mailet har skickats <?php echo count($recipients); ?> personer</h1>
<table>
    <thead>
        <tr>
            <td style="width: 200px;">Namn</td>
            <td style="width: 350px;">Epost</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($recipients as $r){    ?>
        <tr>
            <td><?php echo $r['fname'].' '.$r['lname'];?></td>
            <td><?php echo $r['email']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php


?>