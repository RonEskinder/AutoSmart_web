
<?php
/*
 * Templatation.com
 *
 * Block with icon shortcode for VC
 *
 */
$icon_custom = $icon_contact = $title = $description = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


?>
<div class="contact-block">
    <?php if (!empty($icon_custom)) {
    echo '<i class="cont-info '.$icon_custom.'"> </i>';
    } else { ?><i class="cont-info <?php print esc_html($icon_contact); ?>"></i><?php } ?>
    <div class="content">
    <?php if (!empty($title)) { ?>
    <h4> <?php print esc_html($title); ?> </h4>
    <?php } ?>
        <p><?php echo wp_kses_post($description); ?></p>
    </div>
</div>
