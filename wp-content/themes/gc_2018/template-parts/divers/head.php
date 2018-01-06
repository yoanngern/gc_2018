<?php ?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

	<?php

	if ( is_single() ):
		echo "<title>" . get_field( 'short_name', 'option' ) . " - " . get_the_title() . "</title>";

		if ( get_the_excerpt() ): ?>
            <meta name="Description" content="<?php echo strip_tags( get_the_excerpt() ); ?>"/>
		<?php endif;
	else:
		echo "<title>" . get_field( 'short_name', 'option' ) . " - " . get_the_title() . "</title>";
		echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '">';
	endif; ?>


    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport"
          content="initial-scale=1, width=device-width, minimum-scale=1, user-scalable=no, maximum-scale=1, width=device-width, minimal-ui">
    <link rel="profile" href="http://gmpg.org/xfn/11">


    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/images/manifest.json">
    <link rel="mask-icon" href="favicon_hd.svg" color="#BB9446">
    <meta name="msapplication-TileColor" content="#BB9446">
    <meta name="msapplication-TileImage"
          content="<?php echo get_stylesheet_directory_uri(); ?>/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

	<?php if ( get_field( 'fb_title' ) ):
		$meta_fb_title = get_field( 'fb_title' );
	else:
		$meta_fb_title = get_the_title();
	endif; ?>

	<?php if ( get_field( 'fb_desc' ) ):
		$meta_fb_desc = get_field( 'fb_desc' );
	else:
		$meta_fb_desc = "A place where miracles happen!";
	endif; ?>

	<?php if ( get_field( 'fb_image' ) ):
		$meta_fb_image = get_field( 'fb_image' )['sizes']['full_hd'];;
	else:
		$meta_fb_image = "http://gospel-center.org/wp-content/themes/gc_2018/images/facebook_default_home.png";
	endif; ?>

    <meta property="og:title" content="<?php echo $meta_fb_title; ?>"/>
    <meta property="og:description"
          content="<?php echo $meta_fb_desc; ?>"/>
    <meta property="og:image"
          content="<?php echo $meta_fb_image; ?>"/>


	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>



    <script>

    </script>
	<?php wp_head(); ?>

    <?php echo get_field( 'script', 'option' ) ?>


    <script>


    </script>

	<?php get_template_part( 'template-parts/divers/facebook_pixel' ); ?>

</head>


<?php if ( get_field( 'facebook_event' ) ):
	echo get_field( 'facebook_event' );
endif; ?>
