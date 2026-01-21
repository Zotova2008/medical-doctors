<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; the_posts_navigation(); else : ?>
                <p><?php esc_html_e( 'No posts found.', 'medical-doctors' ); ?></p>
            <?php endif; ?>
        </div>
    </main>
<?php get_footer();