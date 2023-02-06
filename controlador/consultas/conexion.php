<?php
	$cn = mysqli_connect("localhost", "root", "", "nutricosmetic", "3306");
	if ($cn->connect_error)
	{
		die($cn->connect_error);
	}
	