<?php
    //header("Content-Type: application/json");
    // configuration
    require("../includes/config.php"); 
 
 	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["todo"] != "DELETE"){ 
            if ($_FILES["datafile"]["error"] > 0) {
                apologize("Debe seleccionar una imagen...");
            } else {
    /*          echo "Upload: " . $_FILES["datafile"]["name"] . "<br>";
                echo "Type: " . $_FILES["datafile"]["type"] . "<br>";
                echo "Size: " . ($_FILES["datafile"]["size"] / 1024) . " kB<br>";
                echo "Stored in: " . $_FILES["datafile"]["tmp_name"];*/
                    $allowed =  array('gif','png','jpg','JPG','PNG','GIF');
                    $ext = pathinfo($_FILES["datafile"]["name"], PATHINFO_EXTENSION);
                    
                    if(!in_array($ext,$allowed) ) {
                        apologize("El archivo seleccionado no es una imagen o no tiene un formato soportado");
                    }else if($_FILES["datafile"]["size"] / 1024 > 1024 ){
                        apologize("La imagen seleccionada es muy grande (Mayor a 1MB).");   
                    }else{ //File Ok
                        $name = str_replace(' ', '', $_POST["name"]);//ereg_replace(" ", "", $_POST["name"]);
                        $name = trim($name);
                        move_uploaded_file($_FILES["datafile"]["tmp_name"], "upload/" . $name.".jpg");
                    }
                }

        }

    	if (empty($_POST["todo"]) || empty($_POST["api_url"])){
    		echo "Error, missing data";
    	}else if($_POST["todo"] == "DELETE"){
            $name = str_replace(' ', '', $_POST["name"]);//ereg_replace(" ", "", $_POST["name"]);
            $name = trim($name);
            $path = "upload/".$name.".jpg";
            var_dump($path);
            unlink($path);
    		CallAPI("DELETE", $_POST["api_url"], NULL);
    	}else if($_POST["todo"] == "updateReview"){
         
            $data = json_encode($_POST);
            $json = CallAPI("PUT",$_POST["api_url"],$data);
            $result = json_decode($json, true);
            if (isset($result["error"])){
                apologize($result["error"]);
            }else{
                redirect("res.php");
            }
        
        }else if($_POST["todo"] == "createReview"){
            $data = json_encode($_POST);
            $json = CallAPI("POST",$_POST["api_url"],$data);
            $result = json_decode($json, true);
            if (isset($result["error"])){
                apologize($result["error"]);
            }else{
                redirect("res.php");
            }
        }
    }


?>