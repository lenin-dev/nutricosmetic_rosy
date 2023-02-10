<?php

    // BUSCA SI EXISTE EL EMAIL
    function searchRepeated($email, $cn) {
        $sql = "SELECT * FROM usuarios WHERE Email='$email'";
        $resultBusqueda = mysqli_query($cn, $sql);

        if (mysqli_num_rows($resultBusqueda)>0) {
            return 1;
        } else {
            return 0;
        }
    }
