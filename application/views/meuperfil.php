<div class="ui-widget-header ui-corner-all" style="margin-top: 20px; padding-top: 0px; padding-right: 0.7em; padding-bottom: 0px; padding-left: 0.7em;">
    <p>
        <a href="<?php echo site_url(); ?>">Principal</a>
        <a href="<?php echo site_url('categorias'); ?>">Categorias</a>
        <a href="<?php echo site_url('domain'); ?>">Domínios</a>
        <a href="<?php echo site_url('servidores'); ?>">Servidores</a>
        <a href="<?php echo site_url('urls'); ?>">URLs</a>
    </p>
</div>

<h1>PfSquid - Meu Perfil</h1>

<p>Nome: <b><?php echo $Name; ?></b><br />
    Nome de usuário: <b><?php echo $username; ?></b></p>

<hr>

<?php if(!empty($msg)) { ?>
<p>
	<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
	<strong>Alerta:</strong><?php echo $msg; ?>
</p>
<?php } ?>

<form action="<?php echo site_url('auth/perfil'); ?>" method="post">
    <h3>Mudar a Senha</h3>
    <p>
        Senha atual :<br />
        <input type="password" name="old_password" size="50">
    </p>
    <p>
        Nova Senha :<br />
        <input type="password" name="new_password" size="50">
    </p>
    <p>
        Repita a nova senha:<br />
        <input type="password" name="new_password2" size="50">
    </p>
    <input type="submit" value="Mudar Senha">
</form>