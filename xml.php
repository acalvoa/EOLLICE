<?php
	$xml = simplexml_load_file("http://animacionugm.blogspot.com/feeds/posts/default");
	$json = json_encode($xml);
	echo "<pre>";
	echo $json;
	echo "</pre>";
?>