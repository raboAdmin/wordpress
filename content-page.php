<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
</div>
