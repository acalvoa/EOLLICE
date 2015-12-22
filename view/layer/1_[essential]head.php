 <?php 
    include("controller/users.php");
    $users= new users();
    $datos = @$users->getinfo();
 ?>
 <section class="header">   
    <div class="background">&nbsp;</div>
    <div class="navbar">
        <!-- CLASE PARA MOVILES -->
        <!-- CLASE PARA PANTALLA -->
        <div class="container visible-lg visible-md">
            <!-- CABECERA MARCA -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><img src="images/platform/logo-blanco.png" /></a>
            </div>
            <div class="row" style="height:50px;">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://blog.eollice.com"><i class="fa fa-pencil-square-o"></i> Blog</a></li>
                    <li><a href="riesgos.php"><i class="fa fa-suitcase"></i></i> Riesgos</a></li>
                    <li><a href="faq.php"><i class="fa fa-question"></i> Preguntas Frecuentes</a></li>
                    <li><a ><i class="fa fa-search"></i>  Buscar</a></li>
                    <li class="registro_divs" id="login-btn-header" <?php if($users->isConected()){ echo 'style="display:none;"'; } ?>><a href="#"><i class="fa fa-user"></i> Ingresa</a></li>
                    <li class="registro_divs" id="reg-btn-header" <?php if($users->isConected()){ echo 'style="display:none;"'; } ?>><a href="#"><i class="fa fa-cogs"></i> Regístrate</a></li>
                    <li class="user_divs dropdown" <?php if(!$users->isConected()){ echo 'style="display:none;"'; } ?>>
                      <a data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <span class="user_divs_data"><?php echo $datos['nombre']; ?></span><span class="caret" style="border-top-color: rgb(255, 255, 255); border-bottom-color: rgb(255, 255, 255);"></span></a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                        <!-- <li style="cursor:pointer;" role="presentation"><a role="menuitem" tabindex="-1" href=""><h4><i class="fa fa-cogs"></i>&nbsp;&nbsp;&nbsp;Mis datos</h4></a></li>
                        <li style="cursor:pointer;"role="presentation"><a role="menuitem" tabindex="-1" href=""><h4><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Mis Inversiones</h4></a></li>
                         --><li role="presentation" class="divider"></li>
                        <li style="cursor:pointer;"role="presentation" id="logout-btn-header"><a role="menuitem" tabindex="-1" ><h4><i class="fa fa-bolt"></i>&nbsp;&nbsp;&nbsp;Cerrar Sesion</h4></a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <div class="row">
                <ul class="nav navbar-nav navbar-left titulos-cabecera">
                    <li><a href="#howitwork" id="howitwork-btn"><i class="fa fa-cog"></i> Cómo Funciona</a></li>
                    <li><a href="proyectos.php"><img src="images/platform/icon-proyecto.png" class="icon-proyecto"/> Proyectos</a></li>
                    <li><a href="#howarewe" id="howarewe-btn"><i class="fa fa-users"></i> Quienes Somos</a></li>
                    <li><a href="#contact" id="contacto-btn"><i class="fa fa-envelope-o"></i> Contacto</a></li>
                </ul>
            </div>
        </div>
        <!-- CLASE PARA TABLET -->
    </div>
</section>