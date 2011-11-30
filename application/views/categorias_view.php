<script type="text/javascript">
    $(function() {
        $(".button").button();
        $(".btn_sincronizar").button();
        $(".btn_excluir").button();
        $("#sincro").hide();
        $( "#dialog-confirm" ).hide();

        $(".btn_sincronizar").click(function(){
            $("#inputcategoria").val($(this).attr('categoria'));
            $("#sincro").dialog({
                title: 'Sincronizar',
                resizable: false
            });
        });

        $(".btn_excluir").click(function(){
            var url = $(this).attr('categoria');
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                modal: true,
                buttons: {
                    "Excluir": function() {
                        window.location=url;
                        $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });

        $("#all").change(function(){
            if (this.checked) {
                $(".chkServidores").attr({ checked: true });
            } else {
                $(".chkServidores").attr({ checked: false });
            }
        });

        $("#sincronize").click(function(){
            $("#frmsincro").submit();
        });

        $("#btn_cad").click(function(){
            window.location="<?php echo site_url('categorias/cadastro'); ?>";
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

<h1>Lista de Categorias</h1>

<p><input class="button" id="btn_cad" value="Cadastro"></p>

<?php echo $links; ?>

<!-- Janela confirmação de Sincronização -->

<div id="sincro">
    <form action="<?php echo site_url('categorias/sincro'); ?>" method="post" id="frmsincro">
        <input type="hidden" id="inputcategoria" name="categoria" value="" />
        <table class="ui-widget-content ui-corner-all">
            <tr>
                <td><input type="checkbox" id="all" name="all" /></td>
                <td><b>Servidores</b></td>
            </tr>
            <?php foreach ($servidores as $row) {
            ?>
                <tr>
                    <td><input class="chkServidores" type="checkbox" name="<?php echo $row->idServidor; ?>" /></td>
                    <td><?php echo $row->Local; ?></td>
                </tr>
            <?php } ?>
        </table>
        <br />
        <input class="button" type="button" id="sincronize" name="sincronize" value="Sincronizar">
    </form>
</div>

<!-- Janela confirmação de exclusão -->

<div id="dialog-confirm" title="Confirmação de exclusão">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Tem Certeza?</p>
</div>

<table class="ui-widget-content ui-corner-all">
    <tr>
        <td align="center"><b>Nome</b></td>
        <td align="center"><b>Categoria</b></td>
        <td align="center"><b>Ações</b></td>
    </tr>
    <?php foreach ($Categorias as $row) {
    ?>
                <tr>
                    <td><?php echo $row->Name; ?></td>
                    <td><?php echo $row->Descricao; ?></td>
                    <td>
                        <input class="btn_excluir" categoria="<?php echo site_url('categorias/excluir/' . $row->Name); ?>" value="Excluir">
                        <input class="btn_sincronizar" categoria="<?php echo $row->Name; ?>" value="Sincronizar">
                    </td>
                </tr>
    <?php } ?>

</table>
