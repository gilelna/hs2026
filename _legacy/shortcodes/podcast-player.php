<?php
/**
 * Shortcode: Podcast Episode Player (Spotify / Libsyn / audio fallback)
 *
 * Usage:
 *  - [EpisodePlayerEmbed] (backward compatible)
 *  - [podcast_player]
 */

if (!function_exists('hs_episode_player_shortcode')) {
function hs_episode_player_shortcode($atts) {
	global $post;
	if ( ! $post ) return '';

	$post_id = $post->ID;

	// If this post links to a podcast episode, use that episode ID instead
	$linked_episode_id = get_post_meta( $post_id, '_linked_podcast_id', true );
	if ( $linked_episode_id ) {
		$post_id = intval($linked_episode_id);
	}

	// Check for Spotify ID
	$spotify_id = get_post_meta( $post_id, 'wpcf-spotify-episode-id', true );
	if ( $spotify_id ) {
		return '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/episode/' . esc_attr($spotify_id) . '?utm_source=generator&theme=0" width="100%" height="200" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>';
	}

	// Check for Libsyn ID
	$libsyn_id = get_post_meta( $post_id, 'wpcf-libsyn-id', true );
	if ( $libsyn_id ) {
		return '<iframe title="Embed Player" src="https://play.libsyn.com/embed/episode/id/' . esc_attr($libsyn_id) . '/height/192/theme/modern/size/large/thumbnail/yes/custom-color/e0e0e0/time-start/00:00:00/hide-playlist/yes/download/yes/font-color/000000" height="192" width="100%" scrolling="no" allowfullscreen style="border:none;"></iframe>';
	}

	// Fallback: check for audio file
	$audio_file_url = get_post_meta( $post_id, 'audio_file', true );
	if ( $audio_file_url ) {
		return '<audio controls style="width:100%"><source src="' . esc_url($audio_file_url) . '" type="audio/mpeg">Your browser does not support the audio element.</audio>';
	}

	return '';
}
}

// Back-compat and clearer alias
add_shortcode( 'EpisodePlayerEmbed', 'hs_episode_player_shortcode' );
add_shortcode( 'podcast_player', 'hs_episode_player_shortcode' );


