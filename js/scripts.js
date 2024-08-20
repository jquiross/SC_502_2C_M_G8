/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

// Function to update the cart content
function actualizarCarrito() {
    fetch('controllers/controllerCarrito.php?action=ver')
    .then(response => response.text())
    .then(data => {
        document.querySelector('.carrito-contenido').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

// Function to add a product to the cart
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
        actualizarCarrito();  // Call function to update cart view
    })
    .catch(error => console.error('Error:', error));
}

$(document).ready(function() {
    // Handle cart quantity update
    $('.actualizar-carrito').on('submit', function(e) {
        e.preventDefault(); // Prevent redirection

        var $form = $(this);
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                // Reload page to reflect changes
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error("Error updating cart: " + error);
            }
        });
    });

    // Handle removal of a product from the cart
    $('.eliminar-carrito').on('submit', function(e) {
        e.preventDefault(); // Prevent redirection

        var $form = $(this);
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                // Reload page to reflect changes
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error("Error removing from cart: " + error);
            }
        });
    });

    // Handle checkbox color change
    $('input[type="checkbox"]').change(function() {
        if (this.checked) {
            $(this).parent().addClass('checked-checkbox');
        } else {
            $(this).parent().removeClass('checked-checkbox');
        }
    });
    

    // Handle the delete icon functionality
    $('.tm-trash-icon').on('click', function() {
        var $row = $(this).closest('tr');
        var pedidoId = $row.data('pedido-id'); // Get the pedido ID from the row data

        $.ajax({
            type: 'POST',
            url: 'controllers/controllerPedidos.php',
            data: { action: 'eliminar', pedido_id: pedidoId },
            success: function(response) {
                // Remove the row from the table
                $row.remove();
            },
            error: function(xhr, status, error) {
                console.error("Error deleting order: " + error);
            }
        });
    });
});




