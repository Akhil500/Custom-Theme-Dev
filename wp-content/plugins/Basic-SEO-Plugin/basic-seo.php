<?php
/*
Plugin Name: Advanced SEO Suite
Description: Provides advanced SEO features including schema markup, XML sitemap generation, and content analysis.
Version: 1.0
Author: Akhil HS
*/

// Add schema markup to the head section
function add_schema_markup() {
    // Code to generate schema markup
    // Example:
    $schema_markup = '
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "CustomTheme",
        "url": "' . get_site_url() . '",
        "logo": "' . get_template_directory_uri() . '/logo.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91 9206717583",
            "contactType": "customer service"
        }
    }
    </script>';
    
    echo $schema_markup;
}
add_action('wp_head', 'add_schema_markup');

// Generate XML sitemap
function generate_xml_sitemap() {
    // Code to generate XML sitemap
    // Example:
    $posts_args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $posts_query = new WP_Query($posts_args);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    if ($posts_query->have_posts()) {
        while ($posts_query->have_posts()) {
            $posts_query->the_post();
            $xml .= '<url>';
            $xml .= '<loc>' . get_permalink() . '</loc>';
            $xml .= '<lastmod>' . get_the_modified_date('Y-m-d') . '</lastmod>';
            $xml .= '</url>';
        }
    }

    $xml .= '</urlset>';

    $file = fopen(ABSPATH . 'sitemap.xml', 'w');
    fwrite($file, $xml);
    fclose($file);
}
add_action('init', 'generate_xml_sitemap');

// Content analysis
function seo_content_analysis($content) {
    // Code for content analysis
    // Example:
    $word_count = str_word_count(strip_tags($content));
    $reading_time_minutes = ceil($word_count / 200); // Assuming 200 words per minute reading speed

    $analysis_html = '<div class="seo-analysis">';
    $analysis_html .= '<p>Reading Time: ' . $reading_time_minutes . ' min (' . $word_count . ') words</p>';
    $analysis_html .= '</div>';

    // postpend analysis HTML to the content
    // $content .= $analysis_html;

    // Prepend analysis HTML to the content
    $content = $analysis_html . $content;

    return $content;
}
add_filter('the_content', 'seo_content_analysis');

// Enqueue styles for SEO analysis
function enqueue_seo_analysis_styles() {
    wp_enqueue_style('seo-analysis-styles', plugins_url('analysis.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_seo_analysis_styles');
