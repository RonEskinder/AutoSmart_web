<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
/**
 * Template Name: Blog
 *
 * This page is just a blog, its here for giving options to style blog page as well, like adding hero image.
 *
 */

 global $tt_temptt_opt;
 get_header();
 $tt_num_posts = apply_filters('tt_blog_posts_num', '8'); // default number of posts to be shown on this page, modify this number if you want to.
?>

<!-- MAIN CONTENT BLOCK -->

<div id="main" class="main-container">

	<?php do_action( 'tt_before_container' ); ?>
	<div class="mbottom90"></div>
	<div class="container blog-wrapper">
		<?php do_action( 'tt_after_container_start' ); ?>
		<div class="row">

			<div class="col-md-9  blog-inline">

			<?php
			// Fix for pagination
			if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }
			// General args
			$args = array(
				'paged' => $paged,
				'post_type' => 'post',
				'posts_per_page' => $tt_num_posts,
			);
			// query
			$tt_query = new WP_Query( $args );
			// loop
			if ( $tt_query->have_posts() ) : while ( $tt_query->have_posts() ) : $tt_query->the_post();

					// Display posts using default template.
					get_template_part( 'content', get_post_format() );

				endwhile; ?>
						<?php tt_webapp_post_pagination(array( 'pages' => $tt_num_posts));
				else : ?>

					<!-- no posts -->

			<?php endif; ?>
			</div>

			<div class="col-sm-3 col-xs-12">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>