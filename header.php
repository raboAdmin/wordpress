<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/08/14
 * Time: 11:29 AM
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
	    <meta charset="<?php bloginfo( 'charset' ); ?>">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title><?php wp_title( '|', true, 'right' ); ?></title>

	    <link rel="profile" href="http://gmpg.org/xfn/11">
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	    <?php wp_head(); ?>

	    <!-- Legacy IE polyfills -->
	    <!--[if lt IE 9]>
	    	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/polyfill/ie.min.js"></script>
		<![endif]-->
        <script>
            /**
             * Function that tracks a click on an outbound link in Google Analytics.
             * This function takes a valid URL string as an argument, and uses that URL string
             * as the event label.
             */
            var trackOutboundLink = function(url) {
                ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
                    function () {
                        document.location = url;
                    }
                });
            }
        </script>
    </head>

<body <?php body_class(); ?>>

	<!-- Mobile navigation begins -->
	<nav id="cbp-spmenu-s1" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
		<?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_class' => 'nav-menu' ) ); ?>

		<p>Call <a href="tel:0800224433">0800 22 44 33</a><br/>
			8am - 7pm Monday to Friday</p>

	</nav>
	<!-- Mobile navigation ends -->

	<!-- .main-header begins -->
	<header class="main-header">
		<div class="row">
			<div class="medium-6 columns">
				<h1 class="title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</div>
			<div id="header-right" class="medium-6 columns">
				<div class="hide-for-small">
					<p class="tel">
						<a href="tel:0800224433">0800 22 44 33</a>
					</p>
					<p class="hours">8am - 7pm Monday to Friday</p>

					<nav id="primary-navigation" class="primary-navigation" role="navigation">
						<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'rabodirect' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_class' => 'nav-menu' ) ); ?>
					</nav>
				</div>

				<a href="#" id="showLeft" class="icons-menu"></a>
			</div>
		</div>
	</header>
	<!-- .main-header ends -->