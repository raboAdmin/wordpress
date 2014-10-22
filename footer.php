<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/08/14
 * Time: 11:29 AM
 */
?>

<footer class="colophon">
	<div class="row">
		<div class="small-12 large-9 large-centered columns">
			<nav>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>

			<p>&copy; <?php echo date('Y'); ?>. RaboDirect is a division of Rabobank New Zealand Limited</p>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>

<script>jQuery(document).foundation();</script>

</body>
</html>