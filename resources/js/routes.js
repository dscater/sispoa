import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        // INICIO
        {
            path: '/',
            name: 'inicio',
            component: require('./components/Inicio.vue').default
        },

        // LOGIN
        {
            path: '/login',
            name: 'login',
            component: require('./Auth.vue').default
        },

        // USUARIOS
        {
            path: '/usuarios/perfil/:id',
            name: 'usuarios.perfil',
            component: require('./components/modulos/usuarios/perfil.vue').default,
            props: true
        },
        {
            path: '/usuarios',
            name: 'usuarios.index',
            component: require('./components/modulos/usuarios/index.vue').default
        },

        // UNIDADES
        {
            path: '/unidads',
            name: 'unidads.index',
            component: require('./components/modulos/unidads/index.vue').default,
        },

        // FORMULARIO CUATRO
        {
            path: '/formulario_cuatro',
            name: 'formulario_cuatro.index',
            component: require('./components/modulos/formulario_cuatro/index.vue').default,
        },

        // DETALLE FORMULARIO CUATRO
        {
            path: '/detalle_formularios',
            name: 'detalle_formularios.index',
            component: require('./components/modulos/detalle_formularios/index.vue').default,
        },

        {
            path: '/detalle_formularios/create',
            name: 'detalle_formularios.create',
            component: require('./components/modulos/detalle_formularios/create.vue').default,
        },

        {
            path: '/detalle_formularios/edit/:id',
            name: 'detalle_formularios.edit',
            props: true,
            component: require('./components/modulos/detalle_formularios/edit.vue').default,
        },

        // FORMULARIO CINCO
        {
            path: '/formulario_cinco',
            name: 'formulario_cinco.index',
            component: require('./components/modulos/formulario_cinco/index.vue').default,
        },

        {
            path: '/formulario_cinco/create',
            name: 'formulario_cinco.create',
            component: require('./components/modulos/formulario_cinco/create.vue').default,
        },

        {
            path: '/formulario_cinco/edit/:id',
            name: 'formulario_cinco.edit',
            props: true,
            component: require('./components/modulos/formulario_cinco/edit.vue').default,
        },

        // CONFIGURACIÓN
        {
            path: '/configuracion',
            name: 'configuracion',
            component: require('./components/modulos/configuracion/index.vue').default,
            props: true
        },

        // REPORTES
        {
            path: '/reportes/usuarios',
            name: 'reportes.usuarios',
            component: require('./components/modulos/reportes/usuarios.vue').default,
            props: true
        },

        // PÁGINA NO ENCONTRADA
        {
            path: '*',
            component: require('./components/modulos/errors/404.vue').default
        },
    ],
    mode: 'history',
    linkActiveClass: 'active'
});