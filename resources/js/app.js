/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 import Vue from 'vue'

 window.Vue = require('vue');
 import { Form, HasError, AlertError} from 'vform';
 import {ServerTable, ClientTable, Event} from 'vue-tables-2';
 Vue.use(ServerTable, {}, false, 'bootstrap3');
 Vue.use(ClientTable, {}, false, 'bootstrap3');
 Vue.use(Event);


 // Vue.prototype.$gate = new Gate(window.user);

 import VueProgressBar from 'vue-progressbar';
 Vue.use(VueProgressBar, {
   color: 'rgb(143, 255, 199)',
   failedColor: 'red',
   height: '5px'
 });

// import VueCircle from 'vue2-circle-progress'


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import swal from 'sweetalert2';
window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

const moment = require('moment')
require('moment/locale/id')
Vue.filter('myDate', function(created){
	return moment(created).format('dddd, Do MMMM YYYY');
  // return moment().to(data);
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import VueRouter from 'vue-router'
window.Fire = new Vue();
Vue.use(VueRouter)
let routes = [
    { path: '/admin/dashboard', component: require('./components/Admin/Dashboard.vue').default},

    { path: '/admin/pengaturan', component: require('./components/Admin/Pengaturan.vue').default},

    { path: '/admin/halaman', component: require('./components/Admin/Halaman.vue').default, name: 'daftar-halaman'},
    { path: '/admin/halaman/tambah', component: require('./components/Admin/TambahHalaman.vue').default},
    { path: '/admin/halaman/ubah/:id', component: require('./components/Admin/UbahHalaman.vue').default, name: 'edit-halaman'},

    { path: '/admin/produk', component: require('./components/Admin/Produk.vue').default, name: 'daftar-produk'},
    { path: '/admin/produk/tambah', component: require('./components/Admin/TambahProduk.vue').default},
    { path: '/admin/produk/ubah/:id', component: require('./components/Admin/EditProduk.vue').default, name: 'edit-produk'},

    { path: '/admin/galeri', component: require('./components/Admin/Galeri.vue').default, name: 'daftar-galeri'}
]

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('aboutus', require('./components/Front/AboutUs.vue').default);
Vue.component('principals', require('./components/Front/Principals.vue').default);
Vue.component('products', require('./components/Front/Products.vue').default);
Vue.component('galeri', require('./components/Front/Gallery.vue').default);
Vue.component('contactus', require('./components/Front/ContactUs.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const router = new VueRouter({
 	mode: 'history',
 	routes
 })

 const app = new Vue({
    el: '#app',
    router
 });
