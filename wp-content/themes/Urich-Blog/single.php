<?php
/*
 * Template Name: Блог-статья
 * Template Post Type: post
 */
?>
<?php get_header(); ?>
<?php global $mytheme, $post;
 //$post_head = (!empty(redux_post_meta(THEME_OPT,$post->ID,'head_post')))?redux_post_meta(THEME_OPT,$post->ID,'head_post'):'';
 $category_obj = get_the_category( $post->ID);
 $category_name = $category_obj[0]->cat_name;

 $post_date_string = $post->post_date;
 $post_date_prepare = new DateTime($post_date_string);
 
 $post_month = $post_date_prepare->format('F');
 $post_day = $post_date_prepare->format('d');
 $post_year = $post_date_prepare->format('o');
 $post_hour = $post_date_prepare->format('g');
 $post_min = $post_date_prepare->format('i');
 $post_time_meridiem = $post_date_prepare->format('a');



 $post_author_id = $post->post_author;
 $post_author = get_user_meta( $post_author_id, 'nickname', true );
 
 $author_image = get_field( 'photo','user_'.$post_author_id );
 $author_position = get_field( 'position','user_'.$post_author_id );
 $author_linkeid = get_field( 'linkeid','user_'.$post_author_id );
 $author_facebook = get_field( 'facebook','user_'.$post_author_id );
 $author_twitter = get_field( 'twitter','user_'.$post_author_id );
 $author_googlepus = get_field( 'googleplus','user_'.$post_author_id );
 $author_link = get_author_posts_url($post_author_id);


 $post_image=get_the_post_thumbnail_url($post, 'full');
 $post_categories = get_the_category();

$my_post_child_cats = array();
foreach ( $post_categories as $post_cat ) {
    if ( 0 != $post_cat->category_parent ) {
        $my_post_child_cats[] = $post_cat->cat_ID;
    }
}

 ?>
    <section class="banner-article" style="background: url(<?= $post_image ;?>) no-repeat">
        <?php get_template_part( 'template\breadcrump', $name = null ); ?>
        <div class="banner-article-content">
            <h1 class="banner-article-header"><?= the_title() ?></h1>
            <h2 class="banner-article-subheader"><?= $category_name ?></h2>
        </div>
    </section>
    <section class="article container">
        <div class="article-info">
            <div class="article-info-autor">
                <a href="<?= get_author_posts_url($post_author_id); ?>">
                    <img src="<?= $author_image;?>" alt="#" height=78 >
                </a>
                <div class="article-info-autor-text">
                    <div class="article-info-autor-text-name"><a href="<?= $author_link ?>"><?= $post_author ?></a></div>
                    <div class="article-info-autor-text-date"><?= $post_month.' '.$post_day.', '.$post_year.', '.$post_hour.':'.$post_min.' '.$post_time_meridiem ?></div>
                </div>
            </div>
            <img src="<?= $mytheme['raccoon-article']['url'] ?>" alt="#" >                      
        </div>
        <div class="article-content">
            <div class="article-content-social">
                <ol class = 'article-content-social-list'>
                    <li class="article-content-social-item"><a href="<?= $author_linkeid ?>"><img src="<?= $mytheme['LinkedID-article']['url'] ?>" alt=""></a></li>
                    <li class="article-content-social-item"><a href="<?= $author_facebook ?>"><img src="<?= $mytheme['Facebook-article']['url'] ?>" alt=""></a></li>
                    <li class="article-content-social-item"><a href="<?= $author_twitter ?>"><img src="<?= $mytheme['Twitter-article']['url'] ?>" alt=""></a></li>
                    <li class="article-content-social-item"><a href="<?= $author_googlepus ?>"><img src="<?= $mytheme['Google-article']['url'] ?>" alt=""></a></li>
                </ol>
            </div>
            <div class="article-content-about">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <!-- article -->
                <div class="article-content-text">
                    <?php the_content(); ?>
                </div>
                <!-- /article -->
            <?php endwhile; ?>
            <?php else: ?>
                <!-- article -->
                <div>

                    <h2><?php _e( 'Извините, нет контента для отображения.', THEME_OPT ); ?></h2>

                </div>
                <!-- /article -->
            <?php endif; ?>
            </div>
    <?php //get_sidebar();?>
            <aside>
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
    <section class="blog blog-article container">
        <h2 class="blog-article-header">related articles</h2>
        <div class="blog-content">
             <?php //echo do_action( 'show_blog_posts', $my_post_child_cats, $numbers=3,null); ?> 
             <?php do_action('show_same_posts',$my_post_child_cats, $post->ID, '', 3, false );?>
        </div>
    </section>
<?php get_footer(); ?>
