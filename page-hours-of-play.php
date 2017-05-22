<?php
/**
 * The template for displaying the hours of play page
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
	endif; 

	if (get_field( 'top_image' )) {
		$top_image = get_field( 'top_image' ); 
		$top_image = $top_image['url']; 
	} else {
		$top_image = get_template_directory_uri() ."/assets/images/player.png";
	}

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						&nbsp;
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>


	<div id="primary" class="content-area container">
		<main id="main" class="site-main span9" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<div class="hours">

				<table>
				<?php
				if( have_rows('hours_of_play') ):
				    while ( have_rows('hours_of_play') ) : the_row();
					?>
					<tr>
			        	<td class="title"><?php the_sub_field('title'); ?></td>
			        	<td class="info"><?php the_sub_field('info'); ?></td>
					</tr>
					<?php
				    endwhile;
				endif;
				?>
				</table>
				
			</div>

		</main><!-- #main -->

		<?php get_sidebar('pages'); ?>
	</div><!-- #primary -->

<?php
get_footer();
