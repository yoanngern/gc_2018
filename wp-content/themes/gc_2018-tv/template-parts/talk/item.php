<div class="talk_item">
    <a class="talk_container" href="<?php echo $item['link']; ?>">

        <div class="image">
            <div class="bg"
                 style="background-image: url('<?php echo $item['image']['sizes']['summary'] ?>')"></div>
        </div>

        <div class="text">
            <h1><?php echo $item['title']; ?></h1>
            <time><?php echo $item['date']; ?></time>
        </div>
    </a>
</div>
