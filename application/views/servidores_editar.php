<script type="text/javascript">
    $(function() {
        $("button").button();
    });
</script>

<h1>Edição de Servidor</h1>

<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em; ">
        <?php
        echo form_open('servidores/atualizar');
        echo form_hidden('idServidor', $idServidor);
        echo "<p>Hostname: <br>" . form_input($hostname) . "</p>";
        echo "<p>IP: <br>" . form_input($IP) . "</p>";
		echo "<p>Nome de Usuário: <br>" . form_input($username) . "</p>";
        echo "<p>Senha: <br>" . form_password($password) . "</p>";
        echo "<p>Local: <br>" . form_input($local) . "</p>";
        echo "<p>Observação: <br>" . form_input($observacao) . "</p>";
        // TODO colocar javascript para mudar descrição qdo for clicado o Status
         echo "<p>Status: " . form_checkbox($status);
		if($status['value'] == 1) {
			// se está ativo
			 echo "<small>(Ativado)</small>";
		} else {
			// senão
			echo "<small>(Desativado)</small>";
		}
        ?>
        <p>
            <button type="submit" value="mysubmit">Atualizar</button>
        </p>
        <?php
        echo form_close();
        ?>
    </div>
</div>