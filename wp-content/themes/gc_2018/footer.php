</main>

<footer>

    <section class="top">

        <div class="content">


            <div class="logo">
				<?php if ( get_field( 'logo', 'option' ) != null ): ?>


                    <a href="<?php echo pll_home_url(); ?>" id="simple_logo"
                       style="background-image: url('<?php echo get_field( 'logo', 'option' )['sizes']['header']; ?>')"></a>

				<?php endif; ?>
            </div>

			<?php if ( have_rows( 'social', 'option' ) ): ?>
                <div class="center"></div>
                <ul class="social">


					<?php while ( have_rows( 'social', 'option' ) ):
						the_row();

						$social = get_sub_field( 'social_network' );
						$link   = get_sub_field( 'link' );

						?>

                        <li>
                            <a target="_blank" href="<?php echo $link; ?>" id="<?php echo $social['value']; ?>">
                                <h1><?php echo $social['label']; ?></h1>
                            </a>
                        </li>


					<?php endwhile; ?>
                </ul>


			<?php endif; ?>
        </div>

    </section>


	<?php if ( have_rows( 'footer', 'option' ) ): ?>

        <section class="bottom">
            <ul class="infos">

				<?php while ( have_rows( 'footer', 'option' ) ):
					the_row();

					$icon     = get_sub_field( 'icon' );
					$title    = get_sub_field( 'title' );
					$subtitle = get_sub_field( 'subtitle' );
					$link     = get_sub_field( 'link' );

					?>

                    <li class="<?php echo $icon; ?>">
                        <a href="<?php echo $link; ?>">
                            <h1><?php echo $title; ?></h1>
                            <p><?php echo $subtitle; ?></p>
                        </a>
                    </li>


				<?php endwhile; ?>
            </ul>

        </section>
	<?php endif; ?>


</footer>

<?php wp_footer(); ?>


</body>
</html>
