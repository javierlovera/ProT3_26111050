<?php namespace App\Controllers;

use App\Models\PerfilModel; // Importamos el modelo de Perfil
use CodeIgniter\Controller; // O extiende de BaseController

class PerfilController extends Controller // O 'extends BaseController'
{
    /**
     * Muestra la lista de todos los perfiles.
     */
    public function index()
    {
        $perfilModel = new PerfilModel();
        $data['perfiles'] = $perfilModel->findAll(); // Obtiene todos los registros de la tabla 'perfiles'

        return view('perfiles/lista', $data); // Asume que tienes una vista en app/Views/perfiles/lista.php
    }

    /**
     * Muestra el formulario para crear un nuevo perfil.
     */
    public function create()
    {
        // Puedes pasar datos para los errores de validación si el formulario se envía al mismo método
        $data['validation'] = \Config\Services::validation(); // Carga el servicio de validación
        return view('perfiles/crear', $data); // Asume una vista en app/Views/perfiles/crear.php
    }

    /**
     * Guarda un nuevo perfil en la base de datos.
     */
    public function store()
    {
        helper(['form', 'url']); // Carga los helpers si no están ya en autoload.php

        $perfilModel = new PerfilModel();

        // Validar los datos del formulario (las reglas están en PerfilModel.php)
        if ($this->request->getMethod() === 'post' && $perfilModel->validate($this->request->getPost())) {
            // Guardar los datos en la base de datos
            $perfilModel->save([
                'descripcion' => $this->request->getPost('descripcion')
            ]);

            // Redirigir con un mensaje de éxito
            return redirect()->to(base_url('perfiles'))->with('success', 'Perfil creado exitosamente.');
        } else {
            // Si la validación falla, regresa al formulario con los errores y los datos antiguos
            $data['validation'] = $perfilModel->validator;
            $data['oldInput'] = $this->request->getPost(); // Para rellenar el formulario
            return view('perfiles/crear', $data);
        }
    }

    /**
     * Muestra el formulario para editar un perfil existente.
     * @param int $id El ID del perfil a editar.
     */
    public function edit($id = null)
    {
        $perfilModel = new PerfilModel();
        $perfil = $perfilModel->find($id); // Busca el perfil por su ID

        if (empty($perfil)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el perfil con ID: ' . $id);
        }

        $data['perfil'] = $perfil;
        $data['validation'] = \Config\Services::validation();
        return view('perfiles/editar', $data); // Asume una vista en app/Views/perfiles/editar.php
    }

    /**
     * Actualiza un perfil existente en la base de datos.
     * @param int $id El ID del perfil a actualizar.
     */
    public function update($id = null)
    {
        helper(['form', 'url']);

        $perfilModel = new PerfilModel();

        // Obtener el perfil existente para validación de unicidad, etc.
        $perfilExistente = $perfilModel->find($id);

        if (empty($perfilExistente)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el perfil con ID: ' . $id);
        }

        // Reglas de validación, ajustando para 'is_unique' en caso de edición
        $rules = [
            'descripcion' => 'required|min_length[3]|max_length[50]',
        ];
        if ($this->request->getPost('descripcion') !== $perfilExistente['descripcion']) {
            $rules['descripcion'] .= '|is_unique[perfiles.descripcion]';
        }

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {
            $perfilModel->update($id, [
                'descripcion' => $this->request->getPost('descripcion')
            ]);

            return redirect()->to(base_url('perfiles'))->with('success', 'Perfil actualizado exitosamente.');
        } else {
            $data['validation'] = $this->validator;
            $data['perfil'] = $this->request->getPost(); // Mantener los datos enviados
            return view('perfiles/editar', $data);
        }
    }

    /**
     * Elimina un perfil de la base de datos.
     * @param int $id El ID del perfil a eliminar.
     */
    public function delete($id = null)
    {
        $perfilModel = new PerfilModel();
        $perfil = $perfilModel->find($id);

        if (empty($perfil)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el perfil con ID: ' . $id);
        }

        // Antes de eliminar, podrías querer verificar si algún usuario está asociado a este perfil
        // Si hay usuarios, podrías impedirlo o reasignarlos.
        // Ejemplo:
        // $usuarioModel = new \App\Models\UsuarioModel();
        // if ($usuarioModel->where('perfil_id', $id)->countAllResults() > 0) {
        //     return redirect()->to(base_url('perfiles'))->with('error', 'No se puede eliminar el perfil porque tiene usuarios asociados.');
        // }

        $perfilModel->delete($id);

        return redirect()->to(base_url('perfiles'))->with('success', 'Perfil eliminado exitosamente.');
    }
}