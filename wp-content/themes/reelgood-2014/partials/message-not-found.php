<section class="message message--not-found">

  <h3>Oops! Nothing Found Here :(</h3>
  <p>
    The page you are looking for does not exist. (404)
  </p>
  <?php if (T4_ENABLE_SITE_SEARCH) : ?>
  <p>
    Try searching our site for what you are after.
  </p>
  <?php get_search_form(); ?>
  <?php endif; ?>

</section>