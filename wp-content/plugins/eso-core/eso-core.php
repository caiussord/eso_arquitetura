<?php
/**
 * Plugin Name: ESO Core
 * Description: Conteúdo demonstrativo e tipos de publicação da ESO Arquitetura.
 * Version: 1.0.0
 * Requires PHP: 8.0
 * Text Domain: eso-core
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/contact.php';

add_action('init', 'eso_register_content');
register_activation_hook(__FILE__, 'eso_activate_core');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');
