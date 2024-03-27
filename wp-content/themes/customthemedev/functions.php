<?php
// to get title of the page and add image logo to dynamically
 function customthemedev_theme_support(){
       add_theme_support('title-tag');
       add_theme_support('custom-logo');
       add_theme_support('post-thumbnails');
 }
 add_action('after_setup_theme','customthemedev_theme_support');




// add menu widget
 function customthemedev_custom_menu(){
      $location = array(
            'primary' => "left side bar menu",
            'footer' => "footer menu"
      );

      register_nav_menus($location);
 }
 add_action('init','customthemedev_custom_menu');
 

//  custom header and styles
 function customthemedev_register_styles(){

       $version = wp_get_theme()->get( 'Version');
        wp_enqueue_style('customthemedev-style' , get_template_directory_uri()."/style.css", array('customthemedev-bootstrap'),$version,'all');
        wp_enqueue_style('customthemedev-bootstrap' , "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" ,array(),'4.4.1','all');
        wp_enqueue_style('customthemedev-fontawesome' ,"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css",array(),'5.13.0','all');
       }

 add_action('wp_enqueue_scripts','customthemedev_register_styles');

// custom footer scripts
 function customthemedev_register_scripts(){

       $version = wp_get_theme()->get( 'Version');
        wp_enqueue_script('customthemedev-script' , get_template_directory_uri()."/assets/js/main.js", array(),'1.0','all',true);
        wp_enqueue_script('customthemedev-jquery' , "https://code.jquery.com/jquery-3.4.1.slim.min.js" ,array(),'3.4.1','all',true);
        wp_enqueue_script('customthemedev-popper' ,"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js",array(),'1.16.0','all',true);
        wp_enqueue_script('customthemedev-bootstrap' ,"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",array(),'4.4.1','all',true);

       }

 add_action('wp_enqueue_scripts','customthemedev_register_scripts');

?>