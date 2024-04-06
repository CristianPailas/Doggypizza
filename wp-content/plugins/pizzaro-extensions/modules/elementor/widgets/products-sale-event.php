<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Sale Event Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Products_Products_Sale_Event_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Sale Event widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_products_sale_event';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Sale Event widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Sale Event', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Sale Event widget icon.
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
     * Retrieve the list of categories the Products Sale Event widget belongs to.
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
     * Register Products Sale Event widget controls.
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
            'bg_image',
            [
                'label'         => esc_html__('Image', 'pizzaro-extensions'),
                'type'          => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'pre_title',
            [
                'label'         => esc_html__( 'Pre Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section pre title', 'pizzaro-extensions' ),
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
            'price',
            [
                'label'         => esc_html__( 'Price', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter price', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'price_info',
            [
                'label'         => esc_html__( 'Price Info', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter price info', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'product_ids',
            [
                'label'         => esc_html__( 'Product IDs', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label'         => esc_html__( 'Action Text', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter action text', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'action_link',
            [
                'label'         => esc_html__( 'Action Link', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '#',
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
     * Render Products Sale Event output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $bg_image   = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'pre_title'     => $pre_title,
            'section_title' => $title,
            'pre_title'     => $pre_title,
            'price'         => $price,
            'price_info'    => $price_info,
            'product_ids'   => $product_ids,
            'action_text'   => $action_text,
            'action_link'   => $action_link,
            'bg_image'      => $bg_image,
            'section_class' => $el_class,
        );

        if( function_exists( 'pizzaro_products_sale_event' ) ) {
            pizzaro_products_sale_event( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Products_Products_Sale_Event_Block );