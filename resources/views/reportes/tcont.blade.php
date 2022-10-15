<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>TCONT</title>
    <style type="text/css">
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
            font-size: 10pt;
        }

        table {
            width: 100%;
            margin: auto;
        }

        table tbody tr td {
            padding: 4px;
            font-size: 0.8rem;
        }

        .titulo tbody tr td {
            font-size: 1rem;
        }

        .bold {
            font-weight: bold;
        }

        .font-lg {
            font-size: 1.8rem !important;
        }

        .font-md {
            font-size: 1em !important;
        }

        .font-sm {
            font-size: 0.7rem !important;
        }

        .borde {
            border: solid 1px black;
        }

        .ingresos_egresos {
            border-collapse: collapse;
            margin-top: 20px;
        }

        .ingresos_egresos tbody tr td {
            padding: 0px;
        }

        .profit {
            width: 30%;
            margin: auto;
            margin-top: 30px;
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

        .centreado {
            text-align: center;
        }

        .text_right {
            text-align: right;
        }

        .firmas {
            margin-top: 40px;
            border-collapse: collapse;
        }

        .firmas tbody tr:nth-child(1) td:nth-child(2) {
            border: dotted 1px black;
        }

        .firmas tbody tr:nth-child(2) td,
        .firmas tbody tr:nth-child(3) td {
            border: dotted 1px black;
        }

        .firmas tbody tr:nth-child(3) td {
            height: 40px;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <table class="titulo">
        <tbody>
            <tr>
                <td>{{ $configuracion->first()->razon_social }}</td>
                <td class="bold font-lg borde" width="25%">{{ $tcont->cliente->file_nro }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="font-sm">File No</td>
            </tr>
            <tr>
                <td class="bold font-lg borde">{{ $tcont->cliente->cliente }}</td>
                <td class="bold font-lg borde">{{ $tcont->cliente->tipo_embarque->nombre }}</td>
            </tr>
            <tr>
                <td class="font-sm">Cnee</td>
                <td class="font-sm">Embarque</td>
            </tr>
        </tbody>
    </table>

    <table class="info1">
        <tbody>
            <tr>
                <td class="bold font-md borde">{{ $tcont->cliente->master }}</td>
                <td class="bold font-md borde">{{ $tcont->cliente->house }}</td>
                <td class="bold font-md borde">{{ date('d/m/Y', strtotime($tcont->cliente->eta)) }}</td>
                <td class="bold font-md borde">{{ date('d/m/Y', strtotime($tcont->cliente->etd)) }}</td>
            </tr>
            <tr>
                <td class="font-sm">Master</td>
                <td class="font-sm">House</td>
                <td class="font-sm">ETA</td>
                <td class="font-sm">ETD</td>
            </tr>
        </tbody>
    </table>

    <table class="info2">
        <tbody>
            <tr>
                <td class="borde">{{ $tcont->container_nro }}</td>
                <td class="borde">{{ $tcont->cliente->nro_total1 }}</td>
                <td class="borde">{{ $tcont->cliente->units1->nombre }}</td>
                <td class="borde">{{ $tcont->cliente->venta }}</td>
                <td class="borde">{{ $tcont->cliente->oficina->nombre }}</td>
            </tr>
            <tr>
                <td class="font-sm" width="30%">Container No</td>
                <td class="font-sm" width="7%">Qtt</td>
                <td class="font-sm" width="7%">Units</td>
                <td class="font-sm">Venta</td>
                <td class="font-sm">Oficina</td>
            </tr>
        </tbody>
    </table>
    <table class="info3">
        <tbody>
            <tr>
                <td class="borde">{{ $tcont->container_nro2 }}</td>
                <td class="borde">{{ $tcont->cliente->nro_total2 }}</td>
                <td class="borde">{{ $tcont->cliente->units2->nombre }}</td>
                <td class="borde">{{ $tcont->cliente->socio_proveedor->nombre }}</td>
            </tr>
            <tr>
                <td class="font-sm" width="30%">Container No</td>
                <td class="font-sm" width="7%">Qtt</td>
                <td class="font-sm" width="7%">Units</td>
                <td class="font-sm">Socio/Proveedor</td>
            </tr>
            <tr>
                <td class="borde">{{ $tcont->container_nro3 }}</td>
                <td></td>
                <td></td>
                <td class="borde">{{ $tcont->cliente->flete_master }}</td>
            </tr>
            <tr>
                <td class="font-sm" width="30%">Container No</td>
                <td></td>
                <td></td>
                <td class="font-sm">Flete y Recargos</td>
            </tr>
        </tbody>
    </table>
    <table class="info4">
        <tbody>
            <tr>
                <td class="borde">{{ $tcont->container_nro4 }}</td>
                <td class="borde">{{ $tcont->cliente->puerto_embarque }}</td>
                <td class="borde">{{ $tcont->cliente->embarcado->nombre }}</td>
            </tr>
            <tr>
                <td class="font-sm" width="30%">Container No</td>
                <td class="font-sm">Origen</td>
                <td class="font-sm">Embarcado con</td>
            </tr>
        </tbody>
    </table>

    @php
        $ingresos = $tcont->tcont_ingresos;
        $egresos = $tcont->tcont_egresos;
        
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
                <td class="centreado bold border_bottom">INGRESOS</td>
                <td class="centreado bold border_bottom">EGRESOS</td>
            </tr>
            <tr>
                <td>
                    <table style="border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td class="bold centreado border_bottom">Documento</td>
                                <td class="bold centreado border_bottom">Número</td>
                                <td class="bold centreado border_bottom border_right">Monto</td>
                            </tr>
                            @foreach ($ingresos as $ingreso)
                                <tr>
                                    <td class="centreado">{{ $ingreso->documento->nombre }}</td>
                                    <td class="centreado">{{ $ingreso->nro }}</td>
                                    <td class="centreado border_right">$ {{ $ingreso->monto }}</td>
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
                                <td class="centreado border_right border_top">$ {{ $tcont->total_ingresos }}</td>
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
                                <td class="centreado border_top">$ {{ $tcont->total_egresos }}</td>
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
                <td class="centreado border_top border_left border_bottom border_right">$ {{ $tcont->profit }}</td>
            </tr>
        </tbody>
    </table>

    <table class="firmas">
        <tr>
            <td></td>
            <td class="bold centreado">{{ date('d/m/Y') }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="centreado">VISTO BUENO OPERACIONES</td>
            <td class="centreado">VISTO BUENO VENTAS</td>
            <td class="centreado">VISTO BUENO CONTABILIDAD</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</body>

</html>
