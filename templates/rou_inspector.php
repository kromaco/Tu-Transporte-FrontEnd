<script type="text/javascript">
	function textCounter( field, countfield, maxlimit ) {
		if ( field.value.length > maxlimit ) {
			field.value = field.value.substring( 0, maxlimit );
			field.blur();
			field.focus();
			return false;
		}else {
			countfield.value = maxlimit - field.value.length;
		}
	}

	function editReview(id) {
    	var r = confirm("Está seguro de que desea eliminar la reseña?");
		if (r == true)
	  	{
	  		$.ajax({
		    type: "POST",
		    url: "API.php",
		    //dataType: 'json',
		    data: {todo: 'DELETE', api_url:"http://localhost:5000/api/1/reviews/"+id},
   			success: function (response) {
     			alert(response);
   			}
			});
		location.reload();
	  	}
    	return true;
	}

  	var redirect = function(url, id, method) {
    		var form = document.createElement('form');
    		form.method = method;
    		form.action = url;
    		var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", 'id');
            hiddenField.setAttribute("value", id);
            form.appendChild(hiddenField);
    		form.submit();
    }		

	function editItem(id) {
    	redirect('res_inspector.php',id,'POST');	
    }

</script>


<section class="styles">
    <div>
        <a href="rut.php" class="cerrarSesion"  id = "button" style="float:left;margin:45px 0px 0px 60px;"> Regresar </a>
	    <?php if (isset($data)): ?>
	    	<h1 class="titulo"> 	
	        	<img src="img/rouHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
	        	Editar Ruta
	    	</h1>
    	<?php else: ?>
    	    <h1 class="titulo"> 	
	        	<img src="img/rouHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
	        	Crear Ruta
	    	</h1>
  		<?php endif ?>	
    </div>
    <div>
</section>

<section class="contentInspector">
<div class="center">
	<?php if (isset($data)): ?>
    		<form action="API_Rutas.php" method="POST" enctype="multipart/form-data">
    		<?php 
            $name = $variable = substr($data, 0, strpos($data, "."));
    		print("<input type=text required title='El nombre es obligatorio.' maxlength=10 class=name placeholder=Nombre name=name value="."'".$name."'".">")?>
            <input type="file" id="fileElem" name="datafile" size="20">
            <button id="fileSelectRoutes" type="button">Seleccione el archivo con la ruta...</button>
        	<input type="hidden" name="todo" value="editRoute">
        	<?php print("<input type=hidden name=api_url value=".$data.">")?>
        	<div class="centerDiv">
	        	<button id="button" type="submit" class="saveRoutes">Guardar</button>
	        	<a href="rut.php" class="cancelRoutes"  id = "button"> Cancelar </a>
	        </div>	
        <?php else: ?>
    		<form action="API_Rutas.php" method="POST" enctype="multipart/form-data">
    		<?php 
    		print("<input type=text required title='El nombre es obligatorio.' maxlength=10 class=name placeholder=Nombre name=name>")?>
            <input type="file" id="fileElem" name="datafile" size="20">
            <button id="fileSelectRoutes" type="button">Seleccione el archivo con la ruta...</button>
        	<input type="hidden" name="todo" value="createRoute">
            <?php print("<input type=hidden name=api_url value=http://localhost:5000/api/1/routes>")?>

        	<div class="centerDiv">
	        	<button id="button" type="submit" class="saveRoutes">Guardar</button>
	        	<a href="rut.php" class="cancelRoutes"  id = "button"> Cancelar </a>
	        </div>
        <?php endif ?>	
    </form>
    <div class="message">
        Las rutas deben ser subidas en formato CSV con un juego de coordenadas Latitud-Longitud por fila.
    </div>  
</div>    
</section>


<!--<input type="file" id="fileElem" multiple>
<button id="fileSelect">Select some files</button>-->

<script>
    document.querySelector('#fileSelectRoutes').addEventListener('click', function(e) {
        // Use the native click() of the file input.
        document.querySelector('#fileElem').click();
    }, false);

    $("input[name='attachment[]']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    console.log(fileName);
});

</script>

