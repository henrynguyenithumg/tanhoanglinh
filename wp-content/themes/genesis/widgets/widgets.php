<?php

function add_widgets_collection($folders) {
    $folders[] = get_template_directory() . '/widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_widgets_collection');
