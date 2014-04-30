<?php
    require("../includes/config.php"); 

	$json = CallAPI("GET", "http://localhost:5000/api/1/reviews", NULL);

	$result = json_decode($json, true);
	$revs = $result['reviews'];

	// foreach ($revs as $rev) {
	// 	var_dump($rev);
	// 	print('<br>');
	// }
	//print_r($result['Result']);

    render("res.php", ["title" => "Reseñas","revs" => $revs]);
?>