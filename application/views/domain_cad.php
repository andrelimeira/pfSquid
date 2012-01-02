<script type="text/javascript">
    $(function() {
        $("button").button();
    });
</script> 

<h1>Lista de Domínios</h1>
<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php echo validation_errors(); ?>

        <?php echo form_open('domain/cadastro'); ?>

        <p>Domínio</p>
        <input type="text" name="Dominio" value="" size="50" />

        <p>Categorias</p>
        <select id="categoria" name="NameCategoria">
            <?php
            foreach ($Categorias as $categoria) {
                echo "<option value=\"$categoria->Name\">$categoria->Name</option>";
            }
            ?>
        </select>
        <p>Domínio</p>
        <input type="radio" name="sincro" value="1" checked />Sincronizar no cadastro<br />
        <input type="radio" name="sincro" value="0" />Não sincronizar no cadastro
        <p>
            <button type="submit" value="Enviar">Enviar</button>
            <button type="reset" value="Limpar">Limpar Campos</button>
        </p>
        <?php echo form_close(); ?>

    </div>
</div>