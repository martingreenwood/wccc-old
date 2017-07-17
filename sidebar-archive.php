<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wccc
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area animated fadeIn delay1" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
