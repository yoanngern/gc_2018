<?php

$id    = get_the_ID();
$title = get_the_title();
$link  = esc_url( get_permalink() );
$image = get_field_or_parent( 'bg_image', $_POST, 'gc_eventcategory' )['sizes']['square'];
$date  = complex_date( get_field( 'start' ), get_field( 'end' ) );
$time  = time_trans( new DateTime( get_field( 'start' ) ) );

?>


<div class="event">
    <a href="<?php echo $link; ?>">
        <div class="content">
            <div class="hover"></div>
            <div id="<?php echo $id; ?>" class="image" style="background-image: url('<?php echo $image; ?>')"></div>
            <h2><?php echo $title; ?></h2>
            <div class="bottom">
                <div class="txt">
                    <h3><?php echo $date; ?></h3>
                    <h4><?php echo $time; ?></h4>
                </div>
                <div class="button">
                    <span>En savoir plus</span>
                </div>
            </div>

        </div>

    </a>
</div>