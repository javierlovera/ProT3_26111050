<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="email"], input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background-color: #0056b3; }
        .message.success { color: green; margin-bottom: 10px; }
        .message.error { color: red; margin-bottom: 10px; }
        .error-list { color: red; margin-bottom: 10px; }
        p { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="message success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="message error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)) : ?>
            <div class="error-list">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/authenticate') ?>" method="post">
            <?= csrf_field() ?> <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>" required>
            <br>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" required>
            <br>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <p>¿No tienes cuenta? <a href="<?= base_url('registro') ?>">Regístrate aquí</a></p>
    </div>
</body>
</html>