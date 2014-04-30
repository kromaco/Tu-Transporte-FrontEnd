<?php
    require("../includes/config.php"); 
 
 	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["todo"] != "DELETE"){ 
            if ($_FILES["datafile"]["error"] > 0) {
                apologize("Debe seleccionar un archivo CSV que contenga las coordenadas de una ruta...");
            } else {
    /*          echo "Upload: " . $_FILES["datafile"]["name"] . "<br>";
                echo "Type: " . $_FILES["datafile"]["type"] . "<br>";
                echo "Size: " . ($_FILES["datafile"]["size"] / 1024) . " kB<br>";
                echo "Stored in: " . $_FILES["datafile"]["tmp_name"];*/
                $allowed =  array('csv');
                $ext = pathinfo($_FILES["datafile"]["name"], PATHINFO_EXTENSION);
                
                if(!in_array($ext,$allowed) ) {
                    apologize("El archivo seleccionado no es CSV.");
                }else if($_FILES["datafile"]["size"] / 1024 > 15 ){
                    apologize("El archivo seleccionado es muy grande (Mayor a 15KB).");   
                }else if($_POST["todo"] == "createRoute"){ //File Ok
                    move_uploaded_file($_FILES["datafile"]["tmp_name"], "rutas/" . $_POST["name"].".csv");
                    redirect("rut.php");
                }else if($_POST["todo"] == "editRoute"){ //File Ok
                   // var_dump($_POST["api_url"]);
                   // var_dump($_POST["name"]);
                    $path = "rutas/".$_POST["api_url"];
                    unlink($path);
                    move_uploaded_file($_FILES["datafile"]["tmp_name"], "rutas/" . $_POST["name"].".csv");
                    //rename("rutas/".$_POST["api_url"], "rutas/".$_POST["name"].".csv");
                    redirect("rut.php");
                }
            }

        }

    	if (empty($_POST["todo"]) || empty($_POST["api_url"])){
    		echo "Error, missing data";
    	}else if($_POST["todo"] == "DELETE"){
            var_dump($_POST["api_url"]);
    		CallAPI("DELETE", $_POST["api_url"], NULL);
    	}

        /*else if($_POST["todo"] == "updateRoute"){
            $data = json_encode($_POST);
            $json = CallAPI("PUT",$_POST["api_url"],$data);
            $result = json_decode($json, true);
            if (isset($result["error"])){
                apologize($result["error"]);
            }else{
                redirect("res.php");
            }
        }else if($_POST["todo"] == "createRoute"){
            $data = json_encode($_POST);
            $json = CallAPI("POST",$_POST["api_url"],$data);
            $result = json_decode($json, true);
            if (isset($result["error"])){
                apologize($result["error"]);
            }else{
                redirect("res.php");
            }
           // CallAPI("DELETE", $_POST["api_url"], NULL);
        }*/
    }


?>