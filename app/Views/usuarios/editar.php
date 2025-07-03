<!-- app/Views/usuarios/editar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        /* Estilos básicos para el formulario */
        body { font-family: 'Inter', sans-serif; margin: 20px; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container {
            background-color: #ffffff;
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 90%; /* Responsive width */
        }
        h1 { text-align: center; color: #333; margin-bottom: 25px; font-size: 2em; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 22px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }
        button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            margin-right: 15px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        button.actualizar { background-color: #007bff; color: white; }
        button.volver { background-color: #6c757d; color: white; }
        button:hover { transform: translateY(-2px); }
        button.actualizar:hover { background-color: #0056b3; }
        button.volver:hover { background-color: #5a6268; }
        .error { color: #dc3545; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; padding: 15px; margin-bottom: 25px; font-size: 0.95em; line-height: 1.5; }
        .error ul { list-style-type: none; padding: 0; margin: 0; }
        .error li { margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuario: <?= esc($usuario['usuario'] ?? 'N/A') ?></h1>

        <?php if (isset($validation)) : ?>
            <div class="error">
                <ul>
                <?php foreach ($validation->getErrors() as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('usuarios/actualizar/' . ($usuario['id_usuario'] ?? '')) ?>" method="post">
            <?= csrf_field() ?> <!-- Protección CSRF -->

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= old('nombre', $usuario['nombre'] ?? '') ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="<?= old('apellido', $usuario['apellido'] ?? '') ?>" required>

            <label for="usuario_input">Usuario:</label>
            <input type="text" name="usuario" id="usuario_input" value="<?= old('usuario', $usuario['usuario'] ?? '') ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= old('email', $usuario['email'] ?? '') ?>" required>

            <label for="pass">Nueva Contraseña (dejar en blanco para no cambiar):</label>
            <input type="password" name="pass" id="pass">

            <label for="perfil_id">Perfil:</label>
            <select name="perfil_id" id="perfil_id">
                <!-- Por simplicidad, se asumen los IDs 1 y 2 para perfiles.
                     Si pasas $perfiles desde el controlador, descomenta el bloque PHP de abajo. -->
                <option value="1" <?= (old('perfil_id', $usuario['perfil_id'] ?? '') == 1) ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= (old('perfil_id', $usuario['perfil_id'] ?? '') == 2) ? 'selected' : '' ?>>Cliente</option>
                <?php /*
                <?php if (isset($perfiles) && is_array($perfiles)) : ?>
                    <?php foreach ($perfiles as $perfil) : ?>
                        <option value="<?= esc($perfil['id_perfiles']) ?>"
                            <?= (old('perfil_id', $usuario['perfil_id'] ?? '') == $perfil['id_perfiles']) ? 'selected' : '' ?>>
                            <?= esc($perfil['descripcion']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
                */ ?>
            </select>
            <br><br>

            <button type="submit" class="actualizar">Actualizar Usuario</button>
            <a href="<?= base_url('usuarios') ?>"><button type="button" class="volver">Volver a la lista</button></a>
        </form>
    </div>
</body>
</html>
