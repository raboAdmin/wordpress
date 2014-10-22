<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 22/09/14
 * Time: 10:36 AM
 */

/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
		?>

		<div class="entry-meta">
			<?php
			if ( 'post' == get_post_type() )
				rabodirect_posted_on();

			edit_post_link( __( 'Edit', 'rabodirect' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rabodirect' ) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
