<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>HBL</title>
    <style type="text/css">
        * {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            font-size: 10pt;
        }

        .tipo {
            width: 250PX;
            margin-left: auto;
            text-align: right;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table tbody tr td {
            font-size: 0.7rem;
        }

        .house {
            font-size: 1.4rem;
        }

        .bold {
            font-weight: bold;
        }

        .b1 {
            margin-top: 20px;
        }

        .b1 tbody tr td:nth-child(2) {
            padding-left: 60px;
            text-align: right;
        }

        .b2 {
            margin-top: 30px;
        }

        .b3 tbody tr td,
        .b4 tbody tr td {
            height: 40px;
        }

        .b6 {
            margin-top: 40px;
        }

        .b6 tbody tr td {
            vertical-align: top;
        }

        .b7 {
            margin-top: 40px;
        }

        .b8 {
            margin-top: 30px;
        }

        .b9 {
            margin-top: 80px;
        }

        .centreado {
            text-align: center;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')

    <div class="tipo">{{ $tipo }}</div>
    <table class="b1">
        <tbody>
            <tr>
                <td>
                    {!! $cliente->manifiesto->shipper_texto !!}
                </td>
                <td>
                    <span class="house bold">{{ $cliente->house }}</span> <br>
                    <span class="master"> {{ $cliente->master }}</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="b2">
        <tbody>
            <tr>
                <td width="50%">
                    {{ $cliente->cliente }} <br />
                    NIT: {{ $cliente->nro_nit }} <br />
                    {{ $cliente->oficina->nombre }} <br />
                </td>
                <td>
                    {{ $configuracion->first()->razon_social }}<br />
                    {{ $configuracion->first()->dir }}<br />
                    {{ $configuracion->first()->ciudad }}<br />
                    {{ $configuracion->first()->fono }}<br />
                </td>
            </tr>
        </tbody>
    </table>

    <table class="b3">
        <tbody>
            <tr>
                <td width="20%">
                    SAME AS CONSIGNEE
                </td>
                <td></td>
            </tr>
            <tr>
                <td>XXXXXXXXXXXXXXXXX</td>
                <td>XXXXXXXXXXXXXXXXX</td>
            </tr>
        </tbody>
    </table>

    <table class="b4">
        <tbody>
            <tr>
                <td width="25%">{{ $cliente->manifiesto->ocean_vessel }}</td>
                <td width="15%">{{ $cliente->manifiesto->voyage_nro }}</td>
                <td>{{ $cliente->puerto_embarque }}</td>
            </tr>
        </tbody>
    </table>

    <table class="b5">
        <tbody>
            <tr>
                <td width="40%">{{ $cliente->manifiesto->port_discharge }}</td>
                <td>{{ $cliente->puerto_destino->nombre }}</td>
            </tr>
        </tbody>
    </table>

    <table class="b6">
        <tbody>
            <tr>
                <td width="10%">{!! $cliente->manifiesto->marcas_numeros !!}</td>
                <td width="10%">{{ $cliente->units1->nombre }}</td>
                <td>{!! $cliente->manifiesto->descripcion !!}</td>
                <td width="10%">{{ $cliente->manifiesto->peso }}</td>
                <td width="10%">{{ $cliente->units2->nombre }}</td>
            </tr>
        </tbody>
    </table>

    <table class="b7">
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td width="30%">{{ $cliente->puerto_embarque }}
                    {{ date('d/m/Y', strtotime($cliente->manifiesto->date_issue)) }}
                </td>
            </tr>
        </tbody>
    </table>

    <table class="b8">
        <tbody>
            @foreach ($cliente->cliente_ingresos as $key => $ingreso)
                <tr>
                    <td width="30%">US DOLAR</td>
                    <td width="30%">{{ $ingreso->descripcion }}<br />{{ number_format($ingreso->monto, 2) }}</td>
                    <td>
                        @if ($key == 0)
                            No BILL OF LADING: <span class="bold">{{ $cliente->house }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="b9">
        <tbody>
            <tr>
                <td width="30%">US DOLAR</td>
                <td>{{ number_format($cliente->total_ingresos, 2) }}</td>
        </tbody>
    </table>
</body>

</html>
