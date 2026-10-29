<?php
defined('ABSPATH') || exit;

add_action('admin_post_nopriv_eso_contact', 'eso_handle_contact');
add_action('admin_post_eso_contact', 'eso_handle_contact');
add_filter('wp_mail_from', static fn($from) => getenv('ESO_SMTP_HOST') ? 'demo@eso.local' : $from);
add_filter('wp_mail_from_name', static fn($name) => getenv('ESO_SMTP_HOST') ? 'ESO Arquitetura' : $name);
add_action('phpmailer_init', function (PHPMailer\PHPMailer\PHPMailer $mailer): void {
    $host = getenv('ESO_SMTP_HOST');
    if (!$host) return;
    $mailer->isSMTP();
    $mailer->Host = $host;
    $mailer->Port = 1025;
    $mailer->SMTPAuth = false;
    $mailer->SMTPSecure = '';
    $mailer->SMTPAutoTLS = false;
    $mailer->setFrom('demo@eso.local', 'ESO Arquitetura');
});

function eso_handle_contact(): void {
    $return = wp_get_referer() ?: home_url('/contato/');
    $return = wp_validate_redirect($return, home_url('/contato/'));
    $finish = static function (string $status) use ($return): void {
        wp_safe_redirect(add_query_arg('envio', $status, $return) . '#formulario');
        exit;
    };
    if (!isset($_POST['eso_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['eso_nonce'])), 'eso_contact')) $finish('invalido');
    if (!empty($_POST['website'])) $finish('invalido');
    $started = isset($_POST['started']) ? absint($_POST['started']) : 0;
    if (!$started || time() - $started < 3) $finish('invalido');

    $name = sanitize_text_field(wp_unslash($_POST['nome'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['telefone'] ?? ''));
    $service = sanitize_text_field(wp_unslash($_POST['servico'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['mensagem'] ?? ''));
    $allowed = ['Arquitetura', 'Interiores', 'Corporativo', 'Reforma', 'Consultoria técnica', 'Outro'];
    if (mb_strlen($name) < 2 || mb_strlen($name) > 100 || !is_email($email) || mb_strlen($phone) > 30 || !in_array($service, $allowed, true) || mb_strlen($message) < 10 || mb_strlen($message) > 3000 || empty($_POST['consentimento'])) $finish('invalido');

    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    $key = 'eso_contact_' . md5($ip);
    if (get_transient($key)) $finish('limite');
    set_transient($key, 1, MINUTE_IN_SECONDS);

    $recipient = get_option('admin_email');
    $body = "Nova mensagem pelo site ESO (demonstração)\n\nNome: $name\nE-mail: $email\nTelefone: $phone\nServiço: $service\n\n$message";
    $sent = wp_mail($recipient, '[ESO] Novo contato pelo site', $body, ['Reply-To: ' . $name . ' <' . $email . '>']);
    $finish($sent ? 'sucesso' : 'erro');
}
