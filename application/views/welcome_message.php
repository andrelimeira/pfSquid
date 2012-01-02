<div class="ui-widget-header ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;">
    <p>
        <a href="<?php echo site_url(); ?>">Principal</a>
        <a href="<?php echo site_url('categorias'); ?>">Categorias</a>
        <a href="<?php echo site_url('domain'); ?>">Domínios</a>
        <a href="<?php echo site_url('servidores'); ?>">Servidores</a>
        <a href="<?php echo site_url('urls'); ?>">URLs</a>
    </p>
</div>

<h1>PfSquid!</h1>

<br />

<table border="1" cellspacing="0" cellpadding="5">
    <tr class="ui-state-highlight"><td><b>Categorias</b></td><td><b>Domínios</b></td></tr>
    <?php
    foreach ($categorias as $row) {
        foreach ($row as $categoria) {
            echo sprintf("<tr><td>%s</td><td>%s</td></tr>", $categoria->Descricao, $categoria->total);
        }
    }
    ?>
</table>
<h3>Servidores</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
    <?php
	foreach ($servidores as $row) {
        foreach ($row as $servidor) {
            echo sprintf("<td><a href=\"%s/%s\"><img src=\"images/servidor.png\"><br />%s</a></td>", site_url("servidores/editar/"), $servidor->idServidor, $servidor->hostname);
        }
    }
    ?>
    </tr>
</table>