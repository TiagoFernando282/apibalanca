<?php


namespace App\Controllers;
require 'vendor/autoload.php';

use Exception;


class ticket extends BaseController
{
    private $ticketModel;
    protected $helpers = ['funcoes'];

    function __construct()
    {
        $this->ticketModel = new \App\Models\ticketModel();
        Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		Header('Access-Control-Allow-Methods: GET, POST');
    }

    public function index($id)
    {
        if (isset($id)) {
            $ticket = $this->ticketModel->listar($id);
            if ($ticket != null) {
                $this->response->setContentType('application/json')->send();
                echo json_encode($ticket, JSON_PRETTY_PRINT);
            } else {
                $this->response->setContentType('application/json')->send();
                echo msg("error", "Ticket inválido");
            }
        } else echo "Id inválida";
    }

    public function imprimir($id)
    {
        $data = (array) $this->ticketModel->listar($id);
        return view('ticket_view', $data);
    }

    public function pdf($id)
    {
        $data = (array) $this->ticketModel->listar($id);
        /*return view("ticket_view_pdf", $data);*/
        $mpdf = new \Mpdf\Mpdf();
        $html = view('ticket_view_pdf', $data);
        $mpdf->WriteHTML($html);

        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf', 'I');
    }

    public function update($id)
    {
        try {
            $json = file_get_contents('php://input');
            if (isNullOrEmpty($json))
                throw new Exception("Os dados enviados não são válidos ", 1);

            $data = "{" . str_replace(["[", "]", "{", "}"], "", $json, $count) . "}";
            $data = json_decode($data, true);

            $this->ticketModel->update($id, $data);
            $this->response->setContentType('application/json')->send();
            return msg("msg", "Ticket atualizado com êxito");
        } catch (Exception $e) {
            return msg("error", $e->getMessage());
        }
    }
}
