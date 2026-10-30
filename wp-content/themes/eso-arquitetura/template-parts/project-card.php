<?php
/**
 * Componente de projeto na listagem.
 *
 * @package ESO_Arquitetura
 */

$project_id = get_the_ID(); ?>
<article class="project-card">
	<a class="project-image" href="<?php the_permalink(); ?>" aria-label="Ver projeto conceitual <?php the_title_attribute(); ?>"><?php echo eso_project_img( $project_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
	<div class="project-info">
		<div><span class="project-type"><?php echo esc_html( get_post_meta( $project_id, '_eso_tipo', true ) ); ?> · Projeto conceitual</span>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div><span class="project-arrow" aria-hidden="true">↗</span>
	</div>
</article>
