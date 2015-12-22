<?php
	include("controller/proyectos.php");
?>
<section class="background_page">&nbsp;</section>
<section class="listaproyectos">
	<div class="container">
        <div class="row visible-lg visible-md">
            <div class="col-md-12 col-lg-12 col-padding">
            	<div class="row">
	            	<div class="col-md-7 titulo col-md-offset-1 seguidor"><a href="index.php">Inicio ></a></div>
	            	<div class="col-md-7 titulo col-md-offset-1"><h2>Proyectos de Inversion</h2></div>
		            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
	            </div>
	            <?php proyectos::print_proyectos(); ?>
            </div>

        </div>
    </div>
</section>