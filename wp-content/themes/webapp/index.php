<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The main template file.
 *
 * Works as index and fallback.
 *
 */

 global $tt_temptt_opt;
 get_header();
?>

<!-- MAIN CONTENT BLOCK -->
<div id="main" class="main-container section">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', get_post_format() ); ?>

                <?php endwhile;

                else : ?>

                    <!-- no posts -->
                <?php endif; ?>
                <div class="pager-container pager-article clearfix">
                <?php

                    the_posts_pagination( array(
                    'prev_text'          => esc_html__( 'prev page', 'webapp' ),
                    'next_text'          => esc_html__( 'next page', 'webapp' )
                    ) );
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


