<?php

get_header();

the_post();

?>

<div class="container">

	<div class="row">

    <div class="col-12 column grid--12">

      <?php get_partial( 'breadcrumbs' ); ?>

    </div>

  </div>

	<div class="row">

		<div class="col-9 column grid--9">

			<article <?php post_class('post-id-' . get_the_ID()); ?>>

				<h1 class="post-title"><?php the_title(); ?></h1>

				<?php the_content(); ?>

				<footer class="post-meta">

					<ul class="hl">
						<li><i class="icon-tag"></i> <?php echo get_the_term_list( false, 'category', '', ', ', '' ); ?></li>
						<li><i class="icon-time"></i> <?php the_date('d. m. y'); ?></li>
					</ul>

				</footer>

				<?php comments_template(); ?>

			</article>

		</div>

		<div class="col-3 column grid--3">

			<?php get_sidebar(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>