<header>

	<?php

	if ( is_user_logged_in() ) : ?>

		<div class="private-nav">

			<?php
			wp_nav_menu( array(
				'theme_location' => 'admin'
			) );
			?>

		</div>
	<?php endif; ?>

	<a href="<?php echo pll_home_url(); ?>" id="simple_logo" style="background-image: url('<?php echo get_template_directory_uri() . '/images/gc_oron_white.png' ?>')"></a>


	<?php if ( is_user_logged_in() ) : ?>
		<div id="language">
			<a id="open_lang" href="#"><?php echo pll_current_language( 'name' ) ?></a>
			<select name="lang_switch" id="lang_switch">
				<?php
				$languages = pll_the_languages( array( 'raw' => 1 ) );

				foreach ( $languages as $lang ) : ?>

					<option <?php
					if ( $lang['current_lang'] ) {
						echo 'selected="selected"';
					}

					?> id="<?php echo $lang['slug'] ?>"
					   value="<?php echo $lang['url'] ?>"><?php echo $lang['name'] ?></option>

				<?php endforeach;

				?>
			</select>
		</div>
	<?php endif; ?>

    <div id="burger">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="top-nav">
		<?php

		wp_nav_menu( array(
			'theme_location' => 'top'
		) );

		?>
    </div>

	<div class="principal-nav">
		<?php

		wp_nav_menu( array(
			'theme_location' => 'principal'
		) );

		?>
	</div>



</header>