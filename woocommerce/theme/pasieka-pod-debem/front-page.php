<?php if (!defined('ABSPATH')) { exit; } get_header(); ?>
<main id="main"><div class="wrap hero"><div><span class="eyebrow">Z Kiczyc. Na Twój stół.</span><h1><?php echo esc_html(ppd_setting('hero_title','Miód. Mały słoik, wielka przyjemność.')); ?></h1><p class="lead"><?php echo esc_html(ppd_setting('hero_text','Pasieka Pod Dębem w Kiczycach. Poznaj naszą ofertę i wybierz miód do swojego stołu.')); ?></p><div class="actions"><a class="btn" href="#oferta">Poznaj nasze miody ↗</a><a class="btn secondary" href="#o-pasiece">Poznaj pasiekę</a></div><p class="small-note">Pasieka Pod Dębem · Kiczyce, gmina Skoczów</p></div><div class="hero-art">
<?php $hero=absint(ppd_setting('hero_image',0)); if ($hero) { echo wp_get_attachment_image($hero,'large',false,array('loading'=>'eager','fetchpriority'=>'high')); } else { ?><img class="illustration" src="<?php echo esc_url(get_template_directory_uri().'/assets/jar.svg'); ?>" alt="Autorska ilustracja słoika — nie zdjęcie produktu" width="600" height="660" fetchpriority="high"><?php } ?>
<div class="art-tag"><span>Pasieka Pod Dębem</span><span>Kiczyce · Polska</span></div></div></div>
<div class="feature-strip"><div class="wrap features"><div class="feature">01 / Wybierz swój smak<span>Poznaj dostępne rodzaje miodu.</span></div><div class="feature">02 / Poznaj pasiekę<span>Jesteśmy w Kiczycach, koło Skoczowa.</span></div><div class="feature">03 / Porozmawiajmy<span>Zapytaj nas o aktualną ofertę.</span></div></div></div>
<section class="section wrap" id="oferta"><div class="section-head"><div><span class="eyebrow">Co zamkniemy w Twoim słoiku?</span><h2>Wybierz miód.</h2></div><p>Kliknij produkt, aby zobaczyć szczegóły i dodać go do koszyka.</p></div>
<div class="product-grid">
<?php
$honey_links = array(
 'Miód kremowany z maliną' => 'miod-kremowany-z-malina',
 'Miód kremowany z cytryną' => 'miod-kremowany-z-cytryna',
 'Miód kremowany z rokitnikiem' => 'miod-kremowany-z-rokitnikiem',
 'Miód kremowany z truskawką' => 'miod-kremowany-z-truskawka',
 'Miód kremowany z żurawiną' => 'miod-kremowany-z-zurawina',
 'Miód kremowany z czarną porzeczką' => 'miod-kremowany-z-czarna-porzeczka',
 'Miód kremowany z czerwoną porzeczką' => 'miod-kremowany-z-czerwona-porzeczka',
 'Miód kremowany z limonką i miętą' => 'miod-kremowany-z-limonka-i-mieta',
 'Miód kremowany z pyłkiem pszczelim' => 'miod-kremowany-z-pylkiem-pszczelim',
 'Pierzga' => 'pierzga',
);
foreach ($honey_links as $honey_name => $honey_slug): ?>
<a class="sample-card honey-card" href="<?php echo esc_url(home_url('/product/' . $honey_slug . '/')); ?>">
 <div class="sample-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/jar.svg'); ?>" alt="" width="600" height="660" loading="lazy"></div>
 <h3><?php echo esc_html($honey_name); ?></h3>
 <p>Zobacz produkt</p>
</a>
<?php endforeach; ?>
</div>
<div class="actions"><a class="btn secondary" href="<?php echo esc_url(function_exists('ppd_shop_url') ? ppd_shop_url() : home_url('/shop/')); ?>">Zobacz całą ofertę</a></div>
</section>
<section class="section wrap" id="dlaczego"><div class="section-head"><div><span class="eyebrow">Dlaczego warto</span><h2>Miód z lokalnej pasieki.</h2></div><p>Bezpośredni kontakt, sezonowa oferta i produkty z Kiczyc.</p></div><div class="why-grid"><div class="why-card"><h3>Lokalnie z Kiczyc</h3><p>Pasieka działa w Kiczycach, w gminie Skoczów, na Śląsku Cieszyńskim.</p></div><div class="why-card"><h3>Sezonowość</h3><p>Rodzaje miodu zależą od pory roku i kwitnienia roślin. Dlatego dostępność poszczególnych produktów może się zmieniać.</p></div><div class="why-card"><h3>Bezpośredni kontakt</h3><p>Masz pytanie o produkt lub dostępność? Skontaktuj się z nami przed zakupem.</p></div></div></section>
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
<p class="contact-meta"><?php echo nl2br(esc_html($address)); ?></p><a class="contact-meta" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url('https://www.google.com/maps/search/?api=1&query='.rawurlencode($address)); ?>">Otwórz mapę ↗</a>
<?php else: ?><p class="contact-meta">Dane kontaktowe zostaną opublikowane po potwierdzeniu przez pasiekę.</p><?php endif; ?>
</div></div></section></main><?php get_footer(); ?>