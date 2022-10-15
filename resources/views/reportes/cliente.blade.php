<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cliente</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 0.5cm;
            font-size: 10pt;
        }

        .logo {
            margin: auto;
            width: 100%;
            text-align: center;
        }

        .logo img {
            width: 400px;
            height: 100px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: inherit;
        }

        table thead tr th,
        table tbody tr td {
            padding: 2px;
        }

        .borde {
            border: double 3px;
        }

        .borde1 {
            border-color: #A1C30D;
        }

        .borde2 {
            border-color: #22416D;
        }

        .bold {
            font-weight: bold;
        }

        .font_peque {
            font-size: 0.7rem;
        }

        .font-md bold {
            font-size: 0.85rem;
        }

        .centreado {
            text-align: center;
        }

        .bg-blue {
            background: #b5cff3;
        }

        .info_cliente3 {
            position: relative;
            width: 49%;
            margin-left: 0px;
            margin-right: auto;
        }

        .info_cliente4 {
            position: relative;
            margin-top: -100px;
            width: 49%;
            margin-right: 0px;
            margin-left: auto;
        }

        .info_cliente5 {
            position: absolute;
            right: 0px;
            top: 430px;
            margin-right: 0px;
        }

        .w-49 {
            width: 49%;
        }

        .mt-70 {
            margin-top: 70px;
        }

        hr {
            height: 2px;
            background: #22416D;
            width: 100%;
        }

        .master {
            margin-left: 0px;
            margin-right: auto;
        }

        .master tbody tr:nth-child(1) td {
            vertical-align: top;
            height: 100px;
        }

        .house tbody tr:nth-child(1) td {
            vertical-align: top;
            height: 100px;
        }


        .house {
            margin-left: 0px;
            margin-right: auto;
        }

        .pagos {
            margin-left: 0px;
            margin-right: auto;
        }

        .check {
            border: solid 1px black;
            padding: 2px;
        }

        .notas {
            border-collapse: collapse;
            margin-top: -10px;
        }

        .notas tbody tr td:nth-child(1) {
            background: #60497A;
            color: white;
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        .notas tbody tr td {
            font-size: 0.85rem;
            border: dotted 2px #22416D;
            height: 90px;
        }

        .ingresos_egresos {
            margin-top: 20px;
            width: 100%;
            font-size: 0.85rem;
        }

        .ingresos_egresos .titulos div {
            display: inline-block;
            width: 49.5%;
            text-align: center;
            padding: 5px 0px;
            border-top: dashed 1px black;
            border-bottom: dashed 1px black;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .ingresos_egresos .registros {
            display: inline-block;
            width: 49.5%;
        }

        .ingresos_egresos .registros .registro {
            width: 100%;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .ingresos_egresos .registros .registro .col {
            display: inline-block;
            width: 48.5%;
            text-align: center;
        }

        .bt-dotted {
            border-top: dotted 2px black;
        }

        .br-dotted {
            padding-right: 10px;
            border-right: dotted 2px black;
        }

        .bl-dotted {
            padding-left: 10px;
            border-left: dotted 2px black;
        }

        .txt_right {
            text-align: right !important;
        }

        .profit {
            width: 30%;
            margin: auto;
        }

        .profit tbody tr td:nth-child(2) {
            border: solid 1px;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="logo">
        <img src="{{ asset('imgs/' . $configuracion->first()->logo) }}" alt="Logo">
    </div>
    <table class="info_cliente">
        <tbody>
            <tr>
                <td class="borde borde1 bold">{{ $cliente->file_nro }}</td>
                <td class="borde borde1">{{ $cliente->tipo_embarque->nombre }}</td>
                <td class="borde borde1">{{ $cliente->venta }}</td>
                <td class="borde borde1">{{ $cliente->oficina->nombre }}</td>
            </tr>
            <tr>
                <td class="font_peque bold">File Nro.</td>
                <td class="font_peque bold">Tipo de Embarque</td>
                <td class="font_peque bold">Venta</td>
                <td class="font_peque bold">Oficina</td>
            </tr>
        </tbody>
    </table>

    <table class="info_cliente2">
        <tbody>
            <tr>
                <td class="bold borde borde1">{{ $cliente->cliente }}<br>{{ $cliente->contacto }}</td>
                <td class="borde borde1">{{ $cliente->cnee }}</td>
            </tr>

            <tr>
                <td class="font_peque bold">Cliente</td>
                <td class="font_peque bold">Cnee</td>
            </tr>
        </tbody>
    </table>

    <table class="info_cliente3">
        <tbody class="borde borde1">
            <tr>
                <td class="bold">Cliente</td>
                <td colspan="2">{{ $cliente->cliente }}</td>
            </tr>
            <tr>
                <td class="bold">Contacto</td>
                <td colspan="2">{{ $cliente->contacto }}</td>
            </tr>
            <tr>
                <td class="bold">Dirección</td>
                <td colspan="2">{{ $cliente->dir }}</td>
            </tr>
            <tr>
                <td class="bold">Ciudad</td>
                <td colspan="2">{{ $cliente->ciudad }}</td>
            </tr>
            <tr>
                <td class="bold">Teléfono</td>
                <td colspan="2">{{ $cliente->fono }}</td>
            </tr>
            <tr>
                <td class="bold">Fax</td>
                <td colspan="2">{{ $cliente->fax }}</td>
            </tr>
            <tr>
                <td class="bold">No NIT</td>
                <td>{{ $cliente->nro_nit }}</td>
                <td class="bg-blue">Cliente Nuevo</td>
            </tr>
        </tbody>
    </table>

    <table class="info_cliente4">
        <tbody>
            <tr>
                <td class="borde borde1">
                    {{ $cliente->nro_nit }}
                </td>
            </tr>
            <tr>
                <td class="font_peque bold">NIT</td>
            </tr>
        </tbody>
    </table>

    <hr class="mt-70">

    <table class="master w-49">
        <tbody>
            <tr>
                <td class="borde borde2 centreado bold">
                    {{ $cliente->master }}
                </td>
            </tr>
            <tr>
                <td class="font_peque bold">Master</td>
            </tr>
        </tbody>
    </table>

    <table class="house w-49">
        <tbody>
            <tr>
                <td class="borde borde2 centreado bold">
                    {{ $cliente->house }}
                </td>
            </tr>
            <tr>
                <td class="font_peque bold">House</td>
            </tr>
        </tbody>
    </table>

    <table class="pagos w-49">
        <tbody class="borde borde2">
            <tr>
                <td class="bold">
                    DOCS. CONTRA PAGO?
                </td>
                @if ($cliente->documentos_cp == 'SI')
                    <td>
                        <span class="check font-md bold">SI</span>&nbsp;&nbsp;&nbsp;NO
                    </td>
                @else
                    <td>
                        SI &nbsp;&nbsp;&nbsp;<span class="check font-md bold">NO</span>
                    </td>
                @endif
            </tr>
            <tr>
                <td class="bold">
                    HBL AL CNEE FLETADO?
                </td>
                @if ($cliente->hbl_ai_cnee_fletado == 'SI')
                    <td>
                        <span class="check font-md bold">SI</span>&nbsp;&nbsp;&nbsp;NO
                    </td>
                @else
                    <td>
                        SI &nbsp;&nbsp;&nbsp;<span class="check font-md bold">NO</span>
                    </td>
                @endif
            </tr>
            <tr>
                <td class="bold">
                    FLETE MENOR?
                </td>
                @if ($cliente->flete_menor == 'SI')
                    <td>
                        <span class="check font-md bold">SI</span>&nbsp;&nbsp;&nbsp;NO
                    </td>
                @else
                    <td>
                        SI &nbsp;&nbsp;&nbsp;<span class="check font-md bold">NO</span>
                    </td>
                @endif
            </tr>
            <tr>
                <td class="bold">
                    CUANTO?
                </td>
                @if ($cliente->cuanto == 'SI')
                    <td>
                        <span class="check font-md bold">SI</span>&nbsp;&nbsp;&nbsp;NO
                    </td>
                @else
                    <td>
                        SI &nbsp;&nbsp;&nbsp;<span class="check font-md bold">NO</span>
                    </td>
                @endif
            </tr>
        </tbody>
    </table>

    <table class="info_cliente5 w-49">
        <tbody>
            <tr>
                <td colspan="2" class="borde borde2">{{ $cliente->puerto_embarque }}</td>
            </tr>
            <tr>
                <td colspan="2" class="font_peque bold">Puerto Embarque</td>
            </tr>
            <tr>
                <td colspan="2" class="borde borde2">{{ $cliente->puerto_destino->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2" class="font_peque bold">Puerto Destino</td>
            </tr>
            <tr>
                <td colspan="2" class="borde borde2">{{ $cliente->destino_final->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2" class="font_peque bold">Destino Final</td>
            </tr>
            <tr>
                <td class="borde borde2">{{ $cliente->etd }}</td>
                <td class="borde borde2">{{ $cliente->eta }}</td>
            </tr>
            <tr>
                <td class="font_peque bold">ETD</td>
                <td class="font_peque bold">ETA</td>
            </tr>
            <tr>
                <td class="borde borde2">{{ $cliente->nro_total1 }}</td>
                <td class="borde borde2">{{ $cliente->units1->nombre }}</td>
            </tr>
            <tr>
                <td class="font_peque bold">Nro. Total</td>
                <td class="font_peque bold">Units</td>
            </tr>
            <tr>
                <td class="borde borde2">{{ $cliente->nro_total2 }}</td>
                <td class="borde borde2">{{ $cliente->units2->nombre }}</td>
            </tr>
            <tr>
                <td class="font_peque bold">Nro. Total</td>
                <td class="font_peque bold">Units</td>
            </tr>
            <tr>
                <td colspan="2" class="borde borde2">{{ $cliente->socio_proveedor->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2" class="font_peque bold">Socio/Proveedor</td>
            </tr>
            <tr>
                <td colspan="2" class="borde borde2">{{ $cliente->embarcado->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2" class="font_peque bold">Embarcado con</td>
            </tr>
            <tr>
                <td class="borde borde2">{{ $cliente->flete_master }}</td>
                <td class="borde borde2">{{ $cliente->flete_house }}</td>
            </tr>
            <tr>
                <td class="font_peque bold">Flete Master</td>
                <td class="font_peque bold">Flete House</td>
            </tr>
        </tbody>
    </table>

    <hr style="margin-top: 65px;">
    <table class="notas">
        <tr>
            <td>NOTAS</td>
            <td>{{ $cliente->notas }}</td>
        </tr>
    </table>

    @php
        $ingresos = $cliente->cliente_ingresos;
        $egresos = $cliente->cliente_egresos;
        
        $restantes_egresos = 0;
        $restantes_ingresos = 0;
        if (count($ingresos) > count($egresos)) {
            $restantes_egresos = count($ingresos) - count($egresos);
        } else {
            $restantes_ingresos = count($egresos) - count($ingresos);
        }
    @endphp
    <div class="ingresos_egresos">
        <div class="titulos">
            <div>EGRESOS</div>
            <div>INGRESOS</div>
        </div>
        <div class="registros">
            @foreach ($egresos as $egreso)
                <div class="registro br-dotted">
                    <div class="col">{{ $egreso->descripcion }}</div>
                    <div class="col">{{ $egreso->monto }} USD</div>
                </div>
            @endforeach
            @for ($i = 1; $i <= $restantes_egresos; $i++)
                <div class="registro br-dotted">
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            @endfor
            <div class="registro br-dotted">
                <div class="col bold txt_right">TOTALES:</div>
                <div class="col bt-dotted">{{ $cliente->total_egresos }} USD</div>
            </div>
        </div>
        <div class="registros">
            @foreach ($ingresos as $ingreso)
                <div class="registro bl-dotted">
                    <div class="col">{{ $ingreso->descripcion }}</div>
                    <div class="col">{{ $ingreso->monto }} USD</div>
                </div>
            @endforeach
            @for ($i = 1; $i <= $restantes_ingresos; $i++)
                <div class="registro bl-dotted">
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            @endfor
            <div class="registro bl-dotted">
                <div class="col bold txt_right">TOTALES:</div>
                <div class="col bt-dotted">{{ $cliente->total_ingresos }} USD</div>
            </div>
        </div>
    </div>

    <table class="profit">
        <tbody>
            <tr>
                <td class="bold" width="20%">PROFIT:</td>
                <td>{{ $cliente->profit }} USD</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
