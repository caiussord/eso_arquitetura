<?php
/**
 * Página de contato.
 *
 * @package ESO_Arquitetura
 */

get_header();
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Apenas lê o estado visual do redirecionamento.
$contact_status = sanitize_key( wp_unslash( $_GET['envio'] ?? '' ) ); ?>
<section class="page-hero">
	<div class="container"><span class="eyebrow">04 / Contato</span>
		<h1>Vamos começar<br>uma <em>conversa.</em></h1>
		<p>Conte um pouco sobre o espaço, o que você imagina e em que etapa está o projeto.</p>
	</div>
</section>
<section class="section">
	<div class="container contact-grid">
		<div class="contact-aside"><span class="eyebrow">O primeiro passo</span>
			<h2>Conte sobre o espaço que você imagina.</h2>
			<p>Não precisa ter tudo definido. Descreva sua ideia, mesmo que ela ainda esteja no começo.</p>
			<?php
			$email = get_theme_mod( 'eso_email', '' );
			if ( is_email( $email ) ) :
				?>
			<a class="text-link" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a><?php endif; ?>
			<?php
			if ( get_theme_mod( 'eso_whatsapp' ) ) :
				?>
			<a class="text-link" href="<?php echo esc_url( eso_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Abrir WhatsApp em nova aba">Conversar pelo WhatsApp ↗</a><?php endif; ?>
			<p class="demo-note">Este é um projeto de portfólio. A ESO Arquitetura e os projetos apresentados são conceituais.</p>
		</div>
		<form id="formulario" class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-contact-form>
			<?php
			if ( $contact_status ) :
				?>
			<div class="form-message <?php echo 'sucesso' === $contact_status ? 'success' : 'error'; ?>" role="status">
				<?php
				echo esc_html(
					match ( $contact_status ) {
						'sucesso' => 'Mensagem enviada. Obrigado pelo contato.',
						'limite' => 'Aguarde um minuto antes de tentar novamente.',
						'erro' => 'Não foi possível enviar. Tente novamente mais tarde.',
						default => 'Confira os campos e tente novamente.' }
				);
				?>
			</div><?php endif; ?>
			<input type="hidden" name="action" value="eso_contact"><input type="hidden" name="started" value="<?php echo esc_attr( time() ); ?>"><?php wp_nonce_field( 'eso_contact', 'eso_nonce' ); ?>
			<div class="honeypot" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
			<div class="form-row">
				<div class="field"><label for="nome">Nome <span aria-hidden="true">*</span></label><input id="nome" name="nome" type="text" autocomplete="name" minlength="2" maxlength="100" required></div>
				<div class="field"><label for="email">E-mail <span aria-hidden="true">*</span></label><input id="email" name="email" type="email" autocomplete="email" required></div>
			</div>
			<div class="form-row">
				<div class="field"><label for="telefone">Telefone <small>(opcional)</small></label><input id="telefone" name="telefone" type="tel" autocomplete="tel" maxlength="30"></div>
				<div class="field"><label for="servico">Tipo de serviço <span aria-hidden="true">*</span></label><select id="servico" name="servico" required>
						<option value="">Selecione</option>
						<?php
						foreach ( array( 'Arquitetura', 'Interiores', 'Corporativo', 'Reforma', 'Consultoria técnica', 'Outro' ) as $option ) :
							?>
						<option><?php echo esc_html( $option ); ?></option><?php endforeach; ?>
					</select></div>
			</div>
			<div class="field"><label for="mensagem">Mensagem <span aria-hidden="true">*</span></label><textarea id="mensagem" name="mensagem" rows="6" minlength="10" maxlength="3000" required placeholder="Fale um pouco sobre sua ideia, o espaço e o momento do projeto."></textarea></div>
			<label class="consent"><input name="consentimento" type="checkbox" value="1" required><span>Li a <a href="<?php echo esc_url( eso_page( 'politica-de-privacidade' ) ); ?>" target="_blank" rel="noopener noreferrer">Política de Privacidade</a> e concordo com o uso dos dados para responder ao meu contato. <span aria-hidden="true">*</span></span></label>
			<button class="button" type="submit">Enviar mensagem <span aria-hidden="true">↗</span></button>
			<p class="form-help">* Campos obrigatórios</p>
		</form>
	</div>
</section>
<?php get_footer(); ?>
