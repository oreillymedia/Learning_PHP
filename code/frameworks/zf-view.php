<p> At <?php echo $when->format("g:i a") ?>, here is what's available: </p>
<ul>
<?php foreach ($what as $item) { ?>
<li><?php echo $this->escapeHtml($item) ?></li>
<?php } ?>
</ul>
