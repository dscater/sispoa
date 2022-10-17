<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Certificacions - <small>Editar</small></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <router-link
                            :to="{ name: 'certificacions.index' }"
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
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div
                                            class="contenedor_pasos text-center"
                                        >
                                            <button
                                                class="paso"
                                                v-for="(
                                                    paso, index
                                                ) in listPasos"
                                                :key="index"
                                                :class="{
                                                    active:
                                                        nro_paso == paso.nro,
                                                    error: paso.error,
                                                }"
                                                @click="cambiaPaso(paso.nro)"
                                            >
                                                <div
                                                    class="nro_paso"
                                                    v-text="paso.nro"
                                                ></div>
                                                <div class="txt">
                                                    {{ paso.label }}
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        v-if="nro_paso == 1"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
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
                                            v-model="
                                                oCertificacion.formulario_id
                                            "
                                            clearable
                                            @change="getOperacionesFormCinco"
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
                                    <div
                                        v-if="nro_paso == 2"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger': errors.fco_id,
                                            }"
                                            >Seleccionar código de
                                            operación*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid': errors.fco_id,
                                            }"
                                            v-model="oCertificacion.fco_id"
                                            clearable
                                            @change="setTextOperacion"
                                        >
                                            <el-option
                                                v-for="item in listOperaciones"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="
                                                    item.operacion
                                                        .codigo_operacion
                                                "
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.fco_id"
                                            v-text="errors.fco_id[0]"
                                        ></span>

                                        <el-input
                                            type="textarea"
                                            autosize
                                            placeholder="Operación"
                                            v-model="text_operacion"
                                            readonly
                                        >
                                        </el-input>
                                    </div>
                                    <div
                                        v-if="nro_paso == 3"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.actividad_tarea_id,
                                            }"
                                            >Seleccionar código de
                                            tarea/actividad*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.actividad_tarea_id,
                                            }"
                                            v-model="
                                                oCertificacion.actividad_tarea_id
                                            "
                                            clearable
                                            @change="setTextTarea"
                                        >
                                            <el-option
                                                v-for="item in listTareas"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="
                                                    item.detalle_operacion
                                                        .codigo_tarea
                                                "
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.actividad_tarea_id"
                                            v-text="
                                                errors.actividad_tarea_id[0]
                                            "
                                        ></span>
                                        <el-input
                                            type="textarea"
                                            autosize
                                            placeholder="Operación"
                                            v-model="text_tarea"
                                            readonly
                                        >
                                        </el-input>
                                    </div>
                                    <div
                                        v-if="nro_paso == 4"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.partida_id,
                                            }"
                                            >Seleccionar partida*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid': errors.partida_id,
                                            }"
                                            v-model="oCertificacion.partida_id"
                                            clearable
                                            @change="asignaPartida"
                                        >
                                            <el-option
                                                v-for="item in listPartidas"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.partida"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.partida_id"
                                            v-text="errors.partida_id[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 5"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.cantidad_usar,
                                            }"
                                            >Ingresar cantidad a
                                            utilizar*</label
                                        >
                                        <input
                                            type="number"
                                            class="form-control"
                                            :class="{
                                                'is-invalid':
                                                    errors.cantidad_usar,
                                            }"
                                            step="0.01"
                                            v-model="
                                                oCertificacion.cantidad_usar
                                            "
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.cantidad_usar"
                                            v-text="errors.cantidad_usar[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 6"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.justificacion,
                                            }"
                                            >Justificación*</label
                                        >
                                        <el-input
                                            type="textarea"
                                            autosize
                                            placeholder="Justificación"
                                            :class="{
                                                'is-invalid':
                                                    errors.justificacion,
                                            }"
                                            v-model="
                                                oCertificacion.justificacion
                                            "
                                            clearable
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.justificacion"
                                            v-text="errors.justificacion[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 7"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger': errors.archivo,
                                            }"
                                            >Adjuntar archivo</label
                                        >
                                        <input
                                            type="file"
                                            ref="archivo"
                                            class="form-control"
                                            @change="cargaArchivo"
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.archivo"
                                            v-text="errors.archivo[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 8"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.correlativo,
                                            }"
                                            >Nro. correlativo*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="oCertificacion.correlativo"
                                            readonly
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.correlativo"
                                            v-text="errors.correlativo[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 9"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.solicitante_id,
                                            }"
                                            >Seleccionar datos del
                                            solicitante*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.solicitante_id,
                                            }"
                                            v-model="
                                                oCertificacion.solicitante_id
                                            "
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listUsuarios"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.full_name"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.solicitante_id"
                                            v-text="errors.solicitante_id[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 10"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.superior_id,
                                            }"
                                            >Seleccionar datos del inmediato
                                            superior que aprueba*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.superior_id,
                                            }"
                                            v-model="oCertificacion.superior_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listUsuarios"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.full_name"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.superior_id"
                                            v-text="errors.superior_id[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 11"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.formulario_id,
                                            }"
                                            >Código SIGEP*</label
                                        >
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>U.E.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="oCertificacion.ue"
                                                    :class="{
                                                        'is-invalid': errors.ue,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.ue"
                                                    v-text="errors.ue[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-2">
                                                <label>PROG</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        oCertificacion.prog
                                                    "
                                                    :class="{
                                                        'is-invalid':
                                                            errors.prog,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.prog"
                                                    v-text="errors.prog[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-2">
                                                <label>PROY</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        oCertificacion.proy
                                                    "
                                                    :class="{
                                                        'is-invalid':
                                                            errors.proy,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.proy"
                                                    v-text="errors.proy[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-2">
                                                <label>ACT.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="oCertificacion.act"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.act,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.act"
                                                    v-text="errors.act[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-2">
                                                <label>F.F.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="oCertificacion.ff"
                                                    :class="{
                                                        'is-invalid': errors.ff,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.ff"
                                                    v-text="errors.ff[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-2">
                                                <label>O.F.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="oCertificacion.of"
                                                    :class="{
                                                        'is-invalid': errors.of,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.of"
                                                    v-text="errors.of[0]"
                                                ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        v-if="nro_paso == 12"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger': errors.codigo,
                                            }"
                                            >Código*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="oCertificacion.codigo"
                                            :class="{
                                                'is-invalid': errors.codigo,
                                            }"
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.codigo"
                                            v-text="errors.codigo[0]"
                                        ></span>
                                    </div>
                                    <div
                                        v-if="nro_paso == 13"
                                        class="form-group col-md-6 ml-auto mr-auto"
                                    >
                                        <label
                                            :class="{
                                                'text-danger': errors.accion,
                                            }"
                                            >Acción de corto plazo*</label
                                        >
                                        <el-input
                                            type="textarea"
                                            autosize
                                            placeholder="Acción de corto plazo"
                                            :class="{
                                                'is-invalid': errors.accion,
                                            }"
                                            v-model="oCertificacion.accion"
                                            clearable
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.accion"
                                            v-text="errors.accion[0]"
                                        ></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <el-button
                                                    v-if="nro_paso > 1"
                                                    class="btn btn-primary bg-light btn-flat btn-block"
                                                    :loading="enviando"
                                                    @click="
                                                        cambiaPaso(nro_paso - 1)
                                                    "
                                                    ><i
                                                        class="fa fa-arrow-left"
                                                    ></i>
                                                    Anterior</el-button
                                                >
                                            </div>
                                            <div class="col-md-6">
                                                <el-button
                                                    v-if="nro_paso < 13"
                                                    class="btn btn-primary bg-light btn-flat btn-block"
                                                    :loading="enviando"
                                                    @click="
                                                        cambiaPaso(nro_paso + 1)
                                                    "
                                                    >Siguiente
                                                    <i
                                                        class="fa fa-arrow-right"
                                                    ></i
                                                ></el-button>
                                            </div>
                                            <div class="col-md-12">
                                                <el-button
                                                    class="btn btn-primary bg-primary btn-flat btn-block m-0 mt-1"
                                                    :loading="enviando"
                                                    @click="enviaRegistro()"
                                                    ><i class="fa fa-save"></i>
                                                    Actualizar
                                                    Registro</el-button
                                                >
                                            </div>
                                        </div>
                                    </div>
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
            oCertificacion: {
                formulario_id: "",
                fco_id: "",
                actividad_tarea_id: "",
                partida_id: "",
                cantidad_usar: "",
                justificacion: "",
                archivo: null,
                correlativo: "",
                solicitante_id: "",
                superior_id: "",
                ue: "",
                prog: "",
                proy: "",
                act: "",
                ff: "",
                of: "",
                codigo: "",
                accion: "",
                estado: "PENDIENTE",
            },
            errors: [],
            listFormularios: [],
            listOperaciones: [],
            listTareas: [],
            listPartidas: [],
            listUsuarios: [],
            enviando: false,
            nro_paso: 1,
            text_operacion: "",
            text_tarea: "",
            oPartida: {
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
            listPasos: [
                {
                    nro: 1,
                    label: "Código PEI",
                    key: "formulario_id",
                    error: false,
                },
                {
                    nro: 2,
                    label: "Operación",
                    key: "fco_id",
                    error: false,
                },
                {
                    nro: 3,
                    label: "Tarea/Actividad",
                    key: "actividad_tarea_id",
                    error: false,
                },
                { nro: 4, label: "Partida", key: "partida_id", error: false },
                {
                    nro: 5,
                    label: "Cantidad",
                    key: "cantidad_usar",
                    error: false,
                },
                {
                    nro: 6,
                    label: "Justificación",
                    key: "justificacion",
                    error: false,
                },
                { nro: 7, label: "Archivo", key: "archivo", error: false },
                {
                    nro: 8,
                    label: "Nro. Correlativo",
                    key: "correlativo",
                    error: false,
                },
                {
                    nro: 9,
                    label: "Solicitante",
                    key: "solicitante_id",
                    error: false,
                },
                {
                    nro: 10,
                    label: "Inmediato Superior",
                    key: "superior_id",
                    error: false,
                },
                { nro: 11, label: "SIGEP", key: "sigep", error: false },
                { nro: 12, label: "Código", key: "codigo", error: false },
                { nro: 13, label: "Acción", key: "accion", error: false },
            ],
        };
    },
    mounted() {
        this.getFormularios();
        this.getUsuarios();
        this.loadingWindow.close();
        this.getCertificacion();
    },
    methods: {
        // Obtener la certificacion
        getCertificacion() {
            axios.get("/admin/certificacions/" + this.id).then((response) => {
                this.oCertificacion = response.data;
                this.getOperacionesFormCinco();
            });
        },
        // Obtener la lista de los formularios cuatro
        getFormularios() {
            axios.get("/admin/formulario_cuatro").then((response) => {
                this.listFormularios = response.data.listado;
            });
        },
        getUsuarios() {
            axios.get("/admin/usuarios").then((response) => {
                this.listUsuarios = response.data.usuarios;
            });
        },

        getCorrelativo() {
            axios
                .get("/admin/certificacions/getNroCorrelativo")
                .then((response) => {
                    this.oCertificacion.correlativo = response.data;
                });
        },

        // lista de operaciones deacuerdo al formulario cuatro seleccionado
        getOperacionesFormCinco() {
            axios
                .get("/admin/formulario_cinco/getOperaciones", {
                    params: {
                        formulario_id: this.oCertificacion.formulario_id,
                    },
                })
                .then((response) => {
                    // this.text_operacion = "";
                    // this.oCertificacion.fco_id = "";
                    this.listOperaciones = response.data;
                    this.setTextOperacion();
                });
        },
        // ENVIAR FORMULARIO
        enviaRegistro() {
            this.enviando = true;
            try {
                let url = "/admin/certificacions/" + this.id;
                let formdata = new FormData();
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                formdata.append("_method", "put");
                formdata.append(
                    "formulario_id",
                    this.oCertificacion.formulario_id
                );
                formdata.append("fco_id", this.oCertificacion.fco_id);
                formdata.append(
                    "actividad_tarea_id",
                    this.oCertificacion.actividad_tarea_id
                );
                formdata.append("partida_id", this.oCertificacion.partida_id);
                formdata.append(
                    "cantidad_usar",
                    this.oCertificacion.cantidad_usar
                );
                formdata.append(
                    "justificacion",
                    this.oCertificacion.justificacion
                );
                formdata.append("archivo", this.oCertificacion.archivo);
                formdata.append("correlativo", this.oCertificacion.correlativo);
                formdata.append(
                    "solicitante_id",
                    this.oCertificacion.solicitante_id
                );
                formdata.append("superior_id", this.oCertificacion.superior_id);
                formdata.append("ue", this.oCertificacion.ue);
                formdata.append("prog", this.oCertificacion.prog);
                formdata.append("proy", this.oCertificacion.proy);
                formdata.append("act", this.oCertificacion.act);
                formdata.append("ff", this.oCertificacion.ff);
                formdata.append("of", this.oCertificacion.of);
                formdata.append("codigo", this.oCertificacion.codigo);
                formdata.append("accion", this.oCertificacion.accion);
                formdata.append("estado", this.oCertificacion.estado);

                axios
                    .post(url, formdata, config)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.msj,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.errors = [];
                        // this.$router.push({ name: "certificacions.index" });
                        location.reload();
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                                this.muestraErrores();
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
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },

        // MANEJAR PASOS
        cambiaPaso(paso) {
            this.nro_paso = paso;
            if (this.nro_paso < 1) {
                this.nro_paso = 1;
            }
            if (this.nro_paso > 13) {
                this.nro_paso = 13;
            }
        },
        // textos codigos
        setTextOperacion() {
            this.text_operacion = this.listOperaciones.filter(
                (item) => item.id == this.oCertificacion.fco_id
            )[0].operacion.operacion;

            this.listTareas = this.listOperaciones.filter(
                (item) => item.id == this.oCertificacion.fco_id
            )[0].actividad_tareas;
            this.setTextTarea();
        },
        setTextTarea() {
            this.text_tarea = this.listOperaciones
                .filter(
                    (item) => item.id == this.oCertificacion.fco_id
                )[0]
                .actividad_tareas.filter(
                    (item_tarea) =>
                        item_tarea.id == this.oCertificacion.actividad_tarea_id
                )[0].descripcion;
            this.getPartidas();
        },
        asignaPartida() {
            setTimeout(() => {
                this.oPartida = this.listPartidas.filter(
                    (item) => item.id == this.oCertificacion.partida_id
                )[0];
                this.oCertificacion.cantidad_usar = this.oPartida.cantidad;
                this.oCertificacion.ue = this.oPartida.ue;
                this.oCertificacion.prog = this.oPartida.prog;
                this.oCertificacion.act = this.oPartida.act;
            }, 500);
        },
        cargaArchivo(e) {
            this.oCertificacion.archivo = e.target.files[0];
            console.log(e);
            console.log(this.oCertificacion.archivo);
        },
        // ARMAR ERRORES
        muestraErrores() {
            let msj_errores = "";
            this.listPasos.forEach((paso) => {
                if (this.errors[paso.key] != undefined) {
                    paso.error = true;
                    msj_errores += this.errors[paso.key][0] + "<br/>";
                } else {
                    paso.error = false;
                }
                if (paso.key == "sigep") {
                    if (
                        this.errors.ue ||
                        this.errors.prog ||
                        this.errors.proy ||
                        this.errors.act ||
                        this.errors.act ||
                        this.errors.ff ||
                        this.errors.of
                    ) {
                        paso.error = true;
                        msj_errores += "Tienes un error en SIGEP<br/>";
                    }
                }
            });
            Swal.fire({
                icon: "error",
                title: "Tienes los siguientes errores",
                html: msj_errores,
                showConfirmButton: true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#0069d9",
            });
        },
        getPartidas() {
            axios
                .get("/admin/actividad_tareas/getPartidas", {
                    params: {
                        actividad_tarea_id:
                            this.oCertificacion.actividad_tarea_id,
                    },
                })
                .then((response) => {
                    this.listPartidas = response.data;
                    console.log(this.listPartidas);
                });
        },
    },
};
</script>

<style>
.contenedor_pasos {
    width: 100%;
    overflow: auto;
    padding: 0px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
}
.paso {
    display: flex;
    flex-direction: column;
    justify-content: center;
    vertical-align: center;
    padding: 4px;
    border: solid 1px rgb(226, 226, 226);
    font-size: 0.75rem;
}
.paso.active {
    color: white;
    background: var(--principal);
}

.paso.active .nro_paso {
    background: #2e93d9;
}

.paso.error {
    color: white;
    background: #d74040;
}

.paso.error .nro_paso {
    background: #f59090;
}

.nro_paso {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 2px auto;
    height: 25px;
    width: 25px;
    font-weight: bold;
    border-radius: 50%;
    background: rgb(210, 210, 210);
}
.txt {
    font-weight: 600;
    width: 100%;
    text-align: center;
}
</style>
