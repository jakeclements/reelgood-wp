<?php get_header(); ?>

<div class="container">

	<div class="row">

		<div class="col-12 column grid--12">

      <?php get_partial( 'breadcrumbs' ); ?>

    </div>

  </div>

	<div class="row">

		<div class="col-9 column grid--9">

			<h1 class="archive-title">Posts</h1>

			<div class="archive-content">

				<?php if( have_posts() ): ?>

					<?php while( have_posts() ): the_post(); ?>

						<?php get_template_part( 'template-parts/loop-single', get_post_type() ); ?>

					<?php endwhile; ?>

					<?php get_partial( 'pagination' ); ?>

				<?php else: ?>

					<?php get_partial( 'no-results' ); ?>

				<?php endif; ?>

			</div>

		</div>

		<div class="col-3 column grid--3">

			<?php get_sidebar(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>