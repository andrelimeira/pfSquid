<script type="text/javascript">
    $(function() {
        $("button").button();
    });
</script> 

<h1>Cadastro de Categoria</h1>

<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php echo validation_errors(); ?>

        <?php echo form_open('categorias/cadastro'); ?>

        <p>Nome (Deve ser idêntico ao Cadastro no PfSense)</p>
        <input type="text" name="Name" value="" size="50" />

        <p>Descrição</p>
        <input type="text" name="Descricao" value="" size="50" />

        <p>
            <button type="submit" value="Enviar">Enviar</button>
            <button type="reset" value="Limpar">Limpar Campos</button>
        </p>

        <?php echo form_close(); ?>
    </div>
</div>