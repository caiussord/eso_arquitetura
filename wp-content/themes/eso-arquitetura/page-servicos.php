<?php
/**
 * Página de serviços.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="page-hero">
	<div class="container"><span class="eyebrow">02 / Serviços</span>
		<h1>Atuação que acompanha<br>cada <em>necessidade.</em></h1>
		<p>Frentes de trabalho ilustrativas, pensadas para conectar ideias, técnica e experiência cotidiana.</p>
	</div>
</section>
<section class="section">
	<div class="container services-list">
		<?php
		$services = new WP_Query(
			array(
				'post_type'      => 'servico',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		$i        = 0;
		while ( $services->have_posts() ) :
			$services->the_post();
			++$i;
			?>
		<article class="service-row"><span><?php echo esc_html( str_pad( (string) $i, 2, '0', STR_PAD_LEFT ) ); ?></span>
			<h2><?php the_title(); ?></h2>
			<div>
				<?php
				if ( get_the_content() ) :
					the_content();
				else :
					?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			</div>
		</article>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
<section class="section small-cta">
	<div class="container split-content">
		<h2>Seu projeto começa com uma conversa.</h2>
		<div>
			<p>Conte o que você tem em mente e vamos entender os próximos passos.</p><a class="button" href="<?php echo esc_url( eso_page( 'contato' ) ); ?>">Solicitar orçamento ↗</a>
		</div>
	</div>
</section>
<?php get_footer(); ?>
