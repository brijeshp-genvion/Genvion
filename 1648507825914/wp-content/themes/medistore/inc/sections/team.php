<?php
/**
 * Team section
 *
 * This is the template for the content of team section
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */
if ( ! function_exists( 'medistore_add_team_section' ) ) :
    /**
    * Add team section
    *
    *@since  medistore 1.0.0
    */
    function medistore_add_team_section() {
    	$options = medistore_get_theme_options();
        // Check if team is enabled on frontpage
        $team_enable = apply_filters( 'medistore_section_status', true, 'team_section_enable' );

        
        if ( true !== $team_enable ) {
            return false;
        }
        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'medistore_filter_team_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render team section now.
        medistore_render_team_section( $section_details );
    }
endif;

if ( ! function_exists( 'medistore_get_team_section_details' ) ) :
    /**
    * team section details.
    *
    * @since  medistore 1.0.0
    * @param array $input team section details.
    */
    function medistore_get_team_section_details( $input ) {
        $options = medistore_get_theme_options();

        $team_count = 3;

        $content = array();

        $page_ids = array();
        $position = array();

        for ( $i = 1; $i <= absint($team_count); $i++ ) {
            if ( ! empty( $options['team_content_page_' . $i] ) ) :
                $page_ids[] = $options['team_content_page_' . $i];
            endif;
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint($team_count),
            'orderby'           => 'post__in',
            );                    


        $query = new WP_Query( $args );
        $i = 1;
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['position']  = (! empty(  $options['team_position_' . $i] ) ) ?  $options['team_position_' . $i] : '';
                $page_post['social']    = (! empty( $options['team_social_' . $i] ) ) ? $options['team_social_' . $i] : '';
                $page_post['url']       = get_the_permalink();
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnails' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';
                $page_post['excerpt']   = medistore_trim_content($options['slider_excerpt_length']);

                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// team section content details.
add_filter( 'medistore_filter_team_section_details', 'medistore_get_team_section_details' );


if ( ! function_exists( 'medistore_render_team_section' ) ) :
  /**
   * Start team section
   *
   * @return string team content
   * @since  medistore 1.0.0
   *
   */
   function medistore_render_team_section( $content_details = array() ) {
        $options = medistore_get_theme_options();
        $column = ! empty( $options['team_column'] ) ? $options['team_column'] : 'col-3';

        if ( empty( $content_details ) ) {
            return;
        } ?>

            <div id="team" class="relative page-section">
                <div class="wrapper">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['team_title'] ); ?></h2>
                        <p class="section-content"><?php echo esc_html( $options['team_description'] ); ?></p>
                    </div><!-- .section-header -->  

                    <div class="team-slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":true, "autoplay": false, "draggable": true, "fade": false }' >

                        <?php foreach ( $content_details as $content ) : ?>

                        <article>
                            <div class="team-item">
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php esc_attr( $content['title'] ); ?>"></a>
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        <?php if(!empty($content['position'])) echo '<span class="position-position">'.esc_html( $content['position'] ).'</span>'; ?>
                                    </header>
                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post($content['excerpt']); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- .entry-container -->

                                <?php
                                    if ( ! empty( $content['social'] ) ) : 
                                        $social = explode( '|', $content['social'] ); ?>
                                        <div class="social-icons">
                                            <ul>
                                                <?php foreach( $social as $social_link ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $social_link ); ?>">
                                                        <?php echo medistore_return_social_icon( $social_link ); ?>
                                                    </a>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                            </div><!-- .team-item -->
                        </article>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div><!-- #team-->

    <?php }
endif;