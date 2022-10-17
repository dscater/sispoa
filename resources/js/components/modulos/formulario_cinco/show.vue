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
                                <div
                                    class="row"
                                    id="contenedor_tabla"
                                    v-html="tabla"
                                ></div>
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
                this.getTabla();
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
