import '../libraries/bootstrap_select.js';

export function llenarSelect(urlGetData, id_select) {

    $(".selectpicker").selectpicker();

    $.ajax({
        type: "get",
        url: urlGetData,
        headers: {
            'Authorization': `Bearer ${localStorage.getItem("token_auth_api")}`
        },
        success: function(response) {
            console.log(response);

            let opcion = "";

            for (let i = 0; i < response.length; i++) {
                opcion =
                    "<option value='" +
                    response[i][0] +
                    "'option>" +
                    response[i][1] +
                    "</option>";

                $("#" + id_select).append(opcion);

                $('.selectpicker').selectpicker('refresh');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(jqXHR);
            console.log(errorThrown);
            alert("Se produjo un error, por favor intenta nuevamente");
        }
    });
}