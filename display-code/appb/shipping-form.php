<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
<table>
    <?php if ($errors) { ?>
        <tr>
            <td>You need to correct the following errors:</td>
            <td><ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?= $form->encode($error) ?></li>
                <?php } ?>
            </ul></td>
    <?php }  ?>

    <tr><th>From:</th><td></td></tr>
    <tr><td>Name:</td><td><?= $form->input('text', ['name' => 'from_name']) ?></td></tr>
    <tr><td>Address 1:</td><td><?= $form->input('text', ['name' => 'from_address1']) ?></td></tr>
    <tr><td>Address 2:</td><td><?= $form->input('text', ['name' => 'from_address2']) ?></td></tr>
    <tr><td>City:</td><td><?= $form->input('text', ['name' => 'from_city']) ?></td></tr>
    <tr><td>State:</td><td><?= $form->select($GLOBALS['states'], ['name' => 'from_state']) ?></td></tr>
    <tr><td>ZIP:</td><td><?= $form->input('text', ['name' => 'from_zip', 'size' => 5]) ?></td></tr>

    <tr><th>To:</th><td></td></tr>
    <tr><td>Name:</td><td><?= $form->input('text', ['name' => 'to_name']) ?></td></tr>
    <tr><td>Address 1:</td><td><?= $form->input('text', ['name' => 'to_address1']) ?></td></tr>
    <tr><td>Address 2:</td><td><?= $form->input('text', ['name' => 'to_address2']) ?></td></tr>
    <tr><td>City:</td><td><?= $form->input('text', ['name' => 'to_city']) ?></td></tr>
    <tr><td>State:</td><td><?= $form->select($GLOBALS['states'], ['name' => 'to_state']) ?></td></tr>
    <tr><td>ZIP:</td><td><?= $form->input('text', ['name' => 'to_zip', 'size' => 5]) ?></td></tr>

    <tr><th>Package:</th><td></td></tr>
    <tr><td>Weight:</td><td><?= $form->input('text', ['name' => 'weight']) ?></td></tr>
    <tr><td>Height:</td><td><?= $form->input('text', ['name' => 'height']) ?></td></tr>
    <tr><td>Width:</td><td><?= $form->input('text', ['name' => 'width']) ?></td></tr>
    <tr><td>Depth:</td><td><?= $form->input('text', ['name' => 'depth']) ?></td></tr>

    <tr><td colspan="2" align="center"><?= $form->input('submit', ['value' => 'Ship!']) ?>
    </td></tr>

</table>
</form>