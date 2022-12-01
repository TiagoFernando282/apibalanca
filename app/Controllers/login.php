<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UsuarioModel;

class Login extends BaseController
{
	protected $helpers = ['funcoes'];

	function __construct()
	{
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		Header('Access-Control-Allow-Methods: GET, POST');
	}

	public function index()
	{
		$userModel = new UsuarioModel();
		$data = json_decode(file_get_contents('php://input'));

		if (is_null($data)) {
			echo msg("error", "Usuário ou tipo estão vazios");
			return;
		}

		$user = $userModel->where('nome', $data->nome)->first();

		if (is_null($user)) {
			echo msg("error", "Usuário ou senha inválidos");
			return;
		}

		$pwd_verify = password_verify($data->senha, $user->senha);

		if (!$pwd_verify) {
			echo msg("error", "Usuário ou senha inválidos");
			return;
		}

		$key = getenv("JWT_SECRET");
		$iat = time(); // current timestamp value
		$exp = $iat + 3600;

		$payload = array(
			"iss" => "tfsoftware.com",
			"iat" => $iat, //Time the JWT issued at
			"exp" => $exp, // Expiration time of token
			"nome" => $user->nome,
			"tipo" => $user->id_tipo
		);

		$token = JWT::encode($payload, $key, 'HS256');
		echo msg("token", $token);
	}
}
