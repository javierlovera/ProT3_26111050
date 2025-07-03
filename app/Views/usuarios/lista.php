<!-- app/Views/usuarios/lista.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        /* Estilos básicos para la lista */
        body { font-family: 'Inter', sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container {
            background-color: #ffffff;
            max-width: 1000px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 95%; /* Responsive width */
            overflow-x: auto; /* Para tablas grandes en móviles */
        }
        h1 { text-align: center; color: #333; margin-bottom: 25px; font-size: 2.2em; }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1.05em;
        }
        .message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .action-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-size: 1em;
        }
        .action-button:hover { background-color: #0056b3; transform: translateY(-2px); }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden; /* Para que los bordes redondeados se apliquen a la tabla */
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
            font-size: 0.9em;
        }
        tbody tr:nth-child(even) { background-color: #f9f9f9; }
        tbody tr:hover { background-color: #f1f1f1; }
        td a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        td a:hover { color: #0056b3; text-decoration: underline; }
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            font-weight: bold;
            display: inline-block;
        }
        .status-active { background-color: #d4edda; color: #155724; }
        .status-baja { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="message success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="message error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <a href="<?= base_url('registro') ?>" class="action-button">Crear Nuevo Usuario</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Perfil ID</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($usuarios) && is_array($usuarios)) : ?>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?= esc($usuario['id_usuario']) ?></td>
                            <td><?= esc($usuario['nombre']) ?></td>
                            <td><?= esc($usuario['apellido']) ?></td>
                            <td><?= esc($usuario['usuario']) ?></td>
                            <td><?= esc($usuario['email']) ?></td>
                            <td><?= esc($usuario['perfil_id']) ?></td>
                            <td>
                                <?php if ($usuario['baja'] === 'NO') : ?>
                                    <span class="status-badge status-active">Activo</span>
                                <?php else : ?>
                                    <span class="status-badge status-baja">Baja</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('usuarios/editar/' . $usuario['id_usuario']) ?>">Editar</a>
                                <?php if ($usuario['baja'] === 'NO') : ?>
                                    | <a href="<?= base_url('usuarios/eliminar/' . $usuario['id_usuario']) ?>" onclick="return confirm('¿Estás seguro de que quieres dar de baja a este usuario? Esta acción es irreversible.');">Dar de Baja</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px;">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>