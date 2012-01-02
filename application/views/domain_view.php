<script type="text/javascript">
    $(function() {
        $(".button").button();
        $( "#dialog-confirm" ).hide();

        $("#btn_cad").click(function(){
            window.location="<?php echo site_url('domain/cadastro'); ?>";
        });

        $("#btn_cadlista").click(function(){
            window.location="<?php echo site_url('domain/lista'); ?>";
        });

        $(".btn_excluir").click(function(){
            var url = $(this).attr('dominio');
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
        
    });

</script> 

<!-- Janela confirmação de exclusão -->

<div id="dialog-confirm" title="Confirmação de exclusão">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Tem Certeza?</p>
</div>

<h1>Lista de Domínios</h1>

<form action="<?php echo site_url('domain'); ?>" method="post" name="frm_filtrar">
    <label>Filtro : </label>
    <input type="text" name="Dominio" size="50">
    <select id="Categorias" name="NameCategoria" class="ui-widget ui-widget-content ui-corner-all">
        <option value="">Todas</option>
        <?php
        foreach ($categorias as $categoria) {
            echo sprintf("<option value=\"%s\">%s</option>", $categoria->Name, $categoria->Descricao);
        }
        ?>
    </select>
    <input class="button" type="submit" value="Filtrar" id="btn_filtro">
</form>
<p>
    <input class="button" type="button" id="btn_cad" value="Cadastro">
    <input class="button" type="button" id="btn_cadlista" value="Lista">
</p>
<?php echo $links; ?>

        <table border="1" align="center" cellpadding="5" cellspacing="0" class="ui-widget-content ui-corner-all">
            <tr>
                <td><b>id</b></td>
                <td><b>Domínio</b></td>
                <td><b>Categoria</b></td>
                <td><b>Ações</b></td>
            </tr>
    <?php foreach ($Dominios as $row) {
    ?>
            <tr>
                <td><?php echo $row->idDominio; ?></td>
                <td><?php echo $row->Dominio; ?></td>
                <td><?php echo $row->NameCategoria; ?></td>
                <td>
                    <input class="btn_excluir button" type="button" dominio="<?php echo site_url('domain/excluir/' . $row->idDominio); ?>" value="Excluir">
                </td>
            </tr>
    <?php } ?>
</table>
