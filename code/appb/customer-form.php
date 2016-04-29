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
    <tr>
    <tr><td>Name:</td><td><?= $form->input('text', ['name' => 'name']) ?></td></tr>
    <tr><td>Phone Number:</td><td><?= $form->input('text', ['name' => 'phone']) ?></td></tr>
    <tr><td>Favorite Dish:</td>
        <td><?= $form->select($dishes,['name' => 'dish_id']) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['name' => 'add',
                                        'value' => 'Add Customer']) ?></td>
    </tr>
</table>
</form>
