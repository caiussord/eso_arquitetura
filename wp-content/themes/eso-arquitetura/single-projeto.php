<?php
/**
 * Detalhe de projeto conceitual.
 *
 * @package ESO_Arquitetura
 */

get_header();
while ( have_posts() ) :
	the_post();
	$project_id = get_the_ID(); ?>
<article>
	<header class="page-hero project-detail-head">
		<div class="container"><a class="back-link" href="<?php echo esc_url( get_post_type_archive_link( 'projeto' ) ); ?>">← Todos os projetos</a><span class="eyebrow">Projeto conceitual / demonstrativo</span>
			<h1><?php the_title(); ?></h1>
			<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<div class="project-facts">
				<?php
				foreach ( array(
					'tipo'  => 'Tipo',
					'local' => 'Localização fictícia',
					'ano'   => 'Ano fictício',
					'area'  => 'Área estimada',
				) as $key => $label ) :
					$value = get_post_meta( $project_id, '_eso_' . $key, true );
					if ( $value ) :
						?>
				<div><span><?php echo esc_html( $label ); ?></span><strong><?php echo esc_html( $value ); ?></strong></div>
						<?php
					endif;
				endforeach;
				?>
			</div>
		</div>
	</header>
	<div class="container detail-image"><?php echo eso_project_img( $project_id, 'eager' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<div class="container detail-body"><span class="eyebrow">Sobre o estudo</span>
		<div><?php the_content(); ?>
			<p class="disclaimer">Projeto fictício. Fotografia ilustrativa licenciada, sem relação com obra executada pela ESO Arquitetura.</p>
		</div>
	</div>
</article>
<?php endwhile;
get_footer(); ?>
