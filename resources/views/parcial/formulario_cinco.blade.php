<table class="tabla_detalle">
    <thead>
        <tr>
            <th colspan="17">
                PLAN OPERATIVO ANUAL GESTIÓN
                2022
            </th>
        </tr>
        <tr>
            <th rowspan="3">
                Código Operación(1)
            </th>
            <th rowspan="3">
                Operación(2)
            </th>
            <th rowspan="3">
                Código tarea(3)
            </th>
            <th rowspan="3">
                Actividad/Tareas(4)
            </th>
            <th rowspan="3">
                Lugar de ejecución de la
                Operación(5)
            </th>
            <th rowspan="3">
                Responsable de ejecución de
                la Operación/Tarea (6)
            </th>
            <th colspan="11">
                Desglose Presupuestario
            </th>
        </tr>
        <tr>
            <th rowspan="2">Partida(7)</th>
            <th rowspan="2">
                Descripción(8)
            </th>
            <th rowspan="2">Cantidad(9)</th>
            <th rowspan="2">Unida(10)</th>
            <th rowspan="2">
                Costo Unitario(11)
            </th>
            <th colspan="4">
                Recursos Internos(12)
            </th>
            <th>Recursos externos(13)</th>
            <th rowspan="2">
                TOTAL (por Operación)(14)
            </th>
        </tr>
        <tr>
            <th>TRANSF 42</th>
            <th>UE</th>
            <th>PROG</th>
            <th>ACT</th>
            <th>OTROS</th>
        </tr>
    </thead>
    <tbody>
        @php
            $tarea_actual = 0;
            $muestra = true;
        @endphp
        @foreach ($formulario_cinco->operacions as $index_operacion => $operacion)
            @foreach ($operacion->lugar_responsables as $index_lugar => $lugar)
                @foreach ($lugar->partidas as $index_partida => $partida)
                    <tr>
                        @if ($index_lugar == 0 && $index_partida == 0)
                            <td rowspan="{{ $operacion->total_partidas }}">
                                {{ $operacion->operacion->codigo_operacion }}
                            </td>
                            <td rowspan="{{ $operacion->total_partidas }}">
                                {{ $operacion->operacion->operacion }}
                            </td>
                        @endif
                        {{-- VERIFICAR TAREA --}}
                        @php
                            if ($partida->actividad_tarea_id == $tarea_actual) {
                                $muestra = false;
                            } else {
                                $tarea_actual = $partida->actividad_tarea_id;
                                $muestra = true;
                            }
                        @endphp
                        @if ($muestra)
                            <td rowspan="{{ $partida->total_por_actividad }}">
                                {{ $partida->actividad_tarea->detalle_operacion->codigo_tarea }}</td>
                            <td rowspan="{{ $partida->total_por_actividad }}">
                                {{ $partida->actividad_tarea->descripcion }}</td>
                        @endif
                        @if ($index_partida == 0)
                            <td rowspan="{{ count($lugar->partidas) }}">
                                {{ $lugar->lugar }}
                            </td>
                            <td rowspan="{{ count($lugar->partidas) }}">
                                {{ $lugar->responsable }}
                            </td>
                        @endif
                        <td>{{ $partida->partida }}</td>
                        <td>{{ $partida->descripcion }}</td>
                        <td>{{ $partida->cantidad }}</td>
                        <td>{{ $partida->unidad }}</td>
                        <td>{{ $partida->costo }}</td>
                        <td>{{ $partida->t42 }}</td>
                        <td>{{ $partida->ue }}</td>
                        <td>{{ $partida->prog }}</td>
                        <td>{{ $partida->act }}</td>
                        <td>{{ $partida->otros }}</td>
                        @if ($index_lugar == 0 && $index_partida == 0)
                            <td rowspan="{{ $operacion->total_partidas }}">
                                {{ number_format($operacion->total_operacion, 2) }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="16">TOTAL</th>
            <th>{{ number_format($formulario_cinco->total_formulario, 2) }}</th>
        </tr>
    </tfoot>
</table>
