<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if(! function_exists( 'wp_site_icon' ) ) tt_webapp_favicon_info(); ?>

<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
<?php do_action('webapp_after_body'); ?>
<?php if( function_exists('tt_webapp_preloader')) tt_webapp_preloader(); ?>
<div class="overlay-nav  <?php if ( ! tt_temptt_get_option( 'enable_topbar', '1' )) echo ' no_topnav '; ?>">
   <?php if( function_exists('templatation_topnav_content')) echo templatation_topnav_content(); ?>
   <header class="header clearfix">
        <div class="container">
            <?php tt_webapp_logo(); ?>
            <nav class="nav clearfix">
                <?php
                if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu( array( 'depth'          => 3,
                                        'sort_column'    => 'menu_order',
                                        'container'      => 'ul',
                                        'menu_class'     => '',
                                        'theme_location' => 'primary-menu'
                    ) );
                } else {
                    echo "Please assign primary menu in wp-admin->Appearance->Menus";
                } ?>
            </nav>
            <div class="menu-button">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
</div>
