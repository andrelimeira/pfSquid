<script type="text/javascript">
    $(function() {
        $("button").button();

        $("#btn_cad").click(function(){
            window.location="<?php echo site_url('servidores/cadastro'); ?>";
        });

        $(".btn_editar").click(function(){
            window.location=$(this).attr('id');
        });

        $(".btn_excluir").click(function(){
        	// TODO criar código de confirmação
        	// window.location=$(this).attr('id');
        });
        
    });
</script>

<h1>Lista de Servidores</h1>

<br />

<button id="btn_cad">Cadastro</button>

<?php echo $links; ?>

<table class="ui-widget-content ui-corner-all">
    <tr>
        <td><b>id</b></td>
        <td><b>Status</b></td>
        <td><b>IP</b></td>
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
            <td><?php echo $row->IP; ?></td>
            <td><?php echo $row->Local; ?></td>
            <td><?php echo $row->Observacao; ?></td>
            <td>
                <button class="btn_editar" id="<?php echo site_url('servidores/editar/' . $row->idServidor); ?>">Editar</button>
                <button class="btn_excluir" id="<?php echo site_url('servidores/excluir/' . $row->idServidor); ?>">Excluir</button>
            </td>
        </tr>
<?php } ?>
</table>
