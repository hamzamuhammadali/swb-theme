<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' : ';
		} ?><?php bloginfo( 'name' ); ?></title>
	<?php $favicon = !empty(get_option('globalPlattform')) ? 'global' : 'favicon';?>
    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo( 'template_directory' ); ?>/img/<?php echo $favicon;?>/manifest.json">
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
    <div class='employee' style="background: <?php echo get_option('color');?>">
        <div class='container-fluid'>
            <div class='d-flex justify-content-between'>
                <div class='employee__name'><?php echo $userName; ?></div>
                <div class='employee__logout'><a href="/wp-login.php?action=logout">Ausloggen</a></div>
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
                        <img src="<?php echo wp_get_attachment_url(get_option('logoprint'));?>" alt="Logo"
                             class="logo-img"
                             width="290">
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
