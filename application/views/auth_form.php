<script type="text/javascript">
    $(function() {
        $("button").button();
    });
</script> 

<h1 align="center">Autentica&ccedil;&atilde;o</h1>

<div class="ui-widget" style="width:300px;margin: 0px auto">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php
        echo form_open('auth/login');
        echo "<p>Nome de Usuário: <br>" . form_input($username) . "</p>";
        echo "<p>Senha: <br>" . form_password($password) . "</p>";
        ?>
        <p>
        <button type="submit" value="Enviar">Enviar</button>
        <button type="reset" value="Limpar">Limpar Campos</button>
        </p>
        <?php
        echo form_close();
        ?>
    </div>
</div>