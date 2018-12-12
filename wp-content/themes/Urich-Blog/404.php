<?php get_header();
global $mytheme;?>

		<!-- section -->

                <section class="errors container">
                    <div class='errors-content'>
                        <img src="<?= $mytheme['404-img']['url']; ?>" alt="" class='errors-content-img'>
                        <img src="<?= $mytheme['raccoon-img']['url']; ?>" alt="" class='errors-content-raccoon'>
                    </div>
                    <p class='errors-text'><?php _e('There\'s no such page',THEME_OPT); ?></p>
                    <a class="content-btn btn btn-default" href="<?php echo home_url(); ?>"><?php _e('Go back',THEME_OPT); ?></a>
                </section>

		<!-- /section -->

<?php get_footer(); ?>
