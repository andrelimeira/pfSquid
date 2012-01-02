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

<h1>Edição de Servidor</h1>

<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php
        echo form_open('servidores/atualizar');
        echo form_hidden('idServidor', $idServidor);
        echo "<p>Hostname: <br>" . form_input($hostname) . "</p>";
        echo "<p>URL Servidor: <br>" . form_input($url) . "</p>";
        echo "<p>Senha: <br>" . form_input($password) . "</p>";
        echo "<p>Local: <br>" . form_input($local) . "</p>";
        echo "<p>Observação: <br>" . form_input($observacao) . "</p>";
        // TODO colocar javascript para mudar descrição qdo for clicado o Status
        echo "<p>Status: <br>" . form_checkbox($status) . $status_label;
        ?>
        <p>
            <button type="submit" value="mysubmit">Atualizar</button>
        </p>
        <?php
        echo form_close();
        ?>
    </div>
</div>