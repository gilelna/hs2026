<?php
/**
 * Shortcode: Transcript Box
 *
 * Usage: [transcript_box]
 */

if (!function_exists('hs_transcript_box_shortcode')) {
function hs_transcript_box_shortcode($atts) {
	global $post;

	$transcript = get_post_meta($post->ID, '_transcript_content', true);
	if (!$transcript) return '';

	// Calculate word count
	$word_count = str_word_count(strip_tags($transcript));

	ob_start(); ?>
	<div class="transcript-box" data-post-id="<?php echo esc_attr($post->ID); ?>">
		<div id="transcript-overlay-<?php echo esc_attr($post->ID); ?>" class="transcript-overlay">
			<div class="transcript-modal" role="dialog" aria-modal="true" aria-labelledby="transcript-title-<?php echo esc_attr($post->ID); ?>">
				<div class="transcript-modal-header">
					<h2 id="transcript-title-<?php echo esc_attr($post->ID); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></h2>
					<div>
						<span style="margin-right: 1rem;">Word Count: <?php echo intval($word_count); ?></span>
						<button class="transcript-print-btn" type="button" onclick="hsTranscriptOpen(<?php echo esc_js($post->ID); ?>)">Open Transcript in New Tab</button>
					</div>
				</div>
				<div id="transcript-content-<?php echo esc_attr($post->ID); ?>" class="transcript-modal-content">
					<?php echo wpautop(wp_kses_post($transcript)); ?>
				</div>
				<button class="transcript-close" aria-label="Close">&times;</button>
			</div>
		</div>
		<div class="transcript-box-btn-wrapper" style="text-align:center;margin:2rem 0;">
			<button class="transcript-box-btn" type="button">View Transcript</button>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
}

add_shortcode('transcript_box', 'hs_transcript_box_shortcode');


