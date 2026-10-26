<?php
/**
 * Plugin Name: Pasieka — start sklepu
 * Description: Strony WooCommerce, lista wdrożeniowa i blokada sprzedaży przed uruchomieniem.
 * Version: 1.0.2
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Author: Projekt Pasieka Pod Dębem
 * License: GPL-2.0-or-later
 * Text Domain: pasieka-start
 */
if (!defined('ABSPATH')) { exit; }
function ppds_closed() {
    if (get_option('ppds_test_open','no')==='yes' && wp_get_environment_type()==='production') { return true; }
    return get_option('ppds_sales_open','no')!=='yes';
}
function ppds_admin_menu() { add_menu_page('Pasieka — wdrożenie','Pasieka','manage_options','pasieka-start','ppds_admin_screen','dashicons-palmtree',56); }
add_action('admin_menu','ppds_admin_menu');
function ppds_admin_notice() {
    if (!current_user_can('manage_options') || !ppds_closed()) { return; }
    echo '<div class="notice notice-warning"><p>Pasieka: sprzedaż jest zablokowana. <a href="'.esc_url(admin_url('admin.php?page=pasieka-start')).'">Lista wdrożeniowa</a>. Odblokowanie nie konfiguruje operatora płatności.</p></div>';
}
add_action('admin_notices','ppds_admin_notice');
function ppds_purchase_guard($purchasable) { return ppds_closed()?false:$purchasable; }
add_filter('woocommerce_is_purchasable','ppds_purchase_guard',100);
add_filter('woocommerce_variation_is_purchasable','ppds_purchase_guard',100);
function ppds_cart_guard() {
    $message='Sklep jest w przygotowaniu. Składanie zamówień nie jest jeszcze dostępne.';
    if (ppds_closed() && function_exists('wc_add_notice') && !wc_has_notice($message,'error')) { wc_add_notice($message,'error'); }
}
add_action('woocommerce_check_cart_items','ppds_cart_guard');
add_action('woocommerce_checkout_process','ppds_cart_guard');
function ppds_store_api_guard($errors) {
    if (ppds_closed() && is_wp_error($errors)) { $errors->add('ppds_closed','Sklep jest w przygotowaniu. Składanie zamówień jest zablokowane.'); }
    return $errors;
}
add_filter('woocommerce_store_api_cart_errors','ppds_store_api_guard');
function ppds_payment_guard($statuses) { return ppds_closed()?array():$statuses; }
add_filter('woocommerce_valid_order_statuses_for_payment','ppds_payment_guard',100);
function ppds_public_notice() { if (ppds_closed()) { echo '<div class="notice" role="status">Przygotowujemy sklep. Zakupy online nie są jeszcze dostępne.</div>'; } }
add_action('woocommerce_before_shop_loop','ppds_public_notice',5);
add_action('woocommerce_before_single_product','ppds_public_notice',5);
function ppds_insert_page($slug,$title,$content,$status='draft') {
    $page=get_page_by_path($slug);
    if ($page) { return $page->ID; }
    $id=wp_insert_post(array('post_type'=>'page','post_name'=>$slug,'post_title'=>$title,'post_content'=>$content,'post_status'=>$status),true);
    if (is_wp_error($id)) { throw new Exception($id->get_error_message()); }
    return $id;
}
function ppds_legal_drafts() {
    return array(
        'regulamin'=>array('Regulamin','<h2>Dokument roboczy — nie publikuj bez uzupełnienia</h2><p>To struktura redakcyjna, nie gotowa porada prawna. Uzupełnij i zweryfikuj dla swojego modelu działalności.</p><h2>Sprzedawca</h2><p>[Pełna nazwa, forma działalności, adres, dane rejestrowe jeśli dotyczą, e-mail, telefon i adres reklamacji.]</p><h2>Produkty i ceny</h2><p>[Oferta, gramatura, cechy, ceny końcowe, podatki, dodatkowe koszty i dostępność.]</p><h2>Zamówienia i zawarcie umowy</h2><p>[Kolejne etapy, moment zawarcia umowy, potwierdzenie, zasady konta i zakupów bez rejestracji.]</p><h2>Płatności i dostawa</h2><p>[Rzeczywiste metody, operator, terminy zapłaty, regiony, koszty, czas realizacji i odbiór osobisty.]</p><h2>Reklamacje i zgodność towaru z umową</h2><p>[Procedura, prawa, dane kontaktowe i właściwe terminy po weryfikacji.]</p><h2>Odstąpienie i zwroty</h2><p>[Prawa kupujących, koszty i formularz. Nie zakładaj automatycznie, że żywność wyłącza zwroty. Potwierdź zasadność ewentualnych wyjątków.]</p><h2>Pozostałe postanowienia</h2><p>[Aktualne wymagane informacje dla konkretnego modelu sprzedaży, zmiany regulaminu i pozasądowe rozwiązywanie sporów po weryfikacji.]</p>'),
        'polityka-prywatnosci'=>array('Polityka prywatności','<h2>Dokument roboczy — wymaga uzupełnienia</h2><p>[Administrator i kontakt.]</p><h2>Cele i podstawy przetwarzania</h2><p>[Zamówienia, księgowość, konto, korespondencja, roszczenia zgodnie z rzeczywistymi procesami.]</p><h2>Odbiorcy i retencja danych</h2><p>[Hosting, poczta, operatorzy, dostawcy, księgowość, czas przechowywania i ewentualne transfery.]</p><h2>Prawa osób</h2><p>[Prawa i realizacja, organ nadzorczy, dobrowolność, konsekwencje niepodania danych po weryfikacji.]</p><h2>Cookies</h2><p>[Zrób audyt faktycznie zainstalowanych wtyczek, sesji i koszyka. Oceń mechanizmy zgód po dodaniu analityki i marketingu.]</p><p>Motyw nie dodaje zewnętrznych fontów, pikseli reklamowych ani analityki. Dodatki mogą to zmieniać.</p>'),
        'dostawa-i-platnosci'=>array('Dostawa i płatności','<h2>Dokument roboczy — uzupełnij przed publikacją</h2><h2>Dostawa</h2><p>[Metody, regiony, koszty końcowe, czas przygotowania i transportu, zasady odbioru.]</p><h2>Płatności</h2><p>[Wyłącznie uruchomione metody. Nie deklaruj BLIK-u, kart ani InPost, jeżeli nie zostały skonfigurowane i sprawdzone.]</p><h2>Kontakt</h2><p>[Telefon i e-mail sprzedawcy.]</p>'),
        'zwroty-i-reklamacje'=>array('Zwroty i reklamacje','<h2>Dokument roboczy — wymaga weryfikacji</h2><p>[Adres zwrotów i reklamacji, e-mail i telefon.]</p><h2>Reklamacje</h2><p>[Sposób zgłoszenia, identyfikacja zamówienia, właściwa procedura i terminy.]</p><h2>Odstąpienie od umowy</h2><p>[Zasady odpowiednie do produktów, uprawnienia, terminy, koszty i formularz. Zweryfikuj ewentualne wyjątki.]</p>')
    );
}
function ppds_setup() {
    if (!class_exists('WooCommerce')) { throw new Exception('Najpierw zainstaluj i aktywuj WooCommerce.'); }
    $pages=array('shop'=>array('sklep','Miody',''),'cart'=>array('koszyk','Koszyk','[woocommerce_cart]'),'checkout'=>array('zamowienie','Zamówienie','[woocommerce_checkout]'),'myaccount'=>array('moje-konto','Moje konto','[woocommerce_my_account]'));
    foreach ($pages as $option=>$spec) {
        $existing=absint(get_option('woocommerce_'.$option.'_page_id'));
        if ($existing && get_post_status($existing)==='publish') { continue; }
        $id=ppds_insert_page($spec[0],$spec[1],$spec[2],'publish');
        update_option('woocommerce_'.$option.'_page_id',$id);
    }
    foreach (ppds_legal_drafts() as $slug=>$data) { ppds_insert_page($slug,$data[0],$data[1]); }
    update_option('ppds_initialized','yes'); flush_rewrite_rules(false);
}
function ppds_checks() {
    $woo=class_exists('WooCommerce'); $payments=false; $shipping=false; $priced=false;
    if ($woo) {
        foreach (WC()->payment_gateways()->payment_gateways() as $gateway) { if ($gateway->enabled==='yes') { $payments=true; break; } }
        $zones=WC_Shipping_Zones::get_zones(); $zones[]=array('zone_id'=>0);
        foreach ($zones as $zone) { $z=new WC_Shipping_Zone($zone['zone_id']); if (count($z->get_shipping_methods(true))) { $shipping=true; break; } }
        foreach (wc_get_products(array('status'=>'publish','limit'=>-1,'return'=>'objects')) as $product) {
            if ($product->is_in_stock() && $product->get_price()!=='' && (float)$product->get_price()>0) { $priced=true; break; }
        }
    }
    $legal=true;
    foreach (array_keys(ppds_legal_drafts()) as $slug) { $p=get_page_by_path($slug); if (!$p || $p->post_status!=='publish') { $legal=false; } }
    $terms=absint(get_option('woocommerce_terms_page_id')); $privacy=absint(get_option('wp_page_for_privacy_policy'));
    $pages=true;
    foreach (array('shop','cart','checkout','myaccount') as $type) { if (get_post_status(absint(get_option('woocommerce_'.$type.'_page_id')))!=='publish') { $pages=false; } }
    return array(
        array($woo,'WooCommerce jest aktywny.'),
        array($pages,'Strony sklepu, koszyka, zamówienia i konta są opublikowane i przypisane.'),
        array($priced,'Jest opublikowany produkt z ceną większą od zera i dostępnością.'),
        array($payments,'Włączono metodę płatności. To nie potwierdza poprawności integracji.'),
        array($shipping,'Jest włączona metoda dostawy lub odbioru. Sprawdź strefy i koszty.'),
        array($legal,'Opublikowano cztery strony informacyjne. Treść wymaga osobistej weryfikacji.'),
        array($terms && get_post_status($terms)==='publish','Przypisano opublikowany regulamin w WooCommerce.'),
        array($privacy && get_post_status($privacy)==='publish','Przypisano opublikowaną politykę prywatności w WordPressie.'),
        array(is_ssl(),'Panel jest otwarty przez HTTPS. Sprawdź także całą witrynę.'),
        array(get_theme_mod('ppd_contact_confirmed',false) && get_theme_mod('ppd_address','') && (get_theme_mod('ppd_email','') || get_theme_mod('ppd_phone','')),'Potwierdzono adres i e-mail lub telefon w ustawieniach motywu.')
    );
}
function ppds_handle_action() {
    if (!current_user_can('manage_options')) { wp_die('Brak uprawnień.'); }
    check_admin_referer('ppds_action');
    $action=isset($_POST['ppds_do'])?sanitize_key(wp_unslash($_POST['ppds_do'])):'';
    try {
        if ($action==='setup') { ppds_setup(); $message='Utworzono brakujące strony i dokumenty robocze bez nadpisywania istniejących treści.'; }
        elseif ($action==='front') {
            $id=ppds_insert_page('strona-glowna','Strona główna','','publish');
            if (get_post_status($id)!=='publish') { throw new Exception('Istniejąca strona startowa nie jest opublikowana. Najpierw sprawdź ją w zakładce Strony.'); }
            update_option('show_on_front','page'); update_option('page_on_front',$id); $message='Ustawiono stronę główną Pasieki.';
        }
        elseif ($action==='pl') {
            update_option('woocommerce_currency','PLN'); update_option('woocommerce_default_country','PL');
            update_option('woocommerce_weight_unit','kg'); update_option('woocommerce_dimension_unit','cm');
            $message='Ustawiono PLN, Polskę i jednostki kg/cm. To nie przelicza cen istniejących produktów. Podatki i adres uzupełnij ręcznie.';
        }
        elseif ($action==='close') { update_option('ppds_sales_open','no'); update_option('ppds_test_open','no'); $message='Sprzedaż zablokowana.'; }
        elseif ($action==='test') {
            if (!in_array(wp_get_environment_type(),array('local','development','staging'),true)) { throw new Exception('Tryb testowy jest dostępny tylko w środowisku local/development/staging, nie production.'); }
            if (!class_exists('WooCommerce')) { throw new Exception('Aktywuj WooCommerce.'); }
            update_option('ppds_sales_open','yes'); update_option('ppds_test_open','yes');
            $message='Odblokowano zakupy testowe. Włącz sandbox operatora i zabezpiecz staging hasłem — ten przycisk nie ustawia sandbox.';
        }
        elseif ($action==='open') {
            foreach (ppds_checks() as $check) { if (!$check[0]) { throw new Exception('Nie wszystkie kontrole są spełnione. Sprawdź listę.'); } }
            if (empty($_POST['ppds_attest'])) { throw new Exception('Potwierdź wykonanie testów i weryfikację danych.'); }
            update_option('ppds_sales_open','yes'); update_option('ppds_test_open','no');
            $message='Odblokowano sprzedaż. Sprawdź także widoczność WooCommerce i tryb produkcyjny operatora.';
        } else { throw new Exception('Nieznana operacja.'); }
        set_transient('ppds_feedback_'.get_current_user_id(),array('success',$message),120);
    } catch (Exception $e) { set_transient('ppds_feedback_'.get_current_user_id(),array('error',$e->getMessage()),120); }
    wp_safe_redirect(admin_url('admin.php?page=pasieka-start')); exit;
}
add_action('admin_post_ppds_action','ppds_handle_action');
function ppds_form_button($action,$label) {
    echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" style="margin:16px 0">'; wp_nonce_field('ppds_action');
    echo '<input type="hidden" name="action" value="ppds_action"><input type="hidden" name="ppds_do" value="'.esc_attr($action).'"><button class="button button-secondary">'.esc_html($label).'</button></form>';
}
function ppds_admin_screen() {
    if (!current_user_can('manage_options')) { return; }
    echo '<div class="wrap" style="max-width:980px"><h1>Pasieka — wdrożenie sklepu</h1><p>Stan sprzedaży: <strong>'.(ppds_closed()?'ZABLOKOWANA':'ODBLOKOWANA').'</strong></p>';
    $feedback=get_transient('ppds_feedback_'.get_current_user_id());
    if ($feedback) { delete_transient('ppds_feedback_'.get_current_user_id()); echo '<div class="notice notice-'.esc_attr($feedback[0]).'"><p>'.esc_html($feedback[1]).'</p></div>'; }
    echo '<p>Pracuj na nowej instalacji lub chronionej kopii testowej. Zrób backup. Wtyczka nie tworzy kont operatorów ani nie zastępuje audytu.</p><h2>1. Struktura i oferta</h2><p>Tworzy brakujące strony sklepu oraz dokumenty robocze. Dokumenty pozostają szkicami. Istniejące treści nie są nadpisywane. Nowy koszyk i checkout mają klasyczne shortcode. Produkty zaimportuj z pliku woocommerce/products-import.csv (Produkty → Importuj); instrukcja jest w WDROZENIE.md.</p>';
    ppds_form_button('setup','Utwórz brakujące strony i dokumenty robocze');
    echo '<h2>2. Strona główna i waluta</h2><p>Osobne operacje świadomie zmieniają stronę główną oraz walutę i jednostki sklepu.</p>';
    ppds_form_button('front','Ustaw stronę startową Pasieki jako główną');
    ppds_form_button('pl','Ustaw PLN, kraj Polska i jednostki kg/cm');
    echo '<h2>3. Przygotowanie</h2><p>Produkty edytuj w „Produkty”, treści i kontakt w „Wygląd → Dostosuj → Pasieka — treści i kontakt”. Dane sprzedawcy, podatki, dostawy, płatności i e-maile ustaw w WooCommerce. Dokumenty robocze znajdziesz w „Strony”.</p><ul style="list-style:disc;padding-left:24px">';
    foreach (ppds_checks() as $check) { echo '<li style="padding:6px 0">'.($check[0]?'✓':'—').' '.esc_html($check[1]).'</li>'; }
    echo '</ul><p>Lista sprawdza obecność ustawień, nie poprawność danych, dokumentów ani przebieg transakcji.</p><h2>4. Testy i start</h2><p>Na chronionym stagingu ustaw WP_ENVIRONMENT_TYPE staging i włącz sandbox operatora. Oddzielny przycisk testowy nie jest dostępny w produkcji. Nie przełącza sam operatora w sandbox.</p>';
    if (in_array(wp_get_environment_type(),array('local','development','staging'),true)) { ppds_form_button('test','Odblokuj zakupy testowe na stagingu'); }
    echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('ppds_action');
    echo '<input type="hidden" name="action" value="ppds_action"><input type="hidden" name="ppds_do" value="open"><p><label><input type="checkbox" name="ppds_attest" value="1" required> Potwierdzam weryfikację oferty, danych sprzedawcy i dokumentów oraz testy dostaw, podatków, płatności, statusu zamówienia i e-maili. Rozumiem, że to nie jest audyt prawny ani płatności.</label></p><button class="button button-primary">Odblokuj sprzedaż produkcyjną</button></form>';
    ppds_form_button('close','Zablokuj sprzedaż');
    echo '<p>Nie wyłączaj wtyczki, aby omijać blokadę. Po dezaktywacji jej zabezpieczenia przestają działać. Tryb widoczności WooCommerce jest osobnym ustawieniem.</p></div>';
}
