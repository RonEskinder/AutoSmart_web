<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The default template for displaying page content
 */

	global $tt_temptt_opt;
	if(function_exists('tt_webapp_post_thumb')) $postimgg = tt_webapp_post_thumb('', '', false, false, true);
?>

<div <?php post_class( 'blog-detail ml-block clearfix content' ); ?>>

	<?php if( !empty($postimgg)) { ?>
			<div class="for-img">
				<a class="img" href="#" style="background-image: url('<?php echo wp_kses_post($postimgg); ?>'); background-size: cover;">
					<div class="c-bg"></div>
					<img class="center-image" alt="" src="<?php echo wp_kses_post($postimgg); ?>" style="display: none;">
				</a>
				<span class="date-block"> <?php the_time( 'M j, Y' ) ?> </span>
			</div>
	<?php } ?>

		<div class="content">
			<h1 class="mtitle"><?php the_title(); ?></h1>
			<div class="description">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		<?php if ( comments_open() ) { comments_template(); } ?>

	</div>
</div>
