<?php
/**
 Template Name: No Sidebar
 *
 * The template for displaying all pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";

		$top_image_array = array();
		$top_t20_images = get_field( 'header_images_t20', 'option' );

		foreach ($top_t20_images as $top_t20_image) {
			$top_image_array[] = $top_t20_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";

		$top_image_array = array();
		$top_images = get_field( 'header_images', 'option' );
		foreach ($top_images as $top_image) {
			$top_image_array[] = $top_image['url'];
		}
		$ri = array_rand($top_image_array);
		$top_image = $top_image_array[$ri];
	endif; 

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						<?php if (get_field( 'has_custom_title' )): ?>
							<h1><?php the_field( 'custom_title' ); ?></h1>
						<?php else: ?>
							<h1><?php the_title(); ?></h1>
						<?php endif; ?>
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
			</center>

		</main><!-- #main -->

		<?php //get_sidebar('pages'); ?>
	</div>

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
				        	?>
					        	<div class="copy">
					        	<?php the_sub_field('content'); ?>
					        	</div>
					        <?php 
					        elseif( get_row_layout() == 'image' ): 
				        	?>
					        	<div class="image">
					        	<?php $image = get_sub_field('image'); ?>
					        	<?php echo "<img src='".$image["url"]."'>"; ?>
					        	</div>
							<?php 
							elseif( get_row_layout() == 'video' ): 
							?>
								<div class="video">
					        	<?php the_sub_field('video'); ?>
					        	</div>
							<?php 
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

	<?php if (is_page( 'contact' )): ?>

	<section id="directions">

		<div class="container">

			<form class="directions clearfix" action="http://maps.google.com/maps" method="get" target="_blank">
            <label>
                Get directions from your postcode by filling out this form:
            </label>
            <div class="right">
                <input type="text" name="saddr" placeholder="Enter Postcode" data-com.agilebits.onepassword.user-edited="yes">
                <input type="hidden" name="daddr" value="WR2 4QQ UK">
                <button>Get Directions</button>
            </div>
        </form>
			
		</div>
		
	</section>

	<?php 
	$location = get_field('location', 'options');
	if( !empty($location) ): ?>
	<section id="location">
		<div class="map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
	</section>
	<?php endif; ?>		
	<?php endif ?>

<?php
get_footer();
