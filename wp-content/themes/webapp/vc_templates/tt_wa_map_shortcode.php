<?php
/*
 * Templatation.com
 *
 * Block with image left shortcode for VC
 *
 */
$map_height = $marker = $marker_text  = $latitude = $longitude = $image = $zoom = $title = '';

$ins_button = false;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'goog_maps' );
wp_enqueue_script( 'g_maps' );

$map_zoom = ( is_numeric( $zoom ) ) ? $zoom : 12;
$marker = ( is_numeric( $marker ) && ! empty( $marker ) ) ? wp_get_attachment_url( $marker ) : get_template_directory_uri() . '/images/red-dot.png';
$map_height = (!empty($map_height)) ? 'height:'.$map_height.'px' : '' ;
?>
<!-- end of code from VC -->


 <section id="map-area">
<div class="tt-contact-map-2 map-block" id="map-canvas" data-scroll="no" data-lat="<?php print esc_html($latitude); ?>" data-lng="<?php print esc_html($longitude)?>" data-zoom="<?php print esc_html($zoom); ?>" style="<?php echo esc_attr($map_height);?>"></div>
<?php if(!empty($marker_text)) { ?>
<div class="addresses-block">
    <a data-lat="<?php print esc_html($latitude); ?>" data-lng="<?php print esc_html($longitude)?>" data-string="<?php print esc_html($marker_text)?>"   data-marker="<?php print esc_html($marker); ?>"></a>
</div>
<?php } ?>
 </section>