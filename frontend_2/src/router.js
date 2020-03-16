import Vue from 'vue'
import Router from 'vue-router'

import Home from './components/Home'
import clientes from './components/clientes/clientes'
import produtos from './components/produtos/produtos'
import pedidos from './components/pedidos/pedidos'
import relatorios from './components/relatorios/relatorios'



Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        { path: '/', component: Home },
        { path: '/clientes', component: clientes },
        { path: '/produtos', component: produtos },
        { path: '/pedidos', component: pedidos },
        { path: '/relatorios', component: relatorios }
    ]
})