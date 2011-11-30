<script type="text/javascript">
    $(function() {
        $("button").button();

        $("#btn_cad").click(function(){
            window.location="<?php echo site_url('servidores/cadastro'); ?>";
        });
        
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

<br />

<button id="btn_cad">Cadastro</button>

<?php echo $links; ?>

<table border="1" align="center" cellpadding="5" cellspacing="0" class="ui-widget-content ui-corner-all">
    <tr>
        <td><b>id</b></td>
        <td><b>Status</b></td>
        <td><b>URL</b></td>
        <td><b>Local</b></td>
        <td><b>Observação</b></td>
        <td><b>Ações</b></td>
    </tr>
    <?php foreach ($Servidores as $row) {
 ?>
        <tr>
            <td><?php echo $row->idServidor; ?></td>
            <td><?php if ($row->Status) {
            echo "Ativo";
        } else {
            echo "Desativado";
        } ?></td>
            <td><?php echo $row->URL; ?></td>
            <td><?php echo $row->Local; ?></td>
            <td><?php echo $row->Observacao; ?></td>
            <td>
                <button><a href="<?php echo site_url('servidores/detalhes/' . $row->idServidor); ?>">Detalhes</a></button>
                <button><a href="<?php echo site_url('servidores/editar/' . $row->idServidor); ?>">Editar</a></button>
                <button><a href="<?php echo site_url('servidores/excluir/' . $row->idServidor); ?>">Excluir</a></button>
            </td>
        </tr>
<?php } ?>
</table>
