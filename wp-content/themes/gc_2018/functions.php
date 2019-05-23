<?php


/**
 *
 */
function gc_theme_enqueue_style()
{
    wp_enqueue_style('gc_2018-style', get_template_directory_uri() . '/style.css', false, wp_get_theme()->get('Version'));
}

function gc_theme_enqueue_script()
{
    wp_enqueue_script('gc_2018-js', get_template_directory_uri() . '/js/main_v1_3.min.js', false);
}

function gc_theme_load_theme_textdomain()
{
    load_theme_textdomain('gc_2018', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'gc_theme_load_theme_textdomain');


add_action('wp_enqueue_scripts', 'gc_theme_enqueue_style');
add_action('wp_enqueue_scripts', 'gc_theme_enqueue_script');

add_filter('show_admin_bar', '__return_false');

require_once(__DIR__ . '/includes/gc_date.php');


function get_blog_id()
{
    global $blog_id;

    return $blog_id;
}

function get_blog_gc_id()
{
    return 1;
}

function get_blog_tv_id()
{
    return 4;
}

add_action('acf/init', 'gc_acf_init');

function gc_acf_init()
{

    if (function_exists('acf_add_options_page')) {


        /**
         * Gospel Center - Settings
         */
        acf_add_options_sub_page(array(
            'page_title' => __('Gospel Center - Settings', 'my_text_domain'),
            'menu_title' => __('Gospel Center', 'my_text_domain'),
            'parent_slug' => 'options-general.php',
            'menu_slug' => 'gc',
            'capability' => 'delete_pages',
            'autoload' => true,

        ));

        if (get_blog_id() == get_blog_gc_id()) {

            /**
             * Gospel Center - Global Nav
             */
            acf_add_options_sub_page(array(
                'page_title' => __('Gospel Center - Global Nav', 'my_text_domain'),
                'menu_title' => __('Global Nav', 'my_text_domain'),
                'parent_slug' => 'options-general.php',
                'menu_slug' => 'gc_nav',
                'capability' => 'delete_pages',
                'autoload' => true,

            ));

        }

    }
}


if (isset($_GET['nf_preview_form'])) {

    $home_url = get_home_url();

    $form_id = $_GET['nf_preview_form'];

    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $url = $home_url . "/preview/?nf_preview_form=" . $form_id;

    if ($url != $current_url) {
        wp_safe_redirect($url);
    }

}


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args)
{

    // loop
    foreach ($items as &$item) {

        // vars
        $icon = get_field('icon', $item)['sizes']['thumbnail'];


        // append icon
        if ($icon) {

            $title_txt = $item->title;

            $item->title = '<span class="title">' . $title_txt . '</span> <span class="icon" style="background-image: url(\' ' . $icon . ' \')"></span>';

        }

    }


    // return
    return $items;

}


function apply_file_suffix($path, $suffix = '@2x')
{

    $pathinfo = pathinfo($path);

    $new_path = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . $suffix . '.' . $pathinfo['extension'];

    if (!file_exists($new_path)) {

        return null;
    }

    return $new_path;

}

/**
 * @param $paths
 *
 * @return array
 */
function wpos3_hipdi_add_hidpi_file_paths($paths)
{


    foreach ($paths as $path) {

        $new_path = apply_file_suffix($path);

        if ($new_path != null) {
            $paths[] = $new_path;
        }


    }

    return $paths;
}

add_filter('as3cf_attachment_file_paths', 'wpos3_hipdi_add_hidpi_file_paths');


function register_my_menu()
{
    register_nav_menu('principal', __('Main menu', 'gc_2018'));
    register_nav_menu('top', __('Header menu', 'gc_2018'));

    if (get_blog_id() == get_blog_gc_id()) {

        register_nav_menu('global_nav', __('Global Nav', 'gc_2018'));
    }
}

add_action('init', 'register_my_menu');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function my_widgets_init()
{

    register_sidebar(array(
        'name' => 'Left sidebar',
        'id' => 'left_sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Right sidebar',
        'id' => 'right_sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Right sidebar private',
        'id' => 'right_sidebar_private',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Right sidebar public',
        'id' => 'right_sidebar_public',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));


}

add_action('widgets_init', 'my_widgets_init');


//add_action( 'acf/init', 'my_acf_init' );

add_theme_support('post-thumbnails');


add_image_size('header', 800, 360, true);
add_image_size('home', 800, 450, true);

add_image_size('square', 450, 450, true);
add_image_size('summary', 770, 433, true);
add_image_size('logo', 160, 70, true);

add_image_size('full_hd', 1920, 1080, true);
add_image_size('hd', 1280, 720, true);

add_image_size('social', 1920, 1080, true);

add_image_size('speaker', 350, 245, true);


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 *
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 18;
}

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);


// get the the role object
$role_object = get_role('editor');

// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');


function my_theme_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

add_filter('get_the_archive_title', 'my_theme_archive_title');


function get_attachment_url_by_slug($slug)
{

    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_header = get_posts($args);

    $header = $_header ? array_pop($_header) : null;

    return $header ? wp_get_attachment_url($header->ID) : '';
}


function is_child($pageSlug)
{

    $id = get_the_ID();

    do {

        $parent_id = wp_get_post_parent_id($id);

        $parent_slug = get_page_uri($parent_id);

        if ($parent_slug == $pageSlug) {

            return true;
        } else {
            $id = $parent_id;
        }

    } while ($parent_id != 0 && true);

    return false;
}


// add hook
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
{
    if (isset($args->sub_menu)) {
        $root_id = 0;

        // find the current menu item
        foreach ($sorted_menu_items as $menu_item) {
            if ($menu_item->current) {
                // set the root id based on whether the current menu item has a parent or not
                $root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
                break;
            }
        }

        // find the top level parent
        if (!isset($args->direct_parent)) {
            $prev_root_id = $root_id;
            while ($prev_root_id != 0) {
                foreach ($sorted_menu_items as $menu_item) {
                    if ($menu_item->ID == $prev_root_id) {
                        $prev_root_id = $menu_item->menu_item_parent;
                        // don't set the root_id to 0 if we've reached the top of the menu
                        if ($prev_root_id != 0) {
                            $root_id = $menu_item->menu_item_parent;
                        }
                        break;
                    }
                }
            }
        }
        $menu_item_parents = array();
        foreach ($sorted_menu_items as $key => $item) {
            // init menu_item_parents
            if ($item->ID == $root_id) {
                $menu_item_parents[] = $item->ID;
            }
            if (in_array($item->menu_item_parent, $menu_item_parents)) {
                // part of sub-tree: keep!
                $menu_item_parents[] = $item->ID;
            } else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
                // not part of sub-tree: away with it!
                unset($sorted_menu_items[$key]);
            }
        }

        return $sorted_menu_items;
    } else {
        return $sorted_menu_items;
    }
}


function get_field_or_parent($field, $post, $taxonomy = 'category')
{

    if (is_int($post)) {
        $post = get_post($post);
    }


    $field_return = get_field($field, $post);


    if (!$field_return) :


        $categories = get_the_terms($post->ID, $taxonomy);


        if ($categories) :
            foreach ($categories as $category) :

                $field_return = get_field($field, $category);


                if ($field_return) {
                    break;
                }

                while (!$field_return && $category->parent != null) {

                    $current_cat = get_term($category->parent, $taxonomy);
                    $new_field_return = get_field($field, $current_cat);

                    if ($new_field_return) {
                        $field_return = $new_field_return;
                    }

                    if ($field_return) {
                        break;
                    }

                    $category = $current_cat;

                }

            endforeach;
        endif;

        return $field_return;

    else:

        return $field_return;

    endif;
}

function get_related_posts($post, $nb = 3)
{
    $orig_post = $post;
    global $post;

    $posts = Array();

    $tags = wp_get_post_tags($post->ID);


    if ($tags) {
        $tag_ids = array();
        foreach ($tags as $individual_tag) {
            $tag_ids[] = $individual_tag->term_id;
        }
        $args = array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => $nb, // Number of related posts to display.
            'caller_get_posts' => 1
        );

        $my_query = new wp_query($args);


        foreach ($my_query->get_posts() as $curr_post) {


            array_push($posts, $curr_post);
        }

    }


    $categories = get_categories($post->ID);


    if ((sizeof($posts) < $nb) && sizeof($categories)) {


        $nb_needed = $nb - sizeof($posts);


        foreach ($categories as $category) {


            $exclude = Array();

            array_push($exclude, $post->ID);

            foreach ($posts as $curr) {
                array_push($exclude, $curr->ID);
            }

            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => $nb_needed,
                'offset' => 0,
                'category' => $category->term_id,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'suppress_filters' => true,
                'exclude' => $exclude
            ));

            foreach ($recent_posts as $curr_post) {


                $post_obj = get_post($curr_post['ID']);


                if (sizeof($posts) < $nb) {
                    array_push($posts, $post_obj);
                }
            }
        }

    }


    wp_reset_query();

    array_slice($posts, 0, $nb);

    return $posts;
}


require_once(__DIR__ . '/includes/acf_fields.php');

/**
 * @param int $people_id
 *
 * @return mixed
 */
function get_people($people_id)
{


    if (!is_int($people_id)) {
        $people_id = intval($people_id);
    }

    // Get the current blog id
    $original_blog_id = get_current_blog_id();


    // GC TV
    switch_to_blog(4);

    $people = get_post($people_id);


    if ($people->post_type == 'gc_people') {
        $people_array = array(
            'id' => $people_id,
            'title' => $people->post_title,
            'name' => get_field('firstname', $people) . ' ' . get_field('lastname', $people),
            'picture' => get_field('picture', $people),
            'firstname' => get_field('firstname', $people),
            'lastname' => get_field('lastname', $people),
            'bio' => get_field('bio', $people),
        );

    } else {
        $people_array = null;
    }

    // Switch back to the current blog
    switch_to_blog($original_blog_id);

    return $people_array;
}


/**
 * @param int $people_id
 *
 * @return mixed
 */
function get_last_talks($city = null)
{


    // Get the current blog id
    $original_blog_id = get_current_blog_id();


    // GC TV
    switch_to_blog(4);

    $args = array(
        'posts_per_page' => 4,
        'orderby' => 'meta_value',
        'meta_key' => 'date',
        'order' => 'desc',
        'post_type' => 'gc_talk',
        'meta_query' => array(
            'key' => 'city',
            'compare' => '=',
            'value' => $city,
        )

    );


    // The Query
    $query = new WP_Query($args);

    $talks = $query->get_posts();

    $items = array();


    foreach ($talks as $talk) {


        if (get_field('talk_picture', $talk) != null) {
            $item['image'] = get_field('talk_picture', $talk);
        } else {

            $item['image'] = get_field('picture', get_field('speaker', $talk));

        }


        $item['title'] = get_field('title', $talk);
        $item['speaker'] = get_field('speaker', $talk);

        $item['link'] = esc_url(get_permalink($talk));

        $item['date'] = complex_date(get_field('date', $talk), get_field('date', $talk));

        $items[] = $item;
    }


    // Switch back to the current blog
    switch_to_blog($original_blog_id);


    return $items;
}


/**
 * @param $field
 *
 * @return mixed
 */
function talks_acf_load_value($field)
{


    // Get the current blog id
    $original_blog_id = get_current_blog_id();


    // GC TV
    switch_to_blog(4);

    $cities = get_posts(
        array(
            'post_type' => 'gc_city',
            'numberposts' => 100,
        )
    );


    $choices = [];


    foreach ($cities as $city) {

        $choices[$city->ID] = $city->post_title;
    }

    // Switch back to the current blog
    switch_to_blog($original_blog_id);


    $field['choices'] = $choices;


    return $field;
}

// acf/load_value - filter for every field load
add_filter('acf/load_field/name=home_talks', 'talks_acf_load_value', 10, 3);


/**
 * @param $acf_selector
 * @param $post
 */
function print_buttons($acf_selector, $post, $style = 'dynamic')
{
    if (have_rows($acf_selector . '_buttons', $post)): ?>
        <div class="buttons">

            <?php while (have_rows($acf_selector . '_buttons', $post)):
                the_row();


                $link = get_sub_field('link');
                $display = get_sub_field('display');

                $url = $link['url'];
                $label = $link['title'];
                $target = $link['target'];

                ?>


                <?php if ($display): ?>
                <a class="<?php echo $style ?>" target="<?php echo $target ?>"
                   href="<?php echo $url; ?>"><?php echo $label; ?></a>
            <?php endif; ?>

            <?php endwhile; ?>

        </div>

    <?php endif;
}


/**
 * @param $field
 *
 * @return mixed
 */
function gc_team_load_value($field)
{


    // Get the current blog id
    $original_blog_id = get_current_blog_id();


    // GC TV
    switch_to_blog(get_blog_tv_id());

    $speakers = get_posts(
        array(
            'post_type' => 'gc_people',
            'numberposts' => 300,
        )
    );


    $choices = [];


    foreach ($speakers as $speaker) {

        $choices[$speaker->ID] = $speaker->post_title;
    }

    // Switch back to the current blog
    switch_to_blog($original_blog_id);


    $field['choices'] = $choices;


    return $field;
}

// acf/load_value - filter for every field load
add_filter('acf/load_field/name=team_members', 'gc_team_load_value', 10, 3);


function my_login_logo()
{

    wp_enqueue_style('nublue-login',
        get_template_directory_uri() . '/style-login.css',
        false,
        null,
        'all');
    if (!has_action('login_enqueue_scripts', 'wp_print_styles')) {
        add_action('login_enqueue_scripts', 'wp_print_styles', 11);
    }
}

add_action('login_enqueue_scripts', 'my_login_logo');