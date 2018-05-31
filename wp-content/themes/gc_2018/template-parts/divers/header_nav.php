<header>

    <div>



		<?php if ( get_field( 'logo_white', 'option' ) != null ): ?>
            <a href="<?php echo pll_home_url(); ?>" id="simple_logo"
               style="background-image: url('<?php echo get_field( 'logo_white', 'option' )['sizes']['header']; ?>')"></a>
		<?php endif; ?>

        <a href="<?php echo pll_home_url(); ?>" id="logo_mini">
            <svg>
                <path d="M17.8365916,21.7438401 C16.5186367,21.7994867 15.2014892,21.6615798 13.906543,21.3285064 C12.2285221,20.8958335 10.6784619,20.138152 9.29915045,19.0768332 C7.87906922,17.9828524 6.73347782,16.6574137 5.89588017,15.1372117 C5.06070448,13.6214454 4.52423832,12.0064828 4.29859153,10.3374866 C4.0733484,8.66768385 4.17184181,6.96965456 4.59205346,5.29017415 C5.01428341,3.60746785 5.78285494,2.03524837 6.87677766,0.616662042 C7.03541664,0.411414617 7.2005142,0.213828686 7.36924472,0.0202751219 C5.6867835,0.919492723 4.16175028,2.17678442 2.92170209,3.78448871 C-1.76642281,9.86126416 -0.635766895,18.5844814 5.44741222,23.2668647 C8.99680797,25.9995991 13.4471762,26.7500224 17.4708743,25.6959619 L15.7867984,24.3999595 L17.8365916,21.7438401 L17.8365916,21.7438401 Z"
                      id="Shape"></path>
                <path d="M22.6361271,1.65136714 C21.648771,0.986833234 20.6464795,0.566257468 19.5364103,0.295685715 C18.4231118,0.0235010146 17.2985108,-0.0414200767 16.1940929,0.100519204 C15.0925006,0.243264958 14.0207793,0.592871083 13.0108181,1.13925667 C12.0069119,1.68362607 11.136214,2.42638787 10.4257698,3.34858996 C9.69998634,4.28974416 9.19419845,5.32848163 8.92334157,6.43697902 C8.65208103,7.55233143 8.58547688,8.67615182 8.72918038,9.77658448 C8.87207656,10.8774204 9.22528039,11.941965 9.77950766,12.9391691 C10.3317166,13.9335505 11.089793,14.8057513 12.0335536,15.5319804 C12.9752959,16.257403 14.0018072,16.7594325 15.0856383,17.0247622 C16.1743135,17.2913016 17.2859973,17.355013 18.3883969,17.2110575 C18.5785215,17.1864601 18.7686461,17.1525882 18.9591743,17.1142808 L14.82124,13.9283084 L17.8309403,10.0273976 L26.9851763,17.07557 C28.6139505,12.6710167 27.8918001,7.69265777 25.0568852,3.92400857 C24.4130451,3.09495414 23.5358886,2.25743174 22.6361271,1.65136714 L22.6361271,1.65136714 Z"
                      id="Shape"></path>
            </svg>
            <span><?php echo get_field( 'city_name', 'option' ); ?></span>
        </a>


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

	        <?php if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
                <div id="right-sidebar" class="right-sidebar widget-area">
			        <?php dynamic_sidebar( 'right_sidebar' ); ?>
                </div>
	        <?php endif; ?>

	        <?php if ( is_user_logged_in() && is_active_sidebar( 'right_sidebar_private' ) ) : ?>
                <div id="right-sidebar-private" class="right-sidebar-private widget-area">
			        <?php dynamic_sidebar( 'right_sidebar_private' ); ?>
                </div>
	        <?php endif; ?>

	        <?php if ( !is_user_logged_in() && is_active_sidebar( 'right_sidebar_public' ) ) : ?>
                <div id="right-sidebar-public" class="right-sidebar-public widget-area">
			        <?php dynamic_sidebar( 'right_sidebar_public' ); ?>
                </div>
	        <?php endif; ?>


        </div>
    </div>

</header>