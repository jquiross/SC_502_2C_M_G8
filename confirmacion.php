<?php
session_start();

// Verificar si el ID del pedido está en la URL
if (!isset($_GET['pedido_id'])) {
    // Si no hay un ID de pedido, redirigir al usuario a la página principal
    header("Location: index.php");
    exit();
}

$pedido_id = $_GET['pedido_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">¡Gracias por tu compra!</h2>
        <p class="text-center">Tu pedido ha sido procesado con éxito.</p>
        <p class="text-center">ID de tu pedido: <strong><?php echo htmlspecialchars($pedido_id); ?></strong></p>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Volver a la Tienda</a>
        </div>
    </div>
    
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
