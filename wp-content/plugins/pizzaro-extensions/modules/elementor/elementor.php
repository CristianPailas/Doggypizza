<?php

/**
 * Module Name          : Elementor Addons
 * Module Description   : Provides additional Elementor Elements for the pizzaro theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Pizzaro_Elementor_Extensions' ) ) {
    final class Pizzaro_Elementor_Extensions {

        /**
         * Pizzaro_Extensions The single instance of Pizzaro_Extensions.
         * @var     object
         * @access  private
         * @since   1.0.0
         */
        private static $_instance = null;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  20 );
        }

        /**
         * Pizzaro_Elementor_Extensions Instance
         *
         * Ensures only one instance of Pizzaro_Elementor_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @return Pizzaro_Elementor_Extensions instance
         */
        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Setup plugin constants
         *
         * @access public
         * @since  1.0.0
         * @return void
         */
        public function setup_constants() {

            // Plugin Folder Path
            if ( ! defined( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR' ) ) {
                define( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_URL' ) ) {
                define( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE' ) ) {
                define( 'PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE', __FILE__ );
            }
        }

        /**
         * Widget Category Register
         *
         * @since  1.0.0
         * @access public
         */
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'pizzaro-elements',
                [
                    'title' => esc_html__( 'Pizzaro Elements', 'pizzaro-extensions' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }

        /**
         * Widgets
         *
         * @since  1.0.0
         * @access public
         */
        public function elementor_widgets() {
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/banner.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/coupon.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/events.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/features-list.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/menu-card.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/newsletter.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-categories.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-card.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-with-image.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-sale-event.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/recent-post.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/recent-posts.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/sale-product.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/store-search.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-4-1.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-with-gallery.php';
            require_once PIZZARO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-tabs.php';
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Pizzaro_Elementor_Extensions::instance();
}