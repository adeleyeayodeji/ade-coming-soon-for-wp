<?php
//security
if (!defined('ABSPATH')) {
    exit;
}

class AdeComingSoonPage
{
    /**
     * Init AdeComingSoon
     */
    public function __construct()
    {
        //wp 
        add_action('init', array($this, 'wp'));
        //add a new column to post_type=page
        add_filter('manage_page_posts_columns', array($this, 'add_new_page_column'));
        //update the column with the value
        add_action('manage_page_posts_custom_column', array($this, 'add_new_page_column_value'), 10, 2);
        // Register site styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_plugin_scripts'));
        //admin enqueue scripts
        add_action('admin_enqueue_scripts', array($this, 'register_plugin_scripts'));

        // Register Elementor widget styles and scripts
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'register_elementor_styles'));
        add_action('elementor/frontend/after_register_scripts', array($this, 'register_elementor_scripts'));

        //register widget Ade_Coming_Soon_1
        add_action('elementor/widgets/widgets_registered', array($this, 'register_elementor_widget_ade_coming_soon_1'));
        //add menu to admin bar to turn on or off coming soon page
        add_action('admin_bar_menu', array($this, 'add_admin_bar_menu'), 100);
        //ajax action to enable coming soon page
        add_action('wp_ajax_ade_coming_soon_ajax', array($this, 'ajax_ade_coming_soon_ajax'));
        add_action('wp_ajax_nopriv_ade_coming_soon_ajax', array($this, 'ajax_ade_coming_soon_ajax'));

        //ade_coming_soon_page_ajax
        add_action('wp_ajax_ade_coming_soon_page_ajax', array($this, 'ajax_ade_coming_soon_page_ajax'));
        add_action('wp_ajax_nopriv_ade_coming_soon_page_ajax', array($this, 'ajax_ade_coming_soon_page_ajax'));
    }

    /**
     * WP
     */
    public function wp()
    {
        //exclude wp-admin path and wp-login.php
        if (is_admin() || strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
            return;
        }
        //check if coming soon is enabled
        $coming_soon = get_option('ade_coming_soon_enable', 'no');
        if ($coming_soon == 'yes') {
            //check if user is logged in or if it's the login page
            if (!current_user_can('manage_options')) {
                //get option for selected page id
                $coming_soon_page_id = get_option('ade_coming_soon_enable_page', '');

                //get page id
                $page_id = $coming_soon_page_id;
                //get page content
                $page_content = $this->get_template_content('coming-soon-default');
                //echo page content
                echo $page_content;

                //stop execution
                exit;
            }
        }
    }

    /**
     * Ajax action to enable coming soon page
     */
    public function ajax_ade_coming_soon_ajax()
    {
        //check nonce
        check_ajax_referer('ade_coming_soon_nonce', 'nonce');

        //get type
        $type = sanitize_text_field($_POST['type']);

        //check type
        if ($type == 'enable') {
            //update option
            update_option('ade_coming_soon_enable', 'yes');
        } else {
            //update option
            update_option('ade_coming_soon_enable', 'no');
        }

        //return
        wp_send_json_success();
    }

    /**
     * ajax_ade_coming_soon_page_ajax
     */
    public function ajax_ade_coming_soon_page_ajax()
    {
        //check nonce
        check_ajax_referer('ade_coming_soon_nonce', 'nonce');

        //get type
        $type = sanitize_text_field($_POST['type']);
        //get post id
        $post_id = sanitize_text_field($_POST['post_id']);

        //check type
        if ($type == 'enable') {
            //update option
            update_option('ade_coming_soon_enable_page', $post_id);
        } else {
            //delete option
            delete_option('ade_coming_soon_enable_page');
        }

        //content return
        if ($type == 'enable') {
            $content = '<span class="dashicons dashicons-yes" style="color:green;"></span> <a href="javascript:;" class="ade-post-coming-soon" data-type="disable" data-post-id="' . esc_attr($post_id) . '">' . __('Disable', 'ade-coming-soon') . '</a>';
        } else {
            $content = '<span class="dashicons dashicons-no" style="color:red;"></span> <a href="javascript:;" class="ade-post-coming-soon" data-type="enable" data-post-id="' . esc_attr($post_id) . '">' . __('Enable', 'ade-coming-soon') . '</a>';
        }

        //return
        wp_send_json([
            'code' => 200,
            'data' => $content
        ]);
    }

    /**
     * Add menu to admin bar to turn on or off coming soon page
     */
    public function add_admin_bar_menu($wp_admin_bar)
    {
        $coming_soon = get_option('ade_coming_soon_enable', 'no');
        if ($coming_soon == 'yes') {
            $wp_admin_bar->add_node(array(
                'id' => 'ade_coming_soon',
                'title' => '<span class="dashicons dashicons-yes" style="color:green;"></span> ' . __('Disable Coming Soon', 'ade-coming-soon'),
                'href' => 'javascript:;',
                'meta' => array(
                    'class' => 'ade-coming-soon',
                    'onclick' => 'ade_coming_soon_disable(this, event)'
                )
            ));
        } else {
            $wp_admin_bar->add_node(array(
                'id' => 'ade_coming_soon',
                'title' => '<span class="dashicons dashicons-no" style="color:red;"></span> ' . __('Enable Coming Soon', 'ade-coming-soon'),
                'href' => 'javascript:;',
                'meta' => array(
                    'class' => 'ade-coming-soon',
                    'onclick' => 'ade_coming_soon_enable(this, event)'
                )
            ));
        }
    }

    /**
     * Register Elementor widget Ade_Coming_Soon_1
     */
    public function register_elementor_widget_ade_coming_soon_1()
    {
        // We check if the Elementor plugin has been installed / activated.
        if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
            //widget file
            $widget_file = 'elementor/widgets/ade-coming-soon-1.php';

            // Load the widget class file.
            require_once ADE_COMING_SOON_PLUGIN_DIR . $widget_file;

            // Register the widget with Elementor.
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Ade_Coming_Soon_1());
        }
    }

    /**
     * Add a new column to post_type=page
     */
    public function add_new_page_column($columns)
    {
        //update column to third index
        $columns = array_slice($columns, 0, 2, true) + array("ade_coming_soon" => "Coming Soon") + array_slice($columns, 2, count($columns) - 1, true);
        return $columns;
    }

    /**
     * Update the column with the value
     */
    public function add_new_page_column_value($column_name, $post_id)
    {
        if ($column_name == 'ade_coming_soon') {
            $coming_soon = get_option('ade_coming_soon_enable_page', '');
            if ($coming_soon == $post_id) {
                echo '<span class="dashicons dashicons-yes" style="color:green;"></span> <a href="javascript:;" class="ade-post-coming-soon" data-type="disable" data-post-id="' . esc_attr($post_id) . '">' . __('Disable', 'ade-coming-soon') . '</a>';
            } else {
                echo '<span class="dashicons dashicons-no" style="color:red;"></span> <a href="javascript:;" class="ade-post-coming-soon" data-type="enable" data-post-id="' . esc_attr($post_id) . '">' . __('Enable', 'ade-coming-soon') . '</a>';
            }
        }
    }

    /**
     * Register site styles and scripts
     */
    public function register_plugin_scripts()
    {
        wp_enqueue_style('ade-coming-soon-style', ADE_COMING_SOON_PLUGIN_URL . 'assets/css/ade-coming-soon.css', array(), ADE_COMING_SOON_VERSION, 'all');
        wp_enqueue_script('ade-coming-soon-script', ADE_COMING_SOON_PLUGIN_URL . 'assets/js/ade-coming-soon.js', array('jquery'), ADE_COMING_SOON_VERSION, true);

        //localize script
        wp_localize_script('ade-coming-soon-script', 'ade_coming_soon', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ade_coming_soon_nonce'),
        ));
    }

    /**
     * Register Elementor widget styles and scripts
     */
    public function register_elementor_styles()
    {
        wp_enqueue_style('ade-coming-soon-style-elementor', ADE_COMING_SOON_PLUGIN_URL . 'assets/css/ade-coming-soon.css', array(), ADE_COMING_SOON_VERSION, 'all');
    }

    public function register_elementor_scripts()
    {
        wp_enqueue_script('ade-coming-soon-script-elementor', ADE_COMING_SOON_PLUGIN_URL . 'assets/js/ade-coming-soon.js', array('jquery'), ADE_COMING_SOON_VERSION, true);

        //localise script
        wp_localize_script('ade-coming-soon-script-elementor', 'ade_coming_soon_elementor', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ade_coming_soon_nonce'),
        ));
    }

    /**
     * Get Template Content
     * 
     * @param string $template_name
     * @param array $args
     * 
     * @return string
     */
    public function get_template_content(string $template_name, array $args = array())
    {
        ob_start();
        do_action('ade_coming_soon_before_template_content', $template_name, $args);
        extract($args);
        include ADE_COMING_SOON_PLUGIN_DIR . 'templates/' . $template_name . '.php';
        do_action('ade_coming_soon_after_template_content', $template_name, $args);
        return ob_get_clean();
    }
}


//init
new AdeComingSoonPage();
