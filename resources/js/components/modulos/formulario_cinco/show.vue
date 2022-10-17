<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalle Formulario 5 - <small>Detalles</small></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <router-link
                            :to="{ name: 'formulario_cinco.index' }"
                            class="btn btn-primary btn-block btn-flat"
                            ><i class="fa fa-arrow-left"></i>
                            Volver</router-link
                        >
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3
                                            class="card-title w-full font-weight-bold"
                                        >
                                            <i class="fas fa-list"></i>
                                            Detalle Registro
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="contenedor_tabla">
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
                                            <template
                                                v-for="(
                                                    operacion, index_detalle
                                                ) in oFormularioCinco.operacions"
                                            >
                                                <tr>
                                                    <td>
                                                        {{
                                                            operacion.operacion
                                                                .codigo_operacion
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            operacion.operacion
                                                                .operacion
                                                        }}
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .actividad_tareas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="tarea in lugar.actividad_tareas"
                                                            >
                                                                {{
                                                                    tarea
                                                                        .detalle_operacion
                                                                        .codigo_tarea
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .actividad_tareas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="tarea in lugar.actividad_tareas"
                                                            >
                                                                {{
                                                                    tarea
                                                                        .detalle_operacion
                                                                        .actividad_tarea
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                v-for="lugar in operacion.lugar_responsables"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                operacion
                                                                                    .lugar_responsables
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                            >
                                                                {{
                                                                    lugar.lugar
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                v-for="lugar in operacion.lugar_responsables"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                operacion
                                                                                    .lugar_responsables
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                            >
                                                                {{
                                                                    lugar.responsable
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.partida
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.descripcion
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.cantidad
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.unidad
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.costo
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.t42
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{ partida.ue }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.prog
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.act
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="td_componente">
                                                        <div
                                                            class="contenedor_tarea"
                                                            v-for="lugar in operacion.lugar_responsables"
                                                            :style="{
                                                                height:
                                                                    100 /
                                                                        parseFloat(
                                                                            operacion
                                                                                .lugar_responsables
                                                                                .length
                                                                        ) +
                                                                    '%',
                                                            }"
                                                        >
                                                            <div
                                                                class="tarea"
                                                                :style="{
                                                                    height:
                                                                        100 /
                                                                            parseFloat(
                                                                                lugar
                                                                                    .partidas
                                                                                    .length
                                                                            ) +
                                                                        '%',
                                                                }"
                                                                v-for="partida in lugar.partidas"
                                                            >
                                                                {{
                                                                    partida.otros
                                                                }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{
                                                            operacion.total_operacion
                                                        }}
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Operacion from "./Operacion.vue";
export default {
    components: {
        Operacion,
    },
    props: ["id"],
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            oFormularioCinco: {
                operacions: [],
            },
        };
    },
    mounted() {
        this.getFormularioCinco();
        this.loadingWindow.close();
    },
    methods: {
        // OBTENER EL REGISTRO DETALLE FORMULARIO
        getFormularioCinco() {
            axios.get("/admin/formulario_cinco/" + this.id).then((response) => {
                this.oFormularioCinco = response.data.formulario_cinco;
            });
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style>
#contenedor_tabla {
    width: 100%;
    overflow: auto;
}
.tabla_detalle {
    width: 100%;
    border-collapse: collapse;
    height: 1px;
}

.tabla_detalle thead tr th,
.tabla_detalle tbody tr td {
    padding: 3px;
    font-size: 0.7rem !important;
    text-align: center;
    border: solid 1px;
}
.td_componente {
    padding: 0px !important;
}

.contenedor_tarea {
    height: 100%;
}

.contenedor_tarea .tarea {
    display: flex;
    align-items: center;
    justify-content: center;
}
.contenedor_tarea .tarea {
    border-bottom: solid 1px;
}

.contenedor_tarea:last-child .tarea:last-child {
    border-bottom: none;
}
</style>
