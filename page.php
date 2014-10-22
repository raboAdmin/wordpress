<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/08/14
 * Time: 11:29 AM
 */

get_header(); ?>

	<!-- #content begins -->

	<div id="content" class="site-content" role="main">
<!--        <div class="row">-->
<!--            <div class="medium-12 columns">-->

                <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    get_template_part( 'content', 'page' );
                endwhile;
                ?>
<!--            </div>-->
<!--        </div>-->
	</div>

	<!-- #content ends -->

<?php
get_footer();
