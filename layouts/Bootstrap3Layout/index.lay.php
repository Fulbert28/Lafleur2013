<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Marchand 2013</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php Application::printLayoutName() ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
       
         <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
       padding-top: 30px;
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      #wrap > .container {
        padding-top: 60px;
      }
      .container .credit {
        margin: 20px 0;
      }

      code {
        font-size: 80%;
      }

    </style>
    </head>
    <body>
        
        
        <!--Content-->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="well well-sm">
                        <ul class="nav nav-pills nav-stacked">
                            <?php Application::getController('Categorie', 'Menu') ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">               
                    <?php Application::getController('Main'); ?>
                </div>
            </div>
        </div>
        <!--End Content-->
        
        <!--NavBar a placer en dessous pour que la zone panier soit raffraichie correctement.-->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Marchand 2013</a>
                </div>
                
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                    <?php Application::getController('User'); ?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panier <span class="badge"><?php Application::getController('Panier','Icone'); ?></span> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <?php Application::getController('Panier','Resume'); ?>

                      </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End NavBar-->
        
        <div id="footer">
	      <div class="container">
	        <p class="muted credit">Enseignement assuré par <a href="mailto:ludovic.meru@ac-orleans-tours.fr">MERY Ludovic</a>
	        	dans le cadre du BTS SIO du <a href="http://www.lyceefulbert.fr">lycée Fulbert de Chartres</a>.</p>
	      </div>
	    </div>
        
        
        <!--Scripts-->
        <script src="<?php Application::printLayoutName() ?>/bootstrap/js/jquery.js"></script>
        <script src="<?php Application::printLayoutName() ?>/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement("style");
            msViewportStyle.appendChild(
            document.createTextNode(
             "@-ms-viewport{width:auto!important}"));
            document.getElementsByTagName("head")[0].
            appendChild(msViewportStyle);
        }
        </script>
        <!--End Scripts-->
    </body>
</html>
