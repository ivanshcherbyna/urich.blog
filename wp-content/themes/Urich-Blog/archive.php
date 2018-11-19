
<?php get_header(); ?>


<?php
global $post, $wp_query;
$post_categories = get_the_category($post->ID);

$blog_categories_ids = $wp_query->queried_object->cat_ID;
$number_posts=(isset($_GET['number_pagination']))? $_GET['number_pagination']:null;
$selected_category=$wp_query->queried_object->cat_ID;
$search_filter=(isset($_GET['search-filter']))? $_GET['search-filter']:null;
$iterator = 0;

?>

<section class="blog ">
    <div class="blog-filter wrapper">

        <div class="blog-filter-search">
            <input id="search-input" type="search" placeholder="Що ви бажаєте знайти?" class="blog-filter-search-input" /><button id="search-button" class="blog-filter-search-button"><img src="/wp-content/themes/Urich-Blog/inc/urich/img/shape-gl.png" alt="" ></button>
        </div>
    </div>
    <div class="blog-content">
        <?php do_action('show_blog_posts', $selected_category, $number_posts, $blog_categories_ids,$search_filter); ?>
    </div>
</section>

<section class="pagination wrapper">
    <div class="arrow arrow-prev" id="pagination-prev">
        <img src="/inc/urich/img/arrow-hover.png" alt="#">
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
