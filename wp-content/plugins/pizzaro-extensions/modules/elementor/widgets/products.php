<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Products_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_products';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products widget icon.
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
     * Retrieve the list of categories the Products widget belongs to.
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
     * Register Products widget controls.
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
                'default'       => '4',
                'placeholder'   => esc_html__( 'Enter the number of products to display.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'         => esc_html__( 'Columns', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '4',
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
     * Render Products output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $shortcode_atts = function_exists( 'pizzaro_get_atts_for_shortcode' ) ? pizzaro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
            'section_title'     => $title,
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) ),
            'limit'             => $limit,
            'columns'           => $columns,
            'section_class'     => $el_class
        );

        if( function_exists( 'pizzaro_products' ) ) {
            pizzaro_products( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Products_Block );