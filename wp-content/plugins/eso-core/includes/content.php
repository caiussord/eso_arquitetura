<?php
defined('ABSPATH') || exit;

function eso_register_content(): void {
    register_post_type('projeto', [
        'labels' => ['name' => 'Projetos', 'singular_name' => 'Projeto', 'add_new_item' => 'Adicionar projeto'],
        'public' => true, 'has_archive' => true, 'rewrite' => ['slug' => 'projetos'],
        'show_in_rest' => true, 'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
    ]);
    register_post_type('servico', [
        'labels' => ['name' => 'Serviços', 'singular_name' => 'Serviço'],
        'public' => false, 'show_ui' => true, 'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title', 'editor', 'excerpt', 'page-attributes', 'revisions'],
    ]);
    register_post_type('atuacao', [
        'labels' => ['name' => 'Áreas de atuação', 'singular_name' => 'Área de atuação'],
        'public' => false, 'show_ui' => true, 'show_in_rest' => true,
        'menu_icon' => 'dashicons-category',
        'supports' => ['title', 'editor', 'page-attributes', 'revisions'],
    ]);
    foreach (['tipo' => 'Tipo', 'local' => 'Localização fictícia', 'ano' => 'Ano fictício', 'area' => 'Área'] as $key => $label) {
        register_post_meta('projeto', '_eso_' . $key, [
            'show_in_rest' => true, 'single' => true, 'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => static fn() => current_user_can('edit_posts'),
        ]);
    }
}
add_action('add_meta_boxes_projeto', function (): void { add_meta_box('eso_project_details', 'Dados do projeto conceitual', 'eso_project_meta_box', 'projeto'); });

function eso_project_meta_box(WP_Post $post): void {
    wp_nonce_field('eso_save_project', 'eso_project_nonce');
    foreach (['tipo' => 'Tipo', 'local' => 'Localização fictícia', 'ano' => 'Ano fictício', 'area' => 'Área (opcional)'] as $key => $label) {
        $value = get_post_meta($post->ID, '_eso_' . $key, true);
        printf('<p><label for="eso_%1$s"><strong>%2$s</strong></label><br><input class="widefat" id="eso_%1$s" name="eso_%1$s" value="%3$s"></p>', esc_attr($key), esc_html($label), esc_attr($value));
    }
    echo '<p>Use a imagem destacada para a capa. Insira uma galeria no conteúdo do projeto quando necessário.</p>';
}
function eso_find_post(string $title, string $type): bool {
    return (bool) get_posts(['post_type' => $type, 'post_status' => 'any', 'title' => $title, 'posts_per_page' => 1, 'fields' => 'ids']);
}

add_action('save_post_projeto', function (int $post_id): void {
    if (!isset($_POST['eso_project_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['eso_project_nonce'])), 'eso_save_project') || !current_user_can('edit_post', $post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    foreach (['tipo', 'local', 'ano', 'area'] as $key) {
        $raw = isset($_POST['eso_' . $key]) ? wp_unslash($_POST['eso_' . $key]) : '';
        update_post_meta($post_id, '_eso_' . $key, sanitize_text_field($raw));
    }
});

function eso_activate_core(): void {
    eso_register_content();
    flush_rewrite_rules();
    $pages = [
        'inicio' => 'Início', 'sobre' => 'Sobre', 'servicos' => 'Serviços',
        'contato' => 'Contato', 'politica-de-privacidade' => 'Política de Privacidade',
    ];
    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug]);
        }
    }
    $front = get_page_by_path('inicio');
    if ($front) { update_option('show_on_front', 'page'); update_option('page_on_front', $front->ID); }
    $services = [
        ['Projeto arquitetônico', 'Da primeira conversa ao desenho final, organizamos espaços, usos e soluções com clareza.'],
        ['Projetos complementares', 'Compatibilização conceitual de sistemas e disciplinas para decisões mais consistentes.'],
        ['Reforma', 'Leitura cuidadosa do existente e propostas para adaptar espaços a novas rotinas.'],
        ['Consultoria técnica', 'Orientação para avaliar possibilidades, prioridades e próximos passos de um projeto.'],
    ];
    foreach ($services as $i => [$title, $copy]) {
        if (!eso_find_post($title, 'servico')) wp_insert_post(['post_type' => 'servico', 'post_status' => 'publish', 'post_title' => $title, 'post_excerpt' => $copy, 'menu_order' => $i]);
    }
    $areas = [
        ['Arquitetura', 'Do estudo inicial à organização dos espaços, articulamos forma, função e contexto para criar projetos com propósito.'],
        ['Interiores', 'Materiais, luz e proporção dão forma a ambientes que acompanham diferentes formas de viver.'],
        ['Corporativo', 'Espaços de trabalho e encontro pensados para pessoas, fluxos e a identidade de cada negócio.'],
    ];
    foreach ($areas as $i => [$title, $copy]) {
        if (!eso_find_post($title, 'atuacao')) wp_insert_post(['post_type' => 'atuacao', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => $copy, 'menu_order' => $i]);
    }
    $projects = [
        ['Casa Horizonte', 'Residencial', 'Interior de São Paulo · cenário fictício', '2025', '280 m²', 'Uma investigação conceitual sobre luz, privacidade e continuidade entre interior e jardim.'],
        ['Pátio Interior', 'Interiores', 'Curitiba · cenário fictício', '2024', '145 m²', 'Ambientes essenciais, materiais honestos e uma circulação que convida a permanecer.'],
        ['Pavilhão Entrelinhas', 'Corporativo', 'Belo Horizonte · cenário fictício', '2026', '420 m²', 'Um estudo de espaços de encontro, trabalho e pausa em torno de um eixo aberto.'],
    ];
    foreach ($projects as [$title, $type, $place, $year, $area, $copy]) {
        if (eso_find_post($title, 'projeto')) continue;
        $id = wp_insert_post(['post_type' => 'projeto', 'post_status' => 'publish', 'post_title' => $title, 'post_excerpt' => $copy, 'post_content' => '<p>' . esc_html($copy) . '</p><p>Este estudo é fictício e usa fotografia licenciada apenas como referência visual. Não representa uma obra executada pela ESO Arquitetura.</p>']);
        if (!is_wp_error($id)) foreach (['tipo' => $type, 'local' => $place, 'ano' => $year, 'area' => $area] as $key => $value) update_post_meta($id, '_eso_' . $key, $value);
    }
}
