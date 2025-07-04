<?php if (isset($error)) { ?>
        <p><?= $error; ?></p>
    <?php } ?>
	
<form method="post" action="<?= site_url('users/register') ?>">

		<label for="username">Nombre completo:</label><br>
        <input type="text" name="fullname" required><br><br>

        <label for="username">Usuario:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

		<label for="password">Contraseña:</label><br>
        <input type="password" name="password_repeat" required><br><br>

        <button type="submit">Registrar</button>
    </form>
