<?php

namespace App\Models;

use CodeIgniter\Model;

class tipoUsuarioModel extends Model
{
    protected $table = "TipoUsuario";
    protected $primaryKey = "id";
    protected $allowedFields = ['id', 'descricao'];
    protected $returnType = "object";
}
