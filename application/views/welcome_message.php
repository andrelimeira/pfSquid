<h1>PfSquid!</h1>

<h3>Servidores</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
    <?php
	foreach ($servidores as $row) {
        foreach ($row as $servidor) {
            echo sprintf("<td><a href=\"%s/%s\"><img src=\"images/servidor.png\" width=70 heigh=70><br />%s</a><br></td>", site_url("servidores/editar/"), $servidor->idServidor, $servidor->hostname);
        }
    }
    ?>
    </tr>
</table>

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