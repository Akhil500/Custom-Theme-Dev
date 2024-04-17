<?php
/*
Plugin Name: Social Media Sharing Buttons
Description: Add customizable social media sharing buttons to WordPress posts and pages.
Version: 1.0
Author: Akhil H S
*/

// Add social media sharing buttons to the_content
function add_social_media_sharing_buttons($content) {
    // Get post permalink
    $permalink = get_permalink();
    
    // Generate sharing links
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($permalink);
    $twitter_url = 'https://twitter.com/intent/tweet?url=' . urlencode($permalink);
    $linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($permalink);
    
    // Output HTML for sharing buttons in wordpres
    $buttons_html = '
    <div class="social-media-sharing">
        <a href="' . $facebook_url . '" target="_blank" class="social-button facebook">Share on Facebook</a>
        <a href="' . $twitter_url . '" target="_blank" class="social-button twitter">Share on Twitter</a>
        <a href="' . $linkedin_url . '" target="_blank" class="social-button linkedin">Share on LinkedIn</a>
    </div>';
    
    // Append sharing buttons to content
    $content .= $buttons_html;
    
    return $content;
}
add_filter('the_content', 'add_social_media_sharing_buttons');

// Enqueue styles for social media sharing buttons
function enqueue_social_media_sharing_styles() {
    wp_enqueue_style('social-media-sharing-buttons', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_social_media_sharing_styles');
