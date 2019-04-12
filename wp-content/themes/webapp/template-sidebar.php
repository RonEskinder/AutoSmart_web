<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
/**
 * Template Name: Page with sidebar
 *
 * This page has no sidebar.
 *
 */

 get_header();

?>
<!-- MAIN CONTENT BLOCK -->

<div id="main" class="main-container page">
	<?php do_action( 'tt_before_container' ); ?>

	<div class="container">
		<div class="row">
			<div class="col-md-9  blog-inline">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			        <?php echo tt_temptt_post_title('h1'); ?>
					<?php the_content(); ?>

				<?php endwhile; endif; ?>
				<?php
				if ( comments_open() ) {  ?>
				 <div class="mbottom70"></div>
				 <div class="comment-part">
				 <?php comments_template( '', true );  ?>
				 </div>
				<?php
				}
	            ?>
			</div>
			<div class="col-sm-3 col-xs-12">
				<?php get_sidebar(); ?>
			</div>
		</div>


	</div> <!-- ./container -->
</div>

<?php get_footer(); ?>