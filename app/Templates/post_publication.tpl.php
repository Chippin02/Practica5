<?php include 'header.tpl.php'; ?>
    <div id="body-form">
        <div id="caja">
            <div><h3><?php echo $title; ?></h3></div>
            <?php if (isset($error)) { include 'error.tpl.php'; } ?>
            <form action="/inventory/published" method="post">
                <table style="border-spacing: 5px;">
                    <tr>
                        <td style="text-align: right;">Tipus d'oferta </td>
                        <td>
                            <select name="oferta" id="oferta">
                                <option value="1" <?php if(isset($_POST['oferta']) && $_POST['oferta'] == 1) { echo "selected"; } ?>>Venda</option>
                                <option value="2" <?php if(isset($_POST['oferta']) && $_POST['oferta'] == 2) { echo "selected"; } ?>>Lloguer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Tipus de vivenda </td>
                        <td>
                            <select name="tipus" id="tipus">
                                <option value="1" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 2) { echo "selected"; } ?>>Casa</option>
                                <option value="2" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 2) { echo "selected"; } ?>>Pis</option>
                                <option value="3" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 3) { echo "selected"; } ?>>Habitació</option>
                                <option value="4" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 4) { echo "selected"; } ?>>Estudi</option>
                                <option value="5" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 5) { echo "selected"; } ?>>Local</option>
                                <option value="6" <?php if(isset($_POST['tipus']) && $_POST['tipus'] == 6) { echo "selected"; } ?>>Plaça de parking</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="name">Nom </label></td>
                        <td><input type="text" name="name" id="name" placeholder="Nom de la publicació" <?php if(isset($_POST['name'])) { echo "value='".$_POST['name']."' "; } ?>required></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="preu">Preu </label></td>
                        <td><input type="number" min="0.00" step="0.01" style="height: 20px;" name="preu" id="preu"  <?php if(isset($_POST['preu'])) { echo "value='".$_POST['preu']."' "; } ?> placeholder="Preu de la oferta" required></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="descripcio">Text descriptiu </label></td>
                        <td><textarea name="descripcio" id="descripcio" rows="6" cols="50" placeholder="Descripció del producte" <?php if(isset($_POST['descripcio'])) { echo "value='".$_POST['descripcio']."' "; } ?>required></textarea></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="m2">M2 </label></td>
                        <td><input type="number" min="0.00" step="0.01" style="height: 20px;" name="m2" id="m2" <?php if(isset($_POST['m2'])) { echo "value='".$_POST['m2']."' "; } ?> placeholder="Metres cuadrats de la vivenda"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="direccio">Direcció </label></td>
                        <td><input type="text" name="direccio" id="direccio" placeholder="Direcció de la vivenda" <?php if(isset($_POST['direccio'])) { echo "value='".$_POST['direccio']."' "; } ?>required></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="cp">Codi Postal </label></td>
                        <td><input type="text" name="cp" id="cp" placeholder="Codi Postal de la vivenda" <?php if(isset($_POST['cp'])) { echo "value='".$_POST['cp']."' "; } ?>required></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="ciutat">Ciutat </label></td>
                        <td><input type="text" name="ciutat" id="ciutat" <?php if(isset($_POST['ciutat'])) { echo "value='".$_POST['ciutat']."' "; } ?>placeholder="Ciutat de la vivenda"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label for="provincia">Provincia </label></td>
                        <td><input type="text" name="provincia" id="provincia" placeholder="Provincia de la vivenda" <?php if(isset($_POST['provincia'])) { echo "value='".$_POST['provincia']."' "; } ?>required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" id="publicar" value="Publicar oferta" name="publicar"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php include 'footer.tpl.php'; ?>