<?php get_header(); ?>
<?php global $mytheme, $post; 
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
$selected_category = $categories_array[0]->cat_ID;
$search_filter = null;
if (isset($_GET['search-filter'])) $search_filter = sanitize_text_field($_GET['search-filter']);
elseif (isset($_GET['s'])) $search_filter = sanitize_text_field($_GET['s']);

?>
<!-- section -->
	<section class="blog container search">
        <div class="blog-filter search-page">
	        <div class="search-page-content">
	            <div class="blog-filter-search">
                    <input id="search-input" type="search" placeholder="Search" class="blog-filter-search-input" />
                    <button id="search-button" class="blog-filter-search-button"><img src="<?= get_template_directory_uri();?>/inc/urich/img/search-icon.png" alt=""></button>
                </div>
	            <div class='search-page-textunder'><?php echo sprintf( __( '%s results for ', THEME_OPT ), $wp_query->found_posts ); echo get_search_query(); ?></div>
            </div>  
                <div class='search-img'><img src="<?= $mytheme['raccoon-seacrh']['url'] ?>" alt=""></div>		
        </div>
        <?php do_action('show_blog_posts',$selected_category, $number_posts, $blog_categories_ids,$search_filter); ?>
    </section>
    <section class="container ">
        <?= do_action('show_pagination' ); ?>
    </section>
<!-- /section -->

<?php get_footer(); ?>
