<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <style>
        /* Puedes añadir tu propio CSS aquí o enlazar un archivo CSS */
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button.guardar { background-color: #28a745; color: white; }
        button.cancelar { background-color: #dc3545; color: white; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar usuario</h1>

        <?php if (isset($validation)) : ?>
            <div class="error">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('usuarios/guardar') ?>" method="post">
            <?= csrf_field() ?> <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?= old('nombre') ?>">
            <br>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?= old('apellido') ?>">
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="correo@algo.com" value="<?= old('email') ?>">
            <br>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?= old('usuario') ?>">
            <br>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Contraseña (mínimo 6 caracteres)">
            <br>

            <label for="perfil_id">Perfil:</label>
            <select name="perfil_id" id="perfil_id">
                <option value="1" <?= (old('perfil_id') == 1) ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= (old('perfil_id') == 2 || old('perfil_id') == null) ? 'selected' : '' ?>>Cliente</option>
                <?php /*
                <?php if (isset($perfiles) && is_array($perfiles)) : ?>
                    <?php foreach ($perfiles as $perfil) : ?>
                        <option value="<?= esc($perfil['id_perfiles']) ?>"
                            <?= (old('perfil_id') == $perfil['id_perfiles']) ? 'selected' : '' ?>>
                            <?= esc($perfil['descripcion']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
                */ ?>
            </select>
            <br><br>

            <button type="submit" class="guardar">Guardar</button>
            <a href="<?= base_url('/') ?>"><button type="button" class="cancelar">Cancelar</button></a>
        </form>
    </div>
</body>
</html>