<?php 
    include("controller/proyectos.php");
    $datos = proyectos::get_last_proyect();
?>
<section class="background_page">&nbsp;</section>
<section class="banner">   
    <div class="container">
        <div class="row visible-lg visible-md">
            <div class="col-md-12 col-lg-12 col-padding">
                <div id="banner">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</section>
 <section class="landing">   
    <div class="container">
        <div class="row visible-lg visible-md">
            <div class="col-md-8 col-lg-8 col-padding">
                <div class="landing-box" id="destacado">
                    <div class="cabecera">
                        <?php echo $datos['proyecto']['titulo']; ?>
                    </div>  
                    <div class="cuerpo">
                        <div class="imagen"><img src="<?php echo $datos['proyecto']['source']; ?>" /></div>
                        <div class="descripcion">
                            <div class="titulo"><h5><?php echo $datos['proyecto']['breve_descripcion']; ?></h5></div>
                            <div class="cantidad_invertida col-padding subcuerpo">
                                <center> 
                                    <h4>Cantidad Invertida</h4>
                                    <h5><center>$<?php echo number_format($datos['inversion'][0],0,",","."); ?></center></h5>
                                </center>
                            </div>
                            <div class="inversionistas col-padding subcuerpo">
                            <center>
                                <h4>Inversionistas</h4>
                                <h5><center><?php echo number_format($datos['inversion'][1],0,",","."); ?></center></h5>
                            </center>
                            </div>
                            <div class="tasa col-padding subcuerpo">
                            <center> 
                                <h4>Tasa de Interés</h4>
                                <h5><center><?php echo number_format($datos['proyecto']['tasa_interes_anual'],0,",","."); ?>%</center></h5>
                            </center>
                            </div>
                            <div class="tir col-padding subcuerpo">
                            <center> 
                                <h4>TIR</h4>
                                <h5><center><?php echo number_format($datos['proyecto']['tir'],0,",","."); ?>%</center></h5>
                            </center>
                            </div>
                            <div class="boton">
                                <center><button type="button" class="btn btn-primary btn-lg btn-action-landing" data="inversion.php?id=<?php echo $datos['proyecto']['id_proyecto']; ?>">Más información del proyecto</button></center>
                            </div>
                        </div>
                        <div class="proyectos-btn">
                            <div class="funding-btn">
                                <center><button type="button" class="btn btn-primary btn-lg btn-action-landing" data="proyectos.php">Conoce los proyectos de inversión disponibles<br><h9>Invierte en Energías Renovables</h9></button></center>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-padding loginbox" <?php if($users->isConected()){ echo 'style="display:none;"'; } ?>>
                <div class="row col-padding">
                <div class="panel panel-default login">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresa a Eollice</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="text" id="email-landing">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" id="password-landing">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me" id="remember-landing"> Mantener Conectado
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" id="login-btn-landing" type="button" value="Ingresar" data-loading-text="Cargando...">
                            <h6 id="forgot-landing" style="cursor:pointer;">¿Olvidaste tu Contraseña?</h6>
                        </fieldset>
                            <center><h5>O</h5></center>
                            <button class="btn btn-lg btn-primary btn-block" id="reg-btn-landing" type="button">Regístrate en Eollice<br><h9>Se parte de la comunidad Eollice</h9></button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-padding postuserbox" <?php if(!$users->isConected()){ echo 'style="display:none;"'; } ?>>
                <div class="landing-box" id="postuser-data">
                    <div class="row">
                        <img src="images/platform/Invierten.png"/>
                    </div>
                    <div class="row col-padding text-imagen-box">
                        <h4><center>Se parte de la solución, ayuda al desarrollo de un Chile más limpio</center></h4>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="navdown">
    <div class="container">
        <div class="row visible-lg navdownlg">
        </div>
    </div>
</section>
<section class="sponsor">
    <div class="container">
        <div class="row visible-lg visible-md cabecera">
            <div class="col-md-7 titulo col-md-offset-1"><h1>NOS APOYAN</h1></div>
            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            <div class="col-md-3 col-md-offset-1 col-padding-20 sponsors"><center><img src="images/platform/incubaUC.png"/></center></div>
            <div class="col-md-2 col-padding-20 sponsors"><center><img src="images/platform/uc.png"/></center></div>
            <div class="col-md-2 col-padding-20 sponsors"><center><img src="images/platform/Chile_Verde.png"/></center></div>
            <div class="col-md-3 col-padding-20 sponsors2"><center><img src="images/platform/emprende_verde.png"/></center></div>
        </div>
    </div>
</section>
<section class="howitwork">
    <div id="howitwork">
        <div class="container visible-lg visible-md">
            <div class="row cabecera">
                <div class="col-md-7 titulo col-md-offset-1"><h1>CÓMO FUNCIONA</h1></div>
                <div class="col-md-3 logo"><img src="images/platform/logo-azul.png"></div>
                <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            </div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="15000">
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 cuerpo"><center><h4>Personas pueden invertir en proyectos de energía renovables en necesidad de financiamiento para medianas y pequeñas empresas.</h4></center></div>
                            <div class="col-md-10 col-md-offset-1 cuerpo"><center><img src="images/platform/howitworks.png"/></center></div>
                            <div class="col-md-10 col-md-offset-1 cuerpo"><center><h4>A medida que los proyectos inyectan energía, se paga mensualmente una cuota del financiamiento entregado a los inversionistas.</h4></center></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-md-offset-1 secundario"><h1>1:</h1></div>
                            <div class="col-md-1 secundario"><img src="images/platform/personas.png" /></div>
                            <div class="col-md-1 secundario"><i class="glyphicon glyphicon-arrow-right"></i></div>
                            <div class="col-md-2 secundario"><img src="images/platform/pantalla.png" /></div>
                            <div class="col-md-5 secundario" style="padding-top:10px;"><h5>Las personas exploran proyectos de generación con energías renovables en necesidad de financiamiento e invierten en el que prefieran. Todo a través de la plataforma web.</h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-md-offset-1 primario"><h1>2:</h1></div>
                            <div class="col-md-1 primario"><img src="images/platform/techo.jpg" /></div>
                            <div class="col-md-1 primario"><i class="glyphicon glyphicon-arrow-right"></i></div>
                            <div class="col-md-2 primario"><img src="images/platform/granjero.jpg" /></div>
                            <div class="col-md-5 primario" style="padding-top:10px;"><h5>A medida que el proyecto ERNC genera energía limpia, esta genera dinero por los ahorros percibidos.</h5></div>

                        </div>
                        <div class="row">
                            <div class="col-md-1 col-md-offset-1 secundario"><h1>3:</h1></div>
                            <div class="col-md-1 secundario"><img src="images/platform/granjero.jpg" /></div>
                            <div class="col-md-1 secundario"><i class="glyphicon glyphicon-arrow-right"></i></div>
                            <div class="col-md-2 secundario"><img src="images/platform/personas.png" /></div>
                            <div class="col-md-5 secundario" style="padding-top:10px;"><h5>Cuando el proyecto genera ahorros, el cliente paga cuotas mensuales a los inversionistas con una tasa de interés atractiva.</h5></div>

                        </div>

                    </div>
                    <div class="item second">
                        <div class="row titulo">
                            <div class="col-md-10 col-md-offset-1 primario" style="padding-left:30px;"><h3><b style="">LA PLATAFORMA EOLLICE</b></h3></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1 col-padding-20 terciario"><center><img src="images/platform/pantalla.png" /></center></div>
                            <div class="col-md-3 col-padding-20 terciario">
                                <h2>Cuenta Online</h2>
                                <h5>Personas pueden explorar e invertir facilmente a traves de la plataforma en www.eollice.com</h5>
                            </div>
                            <div class="col-md-2 col-padding-20 terciario"><center><img src="images/platform/cuenta.png" /></center></div>
                            <div class="col-md-3 col-padding-20 terciario">
                                <h2>Pagos Mensuales</h2>
                                <h5>Cada mes los inversionistas reciben un pago igual de la cuota del credito mas intereses.</h5>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2 col-padding-20 terciario col-md-offset-1"><center></center></div>
                            <div class="col-md-2 col-padding-20 terciario "><center><img src="images/platform/billete.png" /></center></div>
                            <div class="col-md-3 col-padding-20 terciario">
                                <h2>Respaldos Legales</h2>
                                <h5>Cada crédito a empresa va asociado a una serie de instrumentos legales como es el caso de pagarés y prendas tanto por los equipos a instalar como de otros bienes, con tal de acotar al mínimo el riesgo de la inversión. </h5>
                            </div>
                            <div class="col-md-3 col-padding-20 terciario "><center></center></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1 col-padding botonproyecto"></div>
                            <div class="col-md-6 col-padding botonproyecto"><center><button class="btn-primary btn-lg btn-action-landing" data="proyectos.php">Conoce los proyectos de Inversión</button></center></div>
                            <div class="col-md-2 botonproyecto"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 indicadores">
                        <!-- Indicators -->
                      <ol class="col-md-10 col-md-offset-1 carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      </ol>
                    </div>
                </div>  
            </div>

            
        </div>
    </div>
</section>
<section class="howarewe">
    <div class="container">
        <div class="row visible-lg visible-md cabecera">
            <div class="col-md-7 titulo col-md-offset-1"><h1>QUIENES SOMOS</h1></div>
            <div class="col-md-3 logo"><img src="images/platform/logo-azul.png"></div>
            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            <div class="col-md-10 col-md-offset-1 bajada"><h5>Eollice es la primera plataforma de Latinoamérica que conecta personas para invertir en proyectos de energías renovables, como paneles solares o generadores eólicos, que entregarán energía a pequeñas y medianas empresas. Así, se le da una oportunidad a la gente en influir qué tipo de energía se consume, generando un impacto positivo en la sociedad y medio ambiente, al mismo tiempo de aumentarle su dinero en el tiempo.</h5></div>
            
            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            <div class="col-md-10 col-md-offset-1 team">
                <div class="col-md-4 col-padding">
                    <center class="foto"><img src="images/platform/FJSM_CEO.png" class="img-thumbnail"/></center>
                    <center style="color:rgba(56, 163, 236, 1);"><h4>Francisco Sepulveda</h4></center>
                    <center style="color:#777;"><h4>Co-Founder</h4></center>
                    <center><h5><br>Soy Francisco, Ingeniero Civil Eléctrico de la Universidad de Chile. He fundado anteriormente Andes Ventus, empresa de desarrollo de proyectos de energías renovables junto a Stefan. Además trabajé en un centro de investigación llamado “Centro de Energía” de la Universidad de Chile, en la unidad de micro-redes eléctricas donde desarrollé estudios en temas de electrificación rural con energía solar fotovoltaica y eólica. </h5></center>
                    <center class="twitter"><h5>Twitter: @franciscoshaggy</h5></center>
                </div>
                <div class="col-md-4 col-padding">
                    <center class="foto"><img src="images/platform/SCPM_CMO.png.jpg" class="img-thumbnail"/></center>
                    <center style="color:rgba(56, 163, 236, 1);"><h4>Stefan Pribnow</h4></center>
                    <center style="color:#777;"><h4>Co-Founder</h4></center>
                    <center><h5><br>Soy Stefan, ingeniero civil industrial de la Universidad de Chile. He fundado anteriormente Andes Ventus junto a Francisco y LaCuota.com, plataforma web que permitía el pago de cuotas entre grupos de personas para un evento en específico. Además, hago consultoría de innovación y emprendimiento en Ematris, ayudando a emprendedores, investigadores y empresas tecnológicas.</h5></center>
                    <center class="twitter"><h5>Twitter: @spribnow</h5></center>
                </div>
                <div class="col-md-4 col-padding">
                    <center class="foto"><img src="images/platform/AC_CTO.png" class="img-thumbnail"/></center>
                    <center style="color:rgba(56, 163, 236, 1);"><h4>Angelo Calvo</h4></center>
                    <center style="color:#777;"><h4>Director de Tecnologia</h4></center>
                    <center><h5><br>Soy Angelo, ingeniero civil informatico de la Universidad Diego Portales. Tengo 10 años de experiencia en variadas áreas TI, enfocándome mayormente en diseño y desarrollo de software de business intelligence, plataformas web y sistemas de telecomunicación. 
<br>Además de cofundar LaCuota.com con Stefan he trabajado en diversos proyectos y empresas como Cuponperfumes.cl y Solvemaps. </h5></center>
                    <center class="twitter"><h5>Twitter: @angelocalvoalfa</h5></center>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contacto">
    <div class="container">
        <div class="row visible-lg visible-md cabecera">
            <div class="col-md-7 titulo col-md-offset-1"><h1>CONTÁCTANOS</h1></div>
            <div class="col-md-3 logo"><img src="images/platform/logo-azul.png"></div>
            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            <div class="col-md-10 col-md-offset-1 bajada"><h5>Tu Feedback es importante para nosotros, envíanos una lineas sobre que te parece Eollice.</h5></div>
            <div class="col-md-10 col-md-offset-1"><div class="cabecera-bot"></div></div>
            <div class="col-md-8 col-md-offset-1 inputform">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon">De</span>
                  <input type="text" class="form-control contact-input" placeholder="Nombre" id="contact-name-landing">
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1 inputform">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control contact-input" placeholder="Email" id="contact-email-landing">
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1 inputform">
                  <textarea class="form-control contact-input" rows="8" style="width:100%; font-size:1.2em;" placeholder="Mensaje" id="contact-mensaje-landing"></textarea>
            </div>
            <div class="col-md-8 col-md-offset-1 inputform">
                <button type="button" class="btn btn-primary btn-lg" id="send-contact-message">Enviar Comentario</button>
            </div>
            <div class="col-md-8 col-md-offset-1 inputform">
            <br>
                <address>
                  <strong>Eollice - Clean Energy Crowdfunding</strong><br>
                  <a href="mailto:#">contacto@eollice.com</a><br>
                  <abbr title="Phone">P:</abbr> (+56) 9 8340-6044<br>
                  Providencia 1308, of. 3D, Santiago
                </address>
            </div>
        </div>
    </div>
</section>
