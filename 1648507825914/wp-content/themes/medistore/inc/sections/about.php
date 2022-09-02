<?php
/**
 * Banner section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */
if ( ! function_exists( 'medistore_add_about_section' ) ) :
    /**
    * Add about section
    *
    *@since medistore 1.0.0
    */
    function medistore_add_about_section() {
    	$options = medistore_get_theme_options();
        // Check if about is enabled on frontpage
        $about_enable = apply_filters( 'medistore_section_status', true, 'about_section_enable' ) ;
        
        if ( true !== $about_enable ) {
            return false;
        }
        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'medistore_filter_about_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return ;
        }

        // Render about section now.
        medistore_render_about_section( $section_details );
    }
endif;

if ( ! function_exists( 'medistore_get_about_section_details' ) ) :
    /**
    * about section details.
    *
    * @since medistore 1.0.0
    * @param array $input about section details.
    */
    function medistore_get_about_section_details( $input ) {
        $options = medistore_get_theme_options();
        
        $content = array();
        $page_id = '';
        if ( ! empty( $options['about_content_page'] ) )
            $page_id = isset($options['about_content_page']) ? $options['about_content_page'] : '' ;
        $args = array(
            'post_type'             => 'page',
            'p'                     =>  absint( $page_id ),
            'ignore_sticky_posts'   => true,
            );
             

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['excerpt']   = medistore_trim_content($options['about_excerpt_length']);
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink( );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

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
// about section content details.
add_filter( 'medistore_filter_about_section_details', 'medistore_get_about_section_details' );


if ( ! function_exists( 'medistore_render_about_section' ) ) :
  /**
   * Start about section
   *
   * @return string about content
   * @since medistore 1.0.0
   *
   */
   function medistore_render_about_section( $content_details = array() ) {
        $options        = medistore_get_theme_options();
        $about_btn_alt_url = (!empty($options['about_btn_alt_url'])) ? $options['about_btn_alt_url'] : '';
        $about_video_url = (!empty($options['about_video_url'])) ? $options['about_video_url'] : '';
        
        if ( empty( $content_details ) ) {
            return;
        } ?>

        <?php $content = $content_details[0];?>

            <div id="about" class="relative page-section">
                <div class="wrapper">
                    <div class="about-content">
                        <div class="about-featured-image" 
                            style="background-image:url('<?php echo esc_url($content['image']); ?>');">
                        </div>
                    
                        <div class="about-content-wrapper">
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html($content['title']); ?></h2>
                            </header>
                            <div class="entry-content">
                                <p><?php echo wp_kses( $content['excerpt'],
                                                    array(
                                                        'a'      => array(
                                                            'href'  => array(),
                                                            'title' => array(),
                                                        ),
                                                        'br'     => array(),
                                                        'em'     => array(),
                                                        'strong' => array(),
                                                        'blockquote' => array(),
                                                    )
                                                ); ?>
                                </p>
                            </div><!-- .entry-content -->
                            <?php if(!empty($options['about_btn_txt']) && !empty($options['about_btn_alt_txt'])) :?>
                                <div class="read-more">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html($options['about_btn_txt']); ?></a>

                                    <?php if(!empty($options['about_btn_alt_txt']) && !empty($about_btn_alt_url)) :?>
                                        <a href="<?php echo esc_url( $about_btn_alt_url ); ?>" class="btn"><?php echo esc_html($options['about_btn_alt_txt']); ?></a>
                                    <?php endif; ?>
                                </div><!-- .read-more -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- .wrapper -->
            </div><!-- #about -->

    <?php
    }    
endif;
