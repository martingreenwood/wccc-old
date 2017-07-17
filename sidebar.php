<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wccc
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area span3 animated fadeIn delay1" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php 
	if (get_field( 'files' )):
	$file = get_field( 'files' );
	?>
	<div class="files widget">
		<h2 class="widget-title">Downloads</h2>
		<a href="<?php echo $file['url']; ?>" class="<?php echo $file['type']; ?>">
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo strip_tags(strtoupper(makePretty($file['name']))); ?>
		</a>
	</div>
	<?php endif; ?>

	
</aside>

