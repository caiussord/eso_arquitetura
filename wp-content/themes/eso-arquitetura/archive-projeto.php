<?php
/**
 * Listagem dos projetos conceituais.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="page-hero">
	<div class="container"><span class="eyebrow">Portfólio demonstrativo</span>
		<h1>Projetos em <em>perspectiva.</em></h1>
		<p>Estudos fictícios de arquitetura, interiores e espaços corporativos. As fotografias são referências visuais licenciadas e não mostram obras da ESO.</p>
	</div>
</section>
<section class="section">
	<div class="container projects-grid archive-grid">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/project-card' );
			endwhile;
			the_posts_pagination(
				array(
					'prev_text' => 'Anterior',
					'next_text' => 'Próximo',
				)
			);
		else :
			?>
		<p>Nenhum projeto publicado ainda.</p><?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
