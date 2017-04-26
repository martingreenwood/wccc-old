<?php
/**
 * The template for displaying First XI Fixtures
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wccc
 */

get_header(); ?>

	<?php 
	if (get_field( 'enable_t20_mode', 'option' )):
		$bannerimage = get_template_directory_uri() . "/assets/images/rapids-banner.png";
	else: 
		$bannerimage = get_template_directory_uri() ."/assets/images/banner.png";
	endif; 

	if (get_field( 'top_image' )) {
		$top_image = get_field( 'top_image' ); 
		$top_image = $top_image['url']; 
	} else {
		$top_image = get_template_directory_uri() ."/assets/images/player.png";
	}

	?>
	<section id="jumbrotron">
		<div class="overlay" style="background-image: url(<?php echo $bannerimage; ?>)"></div>

		<div class="news" style="background-image: url(<?php echo $top_image; ?>)">
			<div class="table"><div class="cell middle">
				<div class="container">
					<div class="span6">
						&nbsp;
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="span6">
					</div>
				</div>
			</div></div>
		</div>
	</section>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<opta-widget sport="cricket" widget="score_card" template="normal" live="true" competition="<?php echo $_GET['competition']; ?>" season="0" match="<?php echo $_GET['match']; ?>" show_match_header="true" show_crests="true" show_competition_name="true" show_match_description="true" show_date="true" date_format="dddd D MMMM YYYY HH:mm" show_venue="true" show_officials="all" show_toss="true" show_innings_breakdown="true" show_current_batting="true" show_best_batting="1" show_best_bowling="1" show_state_of_play="true" navigation="tabs" default_nav="1" show_batting="true" show_mins_batted="true" show_fours="true" show_sixes="true" show_strike_rate="true" show_bowling="true" show_economy="true" show_dot_balls="true" show_bowling_extras="true" show_fow="true" show_partnerships="true" show_unfinished_partnerships="true" team_naming="full" player_naming="last_name" show_logo="true" show_title="false" breakpoints="400, 700"></opta-widget>

			<h1>MANHATTAN</h1>
			<hr>
			<opta-widget sport="cricket" widget="manhattan" template="normal" competition="<?php echo $_GET['competition']; ?>" season="0" match="<?php echo $_GET['match']; ?>" live="true" show_match_header="false" show_crests="true" show_competition_name="true" show_state_of_play="true" show_graphs="all" side="both" show_key="true" show_innings="both" show_tooltips="true" show_officials="on_field" show_axis_labels="true" show_timecontrols="true" team_naming="full" player_naming="full" show_live="true" show_logo="true" show_title="false" breakpoints="400, 700"></opta-widget>

			<h1>WAGON WHEEL</h1>
			<hr>
			<opta-widget sport="cricket" widget="wagonwheel" template="normal" competition="<?php echo $_GET['competition']; ?>" season="0" match="<?php echo $_GET['match']; ?>" live="true" show_match_header="false" show_crests="true" show_state_of_play="true" show_team_sheets="true" show_innings="all" side="both" show_key="true" show_runs_summary="true" show_segments="true" show_tooltips="true" team_naming="full" player_naming="full" show_logo="true" show_live="true" show_title="false" breakpoints="400, 700"></opta-widget>

		</main>

	</div>

<?php
get_footer();
