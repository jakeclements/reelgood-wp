<?php
/*
Template Name: Archives
*/
get_header(); ?>

<?php include(locate_template('partials/message-bar.php')); ?>

<div class="home-post-list archive row">

    <div class="column medium-8 home-featured-posts page-content">

        <h2 class="category-title">All Posts</h2>

        <?php if (have_posts()) : while (have_posts()) : the_post();

            $title = get_the_title();
            $excerpt = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
            $permalink = get_permalink();
            $thumbnail = catch_first_image( get_the_ID() );
            $date = get_the_time( 'l, n M', $post->ID );
            $author_id = $post->post_author;
            $author_nickname = get_the_author_meta('nickname', $author_id);
            $author_link = get_author_posts_url( $author_id );

            if( get_field('author_name', $post->ID) ){
                $author_nickname = get_field('author_name', $p->ID);
            }

            include(locate_template('partials/archive/post-display.php'));

        endwhile; endif; ?>

    </div>

    <div class="column medium-4 home-sidebar sidebar">

        <?php get_sidebar(); ?>

    </div>

    <div class="column medium-12">
        <div class="pagination">
            <?php wp_pagenavi(); ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>