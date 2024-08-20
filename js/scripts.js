/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
// scripts.js
function actualizarCarrito() {
    fetch('controllers/controllerCarrito.php?action=ver')
    .then(response => response.text())
    .then(data => {
        document.querySelector('.carrito-contenido').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

function agregarAlCarrito(productoId, cantidad) {
    let formData = new FormData();
    formData.append('producto_id', productoId);
    formData.append('cantidad', cantidad);

    fetch('controllers/controllerCarrito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('cantidadCarrito').innerText = data;
        actualizarCarrito();  // Llamar a la función para actualizar la vista del carrito
    })
    .catch(error => console.error('Error:', error));
}

    $(document).ready(function() {
    // Manejar la actualización de cantidad en el carrito
    $('.actualizar-carrito').on('submit', function(e) {
        e.preventDefault(); // Evitar la redirección

        var $form = $(this);
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                // Recargar la página para reflejar los cambios
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error("Error en la actualización: " + error);
            }
        });
    });

    // Manejar la eliminación de un producto del carrito
    $('.eliminar-carrito').on('submit', function(e) {
        e.preventDefault(); // Evitar la redirección

        var $form = $(this);
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                // Recargar la página para reflejar los cambios
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error("Error en la eliminación: " + error);
            }
        });
    });
});



