<?php if (!defined('ABSPATH')) { exit; } get_header(); ?>
<style>
@media(min-width:1100px){.product-grid{grid-template-columns:repeat(5,1fr)!important}}
@media(min-width:860px) and (max-width:1099px){.product-grid{grid-template-columns:repeat(4,1fr)!important}}
@media(min-width:560px) and (max-width:859px){.product-grid{grid-template-columns:repeat(3,1fr)!important}}
.honey-card{padding:0!important;display:flex;flex-direction:column}
.honey-card .sample-image{aspect-ratio:4/5!important;min-height:0!important;overflow:hidden;border-radius:26px;margin-bottom:18px;background:linear-gradient(160deg,#f4eeda,#e9edda)}
.honey-card .sample-image img{width:100%!important;height:100%!important;max-height:none!important;aspect-ratio:4/5!important;object-fit:cover!important;padding:0!important;margin:0!important;transition:transform .5s ease}
.honey-card:hover .sample-image img{transform:scale(1.05)}
.honey-card h3{font-size:1.35rem!important;line-height:1.2!important;margin:0 0 8px!important}
.honey-card h3 a{text-decoration:none}
.honey-card p{font-size:.85rem!important}
.honey-card .card-price{font:600 1.1rem/1.2 var(--sans);color:#8e561a;margin:0 0 14px!important}
.honey-form{margin-top:auto;display:flex;flex-direction:column;gap:10px}
.gramatura-field{position:relative;display:flex}
.gramatura-field:before{content:'';position:absolute;right:20px;top:50%;width:9px;height:9px;border-right:1.6px solid var(--forest);border-bottom:1.6px solid var(--forest);transform:translateY(-70%) rotate(45deg);pointer-events:none}
.honey-form select{appearance:none;-webkit-appearance:none;-moz-appearance:none;width:100%;min-height:50px;padding:0 46px 0 18px;border:1px solid #d5d9c8;border-radius:100px;background:var(--white);color:var(--ink);font:600 .92rem/1.2 var(--sans);letter-spacing:.01em;cursor:pointer;transition:border-color .2s ease,box-shadow .2s ease,background-color .2s ease}
.honey-form select:hover{border-color:#b9c0a8}
.honey-form select:focus{border-color:var(--forest);box-shadow:0 0 0 3px rgba(32,62,45,.10);outline:none}
.honey-form select:disabled{opacity:.55;cursor:not-allowed}
.qty-stepper{display:flex;align-items:center;justify-content:space-between;border:1px solid #d5d9c8;border-radius:100px;background:var(--white);padding:4px;min-height:50px}
.qty-stepper button{width:42px;height:42px;border:0;border-radius:50%;background:#f2f0e3;color:var(--forest);font-size:20px;line-height:1;display:grid;place-items:center;transition:background-color .18s ease,color .18s ease}
.qty-stepper button:hover{background:var(--forest);color:#fffdf5}
.qty-stepper input[type=number]{width:56px;border:0;background:transparent;text-align:center;font:600 1rem var(--sans);color:var(--ink);min-height:42px;-moz-appearance:textfield}
.qty-stepper input[type=number]::-webkit-outer-spin-button,.qty-stepper input[type=number]::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
.honey-form .btn{width:100%;margin-top:2px;background:transparent;color:var(--forest);border:1px solid var(--forest)}
.honey-form .btn:hover{background:var(--forest);color:#fffdf5}
.category-filter{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:34px}
.category-filter button{background:transparent;border:1px solid #c9cfba;border-radius:100px;padding:11px 20px;min-height:44px;font:600 13px/1.2 var(--sans);color:var(--ink);transition:all .2s ease}
.category-filter button:hover{border-color:var(--forest);background:rgba(32,62,45,.05)}
.category-filter button.is-active{background:var(--forest);border-color:var(--forest);color:#fffdf5}
.honey-card.is-hidden{display:none!important}
.why-art{max-width:180px;margin-top:var(--s4,1rem)}
.social-links{display:flex;gap:var(--s3,.75rem);flex-wrap:wrap;margin-top:var(--s4,1rem)}
.social-links a{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1rem;border:1px solid rgba(255,255,255,.25);border-radius:.5rem;color:inherit;text-decoration:none}
.social-links a:hover{border-color:currentColor}
@media(max-width:560px){.honey-form select{font-size:.88rem;padding-right:42px}.gramatura-field:before{right:17px}}
</style>
<?php
$social_links = array(
 'Facebook' => '',
 'Instagram' => '',
);
?>
<main id="main"><div class="wrap hero"><div><span class="eyebrow">Z Kiczyc. Na Twój stół.</span><h1><?php echo esc_html(ppd_setting('hero_title','Miód. Mały słoik, wielka przyjemność.')); ?></h1><p class="lead"><?php echo esc_html(ppd_setting('hero_text','Pasieka Pod Dębem w Kiczycach. Poznaj naszą ofertę i wybierz miód do swojego stołu.')); ?></p><div class="actions"><a class="btn" href="#oferta">Poznaj nasze miody ↗</a><a class="btn secondary" href="#o-pasiece">Poznaj pasiekę</a><?php $hero_phone=(string) ppd_setting('phone'); if ($hero_phone): ?><a class="btn ghost" href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$hero_phone)); ?>">Zadzwoń</a><?php endif; ?></div><p class="small-note">Pasieka Pod Dębem · Kiczyce, gmina Skoczów · Odbiór osobisty po potwierdzeniu zamówienia</p></div><div class="hero-art">
<?php $hero=absint(ppd_setting('hero_image',0)); if ($hero) { echo wp_get_attachment_image($hero,'large',false,array('loading'=>'eager','fetchpriority'=>'high')); } else { ?><img class="illustration" src="<?php echo esc_url(get_template_directory_uri().'/assets/jar.svg'); ?>" alt="Autorska ilustracja słoika — nie zdjęcie produktu" width="600" height="660" fetchpriority="high"><?php } ?>
<div class="art-tag"><span>Pasieka Pod Dębem</span><span>Kiczyce · Polska</span></div></div></div>
<div class="feature-strip"><div class="wrap features"><div class="feature">01 / Wybierz swój smak<span>Poznaj dostępne rodzaje miodu.</span></div><div class="feature">02 / Poznaj pasiekę<span>Jesteśmy w Kiczycach, koło Skoczowa.</span></div><div class="feature">03 / Porozmawiajmy<span>Zapytaj nas o aktualną ofertę.</span></div></div></div>
<section class="section wrap" id="oferta"><div class="section-head"><div><span class="eyebrow">Co zamkniemy w Twoim słoiku?</span><h2>Wybierz miód.</h2></div><p>Wybierz kategorię, gramaturę i dodaj produkt do koszyka.</p></div>
<div class="category-filter" id="category-filter">
 <button type="button" class="is-active" data-filter="all">Wszystkie</button>
 <button type="button" data-filter="miody-klasyczne">Miody klasyczne</button>
 <button type="button" data-filter="kremowane">Miody kremowane</button>
 <button type="button" data-filter="pylek-i-pierzga">Pyłek i pierzga</button>
</div>
<div class="product-grid" id="product-grid">
<?php
$homepage_products = wc_get_products(array(
 'status' => 'publish',
 'limit' => 30,
 'orderby' => 'menu_order',
 'order' => 'ASC',
));

foreach ($homepage_products as $product):
 if (!$product->is_purchasable() || !$product->is_in_stock()) { continue; }

 $product_id = $product->get_id();
 $product_link = get_permalink($product_id);
 $product_name = $product->get_name();
 $is_variable = $product->is_type('variable');
 $fallback_image = ($product->get_slug() === 'pierzga') ? 'stempel.svg' : 'bee.svg';
 $category_slugs = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));

 $variations = array();
 if ($is_variable) {
  foreach ($product->get_children() as $variation_id) {
   $variation = wc_get_product($variation_id);
   if (!$variation || !$variation->is_purchasable() || !$variation->is_in_stock()) { continue; }
   $attributes = $variation->get_attributes();
   $gramatura = isset($attributes['gramatura']) ? $attributes['gramatura'] : (isset($attributes['Gramatura']) ? $attributes['Gramatura'] : '');
   if ($gramatura === '') { continue; }
   $variations[] = array(
    'id' => $variation_id,
    'label' => $gramatura,
    'price' => wc_get_price_to_display($variation),
   );
  }
 }

 if ($is_variable && empty($variations)) { continue; }
?>
<article class="sample-card honey-card" data-category="<?php echo esc_attr(implode(' ', $category_slugs)); ?>">
 <a href="<?php echo esc_url($product_link); ?>" class="sample-image">
<?php if ($product->get_image_id()) : ?>
  <?php echo $product->get_image('woocommerce_thumbnail', array('loading' => 'lazy', 'alt' => $product_name)); ?>
<?php else : ?>
  <img src="<?php echo esc_url(get_template_directory_uri().'/assets/'.$fallback_image); ?>" alt="<?php echo esc_attr($product_name); ?>" width="600" height="660" loading="lazy">
<?php endif; ?>
 </a>
 <h3><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html($product_name); ?></a></h3>

<?php if ($is_variable) : $first = $variations[0]; ?>
 <p class="card-price" data-price-for="product-<?php echo esc_attr($product_id); ?>"><?php echo wp_kses_post(wc_price($first['price'])); ?></p>
 <form class="honey-form" method="post" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
  <input type="hidden" name="variation_id" value="<?php echo esc_attr($first['id']); ?>">
  <label class="screen-reader-text" for="gramatura-<?php echo esc_attr($product_id); ?>">Gramatura</label>
  <div class="gramatura-field">
   <select id="gramatura-<?php echo esc_attr($product_id); ?>" class="gramatura-select" name="attribute_gramatura">
<?php foreach ($variations as $variation) : ?>
    <option value="<?php echo esc_attr($variation['label']); ?>" data-variation-id="<?php echo esc_attr($variation['id']); ?>" data-price="<?php echo esc_attr($variation['price']); ?>"><?php echo esc_html($variation['label']); ?> — <?php echo esc_html(wp_strip_all_tags(wc_price($variation['price']))); ?></option>
<?php endforeach; ?>
   </select>
  </div>
  <div class="qty-stepper">
   <button type="button" class="qty-btn" data-step="-1" aria-label="Zmniejsz ilość">−</button>
   <label class="screen-reader-text" for="qty-<?php echo esc_attr($product_id); ?>">Ilość</label>
   <input id="qty-<?php echo esc_attr($product_id); ?>" class="qty-input" type="number" name="quantity" value="1" min="1" max="20" step="1" inputmode="numeric">
   <button type="button" class="qty-btn" data-step="1" aria-label="Zwiększ ilość">+</button>
  </div>
  <button type="submit" class="btn">Dodaj do koszyka</button>
 </form>
<?php else : ?>
 <p class="card-price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
 <form class="honey-form" method="post" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
  <div class="qty-stepper">
   <button type="button" class="qty-btn" data-step="-1" aria-label="Zmniejsz ilość">−</button>
   <label class="screen-reader-text" for="qty-<?php echo esc_attr($product_id); ?>">Ilość</label>
   <input id="qty-<?php echo esc_attr($product_id); ?>" class="qty-input" type="number" name="quantity" value="1" min="1" max="20" step="1" inputmode="numeric">
   <button type="button" class="qty-btn" data-step="1" aria-label="Zwiększ ilość">+</button>
  </div>
  <button type="submit" class="btn">Dodaj do koszyka</button>
 </form>
<?php endif; ?>
</article>
<?php endforeach; ?>
</div>
<div class="actions"><a class="btn secondary" href="<?php echo esc_url(function_exists('ppd_shop_url') ? ppd_shop_url() : home_url('/shop/')); ?>">Zobacz całą ofertę</a><a class="btn ghost" href="<?php echo esc_url(get_template_directory_uri().'/assets/cennik-2026.pdf'); ?>" download>Pobierz cennik 2026 (PDF)</a></div>
<p class="small-note">Dostępność poszczególnych miodów może być sezonowa. Aktualną dostępność znajdziesz w sklepie.</p>
</section>
<script>
document.addEventListener('change', function(event) {
 var select = event.target.closest('.gramatura-select');
 if (!select) { return; }
 var form = select.closest('.honey-form');
 var option = select.options[select.selectedIndex];
 var variationId = option.getAttribute('data-variation-id');
 var price = option.getAttribute('data-price');
 var hiddenVariation = form.querySelector('input[name="variation_id"]');
 if (hiddenVariation && variationId) { hiddenVariation.value = variationId; }
 var priceElement = form.parentElement.querySelector('.card-price');
 if (priceElement && price) { priceElement.innerHTML = price; }
});

document.addEventListener('click', function(event) {
 var stepperButton = event.target.closest('.qty-btn');
 if (stepperButton) {
  var stepper = stepperButton.closest('.qty-stepper');
  var input = stepper.querySelector('.qty-input');
  var step = parseInt(stepperButton.getAttribute('data-step'), 10);
  var value = parseInt(input.value || '1', 10);
  var min = parseInt(input.getAttribute('min') || '1', 10);
  var max = parseInt(input.getAttribute('max') || '20', 10);
  input.value = Math.min(max, Math.max(min, value + step));
  return;
 }

 var button = event.target.closest('#category-filter button');
 if (!button) { return; }
 var filter = button.getAttribute('data-filter');
 var buttons = document.querySelectorAll('#category-filter button');
 var cards = document.querySelectorAll('#product-grid .honey-card');
 buttons.forEach(function(item) { item.classList.toggle('is-active', item === button); });
 cards.forEach(function(card) {
  var categories = (card.getAttribute('data-category') || '').split(' ');
  var show = filter === 'all' || categories.indexOf(filter) !== -1;
  card.classList.toggle('is-hidden', !show);
 });
});
</script>
<section class="section wrap" id="dlaczego"><div class="section-head"><div><span class="eyebrow">Dlaczego warto</span><h2>Miód z lokalnej pasieki.</h2></div><p>Bezpośredni kontakt, sezonowa oferta i produkty z Kiczyc.</p></div><div class="why-grid"><div class="why-card"><img class="why-art" src="<?php echo esc_url(get_template_directory_uri().'/assets/bee.svg'); ?>" alt="" width="240" height="240" loading="lazy"><h3>Lokalnie z Kiczyc</h3><p>Pasieka działa w Kiczycach, w gminie Skoczów, na Śląsku Cieszyńskim.</p></div><div class="why-card"><h3>Sezonowość</h3><p>Rodzaje miodu zależą od pory roku i kwitnienia roślin. Dlatego dostępność poszczególnych produktów może się zmieniać.</p></div><div class="why-card"><h3>Bezpośredni kontakt</h3><p>Masz pytanie o produkt lub dostępność? Skontaktuj się z nami przed zakupem.</p></div></div></section>
<section id="o-pasiece" class="wrap"><div class="story-panel"><div><span class="eyebrow">Pasieka Pod Dębem</span><h2>Dobre rzeczy zaczynają się blisko.</h2><img class="oak-art" src="<?php echo esc_url(get_template_directory_uri().'/assets/oak.svg'); ?>" alt="" width="240" height="240" loading="lazy"></div><div><p><?php echo nl2br(esc_html(ppd_setting('story',ppd_default_story()))); ?></p><p>Masz pytania? Zacznijmy od rozmowy.</p><div class="actions"><a class="btn" href="#kontakt">Skontaktuj się z nami ↗</a></div></div></div></section>
<?php $map_address=ppd_map_query(); if ($map_address!==''): $map_phone=(string) ppd_setting('phone'); ?>
<section class="section wrap" id="odbior"><div class="section-head"><div><span class="eyebrow">Adres i mapa</span><h2>Gdzie nas znajdziesz.</h2></div><p>Odbiór osobisty, jeśli jest dostępny, zobaczysz jako metodę dostawy w koszyku.</p></div><div class="pickup-grid"><div class="pickup-info"><h3>Pasieka Pod Dębem</h3><p><?php echo nl2br(esc_html($map_address)); ?></p><?php if ($map_phone!==''): ?><p>Telefon: <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$map_phone)); ?>"><?php echo esc_html($map_phone); ?></a></p><?php endif; ?><a class="btn secondary" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url('https://www.google.com/maps/search/?api=1&query='.rawurlencode($map_address)); ?>">Otwórz w Mapach Google ↗</a></div><div class="pickup-map" id="map-box"><div class="map-consent"><p>Mapa Google ładuje się dopiero po kliknięciu i może przesyłać dane do Google.</p><button class="btn secondary" id="map-load" type="button" data-src="<?php echo esc_url('https://www.google.com/maps?q='.rawurlencode($map_address).'&output=embed'); ?>">Pokaż mapę</button></div></div></div></section>
<?php endif; ?>
<section class="section wrap" id="pytania"><div class="faq-layout"><div><span class="eyebrow">Przed zamówieniem</span><h2>Warto wiedzieć.</h2><p class="lead">Kilka odpowiedzi, które ułatwią Ci zakupy.</p></div><div><?php foreach (ppd_faq_items() as $faq_item): ?><details><summary><?php echo esc_html($faq_item[0]); ?></summary><p><?php echo esc_html($faq_item[1]); ?></p></details><?php endforeach; ?></div></div></section>
<section class="wrap section" id="kontakt"><div class="contact-panel"><div><span class="eyebrow">Zostańmy w kontakcie</span><h2>Porozmawiajmy o miodzie.</h2><p class="lead">Pasieka Pod Dębem<br>Kiczyce · gmina Skoczów</p></div><div class="contact-links">
<?php if (ppd_setting('contact_confirmed',false)):
$phone=ppd_setting('phone'); $email=ppd_setting('email'); $address=ppd_setting('address','Kiczyce, gmina Skoczów');
if ($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a><?php endif;
if ($email): ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php endif; ?>
<p class="contact-meta"><?php echo nl2br(esc_html($address)); ?></p><a class="contact-meta" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url('https://www.google.com/maps/search/?api=1&query='.rawurlencode($address)); ?>">Otwórz mapę ↗</a><a class="contact-meta" href="<?php echo esc_url(home_url('/dane-firmy/')); ?>">Dane firmy ↗</a>
<?php else: ?><p class="contact-meta">Dane kontaktowe zostaną opublikowane po potwierdzeniu przez pasiekę.</p><?php endif; ?>
<?php $has_social=array_filter($social_links); if ($has_social): ?><div class="social-links"><?php foreach ($social_links as $social_name => $social_url): if ($social_url): ?><a href="<?php echo esc_url($social_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($social_name); ?> ↗</a><?php endif; endforeach; ?></div><?php endif; ?>
</div></div></section></main><?php get_footer(); ?>