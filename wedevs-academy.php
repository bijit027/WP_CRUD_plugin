<?php

/**
 * Plugin Name: weDevs Academy
 * Description: A tutorial plugin for weDevs Academy
 * Plugin URI: https://tareq.co
 * Author: Bijit Deb
 * Author URI: https://tareq.co
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

 if(!defined('ABSPATH')){
     exit;
 }


 require_once __DIR__ . '/vendor/autoload.php';

 
/**
 * The main plugin class
 */

 final class Wedevs_Academy{

    const version = '1.0';

    
    /**
     * Class construcotr
     */
    private function __construct(){
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        add_action('plugin_loaded',[$this,'init_plugin']);

     }

       /**
     * Initializes a singleton instance
     *
     * @return \WeDevs_Academy
     */

     public static function init(){
         static $instance = false;

         if(! $instance){

            $instanece = new self();

         }
         return $instance;
    }

    public function define_constants(){

        define( 'WD_ACADEMY_VERSION', self::version );
        define( 'WD_ACADEMY_FILE', __FILE__ );
        define( 'WD_ACADEMY_PATH', __DIR__ );
        define( 'WD_ACADEMY_URL', plugins_url( '', WD_ACADEMY_FILE ) );
        define( 'WD_ACADEMY_ASSETS', WD_ACADEMY_URL . '/assets' );

    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {
            new WeDevs\Academy\Admin();
        } else {
            new WeDevs\Academy\Frontend();
        }


    }

      /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new WeDevs\Academy\Installer();
        $installer->run();
    }
 } 


 /**
 * Initializes the main plugin
 *
 * @return \WeDevs_Academy
 */

 function wedevs_academy(){
     return wedevs_academy::init();
 }

 // kick-off the plugin
wedevs_academy();