<?php

namespace App\Models;

use CodeIgniter\Model;

class relatorioModel extends Model
{
    protected $table = "TicketsProcessados";
    protected $primaryKey = "ticket";
    protected $allowedFields = [
        'numeroSaida', 'fornecedor', 'placa', 'ticket',
        'produto', 'horaEntrada', 'horaSaida', 'boletim', 'dataSaida'
    ];
    protected $returnType = "object";
    protected $helpers = ['funcoes'];

    function filtros($filtroArray)
    {
        $campos = [
            "ticket", "placa", "fornecedor", "nf", "codProduto", "produto", "motorista", "cpf", "boletim",
            "pesoNF", "pesoEntrada", "dataEntrada", "horaEntrada", "numeroEntrada", "pesoSaida",
            "dataSaida", "horaSaida", "numeroSaida", "pesoLiquido"
        ];

        $db = db_connect();
        $builder = $db->table($this->table);
        $builder->select($campos, true);

        //Tipo de pesagem
        if ($filtroArray["tipoPesagem"] === "recebimento")
            $builder->where("(pesoEntrada - pesoSaida) > ", 0);
        if ($filtroArray["tipoPesagem"] === "expedicao")
            $builder->where("(pesoEntrada - pesoSaida) <=", 0);

        //Intervalo de datas
        $dataInicial = $filtroArray["dataInicial"];
        $dataFinal = $filtroArray["dataFinal"];

        if (isNullOrEmpty($dataInicial))
            $dataInicial =  date("Y-m-d");
        else
            $dataInicial = toDataUSA($dataInicial);

        if (isNullOrEmpty($dataFinal))
            $dataFinal =  date("Y-m-d");
        else
            $dataFinal = toDataUSA($dataFinal);


        if (!isNullOrEmpty($filtroArray["filtros"])) {

            foreach ($filtroArray["filtros"] as $filtro) {
                $builder->like($filtro, strtoupper($filtro[key($filtro)]), 'both');
            }
        }

        $builder->where("dataSaida >= ", "$dataInicial");
        $builder->where("dataSaida <= ",  $dataFinal);
        $builder->orderBy('horaSaida', 'asc');

        $query = $builder->get();
        return $query->getResultObject();
    }
}
