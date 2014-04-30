<?php

    // configuration
    require("../includes/config.php"); 
 
 	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {        
        render("rou_inspector.php", ["title" => "Editar Ruta", "post" => $_POST,"data" => $_POST["id"]]);
    }else{
        render("rou_inspector.php", ["title" => "Agregar Ruta"]);
    }

?>