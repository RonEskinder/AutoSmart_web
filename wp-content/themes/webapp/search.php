<?php get_header(); ?>

<!-- MAIN CONTENT BLOCK -->
<div id="main" class="main-container search-page">
	<div class="container-fluid">
		<?php do_action( 'tt_after_container_start' ); ?>
		<div class="row ">

			<div class="col-md-12 not-found">

			<h1 class="section-title page-title search-item"><?php esc_html_e( 'Search Results For: ', 'webapp' ); echo the_search_query(); ?></h1>
			</div>
			</div>
			</div>
			<div class="container">
			<div class="row">
			<div class="blog-block">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; else : ?>

			<div class="align-center item-not-found"><h1 class="section-title"> <?php esc_html_e( 'We could not find anything for the search term: ', 'webapp' ); echo the_search_query(); ?></h1></div>

			<?php endif; ?>
			</div>

		

		</div>

	</div>
</div>

<?php get_footer(); ?>