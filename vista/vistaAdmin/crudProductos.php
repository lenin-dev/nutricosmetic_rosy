
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>CRUD Productos</title>

    <link rel="stylesheet" href="../../estilos/estiloPrin.css">

    <!-- BOOTSTRAP y sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">

</head>
<body id="fondo">

    <!-- encabezado, menu principal ////////////////////////////////////////////////////// -->
    <!-- nombre y logo de la pagina /////////////////////////////////////////////// -->
    <nav class="navbar navbar-expand-lg" style="background-color: #F6C62E">
        <div class="container-sm">
            <a class="navbar-brand mb-0 h1" href="../../">
                <img src="../../galeria/iconos/iconotienda.png" alt="Logo" width="40" height="40" 
                class="d-inline-block align-text-center">
            </a>
    <!-- boton hamburguesa /////////////////////////////////////////////////// -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
            </button>
    <!-- opciones del menu ////////////////////////////////////////////////////////// -->
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" id="pageInicio" aria-current="page" href="../../#productos">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" id="pageQuienesSomos" href="../../#quiensoy">QUIÉN SOY</a>
                </li>
                <li class="nav-item mb-2 mt-2">
                    <a href="#" class="btn-transparent position-relative mx-3">
                        <img src="../../galeria/iconos/carrito-de-compras.png" height="30" width="30" alt="carrito-de-compras">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>
            </ul>
    <!-- icono de usuario /////////////////////////////////////////////////////////////// -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../galeria/iconos/usuario.png" id="imgIconNavbar" alt="Logo" width="40" height="40" class="iconUsuario d-inline-block align-text-center">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="prod" class="dropdown-item" href="../../vista/vistaAdmin/crudProductos.html">Administrar productos</a></li>
                        <li><a id="resp2" class="dropdown-item" href="../../vista/Perfil.php">Perfil</a></li>
                        <li><hr id="resp3" class="dropdown-divider" id="resp"></li>
                        <li><a id="resp4" class="dropdown-item" href="../../controlador/consultas/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <section class="container my-5 mx-auto py-4 px-4 bg-light text-center" id="border-radius">
        <div class="row">
            <div class="col">
                <p class="fw-bold fs-3">AGREGAR</p>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2">
                <button type="button" id="btnProd" class="btn btn-info fw-bold" data-bs-toggle="modal" data-bs-target="#staticAddProductos">Producto</button>
            </div>
            <div class="col col-lg-2">
                <button type="button" id="btncat" class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#staticAddCategoria">Categoría</button>
            </div>
            <div class="col col-lg-2">
                <button type="button" id="btnMarca" class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#staticAddMarca">Marca</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger mt-4" id="mensaje-error-prod" role="alert"></div>
                <p class="fw-bold fs-3 mt-4">PRODUCTOS</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 justify-content-end">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Porción</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Oferta</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--                 -->
    <!-- MODAL CONTAINER -->
    <!--                 -->

    <!-- Modal Add Productos -->
    <div class="modal fade modal-lg" id="staticAddProductos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticAddProductos">Agregar productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarProductos" name="formAgregarProductos" method="post">
                        <div class="alert alert-danger text-center" id="mensaje4" role="alert" style="display: none;"></div>
                        <div class="row row-cols-1 row-cols-sm-1 g-0">
                            <!-- div de la imagen contenedor -->
                            <div class="col col-lg-5 col-sm-12">
                                <div class="mb-3 text-center">
                                   <img src="../../galeria/iconos/agregar.png" class="img-fluid rounded my-auto mx-auto d-block" width="300" height="300" name="imagenUsuario" id="imagenUsuario" alt="Imagen del producto">
                                    <div class="file-input mt-4">
                                        <input type="file" name="file-input" onchange="mostrar(event)" id="file-input" class="file-input__input"/>
                                        <label class="file-input__label" for="file-input"><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg>
                                            <span>Subir imagen</span>
                                        </label> 
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- div del formulario contenedor -->
                            <div class="col col-lg-6 col-sm-12 mx-auto">

                                <label for="inputNombreProducto" class="form-label">Nombre producto</label>
                                <input type="text" class="form-control" name="txtProducto" 
                                id="inputNombreProducto" placeholder="Nombre producto" required>

                                <div class="row row-cols-2 mt-3">
                                    <div class="col-6">
                                        
                                        <label for="selectCategoria" class="form-label">Categoría</label>
                                        <select class="form-select" name="txtCategoria" id="selectCategoria" aria-label="Default select example" required>
                                            <option value="0" selected>Escoge una categoría</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="selectMarca" class="form-label">Marca</label>
                                        <select class="form-select" name="txtMarca" id="selectMarca" aria-label="Default select example" required>
                                            <option value="0" selected>Escoge una marca</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row row-cols-2 mt-3">
                                    <div class="col-6">
                                        <label for="inputPrecio" class="form-label">Precio</label>
                                        <input type="text" name="txtPrecio" class="form-control" id="inputPrecio" placeholder="$ 0.00 mx" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputProcion" class="form-label">Porción</label>
                                        <input type="text" name="txtPorcion" class="form-control" id="inputProcion" placeholder="0 gr / lt / ml" required>
                                    </div>
                                </div>

                                <div class="row row-cols-2 mt-3">
                                    <div class="col-6 my-auto mx-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                            <label class="form-check-label" name="inlineFormCheck" for="inlineFormCheck">
                                                ¿Está en oferta?
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-6">
                                        <label for="inputOferta" class="form-label">Oferta</label>
                                        <input type="text" name="txtOferta" disabled class="form-control" id="inputOferta" placeholder="$ 0.00 mx">
                                    </div>
                                </div>

                                <label for="textTareaDescripcion mt-3" class="form-label">Descripción</label>
                                <textarea class="form-control" name="txtDescripcion" id="textTareaDescripcion" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" id="cerrarModal" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Add Categorias -->
    <div class="modal fade modal-md" id="staticAddCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticAddCategoria">Agregar categorías</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCategoria" name="formAgregarCategoria" method="post">
                        <div class="alert alert-danger text-center" id="mensaje5" role="alert" style="display: none;"></div>
                        <div class="row row-cols-2 g-0">
                            <div class="col-5 col-lg-5">
                                <p>Lista de categorías</p>

                                <ul id="listaCategoria">
                                    
                                </ul>

                            </div>
                            <div class="col-7 col-lg-7">
                                <label for="inputCategoria" class="form-label">Categoría</label>
                                <input type="text" required class="form-control" name="txtCategoria" id="inputCategoria" placeholder="Categoría(protector solar, bebida)">
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="addCategoria" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Marca -->
    <div class="modal fade modal-md" id="staticAddMarca" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticAddMarca">Agregar marcas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarMarca" name="formAgregarMarca" method="post">
                        <div class="alert alert-danger text-center" id="mensaje6" role="alert" style="display: none;"></div>
                        <div class="row row-cols-2 g-0">
                            <div class="col-5 col-lg-5">
                                <p>Lista de marcas</p>

                                <ul id="listaMarca">
                                    
                                </ul>

                            </div>
                            <div class="col-7 col-lg-7">
                                <label for="inputMarca" class="form-label">Marca</label>
                                <input type="text" required class="form-control" name="txtMarca" id="inputMarca" placeholder="Introdusca la marca">
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="addMarca" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- JavaScript Bundle with Popper ////////////////////////////////////////////////////// -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script src="../../controlador/peticiones/validacionUsuario.js"></script>
    <script src="../../controlador/peticiones/crudProducto.js"></script>


</body>
</html>