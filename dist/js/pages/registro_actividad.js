

function queryActividad(){
        var id = document.getElementById("id_actividad").value;
        console.log("id: "+id);
        fetch_actividad(id);
        fetch_plataforma(id);
        fetch_categoria(id);
}

function fetch_actividad(id){
        var parametros = {
                "id" : id
        };
        $.ajax({
                data:  parametros,
                url:   'pages/backend/fetch_actividad.php',
                type:  'post',
                beforeSend: function () {
                        console.log("iniciando");
                },
                success:  function (response) {
                    console.log("respuesta: "+response);
                    //document.getElementById("actividad").value = response;
                    $('#actividad').val(response);
                }
        });
}

function fetch_plataforma(id){
        var parametros = {
                "id" : id
        };
        $.ajax({
                data:  parametros,
                url:   'pages/backend/fetch_plataforma.php',
                type:  'post',
                beforeSend: function () {
                        console.log("iniciando");
                },
                success:  function (response) {
                    console.log("respuesta: "+response);
                    //document.getElementById("actividad").value = response;
                    $('#plataforma').val(response);
                }
        });
}

function fetch_categoria(id){
        var parametros = {
                "id" : id
        };
        $.ajax({
                data:  parametros,
                url:   'pages/backend/fetch_categoria.php',
                type:  'post',
                beforeSend: function () {
                        console.log("iniciando");
                },
                success:  function (response) {
                    console.log("respuesta: "+response);
                    //document.getElementById("actividad").value = response;
                    $('#categoria').val(response);
                }
        });
}