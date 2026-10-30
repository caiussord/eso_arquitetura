<?php
/**
 * Template de conteúdo padrão.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="page-hero">
	<div class="container"><span class="eyebrow">ESO Arquitetura</span>
		<h1>Conteúdo</h1>
	</div>
</section>
<section class="section">
	<div class="container legal-content">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
		<article>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?>
		</article>
				<?php
			endwhile;
			the_posts_pagination();
		else :
			?>
		<p>Nenhum conteúdo encontrado.</p><?php endif; ?>
	</div>
</section><?php get_footer(); ?>
