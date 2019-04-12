  
<?php if(function_exists('tt_webapp_post_thumb')) $postimgg = tt_webapp_post_thumb(870, 400); ?>

   <article <?php post_class( 'article clearfix blog-post' ); ?>>
          <?php if( !empty($postimgg)) echo '<div class="popup-link">'. wp_kses_post($postimgg) .'</div>'; ?>
        <div class="clearfix"></div>
        <div class="post-info">
            <span><i class="fa fa-map-marker"></i><?php  if(function_exists('tt_webapp_get_cats')) echo tt_webapp_get_cats( 'single' );  ?></span>
            <span><i class="fa fa-calendar"></i><?php the_time( 'd.j.Y' ); ?></span>
            <span><i class="fa fa-pencil"></i><?php the_author(); ?></span>
            <span ><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', '% responses' ); ?></span>
        </div>
        <div class="post-content clearfix">
            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="post-text">
               <?php tt_webapp_excerpt_charlength( 500 ); ?>
            </p>
            <a class="button btn-learn wp-btn-read" href="<?php the_permalink(); ?>"><i class="fa fa-paper-plane"></i><?php esc_html_e( 'read more', 'webapp' ); ?></a>
        </div>
    </article>

    




