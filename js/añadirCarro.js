$(document).ready(function() {
    $('.btn-agregar-carrito').on('click', function() {
        var idProducto = $(this).data('id');
        $.ajax({
            url: 'agregarCarrito.php',
            type: 'POST',
            data: { id: idProducto },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    });
}); 