<?php
require_once '../../../../../wp-config.php';

global $wpdb;
$td_post_id = $_POST['id'];
$ip = $_SERVER['REMOTE_ADDR'];
$like = get_post_meta($td_post_id, '_liked', true);

if($td_post_id != '') {
	$voteStatusByIp = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."ilikethis_votes WHERE post_id = '$td_post_id' AND ip = '$ip'");
	
    if (!isset($_COOKIE['liked-'.$td_post_id]) && $voteStatusByIp == 0) {
		$likeNew = $like + 1;
		update_post_meta($td_post_id, '_liked', $likeNew);

		setcookie('liked-'.$td_post_id, time(), time()+3600*24*365, '/');
		$wpdb->query("INSERT INTO ".$wpdb->prefix."ilikethis_votes VALUES ('', NOW(), '$td_post_id', '$ip')");

		echo $likeNew;
	}
	else {
		echo $like;
	}
}
?>