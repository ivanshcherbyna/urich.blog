<?php
/*
* Category page
*/

 get_header();

global $mytheme, $post;
$post_categories = get_the_category($post->ID);
$categories_array = get_categories(array(
    'type'         => 'post',
    //'child_of'     => 5,
    'parent'       => '',
//    'orderby'      => 'name',
//    'order'        => 'ASC',
    'hide_empty'   => '',
    'hierarchical' => false ,
    'exclude'      => '',
    'include'      => '',
    'number'       => 0,
    'taxonomy'     => 'category',
    'pad_counts'   => false,
) );

$current_cat_id = $wp_query->get_queried_object_id();
$current_cat_name = get_cat_name($current_cat_id);
$blog_categories_ids = '';
$number_posts=(isset($_GET['number_pagination']))? $_GET['number_pagination']:null;
$selected_category=(!empty($current_cat_id))? $current_cat_id:$categories_array[0]->cat_ID;
$search_filter=(isset($_GET['search-filter']))? $_GET['search-filter']:null;
$iterator = 0;

?>

<section class="blog container">
    <h1><?= $current_cat_name ?></h1>
    <h2 class="blog-subheader">Page of category</h2>
    <div class="blog-filter wrapper">
        <div class="blog-filter-search">
            <input id="search-input" type="search"  placeholder="Search" class="blog-filter-search-input" />
            <button id="search-button" class="blog-filter-search-button"><img src="<?= get_template_directory_uri();?>/inc/urich/img/search-icon.png" alt=""></button>
        </div>
    </div>
    <?= do_action('show_blog_posts',$selected_category, $number_posts, $blog_categories_ids,$search_filter); ?>
</section>
<section class="container ">
    <?= do_action('show_pagination' ); ?>
</section>

<?php get_footer();?>

