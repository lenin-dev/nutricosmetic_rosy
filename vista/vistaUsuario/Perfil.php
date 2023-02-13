<!DOCTYPE html>
<html lang="en-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

    <!-- Modal Editar imagen -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar imagen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Direccion -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar dirección</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- contenido pagina -->
    <section class="container">
        <div class="row row-cols-1 row-cols-md-3 my-3">
            <div class="col-sm-12 col-md-4 mx-auto">
                <div class="mb-3">
                    <div class="contenedorIcon mt-5">
                        <img src="./galeria/iconos/usuario_login.png" class="imagenUsuario" alt="editImg1">
                        <button type="button" class="mx-auto btnContIcon" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="btnEditar" src="./galeria/iconos/lapiz.png" alt="editar"></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 mx-auto">
                <label class="fw-bold fs-3 my-2 text-center">Datos de usuario</label>
                <input type="text" name="nombre" class="form-control my-2" value="nombre" disabled>
                <input type="text" name="correo" class="form-control my-2" value="correo" disabled>
                <input type="text" name="celular" class="form-control my-2" value="celular" disabled>
            </div>
        </div>
        <div clss="container">
            <div class="mt-4">
                <p class="fw-bold fs-3 mt-4 my-2 text-center">Dirección</p>
                <div class="contButton mx-auto my-3">
                    <button class="bntAdd" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        <span class="contIcon"><svg class="iconAdd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg></span>
                        Agregar dirección
                    </button>
                </div>
                <div class="row justify-content-md-cente">
                    <div class="col col-lg-6 mx-auto mb-5">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Dirección
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Colonía</label>
                                                <input type="text" class="form-control" disabled value="colonia">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" disabled value="direccion">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Código postal</label>
                                                <input type="text" class="form-control" disabled value="cp">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Núm. Exterior</label>
                                                <input type="text" class="form-control" disabled value="Exterior">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Núm. Interior</label>
                                                <input type="text" class="form-control" disabled value="Interior">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>   
            </div>
        </div>
        
        <div id="map"></div>
        
    </section>


    
</body>
</html>