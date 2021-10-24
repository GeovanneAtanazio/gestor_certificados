/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// JQuery
window.$ = window.jQuery = require( 'jquery' );
require('jquery-mask-plugin');

// DataTables
require( 'datatables.net' );
require( 'datatables.net-dt' );
$(document).ready( function () {
    $('#table_id').DataTable({
        responsive: true,
        lengthMenu: [25, 50, 100],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        search: {
            "caseInsensitive": true,
        },
    });
} );

//método para bloquear botão de voltar do navegador
$(document).ready(function() {
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, "", window.location.href);
    };
});

//DataTables Plugins: Accent Neutralise
(function(){
    function removeAccents ( data ) {
        if ( data.normalize ) {
            // Use I18n API if avaiable to split characters and accents, then remove
            // the accents wholesale. Note that we use the original data as well as
            // the new to allow for searching of either form.
            return data +' '+ data
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
        }

        return data;
    }

    var searchType = jQuery.fn.DataTable.ext.type.search;

    searchType.string = function ( data ) {
        return ! data ?
            '' :
            typeof data === 'string' ?
                removeAccents( data ) :
                data;
    };

    searchType.html = function ( data ) {
        return ! data ?
            '' :
            typeof data === 'string' ?
                removeAccents( data.replace( /<.*?>/g, '' ) ) :
                data;
    };
}());

