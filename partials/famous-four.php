	<section id="famousfour">
		<div class="container">
			<div class="row">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('famous_four') ):

				 	// loop through the rows of data
				    while ( have_rows('famous_four') ) : the_row();

				        // display a sub field value
						$image = get_sub_field('image');
 						$name = get_sub_field('name');
						$link = get_sub_field('link');
						?>
						<div class="item span3">
							<a href="<?php echo $link; ?>">
								<img src="<?php echo $image['sizes']['poster']; ?>">
							</a>
							<div class="info">
								<h3><a href="<?php echo $link; ?>"><?php echo $name; ?></a></h3>
							</div>
						</div>
						<?php

					endwhile;

				endif;

				?>
			</div>
		</div>
	</section>