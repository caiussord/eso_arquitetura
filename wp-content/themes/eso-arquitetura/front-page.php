<?php
/**
 * Página inicial do site.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="hero" aria-labelledby="hero-title">
	<img class="hero-image" src="<?php echo esc_url( eso_image( 'casa-horizonte.jpg' ) ); ?>" srcset="<?php echo esc_url( eso_image( 'casa-horizonte-640.jpg' ) ); ?> 640w, <?php echo esc_url( eso_image( 'casa-horizonte-960.jpg' ) ); ?> 960w, <?php echo esc_url( eso_image( 'casa-horizonte.jpg' ) ); ?> 1200w" sizes="100vw" alt="Casa contemporânea fotografada para referência visual" width="1200" height="675" fetchpriority="high">
	<div class="hero-shade"></div>
	<div class="container hero-content">
		<div class="hero-main"><span class="eyebrow light">Arquitetura com intenção</span>
			<h1 id="hero-title">Espaços para<br>novas <em>perspectivas.</em></h1>
		</div>
		<div class="hero-aside">
			<p>Um olhar atento para a relação entre espaço, técnica e vida cotidiana.</p><a class="text-link light-link" href="#projetos">Explore os projetos <span aria-hidden="true">↗</span></a>
		</div>
	</div>
	<div class="hero-index container"><span>ESO / 01</span><span>Projeto demonstrativo · empresa fictícia</span><span>Role para explorar ↓</span></div>
</section>
<section class="section intro" id="essencia">
	<div class="container intro-grid">
		<div><span class="eyebrow">01 / Essência</span><span class="intro-mark">✳</span></div>
		<div>
			<h2>Projetar é descobrir<br><em>o que importa.</em></h2>
			<p>Na ESO, cada espaço começa com uma escuta. Nossa proposta conceitual reúne clareza técnica e sensibilidade para desenhar ambientes que fazem sentido para as pessoas e para o lugar.</p><a class="text-link" href="<?php echo esc_url( eso_page( 'sobre' ) ); ?>">Conheça nossa essência <span aria-hidden="true">↗</span></a>
		</div>
	</div>
</section>
<section class="section projects-section" id="projetos">
	<div class="container">
		<div class="section-head">
			<div><span class="eyebrow">02 / Projetos em destaque</span>
				<h2>Ideias em <em>perspectiva.</em></h2>
			</div>
			<p>Estudos conceituais que exploram diferentes maneiras de habitar e compartilhar o espaço.</p>
		</div>
		<div class="projects-grid">
			<?php
			$projects = new WP_Query(
				array(
					'post_type'      => 'projeto',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'ASC',
				)
			);
			while ( $projects->have_posts() ) :
				$projects->the_post();
				get_template_part( 'template-parts/project-card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<div class="section-end"><a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'projeto' ) ); ?>">Todos os projetos <span aria-hidden="true">↗</span></a></div>
	</div>
</section>
<section class="section expertise" id="atuacao">
	<div class="container expertise-grid">
		<div class="expertise-intro"><span class="eyebrow">03 / Atuação</span>
			<h2>Do primeiro traço<br>ao espaço vivido.</h2>
			<p>Três frentes para pensar ambientes com coerência, identidade e atenção ao uso.</p><a class="text-link" href="<?php echo esc_url( eso_page( 'servicos' ) ); ?>">Ver todos os serviços <span aria-hidden="true">↗</span></a>
		</div>
		<div class="accordion">
			<?php
			$areas       = new WP_Query(
				array(
					'post_type'      => 'atuacao',
					'posts_per_page' => 3,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);
			$area_number = 0;
			while ( $areas->have_posts() ) :
				$areas->the_post();
				++$area_number;
				?>
			<details>
				<summary><span><?php echo esc_html( str_pad( (string) $area_number, 2, '0', STR_PAD_LEFT ) ); ?></span><strong><?php the_title(); ?></strong><span class="plus" aria-hidden="true">+</span></summary>
				<div class="accordion-content"><?php the_content(); ?></div>
			</details>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<section class="section process">
	<div class="container">
		<div class="section-head">
			<div><span class="eyebrow">04 / Nosso processo</span>
				<h2>Clareza em cada <em>etapa.</em></h2>
			</div>
			<p>Um caminho de diálogo e decisões bem fundamentadas, da primeira ideia ao acompanhamento.</p>
		</div>
		<div class="process-grid">
			<div><span>01</span>
				<h3>Escuta</h3>
				<p>Entendemos necessidades, contexto e possibilidades antes de desenhar.</p>
			</div>
			<div><span>02</span>
				<h3>Projeto</h3>
				<p>Transformamos o briefing em soluções espaciais claras e consistentes.</p>
			</div>
			<div><span>03</span>
				<h3>Acompanhamento</h3>
				<p>Orientamos os próximos passos para preservar a intenção do projeto.</p>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
