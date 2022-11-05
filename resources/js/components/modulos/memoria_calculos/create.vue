<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Memoria de Cálculo - <small>Nuevo</small></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <router-link
                            :to="{ name: 'memoria_calculos.index' }"
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
                                            Nuevo Registro
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
                            :formulario_id="formulario_id.toString()"
                            :operacion="operacion"
                            :index="index"
                            @quitar="quitarOperacion"
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
                                    ><i class="fa fa-save"></i>
                                    Registrar</el-button
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
        this.loadingWindow.close();
        this.getFormularios();
    },
    methods: {
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
                    formulario_id: this.formulario_id,
                    data: this.listOperacions,
                };
                axios
                    .post("/admin/memoria_calculos", data)
                    .then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: response.data.msj,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        this.$router.push({
                            name: "memoria_calculos.index",
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
                if (
                    item.detalle_operacion_id == null ||
                    item.detalle_operacion_id == ""
                ) {
                    array_errors.push(
                        "Debes seleccionar un <b>código de Actividad/Tarea</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.ue == null || item.ue == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Unidad Ejecutora</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.prog == null || item.prog == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Programación</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.act == null || item.act == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Actividad</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.lugar == null || item.lugar == "") {
                    array_errors.push(
                        "Debes ingresar un <b>Lugar de Ejecución de la Operación</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.responsable == null || item.responsable == "") {
                    array_errors.push(
                        "Debes ingresar un <b>Responsable de Ejecución de la Operación / Tarea</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.partida == null || item.partida == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Partida de gasto</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.nro == null || item.nro == "") {
                    array_errors.push(
                        "Debes ingresar un <b>Nro</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.descripcion == null || item.descripcion == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Descripción</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.cantidad == null || item.cantidad == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Canitdad</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.unidad == null || item.unidad == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Unidad</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.costo == null || item.costo == "") {
                    array_errors.push(
                        "Debes ingresar un <b>Precio Unitario</b> en el elemento " +
                            (index + 1)
                    );
                }
                if (item.justificacion == null || item.justificacion == "") {
                    array_errors.push(
                        "Debes ingresar una <b>Justificación</b> en el elemento " +
                            (index + 1)
                    );
                }
            });

            return array_errors;
        },

        // METODOS DE LOS DETALLES
        agregarOperacion() {
            this.listOperacions.push({
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
            });
        },
        quitarOperacion(index, item) {
            this.listOperacions.splice(index, 1);
        },
    },
};
</script>

<style></style>
