<?php include 'header.tpl.php'; ?>
    <div id="body">
        <div id='section'>
            <?php if (isset($error)) { include 'error.tpl.php'; } ?>
            <?php echo \P\Controllers\InventoryController::show_my_publications(); ?>
        </div>
        <?php include 'aside.tpl.php'; ?>
    </div>
<?php include 'footer.tpl.php'; ?>