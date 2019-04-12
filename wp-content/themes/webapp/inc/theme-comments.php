<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Fist full of comments
if ( ! function_exists( 'tt_temptt_cust_cmnt' ) ) {
	function tt_temptt_cust_cmnt( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?>>

	    	<a id="comment-<?php comment_ID() ?>-start"></a>

	      	<div id="li-comment-<?php comment_ID() ?>" class="comment_container">

				<?php if( get_comment_type() == 'comment' ) { ?>
		             <div class="avatar"><?php echo get_avatar( $comment, apply_filters( 'tt_comment_avatar_size', $size = 125 ) ); ?></div>
	            <?php } ?>

					<div class="comment-text">

			            <span class="name"><?php tt_webapp_commenter_link(); ?></span>

				        <div class="comment-entry" id="comment-<?php comment_ID(); ?>">
							<?php comment_text(); ?>
							<?php if ( $comment->comment_approved == '0' ) { ?>
				                <p class='unapproved'><?php esc_html_e( 'Your comment is awaiting moderation.', 'webapp' ); ?></p>
				            <?php } ?>
						</div><!-- /comment-entry -->

		                <div class="comment-head">
			                <span class="date"><?php echo get_comment_date( get_option( 'date_format' ) ).' - '. get_comment_time( get_option( 'time_format' ) ); ?></span>
			                <span class="perma"><a href="<?php echo get_comment_link(); ?>-start" title="<?php esc_attr_e( 'Direct link to this comment', 'webapp' ); ?>">#</a></span>
			                <span class="edit"><?php edit_comment_link(esc_html__( 'Edit', 'webapp' ), '', '' ); ?></span>
		                </div><!-- /.comment-head -->

			            <?php $tt_reply_text = ''; $tt_reply_text = esc_html__( 'Reply', 'webapp' ); ?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => $tt_reply_text,  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- /.reply -->
	                </div> <!-- /.comment-text -->


			</div><!-- /.comment-container -->

	<?php
	} // End tt_webapp_cust_cmnt()
}

// PINGBACK / TRACKBACK OUTPUT
if ( ! function_exists( 'tt_temptt_list_pings' ) ) {
	function tt_temptt_list_pings( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>">
			<span class="author"><?php comment_author_link(); ?></span> -
			<span class="date"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></span>
			<span class="pingcontent"><?php comment_text(); ?></span>

	<?php
	} // End tt_temptt_list_pings()
}

if ( ! function_exists( 'tt_webapp_commenter_link' ) ) {
	function tt_webapp_commenter_link() {
	    $commenter = get_comment_author_link();
	    echo wp_kses_post($commenter);
	} // End tt_webapp_commenter_link()
}



?>