<!-- sidebar -->


<?php global $mytheme, $post;
$category = $post->post_category;
if(is_array($category)) {
    arsort($category);
    $category = implode(',', $category);
}
$exclude_post_id = $post->ID;

$share_social_gl = !empty(get_post_meta(get_queried_object_id(),'google_plus_count',true))?get_post_meta($post->ID,'google_plus_count',true) : 0;
$share_social_fb = !empty(get_post_meta($post->ID,'facebook_count',true))?get_post_meta($post->ID,'facebook_count',true) : 0;
$share_social_tw = !empty(get_post_meta($post->ID,'twitter_count',true))?get_post_meta($post->ID,'twitter_count',true) : 0;
echo '<input id="post_id_num" type="hidden" value="'.$post->ID.'"/>';

?>

<div class="blog_article-sidebar">
    <h2 class="blog_article-sidebar-header">Поширити</h2>
    <div class="blog_article-sidebar-social">
        <div class="blog_article-sidebar-social-item">
            <a id="share_btn_gl" href="https://plus.google.com/share?url=<?= get_the_permalink()?>" class="blog_article-sidebar-social-item-link" target="_blank"><img src="/inc/urich/img/google-plus.png" alt="#"></a>
            <div class="blog_article-sidebar-social-item-num"><?= $share_social_gl ?></div>
        </div>
        <div class="blog_article-sidebar-social-item">
            <a id="share_btn_fb" href="https://www.facebook.com/sharer?u=<?= get_permalink()?>" class="blog_article-sidebar-social-item-link" title="Share on Facebook" target="_blank"><img src="/inc/urich/img/shape.png" alt="#"></a>
            <div class="blog_article-sidebar-social-item-num"><?= $share_social_fb ?></div>
        </div>
        <div class="blog_article-sidebar-social-item">
            <a id="share_btn_tw" href="https://twitter.com/home?status=' <?= get_the_permalink()?> '" class="blog_article-sidebar-social-item-link" target="_blank"><img src="/inc/urich/img/twitter.png" alt="#"></a>
            <div class="blog_article-sidebar-social-item-num"><?= $share_social_tw ?></div>
        </div>
    </div>
    <h2 class="blog_article-sidebar-header">Схожі дописи</h2>
    <div class="blog_article-sidebar-content">
        <?php do_action('show_same_posts',$category, $exclude_post_id); ?>
    </div>
</div>




<!-- /sidebar -->