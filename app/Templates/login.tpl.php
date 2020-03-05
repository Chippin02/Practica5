<?php include 'header.tpl.php'; ?>
<div id="body-form">
    <div id="caja">
        <div><h3><?php echo $title; ?></h3></div>
        <?php if (isset($error)) { include 'error.tpl.php'; } ?>
        <form action="/user/connect" method="post">
            <table style="border-spacing: 5px;">
                <tr>
                    <td style="text-align: right;"><label for="usuari">Nom d'usuari </label></td>
                    <td><input type="text" name="usuari" id="usuari" placeholder="Nom d'usuari" <?php //if(isset($_POST['usuari'])) { echo "value='".$_POST['usuari']."' "; } ?>required></td>
                </tr>
                <tr>
                    <td style="text-align: right;"><label for="contrasenya">Contrasenya </label></td>
                    <td><input type="password" name="contrasenya" id="contrasenya" placeholder="Contrasenya del compte" required></td>
                </tr>
                <tr>
                    <td style="text-align: right;"><label for="recordar-me">Recorda'm </label></td>
                    <td><input type="checkbox" name="checkRecordar" id="recordar-me" <?php //if(isset($_POST['checkRecordar'])) { echo "checked"; } ?>></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><input type="submit" id="connect" value="Connectar" name="connect"></td>
                </tr>
            </table>
        </form>
        <a href="">He oblidat la meva contrasenya</a><br>
    </div>
</div>
<?php include 'footer.tpl.php'; ?>