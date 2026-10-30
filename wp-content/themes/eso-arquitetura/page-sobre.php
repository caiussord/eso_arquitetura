<?php
/**
 * Página institucional.
 *
 * @package ESO_Arquitetura
 */

get_header(); ?>
<section class="page-hero">
	<div class="container"><span class="eyebrow">01 / Essência</span>
		<h1>Um olhar atento<br>para o <em>essencial.</em></h1>
		<p>ESO Arquitetura é uma marca conceitual criada para demonstrar uma experiência digital de arquitetura.</p>
	</div>
</section>
<section class="section">
	<div class="container split-content">
		<div><span class="eyebrow">Nossa visão</span>
			<h2>O espaço ganha sentido quando começa pelas pessoas.</h2>
		</div>
		<div>
			<p>Este escritório fictício representa uma forma de pensar arquitetura que equilibra escuta, estudo do contexto e expressão material. Cada proposta parte da rotina de quem ocupa o espaço e das condições do lugar.</p>
			<p>Os projetos apresentados neste site são estudos demonstrativos. Não correspondem a clientes, profissionais ou obras reais.</p>
		</div>
	</div>
</section>
<section class="section image-band">
	<div class="container"><img src="<?php echo esc_url( eso_image( 'pavilhao.jpg' ) ); ?>" alt="Detalhe de arquitetura em concreto fotografado por Lena Laurentez" loading="lazy" width="1200" height="850"></div>
</section>
<section class="section">
	<div class="container split-content">
		<div><span class="eyebrow">Como pensamos</span>
			<h2>Escuta, rigor e abertura.</h2>
		</div>
		<div>
			<p>Começamos com perguntas. Investigamos as necessidades, organizamos prioridades e testamos caminhos antes de chegar a uma solução. A metodologia valoriza decisões claras e diálogo em todas as etapas.</p><a class="text-link" href="<?php echo esc_url( eso_page( 'contato' ) ); ?>">Vamos conversar <span aria-hidden="true">↗</span></a>
		</div>
	</div>
</section>
<?php get_footer(); ?>
