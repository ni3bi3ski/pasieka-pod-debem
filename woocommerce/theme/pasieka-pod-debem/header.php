<?php if (!defined('ABSPATH')) { exit; } ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a href="#main" class="skip">Przejdź do treści</a>
<div class="top-note">PASIEKA POD DĘBEM · KICZYCE</div>
<header class="site-header"><div class="wrap header-inner">
<a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/oak.svg'); ?>" width="46" height="46" alt=""><span><span class="brand-name">Pasieka Pod Dębem</span><span class="brand-sub">Blisko natury · Kiczyce</span></span></a>
<button class="menu-toggle" type="button" aria-controls="main-nav" aria-expanded="false">Menu</button>
<nav id="main-nav" class="main-nav" aria-label="Menu główne"><a href="<?php echo esc_url(ppd_shop_url()); ?>">Miody</a><a href="<?php echo esc_url(home_url('/#o-pasiece')); ?>">O pasiece</a><a href="<?php echo esc_url(home_url('/#pytania')); ?>">Pytania</a><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Kontakt</a>
<?php if (function_exists('wc_get_cart_url')): ?><a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">Koszyk (<span class="ppd-cart-count"><?php echo (function_exists('WC') && WC()->cart)?absint(WC()->cart->get_cart_contents_count()):0; ?></span>)</a><?php endif; ?>
</nav></div></header>
