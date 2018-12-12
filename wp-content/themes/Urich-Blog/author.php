<?php
/*
 * Author page
 */

 $post_author_id = get_queried_object_id();
 $post_author = get_user_meta( $post_author_id, 'nickname', true );
 $author_description = get_user_meta($post_author_id, 'description', true);
 $author_image = get_field( 'photo','user_'.$post_author_id );
 $author_position = get_field( 'position','user_'.$post_author_id );
 $author_linkeid = get_field( 'linkeid','user_'.$post_author_id );
 $author_facebook = get_field( 'facebook','user_'.$post_author_id );
 $author_twitter = get_field( 'twitter','user_'.$post_author_id );
 $author_googlepus = get_field( 'googlepus','user_'.$post_author_id );
 
 
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
 <?php get_header(); ?>

      <section class="blog container author">
        <div class="author-info">
            <div class="author-info-photo"><img src="<?= $author_image ?>" alt="author"></div>
            <div class="author-info-content">
                <h3 class="author-info-content-name"><?= $post_author ?></h3>
                <span class="author-info-content-prof"><?= $author_position ?></span>
                <hr class="author-info-content-line">
                <p class="author-info-content-text"><?= $author_description ?></p>
            </div>
        </div>
        <h2 class="blog-content-header">Articles by author</h2>
        <?= do_action('show_blog_posts',$selected_category, $number_posts, $blog_categories_ids,$search_filter); ?>
    </section>
    <section class="container ">
        <?= do_action('show_pagination' ); ?>
    </section>
        
<?php get_footer(); ?>
