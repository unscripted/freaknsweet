<?php
/*  
	Parse Twitter Feeds
    based on code from http://spookyismy.name/old-entries/2009/1/25/latest-twitter-update-with-phprss-part-three.html
    and cache code from http://snipplr.com/view/8156/twitter-cache/
    and other cache code from http://wiki.kientran.com/doku.php?id=projects:twitterbadge
*/
function parse_cache_feed($usernames, $limit) {
	$username_for_feed = str_replace(" ", "+OR+from%3A", $usernames);
	$feed = "http://search.twitter.com/search.atom?q=from%3A" . $username_for_feed . "&rpp=" . $limit;
	$usernames_for_file = str_replace(" ", "-", $usernames);
	$cache_file = dirname(__FILE__).'/cache/' . $usernames_for_file . '-twitter-cache';
	$last = filemtime($cache_file);
	$now = time();
	$interval = 600;
	
	
	
	// check the cache file
	if ( !$last || (( $now - $last ) > $interval) ) {
		
		// cache file doesn't exist, or is old, so refresh it
		$ch = curl_init();
		$timeout = 5; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $feed);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$cache_rss = curl_exec($ch);
		curl_close($ch);
		
		if (!$cache_rss) {
			// we didn't get anything back from twitter
			echo "<!-- ERROR: Twitter feed was blank! Using cache file. -->";
		} else {
			// we got good results from twitter
			echo "<!-- SUCCESS: Twitter feed used to update cache file -->";
			$cache_static = fopen($cache_file, 'wb');
			fwrite($cache_static, serialize($cache_rss));
			fclose($cache_static);
		}
		
		// read from the cache file
		$rss = @unserialize(file_get_contents($cache_file));
	
	} else {
		// cache file is fresh enough, so read from it
		echo "<!-- SUCCESS: Cache file was recent enough to read from -->";
		$rss = @unserialize(file_get_contents($cache_file));
	}
	
	
	
	// clean up and output the twitter feed
	$feed = str_replace("&amp;", "&", $rss);
	$feed = str_replace("&lt;", "<", $feed);
	$feed = str_replace("&gt;", ">", $feed);
	$clean = explode("<entry>", $feed);
	$clean = str_replace("&quot;", "\"", $clean);
	$clean = str_replace("&apos;", "\"", $clean);
	$amount = count($clean) - 1;
	
	
	
	if ($amount) { // are there any tweets? ?>

    <ul id="twitter_update_list"> 
    
    <?php
	for ($i = 1; $i <= $amount; $i++) {
		$entry_close = explode("</entry>", $clean[$i]);
		$clean_content_1 = explode("<content type=\"html\">", $entry_close[0]);
		$clean_content = explode("</content>", $clean_content_1[1]);
		$clean_name_2 = explode("<name>", $entry_close[0]);
		$clean_name_1 = explode("(", $clean_name_2[1]);
		$clean_name = explode(")</name>", $clean_name_1[1]);
		$clean_user = explode(" (", $clean_name_2[1]);
		$clean_lower_user = strtolower($clean_user[0]);
		$clean_uri_1 = explode("<uri>", $entry_close[0]);
		$clean_uri = explode("</uri>", $clean_uri_1[1]);
		$clean_time_1 = explode("<published>", $entry_close[0]);
		$clean_time = explode("</published>", $clean_time_1[1]);
		$unix_time = strtotime($clean_time[0]);
		$pretty_time = relativeTime($unix_time);
		?>

        <li><span><?php echo $clean_content[0]; ?></span><a href="<?php echo $clean_uri[0]; ?>"><?php echo $pretty_time; ?></a></li>
        
	<?php } ?>
    
    </ul>
    
    <?php } else { ?>
    
    <ul id="twitter_update_list">
		<li>Sorry, no feeds are available.</li>
    </ul>
    
    <?php
	}
}
