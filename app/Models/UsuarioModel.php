<?php

namespace App\Models;

use CodeIgniter\Model;

class usuarioModel extends Model
{

    protected $table = "Usuario";
    protected $primaryKey = "id";
    protected $allowedFields = ['nome', 'senha', 'id_tipo'];
    protected $returnType = "object";


    function listarUsuarios()
    {
        $tabelaJoin = "TipoUsuario";
        $condiçãoJoin = "Usuario.id_tipo = TipoUsuario.id";
        $camposNecesarios = [ $this->table . '.id', $this->table . '.nome',
        $this->table . '.senha' ,  $tabelaJoin . '.descricao AS tipo'];

        $db = db_connect();
        $builder = $db->table($this->table);
        $builder->select($camposNecesarios);
        $builder->join($tabelaJoin, $condiçãoJoin);
        $query = $builder->get();

        return $query->getResultObject();
       /* echo "<pre>";
        print_r($query->getResultArray());*/
    }
}
