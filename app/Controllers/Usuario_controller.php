<?php namespace App\Controllers; // IMPORTANTE: Define el namespace si está dentro de App\Controllers

use App\Models\UsuarioModel; // Importa tu modelo de usuario
use CodeIgniter\Controller; // O extiende de BaseController si ya lo tienes en tu app

// Si extiendes de BaseController, asegúrate de que BaseController.php exista en app/Controllers
// class Usuario_controller extends BaseController
class Usuario_controller extends Controller // Si no usas BaseController, extiende de Controller directamente
{
    public function index()
    {
        // 1. Instanciar el modelo directamente
        $usuarioModel = new UsuarioModel();

        // 2. Llamar al método del modelo
        // Asumo que 'getUsuario' es un método que tú has definido en UsuarioModel.
        // Si no existe, tendrías que definirlo o usar los métodos integrados del modelo (find, where, first, etc.)
        // Ejemplo: Si getUsuario(1) trae el usuario con id=1
        $usuario = $usuarioModel->find(1); // Esto es lo estándar en CI4 para buscar por PK

        // Si getUsuario() es un método personalizado, el modelo debería tener algo como:
        /*
        // En app/Models/UsuarioModel.php
        public function getUsuario($id)
        {
            return $this->find($id); // O una consulta más compleja
        }
        */

        $data['usuario'] = $usuario; // Prepara los datos para la vista

        // 3. Cargar la vista usando la función view() de CI4
        return view('principal', $data);
    }
}