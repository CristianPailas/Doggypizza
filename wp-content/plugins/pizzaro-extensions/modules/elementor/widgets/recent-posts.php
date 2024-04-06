<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Recent Posts Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Pizzaro_Elementor_Pizzaro_Recent_Posts_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Recent Posts widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'pizzaro_elementor_pizzaro_recent_posts';
    }

    /**
     * Get widget title.
     *
     * Retrieve Recent Posts widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Recent Posts', 'pizzaro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Recent Posts widget icon.
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
     * Retrieve the list of categories the Recent Posts widget belongs to.
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
     * Register Recent Posts widget controls.
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
            'pre_title',
            [
                'label'         => esc_html__( 'Pre Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter pre title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'         => esc_html__( 'Title', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter section title', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'post_choice',
            [
                'label' => esc_html__( 'Choice', 'pizzaro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent'    => esc_html__( 'Recent','pizzaro-extensions'),
                    'random'    => esc_html__( 'Random','pizzaro-extensions'),
                    'specific'  => esc_html__( 'Specific','pizzaro-extensions'),
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
                'placeholder'   => esc_html__( 'Enter the number of posts to display.', 'pizzaro-extensions' ),
            ]
        );
        
        $this->add_control(
            'ids',
            [
                'label'         => esc_html__( 'IDs', 'pizzaro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter id spearate by comma(,) Note: Only works with specific choice.', 'pizzaro-extensions'),
                'condition'     => [
                    'post_choice' => 'specific',
                ],
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'     => esc_html__( 'Show Read More', 'pizzaro-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'pizzaro-extensions' ),
                'label_off'     => esc_html__( 'Show', 'pizzaro-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Check to show Read More.', 'pizzaro-extensions' ),
            ]
        );

        $this->add_control(
            'show_comment_link',
            [
                'label'     => esc_html__( 'Show Comment Link', 'pizzaro-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'pizzaro-extensions' ),
                'label_off'     => esc_html__( 'Show', 'pizzaro-extensions' ),
                'return_value'  => true,
                'default'       => false,
                'placeholder'   => esc_html__( 'Check to show comment link.', 'pizzaro-extensions' ),
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
     * Render Recent Posts output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'section_title'         => $section_title,
            'pre_title'             => $pre_title,
            'post_choice'           => $post_choice,
            'post_id'               => $ids,
            'limit'                 => $limit,
            'show_read_more'        => $show_read_more,
            'show_comment_link'     => $show_comment_link,
            'section_class'         => $el_class,
        );

        if( function_exists( 'pizzaro_recent_posts' ) ) {
            pizzaro_recent_posts( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Pizzaro_Elementor_Pizzaro_Recent_Posts_Block );