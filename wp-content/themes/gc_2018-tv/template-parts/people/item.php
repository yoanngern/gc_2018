<?php

$id   = get_the_ID( $speaker );
$name = get_field( 'firstname', $speaker ) . " " . get_field( 'lastname', $speaker );
$link = esc_url( get_permalink( $speaker ) );

$title = get_field( 'title', $speaker );

$image = get_field( 'picture', $speaker );


?>


<div class="speaker">
    <a href="<?php echo $link; ?>">

        <div class="image">
            <div class="bg" style="background-image: url('<?php echo $image['sizes']['speaker']; ?>')"></div>
        </div>
        <div class="txt">
            <h2><?php echo $name; ?></h2>
            <h3><?php echo $title; ?></h3>
        </div>

    </a>
</div>