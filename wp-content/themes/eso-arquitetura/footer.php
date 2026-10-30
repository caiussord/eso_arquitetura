<?php
/**
 * Rodapé do site.
 *
 * @package ESO_Arquitetura
 */

?>
</main>
<footer class="site-footer">
	<div class="container footer-main">
		<div><span class="eyebrow light">O próximo espaço começa aqui</span>
			<h2>Vamos imaginar<br><em>o que vem depois.</em></h2><a class="footer-link" href="<?php echo esc_url( eso_page( 'contato' ) ); ?>">Iniciar uma conversa <span aria-hidden="true">↗</span></a>
		</div>
		<div class="footer-side">
			<p>Arquitetura, interiores e ideias que fazem sentido para quem vive o espaço.</p>
			<nav aria-label="Navegação do rodapé"><a href="<?php echo esc_url( get_post_type_archive_link( 'projeto' ) ); ?>">Projetos</a><a href="<?php echo esc_url( eso_page( 'sobre' ) ); ?>">Sobre</a><a href="<?php echo esc_url( eso_page( 'servicos' ) ); ?>">Serviços</a><a href="<?php echo esc_url( eso_page( 'contato' ) ); ?>">Contato</a></nav>
		</div>
	</div>
	<div class="container footer-bottom"><span class="brand footer-brand">eso<span>.</span></span><span>Projeto demonstrativo · escritório e cases fictícios</span><a href="<?php echo esc_url( eso_page( 'politica-de-privacidade' ) ); ?>">Privacidade</a><span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> ESO Arquitetura</span></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
