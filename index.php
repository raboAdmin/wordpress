<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/08/14
 * Time: 11:29 AM
 */

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<!-- #content begins -->

	<div id="content" class="site-content" role="main">

		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

		endwhile;
		?>

	</div>

	<!-- #content ends -->

<?php
get_footer();

