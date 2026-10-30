<?php
/**
 * Template da página não encontrada.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="page-hero not-found">
	<div class="container"><span class="eyebrow">Erro 404</span>
		<h1>Esta página saiu<br>do <em>projeto.</em></h1>
		<p>O endereço pode ter mudado ou não existe mais.</p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início ↗</a>
	</div>
</section><?php get_footer(); ?>
