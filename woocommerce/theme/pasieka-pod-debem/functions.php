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
function ppd_asset_version($path) {
    $file=get_template_directory().$path;
    return file_exists($file)?(string) filemtime($file):(string) wp_get_theme()->get('Version');
}
function ppd_setting($name,$default='') { return get_theme_mod('ppd_'.$name,$default); }
function ppd_shop_url() { return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/#oferta'); }
function ppd_default_story() {
    return 'Pasieka Pod Dębem działa od 2012 roku w Kiczycach, w gminie Skoczów, na Śląsku Cieszyńskim. Rodzaje miodu zależą od sezonu i kwitnienia roślin, dlatego dostępność produktów może się zmieniać. Zajrzyj do oferty lub skontaktuj się z nami, aby porozmawiać o dostępnych produktach.';
}
function ppd_map_query() {
    if (!ppd_setting('contact_confirmed',false)) { return ''; }
    return trim((string) ppd_setting('address',''));
}
function ppd_theme_assets() {
    wp_enqueue_style('ppd-style',get_stylesheet_uri(),array(),ppd_asset_version('/style.css'));
    wp_enqueue_style('ppd-extras',get_template_directory_uri().'/assets/extras.css',array('ppd-style'),ppd_asset_version('/assets/extras.css'));
    wp_enqueue_script('ppd-site',get_template_directory_uri().'/assets/site.js',array(),ppd_asset_version('/assets/site.js'),true);
    if (is_front_page() && ppd_map_query()!=='') {
        wp_enqueue_script('ppd-map',get_template_directory_uri().'/assets/map.js',array(),ppd_asset_version('/assets/map.js'),true);
    }
}
add_action('wp_enqueue_scripts','ppd_theme_assets');
function ppd_customize($wp_customize) {
    $wp_customize->add_section('ppd_settings',array('title'=>'Pasieka — treści i kontakt','priority'=>30));
    $settings=array(
        'hero_title'=>array('Miód. Mały słoik, wielka przyjemność.','Nagłówek strony głównej','text'),
        'hero_text'=>array('Pasieka Pod Dębem w Kiczycach. Poznaj naszą ofertę i wybierz miód do swojego stołu.','Wprowadzenie','textarea'),
        'story'=>array(ppd_default_story(),'Tekst o pasiece','textarea'),
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
function ppd_faq_items() {
    return array(
        array('Gdzie sprawdzę aktualną ofertę?','Aktualne produkty znajdziesz w zakładce „Miody”. Publikujemy tam ceny, gramatury i dostępność. Jeśli oferta jest w przygotowaniu, zakup nie jest jeszcze możliwy.'),
        array('Jakie są sposoby dostawy?','Dostępne metody i koszt dostawy zobaczysz w koszyku po podaniu adresu. Jeśli dla Twojego adresu nie ma metody dostawy, skontaktuj się z nami przed zakupem.'),
        array('Jak mogę zapłacić?','Aktualne metody płatności są wyświetlane podczas składania zamówienia. Dostępność BLIK-u lub płatności kartą zależy od uruchomionego operatora płatności.'),
        array('Czy można odebrać zamówienie osobiście?','Odbiór jest możliwy, jeśli taka opcja pojawia się w koszyku. Termin i miejsce odbioru ustal z nami na podstawie danych podanych przy zamówieniu.'),
        array('Jak przechowywać miód?','Przechowuj miód w szczelnie zamkniętym słoiku, w suchym miejscu, z dala od bezpośredniego światła. Nie przechowuj go w lodówce.'),
        array('Dlaczego miód się krystalizuje?','Krystalizacja to naturalny proces, który zależy od rodzaju miodu i temperatury przechowywania. Nie oznacza, że produkt jest zepsuty.'),
        array('Czy mogę zamówić miód na prezent?','Tak. W uwagach do zamówienia napisz, że produkt ma być prezentem — ustalimy szczegóły po złożeniu zamówienia.'),
        array('Co jeśli produktu nie ma?','Informację o dostępności zobaczysz na stronie produktu. Jeśli produkt jest niedostępny, skontaktuj się z nami lub wybierz inny rodzaj miodu.')
    );
}
function ppd_structured_data() {
    if (!is_front_page()) { return; }
    $graph=array();
    if (ppd_setting('contact_confirmed',false)) {
        $business=array('@type'=>'LocalBusiness','name'=>'Pasieka Pod Dębem','description'=>'Pasieka w Kiczycach — miody i produkty pszczele.','url'=>home_url('/'),'sameAs'=>array('https://www.facebook.com/miody.pod.debem/'));
        $phone=preg_replace('/[^+0-9]/','',(string) ppd_setting('phone'));
        if ($phone!=='') { $business['telephone']=$phone; }
        $email=(string) ppd_setting('email');
        if ($email!=='') { $business['email']=$email; }
        $address=trim((string) ppd_setting('address'));
        if ($address!=='') { $business['address']=array('@type'=>'PostalAddress','streetAddress'=>$address,'addressCountry'=>'PL'); }
        $graph[]=$business;
    }
    $questions=array();
    foreach (ppd_faq_items() as $item) {
        $questions[]=array('@type'=>'Question','name'=>$item[0],'acceptedAnswer'=>array('@type'=>'Answer','text'=>$item[1]));
    }
    $graph[]=array('@type'=>'FAQPage','mainEntity'=>$questions);
    $data=array('@context'=>'https://schema.org','@graph'=>$graph);
    echo '<script type="application/ld+json">'.wp_json_encode($data,JSON_HEX_TAG|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'</script>'."\n";
}
add_action('wp_head','ppd_structured_data',20);
function ppd_get_seo_description() {
    $description='';
    if (function_exists('is_product') && is_product()) {
        $product=wc_get_product(get_the_ID());
        if ($product) {
            $description=$product->get_short_description();
            if (trim(wp_strip_all_tags($description))==='') { $description=$product->get_description(); }
        }
    } elseif (function_exists('is_product_category') && is_product_category()) {
        $term=get_queried_object();
        if ($term && !empty($term->description)) { $description=$term->description; }
    } elseif (is_front_page()) {
        $description=ppd_setting('hero_text','Pasieka Pod Dębem w Kiczycach. Poznaj naszą ofertę i wybierz miód do swojego stołu.');
    }
    $description=wp_strip_all_tags((string) $description);
    $description=preg_replace('/\s+/',' ',$description);
    if (mb_strlen($description)>158) { $description=mb_substr($description,0,155).'…'; }
    return $description;
}
function ppd_get_seo_image() {
    if (function_exists('is_product') && is_product()) {
        $product=wc_get_product(get_the_ID());
        if ($product && $product->get_image_id()) {
            $image=wp_get_attachment_image_src($product->get_image_id(),'large');
            if ($image) { return $image[0]; }
        }
    }
    return '';
}
function ppd_head_meta() {
    if (defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION')) { return; }
    $description=ppd_get_seo_description();
    if ($description==='') { return; }
    echo '<meta name="description" content="'.esc_attr($description).'">'."\n";
    echo '<meta property="og:locale" content="pl_PL">'."\n";
    echo '<meta property="og:title" content="'.esc_attr(wp_get_document_title()).'">'."\n";
    echo '<meta property="og:description" content="'.esc_attr($description).'">'."\n";
    echo '<meta property="og:url" content="'.esc_url(home_url(add_query_arg(array(),$GLOBALS['wp']->request))).'">'."\n";
    if (function_exists('is_product') && is_product()) { echo '<meta property="og:type" content="product">'."\n"; } else { echo '<meta property="og:type" content="website">'."\n"; }
    $image=ppd_get_seo_image();
    if ($image!=='') {
        echo '<meta property="og:image" content="'.esc_url($image).'">'."\n";
        echo '<meta name="twitter:card" content="summary_large_image">'."\n";
        echo '<meta name="twitter:image" content="'.esc_url($image).'">'."\n";
    }
}
add_action('wp_head','ppd_head_meta',5);
