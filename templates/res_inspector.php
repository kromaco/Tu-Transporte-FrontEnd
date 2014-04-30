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
        <a href="res.php" class="cerrarSesion"  id = "button" style="float:left;margin:45px 0px 0px 60px;"> Regresar </a>
	    <?php if (isset($data)): ?>
	    	<h1 class="titulo"> 	
	        	<img src="img/resHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
	        	Editar Rese&#241;a
	    	</h1>
    	<?php else: ?>
    	    <h1 class="titulo"> 	
	        	<img src="img/resHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
	        	Crear Rese&#241;a
	    	</h1>
  		<?php endif ?>	
    </div>
    <div>
</section>

<section class="contentInspector">
<div class="center">
	<?php if (isset($data)): ?>
    		<form action="api.php" method="POST" enctype="multipart/form-data">
    		<?php 
    		print("<input type=text required title='El nombre es obligatorio.' maxlength=25 class=name placeholder=Nombre name=name value="."'".$data["name"]."'".">")?>
        	<br>
        	<?php print("<textarea onblur=textCounter(this,this.form.counter,250); onkeyup=textCounter(this,this.form.counter,250); type=text required title='La Rese&#241;a es obligatoria' maxlength=250 class=RevDescription placeholder=Rese&#241;a name=description>".$data["description"]."</textarea>")?>
        	<input class="counter" onblur="textCounter(this.form.recipients,this,250);" disabled  onfocus="this.blur();" tabindex="999" maxlength="3" size="3" value="250" name="counter">
        	<input type="hidden" name="todo" value="updateReview">
        	<?php print("<input type=hidden name=api_url value=http://localhost:5000/api/1/reviews/".$data["id"].">")?>
        	<div class="centerDiv">
	        	<button id="button" type="submit" class="save">Guardar</button>
	        	<a href="res.php" class="cancel"  id = "button"> Cancelar </a>
	        </div>	
        <?php else: ?>
    		<form action="api.php" method="POST" enctype="multipart/form-data">
    		<?php 
    		print("<input type=text required title='El nombre es obligatorio.' maxlength=25 class=name placeholder=Nombre name=name>")?>
        	<?php print("<textarea onblur=textCounter(this,this.form.counter,250); onkeyup=textCounter(this,this.form.counter,250); type=text required title='La Rese&#241;a es obligatoria' maxlength=250 class=RevDescription placeholder=Rese&#241;a name=description></textarea>")?>
        	<input class="counter" onblur="textCounter(this.form.recipients,this,250);" disabled  onfocus="this.blur();" tabindex="999" maxlength="3" size="3" value="250" name="counter">            
            <input type="file" id="fileElem" name="datafile" size="20">
            <button id="fileSelect" type="button">Seleccione una imagen</button>
        	<input type="hidden" name="todo" value="createReview">
            <?php print("<input type=hidden name=api_url value=http://localhost:5000/api/1/reviews>")?>
        	<div class="centerDiv">
	        	<button id="button" type="submit" class="save">Guardar</button>
	        	<a href="res.php" class="cancel"  id = "button"> Cancelar </a>
	        </div>	
        <?php endif ?>	
    </form>
</div>    
</section>


<!--<input type="file" id="fileElem" multiple>
<button id="fileSelect">Select some files</button>-->

<script>
    document.querySelector('#fileSelect').addEventListener('click', function(e) {
        // Use the native click() of the file input.
        document.querySelector('#fileElem').click();
    }, false);

    $("input[name='attachment[]']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    console.log(fileName);
});

</script>

