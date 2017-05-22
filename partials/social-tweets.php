	<section id="twitter">
		<div class="container">
			<div class="row">
				<h2>LATEST TWEETS</h2>
				<div class="tweets">
					<?php
					// TWITTER OAUTH SETTINGS
					$twitteruser = '@WorcsCCC';
					$notweets = '25';
					$consumerkey = '34yHWgUgRHgVPKASUdkpNA';
					$consumersecret = 'Zlc7HitIakfgiEoNhscC5JOI9lzg5krvSb6y1VHY';
					$accesstoken = '84123573-9EfiiocjJOhzHYqO8vPDgKoy7Db9PhLAopTqjOEEG';
					$accesstokensecret = 'Yc9b4IKjQ2PxD0WMuNSuhiKQdcJjdRsHA1CDs8EM7mY';
					
					function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
						$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
						return $connection;
					}
					$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
					$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&include_rts=true&exclude_replies=true&trim_user=true&contributor_details=false&count=".$notweets);
				    $counter = 0; //set up a counter so we can count the number of iterations
					foreach ($tweets as $tweet):
						//if (isset($tweet->entities->media[0])):
						//	$counter++;
						$created = $tweet->created_at;
						$text = $tweet->text;
						//$tweet_url = $tweet->entities->media[0]->url;
						//$media = $tweet->entities->media[0];
						//$media_url = $media->media_url;
						//$media_image = str_replace("http","https", $media_url);
						$posted_date = date('l jS F Y G:i', strtotime($created));
						?>
						<div class="tweet">
							<h4><?php echo $text; ?></h4>
						</div>
						<?php 
						//endif;
						//if ($counter == 3) break;
					endforeach;
					?>
					</div>
					<p>Follow us on twitter: <a href="https://twitter.com/WORCSCCC" target="_blank">@WORCSCCC</a></p>
				</div>
			</div>
		</div>
	</section>