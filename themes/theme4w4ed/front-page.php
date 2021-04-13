<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4ed
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<section class="list-cours">
				<?php
				/* Start the Loop */
				$precedent = "XXXXXXX";
				while ( have_posts() ) :
					the_post();
					// 582-1J1 Animation et interactivité en jeu (75h)
					convertir_tableau($tPropriété);
					if ($precedent != $tPropriété['typeCours']): ?>
					  	<?php if ($precedent != "XXXXXXX"): ?>
							</section>
						<?php endif;?>
						<?php if ($precedent == "Web"): ?>	
							<section class="ctrl-carrousel">
								<?php echo $ctrl_radio; ?>
							</section>
						<?php endif;?>
						<h2><?php echo $tPropriété['typeCours'] // -- Quand c'est Web, ajoute le carrousel, sinon, ajoute la classe bloc (permet d'avoir plus de contrôle sur le css)?></h2>
						<section <?php echo ($tPropriété['typeCours'] == 'Web' ? 'class="carrousel-2"' : 'class="bloc"');  ?>>
					<?php endif;?>	
					<?php 
					if ($tPropriété['typeCours'] == "Web"): 
						get_template_part( 'template-parts/content', 'carrousel' );
						$ctrl_radio .= '<input type="radio" name="rad-carrousel">';
					 else:
						get_template_part( 'template-parts/content', 'bloc' );
					endif; 
					$precedent = $tPropriété['typeCours'];
				endwhile; ?>
			</section>
		<?php endif; ?>
	

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();

function convertir_tableau(&$tPropriété){
	$titre_grand = get_the_title();  
	$tPropriété['session'] = substr($titre_grand, 4,1);
	$tPropriété['nbHeure'] = substr($titre_grand,-4,3 );
	$tPropriété['titre'] = substr($titre_grand,8, -6);
	$tPropriété['sigle'] = substr($titre_grand,0, 7);
	$tPropriété['typeCours'] = get_field('type_de_cours'); 
}
