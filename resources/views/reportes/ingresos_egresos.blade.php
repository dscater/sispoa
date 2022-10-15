<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ingresos y Egresos</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
            word-wrap: break-word;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: 0px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin: auto;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.85em;
        }

        table tbody tr td {
            font-size: 0.75em;
            vertical-align: top;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(236, 236, 236)
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        .ingresos_egresos {
            border-collapse: collapse;
            margin-top: 0px;
        }

        .ingresos_egresos tbody tr td {
            padding: 0px;
        }

        .profit {
            width: 30%;
            margin: auto;
            margin-top: 10px;
        }

        .profit tbody tr td:nth-child(2) {
            border: solid 1px;
        }

        .border_right {
            border-right: solid 1px black;
        }

        .border_left {
            border-left: solid 1px black;
        }

        .border_top {
            border-top: solid 1px black;
        }

        .border_bottom {
            border-bottom: solid 1px black;
        }

        hr {
            height: 1px;
            border-top: dashed 1px;
            border-bottom: none;
        }

        .bold {
            font-weight: bold;
        }

        .totales {
            width: 50%;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . $configuracion->first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ $configuracion->first()->razon_social }}
        </h2>
        <h4 class="texto">INGRESOS Y EGRESOS</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    @php
        $tt_ingresos = 0;
        $tt_egresos = 0;
        $tt_profit = 0;
    @endphp
    @foreach ($clientes as $cliente)
        <table style="margin-top:20px;">
            <tbody>
                <tr>
                    <td width="5%" class="bold">Nro. File:</td>
                    <td width="14%">{{ $cliente->file_nro }}</td>
                    <td class="bold" width="7%">Cliente:</td>
                    <td>{{ $cliente->cliente }}</td>
                </tr>
            </tbody>
        </table>

        @php
            $tconts = $cliente->tconts;
            $total_ingresos = $cliente->tconts()->sum('total_ingresos');
            $total_egresos = $cliente->tconts()->sum('total_egresos');
            $profit = $cliente->tconts()->sum('profit');
            $tt_ingresos += (float) $total_ingresos;
            $tt_egresos += (float) $total_egresos;
            $tt_profit += (float) $profit;
            
            $ingresos = [];
            $egresos = [];
            foreach ($tconts as $tc) {
                foreach ($tc->tcont_ingresos as $value) {
                    $ingresos[] = $value;
                }
                foreach ($tc->tcont_egresos as $value) {
                    $egresos[] = $value;
                }
            }
            
            $restantes_egresos = 0;
            $restantes_ingresos = 0;
            if (count($ingresos) > count($egresos)) {
                $restantes_egresos = count($ingresos) - count($egresos);
            } else {
                $restantes_ingresos = count($egresos) - count($ingresos);
            }
        @endphp
        <table class="ingresos_egresos">
            <tbody>
                <tr>
                    <td class="centreado bold border_bottom border_right border_top gray">INGRESOS</td>
                    <td class="centreado bold border_bottom border_top gray">EGRESOS</td>
                </tr>
                <tr>
                    <td class="border_right">
                        <table style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td class="bold centreado border_bottom">Documento</td>
                                    <td class="bold centreado border_bottom">Número</td>
                                    <td class="bold centreado border_bottom">Monto</td>
                                </tr>
                                @foreach ($ingresos as $ingreso)
                                    <tr>
                                        <td class="centreado">{{ $ingreso->documento->nombre }}</td>
                                        <td class="centreado">{{ $ingreso->nro }}</td>
                                        <td class="centreado">$ {{ $ingreso->monto }}</td>
                                    </tr>
                                @endforeach
                                @for ($i = 1; $i <= $restantes_ingresos; $i++)
                                    <tr>
                                        <td class="centreado">$ -</td>
                                        <td class="centreado"></td>
                                        <td class="centreado"></td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="centreado border_top">$ {{ $total_ingresos }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td class="bold centreado border_bottom">Monto</td>
                                    <td class="bold centreado border_bottom">Número</td>
                                    <td class="bold centreado border_bottom">Documento</td>
                                </tr>
                                @foreach ($egresos as $egreso)
                                    <tr>
                                        <td class="centreado">$ {{ $egreso->monto }}</td>
                                        <td class="centreado">{{ $egreso->nro }}</td>
                                        <td class="centreado">{{ $egreso->documento->nombre }}</td>
                                    </tr>
                                @endforeach
                                @for ($i = 1; $i <= $restantes_egresos; $i++)
                                    <tr>
                                        <td class="centreado">$ -</td>
                                        <td class="centreado"></td>
                                        <td class="centreado"></td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td class="centreado border_top">$ {{ $total_egresos }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="profit">
            <tbody>
                <tr>
                    <td class="bold centreado">Profit Final:</td>
                </tr>
                <tr>
                    <td class="centreado border_top border_left border_bottom border_right">$ {{ $profit }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
    @endforeach

    <table border="1" class="totales">
        <thead>
            <tr>
                <th colspan="2">TOTALES FINALES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="centreado bold gray">INGRESOS</td>
                <td class="centreado bold gray">EGRESOS</td>
            </tr>
            <tr>
                <td class="centreado bold">$ {{ number_format($tt_ingresos, 2) }}</td>
                <td class="centreado bold">$ {{ number_format($tt_egresos, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" class="centreado bold gray">PROFIT</td>
            </tr>
            <tr>
                <td colspan="2" class="centreado bold">$ {{ number_format($tt_profit, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
