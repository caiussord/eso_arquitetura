<?php
/**
 * Cabeçalho do site.
 *
 * @package ESO_Arquitetura
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link" href="#conteudo">Pular para o conteúdo</a>
	<header class="site-header">
		<div class="container header-inner">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="ESO Arquitetura, início"><span class="brand-name">eso<span>.</span></span><span class="brand-sub">ARQUITETURA</span></a>
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Abrir menu"><span></span><span></span></button>
			<nav id="primary-nav" class="primary-nav" aria-label="Navegação principal">
				<a href="<?php echo esc_url( is_front_page() ? '#projetos' : home_url( '/#projetos' ) ); ?>">Projetos</a>
				<a href="<?php echo esc_url( is_front_page() ? '#essencia' : home_url( '/#essencia' ) ); ?>">Essência</a>
				<a href="<?php echo esc_url( is_front_page() ? '#atuacao' : home_url( '/#atuacao' ) ); ?>">Atuação</a>
				<a class="nav-cta" href="<?php echo esc_url( eso_page( 'contato' ) ); ?>">Vamos conversar <span aria-hidden="true">↗</span></a>
			</nav>
		</div>
	</header>
	<main id="conteudo">
