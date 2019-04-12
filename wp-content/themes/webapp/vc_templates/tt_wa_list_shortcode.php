<?php

$i_color = $i_size = $i_class = $list_col = $custom_icon = $list = $list_col = '';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
	if( ! empty( $custom_icon ) ) {
		$b_icon = '<i class="iconsg '.$custom_icon.' " style="' . $i_size . ' ' . $i_color . '"></i>';
	} else {
        $b_icon = '<i class=" fa '.$i_class.' " style="' . $i_size . ' ' . $i_color . '"></i>';
	  }

?>

<?php if ($list == 'type_1') { ?>
    <ul class="wa-list <?php print esc_html($list_col); ?>">
        <?php print do_shortcode($content); ?>
    </ul>
<?php } ?>


<?php if ($list == 'type_2') { ?>
    <ol class="wa-list list-num <?php print esc_html($list_col); ?>">
        <?php print do_shortcode($content); ?>
    </ol>
<?php } ?>

