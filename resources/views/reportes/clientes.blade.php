<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 0.1cm;
            margin-right: 0.1cm;
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
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.6em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.43em;
            vertical-align: top;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
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

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
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
        <h4 class="texto">LISTA DE CLIENTES</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Nro. File</th>
                <th>Tipo de Embarque</th>
                <th>Venta</th>
                <th>Oficina</th>
                <th>Cliente</th>
                <th>Cnne</th>
                <th>Contacto</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Teléfono</th>
                <th>Fax</th>
                <th>Nro. NIT</th>
                <th>Master</th>
                <th>House</th>
                <th>Docs. Contra Pago</th>
                <th>HBL al cnee fletado</th>
                <th>Flete menor</th>
                <th>Cuanto</th>
                <th>Puerto de Embarque</th>
                <th>Puerto de Destino</th>
                <th>Destino Final</th>
                <th>ETD</th>
                <th>ETA</th>
                <th>Nro. Total</th>
                <th>Units</th>
                <th>Nro. Total</th>
                <th>Units</th>
                <th>Socio Proveedor</th>
                <th>Embarcado con</th>
                <th>Flete master</th>
                <th>Flete house</th>
                <th>Notas</th>
                <th>Total Ingresos</th>
                <th>Total Egresos</th>
                <th>Profit</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->file_nro}}</td>
                <td>{{$cliente->tipo_embarque->nombre}}</td>
                <td>{{$cliente->venta}}</td>
                <td>{{$cliente->oficina->nombre}}</td>
                <td>{{$cliente->cliente}}</td>
                <td>{{$cliente->cnee}}</td>
                <td>{{$cliente->contacto}}</td>
                <td>{{$cliente->dir}}</td>
                <td>{{$cliente->ciudad}}</td>
                <td>{{$cliente->fono}}</td>
                <td>{{$cliente->fax}}</td>
                <td>{{$cliente->nro_nit}}</td>
                <td>{{$cliente->master}}</td>
                <td>{{$cliente->house}}</td>
                <td>{{$cliente->documentos_cp}}</td>
                <td>{{$cliente->hbl_ai_cnee_fletado}}</td>
                <td>{{$cliente->flete_menor}}</td>
                <td>{{$cliente->cuanto}}</td>
                <td>{{$cliente->puerto_embarque}}</td>
                <td>{{$cliente->puerto_destino->nombre}}</td>
                <td>{{$cliente->destino_final->nombre}}</td>
                <td>{{$cliente->etd}}</td>
                <td>{{$cliente->eta}}</td>
                <td>{{$cliente->nro_total1}}</td>
                <td>{{$cliente->units1->nombre}}</td>
                <td>{{$cliente->nro_total2}}</td>
                <td>{{$cliente->units2->nombre}}</td>
                <td>{{$cliente->socio_proveedor->nombre}}</td>
                <td>{{$cliente->embarcado->nombre}}</td>
                <td>{{$cliente->flete_master}}</td>
                <td>{{$cliente->flete_house}}</td>
                <td>{{$cliente->notas}}</td>
                <td>{{$cliente->total_ingresos}}</td>
                <td>{{$cliente->total_egresos}}</td>
                <td>{{$cliente->profit}}</td>
                <td>{{$cliente->fecha_registro}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
