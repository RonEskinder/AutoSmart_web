<?php
$title = $icon = $itemcolor = $iconcolor = $type_icon =   '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<li style="<?php if( !empty($itemcolor)) echo 'color: '. esc_html($itemcolor).';'; ?>">
    <i class="<?php print esc_html($type_icon); ?>" style="<?php if( !empty($iconcolor)) echo 'color: '. esc_html($iconcolor).';'; ?>"></i>
    <?php print esc_html($title); ?>
</li>
