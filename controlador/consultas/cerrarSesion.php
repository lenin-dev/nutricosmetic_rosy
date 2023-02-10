<?php

    session_start();
    session_destroy();

	$ruta = "../";

    header("location: /nutricosmetic_rosy");
    exit();