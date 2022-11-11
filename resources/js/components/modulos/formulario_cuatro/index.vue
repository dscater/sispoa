<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>FormularioCuatros</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button
                                            v-if="
                                                permisos.includes(
                                                    'formulario_cuatro.create'
                                                )
                                            "
                                            class="btn btn-outline-primary bg-lightblue btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaFormularioCuatro();
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Nuevo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <b-col lg="10" class="my-1">
                                        <b-form-group
                                            label="Buscar"
                                            label-for="filter-input"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                            label-size="sm"
                                            class="mb-0"
                                        >
                                            <b-input-group size="sm">
                                                <b-form-input
                                                    id="filter-input"
                                                    v-model="filter"
                                                    type="search"
                                                    placeholder="Buscar"
                                                ></b-form-input>

                                                <b-input-group-append>
                                                    <b-button
                                                        class="bg-lightblue"
                                                        variant="primary"
                                                        :disabled="!filter"
                                                        @click="filter = ''"
                                                        >Borrar</b-button
                                                    >
                                                </b-input-group-append>
                                            </b-input-group>
                                        </b-form-group>
                                    </b-col>
                                    <div class="col-md-12">
                                        <b-overlay
                                            :show="showOverlay"
                                            rounded="sm"
                                        >
                                            <b-table
                                                :fields="fields"
                                                :items="listRegistros"
                                                show-empty
                                                stacked="md"
                                                responsive
                                                :current-page="currentPage"
                                                :per-page="perPage"
                                                @filtered="onFiltered"
                                                empty-text="Sin resultados"
                                                empty-filtered-text="Sin resultados"
                                                :filter="filter"
                                            >
                                                <template #cell(foto)="row">
                                                    <b-avatar
                                                        :src="
                                                            row.item.path_image
                                                        "
                                                        size="3rem"
                                                    ></b-avatar>
                                                </template>

                                                <template
                                                    #cell(fecha_registro)="row"
                                                >
                                                    {{
                                                        formatoFecha(
                                                            row.item
                                                                .fecha_registro
                                                        )
                                                    }}
                                                </template>

                                                <template #cell(accion)="row">
                                                    <div
                                                        class="row justify-content-between"
                                                    >
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-primary"
                                                            class="btn-flat btn-block"
                                                            title="Descargar Excel"
                                                            @click="
                                                                descargarExcel(
                                                                    row.item.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-file-excel"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-warning"
                                                            class="btn-flat btn-block"
                                                            title="Editar registro"
                                                            @click="
                                                                editarRegistro(
                                                                    row.item
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-edit"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-danger"
                                                            class="btn-flat btn-block"
                                                            title="Eliminar registro"
                                                            @click="
                                                                eliminaFormularioCuatro(
                                                                    row.item.id,
                                                                    row.item
                                                                        .full_name
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-trash"
                                                            ></i>
                                                        </b-button>
                                                    </div>
                                                </template>
                                            </b-table>
                                        </b-overlay>
                                        <div class="row">
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="ml-auto my-1"
                                            >
                                                <b-form-select
                                                    align="right"
                                                    id="per-page-select"
                                                    v-model="perPage"
                                                    :options="pageOptions"
                                                    size="sm"
                                                ></b-form-select>
                                            </b-col>
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="my-1 mr-auto"
                                                v-if="perPage"
                                            >
                                                <b-pagination
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
                                                    :per-page="perPage"
                                                    align="left"
                                                ></b-pagination>
                                            </b-col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Nuevo
            :muestra_modal="muestra_modal"
            :accion="modal_accion"
            :formulario_cuatro="oFormularioCuatro"
            @close="muestra_modal = false"
            @envioModal="getFormularioCuatros"
        ></Nuevo>
    </div>
</template>

<script>
import Nuevo from "./Nuevo.vue";
export default {
    components: {
        Nuevo,
    },
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            search: "",
            listRegistros: [],
            showOverlay: false,
            fields: [
                {
                    key: "codigo_pei",
                    label: "Código PEI",
                    sortable: true,
                },
                {
                    key: "accion_institucional",
                    label: "Acción Institucional Específica",
                    sortable: true,
                },
                {
                    key: "indicador",
                    label: "Indicador de Proceso",
                    sortable: true,
                },
                {
                    key: "codigo_poa",
                    label: "Código POA",
                    sortable: true,
                },
                {
                    key: "accion_corto",
                    label: "Acción de Corto Plazo",
                    sortable: true,
                },
                {
                    key: "resultado_esperado",
                    label: "Restultado Esperado Gestión",
                    sortable: true,
                },
                {
                    key: "presupuesto",
                    label: "Presupuesto Programado Gestión",
                    sortable: true,
                },
                { key: "ponderacion", label: "Ponderación %", sortable: true },
                { key: "unidad.nombre", label: "Unidad Organizacional" },
                {
                    key: "fecha_registro",
                    label: "Fecha de registro",
                    sortable: true,
                },
                { key: "accion", label: "Acción" },
            ],
            loading: true,
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            muestra_modal: false,
            modal_accion: "nuevo",
            oFormularioCuatro: {
                id: 0,
                codigo_pei: "",
                accion_institucional: "",
                indicador: "",
                codigo_poa: "",
                accion_corto: "",
                resultado_esperado: "",
                presupuesto: "",
                ponderacion: "",
                unidad_id: "",
            },
            currentPage: 1,
            perPage: 5,
            pageOptions: [
                { value: 5, text: "Mostrar 5 Registros" },
                { value: 10, text: "Mostrar 10 Registros" },
                { value: 25, text: "Mostrar 25 Registros" },
                { value: 50, text: "Mostrar 50 Registros" },
                { value: 100, text: "Mostrar 100 Registros" },
                { value: this.totalRows, text: "Mostrar Todo" },
            ],
            totalRows: 10,
            filter: null,
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getFormularioCuatros();
    },
    methods: {
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oFormularioCuatro.id = item.id;
            this.oFormularioCuatro.codigo_pei = item.codigo_pei
                ? item.codigo_pei
                : "";
            this.oFormularioCuatro.accion_institucional =
                item.accion_institucional ? item.accion_institucional : "";
            this.oFormularioCuatro.indicador = item.indicador
                ? item.indicador
                : "";
            this.oFormularioCuatro.codigo_poa = item.codigo_poa
                ? item.codigo_poa
                : "";
            this.oFormularioCuatro.accion_corto = item.accion_corto
                ? item.accion_corto
                : "";
            this.oFormularioCuatro.resultado_esperado = item.resultado_esperado
                ? item.resultado_esperado
                : "";
            this.oFormularioCuatro.presupuesto = item.presupuesto
                ? item.presupuesto
                : "";
            this.oFormularioCuatro.ponderacion = item.ponderacion
                ? item.ponderacion
                : "";
            this.oFormularioCuatro.unidad_id = item.unidad_id
                ? item.unidad_id
                : "";
            this.modal_accion = "edit";
            this.muestra_modal = true;
        },

        // Listar FormularioCuatros
        getFormularioCuatros() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = "/admin/formulario_cuatro";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: { per_page: this.per_page },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.listado;
                    this.totalRows = res.data.total;
                });
        },
        eliminaFormularioCuatro(id, descripcion) {
            Swal.fire({
                title: "¿Quierés eliminar este registro?",
                html: `<strong>${descripcion}</strong>`,
                showCancelButton: true,
                confirmButtonColor: "#05568e",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                denyButtonText: `No, cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .post("/admin/formulario_cuatro/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            if (res.sw) {
                                this.getFormularioCuatros();
                                this.filter = "";
                                Swal.fire({
                                    icon: "success",
                                    title: res.data.msj,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: res.data.msj,
                                    showConfirmButton: false,
                                    timer: 2500,
                                });
                            }
                        });
                }
            });
        },
        abreModal(tipo_accion = "nuevo", formulario_cuatro = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (formulario_cuatro) {
                this.oFormularioCuatro = formulario_cuatro;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaFormularioCuatro() {
            this.oFormularioCuatro.codigo_pei = "";
            this.oFormularioCuatro.accion_institucional = "";
            this.oFormularioCuatro.indicador = "";
            this.oFormularioCuatro.codigo_poa = "";
            this.oFormularioCuatro.accion_corto = "";
            this.oFormularioCuatro.resultado_esperado = "";
            this.oFormularioCuatro.presupuesto = "";
            this.oFormularioCuatro.ponderacion = "";
            this.oFormularioCuatro.unidad_id = "";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
        descargarExcel(id) {
            let config = {
                responseType: "blob",
            };
            axios
                .post(
                    "/admin/reportes/formulario_cuatro_excel",
                    { id: id },
                    config
                )
                .then((response) => {
                    var fileURL = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");
                    fileLink.href = fileURL;
                    fileLink.setAttribute("download", "formulario_cuatro.xlsx");
                    document.body.appendChild(fileLink);

                    fileLink.click();
                })
                .catch(async (error) => {
                    console.log(error);
                    let responseObj = await error.response.data.text();
                    responseObj = JSON.parse(responseObj);
                    this.enviando = false;
                    if (error.response) {
                    }
                });
        },
    },
};
</script>

<style></style>
