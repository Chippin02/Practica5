<div id="aside">
    <?php if($this -> request -> getController() == 'inventory') { ?>
        <form action="/inventory/post" method="post"><input type="submit" value="Publicar nova oferta" name="publicar"></form>
    <?php } ?>
    <h3>Filtra el contingut</h3>
    <form action="/inventory/filter" method="post">
        <table style="border-spacing: 5px;">
            <tr>
                <td style="text-align: right;">Tipus d'oferta </td>
                <td colspan="2">
                    <select name="id_offerttype" id="id_offerttype">
                        <option value="0" <?php if(isset($_POST['id_offerttype']) && $_POST['id_offerttype'] == 0) { echo "selected"; } ?>>- Tipus d'oferta -</option>
                        <option value="1" <?php if(isset($_POST['id_offerttype']) && $_POST['id_offerttype'] == 1) { echo "selected"; } ?>>Venda</option>
                        <option value="2" <?php if(isset($_POST['id_offerttype']) && $_POST['id_offerttype'] == 2) { echo "selected"; } ?>>Lloguer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Tipus de vivenda </td>
                <td colspan="2">
                    <select name="id_producttype" id="id_producttype">
                        <option value="0" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 0) { echo "selected"; } ?>>- Tipus de vivenda -</option>
                        <option value="1" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 1) { echo "selected"; } ?>>Casa</option>
                        <option value="2" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 2) { echo "selected"; } ?>>Pis</option>
                        <option value="3" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 3) { echo "selected"; } ?>>Habitació</option>
                        <option value="4" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 4) { echo "selected"; } ?>>Estudi</option>
                        <option value="5" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 5) { echo "selected"; } ?>>Local</option>
                        <option value="6" <?php if(isset($_POST['id_producttype']) && $_POST['id_producttype'] == 6) { echo "selected"; } ?>>Plaça de parking</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="name">Nom de la oferta </label></td>
                <td colspan="2"><input type="text" name="name" id="name" placeholder="Nom de la oferta" <?php if(isset($_POST['name'])) { echo "value='".$_POST['name']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="filtre_price">Preu de la oferta </label></td>
                <td>
                    <select name="filtre_price" id="filtre_price">
                        <option value=">" <?php if(isset($_POST['filtre_price']) && $_POST['filtre_price'] == 1) { echo "selected"; } ?>>> x</option>
                        <option value=">=" <?php if(isset($_POST['filtre_price']) && $_POST['filtre_price'] == 2) { echo "selected"; } ?>>>= x</option>
                        <option value="=" <?php if(isset($_POST['filtre_price']) && $_POST['filtre_price'] == 3) { echo "selected"; } ?>>= x</option>
                        <option value="<=" <?php if(isset($_POST['filtre_price']) && $_POST['filtre_price'] == 4) { echo "selected"; } ?>><= x</option>
                        <option value="<" <?php if(isset($_POST['filtre_price']) && $_POST['filtre_price'] == 5) { echo "selected"; } ?>>< x</option>
                    </select>
                </td>
                <td><input type="number" min="0" step="0.01" name="price" id="price" placeholder="Preu de la oferta" <?php if(isset($_POST['price'])) { echo "value='".$_POST['price']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="m2">m2 </label></td>
                <td>
                    <select name="filtre_m2" id="filtre_m2">
                        <option value=">" <?php if(isset($_POST['filtre_m2']) && $_POST['filtre_m2'] == 1) { echo "selected"; } ?>>> x</option>
                        <option value=">=" <?php if(isset($_POST['filtre_m2']) && $_POST['filtre_m2'] == 2) { echo "selected"; } ?>>>= x</option>
                        <option value="=" <?php if(isset($_POST['filtre_m2']) && $_POST['filtre_m2'] == 3) { echo "selected"; } ?>>= x</option>
                        <option value="<=" <?php if(isset($_POST['filtre_m2']) && $_POST['filtre_m2'] == 4) { echo "selected"; } ?>><= x</option>
                        <option value="<" <?php if(isset($_POST['filtre_m2']) && $_POST['filtre_m2'] == 5) { echo "selected"; } ?>>< x</option>
                    </select>
                </td>
                <td colspan="2"><input type="number" min="0" step="0.01" name="m2" id="m2" placeholder="m2 de la oferta" <?php if(isset($_POST['m2'])) { echo "value='".$_POST['m2']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="addres">Direcció de la oferta </label></td>
                <td colspan="2"><input type="text" name="addres" id="addres" placeholder="Direccio de la oferta" <?php if(isset($_POST['addres'])) { echo "value='".$_POST['addres']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="zipcode">Codi Postal de la oferta </label></td>
                <td colspan="2"><input type="number" min="00000" max="99999" step="1" name="zipcode" id="zipcode" placeholder="Codi Postal de la oferta" <?php if(isset($_POST['cp'])) { echo "value='".$_POST['cp']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="city">Ciutat de la oferta </label></td>
                <td colspan="2"><input type="text" name="city" id="city" placeholder="Ciutat de la oferta" <?php if(isset($_POST['city'])) { echo "value='".$_POST['city']."' "; } ?>></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="state">Provincia de la oferta </label></td>
                <td colspan="2"><input type="text" name="state" id="state" placeholder="Provincia de la oferta" <?php if(isset($_POST['state'])) { echo "value='".$_POST['state']."' "; } ?>></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;"><input type="submit" id="filtrar" value="Filtrar" name="Filtrar"></td>
            </tr>
            <input type="hidden" value="<?php echo $this->request->getController(); ?>" name="origen">
        </table>
    </form>
</div>