<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
    <header class="header">
        <div class="container">
            <div class="site-branding">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                if ( $custom_logo_id ) {
                    $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( $logo ) {
                        echo '<div class="site-logo">';
                        if ( is_front_page() && is_home() ) {
                            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="custom-logo" width="40">';
                        } else {
                            echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
                            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="custom-logo" width="40">';
                            echo '</a>';
                        }

                        echo '</div>';
                    }
                }
                ?>
            </div>

            <nav class="main-navigation">
                <?php
                wp_nav_menu( [
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => function () {
                            // Если меню не создано, показать ссылку на создание
                            echo '<a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Create a menu', 'medical-doctors' ) . '</a>';
                        },
                ] );
                ?>
            </nav>
        </div>
    </header>

