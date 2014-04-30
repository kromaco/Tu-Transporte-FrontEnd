<script type="text/javascript">

	function deleteItem(id, name) {
    	var r = confirm("Está seguro de que desea eliminar la reseña?");
		if (r == true)
	  	{
	  		$.ajax({
		    type: "POST",
		    url: "API.php",
		    //dataType: 'json',
		    data: {todo: 'DELETE',name: name, api_url:"http://localhost:5000/api/1/reviews/"+id},
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
    	<a href="index.php" class="cerrarSesion"  id = "button" style="float:left;margin:45px 0px 0px 60px;"> Regresar </a>
    	<h1 class="titulo"> 	
        	<img src="img/resHead.png" height="100" width="100" alt="Logo" style="float:left;margin:0 5 0 0;">        
        	Rese&#241;as
    	</h1>
    </div>
    <div>
    <table class="reviewsTable">
	<?php
		foreach ($revs as $rev) {
			$name = str_replace(' ', '', $rev["name"]);//ereg_replace(" ", "", $_POST["name"]);
            $name = trim($name);
			print("<tr class=tableRow>");
			print("<td width=160 height=120><img src=upload/".$name.".jpg alt=Foto height=120 width=160/></td>");
			print("<td class=reviewsBodyColumn><span class=boldText>" . $rev["name"].",</span>". $rev["description"] . "</td>");
			print("<td class=tableButton><a href=# onclick=editItem(this.id); id=".$rev["id"]."><img src=img/edt.png alt=Rutas width=23 height=23></a></td>");
			print("<td class=tableButton><a href=# onclick=deleteItem(this.id,"."'".$name."'"."); id=".$rev["id"]."><img src=img/del.png alt=Rutas width=29 height=30></a></td>");
			print("</tr>");
		}
	?>
</table>
</div>
<div>
	<div class="addButton">
		<a href="res_inspector.php"><img src=img/add.png alt=Rutas width=70 height=70></a>
		Agregar Rese&#241;a...
	</div>
</div>

</section>
