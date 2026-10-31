<?php if (!defined('ABSPATH')) { exit; } get_header(); ?>
<main id="main" class="wrap page-content"><?php while (have_posts()): the_post(); ?><h1><?php the_title(); ?></h1><div class="<?php echo function_exists('is_cart') && (is_cart() || is_checkout() || is_account_page()) ? 'store-content' : 'entry-content'; ?>"><?php the_content(); wp_link_pages(); ?></div><?php endwhile; ?>
<?php if (is_front_page()): ?>
<section class="section" id="miody">
 <div class="section-head"><div><span class="eyebrow">Nasze miody</span><h2>Wybierz miód.</h2></div><p>Kliknij produkt, aby zobaczyć szczegóły i dodać go do koszyka.</p></div>
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
   <div class="sample-image"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/jar.svg'); ?>" alt="" width="600" height="660" loading="lazy"></div>
   <h3><?php echo esc_html($honey_name); ?></h3>
   <p>Zobacz produkt</p>
  </a>
<?php endforeach; ?>
 </div>
 <div class="actions"><a class="btn secondary" href="<?php echo esc_url(function_exists('ppd_shop_url') ? ppd_shop_url() : home_url('/shop/')); ?>">Zobacz całą ofertę</a></div>
</section>
<?php endif; ?>
</main><?php get_footer(); ?>