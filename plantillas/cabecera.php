<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Intranet gestión empresa">
    <meta name="author" content="ELENA MIGALLON GALLEGO">

    <title>Intranet Administración</title>

    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/estilos.css">
    <link href="/public/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/public/index.php">
                <div class="sidebar-brand-icon">
                    <img src="/public/imgs/logo.png" alt="Intranet Administración" class="img-fluid"></img>
                </div>
                <div class="sidebar-brand-text mx-3">TU INTRANET</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="/public/index.php">
                    <span class="fas fa-home"></span>
                    <span>Inicio</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span class="fas fa-hotel"></span>
                    <span>Centros</span></a>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/public/index_centros.php">Listado Centros</a>
                        <a class="collapse-item" href="/public/index_centros.php?accion=crear">Nuevo Centro</a>
                        <a class="collapse-item" href="/public/index_centros.php">Modificar Centro</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmpleados" aria-expanded="true" aria-controls="collapseEmpleados">
                    <span class="fas fa-user-tie"></span>
                    <span>Empleados</span></a>
                </a>
                <div id="collapseEmpleados" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/public/index_trabajadores.php">Listado Empleados</a>
                        <a class="collapse-item" href="/public/index_trabajadores.php?accion=crear">Añadir Empleado</a>
                        <a class="collapse-item" href="/public/index_trabajadores.php">Modificar Empleado</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServicios" aria-expanded="true" aria-controls="collapseServicios">
                    <span class="fas fa-solid fa-star"></span>
                    <span>Servicios</span></a>
                </a>
                <div id="collapseServicios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/public/index_servicios.php">Listado Sevicios</a>
                        <a class="collapse-item" href="/public/index_servicios.php?accion=crear">Añadir Servicio</a>
                        <a class="collapse-item" href="/public/index_servicios.php">Modificar Servicio</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="true" aria-controls="collapseVentas">
                    <span class="fas fa-cash-register"></span>
                    <span>Ventas</span></a>
                </a>
                <div id="collapseVentas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/public/index_ventas.php">Ver ventas</a>
                        <a class="collapse-item" href="/public/index_ventas.php?accion=crear">Realizar Venta</a>
                        <a class="collapse-item" href="/public/index_ventas.php">Modificar Venta</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGastos" aria-expanded="true" aria-controls="collapseGastos">
                    <span class="fas fa-money-bill-wave"></span>
                    <span>Gastos</span></a>
                </a>
                <div id="collapseGastos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/plantillas/en_construccion.php">Listar Gastos</a>
                        <a class="collapse-item" href="/plantillas/en_construccion.phpr">Añadir Gasto</a>
                        <a class="collapse-item" href="/plantillas/en_construccion.php">Modificar Gasto</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBeneficios" aria-expanded="true" aria-controls="collapseBeneficios">
                    <span class="fas fa-chart-line"></span>
                    <span>Beneficios</span></a>
                </a>
                <div id="collapseBeneficios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/plantillas/en_construccion.php">Consultar Beneficios</a>

                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUsuarios">
                    <span class="fas fa-users"></span>
                    <span>Control Usuarios</span></a>
                </a>
                <div id="collapseUsuarios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/public/index_usuarios.php">Consultar Usuarios</a>
                        <a class="collapse-item" href="/public/index_usuarios.php">Añadir Usuarios</a>
                        <a class="collapse-item" href="/public/index_usuarios.php">Modificar Usuarios</a>
                    </div>
                </div>
            </li>


            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Usuario</span>
                                <img class="img-profile rounded-circle" src="/public/imgs/profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/public/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>