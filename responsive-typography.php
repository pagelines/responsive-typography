<?php

/**
  Author: Kyle & Irving
  Author URI: http://pagelines.kyle-irving.co.uk/
  Plugin Name: Responsive Typography
  Plugin URI: http://pagelines.kyle-irving.co.uk/responsive-typography/
  Version: 1.0.1
  Description: Using FlowType.JS this DMS plugin improves typography. In Site Settings is a new panel that will allow you to enter settings to enhance typography - where the text is sized based on the element width it is contained in and the browser of the user.
  Class Name: Responsive_Typography
  PageLines: true
  Section: false
 * 
 */
class Responsive_Typography {

    function __construct() {
        add_action('init', array(&$this, 'init'));
        add_filter('pl_settings_array', array(&$this, 'add_settings'));
        add_action('wp_enqueue_scripts', array(&$this, 'add_scripts'));
    }

    function init() {
        load_plugin_textdomain('responsive-typography', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    function add_scripts() {
        wp_enqueue_script('jquery-flowtype', plugin_dir_url(__FILE__) . 'js/flowtype.js', array('jquery'), NULL, true);
        wp_enqueue_script('responsive-typography', plugin_dir_url(__FILE__) . 'js/responsive-typography.js', array('jquery', 'jquery-flowtype'), NULL, true);
        wp_localize_script('responsive-typography', 'pagelines_responsive_typography', array(
            'flowtype' => array(
                'minimum_width' => (pl_setting('minimum_width')) ? (int) pl_setting('minimum_width') : 500,
                'maximum_width' => (pl_setting('maximum_width')) ? (int) pl_setting('maximum_width') : 1200,
                'minimum_font_size' => (pl_setting('minimum_font_size')) ? (int) pl_setting('minimum_font_size') : 12,
                'maximum_font_size' => (pl_setting('maximum_font_size')) ? (int) pl_setting('maximum_font_size') : 40,
                'font_ratio' => (pl_setting('font_ratio')) ? (int) pl_setting('font_ratio') : 40,
                'line_ratio' => (pl_setting('line_ratio')) ? (double) pl_setting('line_ratio') : 1.5,
                'ids' => pl_setting('ids', array('default' => '')),
                'classes' => pl_setting('classes', array('default' => ''))
            )
        ));
    }

    function add_settings($settings) {
        $settings['responsive-typography'] = array(
            'name' => __('Responsive Typography', 'responsive-typography'),
            'icon' => 'icon-text-width',
            'pos' => 3,
            'opts' => $this->options()
        );

        return $settings;
    }

    function options() {

        $settings = array(
            array(
                'col'	=> 1,
                'type' => 'multi',
                'title' => __('jQuery Flowtype Options', 'responsive-typography'),
                'help' => '',
                'opts' => array(
                    array(
                        'key' => 'minimum_width',
                        'type' => 'select_same',
                        'label' => __('Minimum  width', 'responsive-typography'),
                        'default' => 500,
                        'opts' => range(100, 3200, 50)
                    ),
                    array(
                        'key' => 'maximum_width',
                        'type' => 'select_same',
                        'label' => __('Maximum width', 'responsive-typography'),
                        'default' => 1200,
                        'opts' => range(100, 3200, 50)
                    ),
                    array(
                        'key' => 'minimum_font_size',
                        'type' => 'select_same',
                        'label' => __('Minimum  font size', 'responsive-typography'),
                        'default' => 11,
                        'opts' => range(1, 72, 1)
                    ),
                    array(
                        'key' => 'maximum_font_size',
                        'type' => 'select_same',
                        'label' => __('Maximum font size', 'responsive-typography'),
                        'default' => 24,
                        'opts' => range(1, 72, 1)
                    ),
                    array(
                        'key' => 'font_ratio',
                        'type' => 'select_same',
                        'label' => __('Font ratio', 'responsive-typography'),
                        'default' => 30,
                        'opts' => range(0, 100, 1)
                    ),
                    array(
                        'key' => 'line_ratio',
                        'type' => 'text',
                        'label' => __('Line ratio', 'responsive-typography'),
                        'default' => 1.5
                    )
                )
            ),
            array(
                'col'	=> 2,
                'type' => 'multi',
                'title' => __('Apply for IDs', 'responsive-typography'),
                'help' => '',
                'opts' => array(
                    array(
                        'key' => 'ids',
                        'type' => 'textarea',
                        'label' => __('IDs (separated by comma character)', 'responsive-typography'),
                        'help' => __('Enter the ID that you will use to apply Responsive Typography.<br /><b>Example:</b> &ltdiv id="responsive-content"&gt; TEXT &lt;/div&gt; <br/>You can use IDs or Classes as you prefer.', 'responsive-typography'),
                    ),
                )
            ),
            array(
                'col'	=> 2,
                'type' => 'multi',
                'title' => __('Apply for Classes', 'responsive-typography'),
                'help' => '',
                'opts' => array(
                    array(
                        'key' => 'classes',
                        'type' => 'textarea',
                        'label' => __('Classes (separated by comma character)', 'responsive-typography'),
                        'help' => __('Enter the styling class that you will use to apply Responsive Typography.<br /><b>Example:</b><br/> &ltdiv class="responsive-post"&gt; TEXT &lt;/div&gt; <br/>You can use IDs or Classes as you prefer.', 'responsive-typography'),
                    ),
                )
            )
        );

        return $settings;
    }

}

new Responsive_Typography();