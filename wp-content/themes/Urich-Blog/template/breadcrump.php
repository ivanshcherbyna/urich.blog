<?php 
global $mytheme, $post;
$homeLink = '/';
foreach ($mytheme['menu-repeater-items'] as $menuItem => $value) {
	if (strcasecmp($value['menu-title'], 'home') == 0){
		$homeLink = $value['menu-link'];
	}
}
$category_obj = get_the_category( $post->ID);
$category_name = $category_obj[0]->cat_name;
$category_id = $category_obj[0]->cat_ID;
$category_link = get_category_link( $category_id );
?>
<div class='container breadcrumb-blog'>
            <span class='breadcrumb-blog-item'><a class='breadcrumb-blog-item-link' href="<?= $homeLink ?>">Home </a>/ </span>
            <span class='breadcrumb-blog-item'><a class='breadcrumb-blog-item-link' href="/">Blog</a> / </span>
            <span class='breadcrumb-blog-item'><a class='breadcrumb-blog-item-link' href="<?= $category_link ?>"><?= $category_name ?></a></span>
</div>