function buscador(){
    var valor = document.getElementById('nombrePro').value;
    var param = {
        "idBuscador": valor
    }

    $.ajax({
        data: param,
        url: 'ctroUser.php',
        datatype: 'texto',
        method: 'get',
        success: function(respuesta){
           document.getElementById('mostrarPro').innerHTML = respuesta;
        },
        error: function(xhr,status,error){
            console.log(error);
        }
    
    
    })
}