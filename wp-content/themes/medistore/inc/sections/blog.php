<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */
if ( ! function_exists( 'medistore_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since  medistore 1.0.0
    */
    function medistore_add_blog_section() {
        $options = medistore_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'medistore_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'medistore_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render blog section now.
        medistore_render_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'medistore_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since  medistore 1.0.0
    * @param array $input blog section details.
    */
    function medistore_get_blog_section_details( $input ) {
        $options = medistore_get_theme_options();

        // Content type.
        $blog_content_type  = $options['blog_content_type'];
        $blog_count = 3;
        
        
        $content = array();
        switch ( $blog_content_type ) {
            
            case 'post':
                $post_ids = array();

                for ( $i = 1; $i <= $blog_count; $i++ ) {
                    if ( ! empty( $options['blog_content_post_' . $i] ) )
                        $post_ids[] = $options['blog_content_post_' . $i];
                }
                
                $args = array(
                    'post_type'             => 'post',
                    'post__in'              => ( array ) $post_ids,
                    'posts_per_page'        => absint( $blog_count ),
                    'orderby'               => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'category':
                $cat_id = ! empty( $options['blog_content_category'] ) ? $options['blog_content_category'] : '';
                $args = array(
                    'post_type'             => 'post',
                    'posts_per_page'        => absint( $blog_count ),
                    'cat'                   => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            default:
            break;
        }

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = medistore_trim_content( $options['blog_excerpt_length']);
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';
                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// blog section content details.
add_filter( 'medistore_filter_blog_section_details', 'medistore_get_blog_section_details' );


if ( ! function_exists( 'medistore_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since  medistore 1.0.0
   *
   */
   function medistore_render_blog_section( $content_details = array() ) {
        $options                = medistore_get_theme_options();
        $blog_btn_url = (!empty($options['blog_btn_url'])) ? $options['blog_btn_url'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>

            <div id="articles-section" class="relative page-section same-background">
                <div class="wrapper">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html($options['blog_title'])?></h2>
                    </div><!-- .section-header -->

                    <div class="archive-blog-wrapper <?php echo esc_attr( $options['blog_column_layout'] ); ?> clear">
                    <?php foreach($content_details as $content): ?>

                        <article>
                            <div class="post-wrapper">
                                <div class="featured-image">
                                    <a href="<?php echo esc_url($content['url']); ?>"><img src="<?php echo esc_url($content['image']);?>" alt="<?php echo esc_attr($content['title']); ?>"></a>
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="cat-links"><?php the_category('', '', $content['id'])?></span><!-- .cat-links -->
                                    </div><!-- .entry-meta -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>" tabindex="0"><?php echo esc_html($content['title']); ?></a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post($content['excerpt']);?></p>
                                    </div><!-- .entry-content -->

                                    <div class="post-footer-meta">
                                        <?php echo medistore_author($content['id']); medistore_posted_on($content['id']); ?>
                                    </div><!-- .entry-meta -->
                                </div><!-- .entry-container -->
                            </div><!-- .post-wrapper -->
                        </article>
                        <?php endforeach; ?>

                    </div><!-- .section-content -->
                    <div class="articles-button">
                        <?php if(!empty($options['blog_appointment_date_enable'])) : ?>
                            <?php if(!empty($options['blog_appointment_day'])) : ?>
                                <div class="read-more">
                                    <a class="btn">
                                        <svg viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                                            <path d="M119.467,0C110.041,0,102.4,7.641,102.4,17.067V51.2h34.133V17.067C136.533,7.641,128.892,0,119.467,0z"></path>
                                            <path d="M358.4,0c-9.426,0-17.067,7.641-17.067,17.067V51.2h34.133V17.067C375.467,7.641,367.826,0,358.4,0z"></path>
                                            <path d="M426.667,51.2h-51.2v68.267c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2h-204.8v68.267
                                                c0,9.426-7.641,17.067-17.067,17.067s-17.067-7.641-17.067-17.067V51.2H51.2C22.923,51.2,0,74.123,0,102.4v324.267
                                                c0,28.277,22.923,51.2,51.2,51.2h375.467c28.277,0,51.2-22.923,51.2-51.2V102.4C477.867,74.123,454.944,51.2,426.667,51.2z
                                                M443.733,426.667c0,9.426-7.641,17.067-17.067,17.067H51.2c-9.426,0-17.067-7.641-17.067-17.067V204.8h409.6V426.667z"></path>
                                            <path d="M353.408,243.942c-6.664-6.669-17.472-6.672-24.141-0.009L204.8,368.401l-56.201-56.201
                                                c-6.669-6.664-17.477-6.66-24.141,0.009c-6.664,6.669-6.66,17.477,0.009,24.141l68.267,68.267c6.665,6.663,17.468,6.663,24.132,0
                                                L353.4,268.083C360.068,261.419,360.072,250.611,353.408,243.942z"></path>
                                        </svg>
                                    <span><?php echo esc_html($options['blog_appointment_day']); ?></span></a>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($options['blog_appointment_description'])) : ?>
                                <div class="entry-content">
                                    <p><?php echo wp_kses_post($options['blog_appointment_description']); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($options['blog_btn_title']) && !empty($blog_btn_url)): ?>
                            <div class="read-more">
                                <a href="<?php echo esc_url($blog_btn_url); ?>" class="btn"><?php echo esc_html( $options['blog_btn_title'] ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div><!-- .wrapper -->
            </div><!-- #articles-section -->
<?php }
endif;  ?>