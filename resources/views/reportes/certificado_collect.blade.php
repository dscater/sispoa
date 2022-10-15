<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CertificadoCollect</title>
    <style type="text/css">
        * {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 2cm;
            margin-right: 1cm;
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

        .info1 {
            width: 50%;
            margin-left: auto;
            margin-right: 0;
            border-spacing: 4px;
        }

        .borde {
            border: dotted 1px black;
        }

        .text_gray {
            color: gray;
        }

        .bg_gray {
            background: rgb(228, 228, 228);
        }

        .bold {
            font-weight: bold
        }

        .border_top {
            border-top: solid 1px black;
        }

        .border_bottom {
            border-bottom: solid 1px black;
        }

        .border_left {
            border-left: solid 1px black;
        }

        .border_right {
            border-right: solid 1px black;
        }

        .font-md {
            font-size: 1.1rem;
        }

        .info2 tbody tr td {
            vertical-align: top;
        }

        .flete {
            margin-top: 30px;
            width: 50%;
            margin-left: 0;
            margin-right: auto;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <table class="info1">
        <tbody>
            <tr>
                <td class="text_gray">Date</td>
                <td class="bg_gray bold">{{ date('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="text_gray">ATN</td>
                <td class="bg_gray bold">{{ $cliente->cliente }}</td>
            </tr>
            <tr>
                <td class="text_gray">Doc Ref.</td>
                <td class="bg_gray bold">{{ $cliente->house }}</td>
            </tr>
            <tr>
                <td class="text_gray">Puerto de Embarque</td>
                <td class="bg_gray bold">{{ $cliente->puerto_embarque }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <tr>
            <td class="bold border_bottom font-md">CERTIFICADO DE FLETE MARÍTIMO COLLECT</td>
        </tr>
    </table>

    <p style="margin-top:25px;margin-bottom:25px;">Estimados Señores</p>
    <p>Por medio de la presente extendemos el presente <span class="bold">Certificado de Flete Marítimo</span> para la
        siguiente carga de importación:</p>

    <table class="info2">
        <tr>
            <td class="bold" width="27%">B/L (conocimiento de embarque)</td>
            <td>{{ $cliente->house }}</td>
        </tr>
        <tr>
            <td class="bold">Puerto de Embarque</td>
            <td>{{ $cliente->puerto_embarque }}</td>
        </tr>
        <tr>
            <td class="bold">Unidades</td>
            <td>{{ $cliente->nro_total1 }}</td>
        </tr>
        <tr>
            <td class="bold">No de contenedores</td>
            <td>{{ $cliente->units1->nombre }}</td>
        </tr>
        <tr>
            <td class="bold">Mercadería</td>
            <td>{!! $cliente->manifiesto->descripcion !!}</td>
        </tr>
        <tr>
            <td class="bold">Embarcador1</td>
            <td>{!! $cliente->manifiesto->shipper->nombre !!}</td>
        </tr>
        <tr>
            <td class="bold">Embarcador2</td>
            <td>{!! $cliente->manifiesto->shipper_texto !!}</td>
        </tr>
        <tr>
            <td class="bold">Consignatario</td>
            <td>{{ $cliente->cnee }}</td>
        </tr>
    </table>

    <table class="flete">
        <tbody class="border_top">
            @foreach ($cliente->cliente_ingresos as $ingreso)
                <tr>
                    <td class="bold border_bottom">{{ $ingreso->descripcion }}</td>
                    <td class="border_bottom">{{ $ingreso->monto }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="bold border_bottom">Total:</td>
                <td class="border_bottom">{{ $cliente->ingresos_total }}</td>
            </tr>
        </tbody>
    </table>
    <p>Es cuanto certificamos para los fines que al interesado convenga.</p>
    <p>Atentamente</p>
    <br>
    <br>
    <br>
    <p class="bold" style="margin-bottom:-14px;">{{ $configuracion->first()->operation_manager }}</p>
    <p class="margin:0px;">Operation Manager</p>
    <p class="bold" style="margin-bottom:-14px;">{{ $configuracion->first()->razon_social }}</p>
    <p class="margin:0px;">As Agent Of</p>
</body>

</html>
