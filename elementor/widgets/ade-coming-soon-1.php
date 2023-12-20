<?php
//security
if (!defined('ABSPATH')) {
    exit;
}


/**
 * Coming Soon 1 Elementor Widget
 */
class Ade_Coming_Soon_1 extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Coming Soon 1 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'ade-coming-soon-1';
    }

    /**
     * Get widget title.
     *
     * Retrieve Coming Soon 1 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Ade Coming Soon 1', 'ade-coming-soon');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Coming Soon 1 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        //use elementor icons
        return 'eicon-image-rollover';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Coming Soon 1 widget belongs to.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['ade-coming-soon'];
    }

    /**
     * Register Coming Soon 1 widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @access protected
     */
    protected function _register_controls()
    {

        // Coming Soon 1 Content
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Coming Soon 1 Content', 'ade-coming-soon'),
            ]
        );

        $this->add_control(
            'coming_soon_1_bg_image',
            [
                'label' => __('Background Image', 'ade-coming-soon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'coming_soon_1_logo',
            [
                'label' => __('Logo', 'ade-coming-soon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'coming_soon_1_title',
            [
                'label' => __('Title', 'ade-coming-soon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('COMING SOON', 'ade-coming-soon'),
            ]
        );

        $this->add_control(
            'coming_soon_1_countdown',
            [
                'label' => __('Date Countdown', 'ade-coming-soon'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => date('Y-m-d H:i:s', strtotime('+1 month')),
            ]
        );

        $this->add_control(
            'coming_soon_1_text',
            [
                'label' => __('Footer Text', 'ade-coming-soon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Some text', 'ade-coming-soon'),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Coming Soon 1 widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        // Background Image
        $bg_image = $settings['coming_soon_1_bg_image']['url'];
        if (empty($bg_image)) {
            $bg_image = \Elementor\Utils::get_placeholder_image_src();
        }

        // Logo
        $logo = $settings['coming_soon_1_logo']['url'];
        if (empty($logo)) {
            $logo = \Elementor\Utils::get_placeholder_image_src();
        }

        // Title
        $title = $settings['coming_soon_1_title'];
        if (empty($title)) {
            $title = __('COMING SOON', 'ade-coming-soon');
        }

        // Countdown
        $countdown = $settings['coming_soon_1_countdown'];
        if (empty($countdown)) {
            $countdown = date('Y-m-d H:i:s', strtotime('+1 month'));
        }

        // Footer Text
        $text = $settings['coming_soon_1_text'];
        if (empty($text)) {
            $text = __('Some text', 'ade-coming-soon');
        }

        //get template content
        $content = get_ade_coming_soon_template_content('coming-soon-1', array(
            'bg_image' => $bg_image,
            'logo' => $logo,
            'title' => $title,
            'countdown' => $countdown,
            'text' => $text,
        ));

        echo $content;
    }
}
