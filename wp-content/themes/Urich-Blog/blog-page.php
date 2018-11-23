<?php
/*
 * Template Name: Блог
 * Template Post Type: page
 */
?>
<?php get_header(); ?>

<?php
global $post;
$post_categories = get_the_category($post->ID);
$categories_array = get_categories(array(
    'type'         => 'post',
    'child_of'     => 5,
    'parent'       => '',
//    'orderby'      => 'name',
//    'order'        => 'ASC',
    'hide_empty'   => 1,
    'hierarchical' => false ,
    'exclude'      => '',
    'include'      => '',
    'number'       => 0,
    'taxonomy'     => 'category',
    'pad_counts'   => false,
    // полный список параметров смотрите в описании функции http://wp-kama.ru/function/get_terms
) );
$blog_categories_ids = '';
$number_posts=(isset($_GET['number_pagination']))? $_GET['number_pagination']:null;
$selected_category=(isset($_GET['data-filter']))? $_GET['data-filter']:$categories_array[0]->cat_ID;
$search_filter=(isset($_GET['search-filter']))? $_GET['search-filter']:null;
$iterator = 0;

?>

<section class="blog ">
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
        <?php //get_search_form(); ?>
        <div class="blog-filter-search">
            <input id="search-input" type="search" placeholder="Що ви бажаєте знайти?" class="blog-filter-search-input" /><button id="search-button" class="blog-filter-search-button"><img src="../../wp-content/themes/Svitanok/inc/urich/img/shape-gl.png" alt="" ></button>
        </div>
    </div>
    <div class="blog-content">
        <?php do_action('show_blog_posts', $selected_category, $number_posts, $blog_categories_ids,$search_filter); ?>
    </div>
</section>

<section class="pagination wrapper">
    <div class="arrow arrow-prev" id="pagination-prev">
        <img src="<?= get_template_directory_uri();?>inc/urich/img/arrow-hover.png" alt="#">
    </div>
    <ul class="pagination-list">
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">1</a>
        </li>
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">...</a>
        </li>
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">5</a>
        </li>
        <li class="pagination-list-item active-pagination">
            <a href="" class="pagination-list-item-link">6</a>
        </li>
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">7</a>
        </li>
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">...</a>
        </li>
        <li class="pagination-list-item">
            <a href="" class="pagination-list-item-link">25</a>
        </li>
    </ul>
    <div class="arrow" id="pagination-next">
        <img src="/inc/urich/img/arrow-hover.png" alt="#">
    </div>
</section>
<div class="footer-line-page"></div>

<?php get_footer(); ?>
