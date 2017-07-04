<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('span3'); ?>>

	<a href="<?php the_permalink(); ?>">
	
		<?php 
		if (has_post_thumbnail()) 
		{
			the_post_thumbnail( 'thumbnail' ); 
		} 
		else 
		{
			echo "<img src='".get_stylesheet_directory_uri()."/assets/images/poster-holder.jpg'>";
		}
		?>

		<header>
			<h1><?php the_title(); ?></h1>
		</header>

	</a>

</article>

