<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link
            exact
            :to="{ name: 'inicio' }"
            class="brand-link bg-lightblue"
        >
            <img
                :src="configuracion.path_image"
                alt="Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span
                class="brand-text font-weight-light"
                v-text="configuracion.alias"
            ></span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        :src="user.path_image"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <router-link
                        exact
                        :to="{
                            name: 'usuarios.perfil',
                            params: { id: user.id },
                        }"
                        class="d-block"
                        v-text="user.full_name"
                    ></router-link>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input
                        class="form-control form-control-sidebar bg-white"
                        type="search"
                        placeholder="Buscar Modulo"
                        aria-label="Search"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-sidebar bg-white">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column text-sm nav-flat"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link
                            exact
                            :to="{ name: 'inicio' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header"
                        v-if="
                            permisos.includes('usuarios.index') ||
                            permisos.includes('unidads.index') ||
                            permisos.includes('formulario_cuatro.index') ||
                            permisos.includes('formulario_cinco.index') ||
                            permisos.includes('certificacions.index') ||
                            permisos.includes('configuracion.index')
                        "
                    >
                        ADMINISTRACIÓN
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('usuarios.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'usuarios.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('unidads.index')"
                    >
                        <router-link
                            :to="{ name: 'unidads.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Unidades Organizacionales</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        :class="{
                            'menu-open':
                                $route.name == 'formulario_cuatro.index' ||
                                $route.name == 'detalle_formularios.index',
                        }"
                    >
                        <a
                            href="#"
                            class="nav-link"
                            :class="{
                                active:
                                    $route.name == 'formulario_cuatro.index' ||
                                    $route.name == 'detalle_formularios.index',
                            }"
                        >
                            <i class="nav-icon fa fa-file-contract"></i>
                            <p>
                                Formulario 4
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li
                                class="nav-item"
                                v-if="
                                    permisos.includes('formulario_cuatro.index')
                                "
                            >
                                <router-link
                                    :to="{ name: 'formulario_cuatro.index' }"
                                    v-loading.fullscreen.lock="
                                        fullscreenLoading
                                    "
                                    class="nav-link"
                                >
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Administrar registros</p>
                                </router-link>
                            </li>
                            <li
                                class="nav-item"
                                v-if="
                                    permisos.includes(
                                        'detalle_formularios.index'
                                    )
                                "
                            >
                                <router-link
                                    :to="{ name: 'detalle_formularios.index' }"
                                    v-loading.fullscreen.lock="
                                        fullscreenLoading
                                    "
                                    class="nav-link"
                                >
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Administrar detalles</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('formulario_cinco.index')"
                    >
                        <router-link
                            :to="{ name: 'formulario_cinco.index' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fa fa-file-contract"></i>
                            <p>Formulario 5</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('certificacions.index')"
                    >
                        <router-link
                            :to="{ name: 'certificacions.index' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fa fa-file-alt"></i>
                            <p>Certificaciones</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('configuracion.index')"
                    >
                        <router-link
                            :to="{ name: 'configuracion' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Configuración</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header"
                        v-if="
                            permisos.includes('reportes.usuarios') ||
                            permisos.includes('reportes.clientes') ||
                            permisos.includes('reportes.ingresos_egresos')
                        "
                    >
                        REPORTES
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('reportes.usuarios')"
                    >
                        <router-link
                            :to="{ name: 'reportes.usuarios' }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Lista de Usuarios</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('reportes.ejecucion_presupuestos')"
                    >
                        <router-link
                            :to="{ name: 'reportes.ejecucion_presupuestos' }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Ejecución de presupuestos</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('reportes.ejecucion_presupuestos_g')"
                    >
                        <router-link
                            :to="{ name: 'reportes.ejecucion_presupuestos_g' }"
                            class="nav-link"
                        >
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <p>G. Ejecución de presupuestos</p>
                        </router-link>
                    </li>
                    <li class="nav-header">PERFIL</li>
                    <li class="nav-item">
                        <router-link
                            exact
                            :to="{
                                name: 'usuarios.perfil',
                                params: { id: user.id },
                            }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-user"></i>
                            <p>Ver Perfil</p>
                        </router-link>
                    </li>
                    <li class="nav-header">SALIR</li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link"
                            @click.prevent="logout()"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="fas fa-power-off nav-icon"></i>
                            <p>Cerrar sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    props: ["user", "configuracion"],
    data() {
        return {
            fullscreenLoading: false,
            permisos: localStorage.getItem("permisos"),
        };
    },
    methods: {
        logout() {
            this.fullscreenLoading = true;
            axios.post("/logout").then((res) => {
                setTimeout(function () {
                    localStorage.clear();
                    location.reload();
                    this.$router.push({ name: "login" });
                }, 500);
            });
        },
    },
};
</script>

<style>
.user-panel .info {
    display: flex;
    height: 100%;
    align-items: center;
}
.user-panel .info a {
    font-size: 0.8em;
}
</style>
