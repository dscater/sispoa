<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Manifiesto</title>
    <style type="text/css">
        * {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            font-size: 10pt;
        }

        .encabezado {
            width: 400px;
            margin: auto;
            text-align: center;
        }

        .empresa {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .dir,
        .ciudad {
            font-size: 0.7rem;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        table tbody tr td {
            vertical-align: top;
            padding: 5px;
            font-size: 0.8rem;
        }

        .borde {
            border: dotted 1px black;
        }

        .bold {
            font-weight: bold
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="encabezado empresa">
        {{ $configuracion->first()->razon_social }}
    </div>
    <div class="encabezado dir">
        {{ $configuracion->first()->dir }}
    </div>
    <div class="encabezado ciudad">
        {{ $configuracion->first()->ciudad }}
    </div>

    <table>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="borde">Date Of Issue<br />{{ $manifiesto->date_issue }}</td>
            </tr>
            <tr>
                <td class="borde" colspan="2">Shipper</td>
                <td class="borde" width="14%">Consignee</td>
                <td class="borde">Ocean Vessel <br />{{ $manifiesto->ocean_vessel }}</td>
                <td class="borde">Voyage No <br />{{ $manifiesto->voyage_nro }}</td>
                <td class="borde">Place of Issue<br />{{ $manifiesto->place_issue }}</td>
            </tr>
            <tr>
                <td class="borde" colspan="2">{!! $manifiesto->shipper->nombre !!}</td>
                <td class="borde">{!! $manifiesto->consignee !!}</td>
                <td class="borde">Place of Loading<br />{{ $manifiesto->cliente->puerto_embarque }}</td>
                <td class="borde">Place of Discharge<br />{{ $manifiesto->port_discharge }}</td>
                <td class="borde">Place of Delivery<br />{{ $manifiesto->cliente->puerto_destino->nombre }}</td>
            </tr>
            <tr>
                <td class="borde" width="10%">Master Bill of Lading</td>
                <td class="borde" width="10%">Marcas y Números</td>
                <td class="borde" colspan="3">Descripción de la Carga</td>
                <td class="borde">Peso (KGS) Gross Weight</td>
            </tr>
            <tr>
                <td class="borde">{{ $manifiesto->cliente->master }}</td>
                <td class="borde">{!! $manifiesto->marcas_numeros !!}</td>
                <td class="borde" colspan="3">
                    {!! $manifiesto->descripcion !!}
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class="bold"> CARGA EN TRANSITO A BOLIVIA</span>
                    <br>
                    EL B/L SE DESGLOSA DE ACUERDO A LOS SIGUIENTES HB/LS
                </td>
                <td class="borde">{{ number_format($manifiesto->peso, 2) }}</td>
            </tr>
            <tr>
                <td class="borde" colspan="2">Shipper</td>
                <td class="borde" width="14%">Consignee</td>
                <td class="borde">Ocean Vessel <br />{{ $manifiesto->ocean_vessel2 }}</td>
                <td class="borde">Voyage No <br />{{ $manifiesto->voyage_nro2 }}</td>
                <td class="borde">Place of Issue<br />{{ $manifiesto->place_issue2 }}</td>
            </tr>
            <tr>
                <td class="borde" colspan="2">{!! $manifiesto->shipper_texto !!}</td>
                <td class="borde">{!! $manifiesto->consignee2 !!}</td>
                <td class="borde">Place of Loading<br />{{ $manifiesto->cliente->puerto_embarque }}</td>
                <td class="borde">Place of Delivery<br />{{ $manifiesto->cliente->puerto_destino->nombre }}</td>
                <td class="borde">Final Destination<br />{{ $manifiesto->cliente->destino_final->nombre }}</td>
            </tr>
            <tr>
                <td class="borde" width="10%">MBL/HBL</td>
                <td class="borde" width="10%">Marcas y Números</td>
                <td class="borde" colspan="3">Descripción de la Carga</td>
                <td class="borde">Peso (KGS) Gross Weight</td>
            </tr>
            <tr>
                <td class="borde">{!! $manifiesto->mbl_hbl !!}</td>
                <td class="borde">{!! $manifiesto->marcas_numeros2 !!}</td>
                <td class="borde" colspan="3">{!! $manifiesto->descripcion2 !!}</td>
                <td class="borde">{{ number_format($manifiesto->peso2, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
