<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // Nombre de la tabla a la que este modelo está asociado
    protected $table      = 'usuarios';

    // Nombre de la clave primaria de la tabla
    protected $primaryKey = 'id_usuario';

    // Si la clave primaria es auto-incremental
    protected $useAutoIncrement = true;

    // Tipo de retorno para los métodos find (array o object)
    protected $returnType     = 'array'; // Puedes cambiar a 'object' si prefieres objetos

    // Si se utilizan "soft deletes" (borrado lógico en lugar de físico)
    // Tu columna 'baja' podría usarse para esto, pero dado que es VARCHAR(2)
    // y tiene 'NO' por defecto, no activaremos useSoftDeletes automáticamente.
    // Si quieres usarlo, la columna debería ser DATETIME o TIMESTAMP y null por defecto.
    protected $useSoftDeletes = false; // Cambia a true si implementas borrado suave con una columna de fecha

    // Campos que están permitidos para ser insertados o actualizados
    // Asegúrate de incluir todos los campos que tu formulario o lógica de negocio enviará
    protected $allowedFields = ['nombre', 'apellido', 'usuario', 'email', 'pass', 'perfil_id', 'baja'];

    // --- Configuración de Fechas (Timestamps) ---
    // Si tu tabla NO tiene columnas 'created_at' y 'updated_at' (o similares),
    // déjalo en false. Si las tiene, actívalo y configura los nombres de los campos.
    protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at'; // Si usas soft deletes

    // --- Reglas de Validación (Opcional pero muy recomendable) ---
    // Aquí puedes definir reglas para validar los datos antes de guardarlos
    protected $validationRules = [
        'nombre'    => 'required|min_length[3]|max_length[50]',
        'apellido'  => 'required|min_length[3]|max_length[50]',
        'usuario'   => 'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]', // 'is_unique[tabla.campo]'
        'email'     => 'required|max_length[100]|valid_email|is_unique[usuarios.email]',
        'pass'      => 'required|min_length[6]|max_length[100]',
        'perfil_id' => 'permit_empty|integer', // 'permit_empty' si tiene un valor por defecto
        'baja'      => 'permit_empty|in_list[SI,NO]' // Asegúrate que solo acepte 'SI' o 'NO'
    ];

    // Mensajes de error personalizados para las reglas de validación
    protected $validationMessages = [
        'usuario' => [
            'is_unique' => 'Este nombre de usuario ya está registrado.'
        ],
        'email' => [
            'is_unique' => 'Este correo electrónico ya está registrado.',
            'valid_email' => 'Por favor, introduce un correo electrónico válido.'
        ],
        'pass' => [
            'min_length' => 'La contraseña debe tener al menos 6 caracteres.'
        ]
    ];

    protected $skipValidation       = false; // Si es true, las reglas de validación se ignorarán
    protected $cleanValidationRules = true; // Limpia las reglas después de la validación

    // --- Callbacks (Opcional) ---
    // Métodos que se ejecutan antes/después de insertar, actualizar, etc.
    // Muy útil para encriptar contraseñas antes de guardarlas.
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Función para encriptar la contraseña
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['pass'])) {
            $data['data']['pass'] = password_hash($data['data']['pass'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}