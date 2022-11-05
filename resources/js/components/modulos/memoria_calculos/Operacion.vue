<template>
    <div class="card">
        <div
            class="card-body detalle contenedor_operacion"
            :class="[(index + 1) % 2 == 0 ? 'bg-white' : '']"
        >
            <span
                class="rounded-circle numero_detalle"
                v-text="index + 1"
            ></span>
            <button
                class="btn btn-danger rounded-circle btnQuitar"
                @click="quitar"
            >
                X
            </button>
            <div class="row">
                <div class="form-group col-md-3 mt-3">
                    <label
                        :class="{
                            'text-danger': errors.codigo_operacion,
                        }"
                        >Código de Operación*</label
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

                <div class="form-group col-md-9 mt-3">
                    <label>Operación*</label>

                    <el-input
                        type="textarea"
                        autosize
                        placeholder="Operación"
                        v-model="texto_operacion"
                        clearable
                        readonly
                    >
                    </el-input>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 mt-3">
                    <label
                        :class="{
                            'text-danger': errors.detalle_operacion_id,
                        }"
                        >Código Actividad/Tarea*</label
                    >
                    <el-select
                        filterable
                        class="w-100 d-block"
                        :class="{
                            'is-invalid': errors.detalle_operacion_id,
                        }"
                        v-model="o_Operacion.detalle_operacion_id"
                        clearable
                        @change="getTextoActividad"
                    >
                        <el-option
                            v-for="(
                                actividad, index
                            ) in o_Operacion.detalle_operaciones"
                            :key="actividad.id"
                            :value="actividad.id"
                            :label="actividad.codigo_tarea"
                        >
                        </el-option>
                    </el-select>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.detalle_operacion_id"
                        v-text="errors.detalle_operacion_id[0]"
                    ></span>
                </div>

                <div class="form-group col-md-9 mt-3">
                    <label>Activiadad/Tarea*</label>

                    <el-input
                        type="textarea"
                        autosize
                        placeholder="Actividad/Tarea"
                        v-model="texto_actividad"
                        clearable
                        readonly
                    >
                    </el-input>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label
                        :class="{
                            'text-danger': errors.ue,
                        }"
                        >Unidad ejecutora*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.ue,
                        }"
                        v-model="o_Operacion.ue"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.ue"
                        v-text="errors.ue[0]"
                    ></span>
                </div>
                <div class="form-group col-md-2">
                    <label
                        :class="{
                            'text-danger': errors.prog,
                        }"
                        >Programa*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.prog,
                        }"
                        v-model="o_Operacion.prog"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.prog"
                        v-text="errors.prog[0]"
                    ></span>
                </div>
                <div class="form-group col-md-2">
                    <label
                        :class="{
                            'text-danger': errors.act,
                        }"
                        >Actividad*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.act,
                        }"
                        v-model="o_Operacion.act"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.act"
                        v-text="errors.act[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.lugar,
                        }"
                        >Lugar de Ejecución de la Operación*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.lugar,
                        }"
                        v-model="o_Operacion.lugar"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.lugar"
                        v-text="errors.lugar[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.responsable,
                        }"
                        >Responsable de Ejecución de la Operación /
                        Tarea*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.responsable,
                        }"
                        v-model="o_Operacion.responsable"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.responsable"
                        v-text="errors.responsable[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.partida,
                        }"
                        >Partida de gasto*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.partida,
                        }"
                        v-model="o_Operacion.partida"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.partida"
                        v-text="errors.partida[0]"
                    ></span>
                </div>
                <div class="form-group col-md-1">
                    <label
                        :class="{
                            'text-danger': errors.nro,
                        }"
                        >Nro*</label
                    >
                    <el-input
                        class="w-100"
                        :class="{
                            'is-invalid': errors.nro,
                        }"
                        v-model="o_Operacion.nro"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.nro"
                        v-text="errors.nro[0]"
                    ></span>
                </div>
                <div class="form-group col-md-5">
                    <label
                        :class="{
                            'text-danger': errors.descripcion,
                        }"
                        >Descripción*</label
                    >
                    <el-input
                        type="textarea"
                        autosize
                        class="w-100"
                        :class="{
                            'is-invalid': errors.descripcion,
                        }"
                        v-model="o_Operacion.descripcion"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.descripcion"
                        v-text="errors.descripcion[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.cantidad,
                        }"
                        >Canitdad*</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        :class="{
                            'is-invalid': errors.cantidad,
                        }"
                        v-model="o_Operacion.cantidad"
                        clearable
                        @change="calculaTotal"
                        @keyup="calculaTotal"
                    />
                    <span
                        class="error invalid-feedback"
                        v-if="errors.cantidad"
                        v-text="errors.cantidad[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.unidad,
                        }"
                        >Unidad*</label
                    >
                    <el-input
                        class="w-full"
                        :class="{
                            'is-invalid': errors.unidad,
                        }"
                        v-model="o_Operacion.unidad"
                        clearable
                    ></el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.unidad"
                        v-text="errors.unidad[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.costo,
                        }"
                        >Precio Unitario*</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        :class="{
                            'is-invalid': errors.costo,
                        }"
                        v-model="o_Operacion.costo"
                        clearable
                        @change="calculaTotal"
                        @keyup="calculaTotal"
                    />
                    <span
                        class="error invalid-feedback"
                        v-if="errors.costo"
                        v-text="errors.costo[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.total,
                        }"
                        >Total*</label
                    >
                    <el-input
                        class="w-full"
                        placeholder="Total"
                        :class="{
                            'is-invalid': errors.total,
                        }"
                        v-model="o_Operacion.total"
                        clearable
                        readonly
                    ></el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.total"
                        v-text="errors.total[0]"
                    ></span>
                </div>
                <div class="form-group col-md-3">
                    <label
                        :class="{
                            'text-danger': errors.justificacion,
                        }"
                        >Justificación*</label
                    >
                    <el-input
                        type="textarea"
                        autosize
                        class="w-100"
                        :class="{
                            'is-invalid': errors.justificacion,
                        }"
                        v-model="o_Operacion.justificacion"
                        clearable
                    >
                    </el-input>
                    <span
                        class="error invalid-feedback"
                        v-if="errors.justificacion"
                        v-text="errors.justificacion[0]"
                    ></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 contenedor_tabla">
                    <table class="table table-bordered tabla_programacion">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="12">
                                    Programación Mensual
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">Enero</th>
                                <th class="text-center">Febrero</th>
                                <th class="text-center">Marzo</th>
                                <th class="text-center">Abril</th>
                                <th class="text-center">Mayo</th>
                                <th class="text-center">Junio</th>
                                <th class="text-center">Julio</th>
                                <th class="text-center">Agosto</th>
                                <th class="text-center">Septiembre</th>
                                <th class="text-center">Octubre</th>
                                <th class="text-center">Noviembre</th>
                                <th class="text-center">Diciembre</th>
                            </tr>
                        </thead>
                        <tbody class="detalle_trimestres">
                            <tr>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.ene"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.feb"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.mar"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.abr"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.may"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.jun"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.jul"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.ago"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.sep"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.oct"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.nov"
                                        class="form-control"
                                    />
                                </td>
                                <td class="text-center">
                                    <input
                                        type="number"
                                        step="0.01"
                                        v-model="o_Operacion.dic"
                                        class="form-control"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body bg-primary">
                            <h4 class="text-md">
                                TOTAL OPERACIÓN:
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
            </div> -->
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
                memoria_id: "",
                ue: "",
                prog: "",
                act: "",
                operacion_id: "",
                detalle_operacion_id: "",
                lugar: "",
                responsable: "",
                partida: "",
                nro: "",
                descripcion: "",
                cantidad: "",
                unidad: "",
                costo: "",
                total: 0,
                justificacion: "",
                ene: "",
                feb: "",
                mar: "",
                abr: "",
                may: "",
                jun: "",
                jul: "",
                ago: "",
                sep: "",
                oct: "",
                nov: "",
                dic: "",
                total_operacion: 0,
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
            texto_actividad: "",
        };
    },
    mounted() {
        this.getOperacionesFormulario();
    },
    watch: {
        formulario_id(newVal, oldVal) {
            this.formulario_cuatro_id = newVal;
            this.getOperacionesFormulario();
            this.o_Operacion.operacion_id = "";
            this.texto_operacion = "";
        },
        operacion(newVal, oldVal) {
            this.o_Operacion = newVal;
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
                // get actividades de la operacion
                axios
                    .get("/admin/operacions/getTareas", {
                        params: { id: this.o_Operacion.operacion_id },
                    })
                    .then((response) => {
                        if (this.o_Operacion.id != 0) {
                            let aux_texto = this.texto_operacion;
                            this.texto_operacion = "";
                            this.texto_operacion = aux_texto;
                        }
                        this.texto_operacion = item[0].operacion;
                        if (this.o_Operacion.operacion_id == "") {
                            this.o_Operacion.detalle_operacion_id = "";
                        }
                        this.o_Operacion.detalle_operaciones = response.data;
                        if (this.o_Operacion.detalle_operacion_id != "") {
                            this.getTextoActividad();
                        }
                    });
            } else {
                this.o_Operacion.detalle_operaciones = [];
                this.texto_operacion = "";
            }
        },
        getTextoActividad() {
            let item = this.o_Operacion.detalle_operaciones.filter(
                (value) => value.id == this.o_Operacion.detalle_operacion_id
            );
            if (item.length > 0) {
                this.texto_actividad = item[0].actividad_tarea;
            } else {
                this.texto_actividad = "";
            }
        },

        // QUITAR OPERACION
        quitar() {
            this.$emit("quitar", this.index, this.operacion);
        },
        calculaTotal() {
            let total = 0;
            if (
                this.o_Operacion.cantidad != "" &&
                this.o_Operacion.costo != ""
            ) {
                this.o_Operacion.total =
                    parseFloat(this.o_Operacion.cantidad) *
                    parseFloat(this.o_Operacion.costo);
            }
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

.numero_operacion_detalle {
    padding: 2px;
    background: var(--secondary);
    width: auto;
    height: auto;
    position: absolute;
    z-index: 100;
    left: -15px;
    top: -15px;
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 0.75rem;
    border-radius: 5px;
}

.numero_operacion_detalle_tarea {
    padding: 2px;
    background: var(--secondary);
    width: auto;
    height: auto;
    position: absolute;
    z-index: 100;
    left: -2px;
    top: -18px;
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 0.7rem;
    border-radius: 3px;
}

.btnQuitar {
    padding: 0px;
    width: 30px;
    height: 30px;
    position: absolute;
    right: -10px;
    top: -10px;
}

.fila_tarea,
.fila_partida {
    position: relative;
}

.fila_tarea {
    border: solid 1px #20c997 !important;
    padding-bottom: 5px;
}
.fila_partida {
    border: solid 1px #cfcdcd !important;
}

.fila_tarea input,
.fila_tarea textarea,
.fila_tarea select,
.contenedor_operacion input,
.contenedor_operacion textarea,
.contenedor_operacion select,
.fila_partida input,
.fila_partida textarea,
.fila_partida select {
    font-size: 0.75rem;
}

.fila_tarea .btnQuitar,
.fila_partida .btnQuitar {
    right: -20px;
    top: -10px;
    width: 25px;
    height: 25px;
    font-size: 0.85rem;
}

.contenedor_tabla .card-header,
.contenedor_tabla .card-body {
    padding: 10px;
}

.contenedor_tabla .card-body {
    overflow: auto;
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

.contenedor_operacion label {
    margin: 0px;
    position: absolute;
    font-size: 0.7rem;
    top: -13px;
    left: 12px;
    padding: 0px 5px;
    background: white;
    z-index: 3;
    border-radius: 9px;
    max-width: 100%;
    word-wrap: none;
}

textarea[readonly] {
    background: #ebebeb;
}

.contenedor_operacion hr {
    border-top: solid 3px black;
}

.tabla_programacion thead tr th,
.tabla_programacion tbody tr td {
    font-size: 0.7em;
}

.tabla_programacion tbody tr td input {
    padding: 2px;
}
</style>
