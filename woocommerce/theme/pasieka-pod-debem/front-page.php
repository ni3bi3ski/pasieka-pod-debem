<?php if (!defined('ABSPATH')) { exit; } get_header(); ?>
<style>
@media(min-width:1200px){.product-grid{grid-template-columns:repeat(6,1fr)!important;gap:18px!important}.honey-card h3{font-size:1.1rem!important}.honey-card .sample-image{border-radius:20px;margin-bottom:14px}.honey-form{gap:8px}.honey-form select{min-height:46px;font-size:.82rem;padding:0 38px 0 15px}.honey-form .btn{min-height:46px;font-size:.82rem;padding:11px 18px}.gramatura-field:before{right:15px}}
@media(min-width:900px) and (max-width:1199px){.product-grid{grid-template-columns:repeat(4,1fr)!important}}
@media(min-width:640px) and (max-width:899px){.product-grid{grid-template-columns:repeat(3,1fr)!important}}
@media(max-width:639px){.product-grid{grid-template-columns:repeat(2,1fr)!important}}
.honey-card{padding:0!important;display:flex;flex-direction:column}
.honey-card .sample-image{aspect-ratio:4/5!important;min-height:0!important;overflow:hidden;border-radius:26px;margin-bottom:18px;background:linear-gradient(160deg,#f4eeda,#e9edda)}
.honey-card .sample-image img{width:100%!important;height:100%!important;max-height:none!important;aspect-ratio:4/5!important;object-fit:cover!important;padding:0!important;margin:0!important;transition:transform .5s ease}
.honey-card:hover .sample-image img{transform:scale(1.05)}
.honey-card h3{font-size:1.35rem!important;line-height:1.2!important;margin:0 0 8px!important}
.honey-card h3 a{text-decoration:none}
.honey-card p{font-size:.85rem!important}
.honey-form{margin-top:auto;display:flex;flex-direction:column;gap:10px}
.gramatura-field{position:relative;display:flex}
.gramatura-field:before{content:'';position:absolute;right:18px;top:50%;width:8px;height:8px;border-right:1.6px solid var(--forest);border-bottom:1.6px solid var(--forest);transform:translateY(-70%) rotate(45deg);pointer-events:none}
.honey-form select{appearance:none;-webkit-appearance:none;-moz-appearance:none;width:100%;min-height:50px;padding:0 44px 0 18px;border:1px solid #d5d9c8;border-radius:100px;background:var(--white);color:var(--ink);font:600 .9rem/1.2 var(--sans);letter-spacing:.01em;cursor:pointer;transition:border-color .2s ease,box-shadow .2s ease,background-color .2s ease}
.honey-form select:hover{border-color:#b9c0a8}
.honey-form select:focus{border-color:var(--forest);box-shadow:0 0 0 3px rgba(32,62,45,.10);outline:none}
.honey-form select:disabled{opacity:.55;cursor:not-allowed}
.honey-form .btn{width:100%;margin-top:0;background:transparent;color:var(--forest);border:1px solid var(--forest)}
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
@media(max-width:560px){.honey-form select{font-size:.86rem;padding-right:40px}.gramatura-field:before{right:16px}}
</style>
<?php
$social_links = array(
 'Facebook' => '',
 'Instagram' => '',
);
?>
<main id="main"><div class="wrap hero"><div><span class="eyebrow">Pasieka Pod Dębem · Kiczyce</span><h1>Miody z naszej pasieki w Kiczycach</h1><p class="lead">Wybierz miód, pyłek lub pierzgę prosto z Pasieki Pod Dębem. Produkty są dostępne w kilku gramaturach, a zamówienie możesz odebrać osobiście lub otrzymać wysyłką.</p><div class="actions"><a class="btn" href="#oferta">Zobacz miody ↗</a><a class="btn secondary" href="#o-pasiece">Poznaj pasiekę</a><?php $hero_phone=(string) ppd_setting('phone'); if ($hero_phone): ?><a class="btn ghost" href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$hero_phone)); ?>">Zadzwoń</a><?php endif; ?></div><p class="small-note">Pasieka Pod Dębem · Kiczyce, gmina Skoczów · Odbiór osobisty po potwierdzeniu zamówienia</p></div><div class="hero-art">
<?php $hero=absint(ppd_setting('hero_image',0)); if ($hero) { echo wp_get_attachment_image($hero,'large',false,array('loading'=>'eager','fetchpriority'=>'high')); } else { ?><img class="illustration" src="<?php echo esc_url(get_template_directory_uri().'/assets/stempel.svg'); ?>" alt="Stempel Pasieki Pod Dębem" width="600" height="660" fetchpriority="high"><?php } ?>
<div class="art-tag"><span>Pasieka Pod Dębem</span><span>Kiczyce · Polska</span></div></div></div>
<div class="feature-strip"><div class="wrap features"><div class="feature">01 / Lokalna pasieka<span>Miody z Kiczyc, w sercu Śląska Cieszyńskiego.</span></div><div class="feature">02 / Sezonowa oferta<span>Dostępność zależy od pory roku i kwitnienia roślin.</span></div><div class="feature">03 / Proste zamówienie<span>Wybierz gramaturę, dodaj do koszyka i sfinalizuj zakup online.</span></div></div></div>
<section class="section wrap" id="oferta"><div class="section-head"><div><span class="eyebrow">Nasze produkty</span><h2>Wybierz swój miód</h2></div><p>Filtruj według kategorii, wybierz gramaturę z ceną i dodaj produkt do koszyka.</p></div>
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
 <form class="honey-form" method="post" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
  <input type="hidden" name="variation_id" value="<?php echo esc_attr($first['id']); ?>">
  <input type="hidden" name="quantity" value="1">
  <label class="screen-reader-text" for="gramatura-<?php echo esc_attr($product_id); ?>">Gramatura i cena</label>
  <div class="gramatura-field">
   <select id="gramatura-<?php echo esc_attr($product_id); ?>" class="gramatura-select" name="attribute_gramatura">
<?php foreach ($variations as $variation) : ?>
    <option value="<?php echo esc_attr($variation['label']); ?>" data-variation-id="<?php echo esc_attr($variation['id']); ?>" data-price="<?php echo esc_attr($variation['price']); ?>"><?php echo esc_html($variation['label']); ?> — <?php echo esc_html(wp_strip_all_tags(wc_price($variation['price']))); ?></option>
<?php endforeach; ?>
   </select>
  </div>
  <button type="submit" class="btn">Dodaj do koszyka</button>
 </form>
<?php else : ?>
 <form class="honey-form" method="post" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>">
  <input type="hidden" name="quantity" value="1">
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
 var hiddenVariation = form.querySelector('input[name="variation_id"]');
 if (hiddenVariation && variationId) { hiddenVariation.value = variationId; }
});

document.addEventListener('click', function(event) {
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
<section class="section wrap" id="dlaczego"><div class="section-head"><div><span class="eyebrow">Dlaczego warto</span><h2>Dlaczego warto wybrać nasze miody</h2></div><p>Kupujesz bezpośrednio od pasieki z Kiczyc. Wiemy, co trafia do słoika i chętnie odpowiemy na pytania.</p></div><div class="why-grid"><div class="why-card"><img class="why-art" src="<?php echo esc_url(get_template_directory_uri().'/assets/bee.svg'); ?>" alt="" width="240" height="240" loading="lazy"><h3>Z naszej pasieki</h3><p>Produkty pochodzą z Pasieki Pod Dębem w Kiczycach. Nie jesteśmy pośrednikiem — rozmawiasz z osobą, która zna swoją pasiekę.</p></div><div class="why-card"><h3>Wybierz to, co Ci odpowiada</h3><p>W ofercie są miody klasyczne i kremowane, a także pyłek oraz pierzga. Dostępność zmienia się wraz z sezonem.</p></div><div class="why-card"><h3>Pomoc przed zakupem</h3><p>Nie wiesz, który miód wybrać albo jak wygląda odbiór? Napisz lub zadzwoń — podpowiemy konkretnie.</p></div></div></section>
<section id="o-pasiece" class="wrap"><div class="story-panel"><div><span class="eyebrow">O pasiece</span><h2>Pasieka Pod Dębem</h2><img class="oak-art" src="<?php echo esc_url(get_template_directory_uri().'/assets/oak.svg'); ?>" alt="" width="240" height="240" loading="lazy"></div><div><p>Prowadzimy pasiekę w Kiczycach, w gminie Skoczów. Zależy nam na produktach, które można spokojnie polecić rodzinie i znajomym: miodach, pyłku i pierzdze.</p><p>Nie obiecujemy cudów. Pokazujemy, co mamy, wyjaśniamy skąd pochodzi produkt i pomagamy wybrać odpowiednią gramaturę.</p><div class="actions"><a class="btn" href="#kontakt">Skontaktuj się z nami ↗</a></div></div></div></section>
<?php $map_address=ppd_map_query(); if ($map_address!==''): $map_phone=(string) ppd_setting('phone'); ?>
<section class="section wrap" id="odbior"><div class="section-head"><div><span class="eyebrow">Odbiór i wysyłka</span><h2>Gdzie nas znajdziesz</h2></div><p>Pasieka Pod Dębem znajduje się w Kiczycach, w gminie Skoczów. Jeśli odbiór osobisty jest dostępny, wybierzesz go jako metodę dostawy w koszyku.</p></div><div class="pickup-grid"><div class="pickup-info"><h3>Pasieka Pod Dębem</h3><p><?php echo nl2br(esc_html($map_address)); ?></p><?php if ($map_phone!==''): ?><p>Telefon: <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$map_phone)); ?>"><?php echo esc_html($map_phone); ?></a></p><?php endif; ?><a class="btn secondary" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url('https://www.google.com/maps/search/?api=1&query='.rawurlencode($map_address)); ?>">Otwórz w Mapach Google ↗</a></div><div class="pickup-map" id="map-box"><div class="map-consent"><p>Mapa Google ładuje się dopiero po kliknięciu i może przesyłać dane do Google.</p><button class="btn secondary" id="map-load" type="button" data-src="<?php echo esc_url('https://www.google.com/maps?q='.rawurlencode($map_address).'&output=embed'); ?>">Pokaż mapę</button></div></div></div></section>
<?php endif; ?>
<section class="section wrap" id="pytania"><div class="faq-layout"><div><span class="eyebrow">Przed zamówieniem</span><h2>Najczęstsze pytania</h2><p class="lead">Kilka odpowiedzi, które ułatwią Ci zakupy.</p></div><div>
<details><summary>Czy mogę odebrać zamówienie osobiście?</summary><p>Tak, jeśli odbiór osobisty jest dostępny. Wybierz go jako metodę dostawy w koszyku, a potwierdzimy termin odbioru.</p></details>
<details><summary>Czy wysyłacie miody?</summary><p>Tak. Dostępne metody dostawy i koszt wysyłki zobaczysz w koszyku po dodaniu produktów.</p></details>
<details><summary>Dlaczego niektórych miodów nie ma w ofercie?</summary><p>Miody są produktami sezonowymi. Dostępność zależy od kwitnienia roślin i wielkości zbiorów.</p></details>
<details><summary>Czym różni się miód kremowany od klasycznego?</summary><p>Miód kremowany ma gładką, równomierną konsystencję. Miód klasyczny może naturalnie krystalizować.</p></details>
<details><summary>Czy pyłek i pierzga są zawsze dostępne?</summary><p>Nie zawsze. Ich dostępność zależy od sezonu i aktualnych zapasów pasieki.</p></details>
</div></div></section>
<section class="wrap section" id="kontakt"><div class="contact-panel"><div><span class="eyebrow">Kontakt</span><h2>Porozmawiajmy o miodzie</h2><p class="lead">Masz pytanie o dostępność, odbiór lub wysyłkę? Skontaktuj się z nami.</p><p class="lead">Pasieka Pod Dębem<br>Kiczyce · gmina Skoczów</p></div><div class="contact-links">
<?php if (ppd_setting('contact_confirmed',false)):
$phone=ppd_setting('phone'); $email=ppd_setting('email'); $address=ppd_setting('address','Kiczyce, gmina Skoczów');
if ($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a><?php endif;
if ($email): ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php endif; ?>
<p class="contact-meta"><?php echo nl2br(esc_html($address)); ?></p><a class="contact-meta" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url('https://www.google.com/maps/search/?api=1&query='.rawurlencode($address)); ?>">Otwórz mapę ↗</a><a class="contact-meta" href="<?php echo esc_url(home_url('/dane-firmy/')); ?>">Dane firmy ↗</a>
<?php else: ?><p class="contact-meta">Dane kontaktowe zostaną opublikowane po potwierdzeniu przez pasiekę.</p><?php endif; ?>
<?php $has_social=array_filter($social_links); if ($has_social): ?><div class="social-links"><?php foreach ($social_links as $social_name => $social_url): if ($social_url): ?><a href="<?php echo esc_url($social_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($social_name); ?> ↗</a><?php endif; endforeach; ?></div><?php endif; ?>
</div></div></section></main><?php get_footer(); ?>