<?php

namespace App\Controllers;

use Exception;

class relatorio extends BaseController
{
    private $relatorioModel;
    protected $helpers = ['funcoes'];

    function __construct()
    {
        $this->relatorioModel = new \App\Models\relatorioModel();
        /* $uri = service('uri');
        $uri = current_url(true); 
       echo "olaaaaaaaaaa  "  .  $uri->getSegment(3); */
       header('Cache-Control: no-cache, no-store, must-revalidate');
       header('Pragma: no-cache');

        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST');
    }

    public function index()
    {
        echo "Paramêtros inválidos";
    }

    public function recebimento($dataRelatorio)
    {
        $relatório =  $this->relatorioModel->where("dataSaida", toDataUSA($dataRelatorio))->where("(pesoEntrada - pesoSaida) > ", 0)->orderBy('horaSaida', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    public function expedicao($dataRelatorio)
    {
        $relatório =  $this->relatorioModel->where("dataSaida", toDataUSA($dataRelatorio))->where("(pesoEntrada - pesoSaida) <=", 0)->orderBy('horaSaida', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    public function ambos($dataRelatorio)
    {
        $relatório =  $this->relatorioModel->where("dataSaida", toDataUSA($dataRelatorio))->orderBy('horaSaida', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    public function json()
    {
        try {
            $data = json_decode(file_get_contents('php://input') , true);
            if (isNullOrEmpty($data))
                throw new Exception("Os dados enviados não são válidos ", 1);

            $dados = $this->relatorioModel->filtros($data);
            $this->response->setContentType('application/json')->send();
            echo json_encode($dados, JSON_PRETTY_PRINT);

        } catch (Exception $e) {
            return msg("error", $e->getMessage());
        }
    }

    public function imprimir($id){
		$data = (array) $this->ticketModel->listar($id);
		return view('ticket_view', $data);
	}
}
