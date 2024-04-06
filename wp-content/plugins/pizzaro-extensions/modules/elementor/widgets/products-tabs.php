<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Tab Products  Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Tab_Products_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Tab Products  widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_tab_products';
    }

    /**
     * Get widget title.
     *
     * Retrieve Tab Products  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Tab Products ', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Tab Products  widget icon.
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
     * Retrieve the list of categories the Tab Products  widget belongs to.
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
     * Register Tab Products  widget controls.
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
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of products to display.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'column_val',
            [
                'label'         => esc_html__( 'Columns', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of cloumns to display.', 'pizzaro-extensions' ),
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
     * Render Tab Products  output on the frontend.
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

                extract( $tab );

                $shortcode_atts = function_exists( 'pizzaro_get_atts_for_shortcode' ) ? pizzaro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();
                $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) );

                $tabs_args[] = array(
                    'title'             => $title,
                    'shortcode_tag'     => $shortcode_tag,
                    'shortcode_atts'    => $shortcode_atts,
                );
            }
        }

        $limit      = $per_page;
        $columns    = $column_val;

        $args = array(
            'default_active_tab'=> empty( $default_active_tab ) ? 2 : $default_active_tab,
            'limit'             => $limit,
            'columns'           => $columns,
            'tabs'              => $tabs_args,
            'section_class'     => $el_class,
        );

        if( function_exists( 'pizzaro_products_tabs' ) ) {
            pizzaro_products_tabs( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Tab_Products_Block );