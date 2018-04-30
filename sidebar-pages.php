<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wccc
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area span3 animated fadeIn delay1" role="complementary">

	<?php dynamic_sidebar( 'sidebar-3' ); ?>


	<?php if( have_rows('downloads') ): ?>
	<div class="files widget">
		<h2 class="widget-title">Downloads</h2>
		<?php while ( have_rows('downloads') ) : the_row();
		$file = get_sub_field( 'files' );
		?>
		<a href="<?php echo $file['url']; ?>" class="<?php echo $file['type']; ?>">
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo strip_tags(strtoupper(makePretty($file['name']))); ?>
		</a>
		<?php endwhile ?>
	</div>
	<?php endif; ?>

	<!-- <div class="tabs widget">
		<ul class="tab-links">
			<li class="active"><a href="#tab1">Specsavers County Championship Division Two 2017</a></li>
			<li><a href="#tab2">Royal London One-Day Cup 2017</a></li>
			<li><a href="#tab3">NatWest T20 Blast 2017</a></li>
		</ul>

		<div class="tab-content">
			<div id="tab1" class="tab <?php if (!get_field( 'enable_t20_mode', 'option' )): ?> active <?php endif; ?>">
				<h3>Specsavers County Championship Division Two 2017</h3>
				<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1969" season="0" team="56" navigation="none" default_nav="1" show_key="true" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>

			<div id="tab2" class="tab">
				<h3>Royal London One-Day Cup 2017</h3>
				<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1970" season="0" team="56" navigation="none" default_nav="1" show_key="true" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>

			<div id="tab3" class="tab <?php if (get_field( 'enable_t20_mode', 'option' )): ?> active <?php endif; ?>">
				<h3>NatWest T20 Blast 2017</h3>
				<opta-widget sport="cricket" widget="standings" template="normal" live="false" competition="1971" season="0" team="56" navigation="none" default_nav="1" show_key="true" show_crests="false" points_in_first_column="true" competition_naming="full" team_naming="full" sorting="false" show_live="true" show_logo="false" show_title="false" breakpoints="400, 700"></opta-widget>
			</div>
		</div>
	</div> -->

</aside>
