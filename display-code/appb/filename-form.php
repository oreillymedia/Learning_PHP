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

    <tr><td>File:</td><td><?= $form->input('text', ['name' => 'file']) ?></td></tr>
    <tr><td colspan="2" align="center"><?= $form->input('submit', ['value' => 'Display']) ?>
    </td></tr>

</table>
</form>