    <?php global $mytheme, $post; ?>
            <!-- contact form -->
            <section class="contacts container">
                <?php do_action('show_contact_form',$mytheme['contact-shortcode']); ?>
            </section>
            <!-- contact form -->
			<!-- footer -->
            <footer class="container">
                <div class="footer-content">
                    <div class="footer-side">
                        <h2 class="blog-subheader"><b><?=$mytheme['text-head-left'] ?></b></h2>
                        <div class='footer-text'>
                            <p class='footer-text-content'><?=$mytheme['footer-text-left'] ?></p>
                            <div class='footer-text-contact'>
                                <p class='footer-text-content footer-text-bold'> <?=$mytheme['text-phone-num'] ?></p>
                                <p class='footer-text-content footer-text-bold'><?=$mytheme['text-email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-side">
                        <h2 class="blog-subheader"><b><?=$mytheme['text-head-right'] ?></b></h2>
                        <div class='footer-text'>
                            <p class='footer-text-content'><?=$mytheme['footer-text-right'] ?> </p>
                            <div class='footer-text-contact'>
                                <?php if (!empty($mytheme['footer-slides-list'])):
                                foreach ($mytheme['footer-slides-list'] as $item):
                                ?>
                                <a href="<?= $item['url']?>" class='footer-text-contact-link'><img src="<?= $item['image']?> " alt="<?= $item['title'] ?>" title="<?= $item['description'] ?>"></a>
                                <?php endforeach;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
			<!-- /footer -->
		</div>
		<!-- /wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>
