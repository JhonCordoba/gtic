/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require("./bootstrap");

import Vue from "vue";

import router from "./router/index";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component(
    "crudtable-component",
    require("./components/CrudTableComponent.vue")
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: "#app",
    router
});

function llenarSelect(urlGetData, id_select) {
    $(".selectpicker").selectpicker();

    $.ajax({
        type: "get",
        url: urlGetData,
        success: function(response) {
            let opcion = "";

            for (let i = 0; i < response.length; i++) {
                opcion =
                    "<option value='" +
                    response[i][0] +
                    "'option>" +
                    response[i][1] +
                    "</option>";

                $("#" + id_select).append(opcion);
            }

            $(".selectpicker").selectpicker("refresh");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(jqXHR);
            console.log(errorThrown);
            alert("Se produjo un error, por favor intenta nuevamente");
        }
    });
}

$(document).ready(function() {
    $(".leftmenutrigger").on("click", function(e) {
        $(".side-nav").toggleClass("open");
        $("#contenedorPadrePrincipal").toggleClass(
            "open_contenedorPadrePrincipal"
        );
        if ($("#logo_menu_vertical").is(":visible"))
            $("#logo_menu_vertical").hide(300);
        else $("#logo_menu_vertical").show(300);
        e.preventDefault();
    });
});
