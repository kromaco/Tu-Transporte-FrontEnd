<script type="text/javascript">

	function deleteItem(id) {
    	var r = confirm("Está seguro de que desea eliminar la ruta?");
		if (r == true)
	  	{
	  		$.ajax({
		    type: "POST",
		    url: "API_Rutas.php",
		    //dataType: 'json',
		    data: {todo: 'DELETE', api_url:"http://localhost:5000/api/1/routes/"+id},
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
    	redirect('rou_inspector.php',id,'POST');	
    }

</script>


<section class="styles">
    <div>
	    <a href="index.php" class="cerrarSesion"  id = "button" style="float:left;margin:45px 0px 0px 60px;"> Regresar </a>
	    <h1 class="titulo"> 	
	        <img src="img/rouHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
	        Rutas  
	    </h1>
    </div>
    <table class="routesTable">
	<?php
		foreach ($routes as $route) {
			$route = substr($route, 0, strpos($route, "."));
			print("<tr class=tableRow>");
			print("<td class=routesBodyColumn>".$route. "</td>");
			print("<td class=tableButton><a href=# onclick=editItem(this.id); id=".$route."><img src=img/edt.png alt=Editar width=23 height=23></a></td>");
			print("<td class=tableButton><a href=# onclick=deleteItem(this.id); id=".$route."><img src=img/del.png alt=Eliminar width=29 height=30></a></td>");
			print("</tr>");
		}
	?>
</table>
</div>
<div>
	<div class="addButton">
		<a href="rou_inspector.php"><img src=img/add.png alt=Rutas width=70 height=70></a>
		Agregar Ruta...
	</div>
</div>



</section>