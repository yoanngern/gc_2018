<?php /* Template Name: TV selection */ ?>

<?php get_header('tv'); ?>

<section id="content" class="tv">

    <div class="platter">


        <article class="content-page">

            <section class="header">
                <h1><?php echo get_the_title() ?></h1>

            </section>


            <section class="selection">

				<?php if ( get_field( 'selection' ) ): ?>

					<?php while ( have_rows( 'selection' ) ): the_row();

						$title = get_sub_field( 'title' );
						$link  = get_sub_field( 'link' );
						$image = get_sub_field( 'background' );

						?>

                        <article class="item">
                            <a title="<?php echo $title; ?>" href="<?php echo $link; ?>">
                                <div class="image">
                                    <div class="bg"
                                         style="background-image: url('<?php echo $image['sizes']['speaker'] ?>')"></div>
                                </div>
                            </a>

                        </article>


					<?php endwhile; ?>

				<?php endif; ?>

            </section>


        </article>

    </div>


</section>


<?php get_footer(); ?>

