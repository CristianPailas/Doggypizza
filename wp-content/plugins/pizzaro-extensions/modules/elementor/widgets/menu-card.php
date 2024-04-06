<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Menu Card Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Menu_Card_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Menu Card Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_menu_card';
    }

    /**
     * Get widget title.
     *
     * Retrieve Menu Card Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Menu Card', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Menu Card Block widget icon.
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
     * Retrieve the list of categories the Menu Card Block widget belongs to.
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
     * Register Menu Card Block widget controls.
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
                'placeholder'   => esc_html__( 'Enter pre title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'menus',
            [
                'label'  => esc_html__( 'Menus', 'pizzaro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'title',
                        'label' => esc_html__( 'Title', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                    ],
                    [
                        'name'  => 'price',
                        'label' => esc_html__( 'Price', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                    ],
                    [
                        'name'  => 'description',
                        'label' => esc_html__( 'Description', 'pizzaro-extensions' ),
                        'type'  => Controls_Manager::TEXTAREA,
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
     * Render Menu Card output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if( is_object( $menus ) || is_array( $menus ) ) {
            $menus = json_decode( json_encode( $menus ), true );
        } else {
            $menus = json_decode( urldecode( $menus ), true );
        }

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'section_title'     => $title,
            'pre_title'         => $pre_title,
            'bg_image'          => $bg_image,
            'menus'             => $menus,
            'section_class'     => $el_class
        );

        if( function_exists( 'pizzaro_menu_card' ) ) {
            pizzaro_menu_card( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Menu_Card_Block );