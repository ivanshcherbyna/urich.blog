<?php
/*
 * Template Name: Блог-стаття
 * Template Post Type: post
 */
?>
<?php get_header(); ?>
 <?php global $mytheme, $post;
 $array_month= array('січня', 'лютого', 'березня', 'квітня', 'травня',  'червня', 'липня', 'серпня', 'вересня', 'жовтня', 'листопада', 'грудня');
 $post_date_string = $post->post_date;
 $post_date_prepare = new DateTime($post_date_string);
 $month = $post_date_prepare->format('n');

 $current_post_day = $post_date_prepare->format('d');
 $current_post_year = $post_date_prepare->format('o');
 $current_post_month = $array_month[$month];
 $post_image=get_the_post_thumbnail_url($post, 'full');
 $post_categories = get_the_category($post->ID);
 $post_categories_id = get_the_category($post->ID);
 $post_cat ='';
 $category_parent = '';
 $i =0;
 foreach ($post_categories as $category){
     if ($category->category_parent){
         $category_parent = $category->category_parent;
         $i++;
        if($i>1) $post_cat.=', ';
         $post_cat .= $category->name;
     }
 }
 ?>
<?php
// show content when not has parent category && blog cat number
//if(in_array($category_parent,$post->post_category) || in_array(5,$post->post_category)):
if($category_parent==5):?>
   <section class="blog_article wrapper">
    <div class="blog_article-content">
        <div class="blog_article-content-header">
            <div class = 'blog_article-content-header-text'>Категорії: <span class = 'blog_article-content-header-category'><?= $post_cat?></span></div>
            <span class = 'blog_article-content-header-text'><?= $current_post_day.' '. $current_post_month .' '.$current_post_year  ?></span>
        </div>
        <div class="blog_article-content-img">
            <img src="<?= $post_image ?>" alt="#" class="blog_article-content-img-photo">
        </div>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <!-- article -->
            <article>
                <?php the_content(); ?>
            </article>
            <!-- /article -->
        <?php endwhile; ?>

        <?php else: ?>
            <!-- article -->
            <article>

                <h2><?php _e( 'Вибачте, немає публікацій для відображення.', THEME_OPT ); ?></h2>

            </article>
            <!-- /article -->
        <?php endif; ?>
    </div>
    <?php get_sidebar();?>


</section>
<?php else: ?>
 <main role="main" style="text-align: center;">
        <!-- section -->
        <section class='constitution'>

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                <!-- article -->
                <?php the_content(); // Dynamic Content ?>
                <!-- /article -->

            <?php endwhile; ?>

            <?php else: ?>

                <!-- article -->
                <article>

                    <h1><?php _e( 'Вибачте, немає публікацій для відображення.', THEME_OPT ); ?></h1>

                </article>
                <!-- /article -->

            <?php endif; ?>

        </section>
        <!-- /section -->
    </main>

<?php endif ?>
<?php get_footer(); ?>
