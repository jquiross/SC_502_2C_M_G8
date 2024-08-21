<?php
require './config/conexion.php';
require_once './models/PedidoModel.php';
require_once './controllers/controllerPedido.php';

$modeloPedido = new PedidoModel($conexion);
$pedidoController = new PedidoController($conexion);

try {
    $pedidos = $pedidoController->mostrarPedidos();
} catch (Exception $e) {
    echo 'Error al obtener pedidos: ' . $e->getMessage();
    $pedidos = [];
}

if (isset($_POST['eliminar_pedido'])) {
    $pedidoId = $_POST['pedido_id'];
    $resultado = $pedidoController->eliminarPedido($pedidoId);
    if ($resultado) {
        echo "Pedido eliminado con éxito.";
    } else {
        echo "Error al eliminar el pedido.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--
    Template 2108 Dashboard
    http://www.tooplate.com/view/2108-dashboard
    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
    <link rel="stylesheet" href="css/Pedido.css">

    <style>
        .centered-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            /* Permite que los elementos se envuelvan en pantallas más pequeñas */
        }

        .tm-block {
            padding: 20px;
            /* Padding para mejorar la visualización */
            margin: 10px;
            /* Margen para separar los bloques */
        }

        .tm-block-title {
            margin-bottom: 20px;
            /* Espacio debajo del título */
        }

        .checked-checkbox {
            background-color: #d4edda;
            /* Verde claro de fondo */
            border: 1px solid #c3e6cb;
            /* Borde verde claro */
            border-radius: 4px;
        }

        .checked-checkbox input[type="checkbox"] {
            accent-color: #28a745;
            /* Color verde del checkbox en navegadores compatibles */
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Oculta el input del switch */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Estilo para el slider del switch */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        /* Estilo para el círculo del switch */
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        /* Cuando el switch está activado */
        input:checked+.slider {
            background-color: #4CAF50;
            /* Verde */
        }

        /* Movimiento del círculo cuando el switch está activado */
        input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Estilo redondeado para el slider */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body id="reportsPage" class="bg02">
    <div class="container">
    <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-xl navbar-light bg-light">
                    <a class="navbar-brand" href="indexDashBoard.php">
                        <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                        <h1 class="tm-site-title mb-0">Dashboard</h1>
                    </a>
                    <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Página Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="accounts.php">Cuentas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos.php">Pedidos</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link d-flex" href="login.php">
                                    <i class="far fa-user mr-2 tm-logout-icon"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- row -->
        <div class="row tm-content-row tm-mt-big centered-container">
            <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12">
                <div class="bg-white tm-block h-100">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="tm-block-title d-inline-block">Pedidos</h2>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right">
                          
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped tm-table-striped-even mt-3">
                            <thead>
                                <tr class="tm-bg-gray">
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">Estado de la entrega</th>
                                    <th scope="col">Nombre del solicitante</th>
                                    <th scope="col" class="text-center">Unidades solicitadas</th>
                                    <th scope="col" class="text-center">En Stock</th>
                                    <th scope="col">Día de entrega</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td scope="row">
                                        </td>
                                        <td class="text-center"><label class="switch">
                                                <input type="checkbox" id="estadoEntrega">
                                                <span class="slider round"></span>
                                            </label></td>
                                        <td class="tm-product-name"><?php echo htmlspecialchars($pedido['nombre_solicitante']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($pedido['unidades_solicitadas']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($pedido['en_stock']); ?></td>
                                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($pedido['dia_entrega']))); ?></td>
                                        <td>
                                            <form action="./controllers/controllerPedido.php" method="post" class="eliminar-pedido-form">
                                                <input type="hidden" name="pedido_id" value="<?php echo htmlspecialchars($pedido['pedido_id']); ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- fin del row -->
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/scripts.js"></script>
        <script>
            $(function() {
                $('.tm-product-name').on('click', function() {
                    window.location.href = "edit-product.html";
                });
            })
        </script>
</body>

</html>