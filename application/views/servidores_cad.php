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

<h1>Lista de Servidores</h1>

<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php echo validation_errors(); ?>

        <?php echo form_open('servidores/cadastro'); ?>

        <p>Hostname</p>
        <input type="text" name="hostname" value="" size="25" />
        <p>URL de acesso</p>
        <input type="text" name="URL" value="" size="50" />
        <p>Senha</p>
        <input type="password" name="password" value="" size="50" />
        <p>Localização</p>
        <input type="text" name="Local" value="" size="50" />
        <p>Observação</p>
        <input type="text" name="Observacao" value="" size="50" />
        <p>
            <button type="submit" value="Enviar">Enviar</button>
            <button type="reset" value="Limpar">Limpar Campos</button>
        </p>

        <?php echo form_close(); ?>
    </div>
</div>