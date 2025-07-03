<?php namespace App\Controllers;

use App\Models\UsuarioModel; // Necesitamos el modelo de usuario para verificar credenciales
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse; // Para el tipo de retorno de redirect()

class Login_controller extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function index()
    {
        helper(['form', 'url']);
        // Carga el servicio de sesión para los mensajes flash (éxito/error)
        $session = \Config\Services::session();
        $data['session'] = $session;

        // Si ya hay un usuario logueado, redirige a su página principal o dashboard
        if ($session->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard')); // O la página principal del usuario
        }

        return view('login/login_form', $data); // Asume una vista en app/Views/login/login_form.php
    }

    /**
     * Procesa la solicitud de login.
     */
    public function authenticate(): RedirectResponse
    {
        helper(['form', 'url']); // Carga helpers

        $usuarioModel = new UsuarioModel();
        $session = \Config\Services::session();

        // Reglas de validación para el formulario de login
        $rules = [
            'email'    => 'required|valid_email',
            'pass'     => 'required|min_length[6]', // La longitud mínima de la contraseña
        ];

        // Mensajes personalizados para la validación
        $messages = [
            'email' => [
                'required'    => 'El campo Email es obligatorio.',
                'valid_email' => 'Por favor, introduce un Email válido.',
            ],
            'pass' => [
                'required'   => 'El campo Contraseña es obligatorio.',
                'min_length' => 'La contraseña debe tener al menos 6 caracteres.',
            ],
        ];

        // Valida los datos del formulario
        if (! $this->validate($rules, $messages)) {
            // Si la validación falla, redirige de vuelta al formulario de login con los errores y los datos antiguos
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Obtener credenciales del formulario
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');

        // Buscar el usuario por email
        $usuario = $usuarioModel->where('email', $email)->first();

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuario && password_verify($password, $usuario['pass'])) {
            // Verificar si el usuario está dado de baja
            if ($usuario['baja'] === 'SI') {
                $session->setFlashdata('error', 'Tu cuenta ha sido dada de baja.');
                return redirect()->to(base_url('login'));
            }

            // Credenciales válidas: Iniciar sesión
            $userData = [
                'id_usuario' => $usuario['id_usuario'],
                'nombre'     => $usuario['nombre'],
                'apellido'   => $usuario['apellido'],
                'usuario'    => $usuario['usuario'],
                'email'      => $usuario['email'],
                'perfil_id'  => $usuario['perfil_id'],
                'isLoggedIn' => true,
            ];
            $session->set($userData); // Guarda los datos del usuario en la sesión

            // Redirigir a una página de dashboard o principal
            return redirect()->to(base_url('dashboard'))->with('success', '¡Bienvenido de nuevo, ' . esc($usuario['nombre']) . '!');
        } else {
            // Credenciales inválidas
            $session->setFlashdata('error', 'Email o contraseña incorrectos.');
            return redirect()->to(base_url('login'))->withInput();
        }
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(): RedirectResponse
    {
        $session = \Config\Services::session();
        $session->destroy(); // Destruye todos los datos de la sesión

        return redirect()->to(base_url('login'))->with('success', 'Sesión cerrada exitosamente.');
    }
}