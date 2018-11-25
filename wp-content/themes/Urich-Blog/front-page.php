<?php
/*
 * Template Name: Главная страница Блога
 *
 */
?>
<?php get_header();
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
$blog_categories_ids = '';
$number_posts=(isset($_GET['number_pagination']))? $_GET['number_pagination']:null;
$selected_category=(isset($_GET['data-filter']))? $_GET['data-filter']:$categories_array[0]->cat_ID;
$search_filter=(isset($_GET['search-filter']))? $_GET['search-filter']:null;
$iterator = 0;

?>

<section class="blog container">
    <h1><?= the_title(); ?></h1>
    <h2 class="blog-subheader">The Best Articles You Ever Read</h2>
    <div class="blog-filter wrapper">
        <nav class="blog-filter-tabs">
            <?php foreach ($categories_array as $category):
                $iterator++;
                //temp string $blog_categories_ids for use pagination
                if($iterator!=1) $blog_categories_ids .= ',';
                $blog_categories_ids .= $category->cat_ID;
                ?>
                <span class="filter-tabs-tab" data-filter="<?= $category->cat_ID ?>"><?= $category->name ?></span>
            <?php endforeach; ?>
        </nav>
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
