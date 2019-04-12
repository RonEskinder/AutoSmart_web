<?php get_header(); ?>

<!-- MAIN CONTENT BLOCK -->
<div id="main" class="main-container section">
	<div class="container-fluid error-page">

		<div class="row">

			<div class="col-md-12">
				<h1 class="page-title align-center"> <span><?php esc_html_e( '404', 'webapp' ); ?></span><?php esc_html_e( ' - Page Not Found', 'webapp' ); ?></h1>

				<div class="mesage-box color-3">
					<div class="description">
						<?php echo sprintf( esc_html__( 'We could not find the page you are looking for. Please, %1$s', 'webapp' ), '<a href="' . esc_url( home_url('/') ) . '">'.esc_html__( 'Go back to Home', 'webapp' ).'</a>' ) ?>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<?php get_footer(); ?>