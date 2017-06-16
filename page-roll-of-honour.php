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

	<div id="topnavbar" class="pagenav">
		<div class="container">
		<?php get_sidebar('top'); ?>
		</div>
	</div>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main span12" role="main">

			<center>
			<h1><?php the_title(); ?></h1>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<div class="quick-links">
				<ul>
				<?php
				if( have_rows('roll_of_honours') ):
					while ( have_rows('roll_of_honours') ) : the_row();
					$section_title =  get_sub_field('title');
					?>
					<li><a href="#<?php echo str_replace(" ","",strtolower($section_title)); ?>"><?php the_sub_field('title'); ?></a></li>
					<?php
					endwhile;
				endif;
				?>
				</ul>
			</div>

			</center>

			<section id="cd-timeline" class="cd-container">

				<?php
				if( have_rows('roll_of_honours') ):
				    while ( have_rows('roll_of_honours') ) : the_row();
					$section_title =  get_sub_field('title');
					?>
				    
				    <h1 id="<?php echo str_replace(" ","",strtolower($section_title)); ?>"><?php the_sub_field('title'); ?></h1>
					<?php
					if( have_rows('honours') ):
					    while ( have_rows('honours') ) : the_row();
						?>
						<div class="cd-timeline-block cssanimations">
							<div class="cd-timeline-img cd-picture is-hidden">
								<img width="50px" src="<?php echo get_stylesheet_directory_uri() . "/assets/images/1497449591_calendar-80px.svg"; ?>">
							</div>
					 
							<div class="cd-timeline-content is-hidden">
								<h2><?php the_sub_field('name'); ?></h2>
								<span class="cd-date"><?php the_sub_field('year'); ?></span>
							</div>
						</div>

						<tr>
				        	<td class="title"></td>
				        	<td class="info"></td>
						</tr>
						<?php
					    endwhile;
					endif;

				    endwhile;
				endif;
				?>

			</section>

		</main><!-- #main -->

		<?php //get_sidebar('pages'); ?>
	</div><!-- #primary -->


	<?php if( have_rows('sections') ): ?>
	<section id="parts">

	    <?php while ( have_rows('sections') ) : the_row(); ?>
		<div class="section">
			<div class="container">
				<div class="row">
				
				    <?php while ( have_rows('column') ) : the_row(); ?>
					<div class="column <?php the_sub_field( 'column_with' ); ?>">

					<?php
					if( have_rows('column_content') ):
					    while ( have_rows('column_content') ) : the_row();

					        if( get_row_layout() == 'content' ):

					        	the_sub_field('content');

					        elseif( get_row_layout() == 'image' ): 

					        	$image = get_sub_field('image');
					        	echo "<img src='".$image["url"]."'>";


							elseif( get_row_layout() == 'video' ): 

					        	the_sub_field('video');

					        endif;

					    endwhile;
					endif;
					?>

					</div>
					<?php endwhile; ?>
					
				</div>
			</div>
		</div>
		<?php endwhile; ?>

	</section>
	<?php endif; ?>

<?php
get_footer();
