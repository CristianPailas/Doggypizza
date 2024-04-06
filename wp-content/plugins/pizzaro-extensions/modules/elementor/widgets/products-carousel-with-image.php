<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Carousel with Image Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Products_Carousel_With_Image_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Carousel with Image widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_products_carousel_with_image';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Carousel with Image widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Carousel with Image', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Carousel with Image widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-plug';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Products Carousel with Image widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'pizzaro-elements' ];
    }

    /**
     * Register Products Carousel with Image widget controls.
     *
     * ads different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label'     => esc_html__( 'Content', 'pizzaro-extensions' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'         => esc_html__( 'Sub Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section sub title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode_tag',
            [
                'label' => esc_html__( 'Shortcode Tags', 'pizzaro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'default' => 'recent_products',
                'options' => [
                    'featured_products'     => esc_html__( 'Featured Products','pizzaro-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','pizzaro-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','pizzaro-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','pizzaro-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','pizzaro-extensions'),
                    'product_category'      => esc_html__( 'Product Category','pizzaro-extensions'),
                    'products'              => esc_html__( 'Products','pizzaro-extensions')
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '6',
                'placeholder'   => esc_html__( 'Enter the number of products to display.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'         => esc_html__( 'Columns', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of cloumns to display.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'title',
                'placeholder'   => esc_html__( 'Enter orderby value', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'ASC',
                'placeholder'   => esc_html__( 'Enter order value', 'pizzaro-extensions' ),
            ]
        );
        
        $this->add_control(
            'product_id',
            [
                'label' => esc_html__( 'Product IDs or SKUs', 'pizzaro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter IDs/SKUs separate by comma(,).', 'pizzaro-extensions'),
                'condition' => [
                    'shortcode_tag' => 'products',
                ],
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__( 'Category', 'pizzaro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the category.', 'pizzaro-extensions'),
                'condition' => [
                    'shortcode_tag' => 'product_category',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'         => esc_html__('Image', 'pizzaro-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label'         => esc_html__('Background Image', 'pizzaro-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'cat_orderby',
            [
                'label'         => esc_html__( 'Category Orderby', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'title',
                'placeholder'   => esc_html__( 'Enter orderby.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'cat_order',
            [
                'label'         => esc_html__( 'Category Order', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'ASC',
                'placeholder'   => esc_html__( 'Enter order.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'cat_limit',
            [
                'label'         => esc_html__( 'Category Limit', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of categories to display.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'cat_hide_empty',
            [
                'label'     => esc_html__( 'Category Hide empty?', 'pizzaro-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'pizzaro-extensions' ),
                'label_off'     => esc_html__( 'Show', 'pizzaro-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Check to hide empty categories.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'cat_slugs',
            [
                'label'         => esc_html__( 'Category Slugs', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter slug spearate by comma(,).', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter extra class name', 'pizzaro-extensions' ),
            ]
        );

    $this->end_controls_section();

    }

    /**
     * Render Products Carousel with Image output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $image      = isset( $image['id'] ) ? wp_get_attachment_image_src ($image['id'], 'full' ) : '';
        $bg_image   = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $shortcode_atts = function_exists( 'pizzaro_get_atts_for_shortcode' ) ? pizzaro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
            'section_title'     => $title,
            'sub_title'         => $sub_title,
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) ),
            'limit'             => $limit,
            'columns'           => $columns,
            'image'             => $image,
            'bg_image'          => $bg_image,
            'section_class'     => $el_class,
            'category_args'         => array(
                'orderby'               => $cat_orderby,
                'order'                 => $cat_order,
                'hide_empty'            => $cat_hide_empty,
                'number'                => $cat_limit,
                'slugs'                  => $cat_slugs,
                'hierarchical'          => false
            ),
            'carousel_args' => array(
                'items'             => $columns,
                'nav'               => true,
                'slideSpeed'        => 300,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'paginationSpeed'   => 400,
                'navText'           => is_rtl() ? array( '<i class="po po-arrow-right-slider"></i>', '<i class="po po-arrow-left-slider"></i>' ) : array( '<i class="po po-arrow-left-slider"></i>', '<i class="po po-arrow-right-slider"></i>' ),
                'margin'            => 0,
                'touchDrag'         => true,
                'responsive'        => array(
                    '0'     => array( 'items'   => 1 ),
                    '480'   => array( 'items'   => 3 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => $columns ),
                )
            )
        );

        if( function_exists( 'pizzaro_products_carousel_with_image' ) ) {
            pizzaro_products_carousel_with_image( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Products_Carousel_With_Image_Block );