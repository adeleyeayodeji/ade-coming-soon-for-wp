<?php
//security
if (!defined('ABSPATH')) {
    exit;
}

//AdeComingSoonPage::get_template_content
//check if function exist get_ade_coming_soon_template_content
if (!function_exists('get_ade_coming_soon_template_content')) {
    /**
     * Get template content
     * 
     * @param string $template_name
     * @param array $args
     * 
     * @return string
     */
    function get_ade_coming_soon_template_content(string $template_name, array $args = array())
    {
        $adecomingsoon = new AdeComingSoonPage();
        return $adecomingsoon->get_template_content($template_name, $args);
    }
}
