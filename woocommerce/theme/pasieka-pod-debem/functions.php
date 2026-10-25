<?php
if (!defined('ABSPATH')) { exit; }
function ppd_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    add_theme_support('woocommerce',array('thumbnail_image_width'=>600,'single_image_width'=>1000,'product_grid'=>array('default_columns'=>4,'default_rows'=>3)));
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme','ppd_theme_setup');
function ppd_theme_assets() {
    wp_enqueue_style('ppd-style',get_stylesheet_uri(),array(),'1.0.1');
    wp_enqueue_script('ppd-site',get_template_directory_uri().'/assets/site.js',array(),'1.0.1',true);
}
add_action('wp_enqueue_scripts','ppd_theme_assets');
function ppd_shop_url() { return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/#oferta'); }
function ppd_setting($name,$default='') { return get_theme_mod('ppd_'.$name,$default); }
function ppd_customize($wp_customize) {
    $wp_customize->add_section('ppd_settings',array('title'=>'Pasieka — treści i kontakt','priority'=>30));
    $settings=array(
        'hero_title'=>array('Miód. Mały słoik, wielka przyjemność.','Nagłówek strony głównej','text'),
        'hero_text'=>array('Pasieka Pod Dębem w Kiczycach. Poznaj naszą ofertę i wybierz miód do swojego stołu.','Wprowadzenie','textarea'),
        'story'=>array('Jesteśmy w Kiczycach, w gminie Skoczów. To tutaj powstaje nasza opowieść o miodzie. Zajrzyj do oferty lub skontaktuj się z nami, aby porozmawiać o dostępnych produktach.','Tekst o pasiece','textarea'),
        'phone'=>array('','Numer telefonu (potwierdzony)','text'),
        'email'=>array('','E-mail kontaktowy','email'),
        'address'=>array('Kiczyce, gmina Skoczów','Adres kontaktowy / odbioru','textarea'),
        'contact_confirmed'=>array(false,'Opublikuj wpisane dane kontaktowe po ich weryfikacji','checkbox')
    );
    foreach ($settings as $key=>$spec) {
        $sanitize=($spec[2]==='checkbox')?'wp_validate_boolean':(($spec[2]==='email')?'sanitize_email':(($spec[2]==='textarea')?'sanitize_textarea_field':'sanitize_text_field'));
        $wp_customize->add_setting('ppd_'.$key,array('default'=>$spec[0],'sanitize_callback'=>$sanitize,'transport'=>'refresh'));
        $wp_customize->add_control('ppd_'.$key,array('section'=>'ppd_settings','label'=>$spec[1],'type'=>$spec[2]));
    }
    $wp_customize->add_setting('ppd_hero_image',array('default'=>0,'sanitize_callback'=>'absint'));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize,'ppd_hero_image',array('section'=>'ppd_settings','label'=>'Zdjęcie główne zamiast ilustracji','mime_type'=>'image')));
}
add_action('customize_register','ppd_customize');
function ppd_cart_fragment($fragments) {
    if (function_exists('WC') && WC()->cart) { $fragments['span.ppd-cart-count']='<span class="ppd-cart-count">'.absint(WC()->cart->get_cart_contents_count()).'</span>'; }
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments','ppd_cart_fragment');
function ppd_placeholder($src) { return get_template_directory_uri().'/assets/jar.svg'; }
add_filter('woocommerce_placeholder_img_src','ppd_placeholder');
function ppd_footer_page($slug,$label) {
    $page=get_page_by_path($slug);
    if ($page && $page->post_status==='publish') { echo '<a href="'.esc_url(get_permalink($page)).'">'.esc_html($label).'</a>'; }
}
