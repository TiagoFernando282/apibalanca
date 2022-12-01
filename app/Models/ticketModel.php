<?php

namespace App\Models;

use CodeIgniter\Model;

class ticketModel extends Model
{

    protected $table = "TicketsProcessados";
    protected $primaryKey = "ticket";
    protected $allowedFields = [
        'placa', 'fornecedor', 'nf', 'codProduto', 'produto',
        'motorista', 'cpf', 'boletim', 'pesoNF', 'pesoEntrada', 'dataEntrada', 'horaEntrada',
        'numeroEntrada', 'pesoSaida', 'dataSaida', 'horaSaida', 'numeroSaida', 'pesoLiquido'
    ];
    protected $returnType = "object";

    function listar($id)
    {
        if (isNullOrEmpty($id)) return null;

        $ticket = $this->find($id);

        if ($ticket != null) {
            $ticket->tempoNaEmpresa = obterTempo(
                $ticket->dataEntrada . " "  . $ticket->horaEntrada,
                $ticket->dataSaida . " "  . $ticket->horaSaida
            );
            $ticket->dataEntrada = toDataBR($ticket->dataEntrada);
            $ticket->dataSaida = toDataBR($ticket->dataSaida);
            return $ticket;
        } else return null;
    }

    function atualizar($id, $data)
    {
        if (isNullOrEmpty($id)) return null;
        $this->update($id, $data);
    }
}
