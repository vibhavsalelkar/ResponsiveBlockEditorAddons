<?php
/**
 * Server-side rendering for the instagram block
 *
 * @since   1.0.0
 * @package Responsive Blocks
 */

/**
 * Function using WordPress API to fetch instagram data.
 *
 * @param String $url api to featch instagram posts.
 * @return JSON instagram data
 */
function rbea_instagram_fetch_data( $url ) {
	$request = wp_remote_get( $url );

	if ( is_wp_error( $request ) ) {
		return false;
	}

	return wp_remote_retrieve_body( $request );
}

/**
 * Function using Transient to store/cache data for limited period.
 * The number of images is used as a suffix in the case that the user.
 * adds/removes images and expects a refreshed feed.
 *
 * @param String $result data.
 * @param String $suffix number of posts.
 * @param Number $expire time.
 * @return void [description]
 */
function rbea_instagram_data_to_cache( $result, $suffix = '', $expire = ( 60 * 60 * 6 ) ) {
	set_transient( 'rbea-instagram-api_' . $suffix, $result, $expire );
}

/**
 * Function using Transient to get cache/data stored for limited time.
 *
 * @param String $suffix checks if it is present in cache.
 * @return JSON instagram data
 */
function rbea_instagram_data_from_cache( $suffix = '' ) {
	return get_transient( 'rbea-instagram-api_' . $suffix );
}

/**
 * Function to render data in front-end.
 *
 * @param Array $attributes used in blocks.
 * @return String data to render
 */
function rbea_instagram_render_callback( array $attributes ) {
	$attributes = wp_parse_args(
		$attributes,
		array(
			'block_id'      => '',
			'token'         => '',
			'numberOfItems' => 4,
			'columns'       => 4,
			'imagesGap'     => 0,
			'showCaptions'  => false,
			'borderRadius'  => 0,
		)
	);

	$token           = $attributes['token'];
	$number_of_items = $attributes['numberOfItems'];
	$columns         = $attributes['columns'];
	$images_gap      = $attributes['imagesGap'];
	$show_aptions    = $attributes['showCaptions'];
	$border_radius   = $attributes['borderRadius'];

	$suffix = $token . '_' . $number_of_items;

	if ( ! rbea_instagram_data_from_cache( $suffix ) ) {
		$result = json_decode( rbea_instagram_fetch_data( "https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token={$token}" ) );
		rbea_instagram_data_to_cache( $result, $suffix );
	} else {
		$result = rbea_instagram_data_from_cache( $suffix );
	}

	$insta_posts = $result->data;

	$image_container = '<div class="responsive-block-editor-addons-block-instagram block-' . $attributes['block_id'] . '">
    <div class="responsive-block-editor-addons-instagram-wrapper">
	<div class="responsive-block-editor-addons-instagram-posts-container responsive-block-editor-addons-grid">';

	if ( is_array( $insta_posts ) ) {
		foreach ( $insta_posts as $key => $insta_post ) {

			$media_type = esc_attr( $insta_post->media_type );
			$image      = esc_attr( $insta_post->media_url );

			if ( 'VIDEO' === $media_type ) {
				$image = esc_attr( $insta_post->thumbnail_url );
			}

			if ( $key < $number_of_items ) {
				$image_container .= '
				<a  href="' . esc_attr( $insta_post->permalink ) . '"
				target="_blank" rel="noopener noreferrer"
                class = "responsive-block-editor-addons-image-wrapper has-equal-images">
					<img
					class="responsive-block-editor-addons-instagram-image"
					key="' . esc_attr( $insta_post->id ) . '"
					src="' . $image . '"
					alt="' . ( empty( $insta_post->caption ) ? '' : esc_attr( $insta_post->caption ) ) . '"
					/>
				</a>';
			}
		}
	}

	return "{$image_container}</div></div></div>";
}
