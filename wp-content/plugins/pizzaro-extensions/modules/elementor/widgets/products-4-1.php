<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products 4-1 Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Products_4_1_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products 4-1 widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_products_4_1';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products 4-1 widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products 4-1', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products 4-1 widget icon.
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
     * Retrieve the list of categories the Products 4-1 widget belongs to.
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
     * Register Products 4-1 widget controls.
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
            'default_active_tab',
            [
                'label' => esc_html__( 'Default Active Tab', 'pizzaro-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '1',
                'placeholder' => esc_html__( 'Enter default active tab id.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Products Tabs Element', 'pizzaro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [

                    [
                        'name'  => 'title',
                        'label' => esc_html__( 'Title', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter tab title.', 'pizzaro-extensions'),
                    ],
                    [
                        'name'  => 'shortcode_tag',
                        'label' => esc_html__( 'Shortcode', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::SELECT,
                        'options'   => [
                            'featured_products'     => esc_html__( 'Featured Products','pizzaro-extensions'),
                            'sale_products'         => esc_html__( 'On Sale Products','pizzaro-extensions'),
                            'top_rated_products'    => esc_html__( 'Top Rated Products','pizzaro-extensions'),
                            'recent_products'       => esc_html__( 'Recent Products','pizzaro-extensions'),
                            'best_selling_products' => esc_html__( 'Best Selling Products','pizzaro-extensions'),
                            'product_category'      => esc_html__( 'Product Category','pizzaro-extensions'),
                            'products'              => esc_html__( 'Products','pizzaro-extensions')
                        ],
                        'default' => 'recent_products',
                    ],
                    [
                        'name'  => 'orderby',
                        'label' => esc_html__( 'Order by', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter orderby.', 'pizzaro-extensions'),
                        'default' => 'date',
                    ],
                    [
                        'name'  => 'order',
                        'label' => esc_html__( 'Order', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' =>esc_html__('Enter order', 'pizzaro-extensions' ),
                        'default' => 'DESC',
                    ],
                    [
                        'name'  => 'product_id',
                        'label' => esc_html__( 'Product IDs', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' =>esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'pizzaro-extensions' ),
                        'condition' => [
                            'shortcode_tag' => 'products',
                        ],
                    ],
                    [
                        'name'  => 'category',
                        'label' => esc_html__( 'Category', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter slug spearate by comma(,) Note: Only works with Product Category Shortcode.', 'pizzaro-extensions'),
                        'condition' => [
                            'shortcode_tag' => 'product_category',
                        ],
                    ],
                ],
                'default' => [],
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
     * Render Products 4-1 output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if( is_object( $tabs ) || is_array( $tabs ) ) {
            $tabs = json_decode( json_encode( $tabs ), true );
        } else {
            $tabs = json_decode( urldecode( $tabs ), true );
        }

        $tabs_args = array();
        
        if( is_array( $tabs ) ) {
            foreach ( $tabs as $key => $tab ) {

                extract(shortcode_atts(array(
                    'title'             => '',
                    'shortcode_tag'     => 'recent_products',
                    'orderby'           => 'date',
                    'order'             => 'desc',
                    'product_id'        => '',
                    'category'          => '',
                ), $tab));
                
                $shortcode_atts = function_exists( 'pizzaro_get_atts_for_shortcode' ) ? pizzaro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

                $tabs_args[] = array(
                    'title'             => $title,
                    'shortcode_tag'     => $shortcode_tag,
                    'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) ),
                );
            }
        }

        $args = array(
            'default_active_tab'=> empty( $default_active_tab ) ? 3 : $default_active_tab,
            'tabs'              => $tabs_args,
            'section_class'     => $el_class,
        );

        if( function_exists( 'pizzaro_products_4_1_tabs_block' ) ) {
            pizzaro_products_4_1_tabs_block( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Products_4_1_Block );