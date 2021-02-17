<?php
/**
 * Plugin Name: Dynamic Text Quiz
 * Plugin URI: https://www.scintelligencia.com/
 * Description:
 * Version: 1.0
 * Tags: 
 * Author: SCI Intelligencia
 * Author URI: http://scintelligencia.com/
 * Author Email: sciintelligencia@gmail.com
 * Requires at least: WP 4.8
 * Tested up to: WP 5.6
 * Text Domain: dynamic-text-quiz
 * Domain Path: /lang
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Dynamic Text Quiz
 * @author SCI Intelligencia
 * @version 1.0
 * @link http://scintelligencia.com/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('DTQPlugin') ) {
    class DTQPlugin
    {
        /**
         * StarterPlugin constructor.
         * @since 1.0
         * @version 1.0
         */
        public function __construct()
        {
            $this->run();
        }

        /**
         * Runs Plugins
         * @since 1.0
         * @version 1.0
         */
        public function run()
        {
            $this->constants();
            $this->includes();
            $this->add_actions();
            $this->register_hooks();
        }

        /**
         * @param $name Name of constant
         * @param $value Value of constant
         * @since 1.0
         * @version 1.0
         */
        public function define($name, $value)
        {
            if (!defined($name))
                define($name, $value);
        }

        /**
         * Defines Constants
         * @since 1.0
         * @version 1.0
         */
        public function constants()
        {
            $this->define('DTQ_VERSION', '1.0');
            $this->define('DTQ_PREFIX', 'dtq_');
            $this->define('DTQ_TEXT_DOMAIN', 'dynamic-text-quiz');
            $this->define('DTQ_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
            $this->define('DTQ_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
        }

        /**
         * Require File
         * @since 1.0
         * @version 1.0
         */
        public function file( $required_file ) {
            if ( file_exists( $required_file ) )
                require_once $required_file;
            else
                echo 'File Not Found';
        }

        /**
         * Include files
         * @since 1.0
         * @version 1.0
         */
        public function includes()
        {
            $this->file(DTQ_PLUGIN_DIR_PATH. 'includes/dynamic-text-quiz-functions.php');
        }

        /**
         * Enqueue Styles and Scripts
         * @since 1.0
         * @version 1.0
         */
        public function enqueue_scripts()
        {
            wp_enqueue_style(DTQ_TEXT_DOMAIN . '-css', DTQ_PLUGIN_DIR_URL . 'assets/css/style.css', [], DTQ_VERSION, 'all');
            wp_enqueue_script(DTQ_TEXT_DOMAIN . '-custom-js', DTQ_PLUGIN_DIR_URL . 'assets/js/custom.js', ['jquery'], DTQ_VERSION, true);
        }

        /**
         * Adds Admin Page in Dashboard
         * @since 1.0
         * @version 1.0
         */
        public function add_menu()
        {
            add_menu_page(
                __( 'Dynamic Text Quiz', DTQ_TEXT_DOMAIN ),
                'Dynamic Text Quiz',
                'manage_options',
                DTQ_TEXT_DOMAIN . '-home',
                [$this, 'home'],
                'dashicons-admin-site-alt2'
            );

            add_submenu_page(
	            DTQ_TEXT_DOMAIN. "-home",
	            __( 'Dynamic Text Quiz', DTQ_TEXT_DOMAIN ),
	            'Dynamic Text Quiz',
	            'manage_options',
	            DTQ_TEXT_DOMAIN . '-home',
	            [$this, 'home']
            );

            add_submenu_page(
	            DTQ_TEXT_DOMAIN. "-home",
	            __("Display All Text", DTQ_TEXT_DOMAIN),
	            "Display All Text",
	            "manage_options",
	            DTQ_TEXT_DOMAIN. "-all-text",
	            [$this, "display_text"]
            );
        }

        public function display_text()
        {
        	require_once DTQ_PLUGIN_DIR_PATH . "templates/display-all-text.php";
        }

        /**
         * Home page of Plugin
         * @since 1.0
         * @version 1.0
         */
        public function home()
        {
			return require_once DTQ_PLUGIN_DIR_PATH . "templates/home.php";
        }

        /**
         * Add Actions
         * @since 1.0
         * @version 1.0
         */
        public function add_actions()
        {
            add_action('init', [$this, 'enqueue_scripts']);
	        add_action('init', [$this, 'add_shortcodes']);
	        add_action('admin_menu', [$this, 'add_menu']);
        }

        public function add_shortcodes()
        {
        	add_shortcode( "dynamic_text", [ $this, "dynamic_text" ] );
        }

        public function dynamic_text()
        {

        	require_once DTQ_PLUGIN_DIR_PATH . "templates/dynamic-text.php";
        }

        /**
         * Register Activation, Deactivation and Uninstall Hooks
         * @since 1.0
         * @version 1.0
         */
        public function register_hooks()
        {
            register_activation_hook( __FILE__, [$this, 'activate'] );
            register_deactivation_hook( __FILE__, [$this, 'deactivate'] );
            register_uninstall_hook(__FILE__, 'pluginprefix_function_to_run');
        }

        /**
         * Runs on Plugin's activation
         * @since 1.0
         * @version 1.0
         */
        public function activate()
        {

        }

        /**
         * Runs on Plugin's Deactivation
         * @since 1.0
         * @version 1.0
         */
        public function deactivate()
        {

        }
    }
}

new DTQPlugin();
