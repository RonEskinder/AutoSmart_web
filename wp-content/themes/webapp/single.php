<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * The main template file.
 *
 * Works as index and fallback.
 *
 */

global $tt_temptt_opt;
get_header();
?>

<div id="main" class="main-container section">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<article class="single-article clearfix ">
					<div class="article-info clearfix">
						<div class="post-info post-info-single">
							<span><i class="fa fa-map-marker"></i>
								<?php if ( function_exists( 'tt_webapp_get_cats' ) ) {	echo tt_webapp_get_cats( 'single' );								} ?></span>
							<span><i class="fa fa-calendar"></i><?php the_time( 'd.j.Y' ); ?></span>
							<span><a href="#comments"><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', '% responses' ); ?></a></span>
						</div>
					<!-- Post sharing meta -->
                    <?php get_template_part( 'inc/templates/tt-post-sharing' ); ?>

					</div>

					<?php if (have_posts()) : while (have_posts()) :
					the_post(); ?>
			          <?php if ( has_post_thumbnail()) { ?>
			                    <?php the_post_thumbnail(); ?>
			           <?php } ?>
			        <div class="clearfix mbottom30"></div>
					<h2 class="single-post-title">
						<?php the_title(); ?>
					</h2>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>

					<div class="tags-container article-tags-container mbottom10">
						<?php the_tags( $before = null, $sep = ' ', $after = '' ); ?>
					</div>
				</article>

			<span class="category"><?php esc_html_e( 'Posted in: ', 'webapp' ); ?>
				<?php if( function_exists('tt_webapp_get_cats') ) echo tt_webapp_get_cats( ); ?>
			</span>
			<div class="clearfix mbottom30"></div>
			<?php if( function_exists('tt_webapp_prev_post') ) echo tt_webapp_prev_post(); ?>
			<?php if( function_exists('tt_webapp_next_post') ) echo tt_webapp_next_post(); ?>
			<div class="clearfix"></div>
				<?php endwhile;
				endif; ?>
				<?php if( tt_temptt_get_option('enable_relatedposts', '1') ) get_template_part( 'inc/templates/tt-related-posts' ); ?>
				<div class="commentary-container">

					<?php
					// Comments
					if ( comments_open() ) {
						comments_template( '', true );
					}
					?>
				</div>
			</div>

			<div class="col-sm-3 col-xs-12">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>