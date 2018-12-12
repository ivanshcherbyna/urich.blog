<?php
global $post;
$tags = wp_get_post_tags($post->ID);
if ($tags): ?>
<nav class="article-tabs">
	<?php foreach($tags as $key => $value ): ?>
                    <a href="<?= $value->term_id ?>" class="article-tabs-tab" data-filter=""><?= $value->name ?></a>
                <?php endforeach; ?>
</nav>
<?php endif; ?>