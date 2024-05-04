<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' : ';
		} ?><?php bloginfo( 'name' ); ?></title>

    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php bloginfo( 'template_directory' ); ?>/img/global/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo( 'template_directory' ); ?>/img/global/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php
$user     = wp_get_current_user();
$userName = $user->display_name;
if ( is_user_logged_in() ) :?>
    <div class='employee' style="background: #85b083">
        <div class='container-fluid'>
            <div class='d-flex justify-content-between'>
                <div class='employee__name'><?php echo $userName; ?></div>
                <div class='employee__logout'><a href="/wp-login.php?action=logout">Ausloggen</a> | <a href="/wp-admin">Admin Bereich</a></div>
            </div>
        </div>
    </div>
<?php endif ?>
<header class="header clear" role="banner">
    <div class="container-fluid container-fluid--header">
        <nav class="navbar-expand-lg row align-items-center" role="navigation">
            <div class="col-auto m-auto">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url() ); ?>">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="187" height="83" viewBox="0 0 187 83">
		                    <rect id="Rechteck_1" data-name="Rechteck 1" width="83" height="83" rx="41.5" fill="#eeaa70" opacity="0.85"/>
		                    <rect id="Rechteck_2" data-name="Rechteck 2" width="18" height="18" rx="9" transform="translate(169 42)" fill="#eb9c57" opacity="0.85"/>
		                    <path id="Pfad_9" data-name="Pfad 9" d="M57.678-26.938,49.3-49.858H33.412l-8.4,22.92-8.376-22.92H.742l15.89,36.2H33.412l7.945-18.1,7.945,18.1H66.081l15.89-36.2H66.081ZM83.049-49.912v36.2H97.161v-36.2Zm21.6.027v36.2h14.113v-8.834h12.6l6.814,8.834h15.028l-7.891-10.154a13.579,13.579,0,0,0,5.71-4.956,13.194,13.194,0,0,0,2.182-7.407,13.667,13.667,0,0,0-13.682-13.682ZM135.972-39.3a3.081,3.081,0,0,1,3.1,3.1,2.973,2.973,0,0,1-.916,2.182,2.966,2.966,0,0,1-2.182.889h-17.21V-39.3Z" transform="translate(12.668 73.685)" fill="#85b083"/>
	                    </svg>

                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
