<?php
namespace App\Controllers;
ini_set('display_errors', 1);

class resumo extends BaseController
{
    private $relatorioModel;
    protected $helpers = ['funcoes'];

    function __construct() {
        $this->relatorioModel = new \App\Models\relatorioModel();
       Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
       Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
       Header('Access-Control-Allow-Methods: GET, POST');

    }
    
    public function index(){
        echo "Paramêtros inválidos";
    }
	
	

    public function recebimento($dataRelatorio){
		
        $relatório =  $this->relatorioModel->select('produto , codProduto')->selectSum('pesoLiquido')
		->where("dataSaida", toDataUSA($dataRelatorio))->where("(pesoEntrada - pesoSaida) > ", 0)->groupBy('produto')->orderBy('codProduto', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    public function expedicao($dataRelatorio){
		$relatório =  $this->relatorioModel->select('produto , codProduto')->selectSum('pesoLiquido')
		->where("dataSaida", toDataUSA($dataRelatorio))->where("(pesoEntrada - pesoSaida) <=", 0)->groupBy('produto')->orderBy('codProduto', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    public function ambos($dataRelatorio){
        $relatório =  $this->relatorioModel->where("dataSaida", toDataUSA($dataRelatorio))->orderBy('horaSaida', 'asc')->findAll();
		$relatório =  $this->relatorioModel->select('produto , codProduto')->selectSum('pesoLiquido')
		->where("dataSaida", toDataUSA($dataRelatorio))->groupBy('produto')->orderBy('codProduto', 'asc')->findAll();
        $this->response->setContentType('application/json')->send();
        echo json_encode($relatório, JSON_PRETTY_PRINT);
    }

    


}


?>