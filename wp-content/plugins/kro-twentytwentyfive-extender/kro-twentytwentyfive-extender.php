<?php
/**
 * Plugin Name: KRO Twenty Twenty-Five Extender
 * Text Domain: kro-ttfe
 * Description: TBD
 * Version: 0.0.1
 * Author: Krzysztof Osada
 */
defined( 'ABSPATH' ) || exit;

class KRO_TwentyTwentyFive_Extender {
    const NAMESPACE  = 'kro-ttfe/v1';
    public static $plugin_url;
    public function __construct()
    {
        $this->plugin_url = plugin_dir_url( __FILE__ );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function enqueue_styles() : void
    {
        wp_enqueue_style( 'kro-ttfe', "{$this->plugin_url}assets/css/kro-ttfe.min.css", [], 1772712462, 'screen' );
    }

    public function enqueue_scripts() : void
    {
        wp_enqueue_script( 'kro-ttfe', "{$this->plugin_url}assets/js/kro-ttfe.min.js", [], 1772712462, [ 'in_footer' => true ] );
        wp_enqueue_script( 'kro-ttfe-additional', "{$this->plugin_url}assets/js/scripts.js", [ 'kro-ttfe' ], 1772713773, [ 'in_footer' => true ] );
    }
}

new KRO_TwentyTwentyFive_Extender();