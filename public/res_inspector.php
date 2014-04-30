<?php

    // configuration
    require("../includes/config.php"); 
 
 	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {        
        $json = CallAPI("GET", "http://localhost:5000/api/1/reviews/".$_POST["id"], NULL);
        $res = json_decode($json, true);
        $result = $res["review"];
        $result = $result["0"];
        render("res_inspector.php", ["title" => "Editar Reseña", "post" => $_POST,"data" => $result]);
    }else{
    render("res_inspector.php", ["title" => "Agregar Reseña"]);
    }

?>