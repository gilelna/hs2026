<?php
/**
 * Reusable Inline Video Shortcode
 *
 * Shortcodes:
 *  - [videoinline]
 *  - [inlinevideo]
 *
 * Attributes:
 *  - video: URL (YouTube/Vimeo). Default: current post meta 'wpcf-video-url'
 *  - img:  'thumbnail' | 'featureimage' | absolute URL. Default: 'featureimage'
 */

if ( ! function_exists( 'hs_inline_video_shortcode' ) ) {
	function hs_inline_video_shortcode( $atts ) {
		global $post;

		$atts = shortcode_atts(
			array(
				'video' => '',
				'img'   => 'featureimage',
			),
			$atts,
			'videoinline'
		);

		$video_url = trim( (string) ( $atts['video'] ?: ( $post ? get_post_meta( $post->ID, 'wpcf-video-url', true ) : '' ) ) );
		if ( ! $video_url ) {
			return '';
		}

		$video_id   = '';
		$type       = '';
		$vimeo_hash = '';

		// YouTube variants.
		if ( strpos( $video_url, 'youtube.com' ) !== false || strpos( $video_url, 'youtu.be' ) !== false ) {
			$patterns = array(
				'/(?:youtu\.be\/)([A-Za-z0-9_-]{6,})/i',
				'/v=([A-Za-z0-9_-]{6,})/i',
				'/embed\/([A-Za-z0-9_-]{6,})/i',
				'/shorts\/([A-Za-z0-9_-]{6,})/i',
			);
			foreach ( $patterns as $pattern ) {
				if ( preg_match( $pattern, $video_url, $matches ) ) {
					$video_id = $matches[1];
					break;
				}
			}
			$type = $video_id ? 'youtube' : '';
		}
		// Vimeo variants + unlisted hash.
		elseif ( strpos( $video_url, 'vimeo.com' ) !== false ) {
			if ( preg_match( '/vimeo\.com\/(?:video\/)?(\d+)/i', $video_url, $matches ) ) {
				$video_id = $matches[1] ?? '';
			}
			$parts = parse_url( $video_url );
			if ( ! empty( $parts['query'] ) ) {
				parse_str( $parts['query'], $query_string );
				if ( ! empty( $query_string['h'] ) ) {
					$vimeo_hash = $query_string['h'];
				}
			}
			if ( ! $vimeo_hash && preg_match( '/vimeo\.com\/\d+\/([A-Za-z0-9]+)/', $video_url, $hash_matches ) ) {
				$vimeo_hash = $hash_matches[1];
			}
			$type = $video_id ? 'vimeo' : '';
		}

		if ( ! $video_id ) {
			return '';
		}

		// Determine thumbnail.
		$thumb_url = '';
		$img       = strtolower( trim( (string) $atts['img'] ) );
		if ( $img && filter_var( $img, FILTER_VALIDATE_URL ) ) {
			$thumb_url = $img;
		} elseif ( $img === 'thumbnail' ) {
			// Attempt to use platform default preview images.
			if ( $type === 'youtube' ) {
				$thumb_url = 'https://i.ytimg.com/vi/' . $video_id . '/hqdefault.jpg';
			} elseif ( $type === 'vimeo' ) {
				// Basic fallback image for Vimeo; high-fidelity requires API.
				$thumb_url = get_stylesheet_directory_uri() . '/css/placeholder.webp';
			}
		} else { // featureimage.
			if ( $post ) {
				$thumb_url = get_the_post_thumbnail_url( $post->ID, 'large' );
			}
			if ( ! $thumb_url && $type === 'youtube' ) {
				$thumb_url = 'https://i.ytimg.com/vi/' . $video_id . '/hqdefault.jpg';
			}
			if ( ! $thumb_url ) {
				$thumb_url = get_stylesheet_directory_uri() . '/css/placeholder.webp';
			}
		}

		ob_start();
		?>
		<div class="inline-video-wrapper" style="position:relative;" data-video-type="<?php echo esc_attr( $type ); ?>" data-video-id="<?php echo esc_attr( $video_id ); ?>" <?php if ( ! empty( $vimeo_hash ) ) { echo 'data-video-h="' . esc_attr( $vimeo_hash ) . '"'; } ?>>
			<div class="video-aspect" style="position:relative;padding-top:56.25%;overflow:hidden;border-radius:12px;background:#eee;">
				<img src="<?php echo esc_url( $thumb_url ); ?>" alt="Video Thumbnail" class="video-thumb" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;">
			</div>
			<div class="video-overlay play-overlay" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
				<div class="play-button" style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;background: <?php echo ( $type === 'youtube' ) ? 'red' : '#1ab7ea'; ?>;">
					<svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="28" height="28"><path d="M10 8.5v7l6-3.5-6-3.5z"/></svg>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	add_shortcode( 'videoinline', 'hs_inline_video_shortcode' );
	add_shortcode( 'inlinevideo', 'hs_inline_video_shortcode' );
}
