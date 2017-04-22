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
 						$link = null;
						if (get_sub_field('internal_external_link')) {
							$link = get_sub_field('link');
						}
						else {
							$link = get_sub_field('page');
						}
						?>
						<div class="item span3">
							<img src="<?php echo $image[sizes][poster]; ?>">
							<div class="info">
								<h3><?php echo $name; ?></h3>
								<a href="<?php echo $link; ?>">Details &amp; Tickets &raquo;</a>
							</div>
						</div>
						<?php

					endwhile;

				endif;

				?>
			</div>
		</div>
	</section>