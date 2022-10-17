<template>
    <div
        class="row border mb-3 p-2 detalle contenedor_operacion"
        :class="[(index + 1) % 2 == 0 ? 'gray-dark' : '']"
    >
        <span class="rounded-circle numero_detalle" v-text="index + 1"></span>
        <button class="btn btn-danger rounded-circle btnQuitar" @click="quitar">
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
        </div>
        <div
            class="row"
            v-for="(
                detalle_lr, index_detalle
            ) in o_Operacion.lugar_responsables"
        >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-black p-2">
                        <span
                            class="numero_operacion_detalle"
                            v-text="
                                index +
                                1 +
                                '-' +
                                (index_detalle + 1) +
                                ' Lugar Responsable'
                            "
                        ></span>
                        <button
                            class="btn btn-danger rounded-circle btnQuitar"
                            @click="
                                quitarDetalleLR(index_detalle, detalle_lr.id)
                            "
                            v-if="index_detalle > 0"
                        >
                            X
                        </button>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger':
                                            errors['lugar.' + index_detalle],
                                    }"
                                    >Lugar de ejecución de la Operación*</label
                                >
                                <el-input
                                    placeholder="Lugar de ejecución de la Operación"
                                    :class="{
                                        'is-invalid':
                                            errors['lugar.' + index_detalle],
                                    }"
                                    v-model="detalle_lr.lugar"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors['lugar.' + index_detalle]"
                                    v-text="errors['lugar.' + index_detalle][0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger':
                                            errors[
                                                'responsable.' + index_detalle
                                            ],
                                    }"
                                    >Responsable de ejecución de la operación
                                    Tarea*</label
                                >
                                <el-input
                                    type="textarea"
                                    resize
                                    placeholder="Responsable de ejecución de la operación Tarea"
                                    :class="{
                                        'is-invalid':
                                            errors[
                                                'responsable.' + index_detalle
                                            ],
                                    }"
                                    v-model="detalle_lr.responsable"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="
                                        errors['responsable.' + index_detalle]
                                    "
                                    v-text="
                                        errors[
                                            'responsable.' + index_detalle
                                        ][0]
                                    "
                                ></span>
                            </div>
                            <div class="row pr-1">
                                <div class="col-md-12">
                                    <div class="row">
                                        <button
                                            class="btn btn-sm bg-teal btn-block btn-flat"
                                            @click="
                                                agregarTarea(
                                                    index_detalle,
                                                    detalle_lr
                                                )
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Agregar Tarea/Actividad
                                        </button>
                                    </div>
                                    <div
                                        class="row mt-1 mb-1 fila_tarea border pt-3"
                                        v-for="(
                                            tarea, index_tarea
                                        ) in detalle_lr.actividad_tareas"
                                        :key="index_tarea"
                                        :class="[
                                            (index_tarea + 1) % 2 == 0
                                                ? 'bg-light'
                                                : 'bg-white',
                                        ]"
                                    >
                                        <button
                                            class="btn btn-danger rounded-circle btnQuitar"
                                            v-if="index_tarea > 0"
                                            @click="
                                                quitarTarea(
                                                    index_detalle,
                                                    index_tarea,
                                                    tarea.id
                                                )
                                            "
                                        >
                                            X
                                        </button>
                                        <div class="col-md-2 form-group mb-1">
                                            <label>Código de tarea</label>
                                            <select
                                                v-model="
                                                    tarea.detalle_operacion_id
                                                "
                                                class="form-control"
                                                @change="
                                                    setTextoTarea(
                                                        index_detalle,
                                                        index_tarea,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option
                                                    v-for="detalle_operacion in o_Operacion.detalle_operaciones"
                                                    :key="detalle_operacion.id"
                                                    :value="
                                                        detalle_operacion.id
                                                    "
                                                >
                                                    {{
                                                        detalle_operacion.codigo_tarea
                                                    }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-10 form-group mb-1">
                                            <label>Actividad/Tarea</label>
                                            <el-input
                                                type="textarea"
                                                autosize
                                                placeholder="Actividades/Tareas"
                                                v-model="tarea.descripcion"
                                                readonly
                                            >
                                            </el-input>
                                        </div>
                                        <div class="row">
                                            <button
                                                class="btn btn-sm mt-2 bg-gray-dark btn-block btn-flat"
                                                @click="
                                                    agregarPartida(
                                                        index_detalle,
                                                        index_tarea,
                                                        tarea
                                                    )
                                                "
                                            >
                                                <i class="fa fa-plus"></i>
                                                Agregar Partida
                                            </button>
                                            <div class="col-md-12">
                                                <div
                                                    class="row mt-1 pt-3 fila_partida"
                                                    v-for="(
                                                        partida, index_partida
                                                    ) in tarea.partidas"
                                                    :key="index_partida"
                                                >
                                                    <button
                                                        class="btn btn-danger rounded-circle btnQuitar"
                                                        v-if="index_partida > 0"
                                                        @click="
                                                            quitarPartida(
                                                                index_detalle,
                                                                index_tarea,
                                                                index_partida,
                                                                partida.id
                                                            )
                                                        "
                                                    >
                                                        X
                                                    </button>
                                                    <div
                                                        class="col-md-2 form-group"
                                                    >
                                                        <label>Partida</label>
                                                        <input
                                                            type="text"
                                                            v-model="
                                                                partida.partida
                                                            "
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-6 form-group"
                                                    >
                                                        <label
                                                            >Descripción</label
                                                        >
                                                        <el-input
                                                            type="textarea"
                                                            autosize
                                                            placeholder="Descripción"
                                                            v-model="
                                                                partida.descripcion
                                                            "
                                                        >
                                                        </el-input>
                                                    </div>
                                                    <div
                                                        class="col-md-2 form-group"
                                                    >
                                                        <label>Cantidad</label>
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
                                                    </div>
                                                    <div
                                                        class="col-md-2 form-group"
                                                    >
                                                        <label
                                                            >Unidad de
                                                            medida</label
                                                        >
                                                        <input
                                                            type="text"
                                                            v-model="
                                                                partida.unidad
                                                            "
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-2 form-group"
                                                    >
                                                        <label
                                                            >Costo
                                                            unitario</label
                                                        >
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
                                                    </div>
                                                    <div
                                                        class="col-md-2 form-group"
                                                    >
                                                        <label>TRANSF 42</label>
                                                        <input
                                                            type="number"
                                                            step="0.01"
                                                            v-model="
                                                                partida.t42
                                                            "
                                                            class="form-control"
                                                            readonly
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-1 form-group"
                                                    >
                                                        <label>UE</label>
                                                        <input
                                                            type="text"
                                                            v-model="partida.ue"
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-1 form-group"
                                                    >
                                                        <label>PROG</label>
                                                        <input
                                                            type="text"
                                                            v-model="
                                                                partida.prog
                                                            "
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-1 form-group"
                                                    >
                                                        <label>ACT</label>
                                                        <input
                                                            type="text"
                                                            v-model="
                                                                partida.act
                                                            "
                                                            class="form-control"
                                                        />
                                                    </div>
                                                    <div
                                                        class="col-md-3 form-group"
                                                    >
                                                        <label>Otros</label>
                                                        <el-input
                                                            type="textarea"
                                                            autosize
                                                            placeholder="Otros"
                                                            v-model="
                                                                partida.otros
                                                            "
                                                        >
                                                        </el-input>
                                                    </div>
                                                </div>
                                            </div>
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
                            Agregar Lugar y Responsable de operación
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
                        partidas: [
                            {
                                id: 0,
                                lugar_responsable_id: 0,
                                actividad_tarea_id: "",
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
                        partidas: [
                            {
                                id: 0,
                                lugar_responsable_id: "",
                                actividad_tarea_id: "",
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
                    },
                ],
            });
        },
        quitarDetalleLR(index, id) {
            this.o_Operacion.lugar_responsables.splice(index, 1);
            if (id != 0) {
                this.$emit("quitar_detalle", id);
            }
            this.calculaTotales();
        },

        // ACCIONES PARA AGREGAR TAREAS Y PARTIDAS
        agregarTarea(index, item) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas.push({
                id: 0,
                fco_id: "",
                detalle_operacion_id: "",
                lugar_responsable_id: item.id,
                partidas: [
                    {
                        id: 0,
                        lugar_responsable_id: item.id,
                        actividad_tarea_id: "",
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
        agregarPartida(index, index_tarea, item) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas[
                index_tarea
            ].partidas.push({
                id: 0,
                lugar_responsable_id: item.id,
                actividad_tarea_id: "",
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
        filtraTareasPartida(index, item) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas.filter(
                (tarea) => {}
            );
        },
        setTextoTarea(index, index_tarea, event) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas[
                index_tarea
            ].descripcion = this.o_Operacion.detalle_operaciones.filter(
                (item) => item.id == event.target.value
            )[0].actividad_tarea;
            // AGREGAR LA TAREA A LA LISTA DE ACTIVIDADES DEL LUGAR RESPONSABLE
            let existe_actividad = this.o_Operacion.lugar_responsables[
                index
            ].actividad_tareas.filter(
                (at) => at.detalle_operacion_id == event.target.value
            );
            if (!existe_actividad.length.detalle_operacion) {
                this.o_Operacion.lugar_responsables[
                    index
                ].actividad_tareas.filter(
                    (at) => at.detalle_operacion_id == event.target.value
                )[0].detalle_operacion = this.o_Operacion.detalle_operaciones.filter(
                    (item) => item.id == event.target.value
                )[0];
            }
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
        quitarPartida(index, index_tarea, index_partida, id = 0) {
            this.o_Operacion.lugar_responsables[index].actividad_tareas[
                index_tarea
            ].partidas.splice(index_partida, 1);
            if (id != 0) {
                this.$emit("quitar_partida", id);
            }
            this.calculaTotales();
        },
        calculaTotales() {
            let suma_total = 0;
            this.o_Operacion.lugar_responsables.forEach((lugar_responsable) => {
                lugar_responsable.actividad_tareas.forEach(
                    (actividad_tarea) => {
                        actividad_tarea.partidas.forEach((partida) => {
                            let suma = 0;
                            if (partida.cantidad != "" && partida.costo != "") {
                                suma =
                                    parseFloat(partida.cantidad) *
                                    parseFloat(partida.costo);
                            }
                            partida.t42 = suma;
                            suma_total += suma;
                        });
                    }
                );
            });
            this.o_Operacion.total_operacion = suma_total;
        },
        setIdActividadPartida(index_lr, index_partida, event) {
            console.log(event.target);
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
    top: -15px;
    left: 12px;
}

textarea[readonly] {
    background: #ebebeb;
}

.contenedor_operacion hr {
    border-top: solid 3px black;
}
</style>
