import Vue from 'vue';
import Router from 'vue-router';

//views
import TareasView from '../views/Tareas/Tareas.vue';
import SoftwareView from '../views/Software/Software.vue';
import MovimientosView from '../views/Inventario/movimientos/Movimientos.vue';
import RecursosHumanos from '../views/RecursosHumanos/RecursosHumanos.vue';
import Activos from '../views/Inventario/activos/Activos.vue';
import Configuracion from '../views/Configuracion/Configuracion.vue'
import Home from '../views/Home/Home.vue'

Vue.use(Router)

export default new Router({
    
    routes: [
        {
             path: '/tareas',
             name: 'tareas',
             component: TareasView
        },

        {

            path: '/software',
            name: 'software',
            component: SoftwareView

        },

        {

            path: '/movimientos',
            name: 'movimientos',
            component: MovimientosView

        },

        {

            path: '/recursoshumanos',
            name: 'recursoshumanos',
            component: RecursosHumanos

        },

        {
            path: '/inventario',
            name: 'inventario',
            component: Activos
        },

        {
            path: '/configuracion',
            name: 'configuracion',
            component: Configuracion
        },

        {
            path: '/',
            name: 'home',
            component: Home
        }
    ]

});

