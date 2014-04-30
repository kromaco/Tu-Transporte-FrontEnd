<?php

    // configuration
    require("../includes/config.php"); 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("Debe ingresar un usuario.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Debe ingresar la contraseña.");
        }else if ($_POST["username"] != "master") 
        {
            apologize("Nombre de usuario o contraseña inválidos");
        }else if ($_POST["password"] != "1234") 
        {
            apologize("Nombre de usuario o contraseña inválidos");
        }
        $_SESSION["id"] = "master";
        redirect("/");

    }
    else
    {
        // else render form
        render("login_form.php");
    }

?>
