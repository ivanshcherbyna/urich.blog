<?php global $mytheme, $post;
$category = $post->post_category;
if(is_array($category)) {
    arsort($category);
    $category = implode(',', $category);
}
$exclude_post_id = $post->ID;

echo '<input id="post_id_num" type="hidden" value="'.$post->ID.'"/>';

?>
<!-- sidebar -->
<?php get_template_part( 'template\tags', $name = null ); ?>
<div class="sidebar-list">
               
        <?php do_action('show_same_posts',-1, $exclude_post_id,'',3,true); ?>
    
</div>

<!--sidebar/ -->