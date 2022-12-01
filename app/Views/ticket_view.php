<?php
if (is_numeric($pesoNF)) {
    if (floatval($pesoNF) != 0) {
        $diferencaNF = floatval($pesoLiquido) -  floatval($pesoNF);
        $cor = "";
        $adição = "";

        if ($diferencaNF > 0) {
            $cor = "green";
            $adição = "+";
        } else if ($diferencaNF == 0) $cor = "green";
        else $cor = "red";

        $diferencaNF =  "<span style='color:$cor'>" . $adição . $diferencaNF . " Kgs</span>";
    } else  $diferencaNF = "...";
} else $diferencaNF = "...";
?>
<html>
<head>
    <title>Ticket <?php echo $ticket ?></title>
    <style>
        body {
            font-size: 14px;
            font-family: "calibri";
            max-width: 100%;
            overflow-x: hidden;
        }

        :root {
            --corBorda: black;
        }

        .containerGeral {
            width: 740px;
            height: 400px;
            border: 1px solid var(--corBorda);
            background-color: whitesmoke;
            border-radius: 2px;
        }

        .containerTitulo {
            width: 100%;
            height: 35px;
            border-bottom: 1px solid var(--corBorda);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 15px;
            ;
        }

        .containerPeso {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .containerPesoGeral {
            width: 99.5%;
            height: 30px;
            font-size: 15px;
            position: absolute;
            bottom: 1;
            left: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 1px solid var(--corBorda);
        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
    <script>
        function imprimir() {
            window.print();
        }
    </script>
</head>
<body id="pagina">
    <div class="containerGeral">
        <div id="titulo" class="containerTitulo">CONTROLE DE BALANÇA - TICKET <?php echo $ticket ?></div>
        <div style="display:flex; align-items:start; height:140px; ">
            <div style="width:50%;height:100%; border-right: 1px solid  var(--corBorda); margin-left:20px;">
                </br>Data entr.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora
                entr.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Número entr. </br>&nbsp;
                <?php echo $dataEntrada ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $horaEntrada ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $numeroEntrada ?></br></br>
                </br>Data saída.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora
                saída.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Número saída </br>&nbsp;
                <?php echo $dataSaida ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $horaSaida ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $numeroSaida ?></br>
            </div>
            <div class="containerPeso">
                <div style="height:85%;">
                    Peso entrada</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo ajustarFormatoPeso($pesoEntrada) ?></br>
                    Peso saída </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo ajustarFormatoPeso($pesoSaida)  ?></br>
                </div>
                <div class="containerPesoGeral">
                    <b><?php echo ajustarFormatoPeso($pesoLiquido) . " KGs" ?></b>
                </div>
            </div>
        </div>
        <div style="display:flex; align-items:start; height:220px; border-top:  1px solid  var(--corBorda);">
            <div style="width:35%; margin-left:20px;">
                </br>Produto:&nbsp;&nbsp;<b><?php echo $produto ?></b></br>
                </br>NF:&nbsp;&nbsp;<?php echo $nf ?></br>
                </br>PLACA:&nbsp;&nbsp;<?php echo $placa ?></br>
                </br>Fornec./Dest.:&nbsp;&nbsp;<?php echo $fornecedor ?></br>
                </br>B.C.:&nbsp;<?php echo $boletim ?></br>
                </br>Tempo na empresa:&nbsp;<b><?php echo $tempoNaEmpresa ?></b>
            </div>
            <div style="width:65%; ">
                </br></br></br>Peso NF:&nbsp;<b><?php echo $pesoNF ?></b></br>
                </br>Motorista:&nbsp;<?php echo $motorista ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RG/CPF:&nbsp;<?php echo $cpf ?>
                </br></br></br></br></br></br>
                Diferença NF:&nbsp;<b><?php echo $diferencaNF ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div style="width: 210px; height:1px; border-bottom: 1px solid  var(--corBorda); margin-left:190px; margin-top:-5px;"></div>
            </div>
        </div>
    </div>
</body>
</html>