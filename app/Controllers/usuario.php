<?php

namespace App\Controllers;

use Exception;

class usuario extends BaseController
{
	protected $helpers = ['funcoes'];
	private $usuarioModel;

	function __construct()
	{
		$this->usuarioModel = new \App\Models\usuarioModel();
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		Header('Access-Control-Allow-Methods: GET, POST');
	}

	public function index()
	{
		try {
			$usuarios =  $this->usuarioModel->listarUsuarios();
			foreach ($usuarios as $usuario) {
				if ($usuario->senha != null || $usuario->senha  != "")
					$usuario->senha = "Sim";
				else $usuario->senha = "Não";
			}

			if ($usuarios != null)
				return $this->response->setJSON($usuarios);
			else {
				echo msg("error", "Não há usuários para serem listados");
			}
		} catch (Exception) {
			echo msg("error", "Falha ao obter usuários");
		}
	}

	public function listar($id)
	{
		try {
			$this->response->setContentType('application/json')->send();

			if (isset($id)) {
				$usuario =  $this->usuarioModel->find($id);
				if ($usuario != null) {
					if ($usuario->senha != null || $usuario->senha  != "")
						$usuario->senha = "Sim";
					else $usuario->senha = "Não";
					echo json_encode($usuario, JSON_PRETTY_PRINT);
				} else
					echo msg("error", "O usuário informado não existe");
			} else
				echo msg("error", "ID inválida");
		} catch (Exception) {
			echo msg("error", "Falha ao listar usuários");
		};
	}


	public function tipo()
	{
		try {
			$this->response->setContentType('application/json')->send();
			$tipoUsuarioModel = new \App\Models\tipoUsuarioModel();
			$tipoUsuario = $tipoUsuarioModel->findAll();

			if ($tipoUsuario != null)
				echo json_encode($tipoUsuario, JSON_PRETTY_PRINT);
			else
				echo msg("error", "Nenhum tipo de usuário cadastrado");
		} catch (Exception) {
			echo msg("error", "Falha ao obter tipos de usuário");
		}
	}


	public function adicionar()
	{
		try {
			$this->response->setContentType('application/json')->send();
			$data = json_decode(file_get_contents('php://input'));

			if ($data == null) {
				echo msg("error", "Usuário ou tipo estão vazios");
				return;
			}

			$usuario = [
				"nome" => $data->nome,
				"senha" => password_hash("123456", PASSWORD_DEFAULT),
				"id_tipo" => $data->tipo
			];


			if ($data->nome != "" && $data->nome != "") {
				if ($this->usuarioModel->insert($usuario))
					echo msg("msg", "O usuário informado foi adicionado com êxito");
				else
					echo msg("error", "Não foi possível adicionar o usuário informado, possivelmente ele já exista");
			} else
				echo msg("error", "Usuário ou tipo estão vazios");
		} catch (Exception) {
			echo msg("error", "Falha ao adicionar usuário");
		}
	}

	public function remover($id)
	{
		try {
			$this->response->setContentType('application/json')->send();
			if (isset($id)) {
				$user =  $this->usuarioModel->where('id', $id)->delete();

				if ($user) {
					echo msg("msg", "Usuário removido com êxito");
				} else
					throw new Exception();
			} else
				echo msg("error", "ID Inválida");
		} catch (Exception) {
			echo msg("error", "Falha ao remover usuário");
		}
	}
}
