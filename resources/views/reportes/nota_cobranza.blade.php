<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>NotaCobranza</title>
    <style type="text/css">
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            font-size: 10pt;
            font-family: Arial, Helvetica, sans-serif;
        }

        .titulo {
            width: 500px;
            text-align: right;
            font-weight: bold;
            font-size: 1.8rem;
            margin-left: auto;
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

        .info2 {
            margin-top: 25px;
        }

        .info3 {
            margin-top: 25px;
            border-collapse: collapse;
        }

        .text_gray {
            color: gray;
        }

        .bg_gray {
            background: rgb(228, 228, 228);
        }

        .bold {
            font-weight: bold;
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

        .forma_pago td {
            height: 40px;
            vertical-align: middle;
        }

        .text_right {
            text-align: right;
        }

        .literal {
            margin-top: 20px;
            border-collapse: collapse;
        }

        .literal tbody tr td {
            padding: 6px;
        }

        .literal tbody tr td div {
            height: 1px;
            width: 100%;
            background: black;
        }

        p {
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="titulo">Nota de Cobranza</div>

    <table class="info1">
        <tbody>
            <tr>
                <td class="text_gray">Date</td>
                <td class="bg_gray bold">{{ date('d/m/Y', strtotime($nota_cobranza->date)) }}</td>
            </tr>
            <tr>
                <td class="text_gray">Ref</td>
                <td class="bg_gray bold">{{ $nota_cobranza->ref }}</td>
            </tr>
            <tr>
                <td class="text_gray">Cnee</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->cnee }}</td>
            </tr>
            <tr>
                <td class="text_gray">Shipper</td>
                <td class="bg_gray bold">{!! $nota_cobranza->cliente->manifiesto->shipper->nombre !!}</td>
            </tr>
            <tr>
                <td class="text_gray">Vessel/Voyage</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->manifiesto->ocean_vessel }}
                    &nbsp;&nbsp;&nbsp;{{ $nota_cobranza->cliente->manifiesto->voyage_nro }}</td>
            </tr>
            <tr>
                <td class="text_gray">Port of Loading</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->puerto_embarque }}</td>
            </tr>
            <tr>
                <td class="text_gray">Port of Delivery</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->puerto_destino->nombre }}</td>
            </tr>
            <tr>
                <td class="text_gray">Master B/L No</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->master }}</td>
            </tr>
            <tr>
                <td class="text_gray">House B/L No</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->house }}</td>
            </tr>
            <tr>
                <td class="text_gray">Total Quantity</td>
                <td class="bg_gray bold">{{ $nota_cobranza->cliente->nro_total1 }}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $nota_cobranza->cliente->units1->nombre }}</td>
            </tr>
        </tbody>
    </table>

    <table class="info2">
        <tbody>
            <tr>
                <td class="text_gray" width="8.5%">Nombre</td>
                <td class="bold border_top">{{ $nota_cobranza->cliente->cliente }}</td>
            </tr>
            <tr>
                <td class="text_gray">ATN</td>
                <td class="bold">{{ $nota_cobranza->cliente->cnee }}</td>
            </tr>
            <tr>
                <td class="text_gray">Dirección</td>
                <td class="bold">{{ $nota_cobranza->cliente->dir }}</td>
            </tr>
            <tr>
                <td class="text_gray">Teléfono</td>
                <td class="bold border_bottom">{{ $nota_cobranza->cliente->fono }}</td>
            </tr>
        </tbody>
    </table>

    <table class="info3">
        <tbody>
            <tr>
                <td class="bold border_top border_bottom bg_gray border_left">OT.</td>
                <td class="bold border_top border_bottom bg_gray">Descripción</td>
                <td class="bold border_top border_bottom bg_gray">Unit.</td>
                <td class="bold border_top border_bottom bg_gray border_right">Total</td>
            </tr>
            @foreach ($nota_cobranza->cliente->cliente_ingresos as $ingreso)
                <tr>
                    <td class="border_left">1</td>
                    <td>{{ $ingreso->descripcion }}</td>
                    <td>{{ $ingreso->monto }}</td>
                    <td class="text_right border_right">{{ $ingreso->monto }}</td>
                </tr>
            @endforeach
            <tr class="forma_pago">
                <td class="border_bottom border_left"></td>
                <td class="border_bottom"><span class="bold">Forma de pago:</span>&nbsp;&nbsp;&nbsp;&nbsp; Efectivo
                </td>
                <td class="border_bottom"></td>
                <td class="border_bottom border_right"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="bold">TOTAL</td>
                <td class="border_left border_bottom border_right text_right bold">
                    {{ $nota_cobranza->cliente->total_ingresos }}</td>
            </tr>
        </tbody>
    </table>

    <table class="literal">
        <tbody>
            <tr>
                <td class="bold bg_gray text_right">{{ $literal }}</td>
                <td class="bg_gray">
                    <div>
                </td>
                <td class="bg_gray" width="20%">DOLARES AMERICANOS</td>
            </tr>
        </tbody>
    </table>

    <p class="t1">* Favor emitir cheque a nombre de <span
            class="bold">{{ $configuracion->first()->nombre_cheque }}</span></p>
    <p class="t2">** El monto de esta Nota de Debito deberá ser cancelado en Dólares Americanos, Euros o su
        equivalente en moneda nacional al tipo de cambio vigente al día de pago</p>
    <p class="t3">*** A partir de la llegaga de la nave, cuentan con 21 días libres para la devolución del
        contenedor a puerto. Los días adicionales estan sujetos a recargos. En caso de requerir información adicional
        favor contactarse con nuestras oficinas</p>
</body>

</html>
