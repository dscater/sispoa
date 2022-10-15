<template>
    <div
        class="row border mb-3 p-2 detalle"
        :class="[(index + 1) % 2 == 0 ? 'bg-gray-light' : 'bg-light']"
    >
        <span class="rounded-circle numero_detalle" v-text="index + 1"></span>
        <button class="btn btn-danger rounded-circle btnQuitar" @click="quitar">
            X
        </button>
        <div class="form-group col-md-6">
            <label
                :class="{
                    'text-danger': errors.codigo_operacion,
                }"
                >Código de Operación.*</label
            >
            <el-select
                filterable
                class="w-100 d-block"
                :class="{
                    'is-invalid': errors.operacion_id,
                }"
                v-model="o_Operacion.operacion_id"
                clearable
                @change="getTextoOperacion"
            >
                <el-option
                    v-for="item in listOperaciones"
                    :key="item.id"
                    :value="item.id"
                    :label="item.codigo_operacion"
                >
                </el-option>
            </el-select>
            <span
                class="error invalid-feedback"
                v-if="errors.codigo_operacion"
                v-text="errors.codigo_operacion[0]"
            ></span>
        </div>

        <div class="form-group col-md-6">
            <label
                :class="{
                    'text-danger': errors.operacion,
                }"
                >Operación*</label
            >

            <el-input
                type="textarea"
                autosize
                placeholder="Operación"
                :class="{
                    'is-invalid': errors.operacion,
                }"
                v-model="texto_operacion"
                clearable
                readonly
            >
            </el-input>
            <span
                class="error invalid-feedback"
                v-if="errors.operacion"
                v-text="errors.operacion[0]"
            ></span>
        </div>

        <div
            class="row"
            v-for="(detalle_lr, index) in o_Operacion.lugar_responsables"
        >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-black">
                        <button
                            class="btn btn-danger rounded-circle btnQuitar"
                            @click="quitarDetalleLR(index, detalle_lr.id)"
                            v-if="index > 0"
                        >
                            X
                        </button>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors['lugar.' + index],
                                    }"
                                    >Lugar de ejecución de la Operación*</label
                                >
                                <el-input
                                    placeholder="Lugar de ejecución de la Operación"
                                    :class="{
                                        'is-invalid': errors['lugar.' + index],
                                    }"
                                    v-model="detalle_lr.lugar"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors['lugar.' + index]"
                                    v-text="errors['lugar.' + index][0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger':
                                            errors['responsable.' + index],
                                    }"
                                    >Responsable de ejecución de la operación
                                    Tarea*</label
                                >
                                <el-input
                                    placeholder="Responsable de ejecución de la operación Tarea"
                                    :class="{
                                        'is-invalid':
                                            errors['responsable.' + index],
                                    }"
                                    v-model="detalle_lr.responsable"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors['responsable.' + index]"
                                    v-text="errors['responsable.' + index][0]"
                                ></span>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card contenedor_tabla">
                                        <div
                                            class="card-header d-flex justify-content-between"
                                        >
                                            <button
                                                class="btn btn-sm bg-teal"
                                                @click="
                                                    agregarTarea(
                                                        index,
                                                        detalle_lr
                                                    )
                                                "
                                            >
                                                <i class="fa fa-plus"></i>
                                                Agregar
                                            </button>
                                            <h4 class="titulo_destalle">
                                                Actividades/Tareas
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <table
                                                class="table table-bordered tabla_detalle"
                                            >
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center"
                                                            width="60px"
                                                        >
                                                            Código tarea
                                                        </th>
                                                        <th class="text-center">
                                                            Actividades/Tareas
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            tarea, index_tarea
                                                        ) in detalle_lr.actividad_tareas"
                                                        :key="index_tarea"
                                                    >
                                                        <td>
                                                            <select
                                                                v-model="
                                                                    tarea.detalle_operacion_id
                                                                "
                                                                class="form-control"
                                                                @change="
                                                                    setTextoTarea(
                                                                        index,
                                                                        index_tarea,
                                                                        $event
                                                                    )
                                                                "
                                                            >
                                                                <option
                                                                    v-for="detalle_operacion in o_Operacion.detalle_operaciones"
                                                                    :key="
                                                                        detalle_operacion.id
                                                                    "
                                                                    :value="
                                                                        detalle_operacion.id
                                                                    "
                                                                >
                                                                    {{
                                                                        detalle_operacion.codigo_tarea
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </td>

                                                        <td class="eliminar">
                                                            <el-input
                                                                type="textarea"
                                                                autosize
                                                                placeholder="Actividades/Tareas"
                                                                v-model="
                                                                    tarea.descripcion
                                                                "
                                                            >
                                                            </el-input>
                                                            <button
                                                                class="btn btn-danger rounded-circle btnQuitar"
                                                                v-if="
                                                                    index_tarea >
                                                                    0
                                                                "
                                                                @click="
                                                                    quitarTarea(
                                                                        index,
                                                                        index_tarea,
                                                                        tarea.id
                                                                    )
                                                                "
                                                            >
                                                                X
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card contenedor_tabla">
                                        <div
                                            class="card-header d-flex justify-content-between"
                                        >
                                            <button
                                                class="btn btn-sm bg-teal"
                                                @click="
                                                    agregarPartida(
                                                        index,
                                                        detalle_lr
                                                    )
                                                "
                                            >
                                                <i class="fa fa-plus"></i>
                                                Agregar
                                            </button>
                                            <h4 class="titulo_destalle">
                                                Partidas
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <table
                                                class="table table-bordered tabla_detalle"
                                            >
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center"
                                                            rowspan="2"
                                                        >
                                                            Partida
                                                        </th>
                                                        <th
                                                            class="text-center"
                                                            rowspan="2"
                                                        >
                                                            Descripción
                                                        </th>
                                                        <th
                                                            class="text-center"
                                                            rowspan="2"
                                                        >
                                                            Cantidad
                                                        </th>
                                                        <th
                                                            class="text-center"
                                                            rowspan="2"
                                                        >
                                                            Unidad de Medida
                                                        </th>
                                                        <th
                                                            class="text-center"
                                                            rowspan="2"
                                                        >
                                                            Costo Unitario
                                                        </th>
                                                        <th
                                                            class="text-center"
                                                            colspan="4"
                                                        >
                                                            Recursos internos
                                                        </th>
                                                        <th class="text-center">
                                                            Recursos externos
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">
                                                            TRANSF 42
                                                        </th>
                                                        <th class="text-center">
                                                            UE
                                                        </th>
                                                        <th class="text-center">
                                                            PROG
                                                        </th>
                                                        <th class="text-center">
                                                            ACT
                                                        </th>
                                                        <th class="text-center">
                                                            OTROS
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            partida,
                                                            index_partida
                                                        ) in detalle_lr.partidas"
                                                        :key="index_partida"
                                                    >
                                                        <td>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    partida.partida
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <el-input
                                                                type="textarea"
                                                                autosize
                                                                placeholder="Descripción"
                                                                v-model="
                                                                    partida.descripcion
                                                                "
                                                            >
                                                            </el-input>
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                v-model="
                                                                    partida.cantidad
                                                                "
                                                                @change="
                                                                    calculaTotales
                                                                "
                                                                @keyup="
                                                                    calculaTotales
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    partida.unidad
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                v-model="
                                                                    partida.costo
                                                                "
                                                                @change="
                                                                    calculaTotales
                                                                "
                                                                @keyup="
                                                                    calculaTotales
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                v-model="
                                                                    partida.t42
                                                                "
                                                                class="form-control"
                                                                readonly
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    partida.ue
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    partida.prog
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    partida.act
                                                                "
                                                                class="form-control"
                                                            />
                                                        </td>
                                                        <td class="eliminar">
                                                            <el-input
                                                                type="textarea"
                                                                autosize
                                                                placeholder="Otros"
                                                                v-model="
                                                                    partida.otros
                                                                "
                                                            >
                                                            </el-input>
                                                            <button
                                                                class="btn btn-danger rounded-circle btnQuitar"
                                                                v-if="
                                                                    index_partida >
                                                                    0
                                                                "
                                                                @click="
                                                                    quitarPartida(
                                                                        index,
                                                                        index_partida,
                                                                        partida.id
                                                                    )
                                                                "
                                                            >
                                                                X
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>
                            TOTAL:
                            {{
                                o_Operacion.total_operacion &&
                                o_Operacion.total_operacion != ""
                                    ? parseFloat(
                                          o_Operacion.total_operacion
                                      ).toFixed(2)
                                    : "0.00"
                            }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- BOTON AGREGAR DETALLE -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <button
                            class="btn btn-default btn-flat btn-block"
                            @click="agregarDetalleLR"
                        >
                            <i class="fa fa-plus"></i>
                            Agregar Detalle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        index: {
            type: Number,
            default: 0,
        },
        formulario_id: {
            type: String,
            default: "",
        },
        operacion: {
            type: Object,
            default: {
                id: 0,
                formulario_cinco_id: "",
                operacion_id: "",
                total_operacion: "",
                lugar_responsables: [],
                detalle_operaciones: [],
            },
        },
        accion: {
            type: String,
            default: "create",
        },
    },
    data() {
        return {
            sw_accion: this.accion,
            errors: [],
            o_Operacion: this.operacion,
            formulario_cuatro_id: this.formulario_id,
            listOperaciones: [],
            texto_operacion: "",
        };
    },
    mounted() {
        this.getOperacionesFormulario();
        if (this.o_Operacion.id == 0) {
            this.o_Operacion.lugar_responsables = [];
            this.o_Operacion.lugar_responsables.push({
                id: 0,
                fco_id: "",
                lugar: "",
                responsable: "",
                actividad_tareas: [
                    {
                        id: 0,
                        fco_id: "",
                        detalle_operacion_id: "",
                        lugar_responsable_id: 0,
                    },
                ],
                partidas: [
                    {
                        id: 0,
                        lugar_responsable_id: 0,
                        partida: "",
                        descripcion: "",
                        cantidad: "",
                        unidad: "",
                        costo: "",
                        t42: "",
                        ue: "",
                        prog: "",
                        act: "",
                        otros: "",
                    },
                ],
            });
        }
    },
    watch: {
        formulario_id(newVal, oldVal) {
            this.formulario_cuatro_id = newVal;
            this.getOperacionesFormulario();
            this.o_Operacion.operacion_id = "";
            this.texto_operacion = "";
        },
        texto_operacion() {
            axios
                .get("/admin/operacions/getTareas", {
                    params: { id: this.o_Operacion.operacion_id },
                })
                .then((response) => {
                    setTimeout(() => {
                        if (this.o_Operacion.id != 0) {
                            let aux_texto = this.texto_operacion;
                            this.texto_operacion = "";
                            this.texto_operacion = aux_texto;
                        }
                        this.o_Operacion.detalle_operaciones = response.data;
                    }, 500);
                });
        },
    },
    methods: {
        // OBTENER LAS OPERACIONES DEL FORMULARIO CUATRO
        getOperacionesFormulario() {
            axios
                .get("/admin/formulario_cuatro/getOperaciones", {
                    params: { id: this.formulario_cuatro_id },
                })
                .then((response) => {
                    this.listOperaciones = response.data;
                    if (this.o_Operacion.operacion_id != "") {
                        this.getTextoOperacion();
                    }
                });
        },
        getTextoOperacion() {
            let item = this.listOperaciones.filter(
                (value) => value.id == this.o_Operacion.operacion_id
            );
            if (item.length > 0) {
                this.texto_operacion = item[0].operacion;
            } else {
                this.texto_operacion = "";
            }
            // axios
            //     .get("/admin/operacions/getTareas", {
            //         params: { id: this.o_Operacion.operacion_id },
            //     })
            //     .then((response) => {
            //         this.o_Operacion.detalle_operaciones = response.data;
            //     });
        },

        // QUITAR OPERACION
        quitar() {
            this.o_Operacion.lugar_responsables = [];
            this.$emit("quitar", this.index, this.operacion);
        },
        // ACCIONES SOBRE EL DETALLE DE OPERACIONES
        agregarDetalleLR() {
            this.o_Operacion.lugar_responsables.push({
                id: 0,
                fco_id: "",
                lugar: "",
                responsable: "",
                actividad_tareas: [
                    {
                        id: 0,
                        fco_id: "",
                        detalle_operacion_id: "",
                        lugar_responsable_id: 0,
                    },
                ],
                partidas: [
                    {
                        id: 0,
                        lugar_responsable_id: 0,
                        partida: "",
                        descripcion: "",
                        cantidad: "",
                        unidad: "",
                        costo: "",
                        t42: "",
                        ue: "",
                        prog: "",
                        act: "",
                        otros: "",
                    },
                ],
            });
        },
        quitarDetalleLR(index, id) {
            this.o_Operacion.lugar_responsables.splice(index, 1);
            if (id != 0) {
                this.$emit("quitar_detalle", id);
            }
        },

        // ACCIONES PARA AGREGAR TAREAS Y PARTIDAS
        agregarTarea(index, item) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas.push({
                id: 0,
                fco_id: "",
                detalle_operacion_id: "",
                lugar_responsable_id: item.id,
            });
        },
        agregarPartida(index, item) {
            this.o_Operacion.lugar_responsables[index].partidas.push({
                id: 0,
                lugar_responsable_id: item.id,
                partida: "",
                descripcion: "",
                cantidad: "",
                unidad: "",
                costo: "",
                t42: "",
                ue: "",
                prog: "",
                act: "",
                otros: "",
            });
        },
        setTextoTarea(index, index_tarea, event) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas[
                index_tarea
            ].descripcion = this.o_Operacion.detalle_operaciones.filter(
                (item) => item.id == event.target.value
            )[0].actividad_tarea;
        },
        quitarTarea(index, index_tarea, id = 0) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas.splice(
                index_tarea,
                1
            );
            if (id != 0) {
                this.$emit("quitar_tarea", id);
            }
        },
        quitarPartida(index, index_partida, id = 0) {
            this.o_Operacion.lugar_responsables[index].partidas.splice(
                index_partida,
                1
            );
            if (id != 0) {
                this.$emit("quitar_partida", id);
            }
            this.calculaTotales();
        },
        calculaTotales() {
            let suma_total = 0;
            this.o_Operacion.lugar_responsables.forEach((lugar_responsable) => {
                lugar_responsable.partidas.forEach((partida) => {
                    let suma = 0;
                    if (partida.cantidad != "" && partida.costo != "") {
                        suma =
                            parseFloat(partida.cantidad) *
                            parseFloat(partida.costo);
                    }
                    partida.t42 = suma;
                    suma_total += suma;
                });
            });
            this.o_Operacion.total_operacion = suma_total;
        },
    },
};
</script>
<style>
.row.detalle {
    position: relative;
}

.numero_detalle {
    padding: 2px 0px;
    background: var(--principal);
    width: 37px;
    height: 37px;
    position: absolute;
    left: -15px;
    top: -15px;
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 1.2rem;
}

.btnQuitar {
    padding: 0px;
    width: 30px;
    height: 30px;
    position: absolute;
    right: -10px;
    top: -10px;
}

.contenedor_tabla .card-header,
.contenedor_tabla .card-body {
    padding: 10px;
}

.contenedor_tabla .card-body {
    overflow: auto;
}

.tabla_detalle tbody tr td {
    padding: 0px;
    font-size: 0.9rem;
    vertical-align: middle;
}

.tabla_detalle tbody tr td input,
.tabla_detalle tbody tr td textarea {
    padding: 2px;
    font-size: 0.7rem;
}

.tabla_detalle thead tr th {
    padding: 1px;
    font-size: 0.9rem;
}

.tabla_detalle tbody tr td input {
    min-width: 45px;
}

.titulo_destalle {
    font-size: 1.1rem;
}

td.eliminar {
    position: relative;
}

td.eliminar .btnQuitar {
    width: 20px;
    height: 20px;
    position: absolute;
    font-size: 0.8rem;
    right: -13px;
    top: 0px;
}
</style>
