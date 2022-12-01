<!DOCTYPE html>
<html>

<head>
    <title>HTML Table Generator</title>
    <style>
        table {
            border: 1px solid #b3adad;
            border-collapse: collapse;
            padding: 5px;
        }

        table th {
            border: 1px solid #b3adad;
            padding: 5px;
            background: #f0f0f0;
            color: #313030;
        }

        table td {
            border: 1px solid #b3adad;
            padding: 5px;
            background: #ffffff;
            color: #313030;
        }
    </style>
</head>
<body>
    <table style="width:100%;">
        <thead>
            <tr>
                <th>CONTROLE DE BALANÇA - TICKET <?php echo $ticket ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ul>
                        <li>Data entrada
                            <ul>
                                <li><?php echo $dataEntrada ?></li>
                            </ul>
                        </li>
                    </ul>
                    <br />
                    <ul>
                        <li>Data saída
                            <ul>
                                <li><?php echo $dataSaida ?></li>
                            </ul>
                        </li>
                    </ul>

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>

</html>