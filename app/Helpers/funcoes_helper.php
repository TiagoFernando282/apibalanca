<?php

function msg($titulo, $msg): string
{

    $msgRetorno = [
        $titulo => $msg
    ];

    return json_encode($msgRetorno, JSON_PRETTY_PRINT);
}

function isNullOrEmpty($data) : bool{

    if(is_null($data))
        return true;
    if(empty($data)) 
        return true;

    return false;
}

function toDataUSA($data): string
{
    return date('Y-m-d', strtotime($data));
}

function toDataBR($data): string
{
    return date('d/m/Y', strtotime($data));
}

function obterTempo($dataInicial, $dataFinal): string
{
    $dataEntrada = new DateTime($dataInicial . ":00");
    $dataSaida = new DateTime($dataFinal . ":00");
    $interval = $dataEntrada->diff($dataSaida);

    $tempoNaEmpresa = "";;
    $dias = $interval->d;
    $horas = $interval->h;
    $minutos = $interval->i;

    if ($dias != 0) {
        if ($dias > 9) $tempoNaEmpresa .= $dias . " dias";
        else $tempoNaEmpresa .= $dias . " dia";
    }

    if ($horas != 0) {
        if ($dias != 0) $tempoNaEmpresa .= ",  ";
        if ($horas > 1) $tempoNaEmpresa .= $horas . " horas";
        else $tempoNaEmpresa .= $horas . " hora";
    }

    if ($minutos != 0) {
        if ($horas != 0) $tempoNaEmpresa .= " e ";
        if ($minutos > 1) $tempoNaEmpresa .= $minutos . " minutos";
        else $tempoNaEmpresa .= $minutos . " minutos";
    }

    return $tempoNaEmpresa;
}

function ajustarFormatoPeso($val): string
{
    return str_replace(",", ".", number_format($val));
}
