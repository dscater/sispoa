<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Formulario 5 - <small>Editar</small></h1>
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
                                            <i class="fas fa-edit"></i>
                                            Editar Registro
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.formulario_id,
                                            }"
                                            >Seleccionar código PEI*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.formulario_id,
                                            }"
                                            v-model="formulario_id"
                                            clearable
                                            ref="codigo_pei"
                                        >
                                            <el-option
                                                v-for="item in listFormularios"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.codigo_pei"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.formulario_id"
                                            v-text="errors.formulario_id[0]"
                                        ></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Operacion
                            v-for="(operacion, index) in listOperacions"
                            :operacion="operacion"
                            :formulario_id="formulario_id.toString()"
                            :index="index"
                            @quitar="quitarOperacion"
                            @quitar_tarea="addEliminadosTareas"
                            @quitar_partida="addEliminadosPartidas"
                            :accion="'edit'"
                            :key="index"
                        ></Operacion>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button
                                            class="btn btn-primary btn-flat btn-block"
                                            @click="agregarOperacion"
                                            :disabled="!agregaOperacion"
                                        >
                                            <i class="fa fa-plus"></i>
                                            Agregar Operación
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-md-3">
                                <el-button
                                    class="btn btn-primary bg-primary btn-flat btn-block"
                                    :loading="enviando"
                                    @click="enviarRegistro"
                                    :disabled="!enviable"
                                    ><i class="fa fa-save"></i> Actualizar
                                    registro</el-button
                                >
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
            enviando: false,
            enviable: false,
            agregaOperacion: false,
            listFormularios: [],
            listOperacions: [],
            cantidad_registrados: 0,
            errors: [],
            formulario_id: "",
            formulario_cinco_id: "",
            oFormularioCinco: null,
            eliminados: [],
            tareas_eliminados: [],
            partidas_eliminados: [],
        };
    },
    watch: {
        listOperacions(newVal, oldVal) {
            if (newVal.length > 0) {
                this.enviable = true;
            } else {
                this.enviable = false;
            }
        },
        formulario_id(newVal, oldVal) {
            if (newVal != "") {
                this.agregaOperacion = true;
            } else {
                this.agregaOperacion = false;
            }
        },
    },
    mounted() {
        this.getFormularioCinco();
        this.loadingWindow.close();
        this.getFormularios();
    },
    methods: {
        // OBTENER EL REGISTRO DETALLE FORMULARIO
        getFormularioCinco() {
            axios.get("/admin/formulario_cinco/" + this.id).then((response) => {
                this.oFormularioCinco = response.data.formulario_cinco;
                this.formulario_cinco_id = this.oFormularioCinco.id.toString();
                this.listOperacions = this.oFormularioCinco.operacions;
                this.formulario_id = this.oFormularioCinco.formulario_id;
            });
        },

        // OBTENER LA LISTA DE FORMULARIO
        getFormularios() {
            axios.get("/admin/formulario_cuatro").then((response) => {
                this.listFormularios = response.data.listado;
            });
        },
        // ENVIAR OPERACIONES
        enviarRegistro() {
            let a_errores = this.validaData();
            if (a_errores.length == 0) {
                let data = {
                    _method: "put",
                    formulario_id: this.formulario_id,
                    data: this.listOperacions,
                    eliminados: this.eliminados,
                    tareas_eliminados: this.tareas_eliminados,
                    partidas_eliminados: this.partidas_eliminados,
                };
                axios
                    .post(
                        "/admin/formulario_cinco/" + this.oFormularioCinco.id,
                        data
                    )
                    .then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: response.data.msj,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        this.$router.push({
                            name: "formulario_cinco.index",
                        });
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                                this.$refs.codigo_pei.focus();
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: error,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    });
            } else {
                let mensaje = "";
                a_errores.forEach((e) => {
                    mensaje += e + "<br>";
                });
                Swal.fire({
                    icon: "error",
                    title: "Tienes los siguientes errores",
                    html: mensaje,
                    showConfirmButton: true,
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: "#0069d9",
                });
            }
        },

        // VALIDACION DE DATA
        validaData() {
            let array_errors = [];
            this.listOperacions.forEach((item, index) => {
                if (item.operacion_id == null || item.operacion_id == "") {
                    array_errors.push(
                        "Debes seleccionar un <b>código de operación</b> en el elemento " +
                            (index + 1)
                    );
                }
                item.lugar_responsables.forEach(
                    (item_lugar_responsable, index_lugar_responsable) => {
                        if (
                            item_lugar_responsable.lugar == null ||
                            item_lugar_responsable.lugar == ""
                        ) {
                            array_errors.push(
                                "Debes indicar un <b>lugar</b> en el elemento  " +
                                    (index + 1) +
                                    "-" +
                                    (index_lugar_responsable + 1)
                            );
                        }
                        if (
                            item_lugar_responsable.responsable == null ||
                            item_lugar_responsable.responsable == ""
                        ) {
                            array_errors.push(
                                "Debes indicar un <b>responsable</b> en el elemento  " +
                                    (index + 1) +
                                    "-" +
                                    (index_lugar_responsable + 1)
                            );
                        }
                        item_lugar_responsable.actividad_tareas.forEach(
                            (item_tarea, index_tarea) => {
                                if (
                                    item_tarea.detalle_operacion_id == null ||
                                    item_tarea.detalle_operacion_id == ""
                                ) {
                                    array_errors.push(
                                        "Debes seleccionar un <b>código de tarea</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_tarea + 1)
                                    );
                                }
                            }
                        );
                        item_lugar_responsable.partidas.forEach(
                            (item_partida, index_partida) => {
                                if (
                                    item_partida.actividad_tarea_id == null ||
                                    item_partida.actividad_tarea_id == ""
                                ) {
                                    array_errors.push(
                                        "Debes seleccionar una <b>tarea/actividad</b> para la partida en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.partida == null ||
                                    item_partida.partida == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar una <b>partida</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.descripcion == null ||
                                    item_partida.descripcion == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar una <b>descripción</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.cantidad == null ||
                                    item_partida.cantidad == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar una <b>cantidad</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.unidad == null ||
                                    item_partida.unidad == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar una <b>unidad</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.costo == null ||
                                    item_partida.costo == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar un <b>costo</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.ue == null ||
                                    item_partida.ue == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar un <b>UE</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.prog == null ||
                                    item_partida.prog == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar un <b>PROG</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                                if (
                                    item_partida.act == null ||
                                    item_partida.act == ""
                                ) {
                                    array_errors.push(
                                        "Debes ingresar un <b>ACT</b> en el elemento  " +
                                            (index + 1) +
                                            "-" +
                                            (index_lugar_responsable + 1) +
                                            " fila " +
                                            (index_partida + 1)
                                    );
                                }
                            }
                        );
                    }
                );
            });

            return array_errors;
        },

        // METODOS DE LOS DETALLES
        agregarOperacion() {
            this.listOperacions.push({
                id: 0,
                formulario_cinco_id: "",
                operacion_id: "",
                total_operacion: "",
                lugar_responsables: [],
                detalle_operaciones: [],
            });
        },
        quitarOperacion(index, item) {
            if (item.id != 0) {
                this.eliminados.push(item.id);
            }
            this.listOperacions.splice(index, 1);
        },
        addEliminadosTareas(id) {
            this.tareas_eliminados.push(id);
        },
        addEliminadosPartidas(id) {
            this.partidas_eliminados.push(id);
        },
    },
};
</script>

<style></style>
