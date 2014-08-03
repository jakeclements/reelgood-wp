<article <?php post_class('post-id' . get_the_ID()); ?>>

  <?php the_post_thumbnail( 'thumbnail' ); ?>

  <h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

  <?php the_content('Read more'); ?>

  <footer class="post-meta">

    <ul class="hl">
      <li><i class="icon-tag"></i> <?php echo get_the_term_list( false, 'category', '', ', ', '' ); ?></li>
      <li><i class="icon-time"></i> <?php the_date('d. m. y'); ?></li>
    </ul>

  </footer>

</article>