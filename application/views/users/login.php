<?php if (isset($error)) { ?>
        <p><?= $error; ?></p>
    <?php } ?>

    <form method="post" action="<?= site_url('users/login') ?>">
        <label for="username">Usuario:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Iniciar Sesión</button>
		<button><a href="<?php echo site_url('/users/register'); ?>">Registrarse</a></button>
    </form>
