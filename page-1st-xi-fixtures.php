<?php
/**
 * The template for displaying First XI Fixtures
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

			<opta-widget sport="cricket" widget="fixtures" fixtures_type="e" competition="1969" season="0" team="56" template="normal" live="true" show_venue="true" match_status="all" grouping="date" show_grouping="true" default_nav="1" start_on_current="true" switch_current="0" sub_grouping="date" show_subgrouping="false" order_by="date_ascending" show_crests="false" show_competition_name="true" date_format="dddd D MMMM YYYY" month_date_format="MMMM" competition_naming="full" team_naming="full" match_link="<?php echo home_url('results'); ?>" pre_match="false" show_live="false" show_logo="true" show_title="true" breakpoints="400"></opta-widget>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php
get_footer();
