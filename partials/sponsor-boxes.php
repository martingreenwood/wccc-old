	<section id="sponsors">
		<div class="container">
			<div class="row">

				<div class="sponsors official">
					<header>
						<h3>Official Main Sponsor</h3>
					</header>
					<?php 
					$loop = new WP_Query( array( 'post_type' => 'sponsors', 'posts_per_page' => -1 ) );
					while ( $loop->have_posts() ) : $loop->the_post(); 
					$sponsor_type = get_field( 'sponsor_types' );
						
						if ($sponsor_type == 'official'): 
						?>
							<div class="sponsor">
								<?php the_post_thumbnail( ); ?>
							</div>
						<?php 
						endif;

					endwhile; 
					wp_reset_query(); 
					?>
				</div>

				<div class="sponsors main">
					<header>
						<h3>Official Sponsors</h3>
					</header>
					<?php 
					$loop = new WP_Query( array( 'post_type' => 'sponsors', 'posts_per_page' => -1 ) );
					while ( $loop->have_posts() ) : $loop->the_post(); 
					$sponsor_type = get_field( 'sponsor_types' );
						
						if ($sponsor_type == 'main'): 
						?>
							<div class="sponsor">
								<?php the_post_thumbnail( ); ?>
							</div>
						<?php 
						endif;

					endwhile; 
					wp_reset_query(); 
					?>
				</div>
			</div>
			<div class="row">
				<div class="sponsors span12 club">
					<header>
						<h3>Official Club Partners</h3>
					</header>
					<?php 
					$loop = new WP_Query( array( 'post_type' => 'sponsors', 'posts_per_page' => -1 ) );
					while ( $loop->have_posts() ) : $loop->the_post(); 
					$sponsor_type = get_field( 'sponsor_types' );
						
						if ($sponsor_type == 'club'): 
						?>
							<div class="sponsor">
								<?php the_post_thumbnail( ); ?>
							</div>
						<?php 
						endif;


					endwhile; 
					wp_reset_query(); 
					?>
				</div>

			</div>
		</div>
	</section>