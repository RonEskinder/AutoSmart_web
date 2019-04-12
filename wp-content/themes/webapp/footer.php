<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package ttFramework
 * @subpackage Template
 */
	$total = tt_temptt_get_option('footer_sidebars', '3');
?>
	<footer id="footer-wrap" class="footer col-full">

<?php
	if ( ( is_active_sidebar( 'footer-1' ) ||
		   is_active_sidebar( 'footer-2' ) ||
		   is_active_sidebar( 'footer-3' ) ||
		   is_active_sidebar( 'footer-4' ) ) && $total > 0 ) {
		   $BTcols = 4;
		   if ( $total == 4) $BTcols = 3; if ( $total == 3) $BTcols = 4; if ( $total == 2) $BTcols = 6; if ( $total == 1) $BTcols = 12;

?>
			<section id="footer-widget-area">
        		<div class="container">
            		<div class="row row-ftr">

					<?php $i = 0; while ( $i < $total ) { $i++; ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) { ?>

						<div class="clearfix col-md-<?php print esc_attr($BTcols); ?> col-sm-6 footer-widget-<?php print esc_attr($i); ?>">
				            <?php dynamic_sidebar( 'footer-' . $i ); ?>
						</div>

				        <?php } ?>
					<?php } // End WHILE Loop ?>

					</div>
			    </div>
        		<div class="footer-line clearfix">
	                <div class="container">
				        <div class="copy clearfix fl">
				            <div class="copy-right"><span> <?php echo do_shortcode(esc_html(tt_temptt_get_option('footer_left_text')) ); ?> </span></div>

				        </div>
				        <div class="copy clearfix fr">
				            <div class="copy-right"><span> <?php echo do_shortcode(esc_html(tt_temptt_get_option('footer_right_text')) ); ?> </span></div>

				        </div>
				    </div>
			    </div>
			</section>
	<?php } // End IF Statement ?>
	</footer><!--/.footer-wrap-->

<a href="#" class="scrollup"></a>
<?php wp_footer(); ?>

</body>
</html>
