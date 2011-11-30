<script type="text/javascript">
    $(function() {
        $("button").button();
    });
</script>
<div class="ui-widget-header ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;">
    <p>
        <a href="<?php echo site_url(); ?>">Principal</a>
        <a href="<?php echo site_url('categorias'); ?>">Categorias</a>
        <a href="<?php echo site_url('domain'); ?>">Domínios</a>
        <a href="<?php echo site_url('servidores'); ?>">Servidores</a>
        <a href="<?php echo site_url('urls'); ?>">URLs</a>
    </p>
</div>

<h1>Lista de Domínios</h1>

<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php echo validation_errors(); ?>
        <?php echo form_open('domain/lista'); ?>

        <p>Domínios</p>
        <textarea name="Dominios" rows="20" cols="80"></textarea>

        <p>Categorias</p>
        <select id="categoria" name="NameCategoria">
            <?php foreach ($Categorias as $categoria) {
            ?>
            <?php echo "<option value=\"$categoria->Name\">$categoria->Name</option>"; ?>
            <?php } ?>
        </select>

        <p>
            <button type="submit" value="Enviar">Enviar</button>
            <button type="reset" value="Limpar">Limpar Campos</button>
        </p>

        <?php echo form_close(); ?>
    </div>
</div>