<?php include 'header.tpl.php'; ?>
    <div id="body-form">
        <div id="caja">
            <div><h3><?php echo $title; ?></h3></div>
            <?php if (isset($error)) { include 'error.tpl.php'; } ?>
            <?php echo \P\Controllers\InventoryController::build_update_form(); ?>
        </div>
    </div>
<?php include 'footer.tpl.php'; ?>