<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="span4">
		<?php 

		$terms = get_the_terms( get_the_id(), 'filter' );
		$terms = current($terms);

		if (get_field( 't20shot' )) {
			$t2oimage = get_field( 't20shot' );
			echo "<img src='".$t2oimage['sizes']['poster']."'>";
		} else {
			the_post_thumbnail( 'poster' );
		}
		?>
		</div>

		<div class="span8">
			<?php the_content(); ?>

			<div class="stats">

				<h2>STATS</h2>

				<?php if (get_field( 'role' )): ?>
				<dl>
					<dt>
						Role
					</dt>
					<dd>
						<?php the_field( 'role' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'bats' )): ?>
				<dl>
					<dt>
						bats
					</dt>
					<dd>
						<?php the_field( 'bats' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'bowls' )): ?>
				<dl>
					<dt>
						bowls
					</dt>
					<dd>
						<?php the_field( 'bowls' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'shirt_number' )): ?>
				<dl>
					<dt>
						shirt number
					</dt>
					<dd>
						<?php the_field( 'shirt_number' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'qualifications' )): ?>
				<dl>
					<dt>
						qualifications
					</dt>
					<dd>
						<?php the_field( 'qualifications' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'place_of_birth' )): ?>
				<dl>
					<dt>
						place of birth
					</dt>
					<dd>
						<?php the_field( 'place_of_birth' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'date_of_birth' )): ?>
				<dl>
					<dt>
						date of birth
					</dt>
					<dd>
						<?php echo date("j/m/Y", strtotime(get_field( 'date_of_birth') )); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'height' )): ?>
				<dl>
					<dt>
						height
					</dt>
					<dd>
						<?php the_field( 'height' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'weight' )): ?>
				<dl>
					<dt>
						weight
					</dt>
					<dd>
						<?php the_field( 'weight' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'nickname' )): ?>
				<dl>
					<dt>
						nickname
					</dt>
					<dd>
						<?php the_field( 'nickname' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'bat_used_weight' )): ?>
				<dl>
					<dt>
						bat used weight
					</dt>
					<dd>
						<?php the_field( 'bat_used_weight' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'colour_number' )): ?>
				<dl>
					<dt>
						colour number
					</dt>
					<dd>
						<?php the_field( 'colour_number' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

				<?php if (get_field( 'wccc_debut' )): ?>
				<dl>
					<dt>
						wccc debut
					</dt>
					<dd>
						<?php the_field( 'wccc_debut' ); ?>
					</dd>
				</dl>
				<?php endif; ?>

			</div>

		</div>

</article>

