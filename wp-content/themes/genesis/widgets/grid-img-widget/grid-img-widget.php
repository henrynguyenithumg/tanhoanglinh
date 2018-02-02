<?php
/**
 * Widget Name: Grid IMG
 * Description: A widget displays grid
 * Author: NCCSoft
 */

class Grid_IMG_Widget extends SiteOrigin_Widget
{
    function __construct()
    {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'grid-img-widget', 
        // The name of the widget for display purposes.
            __('Grid IMG Widget', 'grid-img-widget'), 
        // The $widget_options array, which is passed through to WP_Widget.
            
        // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
            'description' => __('Grid widget.', 'grid-img-widget'),
            'help' => ''
        ), 
        //The $control_options array, which is passed through to WP_Widget
            array(), 
        //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'widget-form-fields-text-domain')
                ),
                'images' => array(
                    'type' => 'repeater',
                    'label' => __( 'Image.' , 'widget-form-fields-text-domain' ),
                    'item_name'  => __( 'Image list', 'siteorigin-widgets' ),
                    'fields' => array(
                        'width' => array(
                            'type' => 'number',
                            'label' => __( 'width', 'widget-form-fields-text-domain' )
                        ),
                        'msg' => array(
                            'type' => 'textarea',
                            'label' => __( 'Message', 'widget-form-fields-text-domain' )
                        ),
                        'url' => array(
                            'type' => 'media',
                            'label' => __('Hyperlink', 'widget-form-fields-text-domain'),
                            'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                            'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                            'library' => 'image',
                            'fallback' => true
                        ),
                    ))
            ),
        //The $base_folder path string.
            plugin_dir_path(__FILE__));
    }
    
    function get_template_name($instance)
    {
        return 'grid-img-template';
    }
    
    function get_template_dir($instance)
    {
        return 'grid-img-templates';
    }
    
    function get_style_name($instance)
    {
        return '';
    }
}

siteorigin_widget_register('grid-img-widget', __FILE__, 'Grid_IMG_Widget');
add_filter('grid-img-widget', 'grid-img-widget');
