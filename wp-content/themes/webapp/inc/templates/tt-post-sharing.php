<?php
if ( ! defined( 'ABSPATH' ) ) exit;

 /*
  *  template file
  * @templatation.com
  */
?>


<?php
global $post;

$url[] = '';
$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
?>
    <?php if ( tt_temptt_get_option( 'post_sharing', 1 ) ) { ?>

	<div class="element-social">
        <ul >
            <li>
                <a  class="elem-fac-ico" target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onClick="return temptt_fb_like_<?php echo the_ID(); ?>()">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a  class="elem-fac-ico" target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" onClick="return temptt_tweet_<?php echo the_ID(); ?>()">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a  class="elem-fac-ico" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onClick="return temptt_goog_<?php echo the_ID(); ?>()">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
            <li>
                <a  class="elem-fac-ico" target="_blank" href="'https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onClick="return temptt_ln_<?php echo the_ID(); ?>()">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>
            <li>
                <a  class="elem-fac-ico" target="_blank" href="'https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onClick="return temptt_ln_<?php echo the_ID(); ?>()">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <li>
                <a  class="elem-fac-ico" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" onClick="return temptt_pin_<?php echo the_ID(); ?>()">
                    <i class="fa fa-pinterest"></i>
                </a>
            </li>
        </ul>
	</div>

<?php }
?>


<script type="text/javascript">
    function temptt_fb_like_<?php echo the_ID(); ?>() {
        window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
        return false;
    }
    function temptt_tweet_<?php echo the_ID(); ?>() {
        window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
        return false;
    }
    function temptt_ln_<?php echo the_ID(); ?>() {
        window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
        return false;
    }
    function temptt_goog_<?php echo the_ID(); ?>() {
        window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','sharer','toolbar=0,status=0,width=626,height=436');
        return false;
    }
    function temptt_pin_<?php echo the_ID(); ?>() {
        window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($url[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
        return false;
    }
</script>

