<?php get_header(); ?>

	<main role="main wrapper" style="text-align: center;">
		<!-- section -->
		<section class="library">

			<!-- article -->
			<article id="post-404">

				<h1 style="color: #353535"><?php _e( 'Сторінка не знайдена', THEME_OPT ); ?></h1>
				<h2>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Повернутися на головну', THEME_OPT ); ?></a>
				</h2>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
