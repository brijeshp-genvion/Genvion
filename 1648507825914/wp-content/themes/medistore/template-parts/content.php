<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

$options = medistore_get_theme_options();
?>
<article id="post-<?php the_ID(); ?>">
    <div class="post-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image">
                <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'medium_large' ) ?>" alt="<?php the_title_attribute(); ?>"></a>
            </div><!-- .featured-image -->
        <?php endif; ?>

       <div class="entry-container">
            <div class="entry-meta">
                <span class="cat-links">
                   <?php echo medistore_article_footer_meta( ); ?>
                </span><!-- .cat-links -->
            </div><!-- .entry-meta -->

            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>
            <div class="post-footer-meta">
                <?php echo medistore_author(); medistore_posted_on(); ?>
            </div><!-- .entry-meta -->
        </div><!-- .entry-container -->
    </div>
</article>
