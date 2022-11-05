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
                                        <thead class="bg-primary">
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
                                            <tr
                                                v-for="item in oFormularioCinco
                                                    .memoria.operacions"
                                            >
                                                <td>
                                                    {{ item.codigo_operacion }}
                                                </td>
                                                <td>
                                                    {{
                                                        item.descripcion_operacion
                                                    }}
                                                </td>
                                                <td>
                                                    {{ item.codigo_actividad }}
                                                </td>
                                                <td>
                                                    {{
                                                        item.descripcion_actividad
                                                    }}
                                                </td>
                                                <td>
                                                    {{ item.lugar }}
                                                </td>
                                                <td>
                                                    {{ item.responsable }}
                                                </td>
                                                <td>
                                                    {{ item.partida }}
                                                </td>
                                                <td>
                                                    {{ item.descripcion }}
                                                </td>
                                                <td>
                                                    {{ item.cantidad }}
                                                </td>
                                                <td>
                                                    {{ item.unidad }}
                                                </td>
                                                <td>
                                                    {{ item.costo }}
                                                </td>
                                                <td>
                                                    {{ item.total }}
                                                </td>
                                                <td>
                                                    {{ item.ue }}
                                                </td>
                                                <td>
                                                    {{ item.prog }}
                                                </td>
                                                <td>
                                                    {{ item.act }}
                                                </td>
                                                <td>
                                                    {{ item.justificacion }}
                                                </td>
                                                <td>
                                                    {{ item.total_operacion }}
                                                </td>
                                            </tr>
                                            <tr class="bg-primary">
                                                <th colspan="16">TOTAL</th>
                                                <th>
                                                    {{
                                                        oFormularioCinco.memoria
                                                            .total_final
                                                    }}
                                                </th>
                                            </tr>
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
export default {
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
            tabla: "",
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
        getTabla() {
            axios
                .get(
                    "/admin/formulario_cinco/tabla/getTabla/" +
                        this.oFormularioCinco.id
                )
                .then((response) => {
                    this.tabla = response.data;
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
