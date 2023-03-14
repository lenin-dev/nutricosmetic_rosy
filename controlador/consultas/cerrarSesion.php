<?php

    session_start();
    session_destroy();
    session_unset();

	$ruta = "../";

    header("location: /nutricosmetic_rosy");
    exit();