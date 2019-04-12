<?php
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="related-post-container">
	<h2 class="post-title related-title">
		<span> <?php esc_html_e( 'Related ', 'webapp' ); ?></span> <?php esc_html_e( 'Posts', 'webapp' ); ?>
	</h2>

	<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0"
	     data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="3" data-md-slides="3"
	     data-lg-slides="3" data-add-slides="3">
		<div class="swiper-wrapper ">

			<?php

			$args = array(
				'posts_per_page' => 5

			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post(); ?>
					<div class="swiper-slide ">
						<div class="popular-post related-post <?php if ( has_post_thumbnail()) echo 'has-img'; ?>" >

							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
								<a class="post-link" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							<?php } else { ?>
								<a class="post-link" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							<?php } ?>

							<div class="info-post">
								<span class="post-data"><i class="fa fa-calendar"></i><?php the_time( 'd.j.Y' ); ?></span>
								<span class="post-comment"><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', ' ' ); ?></span>
							</div>
							<p class="text">
								<?php tt_webapp_excerpt_charlength( 100 ); ?>
							</p>
						</div>
					</div>
				<?php } ?>
			<?php } ?>

			<?php
			wp_reset_postdata();
			?>

		</div>
		<div class="pagination pagination-hide"></div>
	</div>
</div>
