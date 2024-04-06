<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Product_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_product';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product widget icon.
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
     * Retrieve the list of categories the Product widget belongs to.
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
     * Register Product widget controls.
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
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'product_id',
            [
                'label'         => esc_html__( 'Product ID', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section title', 'pizzaro-extensions' ),
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
     * Render Product output on the frontend.
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
            'section_title'     => $title,
            'bg_image'          => $bg_image,
            'product_id'        => $product_id,
            'section_class'     => $el_class
        );

        if( function_exists( 'pizzaro_product' ) ) {
            pizzaro_product( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Product_Block );