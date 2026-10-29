<?php
defined('ABSPATH') || exit;

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    add_image_size('eso-project', 1100, 850, true);
    register_nav_menus(['primary' => 'Menu principal', 'footer' => 'Menu do rodapé']);
});

add_action('wp_enqueue_scripts', function (): void {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('eso-main', $uri . '/assets/css/main.css', [], filemtime($dir . '/assets/css/main.css'));
    wp_enqueue_script('eso-main', $uri . '/assets/js/main.js', [], filemtime($dir . '/assets/js/main.js'), true);
});

add_action('customize_register', function (WP_Customize_Manager $customizer): void {
    $customizer->add_section('eso_contact', ['title' => 'ESO · Contato', 'priority' => 40]);
    foreach (['email' => ['E-mail público', 'sanitize_email'], 'whatsapp' => ['WhatsApp com DDI e DDD (somente números)', 'eso_sanitize_whatsapp']] as $id => [$label, $sanitize]) {
        $customizer->add_setting('eso_' . $id, ['default' => '', 'sanitize_callback' => $sanitize]);
        $customizer->add_control('eso_' . $id, ['label' => $label, 'section' => 'eso_contact', 'type' => 'text']);
    }
});
function eso_sanitize_whatsapp($value): string { return preg_replace('/\D+/', '', (string) $value); }

function eso_image(string $name): string { return get_template_directory_uri() . '/assets/images/' . $name; }
function eso_page(string $slug): string { return home_url('/' . $slug . '/'); }
function eso_whatsapp_url(): string {
    $number = eso_sanitize_whatsapp(get_theme_mod('eso_whatsapp', ''));
    return 'https://wa.me/' . $number . '?text=' . rawurlencode('Olá! Gostaria de conversar sobre um projeto.');
}
function eso_project_image(int $id): string {
    if (has_post_thumbnail($id)) return get_the_post_thumbnail_url($id, 'eso-project');
    $fallback = ['casa-horizonte' => 'casa-horizonte.jpg', 'patio-interior' => 'interior.jpg', 'pavilhao-entrelinhas' => 'pavilhao.jpg'];
    $slug = get_post_field('post_name', $id);
    return eso_image($fallback[$slug] ?? 'hero.jpg');
}
function eso_project_img(int $id, string $loading = 'lazy'): string {
    $alt = 'Fotografia ilustrativa licenciada para o projeto conceitual ' . get_the_title($id);
    if (has_post_thumbnail($id)) return wp_get_attachment_image(get_post_thumbnail_id($id), 'eso-project', false, ['alt' => $alt, 'loading' => $loading, 'sizes' => '(max-width: 767px) 100vw, 55vw']);
    $base = eso_project_image($id);
    $small = preg_replace('/\.jpg$/', '-640.jpg', $base);
    $medium = preg_replace('/\.jpg$/', '-960.jpg', $base);
    return '<img src="' . esc_url($base) . '" srcset="' . esc_url($small) . ' 640w, ' . esc_url($medium) . ' 960w, ' . esc_url($base) . ' 1200w" sizes="(max-width: 767px) 100vw, 55vw" alt="' . esc_attr($alt) . '" loading="' . esc_attr($loading) . '" decoding="async" width="1200" height="850">';
}
function eso_meta_description(): string {
    if (is_singular('projeto')) return wp_strip_all_tags(get_the_excerpt());
    if (is_front_page()) return 'ESO Arquitetura: projeto demonstrativo de arquitetura, interiores e espaços corporativos. Conheça os estudos conceituais e a forma de atuação.';
    if (is_page('sobre')) return 'Conheça a essência, os valores e a metodologia conceitual da ESO Arquitetura.';
    if (is_page('servicos')) return 'Explore os serviços demonstrativos de arquitetura, projetos complementares, reforma e consultoria técnica.';
    if (is_page('contato')) return 'Entre em contato com a ESO Arquitetura pelo formulário demonstrativo.';
    return 'ESO Arquitetura: site institucional demonstrativo de um escritório fictício.';
}
add_action('wp_head', function (): void {
    echo '<meta name="description" content="' . esc_attr(eso_meta_description()) . '">' . "\n";
    if (is_singular('projeto') || is_front_page()) echo '<meta property="og:image" content="' . esc_url(is_singular('projeto') ? eso_project_image(get_the_ID()) : eso_image('hero.jpg')) . '">' . "\n";
});
