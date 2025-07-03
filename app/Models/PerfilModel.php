<?php namespace App\Controllers;

use App\Models\PerfilModel; // Importa el modelo PerfilModel

class AlgunaParteDeTuApp extends BaseController // O tu controlador Home, si manejas perfiles allí
{
    public function crearPerfil()
    {
        helper(['form', 'url']);

        $perfilModel = new PerfilModel();

        if ($this->request->getMethod() === 'post' && $perfilModel->validate($this->request->getPost())) {
            $perfilModel->save([
                'descripcion' => $this->request->getPost('descripcion')
            ]);

            return redirect()->to(base_url('/perfiles'))->with('success', 'Perfil creado con éxito!');
        } else {
            $data['validation'] = $perfilModel->validator;
            return view('perfiles/crear', $data); // Asumiendo una vista para crear perfiles
        }
    }

    public function listarPerfiles()
    {
        $perfilModel = new PerfilModel();
        $data['perfiles'] = $perfilModel->findAll(); // Obtiene todos los perfiles

        return view('perfiles/lista', $data); // Asumiendo una vista para listar perfiles
    }
}