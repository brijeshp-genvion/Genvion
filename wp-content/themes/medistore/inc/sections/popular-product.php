<?php
/**
 * Product section
 *
 * This is the template for the content of popular_product section
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */
if ( ! function_exists( 'medistore_add_popular_product_section' ) ) :
    /**
    * Add popular_product section
    *
    *@since medistore 1.0.0
    */
    function medistore_add_popular_product_section() {
    	$options = medistore_get_theme_options();
        // Check if popular_product is enabled on frontpage
        $popular_product_enable = apply_filters( 'medistore_section_status', true, 'popular_product_section_enable' );

        if ( true !== $popular_product_enable) {
            return false;
        }
        // Get popular_product section details
        $section_details = array();
        $section_details = apply_filters( 'medistore_filter_popular_product_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }

        // Render popular_product section now.
        medistore_render_popular_product_section( $section_details );
    }
endif;

if ( ! function_exists( 'medistore_get_popular_product_section_details' ) ) :
    /**
    * popular_product section details.
    *
    * @since medistore 1.0.0
    * @param array $input popular_product section details.
    */
    function medistore_get_popular_product_section_details( $input ) {
        $options = medistore_get_theme_options();

        // Content type.
        $popular_product_content_type  = $options['popular_product_content_type'];

        $args = array();
        switch ( $popular_product_content_type ) {


            case 'product-category':
                $cat_ids = ! empty( $options['popular_product_content_product_category'] ) ? $options['popular_product_content_product_category'] : array();
              
                if ( empty( $cat_ids ) )
                    return;

                foreach ( $cat_ids as $cat_id ) :
                
                    $category_args = array(
                    'post_type'         => 'product',
                    'posts_per_page'    => absint( 6 ),
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'product_cat',
                            'field'     => 'id',
                            'terms'     => $cat_id
                        )
                    ) );
                    array_push( $args, $category_args );
                endforeach;                  

            break;

            case 'category':
                $cat_ids = ! empty( $options['popular_product_category'] ) ? $options['popular_product_category'] : array();

                if ( empty( $cat_ids ) )
                    return;

                foreach ( $cat_ids as $cat_id ) :
                    $category_args = array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 6,
                        'cat'               => absint( $cat_id ),
                        'ignore_sticky_posts'   => true,
                        );
                    array_push( $args, $category_args );
                endforeach;                  
            break;


            default:
            break;
        }

        $i = 0;
        $content = array();
        foreach ( $args as $arg ) :

            // Run The Loop.
            $query = new WP_Query( $arg );
            if ( $query->have_posts() ) : 
                $details = [];
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = medistore_trim_content( 20 );
                    $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

                    // Push to the main array.
                    array_push( $details, $page_post );
                endwhile;
                $cat_id = ($popular_product_content_type == 'category') ? $arg['cat'] : $arg['tax_query'][0]['terms'];
                array_push( $content, array('cat_id'=> $cat_id, 'details'=> $details) );
            endif;
            wp_reset_postdata();
            $i++;
        endforeach;

    
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// popular_product section content details.
add_filter( 'medistore_filter_popular_product_section_details', 'medistore_get_popular_product_section_details' );


if ( ! function_exists( 'medistore_render_popular_product_section' ) ) :
  /**
   * Start popular_product section
   *
   * @return string popular_product content
   * @since medistore 1.0.0
   *
   */
   function medistore_render_popular_product_section( $content_details = array() ) {
        $options = medistore_get_theme_options();
        $popular_product_content_type  = $options['popular_product_content_type'];
        $popular_product_btn_url = (!empty($options['popular_product_btn_url'])) ? $options['popular_product_btn_url'] : '';

        if ( empty( $content_details ) ) {
            return;
        }  ?>

            <div id="product" class="relative page-section">
                <div class="wrapper">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['popular_product_title'] ); ?></h2>
                    </div><!-- .section-header --> 
                    
                    <div class="section-content">
                        <div class="product-filtering">
                            <ul class="product-nav">
                                <?php foreach ( $content_details as $i=>$content ): $terms = get_term( $content['cat_id'] ); ?>
                                    <li <?php if($i==0) echo 'class="active"'; ?>><a href="#" data-tab="<?php echo $terms->slug; ?>"><?php echo $terms->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- .product-filtering -->

                        <div class="product-wrapper">
                            
                        <?php foreach ( $content_details as $i=>$contents ): $terms = get_term( $contents['cat_id'] ); ?>
                            <div id="<?php echo $terms->slug; ?>" class="tab-content <?php if($i==0) echo 'active'; ?> clear">  
                                <ul class="products col-4 container">
                                    <?php foreach ( $contents['details'] as $content ):
                                        if($popular_product_content_type == 'product-category' && class_exists('WooCommerce') ) $popular_product = new WC_Product( $content['id'] ); ?>
                                    <li class="product featured-products ">
                                        <a href="<?php echo esc_url($content['url'] ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <img src="<?php echo esc_url( $content['image'] ) ?>">
                                            <h2 class="woocommerce-loop-product__title"><?php echo esc_html( $content['title'] ); ?></h2>
                                        </a>
                                        <?php if($popular_product_content_type == 'product-category' && class_exists('WooCommerce')) : ?>
                                        <div class="product_meta"><a href="#" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <span class="posted_in">
                                                <?php echo wc_get_product_category_list($content['id']); ?>
                                            </span>
                                            <!-- .posted_in -->
                                                <span class="price"><?php echo $popular_product->get_price_html(); ?></span>
                                        </div><!-- .product-meta -->
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- .tab-content -->
                        <?php endforeach; ?>

                        </div><!-- .product-wrapper -->
                        <?php if(!empty($options['popular_product_btn_title']) && !empty($popular_product_btn_url)): ?>
                            <div class="read-more">
                                <a href="<?php echo esc_url($popular_product_btn_url); ?>" class="btn"><?php echo esc_html( $options['popular_product_btn_title'] ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- #product-->

    <?php }
endif;     