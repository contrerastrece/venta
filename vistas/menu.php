<?php 
	require_once "dependencia.php";
?>

<!DOCTYPE html>
<html lang="es">
        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menú animado</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="css/styleInicio.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class="navbar-brand" href="#">
            <img src="../img/Logo2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrar Articulos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="categoria.php">Categoria</a>
                    <a class="dropdown-item" href="articulos.php">Articulos</a>
                    </div>
                </li>
                <?php
                if ($_SESSION['usuario']=='admin'):
              
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Administrar Usuarios</a>
                </li>
                <?php
                  endif;
                ?>
                
                <li class="nav-item"> 
                <a class="nav-link" href="clientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ventas.php">Vender Articulo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario: <?php echo $_SESSION['usuario'];//0 es el nombre del Usuario ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../procesos/salir.php"><i class='bx bx-power-off' style="color:red"></i> Salir</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="../js/inicio.js"></script>
</body>

</html>



