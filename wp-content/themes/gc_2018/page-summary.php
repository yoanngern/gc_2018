<?php /* Template Name: Summary */ ?>

<?php get_header(); ?>

<section id="content">

	<?php if ( get_field( 'bg_image' ) ): ?>

        <article class="title">
            <div class="image"
                 style="background-image: url('<?php echo get_field( 'bg_image' )['sizes']['header']; ?>')"></div>
            <div class="title">


                <h1 class="page-title">
                    <span class="txt"><?php echo get_the_title(); ?></span>
                    <span class="underline"></span>
                </h1>


            </div>

        </article>

	<?php else: ?>

        <div class="spacer"></div>

	<?php endif; ?>


    <div class="platter" id="summary">
        <nav class="sub-nav">
			<?php

			wp_nav_menu( array(
				'theme_location' => 'principal'
			) );

			?>
        </nav>

		<?php
		// TO SHOW THE PAGE CONTENTS
		while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
            <article class="content-page">


				<?php

				if ( get_the_content() != null ) {
					echo '<div class="content">';
					the_content();
					echo '</div>';
				}


				?> <!-- Page Content -->

            </article><!-- .entry-content-page -->


			<?php
		endwhile; //resetting the page loop
		wp_reset_query(); //resetting the page query
		?>


		<?php if ( have_rows( 'sections' ) ): ?>
            <section class="sections">
				<?php while ( have_rows( 'sections' ) ): the_row();

					?>

                    <article class="item">
                        <div class="pic">
                            <div class="image"
                                 style="background-image: url('<?php echo get_sub_field( 'image' )['sizes']['summary']; ?>')"></div>
                        </div>
                        <div class="content">
                            <div class="txt">
                                <h2><?php the_sub_field( 'title' ); ?></h2>
                                <p><?php the_sub_field( 'text' ); ?></p>

								<?php if ( get_sub_field( 'url' ) != null ): ?>
                                    <a href="<?php the_sub_field( 'url' ); ?>"
                                       class="dynamic"><?php the_sub_field( 'button' ); ?></a>

								<?php endif; ?>
                            </div>
                        </div>

                    </article>

				<?php endwhile; ?>
            </section>
		<?php endif; ?>


    </div>


</section>


<?php get_footer(); ?>

