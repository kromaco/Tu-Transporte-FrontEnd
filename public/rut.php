<?php
    require("../includes/config.php"); 
    $json = CallAPI("GET", "http://localhost:5000/api/1/routes", NULL);
	$result = json_decode($json, true);
	$routes = $result['routes'];
    render("rut.php", ["title" => "Rutas","routes" => $routes]);
?>