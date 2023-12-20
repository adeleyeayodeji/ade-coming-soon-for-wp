<?php
//security
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="ade-coming-soon-page">
    <div class="ade-coming-soon-1">
        <div class="bgimg" style="background-image: url('<?php echo esc_url($bg_image) ?>');">
            <div class="ade-header-logo">
                <img src="<?php echo esc_url($logo) ?>" alt="logo">
            </div>
            <div class="middle">
                <h1><?php echo esc_html($title) ?></h1>
                <hr>
                <p><?php echo date('Y-m-d H:i:s', strtotime($countdown)) ?></p>
            </div>
            <div class="bottomleft">
                <p><?php echo esc_html($text) ?></p>
            </div>
        </div>
    </div>
</div>