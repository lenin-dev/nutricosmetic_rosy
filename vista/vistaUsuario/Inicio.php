<section class="container">
    <div class="">
    <!-- grid de cartas de productos //////////////////////////////////// -->
        <p class="fs-4 fw-bold">PRODUCTOS SEYTÚ Y OMNILIFE</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php
            include_once("../../controlador/consultas/conexion.php");

            $queryProductos = "SELECT * FROM productos p, marca m WHERE p.IdMarca=m.IdMarca";
            $result = $cn->query($queryProductos);

            if($result->num_rows > 0) {

                while($prod = mysqli_fetch_array($result)) {
        ?>

            <div class="col-sm-12 col-md-6 col-lg-4 py-3 d-flex justify-content-center">
              <a href="./vista/vistaUsuario/producto.html?claveproducto=<?php echo $prod['TokenProd']; ?>" class="card shadow text-decoration-none" style="width: 14rem;">
                <img src="<?php echo ".".$prod['Imagen']; ?>" class="card-img-top size-img-prod" alt="Imagen producto">
                <div class="card-body">
                  <p class="card-title text-uppercase"><?php echo $prod['NomProducto']; ?></p>
                  <!-- <p class="card-text">Ideal para protegerte de los rayos del sol UVA/UVB, sin dejar sensación grasosa. Resistente al agua.</p> -->
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><?php echo $prod['NomMarca']; ?></li>

                  <?php
                      if($prod['PrecioOferta'] == 0) {
                  ?>
                        <li class="list-group-item text-success">$<?php echo $prod['PrecioOriginal']; ?>.00</li>
                  <?php  
                      } else { 
                  ?>
                        <li class="list-group-item text-danger text-decoration-line-through">$<?php echo $prod['PrecioOriginal']; ?>.00</li>
                        <li class="list-group-item text-success">$<?php echo $prod['PrecioOferta']; ?>.00</li>
                  <?php
                      }
                  ?>

                </ul>
              </a>
            </div>
        <?php
            
          }
        }
        ?>

        </div>
    </div>
</section>