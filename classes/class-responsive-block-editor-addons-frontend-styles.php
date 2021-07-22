<?php
/**
 * RBEA Styles.
 *
 * @package category
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Responsive_Block_Editor_Addons_Frontend_Styles' ) ) {

	/**
	 * Class Responsive_Block_Editor_Addons_Frontend_Styles.
	 */
	final class Responsive_Block_Editor_Addons_Frontend_Styles {

		/**
		 * Get Advanced Heading CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_advanced_heading_css( $attr, $id ) {
			$defaults = self::get_responsive_block_advanced_heading_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors        = array(
				''                                => array(
					'text-align' => $attr['headingAlignment'],
				),
				' .responsive-heading-title-text' => array(
					'color'           => $attr['headingTitleColor'],
					'font-family'     => $attr['headingTitleFontFamily'],
					'font-size'       => self::get_css_value( $attr['headingTitleFontSize'], 'px' ),
					'font-weight'     => $attr['headingTitleFontWeight'],
					'line-height'     => $attr['headingTitleLineHeight'],
					'letter-spacing'  => self::get_css_value( $attr['headingTitleLetterSpacing'], 'px' ),
					'margin-bottom'   => self::get_css_value( $attr['headSpacing'], 'px' ),
					'text-decoration' => $attr['textDecoration'],
				),
				' .responsive-heading-seperator'  => array(
					'border-top-style' => $attr['seperatorStyle'],
					'border-color'     => $attr['separatorColor'],
					'border-top-width' => self::get_css_value( $attr['separatorHeight'], 'px' ),
					'width'            => self::get_css_value( $attr['separatorWidth'], $attr['separatorWidthType'] ),
					'margin-bottom'    => self::get_css_value( $attr['separatorSpacing'], 'px' ),
				),
				' .responsive-heading-desc-text'  => array(
					'color'           => $attr['subHeadingTitleColor'],
					'font-family'     => $attr['subHeadingTitleFontFamily'],
					'font-size'       => self::get_css_value( $attr['subHeadingTitleFontSize'], 'px' ),
					'font-weight'     => $attr['subHeadingTitleFontWeight'],
					'line-height'     => $attr['subHeadingTitleLineHeight'],
					'letter-spacing'  => self::get_css_value( $attr['subHeadingTitleLetterSpacing'], 'px' ),
					'margin-bottom'   => self::get_css_value( $attr['subheadSpacing'], 'px' ),
					'text-decoration' => $attr['textDecorationSubHeading'],
				),
			);
			$mobile_selectors = array(
				''                                => array(
					'text-align' => $attr['headingAlignmentMobile'],
				),
				' .responsive-heading-title-text' => array(
					'font-size'     => self::get_css_value( $attr['headingTitleFontSizeMobile'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['headSpacingMobile'], 'px' ),
				),
				' .responsive-heading-seperator'  => array(
					'margin-bottom' => self::get_css_value( $attr['separatorSpacingMobile'], 'px' ),
				),
				' .responsive-heading-desc-text'  => array(
					'font-size'     => self::get_css_value( $attr['subHeadingTitleFontSizeMobile'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['subheadSpacingMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				''                                => array(
					'text-align' => $attr['headingAlignmentTablet'],
				),
				' .responsive-heading-title-text' => array(
					'font-size'     => self::get_css_value( $attr['headingTitleFontSizeTablet'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['headSpacingTablet'], 'px' ),
				),
				' .responsive-heading-seperator'  => array(
					'margin-bottom' => self::get_css_value( $attr['separatorSpacingTablet'], 'px' ),
				),
				' .responsive-heading-desc-text'  => array(
					'font-size'     => self::get_css_value( $attr['subHeadingTitleFontSizeTablet'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['subheadSpacingTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-advanced-heading.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}


		/**
		 * Get Advanced Columns CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_advanced_columns_css( $attr, $id ) {
			$defaults = self::get_responsive_block_advanced_columns_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity          = $attr['opacity'] / 100;
			$column_height_style = '';
			if ( 'half' === $attr['height'] ) {
				$column_height_style = '50vh !important';
			}
			if ( 'full' === $attr['height'] ) {
				$column_height_style = '100vh !important';
			}
			if ( 'custom' === $attr['height'] ) {
				$column_height_style = $attr['customHeight'] . 'px !important';
			}

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}
			$max_width = '100%';

			if ( 'custom' === $attr['contentWidth'] ) {
				if ( '' !== $attr['width'] ) {
					$max_width = self::get_css_value( $attr['width'], $attr['widthType'] );
				}
			}

			$background_type_image_styles = array();
			if ( 'image' === $attr['backgroundType'] && $attr['backgroundImage'] ) {
				$background_type_image_styles = array(
					'background-image'      => 'linear-gradient(' . self::hex_to_rgb( $attr['backgroundImageColor'] ? $attr['backgroundImageColor'] : '#fff', $imgopacity ) . ',' . self::hex_to_rgb( $attr['backgroundImageColor'] ? $attr['backgroundImageColor'] : '#fff', $imgopacity ) . '),url(' . $attr['backgroundImage'] . ')',
					'background-position'   => $attr['backgroundPosition'],
					'background-attachment' => $attr['backgroundAttachment'],
					'background-repeat'     => $attr['backgroundRepeat'],
					'background-size'       => $attr['backgroundSize'],
				);
			}
			$selectors = array(
				''                                => array(
					'z-index' => $attr['z_index'],
				),
				' .responsive-columns-wrap'       => array(
					'text-align'       => $attr['blockAlign'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-color'     => $attr['blockBorderColor'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ) . ' !important',
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'background-color' => 'color' === $attr['backgroundType'] ? self::hex_to_rgb( $attr['backgroundColor'], $imgopacity ) : '',
					'background-image' => 'gradient' === $attr['backgroundType'] ? self::generate_background_image_effect(
						self::hex_to_rgb( $attr['backgroundColor1'], $imgopacity ),
						self::hex_to_rgb( $attr['backgroundColor2'], $imgopacity ),
						$attr['gradientDirection'],
						$attr['colorLocation1'],
						$attr['colorLocation2']
					) : '',
					'box-shadow'       => self::get_css_value( $attr['boxShadowHOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowVOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowBlur'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
				),
				' .responsive-columns-inner-wrap' => array(
					'max-width' => $max_width,
				),
				'.background-type-image'          => $background_type_image_styles,
				' .responsive-block-editor-addons-block-columns.overlay-type-color' => array(
					'background-color' => 'image' === $attr['backgroundType'] ? self::hex_to_rgb( $attr['backgroundImageColor'], $imgopacity ) : '',
				),
				' .responsive-block-editor-addons-block-columns.overlay-type-gradient.linear' => array(
					'background-image' => self::generate_background_image_effect(
						self::hex_to_rgb( $attr['gradientOverlayColor1'], $imgopacity ),
						self::hex_to_rgb( $attr['gradientOverlayColor2'], $imgopacity ),
						$attr['gradientOverlayAngle'],
						$attr['gradientOverlayLocation1'],
						$attr['gradientOverlayLocation2']
					),
				),
				' .responsive-block-editor-addons-block-columns.overlay-type-gradient.radial' => array(
					'background-image' => 'radial-gradient( at ' . $attr['gradientOverlayPosition'] . ',' . self::hex_to_rgb( $attr['gradientOverlayColor1'] ? $attr['gradientOverlayColor1'] : '#fff', $imgopacity ) .
						' ' . $attr['gradientOverlayLocation1'] . '%,' . self::hex_to_rgb( $attr['gradientOverlayColor2'] ? $attr['gradientOverlayColor2'] : '#fff', $imgopacity ) .
						' ' . $attr['gradientOverlayLocation2'] . '%)',
				),
				' .responsive-block-editor-addons-block-column' => array(
					'min-height'  => $column_height_style,
					'align-items' => $attr['verticalAlign'],
				),
				' .responsive-block-editor-addons-block-columns' => array(
					'padding-top'    => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPadding'], 'px' ),
					'margin-top'     => self::get_css_value( $attr['topMargin'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMargin'], 'px' ),
				),

			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-block-columns' => array(
					'padding-top'    => self::get_css_value( $attr['topPaddingMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingMobile'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingMobile'], 'px' ),
					'margin-top'     => self::get_css_value( $attr['topMarginMobile'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginMobile'], 'px' ),
				),

			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-block-columns' => array(
					'padding-top'    => self::get_css_value( $attr['topPaddingTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingTablet'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingTablet'], 'px' ),
					'margin-top'     => self::get_css_value( $attr['topMarginTablet'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);
			$id                 = '.responsive-block-editor-addons-advanced-column-outer-wrap.block-' . $id;
			$css                = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Advanced Columns CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_post_carousel_css( $attr, $id ) {
			$defaults = self::get_responsive_block_post_carousel_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$inner_height        = $attr['displayPostImage'] ? '' : '100% !important';
			$slick_button_styles = array(
				'border-color'  => $attr['arrowDotsColor'],
				'border-radius' => self::get_css_value( $attr['arrowBorderRadius'], 'px' ),
				'border-width'  => self::get_css_value( $attr['arrowBorderSize'], 'px' ),
			);
			$imgopacity          = $attr['opacity'] / 100;
			$selectors           = array(
				' .responsive-post-slick-carousel-' . $id . ' .slick-prev.slick-arrow' => $slick_button_styles,
				' .responsive-post-slick-carousel-' . $id . ' .slick-next.slick-arrow' => $slick_button_styles,
				' .responsive-post-slick-carousel-' . $id . ' .slick-slide>div:first-child' => array(
					'margin-left'  => self::get_css_value( ( $attr['columnGap'] / 2 ), 'px' ),
					'margin-right' => self::get_css_value( ( $attr['columnGap'] / 2 ), 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-title' => array(
					'font-family'   => $attr['titleFontFamily'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-weight'   => $attr['titleFontWeight'],
					'line-height'   => $attr['titleLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['imageSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-title a' => array(
					'color' => $attr['titleColor'],
				),
				' .responsive-block-editor-addons-block-post-carousel-byline' => array(
					'color'         => $attr['metaColor'],
					'font-family'   => $attr['metaFontFamily'],
					'font-size'     => self::get_css_value( $attr['metaFontSize'], 'px' ),
					'font-weight'   => $attr['metaFontWeight'],
					'line-height'   => $attr['metaLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['dateSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-excerpt' => array(
					'text-align'  => $attr['blockAlign'],
					'color'       => $attr['contentColor'],
					'font-family' => $attr['excerptFontFamily'],
					'font-size'   => self::get_css_value( $attr['excerptFontSize'], 'px' ),
					'font-weight' => $attr['excerptFontWeight'],
					'line-height' => $attr['excerptLineHeight'],
				),
				' .responsive-block-editor-addons-block-post-carousel-excerpt p:first-child' => array(
					'margin-bottom' => self::get_css_value( $attr['excerptSpace'], 'px' ),

				),
				' .responsive-block-editor-addons-block-post-carousel-date' => array(
					'color' => $attr['metaColor'],
				),
				' .responsive-block-editor-addons-block-post-carousel-author a' => array(
					'color' => $attr['metaColor'],
				),
				' .responsive-block-editor-addons-block-post-carousel-taxonomy a' => array(
					'color' => $attr['metaColor'],
				),
				' .responsive-block-editor-addons-block-post-carousel-more-link-wrapper' => array(
					'font-family'   => $attr['ctaFontFamily'],
					'font-size'     => self::get_css_value( $attr['ctaFontSize'], 'px' ),
					'font-weight'   => $attr['ctaFontWeight'],
					'line-height'   => $attr['ctaLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['ctaSpace'], 'px' ) . ' !important',
					'margin-top'    => '0px',
				),
				' .responsive-block-editor-addons-block-post-carousel-more-link.responsive-block-editor-addons-text-link' => array(
					'color'            => $attr['ctaColor'],
					'background-color' => $attr['ctaBackColor'],
					'border-color'     => $attr['ctaBorderColor'],
					'border-style'     => $attr['ctaBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['ctaBorderRadius'], 'px' ),
					'border-width'     => self::get_css_value( $attr['ctaBorderWidth'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['ctaHpadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['ctaHpadding'], 'px' ),
					'padding-top'      => self::get_css_value( $attr['ctaVpadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['ctaVpadding'], 'px' ),
					'display'          => 'inline-block',
				),
				' .responsive-block-editor-addons-block-post-carousel-more-link:hover' => array(
					'color'            => $attr['ctaHoverColor'],
					'background-color' => $attr['ctaHoverBackColor'],
					'border-color'     => $attr['ctaHoverBorderColor'],
				),
				' .slick-slide'                   => array(
					'margin-bottom' => self::get_css_value( $attr['rowGap'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-text-wrap' => array(
					'text-align' => $attr['blockAlign'],
					'padding'    => self::get_css_value( $attr['contentPadding'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-header' => array(
					'text-align' => $attr['blockAlign'],
				),
				' .responsive-block-editor-addons-post-carousel-inner' => array(
					'background-color' => $attr['bgColor'],
					'height'           => $inner_height,
				),
				' .responsive-block-editor-addons-block-post-carousel-image-background img' => array(
					'opacity' => $imgopacity,
				),
				' ul.slick-dots li button:before' => array(
					'color' => $attr['arrowDotsColor'],
				),
				' ul.slick-dots li.slick-active button:before' => array(
					'color' => $attr['arrowDotsColor'],
				),

			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-block-post-carousel-text-wrap' => array(
					'padding' => self::get_css_value( $attr['contentPaddingMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-block-post-carousel-text-wrap' => array(
					'padding' => self::get_css_value( $attr['contentPadding'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-carousel-title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);
			$id                 = '.responsive-block-editor-addons-block-post-carousel.block-' . $id;
			$css                = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Post Grid CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_post_grid_css( $attr, $id ) {
			$defaults = self::get_responsive_block_post_grid_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}
			$hoverbox_shadow_position_css = $attr['hoverboxShadowPosition'];

			if ( 'outset' === $attr['hoverboxShadowPosition'] ) {
				$hoverbox_shadow_position_css = '';
			}

			$mobile_selectors = array();
			$tablet_selectors = array();

			$display_link = 'none';
			if ( $attr['displayPostLink'] ) {
				$display_link = 'block';
			}

			$boxedcontent_padding = 0;
			$content_padding      = 0;
			if ( 'content' === $attr['layout'] ) {
				$content_padding      = $attr['contentPadding'];
				$boxedcontent_padding = 0;
			}
			if ( 'boxed' === $attr['layout'] ) {
				$boxedcontent_padding = $attr['contentPadding'];
			}

			$link_styles = array();
			$link_styles = array(
				'display'        => $display_link,
				'color'          => $attr['readMoreLinkColor'],
				'font-size'      => self::get_css_value( $attr['continueFontSize'], 'px' ),
				'font-weight'    => $attr['continueFontWeight'],
				'line-height'    => $attr['continueLineHeight'],
				'text-transform' => $attr['continueTextTransform'],
			);

			$column_gap = '';
			if ( $attr['columnGap'] ) {
				$column_gap = $attr['columnGap'];
			}
			$column_gap_tablet = '';
			if ( $attr['columnGapTablet'] ) {
				$column_gap_tablet = $attr['columnGapTablet'];
			}
			$column_gap_mobile = '';
			if ( $attr['columnGapMobile'] ) {
				$column_gap_mobile = $attr['columnGapMobile'];
			}
			$equal_height = 'fit-content';
			if ( $attr['equalHeight'] ) {
				$equal_height = 'auto';
			}
			$pagination_background        = 'transparent';
			$pagination_background_active = 'transparent';
			if ( 'filled' === $attr['paginationLayout'] ) {
				$pagination_background        = $attr['paginationBorderColor'];
				$pagination_background_active = $attr['paginationActiveBorderColor'];
			}

			$selectors = array(
				' .responsive-block-editor-addons-post-grid-items' => array(
					'grid-column-gap' => self::get_css_value( $column_gap, 'px' ),
					'grid-row-gap'    => self::get_css_value( $attr['rowGap'], 'px' ),
				),
				' article'                     => array(
					'background-color' => $attr['bgColor'] . ' !important',
					'border-style'     => $attr['blockBorderStyle'],
					'border-color'     => $attr['blockBorderColor'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ) . ' !important',
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'height'           => $equal_height,
					'box-shadow'       => self::get_css_value( $attr['boxShadowHOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowVOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowBlur'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
					'padding'          => self::get_css_value( $boxedcontent_padding, 'px' ),

				),
				' article:hover'               => array(
					'box-shadow' => self::get_css_value( $attr['hoverboxShadowHOffset'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowVOffset'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowBlur'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowSpread'], 'px' ) . ' ' . $attr['hoverboxShadowColor'] . ' ' . $hoverbox_shadow_position_css,
				),
				' .responsive-block-editor-addons-post-grid-items article' => array(
					'padding' => self::get_css_value( $boxedcontent_padding, 'px' ),
				),
				' .responsive-block-editor-addons-block-post-grid-text' => array(
					'padding'    => self::get_css_value( $content_padding, 'px' ),
					'text-align' => $attr['textAlignment'],
				),
				' header .responsive-block-editor-addons-block-post-grid-title' => array(
					'font-family'    => $attr['titleFontFamily'],
					'font-size'      => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-weight'    => $attr['titleFontWeight'],
					'line-height'    => $attr['titleLineHeight'],
					'text-transform' => $attr['titleTextTransform'],
					'margin-bottom'  => self::get_css_value( $attr['titleBottomSpacing'], 'px' ),
				),
				' header .responsive-block-editor-addons-block-post-grid-title a' => array(
					'color' => $attr['titleColor'],
				),
				' header .responsive-block-editor-addons-block-post-grid-title a:hover' => array(
					'color' => $attr['titleHoverColor'],
				),
				' .responsive-block-editor-addons-block-post-grid-byline' => array(
					'color'          => $attr['metaColor'],
					'font-family'    => $attr['metaFontFamily'],
					'font-size'      => self::get_css_value( $attr['metaFontSize'], 'px' ),
					'font-weight'    => $attr['metaFontWeight'],
					'line-height'    => $attr['metaLineHeight'],
					'text-transform' => $attr['metaTextTransform'],
					'margin-bottom'  => self::get_css_value( $attr['metaBottomSpacing'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-grid-text .responsive-block-editor-addons-block-post-grid-excerpt' => array(
					'color'          => $attr['textColor'],
					'font-family'    => $attr['excerptFontFamily'],
					'font-size'      => self::get_css_value( $attr['excerptFontSize'], 'px' ),
					'font-weight'    => $attr['excerptFontWeight'],
					'line-height'    => $attr['excerptLineHeight'],
					'text-transform' => $attr['excerptTextTransform'],
					'margin-bottom'  => self::get_css_value( $attr['excerptBottomSpacing'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-grid-more-link' => $link_styles,
				' .responsive-block-editor-addons-block-post-grid-more-link:hover' => array(
					'color'           => $attr['readMoreHoverColor'],
					'text-decoration' => 'none',
				),
				' .read-more a'                => $link_styles,
				' .responsive-block-editor-addons-post-grid-item' => array(
					'margin-bottom' => 0,
				),
				' .is-list .responsive-block-editor-addons-post-grid-item:not(:last-child)' => array(
					'margin-bottom' => self::get_css_value( $attr['rowGap'], 'px' ),
				),
				' .is-list article:last-child' => array(
					'margin-bottom' => 0,
				),
				' .responsive-block-editor-addons-block-post-grid-image img' => array(
					'border-radius' => self::get_css_value( $attr['imageBorderRadius'], 'px' ),
				),
				' .responsive-block-editor-addons-post-pagination-wrap > *' => array(
					'border-width'     => self::get_css_value( $attr['paginationBorderWidth'], 'px' ),
					'border-color'     => $attr['paginationBorderColor'],
					'border-style'     => ' solid ',
					'background-color' => $pagination_background,
					'border-radius'    => self::get_css_value( $attr['paginationBorderRadius'], 'px' ),
					'color'            => $attr['paginationTextColor'] . ' !important',
					'margin-right'     => '10px',
					'padding'          => '0.5em',
				),
				' .responsive-block-editor-addons-post-pagination-wrap > *:last-child' => array(
					'margin-right' => '0',
				),
				' .responsive-block-editor-addons-post-pagination-wrap > span' => array(
					'border-width'     => self::get_css_value( $attr['paginationBorderWidth'], 'px' ),
					'border-color'     => $attr['paginationActiveBorderColor'],
					'border-style'     => ' solid ',
					'background-color' => $pagination_background_active,
					'color'            => $attr['paginationTextActiveColor'] . ' !important',
				),
				' .responsive-block-editor-addons-post-pagination-wrap' => array(
					'text-align' => $attr['paginationAlignment'],
				),

			);

			$grid_template_columns = '1fr 1fr';
			if ( $attr['stackonMobile'] ) {
				$grid_template_columns = '1fr';
			}
			$mobile_content_padding = '0';
			if ( 'boxed' === $attr['layout'] && $attr['mobileContentPadding'] ) {
				$mobile_content_padding = $attr['mobileContentPadding'];
			}
			$mobile_selectors = array(
				' header .responsive-block-editor-addons-block-post-grid-title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-post-grid-items article' => array(
					'padding'    => self::get_css_value( $mobile_content_padding, 'px' ),
					'text-align' => $attr['textAlignment'],
				),
				' .is-list article' => array(
					'grid-template-columns' => $grid_template_columns,
				),
				' .responsive-block-editor-addons-post-grid-items' => array(
					'grid-column-gap' => self::get_css_value( $column_gap_mobile, 'px' ),
					'grid-row-gap'    => self::get_css_value( $attr['rowGapMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' header .responsive-block-editor-addons-block-post-grid-title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-post-grid-items' => array(
					'grid-column-gap' => self::get_css_value( $column_gap_tablet, 'px' ),
					'grid-row-gap'    => self::get_css_value( $attr['rowGapTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id              = '.responsive-block-editor-addons-block-post-grid.block-id-' . $id;
			$css             = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			$css['desktop'] .= '.page-template-gutenberg-fullwidth ' . $id . ' .responsive-block-editor-addons-post-grid-items article {padding:' . ( 'boxed' === $attr['layout'] ? $attr['contentPadding'] ? $attr['contentPadding'] : '0' : '0' ) . 'px;}
    ';
			return $css;
		}

		/**
		 * Get Count Up CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_count_up_css( $attr, $id ) {
			$defaults = self::get_responsive_block_count_up_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity = $attr['opacity'] / 100;

			$selectors        = array(
				'.responsive-count__inner .responsive-count-item__features li' => array(
					'line-height' => $attr['contentLineHeight'],
				),
				'.responsive-count__inner .responsive-block-editor-addons-count-up__source-wrap.res-countup-icon-design-shaped .responsive-block-editor-addons-count-up__source-icon' => array(
					'background-color' => $attr['iconShapeColor'],
					'border-radius'    => self::get_css_value( $attr['shapeBorderRadius'], 'px' ),
					'padding'          => self::get_css_value( $attr['shapePadding'], 'px' ),
				),
				'.responsive-count__inner .responsive-block-editor-addons-count-up__source-wrap.res-countup-icon-design-outline .responsive-block-editor-addons-count-up__source-icon' => array(
					'border-color'  => $attr['iconShapeColor'],
					'border-radius' => self::get_css_value( $attr['shapeBorderRadius'], 'px' ),
					'padding'       => self::get_css_value( $attr['shapePadding'], 'px' ),
					'border-width'  => self::get_css_value( $attr['shapeBorder'], 'px' ),
				),
				'.responsive-count__inner .responsive-block-editor-addons-count-up__source-icon svg' => array(
					'width'  => self::get_css_value( $attr['iconsize'], 'px' ),
					'height' => self::get_css_value( $attr['iconsize'], 'px' ),
					'fill'   => $attr['icon_color'],
				),
				' .responsive-count-item'           => array(
					'background-color' => self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ),
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'border-color'     => $attr['blockBorderColor'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
				),
				' .responsive-block-editor-addons-count-up__source-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['iconSpacing'], 'px' ),
				),
				' .responsive-count-item__title'    => array(
					'color'         => $attr['titleColor'],
					'line-height'   => $attr['headingLineHeight'],
					'font-size'     => self::get_css_value( $attr['headingFontSize'], 'px' ),
					'font-family'   => $attr['headingFontFamily'],
					'font-weight'   => $attr['titleFontWeight'],
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
				),
				'.responsive-count__inner .responsive-count-item__price-wrapper .responsive-count-item__amount' => array(
					'color'         => $attr['numColor'],
					'line-height'   => $attr['dateLineHeight'],
					'font-weight'   => $attr['dateFontWeight'],
					'font-size'     => self::get_css_value( $attr['dateFontSize'], 'px' ),
					'font-family'   => $attr['dateFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['numSpace'], 'px' ),
				),
				' .responsive-count-item__features' => array(
					'color'         => $attr['textColor'],
					'line-height'   => $attr['contentLineHeight'],
					'font-weight'   => $attr['contentFontWeight'],
					'font-size'     => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'font-family'   => $attr['contentFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['contentSpace'], 'px' ),
				),
			);
			$mobile_selectors = array(
				'.responsive-count__inner .responsive-count-item__title' => array(
					'font-size' => self::get_css_value( $attr['headingFontSizeMobile'], 'px' ),
				),
				'.responsive-count__inner .responsive-count-item__price-wrapper .responsive-count-item__amount' => array(
					'font-size' => self::get_css_value( $attr['dateFontSizeMobile'], 'px' ),
				),
				' .responsive-count-item__features' => array(
					'font-size' => self::get_css_value( $attr['contentFontSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				'.responsive-count__inner .responsive-count-item__title' => array(
					'font-size' => self::get_css_value( $attr['headingFontSize'], 'px' ),
				),
				'.responsive-count__inner .responsive-count-item__title' => array(
					'font-size' => self::get_css_value( $attr['headingFontSizeTablet'], 'px' ),
				),
				'.responsive-count__inner .responsive-count-item__price-wrapper .responsive-count-item__amount' => array(
					'font-size' => self::get_css_value( $attr['dateFontSizeTablet'], 'px' ),
				),
				' .responsive-count-item__features' => array(
					'font-size' => self::get_css_value( $attr['contentFontSizeTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id              = '.responsive-block-editor-addons-block-count-up.block-' . $id;
			$css             = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			$css['desktop'] .= '
            .responsive-count {
               padding:' . $attr['contentSpacing'] . 'px;
            }
            ';

			return $css;
		}

		/**
		 * Get Blockquote CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_blockquote_css( $attr, $id ) {
			$defaults = self::get_responsive_block_blockquote_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$quoteopacity            = $attr['quoteOpacity'] / 100;
			$imgopacity              = $attr['opacity'] / 100;
			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$selectors = array(
				' ' => array(
					'background-color' =>
						'color' === $attr['backgroundType']
						? self::hex_to_rgb( $attr['backgroundColor'], $imgopacity ) : '',
					'color'            => $attr['quoteTextColor'],
					'border-color'     => $attr['borderColor'],
					'border-style'     => $attr['borderStyle'],
					'border-width'     => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'box-shadow'       =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
					'position'         => 'relative',
					'text-align'       => $attr['quoteAlign'],
					'padding-left'     => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['rightPadding'], 'px' ),
					'padding-top'      => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'background-color' =>
						'color' === $attr['backgroundType']
						? self::hex_to_rgb( $attr['backgroundColor'], $imgopacity )
						: null,
					'background-image' =>
						'gradient' === $attr['backgroundType']
						? 'linear-gradient(' .
							$attr['gradientDirection'] .
							'deg,' .
							self::hex_to_rgb( $attr['backgroundColor1'] ? $attr['backgroundColor1'] : '#ffffff', $imgopacity ) .
							',' .
							self::hex_to_rgb( $attr['backgroundColor2'] ? $attr['backgroundColor2'] : '#ffffff', $imgopacity ) .
							')'
						: null,
				),
				' .responsive-block-editor-addons-section__video-wrap' => array(
					'opacity' => $imgopacity,
				),
				' .responsive-block-editor-addons-section-background-image-wrap .responsive-block-editor-addons-section-background-image' => array(
					'height'        => 100 . '%',
					'opacity'       => $imgopacity,
					'border-radius' => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
				),
				' .responsive-block-editor-addons-block-blockquote-item .responsive-block-editor-addons-block-blockquote-quote' => array(
					'height'  => self::get_css_value( $attr['quoteSize'], 'px' ),
					'width'   => self::get_css_value( $attr['quoteSize'], 'px' ),
					'fill'    => $attr['quoteColor'],
					'left'    => self::get_css_value( $attr['quoteHposition'], 'px' ),
					'top'     => self::get_css_value( $attr['quoteVposition'], 'px' ),
					'opacity' => $quoteopacity,
				),
				' .responsive-block-editor-addons-block-blockquote-text' => array(
					'text-align'  => $attr['quoteAlign'],
					'font-family' => $attr['quoteFontFamily'],
					'font-size'   => self::get_css_value( $attr['quoteFontSize'], 'px' ),
					'font-weight' => $attr['quoteFontWeight'],
					'line-height' => $attr['quoteLineHeight'],
				),
				' .responsive-block-editor-addons-block-blockquote-item' => array(
					'padding-left'   => self::get_css_value( $attr['textSpacingLeft'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['textSpacingRight'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['textSpacingTop'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['textSpacingBottom'], 'px' ),
				),

			);
			$mobile_selectors = array(
				' ' => array(
					'padding-left'   => self::get_css_value( $attr['leftPaddingMobile'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['rightPaddingMobile'], 'px' ) . '!important',
					'padding-top'    => self::get_css_value( $attr['topPaddingMobile'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingMobile'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-block-blockquote-item' => array(
					'padding-left'   => self::get_css_value( $attr['textSpacingLeftMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['textSpacingRightMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['textSpacingTopMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['textSpacingBottomMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' ' => array(
					'padding-left'   => self::get_css_value( $attr['leftPaddingTablet'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['rightPaddingTablet'], 'px' ) . '!important',
					'padding-top'    => self::get_css_value( $attr['topPaddingTablet'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingTablet'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-block-blockquote-item' => array(
					'padding-left'   => self::get_css_value( $attr['textSpacingLeftTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['textSpacingRightTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['textSpacingTopTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['textSpacingBottomTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-blockquote.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}


		/**
		 * Get Divider CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_divider_css( $attr, $id ) {
			$defaults = self::get_responsive_block_divider_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors        = array(
				' ' => array(
					'color' => $attr['spacerDividerColor'],
				),
				' .responsive-block-editor-addons-spacer-handle' => array(
					'color' => $attr['spacerDividerColor'],
				),
				' .responsive-block-editor-addons-divider-inner .responsive-block-editor-addons-divider-content' => array(
					'margin-top'    => self::get_css_value( $attr['spacerHeight'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['spacerHeight'], 'px' ),
				),
				' .responsive-block-editor-addons-divider-inner .responsive-block-editor-addons-divider-content .responsive-block-editor-addons-divider_hr' => array(
					'height'           => self::get_css_value( $attr['spacerDividerHeight'], 'px' ),
					'width'            => $attr['spacerDividerWidth'] . '%',
					'background-color' => $attr['spacerDividerColor'],
					'border-radius'    =>
						'basic' === $attr['spacerDividerStyle']
						? 0
						: self::get_css_value( $attr['spacerDividerHeight'] / 2, 'px' ),
					'margin-left'      => 'left' === $attr['spacerDividerAlignment'] ? 0 : 'auto',
					'margin-right'     => 'right' === $attr['spacerDividerAlignment'] ? 0 : 'auto',
				),
				' .responsive-block-editor-addons-divider-inner .responsive-block-editor-addons-divider-content .rgbl-divider__dots' => array(
					'width'        => $attr['spacerDividerWidth'] . '%',
					'margin-left'  => 'left' === $attr['spacerDividerAlignment'] ? 0 : 'auto',
					'margin-right' => 'right' === $attr['spacerDividerAlignment'] ? 0 : 'auto',
				),
				' .responsive-block-editor-addons-divider-inner .responsive-block-editor-addons-divider-content .rgbl-divider__dots .rgbl-divider__dot' => array(
					'height'           => self::get_css_value( $attr['spacerDividerHeight'], 'px' ),
					'background-color' => $attr['spacerDividerColor'],
					'font-size'        => self::get_css_value( $attr['spacerDividerHeight'] * 1.8, 'px' ),
					'width'            => self::get_css_value( $attr['spacerDividerHeight'], 'px' ),
				),
			);
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-divider.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for post grid block
		 *
		 * @return array
		 */
		public static function get_responsive_block_post_grid_block_default_attributes() {
			return array(
				'textAlignment'               => 'left',
				'postsToShow'                 => 6,
				'stackonMobile'               => true,
				'displayPostDate'             => true,
				'excludeCurrentPost'          => true,
				'displayPostExcerpt'          => true,
				'displayPostAuthor'           => true,
				'displayPostImage'            => true,
				'displayPostLink'             => true,
				'displayPostTitle'            => true,
				'displaySectionTitle'         => false,
				'postPagination'              => false,
				'equalHeight'                 => true,
				'postTitleTag'                => 'h3',
				'postLayout'                  => 'grid',
				'columns'                     => 2,
				'align'                       => 'center',
				'width'                       => 'wide',
				'orderBy'                     => 'date',
				'order'                       => 'desc',
				'readMoreText'                => 'Read More »',
				'offset'                      => 0,
				'excerptLength'               => 55,
				'postType'                    => 'post',
				'postTaxonomy'                => 'category',
				'taxonomyType'                => 'category',
				'paginationAlignment'         => 'left',
				'paginationLayout'            => '',
				'sectionTag'                  => 'section',
				'sectionTitle'                => '',
				'sectionTitleTag'             => 'h2',
				'imageSize'                   => 'full',
				'id'                          => '',
				'bgColor'                     => '#e4e4e4',
				'paginationBorderColor'       => '#e4e4e4',
				'paginationTextActiveColor'   => '',
				'paginationTextColor'         => '',
				'paginationActiveBorderColor' => '',
				'paginationBorderWidth'       => '',
				'paginationBorderRadius'      => '',
				'paginationSpacing'           => '',
				'imageBorderRadius'           => '',
				'textColor'                   => '#444444',
				'previousButtonText'          => 'Previous',
				'nextButtonText'              => 'Next',
				'imagePosition'               => 'top',
				'layout'                      => 'boxed',
				'metaColor'                   => '#444444',
				'readMoreLinkColor'           => '#0066cc',
				'readMoreHoverColor'          => '#0558ab',
				'titleColor'                  => '#444444',
				'titleHoverColor'             => '#444444',
				'contentPadding'              => 30,
				'mobileContentPadding'        => 10,
				'continueFontSize'            => '',
				'continueLineHeight'          => '',
				'continueFontWeight'          => '',
				'continueTextTransform'       => '',
				'titleFontSize'               => '',
				'titleFontSizeMobile'         => '',
				'titleFontSizeTablet'         => '',
				'titleLineHeight'             => '',
				'titleFontWeight'             => '',
				'titleTextTransform'          => '',
				'metaFontSize'                => '',
				'metaLineHeight'              => '',
				'metaFontWeight'              => '',
				'metaTextTransform'           => '',
				'titleFontFamily'             => '',
				'metaFontFamily'              => '',
				'excerptFontFamily'           => '',
				'excerptFontSize'             => '',
				'excerptLineHeight'           => '',
				'excerptFontWeight'           => '',
				'excerptTextTransform'        => '',
				'excerptBottomSpacing'        => '',
				'metaBottomSpacing'           => '',
				'titleBottomSpacing'          => '',
				'columnGap'                   => 20,
				'rowGap'                      => 0,
				'rowGapMobile'                => 0,
				'rowGapTablet'                => 0,
				'blockBorderWidth'            => '0',
				'blockBorderRadius'           => '0',
				'blockBorderStyle'            => 'none',
				'blockBorderColor'            => '#333',
				'pageLimit'                   => '10',
				'taxonomyType'                => 'category',
				'postGridBlockId'             => '',
				'boxShadowColor'              => '',
				'boxShadowHOffset'            => '0',
				'boxShadowVOffset'            => '0',
				'boxShadowBlur'               => '0',
				'boxShadowSpread'             => '0',
				'boxShadowPosition'           => 'outset',
				'hoverboxShadowColor'         => '#cccccc',
				'hoverboxShadowHOffset'       => 0,
				'hoverboxShadowVOffset'       => 0,
				'hoverboxShadowBlur'          => 6,
				'hoverboxShadowSpread'        => 1,
				'hoverboxShadowPosition'      => 'outset',
				'columnGapTablet'             => 20,
				'columnGapMobile'             => 20,
			);
		}

		/**
		 * Get Defaults for post carousel block
		 *
		 * @return array
		 */
		public static function get_responsive_block_post_carousel_default_attributes() {
			return array(
				'blockAlign'           => 'left',
				'columns'              => 2,
				'tcolumns'             => 1,
				'mcolumns'             => 1,
				'block_id'             => 1,
				'autoplaySpeed'        => 2000,
				'autoplay'             => true,
				'infiniteLoop'         => true,
				'pauseOnHover'         => true,
				'transitionSpeed'      => 500,
				'arrowSize'            => 20,
				'arrowDots'            => 'arrows_dots',
				'arrowBorderSize'      => 1,
				'arrowBorderRadius'    => 0,
				'postsToShow'          => 6,
				'displayPostDate'      => true,
				'displayPostExcerpt'   => true,
				'displayPostAuthor'    => true,
				'displayPostImage'     => true,
				'displayPostLink'      => true,
				'displayPostTitle'     => true,
				'displayPostComment'   => true,
				'displayPostTaxonomy'  => true,
				'buttonTarget'         => false,
				'equalHeight'          => true,
				'categories'           => '',
				'className'            => '',
				'postTitleTag'         => 'h3',
				'align'                => 'center',
				'order'                => 'desc',
				'orderBy'              => 'date',
				'readMoreText'         => 'Continue Reading',
				'offset'               => 0,
				'excerptLength'        => 20,
				'postType'             => 'post',
				'sectionTag'           => 'section',
				'sectionTitle'         => '',
				'sectionTitleTag'      => 'h2',
				'imageSize'            => 'full',
				'ctaHoverColor'        => '#ffffff',
				'bgColor'              => '#ffffff',
				'ctaColor'             => '#ffffff',
				'ctaBackColor'         => '#333333',
				'titleColor'           => '#333333',
				'contentColor'         => '#333333',
				'metaColor'            => '#333333',
				'arrowDotsColor'       => '#333333',
				'ctaHoverBackColor'    => '#444444',
				'ctaBorderColor'       => '',
				'ctaHoverBorderColor'  => '',
				'ctaBorderStyle'       => 'none',
				'ctaBorderRadius'      => 0,
				'ctaBorderWidth'       => 2,
				'ctaHpadding'          => 20,
				'ctaVpadding'          => 15,
				'contentPadding'       => 20,
				'contentPaddingMobile' => 20,
				'rowGap'               => 20,
				'columnGap'            => 20,
				'imageSpace'           => null,
				'titleSpace'           => null,
				'dateSpace'            => 20,
				'excerptSpace'         => 20,
				'ctaSpace'             => 20,
				'titleFontSize'        => 20,
				'titleFontSizeMobile'  => 20,
				'titleFontSizeTablet'  => 20,
				'titleFontWeight'      => 100,
				'titleLineHeight'      => 1,
				'metaFontSize'         => 16,
				'metaFontWeight'       => 100,
				'metaLineHeight'       => 1,
				'excerptFontSize'      => 16,
				'excerptFontWeight'    => 100,
				'excerptLineHeight'    => 1,
				'ctaFontSize'          => 16,
				'ctaFontWeight'        => 100,
				'ctaLineHeight'        => 1,
				'opacity'              => 50,
				'imagePosition'        => 'background',
				'titleFontFamily'      => '',
				'metaFontFamily'       => '',
				'excerptFontFamily'    => '',
				'ctaFontFamily'        => '',
			);
		}


		/**
		 * Get Accordian Block CSS
		 * *
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_accordian_css( $attr, $id ) {
			$defaults = self::get_responsive_block_accordian_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$icon_color        = $attr['iconColor'];
			$icon_active_color = $attr['iconActiveColor'];
			if ( ! $attr['iconColor'] ) {
				$icon_color = $attr['titleTextColor'];
			}
			if ( ! $attr['iconActiveColor'] ) {
				$icon_active_color = $attr['titleTextActiveColor'];
			}

			$content_opacity                   = $attr['titleBackgroundColorOpacity'] / 100;
			$content_background_colors_opacity = $attr['contentBackgroundColorOpacity'] / 100;

			$temptitle_secondary_background_color = $attr['titleBgGradient'] ? $attr['titleSecondaryBackgroundColor'] : $attr['titleBackgroundColor'];
			$title_gradient                       = '';
			if ( $attr['titleBgGradient'] ) {
				$title_gradient = 'linear-gradient(' .
					$attr['titleGradientDegree'] .
					'deg,' .
					self::hex_to_rgb( $attr['titleBackgroundColor'] ? $attr['titleBackgroundColor'] : '#ffffff', $content_opacity ) .
					',' .
					self::hex_to_rgb( $temptitle_secondary_background_color ? $temptitle_secondary_background_color : '#ffffff', $content_opacity ) .
					')';
			}

			$temp_active_secondary_background_color = $attr['contentBgGradient'] ? $attr['contentSecondaryBackgroundColor'] : $attr['contentBackgroundColor'];
			$content_gradient                       = 'linear-gradient(' .
				$attr['contentGradientDegree'] .
				'deg,' .
				self::hex_to_rgb( $attr['contentBackgroundColor'] ? $attr['contentBackgroundColor'] : '#ffffff', $content_background_colors_opacity ) .
				',' .
				self::hex_to_rgb( $temp_active_secondary_background_color ? $temp_active_secondary_background_color : '#ffffff', $content_background_colors_opacity ) .
				')';

			$selectors = array(
				' ' => array(
					'margin-top'    => self::get_css_value( ( $attr['marginV'] ), 'px' ),
					'margin-bottom' => self::get_css_value( ( $attr['marginV'] ), 'px' ),
					'margin-left'   => self::get_css_value( ( $attr['marginH'] ), 'px' ),
					'margin-right'  => self::get_css_value( ( $attr['marginH'] ), 'px' ),
				),
				' .responsive-block-editor-addons-icon svg' => array(
					'width'        => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'height'       => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'font-size'    => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'fill'         => $icon_color,
					'margin-right' => '10px',
				),
				' .responsive-block-editor-addons-icon-active svg' => array(
					'width'        => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'height'       => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'font-size'    => self::get_css_value( ( $attr['iconSize'] ), $attr['iconSizeType'] ),
					'fill'         => $icon_active_color,
					'margin-right' => '10px',
				),
				' .responsive-block-editor-addons-accordion-item__outer-wrap' => array(
					'margin-bottom' => self::get_css_value( ( $attr['rowsGap'] ), 'px' ),
				),
				' .responsive-block-editor-addons-accordion__wrap.responsive-block-editor-addons-buttons-layout-wrap' => array(
					'grid-column-gap' => self::get_css_value( ( $attr['columnsGap'] ), 'px' ),
					'grid-row-gap'    => self::get_css_value( ( $attr['rowsGap'] ), 'px' ),
				),
				' .responsive-block-editor-addons-accordion-titles-button' => array(
					'padding-top'    => self::get_css_value( ( $attr['vtitlePaddingDesktop'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-bottom' => self::get_css_value( ( $attr['titleBottomPaddingDesktop'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-right'  => self::get_css_value( ( $attr['htitlePaddingDesktop'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-left'   => self::get_css_value( ( $attr['titleLeftPaddingDesktop'] ), $attr['titlePaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-accordion-content span' => array(
					'margin-top'    => self::get_css_value( ( $attr['vcontentPaddingDesktop'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-bottom' => self::get_css_value( ( $attr['vcontentPaddingDesktop'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-right'  => self::get_css_value( ( $attr['hcontentPaddingDesktop'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-left'   => self::get_css_value( ( $attr['hcontentPaddingDesktop'] ), $attr['contentPaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles' => array(
					'flex-direction' => $attr['iconAlign'],
				),
				' .responsive-block-editor-addons-accordion-titles-button' => array(
					'background-image' => $title_gradient,
				),
				' .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-title' => array(
					'font-family' => $attr['titleFontFamily'],
					'font-size'   => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-weight' => $attr['titleFontWeight'],
					'line-height' => $attr['titleLineHeight'],
				),
				' .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-content' => array(
					'background-image' => $content_gradient,
					'font-family'      => $attr['contentFontFamily'],
					'font-size'        => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'font-weight'      => $attr['contentFontWeight'],
					'line-height'      => $attr['contentLineHeight'],
					'color'            => $attr['contentTextColor'],
				),
				' .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles' => array(
					'color'            => $attr['titleTextColor'],
					'background-color' => self::hex_to_rgb( $attr['titleBackgroundColor'] ? $attr['titleBackgroundColor'] : '#fff', $content_opacity ),
				),
				' .responsive-block-editor-addons-accordion-item-active .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles' => array(
					'color'            => $attr['titleActiveTextColor'],
					'background-color' => $attr['titleActiveBackgroundColor'],
				),

			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-accordion-titles-button' => array(
					'padding-top'    => self::get_css_value( ( $attr['vtitlePaddingMobile'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-bottom' => self::get_css_value( ( $attr['titleBottomPaddingMobile'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-right'  => self::get_css_value( ( $attr['htitlePaddingMobile'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-left'   => self::get_css_value( ( $attr['titleLeftPaddingMobile'] ), $attr['titlePaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-accordion-content span' => array(
					'margin-top'    => self::get_css_value( ( $attr['vcontentPaddingMobile'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-bottom' => self::get_css_value( ( $attr['vcontentPaddingMobile'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-right'  => self::get_css_value( ( $attr['hcontentPaddingMobile'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-left'   => self::get_css_value( ( $attr['hcontentPaddingMobile'] ), $attr['contentPaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-icon svg' => array(
					'width'     => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
					'height'    => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
					'font-size' => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-active svg' => array(
					'width'     => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
					'height'    => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
					'font-size' => self::get_css_value( ( $attr['iconSizeMobile'] ), $attr['iconSizeType'] ),
				),

			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-accordion-titles-button' => array(
					'padding-top'    => self::get_css_value( ( $attr['vtitlePaddingTablet'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-bottom' => self::get_css_value( ( $attr['titleBottomPaddingTablet'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-right'  => self::get_css_value( ( $attr['htitlePaddingTablet'] ), $attr['titlePaddingTypeDesktop'] ),
					'padding-left'   => self::get_css_value( ( $attr['titleLeftPaddingTablet'] ), $attr['titlePaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-accordion-content span' => array(
					'margin-top'    => self::get_css_value( ( $attr['vcontentPaddingTablet'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-bottom' => self::get_css_value( ( $attr['vcontentPaddingTablet'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-right'  => self::get_css_value( ( $attr['hcontentPaddingTablet'] ), $attr['contentPaddingTypeDesktop'] ),
					'margin-left'   => self::get_css_value( ( $attr['hcontentPaddingTablet'] ), $attr['contentPaddingTypeDesktop'] ),
				),
				' .responsive-block-editor-addons-icon svg' => array(
					'width'     => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
					'height'    => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
					'font-size' => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-active svg' => array(
					'width'     => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
					'height'    => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
					'font-size' => self::get_css_value( ( $attr['iconSizeTablet'] ), $attr['iconSizeType'] ),
				),
			);

			if ( 'accordion' === $attr['layout'] && true === $attr['inactiveOtherItems'] ) {
				$selectors = array_merge(
					$selectors,
					array(
						' .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-content' => array(
							'display' => 'none',
						),
					)
				);
			}
			if ( 'accordion' === $attr['layout'] && false === $attr['inactiveOtherItems'] ) {
				$selectors = array_merge(
					$selectors,
					array(
						' .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-icon-active' => array(
							'display' => 'inline-block',
						),
						' .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-icon' => array(
							'display' => 'none',
						),
					)
				);
			}
			if ( 'accordion' === $attr['layout'] && true === $attr['expandFirstItem'] ) {
				$selectors = array_merge(
					$selectors,
					array(
						'  > div:first-child > .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-content' => array(
							'display' => 'block',
						),
						'  > div:first-child > .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-icon-active' => array(
							'display' => 'inline-block',
						),
						'  > div:first-child > .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-icon' => array(
							'display' => 'none',
						),
					)
				);
			}
			if ( 'grid' === $attr['layout'] ) {
				$selectors = array_merge(
					$selectors,
					array(
						'  .responsive-block-editor-addons-accordion-item__outer-wrap' => array(
							'text-align' => $attr['align'],
						),
						'   .responsive-block-editor-addons-accordion__wrap.responsive-block-editor-addons-buttons-layout-wrap' => array(
							'grid-template-columns' => 'repeat(' . $attr['columns'] . ', 1fr)',
							'display'               => 'grid',
						),
						'  > div:first-child > .responsive-block-editor-addons-accordion-item__outer-wrap .responsive-block-editor-addons-accordion-item .responsive-block-editor-addons-accordion-titles-button .responsive-block-editor-addons-icon' => array(
							'display' => 'none',
						),
					)
				);
			}

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-accordion__outer-wrap.responsive-block-editor-addons-block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for Accordian block
		 *
		 * @return array
		 */
		public static function get_responsive_block_accordian_block_default_attributes() {
			return array(
				'block_id'                        => '',
				'layout'                          => 'accordion',
				'inactiveOtherItems'              => true,
				'expandFirstItem'                 => false,
				'enableSchemaSupport'             => false,
				'align'                           => 'left',
				'rowsGap'                         => 10,
				'columnsGap'                      => 10,
				'boxPaddingTypeMobile'            => 'px',
				'boxPaddingTypeTablet'            => 'px',
				'boxPaddingTypeDesktop'           => 'px',
				'vBoxPaddingMobile'               => 10,
				'hBoxPaddingMobile'               => 10,
				'vBoxPaddingTablet'               => 10,
				'hBoxPaddingTablet'               => 10,
				'vBoxPaddingDesktop'              => 10,
				'hBoxPaddingDesktop'              => 10,
				'titleTextColor'                  => '#313131',
				'titleTextActiveColor'            => '#656565',
				'titlePaddingTypeDesktop'         => 'px',
				'vtitlePaddingMobile'             => 10,
				'vtitlePaddingTablet'             => 10,
				'vtitlePaddingDesktop'            => 10,
				'htitlePaddingMobile'             => 10,
				'htitlePaddingTablet'             => 10,
				'htitlePaddingDesktop'            => 10,
				'contentTextColor'                => '#313131',
				'contentPaddingTypeDesktop'       => 'px',
				'vcontentPaddingMobile'           => 10,
				'vcontentPaddingTablet'           => 10,
				'vcontentPaddingDesktop'          => 10,
				'hcontentPaddingMobile'           => 10,
				'hcontentPaddingTablet'           => 10,
				'hcontentPaddingDesktop'          => 10,
				'titleActiveTextColor'            => '',
				'titleActiveBackgroundColor'      => '',
				'iconColor'                       => '',
				'iconActiveColor'                 => '',
				'titleFontWeight'                 => '',
				'titleFontSize'                   => '',
				'titleLineHeight'                 => '',
				'titleFontFamily'                 => '',
				'contentFontFamily'               => '',
				'contentFontWeight'               => '',
				'contentFontSize'                 => '',
				'contentLineHeight'               => '',
				'icon'                            => 'fas fa-plus',
				'iconActive'                      => 'fas fa-minus',
				'iconAlign'                       => 'row',
				'iconSize'                        => 12,
				'iconSizeTablet'                  => 12,
				'iconSizeMobile'                  => 12,
				'iconSizeType'                    => 'px',
				'columns'                         => 2,
				'schema'                          => '',
				'enableToggle'                    => true,
				'equalHeight'                     => true,
				'titleLeftPaddingTablet'          => 10,
				'titleBottomPaddingTablet'        => 10,
				'titleLeftPaddingDesktop'         => 10,
				'titleBottomPaddingDesktop'       => 10,
				'titleLeftPaddingMobile'          => 10,
				'titleBottomPaddingMobile'        => 10,
				'headingTag'                      => 'span',
				'titleBackgroundColorOpacity'     => 100,
				'marginV'                         => '',
				'marginH'                         => '',
				'titleSecondaryBackgroundColor'   => '',
				'titleGradientDegree'             => 100,
				'titleBgGradient'                 => false,
				'titleBackgroundColor'            => '#ffffff',
				'contentSecondaryBackgroundColor' => '',
				'contentGradientDegree'           => 100,
				'contentBgGradient'               => false,
				'contentBackgroundColor'          => '#eeeeee',
				'contentBackgroundColorOpacity'   => 100,
				'borderStyle'                     => 'solid',
				'borderColor'                     => '',
				'borderRadius'                    => 2,
				'borderWidth'                     => 1,
			);
		}

		/**
		 * Get Accordian Child Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_accordian_child_css( $attr, $id ) {
			$defaults         = self::get_responsive_block_accordian_child_block_default_attributes();
			$attr             = array_merge( $defaults, (array) $attr );
			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}
			$selectors = array(
				' ' => array(
					'border-color'  => $attr['borderColor'],
					'border-style'  => $attr['borderStyle'],
					'border-width'  => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius' => self::get_css_value( $attr['borderRadius'], 'px' ),
					'box-shadow'    =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
					'overflow'      => 'hidden',

				),
				' .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles' => array(
					'box-shadow' => 'inset' === $box_shadow_position_css ?
						$box_shadow_position_css .
						' ' .
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] : '',
					'padding'    => self::get_css_value( $attr['titlePadding'], 'px' ),
				),
				' .responsive-block-editor-addons-accordion-content span' => array(
					'margin'  => '0',
					'padding' => self::get_css_value( $attr['contentPadding'], 'px' ),
				),
			);
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-accordion-item__outer-wrap.responsive-block-editor-addons-block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for Accordian Child block
		 *
		 * @return array
		 */
		public static function get_responsive_block_accordian_child_block_default_attributes() {
			return array(
				'block_id'          => '',
				'title'             => 'What is Accordion?',
				'content'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'icon'              => 'fas fa-plus',
				'iconActive'        => 'fas fa-minus',
				'layout'            => 'accordion',
				'headingTag'        => 'span',
				'borderStyle'       => 'solid',
				'borderColor'       => 'black',
				'borderWidth'       => 1,
				'borderRadius'      => 2,
				'boxShadowColor'    => '#fff',
				'boxShadowHOffset'  => 9,
				'boxShadowVOffset'  => 9,
				'boxShadowBlur'     => 9,
				'boxShadowSpread'   => 9,
				'boxShadowPosition' => 'outset',
				'titlePadding'      => 10,
				'contentPadding'    => 10,
			);
		}

		/**
		 * Get Defaults for advanced heading block
		 *
		 * @return array
		 */
		public static function get_responsive_block_advanced_heading_default_attributes() {
			return array(
				'block_id'                      => '',
				'headingTitle'                  => '',
				'headingDesc'                   => '',
				'seperatorStyle'                => 'solid',
				'separatorWidthType'            => '%',
				'separatorColor'                => '',
				'headingTitleColor'             => '',
				'subHeadingTitleColor'          => '',
				'headingTitleFontFamily'        => '',
				'subHeadingTitleFontFamily'     => '',
				'headingTitleFontSize'          => '',
				'subHeadingTitleFontSize'       => '',
				'headingTitleFontSizeTablet'    => '',
				'subHeadingTitleFontSizeTablet' => '',
				'headingTitleFontSizeMobile'    => '',
				'subHeadingTitleFontSizeMobile' => '',
				'headingTitleFontWeight'        => '600',
				'subHeadingTitleFontWeight'     => '400',
				'headingTag'                    => 'h2',
				'headingAlignment'              => 'center',
				'headingAlignmentTablet'        => 'center',
				'headingAlignmentMobile'        => 'center',
				'showHeading'                   => true,
				'showSubHeading'                => true,
				'showSeparator'                 => true,
				'separatorHeight'               => 3,
				'separatorWidth'                => 20,
				'headSpacing'                   => 15,
				'subheadSpacing'                => 15,
				'separatorSpacing'              => 15,
				'headSpacingTablet'             => 15,
				'subheadSpacingTablet'          => 15,
				'separatorSpacingTablet'        => 15,
				'headSpacingMobile'             => 15,
				'subheadSpacingMobile'          => 15,
				'separatorSpacingMobile'        => 15,
				'headingTitleLineHeight'        => 1,
				'subHeadingTitleLineHeight'     => 1,
				'headingTitleLetterSpacing'     => 0,
				'subHeadingTitleLetterSpacing'  => 0,
				'level'                         => 2,
				'textDecoration'                => 'none',
				'textDecorationSubHeading'      => 'none',
			);
		}

		/**
		 * Get Advanced column child Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_advanced_column_child_css( $attr, $id ) {
			$defaults = self::get_responsive_block_advanced_column_child_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity              = $attr['opacity'] / 100 === 0 ? '0.0' : $attr['opacity'] / 100; //phpcs:ignore
			$column_width            = $attr['width'] . '%';
			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}
			$hoverbox_shadow_position_css = $attr['hoverboxShadowPosition'];

			if ( 'outset' === $attr['hoverboxShadowPosition'] ) {
				$hoverbox_shadow_position_css = '';
			}

			$background_type_image_styles = array();
			if ( 'image' === $attr['backgroundType'] && $attr['backgroundImage'] ) {

				if ( 'gradient' === $attr['overlayType'] && 'linear' === $attr['gradientOverlayType'] ) {
					$background_type_image_styles = array(
						'background-image' => self::generate_background_image_effect(
							self::hex_to_rgb( $attr['gradientOverlayColor1'], $imgopacity ),
							self::hex_to_rgb( $attr['gradientOverlayColor2'], $imgopacity ),
							$attr['gradientOverlayAngle'],
							$attr['gradientOverlayLocation1'],
							$attr['gradientOverlayLocation2']
						) . ',url(' . $attr['backgroundImage'] . ')',
					);
				} elseif ( 'gradient' === $attr['overlayType'] && 'radial' === $attr['gradientOverlayType'] ) {
					$background_type_image_styles = array(
						'background-image' => 'radial-gradient( at ' . $attr['gradientOverlayPosition'] . ','
							. self::hex_to_rgb( $attr['gradientOverlayColor1'], $imgopacity ) .
							' ' . $attr['gradientOverlayLocation1'] . '%,' . self::hex_to_rgb( $attr['gradientOverlayColor2'] ? $attr['gradientOverlayColor2'] : '#fff', $imgopacity ) .
							' ' . $attr['gradientOverlayLocation2'] . '%),url(' . $attr['backgroundImage'] . ')',
					);
				} else {
					$background_type_image_styles = array(
						'background-image' => 'linear-gradient(' . self::hex_to_rgb( $attr['backgroundImageColor'] ? $attr['backgroundImageColor'] : '#fff', $imgopacity ) . ',' . self::hex_to_rgb( $attr['backgroundImageColor'] ? $attr['backgroundImageColor'] : '#fff', $imgopacity ) . '),url(' . $attr['backgroundImage'] . ')',
					);

				}
				$background_type_image_styles = array_merge(
					$background_type_image_styles,
					array(
						'background-position'   => $attr['backgroundPosition'],
						'background-attachment' => $attr['backgroundAttachment'],
						'background-repeat'     => $attr['backgroundRepeat'],
						'background-size'       => $attr['backgroundSize'],
					)
				);
			}
			$selectors = array(
				'' => array(
					'width' => $column_width,
				),
				' .responsive-block-editor-addons-block-column' => array_merge(
					array(
						'padding-left'     => self::get_css_value( $attr['leftPadding'], 'px' ),
						'padding-right'    => self::get_css_value( $attr['rightPadding'], 'px' ),
						'padding-top'      => self::get_css_value( $attr['topPadding'], 'px' ),
						'padding-bottom'   => self::get_css_value( $attr['bottomPadding'], 'px' ),
						'margin-left'      => self::get_css_value( $attr['leftMargin'], 'px' ),
						'margin-right'     => self::get_css_value( $attr['rightMargin'], 'px' ),
						'margin-top'       => self::get_css_value( $attr['topMargin'], 'px' ),
						'margin-bottom'    => self::get_css_value( $attr['bottomMargin'], 'px' ),
						'box-shadow'       => self::get_css_value( $attr['boxShadowHOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowVOffset'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowBlur'], 'px' ) . ' ' . self::get_css_value( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
						'background-color' => 'color' === $attr['backgroundType'] ? self::hex_to_rgb( $attr['backgroundColor'] ? $attr['backgroundColor'] : '#fff', $imgopacity ) : '',
						'background-image' => 'gradient' === $attr['backgroundType'] ? self::generate_background_image_effect(
							self::hex_to_rgb( $attr['backgroundColor1'], $imgopacity ),
							self::hex_to_rgb( $attr['backgroundColor2'], $imgopacity ),
							$attr['gradientDirection'],
							$attr['colorLocation1'],
							$attr['colorLocation2']
						) : '',
						'border-style'     => $attr['blockBorderStyle'],
						'border-color'     => $attr['blockBorderColor'],
						'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ) . ' !important',
						'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),

					),
					$background_type_image_styles
				),
				' .responsive-block-editor-addons-block-column:hover' => array(
					'box-shadow'       => self::get_css_value( $attr['hoverboxShadowHOffset'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowVOffset'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowBlur'], 'px' ) . ' ' . self::get_css_value( $attr['hoverboxShadowSpread'], 'px' ) . ' ' . $attr['hoverboxShadowColor'] . ' ' . $hoverbox_shadow_position_css,
					'background-image' => 'gradient' === $attr['backgroundType'] ? self::generate_background_image_effect(
						self::hex_to_rgb( $attr['hoverbackgroundColor1'], $imgopacity ),
						self::hex_to_rgb( $attr['hoverbackgroundColor2'], $imgopacity ),
						$attr['hovergradientDirection'],
						$attr['hovercolorLocation1'],
						$attr['hovercolorLocation2']
					) : '',
				),

			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-block-column' => array(
					'padding-left'   => self::get_css_value( $attr['leftPaddingMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['topPaddingMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingMobile'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['leftMarginMobile'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['rightMarginMobile'], 'px' ),
					'margin-top'     => self::get_css_value( $attr['topMarginMobile'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginMobile'], 'px' ),

				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-block-column' => array(
					'padding-left'   => self::get_css_value( $attr['leftPaddingTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['topPaddingTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingTablet'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['leftMarginTablet'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['rightMarginTablet'], 'px' ),
					'margin-top'     => self::get_css_value( $attr['topMarginTablet'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginTablet'], 'px' ),

				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-advanced-column-child.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for advanced column child block
		 *
		 * @return array
		 */
		public static function get_responsive_block_advanced_column_child_block_default_attributes() {
			return array(
				'width'                    => 50,
				'topPadding'               => '',
				'bottomPadding'            => '',
				'leftPadding'              => '',
				'rightPadding'             => '',
				'leftMargin'               => '',
				'rightMargin'              => '',
				'topMargin'                => '',
				'bottomMargin'             => '',
				'topPaddingTablet'         => '',
				'bottomPaddingTablet'      => '',
				'leftPaddingTablet'        => '',
				'rightPaddingTablet'       => '',
				'leftMarginTablet'         => '',
				'rightMarginTablet'        => '',
				'topMarginTablet'          => '',
				'bottomMarginTablet'       => '',
				'topPaddingMobile'         => '',
				'bottomPaddingMobile'      => '',
				'leftPaddingMobile'        => '',
				'rightPaddingMobile'       => '',
				'leftMarginMobile'         => '',
				'rightMarginMobile'        => '',
				'topMarginMobile'          => '',
				'bottomMarginMobile'       => '',
				'block_id'                 => '',
				'blockBorderStyle'         => 'none',
				'blockBorderWidth'         => 1,
				'blockBorderRadius'        => '',
				'blockBorderColor'         => '',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'hoverboxShadowColor'      => '#cccccc',
				'hoverboxShadowHOffset'    => 0,
				'hoverboxShadowVOffset'    => 0,
				'hoverboxShadowBlur'       => 6,
				'hoverboxShadowSpread'     => 1,
				'hoverboxShadowPosition'   => 'outset',
				'opacity'                  => 20,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'gradientDirection'        => 90,
				'hovercolorLocation1'      => 0,
				'hovercolorLocation2'      => 100,
				'hovergradientDirection'   => 90,
				'backgroundImage'          => '',
				'backgroundPosition'       => 'center center',
				'backgroundSize'           => 'cover',
				'backgroundRepeat'         => 'no-repeat',
				'backgroundAttachment'     => 'scroll',
				'backgroundImageColor'     => '',
				'overlayType'              => 'color',
				'gradientOverlayColor1'    => '',
				'gradientOverlayColor2'    => '',
				'gradientOverlayType'      => 'linear',
				'gradientOverlayLocation1' => 0,
				'gradientOverlayLocation2' => 100,
				'gradientOverlayAngle'     => 0,
				'gradientOverlayPosition'  => 'center center',
				'backgroundType'           => '',
				'backgroundColor'          => '',
				'backgroundColor1'         => '',
				'backgroundColor2'         => '#fff',
				'hoverbackgroundColor1'    => '',
				'hoverbackgroundColor2'    => '#fff',

			);
		}

		/**
		 * Get Buttons Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_buttons_css( $attr, $id ) {
			$defaults = self::get_responsive_block_buttons_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors        = array();
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-buttons.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for buttons block
		 *
		 * @return array
		 */
		public static function get_responsive_block_buttons_default_attributes() {
			return array();
		}

		/**
		 * Get Buttons Child Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_buttons_child_css( $attr, $id ) {
			$defaults = self::get_responsive_block_buttons_child_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity = $attr['opacity'] / 100;

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$icon_space_right = '';
			if ( 'before' === $attr['iconPosition'] ) {
				$icon_space_right = $attr['iconSpace'];
			}
			$icon_space_left = '';
			if ( 'after' === $attr['iconPosition'] ) {
				$icon_space_left = $attr['iconSpace'];
			}

			$updated_v_margin_tablet = '';
			if ( isset( $attr['vMarginTablet'] ) ) {
				$updated_v_margin_tablet = $attr['vMarginTablet'];
			}

			$updated_v_margin_mobile = '';
			if ( isset( $attr['vMarginMobile'] ) ) {
				$updated_v_margin_mobile = $attr['vMarginMobile'];
			}

			$updated_h__margin_tablet = '';
			if ( isset( $attr['hMarginTablet'] ) ) {
				$updated_h__margin_tablet = $attr['hMarginTablet'];
			}

			$updated_h_margin_mobile = '';
			if ( isset( $attr['hMarginMobile'] ) ) {
				$updated_h_margin_mobile = $attr['hMarginMobile'];
			}

			$updated_v__padding_tablet = '';
			if ( isset( $attr['vPaddingTablet'] ) ) {
				$updated_v__padding_tablet = $attr['vPaddingTablet'];
			}

			$updated_v_padding_mobile = '';
			if ( isset( $attr['vPaddingMobile'] ) ) {
				$updated_v_padding_mobile = $attr['vPaddingMobile'];
			}

			$updated_h_padding_tablet = '';
			if ( isset( $attr['hPaddingTablet'] ) ) {
				$updated_h_padding_tablet = $attr['hPaddingTablet'];
			}

			$updated_h_padding_mobile = '';
			if ( isset( $attr['hPaddingMobile'] ) ) {
				$updated_h_padding_mobile = $attr['hPaddingMobile'];
			}

			$updated_background_color   = '';
			$updated_background_h_color = '';
			$updated_background_image   = '';
			if ( 'color' === $attr['backgroundType'] && ! $attr['inheritFromTheme'] ) {
				$updated_background_color   = $attr['background'];
				$updated_background_h_color = $attr['hbackground'];
			}

			$updated_border_color   = '';
			$updated_border_h_color = '';
			if ( $attr['borderColor'] && ! $attr['inheritFromTheme'] ) {
				$updated_border_color = $attr['borderColor'];
			}
			if ( $attr['borderHColor'] && ! $attr['inheritFromTheme'] ) {
				$updated_border_h_color = $attr['borderHColor'];
			}

			$updated_text_color   = '';
			$updated_text_h_color = '';
			if ( $attr['color'] && ! $attr['inheritFromTheme'] ) {
				$updated_text_color = $attr['color'];
			}
			if ( $attr['hColor'] && ! $attr['inheritFromTheme'] ) {
				$updated_text_h_color = $attr['hColor'];
			}

			if ( 'gradient' === $attr['backgroundType'] ) {
				$updated_background_image = self::generate_background_image_effect(
					$attr['backgroundColor1'],
					$attr['backgroundColor2'],
					$attr['gradientDirection'],
					$attr['colorLocation1'],
					$attr['colorLocation2']
				);
			}

			$selectors        = array(
				' .responsive-block-editor-addons-button__wrapper .responsive-block-editor-addons-button__icon svg' => array(
					'color'  => $attr['icon_color'],
					'width'  => self::get_css_value( $attr['iconsize'], 'px' ),
					'height' => self::get_css_value( $attr['iconsize'], 'px' ),
				),
				' .responsive-block-editor-addons-button__wrapper div:hover .responsive-block-editor-addons-button__icon svg' => array(
					'color' => $attr['icon_hover_color'],
				),
				' .responsive-block-editor-addons-button__wrapper .responsive-block-editor-addons-button__link_child, .edit-post-visual-editor.editor-styles-wrapper .responsive-block-editor-addons-button__wrapper .responsive-block-editor-addons-button__link_child' => array(
					'color' => $updated_text_color,
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper:hover .responsive-block-editor-addons-button__link_child, .edit-post-visual-editor.editor-styles-wrapper .wp-block-cover .responsive-block-editor-addons-buttons-child .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper:hover .responsive-block-editor-addons-button__link_child' => array(
					'color' => $updated_text_h_color,
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper' => array(
					'border-color'     => $updated_border_color,
					'border-radius'    => self::get_css_value( $attr['borderRadius'], 'px' ),
					'border-style'     => $attr['borderStyle'],
					'border-width'     => self::get_css_value( $attr['borderWidth'], 'px' ),
					'box-shadow'       =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
					'padding-left'     => self::get_css_value( $attr['hPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['hPadding'], 'px' ),
					'background-image' => $updated_background_image,
					'padding-top'      => self::get_css_value( $attr['vPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['vPadding'], 'px' ),
					'margin-left'      => self::get_css_value( $attr['hMargin'], 'px' ),
					'margin-right'     => self::get_css_value( $attr['hMargin'], 'px' ),
					'margin-top'       => self::get_css_value( $attr['vMargin'], 'px' ),
					'margin-bottom'    => self::get_css_value( $attr['vMargin'], 'px' ),
					'background-color' => $updated_background_color,
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper a' => array(
					'font-size'   => self::get_css_value( $attr['buttonFontSize'], 'px' ),
					'font-family' => $attr['buttonFontFamily'],
					'font-weight' => $attr['buttonFontWeight'],
					'line-height' => $attr['buttonLineHeight'],
					'opacity'     => $imgopacity,
					'font-size'   => self::get_css_value( $attr['buttonFontSize'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper:hover' => array(
					'border-color'     => $updated_border_h_color,
					'background-color' => $updated_background_h_color,
				),
				' .responsive-block-editor-addons-button__icon' => array(
					'margin-left'  => $icon_space_left . 'px',
					'margin-right' => $icon_space_right . 'px',
				),
			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper a' => array(
					'font-size' => self::get_css_value( $attr['buttonFontSizeMobile'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper' => array(
					'margin-top'     => self::get_css_value( $updated_v_margin_mobile, 'px' ),
					'margin-bottom'  => self::get_css_value( $updated_v_margin_mobile, 'px' ),
					'margin-left'    => self::get_css_value( $updated_h_margin_mobile, 'px' ),
					'margin-right'   => self::get_css_value( $updated_h_margin_mobile, 'px' ),
					'padding-top'    => self::get_css_value( $updated_v_padding_mobile, 'px' ),
					'padding-bottom' => self::get_css_value( $updated_v_padding_mobile, 'px' ),
					'padding-left'   => self::get_css_value( $updated_h_padding_mobile, 'px' ),
					'padding-right'  => self::get_css_value( $updated_h_padding_mobile, 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper a' => array(
					'font-size' => self::get_css_value( $attr['buttonFontSizeTablet'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-buttons-repeater.responsive-block-editor-addons-button__wrapper' => array(
					'margin-top'     => self::get_css_value( $updated_v_margin_tablet, 'px' ),
					'margin-bottom'  => self::get_css_value( $updated_v_margin_tablet, 'px' ),
					'margin-left'    => self::get_css_value( $updated_h__margin_tablet, 'px' ),
					'margin-right'   => self::get_css_value( $updated_h__margin_tablet, 'px' ),
					'padding-top'    => self::get_css_value( $updated_v__padding_tablet, 'px' ),
					'padding-bottom' => self::get_css_value( $updated_v__padding_tablet, 'px' ),
					'padding-left'   => self::get_css_value( $updated_h_padding_tablet, 'px' ),
					'padding-right'  => self::get_css_value( $updated_h_padding_tablet, 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-buttons-child.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for buttons block
		 *
		 * @return array
		 */
		public static function get_responsive_block_buttons_child_default_attributes() {
			return array(
				'buttonAlignment'      => 'center',
				'fontFamily'           => 'Default',
				'fontWeight'           => '',
				'fontSubset'           => '',
				'label'                => '#Click Here',
				'link'                 => '',
				'target'               => '_blank',
				'iconsize'             => 16,
				'counterId'            => 1,
				'vPadding'             => 10,
				'hPadding'             => 14,
				'vPaddingTablet'       => 10,
				'hPaddingTablet'       => 14,
				'vPaddingMobile'       => 10,
				'hPaddingMobile'       => 14,
				'vMargin'              => 10,
				'vMarginTablet'        => 10,
				'vMarginMobile'        => 10,
				'hMargin'              => 14,
				'hMarginTablet'        => 10,
				'hMarginMobile'        => 5,
				'borderWidth'          => 1,
				'borderRadius'         => 2,
				'borderStyle'          => 'solid',
				'borderColor'          => '',
				'borderHColor'         => '',
				'color'                => '',
				'background'           => '',
				'hColor'               => '',
				'sizeType'             => 'px',
				'sizeMobile'           => '',
				'sizeTablet'           => '',
				'lineHeight'           => '',
				'lineHeightType'       => 'em',
				'lineHeightMobile'     => '',
				'lineHeightTablet'     => '',
				'opensInNewTab'        => '',
				'colorLocation1'       => 0,
				'colorLocation2'       => 100,
				'gradientDirection'    => 90,
				'backgroundColor1'     => '',
				'backgroundColor2'     => '',
				'opacity'              => 100,
				'icon'                 => '',
				'iconPosition'         => 'after',
				'buttonFontFamily'     => '',
				'buttonFontSize'       => '',
				'buttonFontSizeTablet' => '',
				'buttonFontSizeMobile' => '',
				'buttonLineHeight'     => '',
				'boxShadowColor'       => '',
				'boxShadowHOffset'     => 0,
				'boxShadowVOffset'     => 0,
				'boxShadowBlur'        => '',
				'boxShadowSpread'      => '',
				'boxShadowPosition'    => 'outset',
				'icon_color'           => '#3a3a3a',
				'icon_hover_color'     => '',
				'hbackground'          => '',
				'iconSpace'            => 8,
				'buttonFontWeight'     => '400',
				'inheritFromTheme'     => false,
				'hoverEffect'          => '',
				'backgroundType'       => 'none',
			);
		}

		/**
		 * Get Call to action Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_call_to_action_css( $attr, $id ) {
			$defaults = self::get_responsive_block_call_to_action_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity              = $attr['opacity'] / 100;
			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$updated_button_background_color   = '';
			$updated_button_background_h_color = '';
			$updated_background_color          = '';
			$updated_background_type           = '';
			$updated_button_background_type    = '';

			if ( 'color' === $attr['buttonbackgroundType'] ) {
				$updated_button_background_color   = $attr['buttonBackgroundColor'];
				$updated_button_background_h_color = $attr['hbuttonBackgroundColor'];
			}

			if ( 'color' === $attr['backgroundType'] ) {
				$updated_background_color = self::hex_to_rgb( $attr['ctaBackgroundColor'], $imgopacity );
			} else {
				$updated_background_color = '#ffffff';
			}

			if ( 'gradient' === $attr['backgroundType'] ) {
				$updated_background_type = self::generate_background_image_effect( $attr['backgroundColor1'], $attr['backgroundColor2'], $attr['gradientDirection'], $attr['colorLocation1'], $attr['colorLocation2'] );
			}

			if ( 'gradient' === $attr['buttonbackgroundType'] ) {
				$updated_button_background_type = self::generate_background_image_effect( $attr['buttonbackgroundColor1'], $attr['buttonbackgroundColor2'], $attr['buttongradientDirection'], $attr['buttoncolorLocation1'], $attr['buttoncolorLocation2'] );

			}

			$cta_icon_margin = '';
			if ( 'before' === $attr['iconPosition'] ) {
				$cta_icon_margin = 'auto ' . self::get_css_value( $attr['iconSpace'], 'px' ) . ' auto 0';
			} elseif ( 'after' === $attr['iconPosition'] ) {
				$cta_icon_margin = 'auto 0 auto ' . self::get_css_value( $attr['iconSpace'], 'px' );
			}

			$selectors = array(
				' .responsive-block-editor-addons-cta-button-wrapper .responsive-block-editor-addons-cta-button' => array(
					'color' => $attr['buttonTextColor'],
				),

				' .responsive-block-editor-addons-cta-button-wrapper:hover .responsive-block-editor-addons-cta-button' => array(
					'color' => $attr['hbuttonTextColor'],
				),

				' .responsive-block-editor-addons-cta-button-wrapper:hover' => array(
					'border-color'     => $attr['buttonborderHColor'],
					'background-color' => $updated_button_background_h_color,
				),

				' .responsive-block-editor-addons-cta-link-text' => array(
					'color'       => $attr['buttonTextColor'],
					'font-family' => $attr['buttonTextFontFamily'],
					'font-size'   => self::get_css_value( $attr['buttonTextFontSize'], 'px' ),
					'font-weight' => $attr['buttonTextFontWeight'],
					'line-height' => $attr['buttonTextLineHeight'],
				),

				' .responsive-block-editor-addons-cta-link-text:hover' => array(
					'color' => $attr['hbuttonTextColor'],
				),

				' .responsive-block-editor-addons-cta-button__icon svg' => array(
					'fill' => $attr['icon_color'],
				),

				' .responsive-block-editor-addons-cta-title' => array(
					'font-size'     => self::get_css_value( $attr['ctaTitleFontSize'], 'px' ),
					'color'         => $attr['ctaTextColor'],
					'line-height'   => $attr['headingLineHeight'],
					'font-family'   => $attr['ctaTitleFontFamily'],
					'font-weight'   => $attr['headingFontWeight'],
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
				),

				'' => array(
					'background-color' => $updated_background_color,
					'background-image' => $updated_background_type,
					'border-radius'    => self::get_css_value( $attr['borderRadius'], 'px' ),
					'box-shadow'       =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
					'padding-top'      => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['rightPadding'], 'px' ),
				),

				' .responsive-block-editor-addons-cta-image' => array(
					'background-image'    => $attr['imgURL'] ? 'url(' . $attr['imgURL'] . ')' : null,
					'height'              => 100 . '%',
					'background-position' => $attr['imagePosition'],
					'background-repeat'   => $attr['imageRepeat'],
					'background-size'     => $attr['thumbsize'],
					'border-radius'       => self::get_css_value( $attr['borderRadius'], 'px' ),
				),

				' .responsive-block-editor-addons-cta-text' => array(
					'color'         => $attr['ctaTextColor'],
					'font-size'     => self::get_css_value( $attr['ctaTextFontSize'], 'px' ),
					'font-family'   => $attr['ctaTextFontFamily'],
					'line-height'   => $attr['contentLineHeight'],
					'font-weight'   => $attr['contentFontWeight'],
					'margin-bottom' => self::get_css_value( $attr['subtitleSpace'], 'px' ),
				),

				' .responsive-block-editor-addons-cta-button-wrapper' => array(
					'color'            => $attr['buttonTextColor'],
					'background-color' => $attr['buttonBackgroundColor'],
					'padding-top'      => self::get_css_value( $attr['buttonvPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['buttonvPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['buttonhPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['buttonhPadding'], 'px' ),
					'border-style'     => $attr['buttonborderStyle'] ? $attr['buttonborderStyle'] : 'solid',
					'border-width'     => $attr['buttonborderWidth'] ? self::get_css_value( $attr['buttonborderWidth'], 'px' ) : '1px',
					'background-image' => $updated_button_background_type,
					'margin-bottom'    => self::get_css_value( $attr['buttonSpace'], 'px' ),
					'border-color'     => $attr['buttonborderColor'],
					'background-color' => $updated_button_background_color,
				),

				' .responsive-block-editor-addons-cta-button__icon' => array(
					'margin' => $cta_icon_margin,
				),
				' .responsive-block-editor-addons-cta-button' => array(
					'font-family' => $attr['buttonTextFontFamily'],
					'font-size'   => self::get_css_value( $attr['buttonTextFontSize'], 'px' ),
					'font-weight' => $attr['buttonTextFontWeight'],
					'line-height' => $attr['buttonTextLineHeight'],
				),

			);
			$mobile_selectors = array(
				' h2.responsive-block-editor-addons-cta-title' => array(
					'font-size' => self::get_css_value( $attr['ctaTitleFontSizeMobile'], 'px' ),
				),
				'' => array(
					$box_shadow_position_css,
					'padding-top'    => self::get_css_value( $attr['topPaddingMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingMobile'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-title' => array(
					'margin-bottom' => self::get_css_value( $attr['titleSpaceMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-text' => array(
					'margin-bottom' => self::get_css_value( $attr['subtitleSpaceMobile'], 'px' ),
					'font-size'     => self::get_css_value( $attr['ctaTextFontSizeMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-button-wrapper' => array(
					'margin-bottom' => self::get_css_value( $attr['buttonSpaceMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-button' => array(
					'font-size' => self::get_css_value( $attr['buttonTextFontSizeMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-link-text' => array(
					'font-size' => self::get_css_value( $attr['buttonTextFontSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' h2.responsive-block-editor-addons-cta-title' => array(
					'font-size' => self::get_css_value( $attr['ctaTitleFontSizeTablet'], 'px' ),
				),
				'' => array(
					$box_shadow_position_css,
					'padding-top'    => self::get_css_value( $attr['topPaddingTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingTablet'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-title' => array(
					'margin-bottom' => self::get_css_value( $attr['titleSpaceTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-text' => array(
					'margin-bottom' => self::get_css_value( $attr['subtitleSpaceTablet'], 'px' ),
					'font-size'     => self::get_css_value( $attr['ctaTextFontSizeTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-button-wrapper' => array(
					'margin-bottom' => self::get_css_value( $attr['buttonSpaceTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-button' => array(
					'font-size' => self::get_css_value( $attr['buttonTextFontSizeTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-cta-link-text' => array(
					'font-size' => self::get_css_value( $attr['buttonTextFontSizeTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-call-to-action.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for Call to action block
		 *
		 * @return array
		 */
		public static function get_responsive_block_call_to_action_default_attributes() {
			return array(
				'block_id'                 => '',
				'buttonText'               => '',
				'buttonUrl'                => '',
				'buttonAlignment'          => 'center',
				'buttonBackgroundColor'    => '#2091e1',
				'buttonTextColor'          => '#fff',
				'buttonSize'               => 'responsive-block-editor-addons-cta-button-size-medium',
				'buttonShape'              => 'responsive-block-editor-addons-cta-button-shape-rounded',
				'buttonTarget'             => false,
				'ctaTitle'                 => '',
				'ctaTitleFontFamily'       => '',
				'ctaTextFontFamily'        => '',
				'ctaTitleFontSize'         => '22',
				'ctaTitleFontSizeMobile'   => '22',
				'ctaTitleFontSizeTablet'   => '22',
				'ctaTextFontSize'          => '16',
				'ctaTextFontSizeMobile'    => '16',
				'ctaTextFontSizeTablet'    => '16',
				'ctaText'                  => '',
				'ctaWidth'                 => '',
				'ctaBackgroundColor'       => '#f2f2f2',
				'ctaTextColor'             => '',
				'imgURL'                   => '',
				'imgID'                    => '',
				'imgAlt'                   => '',
				'dimRatio'                 => 50,
				'opacity'                  => 100,
				'headingLineHeight'        => 1.8,
				'headingFontWeight'        => '400',
				'contentLineHeight'        => 1.75,
				'contentFontWeight'        => '400',
				'buttonvPadding'           => 10,
				'buttonhPadding'           => 14,
				'buttonborderWidth'        => 1,
				'buttonborderStyle'        => 'solid',
				'icon'                     => '',
				'iconPosition'             => 'after',
				'counterId'                => 1,
				'hbuttonBackgroundColor'   => '',
				'hbuttonTextColor'         => '#e6f2ff',
				'buttonborderColor'        => '',
				'buttonborderHColor'       => '',
				'resctaType'               => 'button',
				'ctalinkText'              => '',
				'titleSpace'               => 25,
				'subtitleSpace'            => 28,
				'titleSpaceMobile'         => 25,
				'subtitleSpaceMobile'      => 28,
				'titleSpaceTablet'         => 25,
				'subtitleSpaceTablet'      => 28,
				'iconSpace'                => 8,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'gradientDirection'        => 90,
				'backgroundColor1'         => '',
				'backgroundColor2'         => '',
				'backgroundType'           => 'color',
				'buttoncolorLocation1'     => 0,
				'buttoncolorLocation2'     => 100,
				'buttongradientDirection'  => 90,
				'buttonbackgroundColor1'   => '',
				'buttonbackgroundColor2'   => '',
				'buttonbackgroundType'     => 'color',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => '',
				'boxShadowSpread'          => '',
				'boxShadowPosition'        => 'outset',
				'icon_color'               => '#3a3a3a',
				'topPadding'               => 20,
				'bottomPadding'            => 20,
				'leftPadding'              => 20,
				'rightPadding'             => 20,
				'topPaddingMobile'         => 20,
				'bottomPaddingMobile'      => 20,
				'leftPaddingMobile'        => 20,
				'rightPaddingMobile'       => 20,
				'topPaddingTablet'         => 20,
				'bottomPaddingTablet'      => 20,
				'leftPaddingTablet'        => 20,
				'rightPaddingTablet'       => 20,
				'imagePosition'            => 'center center',
				'imageRepeat'              => 'no-repeat',
				'thumbsize'                => 'cover',
				'buttonSpace'              => 28,
				'buttonSpaceMobile'        => 28,
				'buttonSpaceTablet'        => 28,
				'borderRadius'             => 12,
				'buttonTextFontFamily'     => '',
				'buttonTextFontSize'       => 18,
				'buttonTextFontSizeMobile' => 18,
				'buttonTextFontSizeTablet' => 18,
				'buttonTextLineHeight'     => 1,
				'buttonTextFontWeight'     => '400',
			);
		}

		/**
		 * Get Card Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_card_css( $attr, $id ) {
			$defaults = self::get_responsive_block_card_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity    = $attr['opacity'] / 100;
			$buttonopacity = $attr['butopacity'] / 100;

			$updated_button_color            = '';
			$updated_buttonh_color           = '';
			$updated_background_color        = '';
			$updated_background_type         = '';
			$updated_button_background_color = '';
			$box_shadow_position_css         = $attr['boxShadowPosition'];
			$background_image_url_check      = $attr['backgroundImage'] ? $attr['backgroundImage']['url'] : null;

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			if ( 'color' === $attr['buttonbackgroundType'] ) {
				$updated_button_color  = self::hex_to_rgb( $attr['buttonColor'] ? $attr['buttonColor'] : '#2091e1', $buttonopacity );
				$updated_buttonh_color = self::hex_to_rgb( $attr['buttonhColor'] ? $attr['buttonhColor'] : '#0071a1', $buttonopacity );
			}

			if ( 'color' === $attr['backgroundType'] ) {
				$updated_background_color = self::hex_to_rgb( $attr['itemBackgroundColor'] ? $attr['itemBackgroundColor'] : '#fff', $imgopacity );
			} else {
				$updated_background_color = '#fff';
			}

			if ( 'gradient' === $attr['backgroundType'] ) {
				$updated_background_type = self::generate_background_image_effect( $attr['backgroundColor1'], $attr['backgroundColor2'], $attr['gradientDirection'], $attr['colorLocation1'], $attr['colorLocation2'] );
			}

			if ( 'gradient' === $attr['buttonbackgroundType'] ) {
				$updated_button_background_color = self::generate_background_image_effect( $attr['buttonbackgroundColor1'], $attr['buttonbackgroundColor2'], $attr['buttongradientDirection'], $attr['buttoncolorLocation1'], $attr['buttoncolorLocation2'] );
			}

			$selectors = array(
				' .responsive-block-editor-addons-card-button-inner .res-button' => array(
					'color' => $attr['buttonTextColor'],
				),

				' .responsive-block-editor-addons-card-button-inner:hover .res-button' => array(
					'color' => $attr['buttonhTextColor'],
				),

				' .responsive-block-editor-addons-card-button-inner .responsive-block-editor-addons-button__icon svg' => array(
					'fill' => $attr['icon_color'],
				),

				' .responsive-block-editor-addons-card-button-inner:hover .responsive-block-editor-addons-button__icon svg' => array(
					'fill' => $attr['icon_hcolor'],
				),

				' .wp-block-responsive-block-editor-addons-card-item__button-wrapper .responsive-block-editor-addons-card-button-inner' => array(
					'background-color' => $updated_button_color,
				),

				' .responsive-block-editor-addons-card-button-inner:hover' => array(
					'background-color' => $updated_buttonh_color,
				),

				''                    => array(
					'margin-bottom' => self::get_css_value( $attr['blockbotmargin'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['blockmargin'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['blockleftmargin'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['blockrightmargin'], 'px' ),
					'z-index'       => $attr['blockzindex'],
				),

				' .wp-block-responsive-block-editor-addons-card-item' => array(
					'border-color'     => $attr['borderColor'],
					'border-style'     => $attr['borderStyle'],
					'border-width'     => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius'    => self::get_css_value( $attr['borderRadius'], 'px' ),
					'background-color' => $updated_background_color,
					'background-image' => $updated_background_type,
					'box-shadow'       => self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),

				' .responsive-block-editor-addons-card-background-image' => array(
					'background-image'    => 'url(' . $background_image_url_check . ')',
					'height'              => 100 . '%',
					'background-position' => $attr['bgimagePosition'],
					'background-repeat'   => $attr['bgimageRepeat'],
					'background-size'     => $attr['bgthumbsize'],
				),

				' .responsive-block-editor-addons-card-avatar' => array(
					'height' => self::get_css_value( $attr['imageheight'], 'px' ),
				),

				' .responsive-block-editor-addons-card-avatar-img' => array(
					'background-position' => $attr['imagePosition'],
					'background-repeat'   => $attr['imageRepeat'],
					'background-size'     => $attr['thumbsize'],
				),

				' .responsive-block-editor-addons-card-avatar-img.responsive-block-editor-addons-card-avatar-img-0' => array(
					'background-image' => 'url(' . $attr['backgroundImageOne'] . ')',
					'display'          => $attr['backgroundImageOne'] ? 'block' : 'none',
				),

				' .responsive-block-editor-addons-card-avatar-img.responsive-block-editor-addons-card-avatar-img-1' => array(
					'background-image' => 'url(' . $attr['backgroundImageTwo'] . ')',
					'display'          => $attr['backgroundImageTwo'] ? 'block' : 'none',
				),

				' .responsive-block-editor-addons-card-avatar-img.responsive-block-editor-addons-card-avatar-img-2' => array(
					'background-image' => 'url(' . $attr['backgroundImageThree'] . ')',
					'display'          => $attr['backgroundImageThree'] ? 'block' : 'none',
				),

				' .responsive-block-editor-addons-card-avatar-img.responsive-block-editor-addons-card-avatar-img-3' => array(
					'background-image' => 'url(' . $attr['backgroundImageFour'] . ')',
					'display'          => $attr['backgroundImageFour'] ? 'block' : 'none',
				),

				' .card-content-wrap' => array(
					'text-align'    => $attr['contentAlignment'],
					'margin-bottom' => self::get_css_value( $attr['contentSpace'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['contenttopSpace'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-card-item__title' => array(
					'margin-top'    => 0,
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
					'color'         => $attr['textColor'],
					'line-height'   => $attr['headingLineHeight'],
					'font-family'   => $attr['headingFontFamily'],
					'font-weight'   => $attr['headingFontWeight'],
					'font-size'     => self::get_css_value( $attr['headingFontSize'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-card-item__subtitle' => array(
					'margin-top'    => 0,
					'margin-bottom' => self::get_css_value( $attr['subtitleSpace'], 'px' ),
					'color'         => $attr['textColor'],
					'line-height'   => $attr['subLineHeight'],
					'font-weight'   => $attr['subFontWeight'],
					'font-family'   => $attr['subFontFamily'],
					'font-size'     => self::get_css_value( $attr['subFontSize'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-card-item__content' => array(
					'margin-top'  => 0,
					'color'       => $attr['textColor'],
					'line-height' => $attr['contentLineHeight'],
					'font-weight' => $attr['contentFontWeight'],
					'font-size'   => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'font-family' => $attr['contentFontFamily'],
				),

				' .responsive-block-editor-addons-card-button-inner' => array(
					'padding-top'      => self::get_css_value( $attr['vPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['vPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['hPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['hPadding'], 'px' ),
					'margin-top'       => self::get_css_value( $attr['vMargin'], 'px' ),
					'margin-bottom'    => self::get_css_value( $attr['vMargin'], 'px' ),
					'margin-left'      => self::get_css_value( $attr['hMargin'], 'px' ),
					'margin-right'     => self::get_css_value( $attr['hMargin'], 'px' ),
					'border-style'     => $attr['butborderStyle'],
					'border-radius'    => self::get_css_value( $attr['butborderRadius'], 'px' ),
					'border-width'     => self::get_css_value( $attr['butborderWidth'], 'px' ),
					'background-image' => $updated_button_background_color,
				),

			);

			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-card.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for card block
		 *
		 * @return array
		 */
		public static function get_responsive_block_card_default_attributes() {
			return array(
				'block_id'                => '',
				'cardsArray'              => '',
				'count'                   => '',
				'gutter'                  => 'medium',
				'stack'                   => 'mobile',
				'contentAlign'            => 'center',
				'textColor'               => '',
				'itemBackgroundColor'     => '',
				'buttonColor'             => '',
				'buttonTextColor'         => '#fff',
				'boxShadowColor'          => '',
				'boxShadowHOffset'        => 0,
				'boxShadowVOffset'        => 0,
				'boxShadowBlur'           => 0,
				'boxShadowSpread'         => 0,
				'boxShadowPosition'       => 'outset',
				'titleSpace'              => 8,
				'subtitleSpace'           => 16,
				'contentSpace'            => 16,
				'buttonSpace'             => 20,
				'borderWidth'             => 0,
				'borderRadius'            => 12,
				'opacity'                 => 100,
				'resshowImage'            => true,
				'colorLocation1'          => 0,
				'colorLocation2'          => 100,
				'gradientDirection'       => 90,
				'backgroundImage'         => '',
				'backgroundColor'         => '',
				'backgroundColor1'        => '',
				'backgroundColor2'        => '#fff',
				'backgroundType'          => 'none',
				'imageopacity'            => 20,
				'imageSize'               => 'full',
				'imagePosition'           => 'center center',
				'imageRepeat'             => 'no-repeat',
				'thumbsize'               => 'cover',
				'imageheight'             => 200,
				'blockmargin'             => 2,
				'blockzindex'             => 1,
				'icon'                    => '',
				'iconPosition'            => 'after',
				'icon_color'              => '#3a3a3a',
				'counterId'               => 1,
				'buttonhColor'            => '',
				'buttonhTextColor'        => '#e6f2ff',
				'butopacity'              => 100,
				'vPadding'                => 10,
				'hPadding'                => 14,
				'vMargin'                 => 10,
				'hMargin'                 => 0,
				'butborderWidth'          => 1,
				'butborderRadius'         => 2,
				'butborderStyle'          => 'none',
				'buttonSize'              => 'responsive-block-editor-addons-button-size-medium',
				'buttoncolorLocation1'    => 0,
				'buttoncolorLocation2'    => 100,
				'buttongradientDirection' => 90,
				'buttonbackgroundColor1'  => '',
				'buttonbackgroundColor2'  => '#fff',
				'buttonbackgroundType'    => 'none',
				'icon_hcolor'             => '#3a3a3a',
				'headingFontFamily'       => '',
				'subFontFamily'           => '',
				'contentFontFamily'       => '',
				'subLineHeight'           => 1,
				'subFontWeight'           => 400,
				'subFontSize'             => 16,
				'headingLineHeight'       => 1,
				'headingFontWeight'       => 900,
				'headingFontSize'         => 20,
				'contentLineHeight'       => 2,
				'contentFontSize'         => 16,
				'contentFontWeight'       => 400,
				'blockbotmargin'          => 2,
				'blockleftmargin'         => 0,
				'blockrightmargin'        => 0,
				'contenttopSpace'         => 16,
				'bgimageSize'             => 'full',
				'bgimagePosition'         => 'center center',
				'bgimageRepeat'           => 'no-repeat',
				'bgthumbsize'             => 'cover',
				'borderStyle'             => 'none',
				'buttonTarget'            => 'false',
				'contentAlignment'        => 'left',
				'borderColor'             => '',
				'backgroundImageOne'      => '',
				'backgroundImageTwo'      => '',
				'backgroundImageThree'    => '',
				'backgroundImageFour'     => '',
			);
		}

		/**
		 * Get Content timeline Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_content_timeline_css( $attr, $id ) {
			$defaults = self::get_responsive_block_content_timeline_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$border_with_color = '13px solid' . $attr['backgroundColor'];

			$imgopacity = $attr['opacity'] / 100;

			$selectors = array(
				' .responsive-timeline__left .responsive-timeline__day-left .responsive-timeline__arrow:after' => array(
					'border-right' => $border_with_color,
				),

				' .responsive-timeline__right .responsive-timeline__day-right .responsive-timeline__arrow:after' => array(
					'border-left' => $border_with_color,
				),

				' .responsive-timeline__line'             => array(
					'background-color' => $attr['separatorColor'],
				),

				' .responsive-timeline__line__inner'      => array(
					'background-color' => $attr['separatorFillColor'],
				),

				' .responsive-timeline__main .responsive-block-editor-addons-ifb-icon' => array(
					'color' => $attr['iconColor'],
				),

				' .responsive-timeline__main .responsive-block-editor-addons-ifb-icon svg' => array(
					'fill' => $attr['iconColor'],
				),

				' .responsive-timeline__marker'           => array(
					'background-color' => $attr['separatorBg'],
					'border-color'     => $attr['separatorBorder'],
				),

				' .responsive-timeline__main .responsive-timeline__marker.responsive-timeline__in-view-icon' => array(
					'background'   => $attr['iconBgFocus'],
					'border-color' => $attr['borderFocus'],
					'color'        => $attr['iconFocus'],
				),

				' .responsive-timeline__main .responsive-timeline__marker.responsive-timeline__in-view-icon svg' => array(
					'fill' => $attr['iconFocus'],
				),

				' .responsive-timeline__main .responsive-timeline__marker.responsive-timeline__in-view-icon .responsive-timeline__icon-new' => array(
					'color' => $attr['iconFocus'],
				),

				' .responsive-timeline__left-block .responsive-timeline__line' => array(
					'left' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__rightt-block .responsive-timeline__line' => array(
					'right' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__field.responsive-timeline__field-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['verticalSpace'], 'px' ),
				),

				' .responsive-timeline__marker.out-view-responsive-timeline__icon, .responsive-timeline__marker.in-view-responsive-timeline__icon' => array(
					'margin-left'  => self::get_css_value( $attr['horizontalSpace'], 'px' ),
					'margin-right' => self::get_css_value( $attr['horizontalSpace'], 'px' ),
					'min-width'    => self::get_css_value( $attr['connectorBgsize'], 'px' ),
					'min-height'   => self::get_css_value( $attr['connectorBgsize'], 'px' ),
					'border-width' => self::get_css_value( $attr['borderwidth'], 'px' ),
				),

				' .responsive-block-editor-addons-ifb-icon' => array(
					'width'  => self::get_css_value( $attr['iconSize'], 'px' ),
					'height' => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-timeline__events-inner-new' => array(
					'border-radius'    => self::get_css_value( $attr['itemBorderRadius'], 'px' ),
					'border-width'     => self::get_css_value( $attr['itemBorderWidth'], 'px' ),
					'border-style'     => $attr['itemBorderStyle'],
					'border-color'     => $attr['itemBorderColor'],
					'padding'          => self::get_css_value( $attr['itemPadding'], 'px' ),
					'background-color' => self::hex_to_rgb( $attr['backgroundColor'], $imgopacity ),
				),

				' .responsive-timeline__inner-date-new'   => array(
					'color'       => $attr['dateColor'],
					'line-height' => $attr['dateLineHeight'],
					'font-weight' => $attr['dateFontWeight'],
					'font-size'   => self::get_css_value( $attr['dateFontSize'], 'px' ),
					'font-family' => $attr['dateFontFamily'],
				),

				' .responsive-timeline__heading'          => array(
					'color'         => $attr['headingColor'],
					'line-height'   => $attr['headingLineHeight'],
					'font-weight'   => $attr['headingFontWeight'],
					'font-size'     => self::get_css_value( $attr['headingFontSize'], 'px' ),
					'font-family'   => $attr['headingFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['headingBottomMargin'], 'px' ),
				),

				' .responsive-timeline-desc-content'      => array(
					'color'       => $attr['contentColor'],
					'line-height' => $attr['contentLineHeight'],
					'font-weight' => $attr['contentFontWeight'],
					'font-size'   => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'font-family' => $attr['contentFontFamily'],
				),

				' .responsive-timeline__date-new'         => array(
					'color'       => $attr['dateColor'],
					'line-height' => $attr['dateLineHeight'],
					'font-weight' => $attr['dateFontWeight'],
					'font-size'   => self::get_css_value( $attr['dateFontSize'], 'px' ),
					'font-family' => $attr['dateFontFamily'],
				),

				' .responsive-timeline__line'             => array(
					'background-color' => $attr['separatorColor'],
					'width'            => self::get_css_value( $attr['separatorwidth'], 'px' ),
					'margin-left'      => 'center' !== $attr['timelinAlignment'] ? self::get_css_value( $attr['horizontalSpace'], 'px' ) : '',
					'margin-right'     => 'center' !== $attr['timelinAlignment'] ? self::get_css_value( $attr['horizontalSpace'], 'px' ) : '',
				),

			);

			$mobile_selectors = array(
				' .responsive-timeline__center-block.responsive-timeline__responsive-mobile .responsive-timeline__line' => array(
					'left'  => $attr['connectorBgsize'] / 2 . 'px',
					'right' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__left-block.responsive-timeline__responsive-mobile .responsive-timeline__line' => array(
					'left' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__right-block.responsive-timeline__responsive-mobile .responsive-timeline__line' => array(
					'right' => $attr['connectorBgsize'] / 2 . 'px',
				),
			);

			$tablet_selectors = array(
				' .responsive-timeline__center-block.responsive-timeline__responsive-tablet .responsive-timeline__line' => array(
					'left'  => $attr['connectorBgsize'] / 2 . 'px',
					'right' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__left-block.responsive-timeline__responsive-tablet .responsive-timeline__line' => array(
					'left' => $attr['connectorBgsize'] / 2 . 'px',
				),

				' .responsive-timeline__right-block.responsive-timeline__responsive-tablet .responsive-timeline__line' => array(
					'right' => $attr['connectorBgsize'] / 2 . 'px',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-content-timeline.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for content timeline block
		 *
		 * @return array
		 */
		public static function get_responsive_block_content_timeline_default_attributes() {
			return array(
				'block_id'            => '',
				'timelinAlignment'    => 'center',
				'timelineItems'       => '',
				'dateFormat'          => 'F j, Y',
				'headingTag'          => 'h4',
				't_date'              => '',
				'displayPostDate'     => true,
				'count'               => 5,
				'dateBottomspace'     => 5,
				'itemBorderStyle'     => 'none',
				'itemBorderColor'     => '',
				'itemBorderWidth'     => 1,
				'itemBorderRadius'    => 2,
				'itemPadding'         => 20,
				'horizontalSpace'     => 0,
				'verticalSpace'       => 15,
				'headingBottomMargin' => 15,
				'dateLineHeight'      => 1,
				'contentFontFamily'   => '',
				'headingFontFamily'   => '',
				'dateFontFamily'      => '',
				'dateFontWeight'      => '400',
				'dateFontSize'        => 16,
				'headingLineHeight'   => 1,
				'headingFontWeight'   => '400',
				'headingFontSize'     => 20,
				'dateColor'           => '',
				'headingColor'        => '',
				'contentColor'        => '',
				'backgroundColor'     => '#eee',
				'counterId'           => 1,
				'contentLineHeight'   => 2,
				'contentFontSize'     => 16,
				'contentFontWeight'   => '400',
				'opacity'             => 100,
				'separatorColor'      => '#eee',
				'iconColor'           => '#333',
				'separatorBg'         => '#eee',
				'separatorBorder'     => '#eee',
				'separatorFillColor'  => '#61ce70',
				'iconFocus'           => '#fff',
				'iconBgFocus'         => '#61ce70',
				'borderFocus'         => '#5cb85c',
				'separatorwidth'      => 3,
				'borderwidth'         => 0,
				'connectorBgsize'     => 35,
				'iconSize'            => 20,
				'icon'                => 'fa fa-calendar-alt',
				'stack'               => 'mobile',
				'arrowlinAlignment'   => 'center',
			);
		}

		/**
		 * Get Expand Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_expand_css( $attr, $id ) {
			$defaults = self::get_responsive_block_expand_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors = array(
				' .responsive-block-editor-addons-expand-block-content' => array(
					'text-align' => $attr['expandAlignment'],
				),

				' .responsive-block-editor-addons-expand-title' => array(
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
					'font-family'   => $attr['titleFontFamily'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-weight'   => $attr['titleFontWeight'],
					'line-height'   => $attr['titleLineHeight'],
					'color'         => $attr['titleColor'],
				),

				' .responsive-block-editor-addons-expand-less-text' => array(
					'margin-bottom' => self::get_css_value( $attr['textSpace'], 'px' ),
					'font-family'   => $attr['textFontFamily'],
					'font-size'     => self::get_css_value( $attr['textFontSize'], 'px' ),
					'font-weight'   => $attr['textFontWeight'],
					'line-height'   => $attr['textLineHeight'],
					'color'         => $attr['textColor'],
				),

				' .responsive-block-editor-addons-expand-more-text' => array(
					'display'       => 'none',
					'margin-bottom' => self::get_css_value( $attr['textSpace'], 'px' ),
					'font-family'   => $attr['textFontFamily'],
					'font-size'     => self::get_css_value( $attr['textFontSize'], 'px' ),
					'font-weight'   => $attr['textFontWeight'],
					'line-height'   => $attr['textLineHeight'],
					'color'         => $attr['textColor'],
				),

				' .responsive-block-editor-addons-expand-more-toggle-text' => array(
					'margin-bottom' => self::get_css_value( $attr['linkSpace'], 'px' ),
					'font-family'   => $attr['linkFontFamily'],
					'font-size'     => self::get_css_value( $attr['linkFontSize'], 'px' ),
					'font-weight'   => $attr['linkFontWeight'],
					'line-height'   => $attr['linkLineHeight'],
					'color'         => $attr['linkColor'],
				),

				' .responsive-block-editor-addons-expand-less-toggle-text' => array(
					'display'       => 'none',
					'margin-bottom' => self::get_css_value( $attr['linkSpace'], 'px' ),
					'font-family'   => $attr['linkFontFamily'],
					'font-size'     => self::get_css_value( $attr['linkFontSize'], 'px' ),
					'font-weight'   => $attr['linkFontWeight'],
					'line-height'   => $attr['linkLineHeight'],
					'color'         => $attr['linkColor'],
				),
			);

			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-expand.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for expand block
		 *
		 * @return array
		 */
		public static function get_responsive_block_expand_default_attributes() {
			return array(
				'block_id'        => '',
				'blockTitle'      => 'Title for this block',
				'expandLessText'  => 'Some short text that can be expanded to show more details.',
				'expandMoreText'  => 'Some short text that can be expanded to show more details. Description for this block. Use this space for describing your block. Any text will do. Description for this block. You can use this space for describing your block.',
				'moreLabel'       => 'Show more',
				'lessLabel'       => 'Show less',
				'showTitle'       => true,
				'expandAlignment' => '',
				'textColor'       => '',
				'linkColor'       => '',
				'titleColor'      => '',
				'titleSpace'      => 28,
				'textSpace'       => 20,
				'linkSpace'       => 18,
				'titleFontFamily' => '',
				'textFontFamily'  => '',
				'linkFontFamily'  => '',
				'titleFontSize'   => 20,
				'titleFontWeight' => 400,
				'titleLineHeight' => 1,
				'textFontSize'    => 16,
				'textFontWeight'  => 400,
				'textLineHeight'  => 2,
				'linkFontSize'    => 16,
				'linkFontWeight'  => 400,
				'linkLineHeight'  => 1,
			);
		}

		/**
		 * Get Flipbox Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_flipbox_css( $attr, $id ) {
			$defaults = self::get_responsive_block_flipbox_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$flip_style = 'rotateY(0deg)';
			$flip_style_back;
			$flip_class;

			if ( 'back_selected' === $attr['colorButtonSelected'] ) {
				$flip_class = 'backSelected';
				if ( 'LTR' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateY(180deg)';
					$flip_style_back = 'rotateY(180deg)';
				}
				if ( 'RTL' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateY(-180deg)';
					$flip_style_back = 'rotateY(-180deg)';
				}
				if ( 'BTT' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateX(180deg)';
					$flip_style_back = 'rotateX(180deg)';
				}
				if ( 'TTB' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateX(-180deg)';
					$flip_style_back = 'rotateX(-180deg)';
				}
			} else {
				$flip_class = 'frontSelected';
				if ( 'LTR' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateY(0deg)';
					$flip_style_back = 'rotateY(180deg)';
				}
				if ( 'RTL' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateY(0deg)';
					$flip_style_back = 'rotateY(-180deg)';
				}
				if ( 'BTT' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateX(0deg)';
					$flip_style_back = 'rotateX(180deg)';
				}
				if ( 'TTB' === $attr['flipStyleSelected'] ) {
					$flip_style      = 'rotateX(0deg)';
					$flip_style_back = 'rotateX(-180deg)';
				}
			};

			$transition_speed_sec = $attr['transitionSpeed'] / 10;

			$flipbox_transition =
				$attr['transitionSpeed'] < 10
				? 'transform 0.' . $attr['transitionSpeed'] . 's'
				: 'transform ' . $transition_speed_sec . 's';

			$coloropacity     = $attr['colorOpacity'] / 100;
			$backcoloropacity = $attr['backColorOpacity'] / 100;
			$imageopacity     = $attr['imageOpacity'] / 100;
			$backimageopacity = $attr['backImageOpacity'] / 100;

			$background_front = '';
			$background_back  = '';

			if ( $attr['backgroundImage'] ) {
				$background_front = 'linear-gradient(' .

				self::hex_to_rgb( $attr['frontBackgroundColor'], $coloropacity ) .

				',' .

				self::hex_to_rgb( $attr['frontBackgroundColor'], $coloropacity ) .

				'),url(' .

				$attr['backgroundImage'] .

				')';
			}
			if ( $attr['backBackgroundImage'] ) {
				$background_back = 'linear-gradient(' .

				self::hex_to_rgb( $attr['backBackgroundColor'], $backcoloropacity ) .

				',' .

				self::hex_to_rgb( $attr['backBackgroundColor'], $backcoloropacity ) .

				'),url(' .

				$attr['backBackgroundImage'] .

				')';
			}

			$background_image_gradient = '';
			$btn_color                 = $attr['buttonColor'];
			$btn_opacity               = $attr['buttonopacity'];
			if ( 'gradient' === $attr['buttonbackgroundType'] ) {
				$background_image_gradient = 'linear-gradient(' . $attr['buttongradientDirection'] . 'deg, ' . $attr['buttonbackgroundColor1'] . ' ' . $attr['buttoncolorLocation1'] . '%, ' . $attr['buttonbackgroundColor2'] . ' ' . $attr['buttoncolorLocation2'] . '%)';
			} elseif ( 'color' === $attr['buttonbackgroundType'] ) {
				$btn_color   = $attr['buttonColor'];
				$btn_opacity = $attr['buttonopacity'];
			};

			$background_hover_image_gradient = '';
			$btn_h_color                     = $attr['buttonHColor'];
			$btn_h_opacity                   = $attr['buttonHopacity'];
			if ( 'gradient' === $attr['buttonHbackgroundType'] ) {
				$background_hover_image_gradient = 'linear-gradient(' . $attr['buttonHgradientDirection'] . 'deg, ' . $attr['buttonHbackgroundColor1'] . ' ' . $attr['buttonHcolorLocation1'] . '%, ' . $attr['buttonHbackgroundColor2'] . ' ' . $attr['buttonHcolorLocation2'] . '%)';
			} elseif ( 'color' === $attr['buttonHbackgroundType'] ) {
				$btn_h_color   = $attr['buttonHColor'];
				$btn_h_opacity = $attr['buttonHopacity'];
			}

			$selectors        = array(
				' '               => array(
					'margin-bottom' => self::get_css_value( $attr['bottomMargin'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['topMargin'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box' => array(
					'height' => self::get_css_value( $attr['height'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box .flip-box-inner' => array(
					'transition' => $flipbox_transition,
				),
				' .wp-block-responsive-block-editor-addons-flip-box .flip-box-front' => array(
					'background-image'      => $background_front,
					'background-position'   => $attr['backgroundPosition'],
					'background-attachment' => $attr['backgroundAttachment'],
					'background-repeat'     => $attr['backgroundRepeat'],
					'background-size'       => $attr['backgroundSize'],
					'background-color'      => self::hex_to_rgb( $attr['frontBackgroundColor'], $coloropacity ),
					'color'                 => $attr['frontTextColor'],
					'border-color'          => $attr['borderColor'],
					'border-style'          => $attr['borderStyle'],
					'border-width'          => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius'         => self::get_css_value( $attr['borderRadius'], 'px' ),
					'box-shadow'            =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
					'height'                => self::get_css_value( $attr['height'], 'px' ),
					'padding-top'           => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom'        => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'padding-left'          => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'         => self::get_css_value( $attr['rightPadding'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box__title' => array(
					'color' => $attr['frontTextColor'],
				),
				' .wp-block-responsive-block-editor-addons-flip-box__subtitle' => array(
					'color' => $attr['frontTextColor'],
				),
				' .flip-box-back' => array(
					'background-image'      => $background_back,
					'background-position'   => $attr['backBackgroundPosition'],
					'background-attachment' => $attr['backBackgroundAttachment'],
					'background-repeat'     => $attr['backBackgroundRepeat'],
					'background-size'       => $attr['backBackgroundSize'],
					'background-color'      => self::hex_to_rgb( $attr['backBackgroundColor'], $backcoloropacity ),
					'color'                 => $attr['backTextColor'],
					'transform'             => $flip_style_back,
					'border-color'          => $attr['borderColor'],
					'border-style'          => $attr['borderStyle'],
					'border-width'          => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius'         => self::get_css_value( $attr['borderRadius'], 'px' ),
					'box-shadow'            =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
					'height'                => self::get_css_value( $attr['height'], 'px' ),
					'padding-top'           => self::get_css_value( $attr['backtopPadding'], 'px' ),
					'padding-bottom'        => self::get_css_value( $attr['backbottomPadding'], 'px' ),
					'padding-left'          => self::get_css_value( $attr['backleftPadding'], 'px' ),
					'padding-right'         => self::get_css_value( $attr['backrightPadding'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box__backtitle' => array(
					'color' => $attr['backTextColor'],
				),
				' .wp-block-responsive-block-editor-addons-flip-box__backsubtitle' => array(
					'color' => $attr['backTextColor'],
				),
				' .wp-block-responsive-block-editor-addons-flip-box-dashicon-fronticon-wrap' => array(
					'font-size' => self::get_css_value( $attr['iconSize'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box-dashicon-fronticon-wrap svg' => array(
					'font-size' => self::get_css_value( $attr['iconSize'], 'px' ),
					'fill'      => $attr['iconColor'],
					'height'    => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'     => self::get_css_value( $attr['iconSize'], 'px' ),
				),
				' .dashicons'     => array(
					'width'  => 'auto !important',
					'height' => 'auto !important',
				),
				' .wp-block-responsive-block-editor-addons-flip-box-dashicon-backicon-wrap' => array(
					'font-size' => self::get_css_value( $attr['backIconSize'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flip-box-dashicon-backicon-wrap svg' => array(
					'font-size' => self::get_css_value( $attr['backIconSize'], 'px' ),
					'fill'      => $attr['backIconColor'],
					'height'    => self::get_css_value( $attr['backIconSize'], 'px' ),
					'width'     => self::get_css_value( $attr['backIconSize'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-flipbox-item__button.wp-block-button__link' => array(
					'border-radius'    => self::get_css_value( $attr['buttonBorderRadius'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['buttonHpadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['buttonHpadding'], 'px' ),
					'padding-top'      => self::get_css_value( $attr['buttonVpadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['buttonVpadding'], 'px' ),
					'background-image' => $background_image_gradient,
					'background-color' => $btn_color . '!important',
					'opacity'          => $btn_opacity / 100,
					'color'            => $attr['buttonTextColor'] . '!important',
				),
				' .wp-block-responsive-block-editor-addons-flipbox-item__button.wp-block-button__link:hover' => array(
					'background-image' => $background_hover_image_gradient,
					'background-color' => $btn_h_color . '!important',
					'opacity'          => $btn_h_opacity / 100,
					'color'            => $attr['buttonHTextColor'] . '!important',
				),
				' .has-medium-gutter.has-2-columns > *:not(.block-editor-inner-blocks)' => array(
					'max-width' => 'calc(100% / 2 - ' . $attr['flipBoxGutterGap'] . 'px)',
				),
				' .has-medium-gutter.has-3-columns > *:not(.block-editor-inner-blocks)' => array(
					'max-width' => 'calc(100% / 3 - ' . $attr['flipBoxGutterGap'] . 'px)',
				),
				' .has-medium-gutter.has-4-columns > *:not(.block-editor-inner-blocks)' => array(
					'max-width' => 'calc(100% / 4 - ' . $attr['flipBoxGutterGap'] . 'px)',
				),
			);
			$mobile_selectors = array(
				' .has-medium-gutter.responsive-flipbox-columns__stack-mobile > *:not(.block-editor-inner-blocks)' => array(
					'min-width' => '100%',
					'max-width' => '100%',
				),
			);

			$tablet_selectors = array(
				' .has-medium-gutter.responsive-flipbox-columns__stack-tablet > *:not(.block-editor-inner-blocks)' => array(
					'min-width' => '100%',
					'max-width' => '100%',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-flipbox.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for flipbox block
		 *
		 * @return array
		 */
		public static function get_responsive_block_flipbox_default_attributes() {
			return array(
				'block_id'                 => '',
				'flipboxArray'             => '',
				'count'                    => '',
				'height'                   => 420,
				'iconSize'                 => 50,
				'backIconSize'             => 50,
				'transitionSpeed'          => 8,
				'backgroundImage'          => '',
				'backgroundPosition'       => 'center center',
				'backgroundAttachment'     => 'scroll',
				'backgroundRepeat'         => 'no-repeat',
				'backgroundSize'           => 'cover',
				'backBackgroundImage'      => '',
				'backBackgroundPosition'   => 'center center',
				'backBackgroundAttachment' => 'scroll',
				'backBackgroundRepeat'     => 'no-repeat',
				'backBackgroundSize'       => 'cover',
				'colorOpacity'             => 30,
				'backColorOpacity'         => 30,
				'imageOpacity'             => 30,
				'backImageOpacity'         => 30,
				'buttonbackgroundType'     => 'none',
				'buttoncolorLocation1'     => 0,
				'buttoncolorLocation2'     => 100,
				'buttongradientDirection'  => 90,
				'buttonbackgroundColor1'   => '#333',
				'buttonbackgroundColor2'   => '',
				'buttonHTextColor'         => '#fff',
				'buttonHColor'             => '#333',
				'buttonopacity'            => 100,
				'buttonHopacity'           => 100,
				'buttonHbackgroundType'    => 'none',
				'buttonHcolorLocation1'    => 0,
				'buttonHcolorLocation2'    => 100,
				'buttonHgradientDirection' => 90,
				'buttonHbackgroundColor1'  => '#333',
				'buttonHbackgroundColor2'  => '',
				'buttonBorderRadius'       => 0,
				'buttonHpadding'           => 20,
				'buttonVpadding'           => 10,
				'iconSelected'             => 'editor-textcolor',
				'flipStyleSelected'        => 'LTR',
				'align'                    => 'wide',
				'gutter'                   => 'medium',
				'contentAlign'             => 'center',
				'frontTextColor'           => '',
				'frontBackgroundColor'     => '#fff',
				'backTextColor'            => '',
				'backBackgroundColor'      => '#fff',
				'buttonColor'              => '#333',
				'buttonTextColor'          => '',
				'iconColor'                => '',
				'backIconColor'            => '',
				'borderStyle'              => 'none',
				'borderWidth'              => 2,
				'borderRadius'             => '',
				'borderColor'              => '',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'showFrontIcon'            => true,
				'showFrontTitle'           => true,
				'showFrontSubtitle'        => true,
				'showBackIcon'             => true,
				'showBackTitle'            => true,
				'showBackSubtitle'         => true,
				'showBackButton'           => true,
				'colorButtonSelected'      => '',
				'topMargin'                => 0,
				'bottomMargin'             => 0,
				'topPadding'               => 0,
				'bottomPadding'            => 0,
				'leftPadding'              => 0,
				'rightPadding'             => 0,
				'backtopPadding'           => 0,
				'backbottomPadding'        => 0,
				'backleftPadding'          => 0,
				'backrightPadding'         => 0,
				'flipBoxGutterGap'         => 10,
				'stack'                    => 'mobile',
			);
		}

		/**
		 * Get Gallery Masonry Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_gallery_masonry_css( $attr, $id ) {
			return array();
		}

		/**
		 * Get Defaults for gallery masonry block
		 *
		 * @return array
		 */
		public static function get_responsive_block_gallery_masonry_block_default_attributes() {
			return array();
		}

		/**
		 * Get Googlemap Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_googlemap_css( $attr, $id ) {
			$defaults = self::get_responsive_block_googlemap_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors        = array(
				' iframe' => array(
					'width'      => '100%',
					'min-height' => $attr['height'] ? self::get_css_value( $attr['height'], 'px' ) : 400 + 'px',
				),
			);
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-googlemap.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for googlemap block
		 *
		 * @return array
		 */
		public static function get_responsive_block_googlemap_default_attributes() {
			return array(
				'address' => '',
				'apiKey'  => '',
				'zoom'    => 12,
				'height'  => 400,
				'pinned'  => false,
			);
		}

		/**
		 * Get Icon List Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_icon_list_css( $attr, $id ) {
			$defaults = self::get_responsive_block_icon_list_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$editor_gap = 0;
			if ( '' !== $attr['gap'] ) { //phpcs:ignore
				$editor_gap = $attr['gap'];
			}

			$alignment = 'center';
			if ( 'left' === $attr['align'] ) {
				$alignment = 'flex-start';
			}
			if ( 'right' === $attr['align'] ) {
				$alignment = 'flex-end';
			}

			$selectors        = array(
				' .responsive-block-editor-addons-icon-list__source-icon svg' => array(
					'width'  => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
					'height' => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
				),
				'.responsive-block-editor-addons-icon-list__layout-horizontal .wp-block-responsive-block-editor-addons-icons-list-child' => array(
					'margin-left'  => self::get_css_value( $editor_gap / 2, 'px' ),
					'margin-right' => self::get_css_value( $editor_gap / 2, 'px' ),
				),
				'.responsive-block-editor-addons-icon-list__layout-horizontal .wp-block-responsive-block-editor-addons-icons-list-child:first-child' => array(
					'margin-left' => '0',
				),
				'.responsive-block-editor-addons-icon-list__layout-horizontal .wp-block-responsive-block-editor-addons-icons-list-child:nth-last-child(2)' => array(
					'margin-right' => '0',
				),
				'.responsive-block-editor-addons-icon-list__layout-vertical .responsive-block-editor-addons-icon-list__content-wrap' => array(
					'margin-bottom' => self::get_css_value( $editor_gap, 'px' ),
				),
				'.responsive-block-editor-addons-icon-list__layout-vertical .wp-block-responsive-block-editor-addons-icons-list-child:last-child .responsive-block-editor-addons-icon-list__content-wrap' => array(
					'margin-bottom' => '0px',
				),
				' .responsive-block-editor-addons-icon-list__source-wrap' => array(
					'padding'       => self::get_css_value( $attr['bgSize'], 'px' ),
					'border-radius' => self::get_css_value( $attr['borderRadius'], 'px' ),
					'border-width'  => self::get_css_value( $attr['border'], 'px' ),
					'margin-right'  => $attr['hideLabel'] ? '0px' : self::get_css_value( $attr['inner_gap'], 'px' ),
				),
				' .responsive-block-editor-addons-icon-list__source-icon' => array(
					'width'     => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
					'height'    => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
					'font-size' => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-list__source-image' => array(
					'width'  => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
					'height' => self::get_css_value( $attr['size'], $attr['fontSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-list__label-wrap' => array(
					'text-align' => $attr['align'],
				),
				' .responsive-block-editor-addons-icon-list__wrap' => array(
					'align-items'     => $alignment,
					'justify-content' => $alignment,
				),
				'.responsive-block-editor-addons-icon-list__layout-horizontal .block-editor-block-list__layout' => array(
					'justify-content'  => $alignment,
					'-webkit-box-pack' => $alignment,
					'-ms-flex-pack'    => $alignment,
				),
				' .responsive-block-editor-addons-icon-list__label' => array(
					'font-family' => $attr['labelFontFamily'],
					'font-weight' => $attr['labelFontWeight'],
					'line-height' => $attr['labelFontLineHeight'],
					'font-size'   => self::get_css_value( $attr['labelFontSize'], 'px' ),
				),
			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-icon-list__source-icon svg' => array(
					'width'  => self::get_css_value( $attr['sizeMobile'], $attr['fontSizeType'] ),
					'height' => self::get_css_value( $attr['sizeMobile'], $attr['fontSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-list__label' => array(
					'font-size' => self::get_css_value( $attr['labelFontSizeMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-icon-list__source-wrap' => array(
					'padding' => self::get_css_value( $attr['bgSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-icon-list__source-icon svg' => array(
					'width'  => self::get_css_value( $attr['sizeTablet'], $attr['fontSizeType'] ),
					'height' => self::get_css_value( $attr['sizeTablet'], $attr['fontSizeType'] ),
				),
				' .responsive-block-editor-addons-icon-list__label' => array(
					'font-size' => self::get_css_value( $attr['labelFontSizeTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-icon-list__source-wrap' => array(
					'padding' => self::get_css_value( $attr['bgSizeTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-icon-list__outer-wrap.responsive-block-editor-addons-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for icon list block
		 *
		 * @return array
		 */
		public static function get_responsive_block_icon_list_block_default_attributes() {

			return array(
				'align'               => 'left',
				'icon_count'          => 1,
				'icons'               => array(),
				'gap'                 => 10,
				'inner_gap'           => 15,
				'iconPosition'        => 'middle',
				'size'                => 16,
				'sizeMobile'          => 16,
				'sizeTablet'          => 16,
				'bgSize'              => 0,
				'bgSizeMobile'        => 0,
				'bgSizeTablet'        => 0,
				'border'              => 0,
				'borderRadius'        => 0,
				'hideLabel'           => false,
				'labelFontFamily'     => '',
				'labelFontWeight'     => '',
				'labelFontSize'       => '',
				'labelFontSizeTablet' => '',
				'labelFontSizeMobile' => '',
				'labelFontLineHeight' => 1,
				'icon_layout'         => 'vertical',
				'fontSizeType'        => 'px',
				'block_id'            => 1,
			);
		}

		/**
		 * Get Icon List Child Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_icon_list_child_css( $attr, $id ) {

			$defaults = self::get_responsive_block_icon_list_child_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors = array(
				' .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-icon' => array(
					'color' => $attr['icon_color'],
				),
				' .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-icon:hover' => array(
					'color' => $attr['icon_hover_color'],
				),
				' .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-wrap' => array(
					'background-color' => $attr['icon_bg_color'],
					'border-color'     => $attr['icon_border_color'],
				),
				':hover .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-wrap' => array(
					'background-color' => $attr['icon_bg_hover_color'],
					'border-color'     => $attr['icon_border_hover_color'],
				),
				' .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-icon svg' => array(
					'fill' => $attr['icon_color'],
				),
				':hover .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__source-icon svg' => array(
					'fill' => $attr['icon_hover_color'],
				),
				' .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__label' => array(
					'color' => $attr['label_color'],
				),
				':hover .responsive-block-editor-addons-icon-list__content-wrap .responsive-block-editor-addons-icon-list__label' => array(
					'color' => $attr['label_hover_color'],
				),

			);
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-icon-list-repeater.responsive-block-editor-addons-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for icon list child block
		 *
		 * @return array
		 */
		public static function get_responsive_block_icon_list_child_block_default_attributes() {
			return array(
				'label'                   => '#Label',
				'image_icon'              => 'icon',
				'icon'                    => 'fab fa-arrow-circle-right',
				'hideLabel'               => false,
				'image'                   => '',
				'icon_color'              => '#3a3a3a',
				'label_color'             => '',
				'icon_hover_color'        => '',
				'label_hover_color'       => '',
				'icon_bg_color'           => '',
				'icon_bg_hover_color'     => '',
				'icon_border_color'       => '',
				'icon_border_hover_color' => '',
				'link'                    => '#',
				'target'                  => false,
				'disableLink'             => true,
				'block_id'                => 1,
				'source_type'             => 'icon',
			);
		}

		/**
		 * Get Image Box Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_image_boxes_css( $attr, $id ) {
			$defaults = self::get_responsive_block_image_boxes_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity       = $attr['opacity'] / 100;
			$hover_imgopacity = $attr['hoverOpacity'] / 100;

			$tempsecondary_background_color        = $attr['bgGradient']
			? $attr['secondaryBackgroundColor']
			: $attr['itemBackgroundColor'];
			$temp_hover_secondary_background_color = $attr['hoverBgGradient']
			? $attr['hoverSecondaryBackgroundColor']
			: $attr['itemHoverBackgroundColor'];

			$hover_gradient =
			'linear-gradient(' .
			$attr['hoverGradientDegree'] .
			'deg,' .
			self::hex_to_rgb( $attr['itemHoverBackgroundColor'], $hover_imgopacity ) .
			',' .
			self::hex_to_rgb(
				$temp_hover_secondary_background_color,
				$hover_imgopacity
			) .
			')';

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$background_image_first  = '';
			$background_image_second = '';
			$background_image_third  = '';
			$background_image_fourth = '';

			$background_image_first = 'linear-gradient(' . $attr['gradientDegree'] . 'deg, ' .

			self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ) .

			',' .

			self::hex_to_rgb( $tempsecondary_background_color, $imgopacity ) .

			'),url(' .

			$attr['backgroundImageOne'] .

			')';

			$background_image_second = 'linear-gradient(' . $attr['gradientDegree'] . 'deg, ' .

			self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ) .

			',' .

			self::hex_to_rgb( $tempsecondary_background_color, $imgopacity ) .

			'),url(' .

			$attr['backgroundImageTwo'] .

			')';

			$background_image_third = 'linear-gradient(' . $attr['gradientDegree'] . 'deg, ' .

			self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ) .

			',' .

			self::hex_to_rgb( $tempsecondary_background_color, $imgopacity ) .

			'),url(' .

			$attr['backgroundImageThree'] .

			')';

			$background_image_fourth = 'linear-gradient(' . $attr['gradientDegree'] . 'deg, ' .

			self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ) .

			',' .

			self::hex_to_rgb( $tempsecondary_background_color, $imgopacity ) .

			'),url(' .

			$attr['backgroundImageFour'] .

			')';

			$gutter_margin_ib = '';
			if ( $attr['count'] > 1 ) {
				if ( 'small' === $attr['gutter'] ) {
					$gutter_margin_ib = '20px';
				} elseif ( 'medium' === $attr['gutter'] ) {
					$gutter_margin_ib = '30px';
				} elseif ( 'large' === $attr['gutter'] ) {
					$gutter_margin_ib = '40px';
				} elseif ( 'huge' === $attr['gutter'] ) {
					$gutter_margin_ib = '50px';
				} else {
					$gutter_margin_ib = '';
				}
			}

			$selectors = array(
				' '                => array(
					'text-align'          => $attr['contentAlign'],
					'border-color'        => $attr['blockBorderColor'],
					'border-style'        => $attr['blockBorderStyle'],
					'border-width'        => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'border-radius'       => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'justify-content'     => $attr['verticalAlignment'] . '!important',
					'background-color'    => self::hex_to_rgb( $attr['itemBackgroundColor'], $imgopacity ),
					'background-size'     => $attr['backgroundSize'],
					'background-repeat'   => $attr['backgroundRepeat'],
					'background-position' => $attr['backgroundPosition'],
					'padding-left'        => self::get_css_value( $attr['boxPaddingLeft'], 'px' ),
					'padding-right'       => self::get_css_value( $attr['boxPaddingRight'], 'px' ),
					'padding-bottom'      => self::get_css_value( $attr['boxPaddingBottom'], 'px' ),
					'padding-top'         => self::get_css_value( $attr['boxPaddingTop'], 'px' ),
					'height'              => self::get_css_value( $attr['boxHeight'], 'px' ),
					'box-shadow'          =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),

				':hover .responsive-block-editor-addons-add-image' => array(
					'background-image' => $hover_gradient,
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
				),

				':hover'           => array(
					'transform' => 'scale(' . $attr['imageHoverEffect'] . ')',
				),

				' .responsive-block-editor-addons-imagebox-image' => array(
					'width'     => $attr['imageSize'],
					'max-width' => 100 . '%',
				),
				' .wp-block-responsive-block-editor-addons-image-boxes-block-item__title' => array(
					'font-family'   => $attr['titleFontFamily'],
					'font-weight'   => $attr['titleFontWeight'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'line-height'   => $attr['titleLineHeight'],
					'color'         => $attr['titleColor'],
					'margin-top'    => self::get_css_value( $attr['titleSpacing'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['titleSpacing'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-image-boxes-block-item__description' => array(
					'font-family'   => $attr['descriptionFontFamily'],
					'font-size'     => self::get_css_value( $attr['descriptionFontSize'], 'px' ),
					'font-weight'   => $attr['descriptionFontWeight'],
					'line-height'   => $attr['descriptionLineHeight'],
					'color'         => $attr['descriptionColor'],
					'margin-top'    => self::get_css_value( $attr['descriptionSpacing'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['descriptionSpacing'], 'px' ),
				),
				' .imagebox-arrow' => array(
					'color'     => $attr['arrowColor'],
					'font-size' => self::get_css_value( $attr['arrowSize'], 'px' ),
				),
				'.responsive-block-editor-addons-block-image-boxes-0' => array(
					'background-image' => $background_image_first,
				),
				'.responsive-block-editor-addons-block-image-boxes-1' => array(
					'background-image' => $background_image_second,
				),
				'.responsive-block-editor-addons-block-image-boxes-2' => array(
					'background-image' => $background_image_third,
				),
				'.responsive-block-editor-addons-block-image-boxes-3' => array(
					'background-image' => $background_image_fourth,
				),
			);
			$mobile_selectors = array(
				' .wp-block-responsive-block-editor-addons-image-boxes-block-item__title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .wp-block-responsive-block-editor-addons-image-boxes-block-item__title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSizeTablet'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-image-boxes-block-item__title' => array(
					'font-size' => self::get_css_value( $attr['titleFontSize'], 'px' ) . '!important',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id             = '.responsive-block-editor-addons-block-image-boxes.block-' . $id;
			$css            = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			$css['mobile'] .= '
                .wp-block-responsive-block-editor-addons-image-boxes-block__inner a {
                    margin-bottom: ' . $gutter_margin_ib . '!important;
					max-width: 100% !important;
                }
				.wp-block-responsive-block-editor-addons-image-boxes-block__inner {
                    flex-direction: column;
					align-items: center;
                }
            ';

			return $css;
		}

		/**
		 * Get Defaults for image box block
		 *
		 * @return array
		 */
		public static function get_responsive_block_image_boxes_default_attributes() {
			return array(
				'block_id'                      => '',
				'imageboxesBlock'               => '',
				'counterId'                     => 1,
				'count'                         => '',
				'titleHeadingTag'               => 'h3',
				'gutter'                        => 'medium',
				'contentAlign'                  => 'center',
				'textColor'                     => '',
				'itemBackgroundColor'           => '#fff',
				'hoverTextColor'                => '',
				'verticalAlignment'             => 'center',
				'itemHoverBackgroundColor'      => '#fff',
				'hoverBorderColor'              => '',
				'titleSpacing'                  => '',
				'descriptionSpacing'            => '',
				'blockBorderRadius'             => '',
				'blockBorderStyle'              => 'solid',
				'blockBorderWidth'              => 2,
				'blockBorderColor'              => '#1E1E1E',
				'boxPaddingLeft'                => 15,
				'boxPaddingRight'               => 15,
				'boxPaddingBottom'              => 15,
				'boxPaddingTop'                 => 15,
				'boxHeight'                     => '',
				'hasArrow'                      => '',
				'hasArrow'                      => '',
				'arrowColor'                    => '',
				'arrowSize'                     => '',
				'boxShadowColor'                => '#fff',
				'boxShadowHOffset'              => 9,
				'boxShadowVOffset'              => 9,
				'boxShadowBlur'                 => 9,
				'opacity'                       => 70,
				'hoverOpacity'                  => 70,
				'boxShadowSpread'               => 9,
				'boxShadowPosition'             => 'outset',
				'backgroundPosition'            => '',
				'backgroundSize'                => '',
				'backgroundRepeat'              => '',
				'imageHoverEffect'              => '',
				'bggradient'                    => '',
				'secondaryBackgroundColor'      => '',
				'hoverSecondaryBackgroundColor' => '',
				'gradientDegree'                => 180,
				'bgGradient'                    => false,
				'hoverGradientDegree'           => 180,
				'hoverBgGradient'               => false,
				'titleFontFamily'               => '',
				'descriptionFontFamily'         => '',
				'titleFontSize'                 => '',
				'titleFontSizeMobile'           => '',
				'titleFontSizeTablet'           => '',
				'titleFontWeight'               => '',
				'imageSize'                     => 'full',
				'titleLineHeight'               => '',
				'titleColor'                    => '#1E1E1E',
				'descriptionFontSize'           => '',
				'descriptionFontWeight'         => '',
				'descriptionLineHeight'         => '',
				'descriptionColor'              => '#1E1E1E',
				'backgroundImageOne'            => '',
				'backgroundImageTwo'            => '',
				'backgroundImageThree'          => '',
				'backgroundImageFour'           => '',
			);
		}

		/**
		 * Get Image Slider Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_image_slider_css( $attr, $id ) {
			$defaults = self::get_responsive_block_image_slider_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$imgopacity = $attr['iconBackgroundOpacity'] / 100;

			$selectors = array(
				' .flickity-button .flickity-button-icon' => array(
					'fill' => $attr['iconColor'],
				),

				' .flickity-button'                       => array(
					'background-color' => self::hex_to_rgb( $attr['iconBackgroundColor'] ? $attr['iconBackgroundColor'] : '#ffffff', $imgopacity ),
					'border-radius'    => $attr['iconBackgroundRadius'] . '%',
				),

				' .responsive-block-editor-addons-gallery--item figure' => array(
					'height' => ( $attr['height'] - ( $attr['borderWidth'] ? $attr['borderWidth'] * 2 : 0 ) ) . 'px',
				),

				' .has-carousel-lrg .responsive-block-editor-addons-gallery--item' => array(
					'width' => self::get_css_value( $attr['width'], 'px' ),
				),

				' .responsive-block-editor-addons-gallery--item' => array(
					'margin-left'  => $attr['gutter'] > 0 && ! ( $attr['responsiveHeight'] ) ? $attr['gutter'] . 'px' : null,
					'margin-right' => $attr['gutter'] > 0 && ! ( $attr['responsiveHeight'] ) ? $attr['gutter'] . 'px' : null,
					'border-width' => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-style' => $attr['borderStyle'],
					'border-color' => $attr['borderColor'],
				),
			);

			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-image-slider.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for image slider block
		 *
		 * @return array
		 */
		public static function get_responsive_block_image_slider_default_attributes() {
			return array(
				'block_id'              => '',
				'gutter'                => 5,
				'gutterMobile'          => 5,
				'gridSize'              => 'lrg',
				'height'                => 400,
				'width'                 => '',
				'customWidth'           => false,
				'pageDots'              => false,
				'prevNextButtons'       => true,
				'autoPlay'              => false,
				'autoPlaySpeed'         => 3000,
				'draggable'             => true,
				'alignCells'            => false,
				'pauseHover'            => false,
				'freeScroll'            => false,
				'isSmallImage'          => false,
				'thumbnails'            => false,
				'responsiveHeight'      => false,
				'borderWidth'           => '',
				'iconBackgroundRadius'  => 20,
				'iconBackgroundOpacity' => 90,
				'iconBackgroundColor'   => '',
				'borderColor'           => '',
				'iconColor'             => '',
				'borderStyle'           => '',
				'counterId'             => '',
			);
		}

		/**
		 * Get Info Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_info_block_css( $attr, $id ) {
			$defaults = self::get_responsive_block_info_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$image_box_shadow_position_css = $attr['imageBoxShadowPosition'];
			if ( 'outset' === $attr['imageBoxShadowPosition'] ) {
				$image_box_shadow_position_css = '';
			}

			$box_shadow_position_css = $attr['boxShadowPosition'];
			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$hoverbox_shadow_position_css = $attr['hoverboxShadowPosition'];
			if ( 'outset' === $attr['hoverboxShadowPosition'] ) {
				$hoverbox_shadow_position_css = '';
			}

			$newopacity = $attr['opacity'] / 100;

			$imgopacity = $attr['imageopacity'] / 100;

			$icon_bg_color = '';
			if ( 'solid' === $attr['iconBackgroundType'] ) {
				$icon_bg_color = $attr['iconBackgroundColor'];
			}

			$icon_bg_hover_color = '';
			if ( 'solid' === $attr['iconBackgroundType'] ) {
				$icon_bg_hover_color = $attr['iconBackgroundHoverColor'];
			}

			$icon_bg_padding = 0;
			if ( 'none' !== $attr['iconBackgroundType'] ) {
				$icon_bg_padding = self::get_css_value( $attr['iconPadding'], 'px' );
			}

			$icon_border = 'none';
			if ( 'outline' === $attr['iconBackgroundType'] ) {
				$icon_border = self::get_css_value( $attr['iconBorderWidth'], 'px' ) . ' solid ' . $attr['iconBackgroundColor'];
			}

			$icon_hover_border = 'none';
			if ( 'outline' === $attr['iconBackgroundType'] ) {
				$icon_hover_border = self::get_css_value( $attr['iconBorderWidth'], 'px' ) . ' solid ' . $attr['iconBackgroundHoverColor'];
			}

			$selectors = array(
				' '                                        => array(
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'background-color' => self::hex_to_rgb( $attr['boxBackgroundColor'], $newopacity ),
					'padding'          => self::get_css_value( $attr['contentPadding'], 'px' ),
					'border-color'     => $attr['blockBorderColor'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'box-shadow'       =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),

				':hover'                                   => array(
					'box-shadow' =>
					self::get_css_value( $attr['hoverboxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowSpread'], 'px' ) .
					' ' .
					$attr['hoverboxShadowColor'] .
					' ' .
					$hoverbox_shadow_position_css,
				),

				' .responsive-block-editor-addons-ifb-image-icon-content.responsive-block-editor-addons-ifb-imgicon-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['iconBottomMargin'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['iconTopMargin'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['iconLeftMargin'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['iconRightMargin'], 'px' ),
				),

				' .responsive-block-editor-addons-ifb-icon' => array(
					'width'            => self::get_css_value( $attr['resIconSize'], 'px' ),
					'height'           => self::get_css_value( $attr['resIconSize'], 'px' ),
					'background-color' => $icon_bg_color,
					'border-radius'    => self::get_css_value( $attr['iconBorderRadius'], 'px' ),
					'padding'          => $icon_bg_padding,
					'border'           => $icon_border,
				),

				' .responsive-block-editor-addons-ifb-icon:hover' => array(
					'background-color' => $icon_bg_hover_color,
					'border'           => $icon_hover_border,
				),

				' .responsive-block-editor-addons-ifb-image-content > img' => array(
					'border-color'  => $attr['resImageBorderColor'],
					'border-radius' => self::get_css_value( $attr['resImageBorderRadius'], 'px' ),
					'border-width'  => self::get_css_value( $attr['resImageBorderWidth'], 'px' ),
					'border-style'  => $attr['resImageBorderStyle'],
					'box-shadow'    =>
						self::get_css_value( $attr['imageBoxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['imageBoxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['imageBoxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['imageBoxShadowSpread'], 'px' ) .
						' ' .
						$attr['imageBoxShadowColor'] .
						' ' .
						$image_box_shadow_position_css,
					'opacity'       => $imgopacity,
				),

				' .responsive-block-editor-addons-ifb-separator' => array(
					'border-width'     => self::get_css_value( $attr['resseperatorThickness'], 'px' ),
					'border-color'     => $attr['resseperatorColor'],
					'border-top-style' => $attr['resseperatorStyle'],
					'width'            => self::get_css_value( $attr['resseperatorWidth'], $attr['resseparatorWidthType'] ),
					'margin-bottom'    => self::get_css_value( $attr['sepSpace'], 'px' ),
				),

				' .responsive-block-editor-addons-ifb-cta-button' => array(
					'background-color' => $attr['resctaBgColor'],
					'border-color'     => $attr['resctaBorderColor'],
				),

				' .responsive-block-editor-addons-ifb-cta-button .responsive-block-editor-addons-inline-editing' => array(
					'color' => $attr['resctaBtnLinkColor'],
				),

				' .responsive-block-editor-addons-ifb-cta-button:hover' => array(
					'background-color' => $attr['hoverctaBgColor'],
					'border-color'     => $attr['hoverctaBorderColor'],
				),

				' .responsive-block-editor-addons-ifb-cta-button:hover .responsive-block-editor-addons-inline-editing' => array(
					'color' => $attr['hoverctaBtnLinkColor'],
				),

				' .responsive-block-editor-addons-ifb-icon svg' => array(
					'fill' => $attr['icon_color'],
				),

				' .responsive-block-editor-addons-ifb-icon:hover svg' => array(
					'fill' => $attr['icon_hcolor'],
				),

				' .responsive-block-editor-addons-infobox__content-wrap' => array(
					'text-align' => ( 'above-title' === $attr['imgiconPosition'] || 'below-title' === $attr['imgiconPosition'] ) ? $attr['resheadingAlign'] : '',
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-title' => array(
					'font-size' => self::get_css_value( $attr['resheadFontSize'], 'px !important' ),
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-desc' => array(
					'font-size' => self::get_css_value( $attr['ressubHeadFontSize'], 'px !important' ),
				),

				' .responsive-block-editor-addons-ifb-image-content img' => array(
					'width'     => self::get_css_value( $attr['imageWidth'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidth'], 'px' ),
				),

				' .responsive-block-editor-addons-cta-image' => array(
					'background-image'      => 'url(' . $attr['imgURL'] . ')',
					'background-position'   => $attr['imagePosition'],
					'background-repeat'     => $attr['imageRepeat'],
					'background-size'       => $attr['thumbsize'],
					'background-attachment' => $attr['backgroundAttachment'],
				),

				' .responsive-block-editor-addons-ifb-title-prefix' => array(
					'color'         => $attr['resprefixColor'],
					'font-size'     => self::get_css_value( $attr['resprefixFontSize'], 'px' ),
					'font-weight'   => $attr['resprefixFontWeight'],
					'line-height'   => $attr['resprefixLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['resprefixSpace'], 'px' ),
				),

				' .responsive-block-editor-addons-ifb-title' => array(
					'color'         => $attr['resheadingColor'],
					'font-family'   => $attr['resheadFontFamily'],
					'font-weight'   => $attr['resheadFontWeight'],
					'line-height'   => $attr['resheadLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['resheadSpace'], 'px' ),
				),

				' .responsive-block-editor-addons-ifb-desc' => array(
					'color'         => $attr['ressubheadingColor'],
					'font-family'   => $attr['ressubHeadFontFamily'],
					'font-weight'   => $attr['ressubHeadFontWeight'],
					'line-height'   => $attr['ressubHeadLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['ressubHeadSpace'], 'px' ),
				),

				' .responsive-block-editor-addons-infobox-cta-link' => array(
					'color'          => $attr['resctaLinkColor'],
					'padding-top'    => self::get_css_value( $attr['ctaBtnVertPadding'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['ctaBtnVertPadding'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['ctaBtnHrPadding'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['ctaBtnHrPadding'], 'px' ),
					'font-size'      => self::get_css_value( $attr['ctaTextFontSize'], 'px' ),
					'font-weight'    => $attr['ctaTextFontWeight'],
					'font-family'    => $attr['ctaTextFontFamily'],
					'line-height'    => $attr['ctaTextLineHeight'],
				),

				' .responsive-block-editor-addons-inline-editing ' => array(
					'color'     => $attr['resctaLinkColor'],
					'font-size' => self::get_css_value( $attr['resctaFontSize'], 'px' ),
				),

				' .responsive-block-editor-addons-infobox-cta-link.responsive-block-editor-addons-ifb-cta-button' => array(
					'border-width'   => self::get_css_value( $attr['resctaBorderWidth'], 'px' ),
					'border-style'   => $attr['resctaBorderStyle'],
					'border-radius'  => self::get_css_value( $attr['resctaBorderRadius'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['ctaBtnVertPadding'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['ctaBtnVertPadding'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['ctaBtnHrPadding'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['ctaBtnHrPadding'], 'px' ),
					'font-size'      => self::get_css_value( $attr['resctaFontSize'], 'px' ),
					'font-weight'    => $attr['resctaFontWeight'],
				),

				' .responsive-block-editor-addons-ifb-cta' => array(
					'margin-bottom' => self::get_css_value( $attr['ctaBottomMargin'], 'px' ),
				),
			);

			$mobile_selectors = array(
				' .responsive-block-editor-addons-ifb-image-icon-content.responsive-block-editor-addons-ifb-imgicon-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['iconBottomMarginMobile'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['iconTopMarginMobile'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['iconLeftMarginMobile'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['iconRightMarginMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-mobile .responsive-block-editor-addons-ifb-content' => array(
					'text-align' => $attr['alignment'],
				),
				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-mobile .responsive-block-editor-addons-ifb-icon-wrap' => array(
					'text-align' => $attr['alignment'],
				),
				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-mobile .responsive-block-editor-addons-ifb-imgicon-wrap' => array(
					'text-align' => $attr['alignment'],
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-title' => array(
					'font-size' => self::get_css_value( $attr['resheadFontSizeMobile'], 'px !important' ),
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-desc' => array(
					'font-size' => self::get_css_value( $attr['ressubHeadFontSizeMobile'], 'px !important' ),
				),

				' .responsive-block-editor-addons-ifb-image-content img' => array(
					'width'     => self::get_css_value( $attr['imageWidthMobile'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidthMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-infobox-cta-link' => array(
					'font-size' => self::get_css_value( $attr['ctaTextFontSizeMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-ifb-image-icon-content.responsive-block-editor-addons-ifb-imgicon-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['iconBottomMarginTablet'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['iconTopMarginTablet'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['iconLeftMarginTablet'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['iconRightMarginTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-tablet .responsive-block-editor-addons-ifb-content' => array(
					'text-align' => $attr['alignment'],
				),

				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-tablet .responsive-block-editor-addons-ifb-icon-wrap' => array(
					'text-align' => $attr['alignment'],
				),

				' .responsive-block-editor-addons-infobox__content-wrap.responsive-block-editor-addons-infobox-stacked-tablet .responsive-block-editor-addons-ifb-imgicon-wrap' => array(
					'text-align' => $attr['alignment'],
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-title' => array(
					'font-size' => self::get_css_value( $attr['resheadFontSizeTablet'], 'px !important' ),
				),

				' .responsive-block-editor-addons-infobox__content-wrap .responsive-block-editor-addons-ifb-desc' => array(
					'font-size' => self::get_css_value( $attr['ressubHeadFontSizeTablet'], 'px !important' ),
				),

				' .responsive-block-editor-addons-ifb-image-content img' => array(
					'width'     => self::get_css_value( $attr['imageWidthTablet'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidthTablet'], 'px' ),
				),
				' .responsive-block-editor-addons-infobox-cta-link' => array(
					'font-size' => self::get_css_value( $attr['ctaTextFontSizeTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-info-block.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for info block
		 *
		 * @return array
		 */
		public static function get_responsive_block_info_block_default_attributes() {
			return array(
				'block_id'                 => '',
				'inheritFromTheme'         => false,
				'resprefixTitle'           => 'Prefix',
				'classMigrate'             => false,
				'resinfoBlockTitle'        => 'Info Box',
				'resDescHeading'           => 'Click here to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
				'resheadingAlign'          => 'center',
				'alignment'                => 'center',
				'resheadingColor'          => '',
				'ressubheadingColor'       => '',
				'resprefixColor'           => '',
				'icon'                     => 'fa fa-star',
				'imgiconPosition'          => 'above-title',
				'resIconSize'              => 40,
				'iconColor'                => '#333',
				'resprefixFontSize'        => '',
				'resprefixFontWeight'      => '',
				'resprefixLineHeight'      => '',
				'resheadingTag'            => 'h3',
				'resheadFontFamily'        => '',
				'ressubHeadFontFamily'     => '',
				'resheadFontSize'          => '',
				'resheadFontSizeMobile'    => '',
				'resheadFontSizeTablet'    => '',
				'resheadFontWeight'        => '700',
				'resheadLineHeight'        => '',
				'ressubHeadFontSize'       => '',
				'ressubHeadFontSizeTablet' => '',
				'ressubHeadFontSizeMobile' => '',
				'ressubHeadFontWeight'     => '100',
				'ressubHeadLineHeight'     => '',
				'resheadSpace'             => 10,
				'ressubHeadSpace'          => 10,
				'resseperatorSpace'        => 10,
				'source_type'              => 'icon',
				'ressourceAlign'           => 'top',
				'resctaTarget'             => false,
				'ctaIcon'                  => '',
				'resseperatorPosition'     => 'after_title',
				'resseperatorStyle'        => 'solid',
				'resseperatorColor'        => '',
				'resseperatorWidth'        => 30,
				'resseparatorWidthType'    => '%',
				'resseperatorThickness'    => 2,
				'resctaType'               => 'none',
				'resctaText'               => 'Read More',
				'resctaLink'               => '#',
				'resctaLinkColor'          => '#333',
				'resctaFontSize'           => '',
				'resctaFontWeight'         => '',
				'resctaBtnLinkColor'       => '#333',
				'resctaBgColor'            => 'transparent',
				'resctaBorderColor'        => '#333',
				'resctaBorderStyle'        => 'solid',
				'ctaBtnVertPadding'        => 10,
				'ctaBtnHrPadding'          => 14,
				'resctaBorderWidth'        => 1,
				'resctaBorderRadius'       => 0,
				'resprefixSpace'           => 5,
				'iconLeftMargin'           => 0,
				'iconRightMargin'          => 0,
				'iconTopMargin'            => 5,
				'iconBottomMargin'         => 5,
				'iconLeftMarginMobile'     => 0,
				'iconRightMarginMobile'    => 0,
				'iconTopMarginMobile'      => 5,
				'iconBottomMarginMobile'   => 5,
				'iconLeftMarginTablet'     => 0,
				'iconRightMarginTablet'    => 0,
				'iconTopMarginTablet'      => 5,
				'iconBottomMarginTablet'   => 5,
				'iconImage'                => '',
				'imageSize'                => 'thumbnail',
				'imageWidth'               => 120,
				'imageWidthTablet'         => '',
				'imageWidthMobile'         => '',
				'imageWidthType'           => true,
				'stack'                    => 'tablet',
				'resshowPrefix'            => true,
				'resshowTitle'             => true,
				'resshowDesc'              => true,
				'blockBorderStyle'         => 'none',
				'blockBorderWidth'         => 1,
				'blockBorderRadius'        => '',
				'blockBorderColor'         => '',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => '',
				'boxShadowSpread'          => '',
				'boxShadowPosition'        => 'outset',
				'imageBoxShadowColor'      => '',
				'imageBoxShadowHOffset'    => 0,
				'imageBoxShadowVOffset'    => 0,
				'imageBoxShadowBlur'       => '',
				'imageBoxShadowSpread'     => '',
				'imageBoxShadowPosition'   => 'outset',
				'counterId'                => 1,
				'boxBackgroundColor'       => '#ffffff',
				'contentPadding'           => 0,
				'opacity'                  => 100,
				'imageopacity'             => 100,
				'imgURL'                   => '',
				'imgID'                    => '',
				'imgAlt'                   => '',
				'dimRatio'                 => 50,
				'hoverctaBtnLinkColor'     => '#333',
				'hoverctaBgColor'          => 'transparent',
				'hoverctaBorderColor'      => '#333',
				'imagePosition'            => 'center center',
				'imageRepeat'              => 'no-repeat',
				'thumbsize'                => 'cover',
				'backgroundAttachment'     => 'scroll',
				'sepSpace'                 => 10,
				'icon_color'               => '#3a3a3a',
				'icon_hcolor'              => '#3a3a3a',
				'resImageBorderColor'      => '#333',
				'resImageBorderStyle'      => 'none',
				'resImageBorderRadius'     => 0,
				'resImageBorderWidth'      => 2,
				'ctaTextFontFamily'        => '',
				'ctaTextFontSize'          => '',
				'ctaTextFontSizeMobile'    => '',
				'ctaTextFontSizeTablet'    => '',
				'ctaTextFontWeight'        => '',
				'ctaTextLineHeight'        => '',
				'ctaBottomMargin'          => 10,
				'hoverboxShadowColor'      => '#ccc',
				'hoverboxShadowHOffset'    => 0,
				'hoverboxShadowVOffset'    => 0,
				'hoverboxShadowBlur'       => 6,
				'hoverboxShadowSpread'     => 1,
				'hoverboxShadowPosition'   => 'outset',
				'iconBackgroundColor'      => '#0066cc',
				'iconBackgroundHoverColor' => '',
				'iconBackgroundType'       => 'none',
				'iconPadding'              => 5,
				'iconBorderRadius'         => 0,
				'iconBorderWidth'          => 1,

			);
		}

		/**
		 * Get Post timeline Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_post_timeline_css( $attr, $id ) {
			$defaults = self::get_responsive_block_post_timeline_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$selectors = array(
				' .responsive-block-editor-addons-timeline__icon-new svg' => array(
					'width'  => self::get_css_value( $attr['iconSize'], 'px' ),
					'height' => self::get_css_value( $attr['iconSize'], 'px' ),
					'fill'   => $attr['iconColor'],
				),
				' .responsive-block-editor-addons-timeline__marker' => array(
					'border'           => self::get_css_value( $attr['borderWidth'], 'px solid' ),
					'border-color'     => $attr['separatorBorder'],
					'background-color' => $attr['separatorBg'],
					'min-width'        => self::get_css_value( $attr['bgSize'], 'px' ),
					'min-height'       => self::get_css_value( $attr['bgSize'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__line' => array(
					'background-color' => $attr['connectorColor'],
					'width'            => self::get_css_value( $attr['connectorWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__link_parent' => array(
					'background-color' => $attr['continuebgColor'],
					'border'           => '1px solid ' . $attr['borderColor'] . '',
					'box-shadow'       =>
					self::get_css_value(
						$attr['boxShadowHOffset'],
						'px'
					) .
					' ' .
					self::get_css_value(
						$attr['boxShadowVOffset'],
						'px'
					) .
					' ' .
					self::get_css_value(
						$attr['boxShadowBlur'],
						'px'
					) .
					' ' .
					self::get_css_value(
						$attr['boxShadowSpread'],
						'px'
					) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
				),
				' .responsive-block-editor-addons-timeline__link_parent:hover' => array(
					'background-color' => $attr['continuebghColor'],
					'border'           => '1px solid ' . $attr['borderHColor'] . '',
				),
				' .responsive-block-editor-addons-timeline__link_parent .responsive-block-editor-addons-timeline__link' => array(
					'color'       => $attr['continueColor'] . '!important',
					'line-height' => $attr['continueLineHeight'],
					'font-weight' => $attr['continueFontWeight'],
					'font-size'   => self::get_css_value( $attr['continueFontSize'], 'px' ),
					'font-family' => $attr['continueFontFamily'],
				),
				' .responsive-block-editor-addons-timeline__link_parent:hover .responsive-block-editor-addons-timeline__link' => array(
					'color' => $attr['hColor'] . '!important',
				),
				'.responsive-block-editor-addons-timeline__center-block .responsive-block-editor-addons-timeline__marker' => array(
					'margin-left'  => self::get_css_value( $attr['horSpace'], 'px' ),
					'margin-right' => self::get_css_value( $attr['horSpace'], 'px' ),
				),
				'.responsive-block-editor-addons-timeline__left-block .responsive-block-editor-addons-timeline__day-new' => array(
					'margin-left' => self::get_css_value( $attr['horSpace'], 'px' ),
				),
				'.responsive-block-editor-addons-timeline__right-block .responsive-block-editor-addons-timeline__day-new' => array(
					'margin-right' => self::get_css_value( $attr['horSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__field.responsive-block-editor-addons-timeline__field-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['verSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__left-block .responsive-block-editor-addons-timeline__line' => array(
					'left' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__right-block .responsive-block-editor-addons-timeline__line' => array(
					'right' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__main .responsive-block-editor-addons-timeline__post p' => array(
					'line-height' => $attr['contentLineHeight'],
				),
				' .responsive-block-editor-addons-timeline__events-new' => array(
					'margin-bottom' => self::get_css_value( $attr['blockSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__events-new .responsive-block-editor-addons-timeline__events-inner-new' => array(
					'background-color' => $attr['bgColor']
					? $attr['bgColor'] : '#e4e4e4',
					'border-radius'    => self::get_css_value( $attr['borderRadius'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__date-hide.responsive-block-editor-addons-timeline__date-inner .responsive-block-editor-addons-timeline__date-new' => array(
					'line-height' => $attr['dateLineHeight'],
					'font-weight' => $attr['dateFontWeight'],
					'font-size'   => self::get_css_value( $attr['dateFontSize'], 'px' ),
					'font-family' => $attr['dateFontFamily'],
				),
				' .responsive-block-editor-addons-content' => array(
					'padding' => self::get_css_value( $attr['contentPadding'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-timeline-title' => array(
					'margin-bottom' => self::get_css_value( $attr['headingSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-timeline-title .responsive-block-editor-addons-block-post-timeline-title-heading' => array(
					'color'       => $attr['headingColor']
					? $attr['headingColor'] . '!important'
					: '#333',
					'line-height' => $attr['headingLineHeight'],
					'font-weight' => $attr['headingFontWeight'],
					'font-size'   => self::get_css_value( $attr['headingFontSize'], 'px' ),
					'font-family' => $attr['headingFontFamily'],
				),
				' .responsive-block-editor-addons-block-post-timeline-byline' => array(
					'margin-bottom' => self::get_css_value( $attr['authorSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-block-post-timeline-author .responsive-block-editor-addons-text-link' => array(
					'color'       => $attr['authorColor']
					? $attr['authorColor'] . '!important'
					: '#626e81',
					'line-height' => $attr['authorLineHeight'],
					'font-weight' => $attr['authorFontWeight'],
					'font-size'   => self::get_css_value( $attr['authorFontSize'], 'px' ),
					'font-family' => $attr['authorFontFamily'],
				),
				' .responsive-block-editor-addons-block-post-timeline-excerpt .responsive-block-editor-addons-timeline__post' => array(
					'color'         => $attr['textColor']
					? $attr['textColor'] . '!important'
					: '#333',
					'font-weight'   => $attr['contentFontWeight'],
					'font-size'     => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'font-family'   => $attr['contentFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['excerptSpace'], 'px' ),
				),
				' .responsive-block-editor-addons-timeline__date-new.responsive-block-editor-addons-timeline__date-outer' => array(
					'line-height' => $attr['dateLineHeight'],
					'font-weight' => $attr['dateFontWeight'],
					'font-size'   => self::get_css_value( $attr['dateFontSize'], 'px' ),
					'font-family' => $attr['dateFontFamily'],
				),
				' .responsive-block-editor-addons-timeline__main .responsive-block-editor-addons-timeline__line__inner' => array(
					'background-color' => $attr['separatorFillColor'],
				),
				' .responsive-block-editor-addons-timeline__main .responsive-block-editor-addons-timeline__marker.responsive-block-editor-addons-timeline__in-view-icon' => array(
					'background'   => $attr['iconBgFocus'],
					'border-color' => $attr['borderFocus'],
					'color'        => $attr['iconFocus'],
				),

				' .responsive-block-editor-addons-timeline__main .responsive-block-editor-addons-timeline__marker.responsive-block-editor-addons-timeline__in-view-icon svg' => array(
					'fill' => $attr['iconFocus'],
				),

				' .responsive-block-editor-addons-timeline__main .responsive-block-editor-addons-timeline__marker.responsive-block-editor-addons-timeline__in-view-icon .responsive-block-editor-addons-timeline__icon-new' => array(
					'color' => $attr['iconFocus'],
				),
			);
			$mobile_selectors = array(
				' .responsive-block-editor-addons-timeline__center-block.responsive-block-editor-addons-timeline__responsive-mobile .responsive-block-editor-addons-timeline__line' => array(
					'left'  => 'calc(' . $attr['bgSize'] . '/2)px',
					'right' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__left-block.responsive-block-editor-addons-timeline__responsive-mobile .responsive-block-editor-addons-timeline__line' => array(
					'left' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__right-block.responsive-block-editor-addons-timeline__responsive-mobile .responsive-block-editor-addons-timeline__line' => array(
					'right' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-timeline__center-block.responsive-block-editor-addons-timeline__responsive-tablet .responsive-block-editor-addons-timeline__line' => array(
					'left'  => 'calc(' . $attr['bgSize'] . '/2)px',
					'right' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__left-block.responsive-block-editor-addons-timeline__responsive-tablet .responsive-block-editor-addons-timeline__line' => array(
					'left' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
				' .responsive-block-editor-addons-timeline__right-block.responsive-block-editor-addons-timeline__responsive-tablet .responsive-block-editor-addons-timeline__line' => array(
					'right' => 'calc(' . $attr['bgSize'] . '/2)px',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-post-timeline.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for post timeline block
		 *
		 * @return array
		 */
		public static function get_responsive_block_post_timeline_default_attributes() {
			return array(
				'categories'          => '',
				'className'           => '',
				'postsToShow'         => 6,
				'displayPostDate'     => true,
				'displayPostExcerpt'  => true,
				'displayPostAuthor'   => true,
				'displayPostImage'    => true,
				'displayPostLink'     => true,
				'displayPostTitle'    => true,
				'displaySectionTitle' => false,
				'postTitleTag'        => 'h3',
				'postLayout'          => 'grid',
				'columns'             => 2,
				'align'               => 'center',
				'timelinAlignment'    => 'center',
				'arrowlinAlignment'   => 'center',
				'width'               => 'wide',
				'order'               => 'desc',
				'orderBy'             => 'date',
				'readMoreText'        => 'Continue Reading',
				'offset'              => 0,
				'excerptLength'       => 55,
				'postType'            => 'post',
				'sectionTag'          => 'section',
				'sectionTitle'        => '',
				'sectionTitleTag'     => 'h2',
				'imageSize'           => 'full',
				'url'                 => '',
				'source'              => 'attribute',
				'selector'            => 'img',
				'attribute'           => 'src',
				'id'                  => '',
				'bgColor'             => '#e4e4e4',
				'textColor'           => '#333',
				'contentPadding'      => 20,
				'authorSpace'         => '',
				'excerptSpace'        => '',
				'blockSpace'          => '',
				'headingSpace'        => '',
				'headingColor'        => '#333',
				'authorColor'         => '#626e81',
				'continueColor'       => '#333',
				'dateFontFamily'      => '',
				'headingFontFamily'   => '',
				'authorFontFamily'    => '',
				'contentFontFamily'   => '',
				'continueFontFamily'  => '',
				'connectorColor'      => '#eeeeee',
				'dateFontSize'        => 16,
				'dateFontWeight'      => 400,
				'dateLineHeight'      => 1.75,
				'headingFontSize'     => 20,
				'headingFontWeight'   => 700,
				'headingLineHeight'   => 1.5,
				'authorFontSize'      => 14,
				'authorFontWeight'    => 400,
				'authorLineHeight'    => 1.5,
				'contentFontSize'     => 16,
				'contentFontWeight'   => 400,
				'contentLineHeight'   => 1.75,
				'continueFontSize'    => 16,
				'continueFontWeight'  => 700,
				'continueLineHeight'  => 1.75,
				'icon'                => 'calendar-alt',
				'iconSize'            => 16,
				'bgSize'              => 35,
				'borderWidth'         => 0,
				'connectorWidth'      => 3,
				'iconColor'           => '#333',
				'separatorBg'         => '#eee',
				'separatorBorder'     => '#eee',
				'separatorFillColor'  => '#61ce70',
				'iconFocus'           => '#fff',
				'iconBgFocus'         => '#61ce70',
				'borderFocus'         => '#5cb85c',
				'continuebgColor'     => '',
				'borderColor'         => '',
				'hColor'              => '#333',
				'continuebghColor'    => '',
				'borderHColor'        => '',
				'target'              => true,
				'borderRadius'        => 0,
				'verSpace'            => 0,
				'horSpace'            => 0,
				'stack'               => 'mobile',
				'boxShadowColor'      => '',
				'boxShadowPosition'   => 'outset',
				'boxShadowHOffset'    => 0,
				'boxShadowVOffset'    => 0,
				'boxShadowBlur'       => 0,
				'boxShadowSpread'     => 0,
				'taxonomyType'        => 'category',
				'block_id'            => '',
			);
		}

		/**
		 * Get Pricing list Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_pricing_list_css( $attr, $id ) {
			$defaults = self::get_responsive_block_pricing_list_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$align = $attr['contentAlign'];
			if ( 'left' === $align ) {
				$align = 'flex-start';
			} elseif ( 'right' === $align ) {
				$align = 'flex-end';
			}

			$selectors        = array(
				' .responsive-block-editior-addons-pricing-list-item-wrap' => array(
					'margin-bottom' => self::get_css_value( $attr['rowGap'], 'px' ),
					'padding-left'  => self::get_css_value( $attr['columnGap'] / 2, 'px' ),
					'padding-right' => self::get_css_value( $attr['columnGap'] / 2, 'px' ),
				),
				' .responsive-block-editior-addons-pricing-list-item-wrap .responsive-block-editior-addons-pricing-list-item-content' => array(
					'padding-top'    => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPadding'], 'px' ),
					'text-align'     => $attr['contentAlign'],
				),
				' .responsive-block-editior-addons-pricing-list-item-image-wrap .responsive-block-editior-addons-pricing-list-item-image' => array(
					'height'    => 'auto',
					'width'     => self::get_css_value( $attr['imageWidth'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidth'], 'px' ),
				),
				' .responsive-block-editior-addons-pricing-list-item-title' => array(
					'color'         => $attr['titleColor'],
					'line-height'   => $attr['titleLineHeight'],
					'font-weight'   => $attr['titleFontWeight'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-family'   => $attr['titleFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
				),
				' .responsive-block-editior-addons-pricing-list-item-description' => array(
					'color'       => $attr['descColor'],
					'line-height' => $attr['descriptionLineHeight'],
					'font-weight' => $attr['descriptionFontWeight'],
					'font-size'   => self::get_css_value( $attr['descriptionFontSize'], 'px' ),
					'font-family' => $attr['descriptionFontFamily'],
				),
				' .responsive-block-editior-addons-pricing-list-item-price-wrap' => array(
					'color'       => $attr['priceColor'],
					'line-height' => $attr['priceLineHeight'],
					'font-weight' => $attr['priceFontWeight'],
					'font-size'   => self::get_css_value( $attr['priceFontSize'], 'px' ),
					'font-family' => $attr['priceFontFamily'],
				),
				' .responsive-block-editior-addons-pricing-list-item-image-wrap responsive-block-editior-addons-pricing-list-item-image' => array(
					'height'    => 'auto',
					'width'     => self::get_css_value( $attr['imageWidth'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidth'], 'px' ),
				),
				' .responsive-block-editior-addons-pricing-list-item-separator-wrap' => array(
					'justify-content' => $align,
				),
				' .responsive-block-editior-addons-pricing-list-item-separator' => array(
					'border-top-color' => $attr['seperatorColor'],
					'border-top-style' => $attr['seperatorStyle'],
					'border-top-width' => self::get_css_value( $attr['seperatorThickness'], 'px' ),
					'width'            => $attr['seperatorWidth'] . '%',
				),
			);
			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-pricing-list.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for pricing list block
		 *
		 * @return array
		 */
		public static function get_responsive_block_pricing_list_default_attributes() {
			return array(
				'block_id'              => '',
				'pricingList'           => '',
				'topPadding'            => 5,
				'bottomPadding'         => 5,
				'leftPadding'           => 5,
				'rightPadding'          => 5,
				'rowGap'                => 10,
				'columnGap'             => 10,
				'titleSpace'            => 10,
				'titleFontFamily'       => '',
				'descriptionFontFamily' => '',
				'priceFontFamily'       => '',
				'titleFontSize'         => '',
				'titleFontWeight'       => '',
				'titleLineHeight'       => '',
				'descriptionFontSize'   => '',
				'descriptionFontWeight' => '',
				'descriptionLineHeight' => '',
				'priceFontSize'         => '',
				'priceFontWeight'       => '',
				'priceLineHeight'       => '',
				'seperatorStyle'        => 'dashed',
				'seperatorWidth'        => 100,
				'seperatorThickness'    => 1,
				'seperatorColor'        => '',
				'titleColor'            => '',
				'descColor'             => '',
				'priceColor'            => '',
				'columns'               => 2,
				'count'                 => '',
				'contentAlign'          => 'left',
				'imagePosition'         => 'top',
				'imageAlignment'        => 'middle',
				'imageSize'             => 'medium',
				'imageWidth'            => '',
			);
		}

		/**
		 * Get Pricing table Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_pricing_table_css( $attr, $id ) {
			$defaults = self::get_responsive_block_pricing_table_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];
			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$button_box_shadow_position_css = $attr['buttonBoxShadowPosition'];
			if ( 'outset' === $attr['buttonBoxShadowPosition'] ) {
				$button_box_shadow_position_css = '';
			}

			$imgopacity             = $attr['opacity'] / 100;
			$blockimgopacity        = $attr['blockopacity'] / 100;
			$blockbackcoloropacity  = $attr['blockBackColorOpacity'] / 100;
			$columnbackcoloropacity = $attr['columnBackColorOpacity'] / 100;

			$align_style = 'center';
			if ( 'left' === $attr['blockAlign'] ) {
				$align_style = 'flex-start';
			}
			if ( 'right' === $attr['blockAlign'] ) {
				$align_style = 'flex-end';
			}

			$updated_button_bg_h_color = '';
			$updated_button_bg_h_image = '';
			if ( 'color' === $attr['buttonHbackgroundType'] ) {
				$updated_button_bg_h_color = $attr['ctaHoverBackColor'];
			} elseif ( 'gradient' === $attr['buttonHbackgroundType'] ) {
				$updated_button_bg_h_image = 'linear-gradient(' . $attr['buttonHgradientDirection'] . 'deg, ' . $attr['buttonHbackgroundColor1'] . ' ' . $attr['buttonHcolorLocation1'] . '% , ' . $attr['buttonHbackgroundColor2'] . ' ' . $attr['buttonHcolorLocation2'] . '%)';
			}

			$updated_button_background_color = '';
			$updated_button_background_image = '';
			if ( 'color' === $attr['buttonbackgroundType'] ) {
				$updated_button_background_color = $attr['ctaBackColor'];
			} elseif ( 'gradient' === $attr['buttonbackgroundType'] ) {
				$updated_button_background_image = 'linear-gradient(' . $attr['buttongradientDirection'] . 'deg, ' . $attr['buttonbackgroundColor1'] . ' ' . $attr['buttoncolorLocation1'] . '%, ' . $attr['buttonbackgroundColor2'] . ' ' . $attr['buttoncolorLocation2'] . '%)';
			}

			$selectors = array(
				' .wp-block-responsive-block-editor-addons-pricing-table-item__button' => array(
					'color'            => $attr['ctaColor'] . '!important',
					'display'          => 'block',
					'background-color' => $updated_button_background_color,
					'background-image' => $updated_button_background_image,
					'margin-left'      => 'left' === $attr['blockAlign'] ? 0 : '',
					'margin-right'     => 'right' === $attr['blockAlign'] ? 0 : '',
					'margin-bottom'    => self::get_css_value( $attr['buttonSpace'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['ctaHpadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['ctaHpadding'], 'px' ),
					'padding-top'      => self::get_css_value( $attr['ctaVpadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['ctaVpadding'], 'px' ),
					'border-color'     => $attr['ctaBorderColor'],
					'border-radius'    => self::get_css_value( $attr['ctaBorderRadius'], 'px' ),
					'border-width'     => self::get_css_value( $attr['ctaBorderWidth'], 'px' ),
					'border-style'     => $attr['ctaBorderStyle'],
					'line-height'      => $attr['ctaLineHeight'],
					'font-weight'      => $attr['ctaFontWeight'],
					'font-size'        => self::get_css_value( $attr['ctaFontSize'], 'px' ),
					'font-family'      => $attr['ctaFontFamily'],
					'box-shadow'       =>
						self::get_css_value( $attr['buttonBoxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['buttonBoxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['buttonBoxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['buttonBoxShadowSpread'], 'px' ) .
						' ' .
						$attr['buttonBoxShadowColor'] .
						' ' .
						$button_box_shadow_position_css,
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__button:hover' => array(
					'color'            => $attr['ctaHoverColor'] . '!important',
					'background-color' => $updated_button_bg_h_color,
					'background-image' => $updated_button_bg_h_image,
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item.background-type-image' => array(
					'background-image'      => 'linear-gradient(' .
					self::hex_to_rgb( '#fff', 1 - $imgopacity ) .
					',' .
					self::hex_to_rgb( '#fff', 1 - $imgopacity ) .
					'),' .
					'url(' . $attr['backgroundImage'] . ')',
					'background-position'   => 'center center',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'no-repeat',
					'background-size'       => 'cover',
				),

				'' => array(
					'text-align'       => $attr['blockAlign'],
					'padding-top'      => self::get_css_value( $attr['blockTopPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['blockBottomPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['blockLeftPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['blockRightPadding'], 'px' ),
					'background-color' => 'color' === $attr['blockbackgroundType'] ? self::hex_to_rgb( $attr['blockbackgroundColor'], 0 ) : '',
					'opacity'          => 'color' === $attr['blockbackgroundType'] ? $attr['blockBackColorOpacity'] : 100,
					'background-image' =>
						'gradient' === $attr['blockbackgroundType']
						? self::generate_background_image_effect(
							$attr['blockbackgroundColor1'],
							$attr['blockbackgroundColor2'],
							$attr['blockgradientDirection'],
							$attr['blockcolorLocation1'],
							$attr['blockcolorLocation2']
						)
						: null,
				),

				' .responsive-block-editor-addons-pricing-table-background-image' => array(
					'height'  => '100%',
					'opacity' => $blockimgopacity,
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item' => array(
					'padding-top'      => self::get_css_value( $attr['columnTopPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['columnBottomPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['columnLeftPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['columnRightPadding'], 'px' ),
					'color'            => $attr['textColor'],
					'background-color' => $attr['itemBackgroundColor'],
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'border-color'     => $attr['blockBorderColor'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'background-color' =>
						'color' === $attr['backgroundType']
						? self::hex_to_rgb( $attr['backgroundColor'], $columnbackcoloropacity )
						: '#eee',
					'background-image' =>
						'gradient' === $attr['backgroundType']
						? self::generate_background_image_effect(
							self::hex_to_rgb(
								$attr['backgroundColor1'],
								$columnbackcoloropacity
							),
							self::hex_to_rgb(
								$attr['backgroundColor2'],
								$columnbackcoloropacity
							),
							$attr['gradientDirection'],
							$attr['colorLocation1'],
							$attr['colorLocation2']
						)
						: null,
					'box-shadow'       =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__title' => array(
					'color'         => $attr['titleColor'],
					'line-height'   => $attr['titleLineHeight'],
					'font-weight'   => $attr['titleFontWeight'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-family'   => $attr['titleFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['titleSpace'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__price-wrapper' => array(
					'margin-bottom'   => self::get_css_value( $attr['priceSpace'], 'px' ),
					'justify-content' => $align_style,
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__currency' => array(
					'color'       => $attr['prefixColor'],
					'line-height' => $attr['prefixLineHeight'],
					'font-weight' => $attr['prefixFontWeight'],
					'font-size'   => self::get_css_value( $attr['prefixFontSize'], 'px' ),
					'font-family' => $attr['prefixFontFamily'],
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__amount' => array(
					'color'       => $attr['priceColor'],
					'line-height' => $attr['amountLineHeight'],
					'font-weight' => $attr['amountFontWeight'],
					'font-size'   => self::get_css_value( $attr['amountFontSize'], 'px' ),
					'font-family' => $attr['amountFontFamily'],
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__price_suffix' => array(
					'color'       => $attr['suffixColor'],
					'line-height' => $attr['suffixLineHeight'],
					'font-weight' => $attr['suffixFontWeight'],
					'font-size'   => self::get_css_value( $attr['suffixFontSize'], 'px' ),
					'font-family' => $attr['suffixFontFamily'],
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__sub_price' => array(
					'color'          => $attr['subpriceColor'],
					'line-height'    => $attr['subpriceLineHeight'],
					'text-transform' => $attr['subpriceTextTransform'],
					'font-weight'    => $attr['subpriceFontWeight'],
					'font-size'      => self::get_css_value( $attr['subpriceFontSize'], 'px' ),
					'font-family'    => $attr['subpriceFontFamily'],
					'margin-bottom'  => self::get_css_value( $attr['subpriceSpace'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-pricing-table-item__features' => array(
					'color'         => $attr['featuresColor'],
					'line-height'   => $attr['featuresLineHeight'],
					'font-weight'   => $attr['featuresFontWeight'],
					'font-size'     => self::get_css_value( $attr['featuresFontSize'], 'px' ),
					'font-family'   => $attr['featuresFontFamily'],
					'margin-bottom' => self::get_css_value( $attr['featuresSpace'], 'px' ),
				),

			);

			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-pricing-table.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for pricing table block
		 *
		 * @return array
		 */
		public static function get_responsive_block_pricing_table_default_attributes() {
			return array(
				'block_id'                 => '',
				'pricingTable'             => '',
				'blockId'                  => '',
				'count'                    => 2,
				'gutter'                   => 'medium',
				'contentAlign'             => 'center',
				'textColor'                => '',
				'titleColor'               => '',
				'prefixColor'              => '',
				'priceColor'               => '',
				'suffixColor'              => '',
				'subpriceColor'            => '',
				'featuresColor'            => '',
				'itemBackgroundColor'      => '',
				'blockBorderStyle'         => 'none',
				'blockBorderWidth'         => 1,
				'blockBorderRadius'        => 0,
				'blockBorderColor'         => '',
				'sectionTag'               => 'section',
				'opacity'                  => 30,
				'blockBackColorOpacity'    => 100,
				'columnBackColorOpacity'   => 100,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'gradientDirection'        => 90,
				'backgroundImage'          => '',
				'backgroundColor'          => '',
				'backgroundColor1'         => '',
				'backgroundColor2'         => '#fff',
				'backgroundType'           => 'none',
				'blockopacity'             => '30',
				'blockcolorLocation1'      => 0,
				'blockcolorLocation2'      => 100,
				'blockgradientDirection'   => 90,
				'blockbackgroundImage'     => '',
				'blockbackgroundColor'     => '',
				'blockbackgroundColor1'    => '',
				'blockbackgroundColor2'    => '#fff',
				'blockbackgroundType'      => 'none',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'buttonBoxShadowColor'     => '',
				'buttonBoxShadowHOffset'   => 0,
				'buttonBoxShadowVOffset'   => 0,
				'buttonBoxShadowBlur'      => 0,
				'buttonBoxShadowSpread'    => 0,
				'buttonBoxShadowPosition'  => 'outset',
				'ctaColor'                 => '#ffffff',
				'ctaBackColor'             => '#3f46ae',
				'ctaHoverColor'            => '#ffffff',
				'ctaHoverBackColor'        => '#3f46ae',
				'ctaBorderColor'           => '#333',
				'ctaBorderStyle'           => 'none',
				'ctaBorderRadius'          => 0,
				'ctaBorderWidth'           => 2,
				'ctaHpadding'              => 30,
				'ctaVpadding'              => 15,
				'buttonbackgroundType'     => 'color',
				'buttoncolorLocation1'     => 0,
				'buttoncolorLocation2'     => 100,
				'buttongradientDirection'  => 90,
				'buttonbackgroundColor1'   => '',
				'buttonbackgroundColor2'   => '#fff',
				'buttonHbackgroundType'    => 'color',
				'buttonHcolorLocation1'    => 0,
				'buttonHcolorLocation2'    => 100,
				'buttonHgradientDirection' => 90,
				'buttonHbackgroundColor1'  => '',
				'buttonHbackgroundColor2'  => '#fff',
				'titleFontFamily'          => '',
				'amountFontFamily'         => '',
				'prefixFontFamily'         => '',
				'suffixFontFamily'         => '',
				'subpriceFontFamily'       => '',
				'featuresFontFamily'       => '',
				'ctaFontFamily'            => '',
				'titleFontSize'            => '',
				'titleFontWeight'          => '',
				'titleLineHeight'          => '',
				'amountFontSize'           => '',
				'amountFontWeight'         => '',
				'amountLineHeight'         => '',
				'subpriceFontSize'         => '',
				'subpriceFontWeight'       => '',
				'subpriceLineHeight'       => '',
				'subpriceTextTransform'    => 'uppercase',
				'prefixFontSize'           => '',
				'prefixFontWeight'         => '',
				'prefixLineHeight'         => '',
				'suffixFontSize'           => '',
				'suffixFontWeight'         => '',
				'suffixLineHeight'         => '',
				'featuresFontSize'         => '',
				'featuresFontWeight'       => '',
				'featuresLineHeight'       => '',
				'ctaFontSize'              => '',
				'ctaFontWeight'            => '',
				'ctaLineHeight'            => '',
				'blockTopPadding'          => 0,
				'blockBottomPadding'       => 0,
				'blockLeftPadding'         => 0,
				'blockRightPadding'        => 0,
				'columnTopPadding'         => 64,
				'columnBottomPadding'      => 64,
				'columnLeftPadding'        => 24,
				'columnRightPadding'       => 24,
				'showImage'                => true,
				'showTitle'                => true,
				'showPrefix'               => true,
				'showPrice'                => true,
				'showSuffix'               => true,
				'showSubprice'             => true,
				'showFeatures'             => true,
				'showButton'               => true,
				'buttonTarget'             => false,
				'titleSpace'               => '',
				'priceSpace'               => '',
				'subpriceSpace'            => 0,
				'buttonSpace'              => '',
				'featuresSpace'            => '',
				'blockAlign'               => 'center',
				'imageWidth'               => '',
				'imageSize'                => 'full',
				'imageShape'               => '',
			);
		}

		/**
		 * Get Section Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_section_css( $attr, $id ) {
			$defaults = self::get_responsive_block_section_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}
			$imgopacity = $attr['opacity'] / 100;

			$background_image_effect  = '';
			$updated_background_image = '';

			$color_type = '';
			if ( 'color' === $attr['overlayType'] ) {
				$color_type = self::hex_to_rgb(
					$attr['backgroundImageColor'],
					$imgopacity
				);

				if ( $attr['backgroundImage'] ) {
					$updated_background_image = 'linear-gradient(' .
					self::hex_to_rgb( $attr['backgroundImageColor'], $imgopacity ) .
					',' .
					self::hex_to_rgb( $attr['backgroundImageColor'], $imgopacity ) .
					'),url(' .
					$attr['backgroundImage'] .
					')';
				}
				$background_image_effect = '';
			} else {
				if ( 'linear' === $attr['gradientOverlayType'] ) {
					$background_image_effect = 'linear-gradient(' .
					$attr['gradientOverlayAngle'] .
					'deg,' .
					self::hex_to_rgb( $attr['gradientOverlayColor1'], $imgopacity ) .
					$attr['gradientOverlayLocation1'] .
					'% ,' .
					self::hex_to_rgb( $attr['gradientOverlayColor2'], $imgopacity ) .
					$attr['gradientOverlayLocation2'] .
					'% ),url(' .
					$attr['backgroundImage'] .
					')';
				}
				if ( 'radial' === $attr['gradientOverlayType'] ) {
					$background_image_effect = 'radial-gradient(' .
					'at ' . $attr['gradientOverlayPosition'] . ', ' .
					self::hex_to_rgb( $attr['gradientOverlayColor1'], $imgopacity ) .
					$attr['gradientOverlayLocation1'] .
					'% ,' .
					self::hex_to_rgb( $attr['gradientOverlayColor2'], $imgopacity ) .
					$attr['gradientOverlayLocation2'] .
					'% ),url(' .
					$attr['backgroundImage'] .
					')';
				}
			}

			$selectors = array(
				' > .responsive-block-editor-addons-block-section' => array(
					'margin-top'       => self::get_css_value( $attr['topMargin'], 'px' ),
					'margin-bottom'    => self::get_css_value( $attr['bottomMargin'], 'px' ),
					'margin-left'      => self::get_css_value( $attr['leftMargin'], 'px' ),
					'margin-right'     => self::get_css_value( $attr['rightMargin'], 'px' ),
					'padding-top'      => self::get_css_value( $attr['topPadding'], 'px' ),
					'padding-bottom'   => self::get_css_value( $attr['bottomPadding'], 'px' ),
					'padding-left'     => self::get_css_value( $attr['leftPadding'], 'px' ),
					'padding-right'    => self::get_css_value( $attr['rightPadding'], 'px' ),
					'background-color' => $color_type,
					'background-image' => $background_image_effect,
				),
				' > .responsive-section-wrap > .responsive-section-inner-wrap' => array(
					'max-width' => 'full' === $attr['align'] ? self::get_css_value( $attr['innerWidth'], 'px' ) : '',
					'z-index'   => $attr['z_index'],
				),
				' .background-type-video'     => array(
					'background-color' => self::hex_to_rgb(
						$attr['backgroundColor'],
						$imgopacity
					),
				),
				' > .responsive-section-wrap' => array(
					'background-image'      => $updated_background_image,
					'background-position'   => $attr['backgroundPosition'],
					'background-attachment' => $attr['backgroundAttachment'],
					'background-repeat'     => $attr['backgroundRepeat'],
					'background-size'       => $attr['backgroundSize'],
					'border-radius'         => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'z-index'               => $attr['z_index'],
					'max-width'             => 'full' !== $attr['align'] ? self::get_css_value( $attr['width'], 'px' ) : '',
					'margin-left'           => 'full' !== $attr['align'] ? 'auto' : '',
					'margin-right'          => 'full' !== $attr['align'] ? 'auto' : '',
				),
				' > .responsive-section-wrap.responsive-block-editor-addons-block-section' => array(
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'border-color'     => $attr['blockBorderColor'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'background-color' =>
						'color' === $attr['backgroundType']
						? self::hex_to_rgb( $attr['backgroundColor'], $imgopacity )
						: '',
					'background-image' =>
						'gradient' === $attr['backgroundType']
						? self::generate_background_image_effect(
							self::hex_to_rgb( $attr['backgroundColor1'], $imgopacity ),
							self::hex_to_rgb( $attr['backgroundColor2'], $imgopacity ),
							$attr['gradientDirection'],
							$attr['colorLocation1'],
							$attr['colorLocation2']
						)
						: '',
					'box-shadow'       =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),
			);

			$mobile_selectors = array(
				' > .responsive-block-editor-addons-block-section' => array(
					'margin-top'     => self::get_css_value( $attr['topMarginMobile'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginMobile'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['leftMarginMobile'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['rightMarginMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['topPaddingMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingMobile'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingMobile'], 'px' ),
				),
				' > .responsive-section-wrap > .responsive-section-inner-wrap' => array(
					'max-width' =>
						'full' === $attr['align'] ? self::get_css_value( $attr['innerWidthMobile'], 'px' ) : '',
				),
				' > .responsive-section-wrap' => array(
					'background-position' => $attr['backgroundPositionMobile'],
					'background-size'     => '' === $attr['backgroundSizeMobile'] ? $attr['backgroundSize'] : $attr['backgroundSizeMobile'],
				),
			);

			$tablet_selectors = array(
				' > .responsive-block-editor-addons-block-section' => array(
					'margin-top'     => self::get_css_value( $attr['topMarginTablet'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['bottomMarginTablet'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['leftMarginTablet'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['rightMarginTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['topPaddingTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['bottomPaddingTablet'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['leftPaddingTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['rightPaddingTablet'], 'px' ),
				),
				' > .responsive-section-wrap > .responsive-section-inner-wrap' => array(
					'max-width' =>
						'full' === $attr['align'] ? self::get_css_value( $attr['innerWidthTablet'], 'px' ) : '',
				),
				' > .responsive-section-wrap' => array(
					'background-position' => $attr['backgroundPositionTablet'],
					'background-size'     => '' === $attr['backgroundSizeTablet'] ? $attr['backgroundSize'] : $attr['backgroundSizeTablet'],
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id              = '.responsive-block-editor-addons-block-section-outer-wrap.block-' . $id;
			$css             = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			$css['desktop'] .= '
            .responsive-block-editor-addons-section__video-wrap {
                border-radius:' . $attr['blockBorderRadius'] . 'px;
              }
            .page.page-template-gutenberg-fullwidth .alignfull' . $id . ' > .responsive-section-wrap > .responsive-section-inner-wrap{
                max-width:' . ( 'full' === $attr['align'] ? self::get_css_value( $attr['innerWidth'], 'px' ) : ' ' ) . ' ;}

                .page.page-template-gutenberg-fullwidth .alignfull ' . $id . '{
                max-width:' . ( 'full' !== $attr['align'] ? self::get_css_value( $attr['width'], 'px' ) . ' !important' : ' ' ) . ' ;
                margin-left:' . ( 'full' !== $attr['align'] ? 'auto' : ' ' ) . ' ;
                margin-right:' . ( 'full' !== $attr['align'] ? 'auto' : ' ' ) . ' ;
                }
            ';
			$css['tablet']  .= '
            .page.page-template-gutenberg-fullwidth .alignfull' . $id . ' > .responsive-section-wrap > .responsive-section-inner-wrap{
                max-width:' . ( 'full' === $attr['align'] ? self::get_css_value( $attr['innerWidthTablet'], 'px' ) : ' ' ) . ' ;}
            ';
			$css['mobile']  .= '
            .page.page-template-gutenberg-fullwidth .alignfull' . $id . ' > .responsive-section-wrap > .responsive-section-inner-wrap{
                max-width:' . ( 'full' === $attr['align'] ? self::get_css_value( $attr['innerWidthMobile'], 'px' ) : ' ' ) . ' ;}
            ';

			return $css;
		}

		/**
		 * Get Defaults for section block
		 *
		 * @return array
		 */
		public static function get_responsive_block_section_default_attributes() {
			return array(
				'block_id'                 => '',
				'blockId'                  => '',
				'align'                    => '',
				'width'                    => 900,
				'innerWidth'               => 1140,
				'innerWidthTablet'         => 1140,
				'innerWidthMobile'         => 1140,
				'innerWidthType'           => 'px',
				'themeWidth'               => false,
				'topPadding'               => 10,
				'topPaddingMobile'         => 10,
				'topPaddingTablet'         => 10,
				'bottomPadding'            => 10,
				'bottomPaddingMobile'      => 10,
				'bottomPaddingTablet'      => 10,
				'leftPadding'              => 10,
				'leftPaddingMobile'        => 10,
				'leftPaddingTablet'        => 10,
				'rightPadding'             => 10,
				'rightPaddingMobile'       => 10,
				'rightPaddingTablet'       => 10,
				'topMargin'                => 0,
				'bottomMargin'             => 0,
				'leftMargin'               => 0,
				'rightMargin'              => 0,
				'topMarginTablet'          => 0,
				'bottomMarginTablet'       => 0,
				'leftMarginTablet'         => 0,
				'rightMarginTablet'        => 0,
				'topMarginMobile'          => 0,
				'bottomMarginMobile'       => 0,
				'leftMarginMobile'         => 0,
				'rightMarginMobile'        => 0,
				'blockBorderStyle'         => 'none',
				'blockBorderWidth'         => 1,
				'blockBorderRadius'        => 0,
				'blockBorderColor'         => '#000',
				'sectionTag'               => 'section',
				'opacity'                  => 20,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'gradientDirection'        => 90,
				'backgroundImage'          => '',
				'backgroundPosition'       => 'center-center',
				'backgroundPositionTablet' => 'center center',
				'backgroundPositionMobile' => 'center center',
				'backgroundSize'           => 'cover',
				'backgroundSizeTablet'     => 'cover',
				'backgroundSizeMobile'     => 'cover',
				'backgroundRepeat'         => 'no-repeat',
				'backgroundAttachment'     => 'scroll',
				'backgroundImageColor'     => '#fff',
				'overlayType'              => 'color',
				'gradientOverlayColor1'    => '#fff',
				'gradientOverlayColor2'    => '#fff',
				'gradientOverlayType'      => 'linear',
				'gradientOverlayLocation1' => 0,
				'gradientOverlayLocation2' => 100,
				'gradientOverlayAngle'     => 0,
				'gradientOverlayPosition'  => 'center center',
				'backgroundVideo'          => '',
				'backgroundColor'          => '#fff',
				'backgroundColor1'         => '#fff',
				'backgroundColor2'         => '#fff',
				'backgroundType'           => 'none',
				'boxShadowColor'           => '#fff',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'z_index'                  => 1,
			);
		}

		/**
		 * Get Shape divider Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_shape_divider_css( $attr, $id ) {
			$defaults = self::get_responsive_block_shape_divider_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$updated_background_color = null;
			if ( 'color' === $attr['backgroundType'] && null !== $attr['backgroundColor'] ) {
				$updated_background_color = $attr['backgroundColor'];
			}

			$updated_background_image = null;
			if ( 'gradient' === $attr['backgroundType'] ) {
				$updated_background_image = self::generate_background_image_effect( $attr['backgroundColor1'], $attr['backgroundColor2'], $attr['gradientDirection'], $attr['colorLocation1'], $attr['colorLocation2'] );
			}

			$selectors = array(
				'' => array(
					'background-color' => $updated_background_color,
					'background-image' => $updated_background_image,
					'color'            => $attr['customColor'],
				),

				' .wp-block-responsive-block-editor-addons-shape-divider__svg-wrapper' => array(
					'min-height' => self::get_css_value( $attr['shapeHeight'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-shape-divider__alt-wrapper' => array(
					'min-height' => self::get_css_value( $attr['backgroundHeight'], 'px' ),
				),
			);
			$mobile_selectors = array(
				' .wp-block-responsive-block-editor-addons-shape-divider__svg-wrapper' => array(
					'min-height' => $attr['shapeHeightMobile'] ? self::get_css_value( $attr['shapeHeightMobile'], 'px' ) : self::get_css_value( $attr['shapeHeight'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-shape-divider__alt-wrapper' => array(
					'min-height' => $attr['backgroundHeightMobile'] ? self::get_css_value( $attr['backgroundHeightMobile'], 'px' ) : self::get_css_value( $attr['backgroundHeight'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .wp-block-responsive-block-editor-addons-shape-divider__svg-wrapper' => array(
					'min-height' => $attr['shapeHeightTablet'] ? self::get_css_value( $attr['shapeHeightTablet'], 'px' ) : self::get_css_value( $attr['shapeHeight'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-shape-divider__alt-wrapper' => array(
					'min-height' => $attr['backgroundHeightTablet'] ? self::get_css_value( $attr['backgroundHeightTablet'], 'px' ) : self::get_css_value( $attr['backgroundHeight'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-shape-divider.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for shape divider block
		 *
		 * @return array
		 */
		public static function get_responsive_block_shape_divider_default_attributes() {
			return array(
				'block_id'               => '',
				'align'                  => 'full',
				'height'                 => 100,
				'heightTablet'           => '',
				'heightMobile'           => '',
				'shapeHeight'            => 100,
				'shapeHeightTablet'      => 0,
				'shapeHeightMobile'      => 0,
				'backgroundHeight'       => 50,
				'backgroundHeightTablet' => '',
				'backgroundHeightMobile' => '',
				'syncHeight'             => true,
				'syncHeightAlt'          => true,
				'verticalFlip'           => false,
				'horizontalFlip'         => false,
				'color'                  => '',
				'customColor'            => '',
				'backgroundColor'        => '#fff',
				'customBackgroundColor'  => '#fff',
				'noBottomMargin'         => true,
				'noTopMargin'            => true,
				'justAdded'              => true,
				'colorLocation1'         => 0,
				'colorLocation2'         => 100,
				'gradientDirection'      => 90,
				'backgroundColor1'       => '#fff',
				'backgroundColor2'       => '#fff',
				'backgroundType'         => 'none',
			);
		}

		/**
		 * Get Spacer Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_spacer_css( $attr, $id ) {
			$defaults = self::get_responsive_block_spacer_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors = array(
				' .responsive-block-editor-addons-spacer' => array(
					'height' => self::get_css_value( $attr['height'], 'px' ),
				),
			);

			$mobile_selectors = array(
				' .responsive-block-editor-addons-spacer' => array(
					'height' => self::get_css_value( $attr['heightMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-spacer' => array(
					'height' => self::get_css_value( $attr['heightTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '';
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for spacer block
		 *
		 * @return array
		 */
		public static function get_responsive_block_spacer_default_attributes() {
			return array(
				'height'       => 100,
				'heightTablet' => 100,
				'heightMobile' => 100,
			);
		}

		/**
		 * Get Team Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_team_css( $attr, $id ) {
			$defaults = self::get_responsive_block_team_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$bgopacity = $attr['opacity'] / 100;

			$tempsecondary_background_color = $attr['bgGradient'] ? $attr['secondaryBackgroundColor'] : $attr['backgroundColor'];

			$bggradient = 'linear-gradient(' .
			$attr['gradientDegree'] .
			'deg,' .
			self::hex_to_rgb( $attr['backgroundColor'] ? $attr['backgroundColor'] : '#ffffff', $bgopacity ? $bgopacity : 0 ) .
			$attr['colorLocation1'] .
			'% ,' .
			self::hex_to_rgb( $tempsecondary_background_color ? $tempsecondary_background_color : '#ffffff', $bgopacity ? $bgopacity : 0 ) .
			$attr['colorLocation2'] .
			'% )';

			if ( $attr['backgroundImage'] ) {
				$bggradient = 'linear-gradient(' .
				$attr['gradientDegree'] .
				'deg,' .
				self::hex_to_rgb( $attr['backgroundColor'] ? $attr['backgroundColor'] : '#ffffff', $bgopacity ? $bgopacity : 0 ) .
				$attr['colorLocation1'] .
				'% ,' .
				self::hex_to_rgb( $tempsecondary_background_color ? $tempsecondary_background_color : '#ffffff', $bgopacity ? $bgopacity : 0 ) .
				$attr['colorLocation2'] .
				'% ),url(' .
				$attr['backgroundImage'] .
				')';
			}

			$box_shadow_position_css = $attr['boxShadowPosition'];

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$gutter_margin = '';
			if ( $attr['count'] > 1 ) {
				if ( 'small' === $attr['gutter'] ) {
					$gutter_margin = '20px';
				} elseif ( 'medium' === $attr['gutter'] ) {
					$gutter_margin = '30px';
				} elseif ( 'large' === $attr['gutter'] ) {
					$gutter_margin = '40px';
				} elseif ( 'huge' === $attr['gutter'] ) {
					$gutter_margin = '50px';
				} else {
					$gutter_margin = '';
				}
			}

			$selectors = array(
				' .responsive-block-editor-addons-team-avatar-wrapper' => array(
					'text-align' => $attr['alignment'],
					'text-align' => '-webkit-' . $attr['alignment'],
				),

				' .responsive-block-editor-addons-team-avatar' => array(
					'width'         => self::get_css_value( $attr['imageWidth'], 'px' ),
					'height'        => self::get_css_value( $attr['imageWidth'], 'px' ),
					'margin-top'    => self::get_css_value( $attr['imageMarginTop'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['imageMarginBottom'], 'px' ),
					'text-align'    => 'justify',
				),

				' .responsive-block-editor-addons-team-name'   => array(
					'color'         => $attr['titleColor'],
					'font-family'   => $attr['titleFontFamily'],
					'font-size'     => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'font-weight'   => $attr['titleFontWeight'],
					'line-height'   => $attr['titleLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['titleSpacing'], 'px' ),
				),

				' .responsive-block-editor-addons-team-designation' => array(
					'color'         => $attr['designationColor'],
					'font-family'   => $attr['designationFontFamily'],
					'font-size'     => self::get_css_value( $attr['designationFontSize'], 'px' ),
					'font-weight'   => $attr['designationFontWeight'],
					'line-height'   => $attr['designationLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['designationSpacing'], 'px' ),
				),

				' .responsive-block-editor-addons-team-description' => array(
					'color'         => $attr['descriptionColor'],
					'font-family'   => $attr['descriptionFontFamily'],
					'font-size'     => self::get_css_value( $attr['descriptionFontSize'], 'px' ),
					'font-weight'   => $attr['descriptionFontWeight'],
					'line-height'   => $attr['descriptionLineHeight'],
					'margin-bottom' => self::get_css_value( $attr['descriptionSpacing'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons a' => array(
					'margin-left'  => self::get_css_value( $attr['socialIconSpacing'], 'px' ),
					'margin-right' => self::get_css_value( $attr['socialIconSpacing'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-twitter' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-facebook' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-linkedin' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-instagram' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-email' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-youtube' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .responsive-block-editor-addons-team-social-icons .dashicons.dashicons-pinterest' => array(
					'color'           => $attr['socialIconColor'],
					'font-size'       => self::get_css_value( $attr['iconSize'], 'px' ),
					'text-decoration' => 'none',
					'height'          => self::get_css_value( $attr['iconSize'], 'px' ),
					'width'           => self::get_css_value( $attr['iconSize'], 'px' ),
				),

				' .wp-block-responsive-block-editor-addons-team' => array(
					'background-image'      => $bggradient,
					'background-size'       => $attr['backgroundSize'],
					'background-repeat'     => $attr['backgroundRepeat'],
					'background-position'   => $attr['backgroundPosition'],
					'background-attachment' => $attr['backgroundAttachment'],
					'border-width'          => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-color'          => $attr['borderColor'],
					'border-radius'         => self::get_css_value( $attr['borderRadius'], 'px' ),
					'padding'               => self::get_css_value( $attr['padding'], 'px' ),
					'text-align'            => $attr['alignment'],
					'box-shadow'            =>
						self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
						' ' .
						self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
						' ' .
						$attr['boxShadowColor'] .
						' ' .
						$box_shadow_position_css,
				),
			);

			$mobile_selectors = array(
				' .wp-block-responsive-block-editor-addons-team' => array(
					'margin-bottom' => $gutter_margin,
				),
				' .responsive-block-editor-addons-team-avatar' => array(
					'width'     => self::get_css_value( $attr['imageWidthMobile'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidthMobile'], 'px' ),
					'height'    => self::get_css_value( $attr['imageWidthMobile'], 'px' ),
				),
				'.has-columns.has-responsive-columns.responsive-team-block-columns__stack-mobile > *:not(.block-editor-inner-blocks)' => array(
					'max-width' => '100%',
					'min-width' => '100%',
				),
			);

			$tablet_selectors = array(
				' .wp-block-responsive-block-editor-addons-team' => array(
					'margin-bottom' => $gutter_margin,
				),
				' .responsive-block-editor-addons-team-avatar' => array(
					'width'     => self::get_css_value( $attr['imageWidthTablet'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidthTablet'], 'px' ),
					'height'    => self::get_css_value( $attr['imageWidthTablet'], 'px' ),
				),
				'.has-columns.has-responsive-columns.responsive-team-block-columns__stack-tablet > *:not(.block-editor-inner-blocks)' => array(
					'max-width' => '100%',
					'min-width' => '100%',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.wp-block-responsive-block-editor-addons-team-wrapper.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for team block
		 *
		 * @return array
		 */
		public static function get_responsive_block_team_default_attributes() {
			return array(
				'block_id'                 => '',
				'teamBlock'                => 'teamBlock',
				'teamImgURL'               => '',
				'counterId'                => '1',
				'count'                    => 2,
				'gutter'                   => 'medium',
				'designationColor'         => '',
				'descriptionColor'         => '',
				'socialIconColor'          => '#0066CC',
				'titleColor'               => '',
				'titleFontWeight'          => '',
				'designationFontWeight'    => '',
				'descriptionFontWeight'    => '',
				'titleLineHeight'          => '',
				'designationLineHeight'    => '',
				'descriptionLineHeight'    => '',
				'imageSize'                => 'full',
				'titleFontFamily'          => '',
				'designationFontFamily'    => '',
				'descriptionFontFamily'    => '',
				'titleFontSize'            => 23,
				'designationFontSize'      => 15,
				'descriptionFontSize'      => 15,
				'socialIconFontSize'       => 23,
				'imageMarginTop'           => '',
				'imageMarginBottom'        => '',
				'iconSize'                 => '',
				'titleSpacing'             => '',
				'designationSpacing'       => '',
				'descriptionSpacing'       => '',
				'socialIconSpacing'        => '',
				'imageStyle'               => '0%',
				'imageWidth'               => 120,
				'imageWidthMobile'         => 120,
				'imageWidthTablet'         => 120,
				'backgroundColor'          => '',
				'borderColor'              => '',
				'borderWidth'              => 2,
				'borderRadius'             => 2,
				'padding'                  => 2,
				'alignment'                => 'center',
				'imageShape'               => '',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'opacity'                  => 50,
				'secondaryBackgroundColor' => '',
				'gradientDegree'           => 100,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'bgGradient'               => '',
				'backgroundImage'          => '',
				'backgroundPosition'       => 'center center',
				'backgroundRepeat'         => 'no-repeat',
				'backgroundSize'           => 'cover',
				'backgroundAttachment'     => 'scroll',
				'showImage'                => true,
				'showName'                 => true,
				'showDesignation'          => true,
				'showDescription'          => true,
				'showSocialIcons'          => true,
				'facebook'                 => '',
				'twitter'                  => '',
				'linkedin'                 => '',
				'instagram'                => '',
				'email'                    => '',
				'youtube'                  => '',
				'pinterest'                => '',
				'stack'                    => 'mobile',
			);
		}

		/**
		 * Get testimonial Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_testimonial_css( $attr, $id ) {
			$defaults = self::get_responsive_block_testimonial_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css      = $attr['boxShadowPosition'];
			$hoverbox_shadow_position_css = $attr['hoverboxShadowPosition'];

			$bgimage                        = $attr['backgroundImage'] ? $attr['backgroundImage'] : '';
			$tempsecondary_background_color = $attr['bgGradient']
			? $attr['secondaryBackgroundColor']
			: $attr['testimonialBackgroundColor'];
			$bggradient                     =
			'linear-gradient(' .
			$attr['gradientDegree'] .
			'deg,' .
			self::hex_to_rgb( $attr['testimonialBackgroundColor'], $attr['opacity'] ) .
			',' .
			self::hex_to_rgb( $tempsecondary_background_color, $attr['opacity'] ) .
			'),url(' .
			$bgimage .
			')';

			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			if ( 'outset' === $attr['hoverboxShadowPosition'] ) {
				$hoverbox_shadow_position_css = '';
			}

			$selectors = array(
				' .wp-block-responsive-block-editor-addons-testimonial:last-child' => array(
					'margin-bottom' => '0 !important',
				),
				' .responsive-block-editor-addons-testimonial-text' => array(
					'text-align'     => $attr['testimonialAlignment'],
					'font-family'    => $attr['contentFontFamily'],
					'font-size'      => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'line-height'    => $attr['contentLineHeight'],
					'font-weight'    => $attr['contentFontWeight'],
					'text-transform' => $attr['contentTextTransform'],
					'margin-bottom'  => self::get_css_value( $attr['contentSpacing'], 'px' ),
					'color'          => $attr['testimonialTextColor'],
				),
				' .responsive-block-editor-addons-testimonial-info' => array(
					'margin-bottom' => self::get_css_value( $attr['titleSpacing'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial-info .responsive-block-editor-addons-testimonial-inner-block .responsive-block-editor-addons-testimonial-avatar-wrap' => array(
					'padding-right' => self::get_css_value( $attr['imageSpacing'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial-info .responsive-block-editor-addons-testimonial-inner-block .responsive-block-editor-addons-testimonial-avatar-wrap .responsive-block-editor-addons-testimonial-image-wrap' => array(
					'height' => self::get_css_value( $attr['imageWidth'], 'px' ),
					'width'  => self::get_css_value( $attr['imageWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial-avatar' => array(
					'height' => self::get_css_value( $attr['imageWidth'], 'px' ),
					'width'  => self::get_css_value( $attr['imageWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial-details .responsive-block-editor-addons-testimonial-name' => array(
					'color'          => $attr['testimonialNameColor'],
					'font-family'    => $attr['nameFontFamily'],
					'font-size'      => self::get_css_value( $attr['nameFontSize'], 'px' ),
					'line-height'    => $attr['nameLineHeight'],
					'font-weight'    => $attr['nameFontWeight'],
					'text-transform' => $attr['nameTextTransform'],
					'margin-bottom'  => self::get_css_value( $attr['nameSpacing'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial-details .responsive-block-editor-addons-testimonial-title' => array(
					'color'          => $attr['testimonialTitleColor'],
					'font-family'    => $attr['titleFontFamily'],
					'font-size'      => self::get_css_value( $attr['titleFontSize'], 'px' ),
					'line-height'    => $attr['titleLineHeight'],
					'font-weight'    => $attr['titleFontWeight'],
					'text-transform' => $attr['titleTextTransform'],
				),
				' .testimonial-box.responsive-block-editor-addons-block-testimonial' => array(
					'box-shadow' =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
					'padding'    => self::get_css_value( $attr['padding'], 'px' ),
				),
				' .responsive-block-editor-addons-block-testimonial:hover' => array(
					'box-shadow' =>
					self::get_css_value( $attr['hoverboxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['hoverboxShadowSpread'], 'px' ) .
					' ' .
					$attr['hoverboxShadowColor'] .
					' ' .
					$hoverbox_shadow_position_css,
				),
				' .responsive-block-editor-addons-block-testimonial' => array(
					'background-image'    => $bggradient,
					'background-size'     => $attr['backgroundSize'],
					'background-repeat'   => $attr['backgroundRepeat'],
					'background-position' => $attr['backgroundPosition'],
					'color'               => $attr['testimonialTextColor'],
					'border-style'        => $attr['borderStyle'],
					'border-width'        => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-radius'       => self::get_css_value( $attr['borderRadius'], 'px' ),
					'border-color'        => $attr['borderColor'],
				),

			);
			$mobile_selectors = array(
				' .testimonial-box.responsive-block-editor-addons-block-testimonial' => array(
					'padding' => self::get_css_value( $attr['paddingMobile'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-testimonial:last-child' => array(
					'margin-bottom' => '0 !important',
				),
			);

			$tablet_selectors = array(
				' .testimonial-box.responsive-block-editor-addons-block-testimonial' => array(
					'padding' => self::get_css_value( $attr['paddingTablet'], 'px' ),
				),
				' .wp-block-responsive-block-editor-addons-testimonial:last-child' => array(
					'margin-bottom' => self::get_css_value( 20, 'px' ) . ' !important',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-testimonial.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for testimonial block
		 *
		 * @return array
		 */
		public static function get_responsive_block_testimonial_default_attributes() {
			return array(
				'block_id'                   => '',
				'testimonialBlock'           => '',
				'counterId'                  => '',
				'count'                      => '',
				'gutter'                     => 'medium',
				'testimonialAlignment'       => '',
				'testimonialBackgroundColor' => '#f2f2f2',
				'testimonialTextColor'       => '',
				'testimonialNameColor'       => '',
				'testimonialTitleColor'      => '',
				'titleFontSize'              => '',
				'titleLineHeight'            => '',
				'titleFontWeight'            => '',
				'titleTextTransform'         => '',
				'nameFontSize'               => '',
				'nameLineHeight'             => '',
				'imageWidth'                 => '',
				'nameFontFamily'             => '',
				'titleFontFamily'            => '',
				'contentFontFamily'          => '',
				'nameFontWeight'             => '',
				'nameTextTransform'          => '',
				'contentFontSize'            => '',
				'contentLineHeight'          => 1.6,
				'contentFontWeight'          => '',
				'contentTextTransform'       => '',
				'testimonialCiteAlign'       => 'left-aligned',
				'backgroundColor'            => '#f2f2f2',
				'borderStyle'                => 'none',
				'borderWidth'                => 1,
				'borderColor'                => '',
				'borderRadius'               => 2,
				'padding'                    => 20,
				'paddingTablet'              => 20,
				'paddingMobile'              => 20,
				'contentSpacing'             => 8,
				'titleSpacing'               => '',
				'nameSpacing'                => -5,
				'imageSpacing'               => '',
				'alignment'                  => 'center',
				'imageShape'                 => '',
				'imageSize'                  => 'full',
				'boxShadowColor'             => '#fff',
				'boxShadowHOffset'           => 0,
				'boxShadowVOffset'           => 0,
				'boxShadowBlur'              => 0,
				'boxShadowSpread'            => 0,
				'boxShadowPosition'          => 'outset',
				'hoverboxShadowColor'        => '#ccc',
				'hoverboxShadowHOffset'      => 0,
				'hoverboxShadowVOffset'      => 0,
				'hoverboxShadowBlur'         => 6,
				'hoverboxShadowSpread'       => 1,
				'hoverboxShadowPosition'     => 'outset',
				'opacity'                    => 0.7,
				'gradientDegree'             => 180,
				'bgGradient'                 => false,
				'backgroundImage'            => '',
				'backgroundPosition'         => '',
				'backgroundSize'             => '',
				'backgroundRepeat'           => '',
				'imageHoverEffect'           => '',
				'bggradient'                 => '',
				'secondaryBackgroundColor'   => '',
			);
		}

		/**
		 * Get Testimonial Slider Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_testimonial_slider_css( $attr, $id ) {
			$defaults = self::get_responsive_block_testimonial_slider_block_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$position    = str_replace( '-', ' ', $attr['backgroundPosition'] );
			$backopacity = $attr['backgroundOpacity'] ? ( 100 - $attr['backgroundOpacity'] ) / 100 : 0.5;
			$image_url   = $attr['backgroundImage'] ? $attr['backgroundImage']['url'] : null;

			$selectors = array(
				' '                   => array(
					'padding' => self::get_css_value( $attr['blockPadding'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial__wrap .responsive-block-editor-addons-tm__content' => array(
					'border-width'  => self::get_css_value( $attr['borderWidth'], 'px' ),
					'border-color'  => $attr['borderColor'],
					'border-style'  => $attr['borderStyle'],
					'border-radius' => self::get_css_value( $attr['borderRadius'], 'px' ),
					'padding'       => self::get_css_value( $attr['contentPadding'], 'px' ),
					'text-align'    => $attr['headingAlign'],
				),
				' button.slick-arrow' => array(
					'border-width'  => self::get_css_value( $attr['arrowBorderSize'], 'px' ),
					'border-color'  => $attr['arrowColor'],
					'border-radius' => self::get_css_value( $attr['arrowBorderRadius'], 'px' ),
				),
				' ul.slick-dots li button:before, ul.slick-dots li.slick-active button:before' => array(
					'color' => $attr['arrowColor'],
				),
				' .slick-arrow svg'   => array(
					'fill'   => $attr['arrowColor'],
					'width'  => self::get_css_value( $attr['arrowSize'], 'px' ),
					'height' => self::get_css_value( $attr['arrowSize'], 'px' ),
				),
				' .responsive-block-editor-addons-tm__image img' => array(
					'width'     => self::get_css_value( $attr['imageWidth'], 'px' ),
					'max-width' => self::get_css_value( $attr['imageWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial__wrap.responsive-block-editor-addons-tm__bg-type-color .responsive-block-editor-addons-tm__content' => array(
					'background-color' => $attr['backgroundColor'],
				),
				' .responsive-block-editor-addons-testimonial__wrap.responsive-block-editor-addons-tm__bg-type-image .responsive-block-editor-addons-tm__content' => array(
					'background-image'    => 'url(' . $image_url . ')',
					'background-position' => $position,
					'background-repeat'   => $attr['backgroundRepeat'],
					'background-size'     => $attr['backgroundSize'],
				),
				' .responsive-block-editor-addons-testimonial__wrap.responsive-block-editor-addons-tm__bg-type-image .responsive-block-editor-addons-tm__overlay' => array(
					'background-color' => $attr['backgroundImageColor'],
					'opacity'          => $backopacity,
				),
				' .responsive-block-editor-addons-testimonial__wrap' => array(
					'padding-left'  => self::get_css_value( $attr['columnGap'] / 2, 'px' ),
					'padding-right' => self::get_css_value( $attr['columnGap'] / 2, 'px' ),
					'margin-bottom' => self::get_css_value( $attr['rowGap'], 'px' ),
				),
				' .responsive-block-editor-addons-testimonial__wrap .responsive-block-editor-addons-tm__image-content' => array(
					'padding-left'   => self::get_css_value( $attr['imgHrPadding'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['imgHrPadding'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['imgVrPadding'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['imgVrPadding'], 'px' ),
				),
				' .responsive-block-editor-addons-tm__content.skin-type-bubble .responsive-block-editor-addons-tm__desc' => array(
					'padding' => self::get_css_value( $attr['bubblePadding'], 'px' ),
				),
				' .responsive-block-editor-addons-tm__content.skin-type-bubble .responsive-block-editor-addons-testinomial-text-wrap:before' => array(
					'border-top' => '10px solid ' . $attr['bubbleColor'],
				),
				' .responsive-block-editor-addons-tm__content.skin-type-bubble .responsive-block-editor-addons-testinomial-text-wrap' => array(
					'background-color' => $attr['bubbleColor'],
					'border-radius'    => self::get_css_value( $attr['bubbleBorderRadius'], 'px' ),
				),

			);

			$mobile_selectors = array(
				' .responsive-block-editor-addons-testimonial__wrap .responsive-block-editor-addons-tm__content' => array(
					'text-align' => $attr['headingAlignMobile'],
				),

			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-testimonial__wrap .responsive-block-editor-addons-tm__content' => array(
					'text-align' => $attr['headingAlignTablet'],
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-testomonial__outer-wrap.responsive-block-editor-addons-block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for testimonial slider block
		 *
		 * @return array
		 */
		public static function get_responsive_block_testimonial_slider_block_default_attributes() {
			return array(
				'test_item_count'         => 3,
				'classMigrate'            => false,
				'test_block'              => array(),
				'skin'                    => 'default',
				'bubblePadding'           => 20,
				'bubbleBorderRadius'      => 0,
				'bubbleColor'             => 'center',
				'headingAlign'            => 'center',
				'headingAlignMobile'      => 'center',
				'headingAlignTablet'      => 'center',
				'descColor'               => '#333',
				'companyColor'            => '#888888',
				'authorColor'             => '#333',
				'iconimgStyle'            => 'circle',
				'imagePosition'           => 'bottom',
				'imageAlignment'          => 'top',
				'nameFontSizeType'        => 'px',
				'nameFontSize'            => '',
				'nameFontSizeTablet'      => '',
				'nameFontSizeMobile'      => '',
				'nameFontFamily'          => 'Default',
				'nameFontWeight'          => '',
				'nameFontSubset'          => '',
				'nameLineHeightType'      => 'em',
				'nameLineHeight'          => '',
				'nameLineHeightTablet'    => '',
				'nameLineHeightMobile'    => '',
				'nameLoadGoogleFonts'     => false,
				'companyFontSizeType'     => 'px',
				'companyFontSize'         => '',
				'companyFontSizeTablet'   => '',
				'companyFontSizeMobile'   => '',
				'companyFontFamily'       => 'Default',
				'companyFontWeight'       => '',
				'companyFontSubset'       => '',
				'companyLineHeightType'   => 'em',
				'companyLineHeight'       => '',
				'companyLineHeightTablet' => '',
				'companyLineHeightMobile' => '',
				'companyLoadGoogleFonts'  => false,
				'descFontSizeType'        => 'px',
				'descFontSize'            => '',
				'descFontSizeTablet'      => '',
				'descFontSizeMobile'      => '',
				'descFontFamily'          => 'Default',
				'descFontWeight'          => '',
				'descFontSubset'          => '',
				'descLineHeightType'      => 'em',
				'descLineHeight'          => '',
				'descLineHeightTablet'    => '',
				'descLineHeightMobile'    => '',
				'descLoadGoogleFonts'     => false,
				'nameSpace'               => 5,
				'descSpace'               => 15,
				'block_id'                => 'not_set',
				'authorSpace'             => 5,
				'imgVrPadding'            => 10,
				'imgHrPadding'            => 10,
				'imgTopPadding'           => 10,
				'imgBottomPadding'        => 10,
				'iconImage'               => array(
					'url' => '',
					'alt' => 'InfoBox placeholder img',
				),
				'imageSize'               => 'thumbnail',
				'imageWidth'              => 60,
				'columns'                 => 1,
				'tcolumns'                => 1,
				'mcolumns'                => 1,
				'pauseOnHover'            => true,
				'infiniteLoop'            => true,
				'transitionSpeed'         => 500,
				'autoplay'                => true,
				'autoplaySpeed'           => 2000,
				'arrowDots'               => 'arrows_dots',
				'arrowSize'               => 20,
				'arrowBorderSize'         => 1,
				'arrowBorderRadius'       => 0,
				'rowGap'                  => 10,
				'columnGap'               => 10,
				'contentPadding'          => 5,
				'backgroundType'          => '',
				'backgroundImage'         => '',
				'backgroundPosition'      => 'center-center',
				'backgroundSize'          => 'cover',
				'backgroundRepeat'        => 'no-repeat',
				'backgroundColor'         => '',
				'backgroundImageColor'    => '',
				'borderStyle'             => 'none',
				'borderWidth'             => '1',
				'borderRadius'            => '',
				'borderColor'             => '',
				'backgroundOpacity'       => 50,
				'arrowColor'              => '#333',
				'stack'                   => 'tablet',
				'blockPadding'            => 45,
			);
		}

		/**
		 * Get Video Popup Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_video_popup_css( $attr, $id ) {
			$defaults = self::get_responsive_block_video_popup_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];
			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$imgopacity  = $attr['opacity'] / 100;
			$playopacity = $attr['butopacity'] / 100;

			$updated_img_url = '';
			if ( $attr['imgURL'] ) {
				$updated_img_url = $attr['imgURL'];
			}

			$updated_background_image = '';
			if ( $updated_img_url ) {
				$updated_background_image = 'linear-gradient(' .
				self::hex_to_rgb( $attr['vidBackgroundColor'], $imgopacity ) .
				',' .
				self::hex_to_rgb( $attr['vidBackgroundColor'], $imgopacity ) .
				'),url(' .
				$updated_img_url .
				')';
			}

			$selectors = array(
				' .responsive-block-editor-addons-video-popup__wrapper' => array(
					'background-image' => $updated_background_image,
					'background-color' => self::hex_to_rgb( $attr['vidBackgroundColor'], $imgopacity ),
					'max-width'        => self::get_css_value( $attr['vidwidth'], 'px' ),
					'height'           => self::get_css_value( $attr['vidheight'], 'px' ),
					'border-width'     => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
					'border-color'     => $attr['blockBorderColor'],
					'border-style'     => $attr['blockBorderStyle'],
					'border-radius'    => self::get_css_value( $attr['blockBorderRadius'], 'px' ),
					'box-shadow'       =>
					self::get_css_value( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					self::get_css_value( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$box_shadow_position_css,
				),

				' .responsive-block-editor-addons-video-popup__play-button svg' => array(
					'width'   => self::get_css_value( $attr['playButtonSize'], 'px' ),
					'height'  => self::get_css_value( $attr['playButtonSize'], 'px' ),
					'fill'    => $attr['playButtonColor'],
					'opacity' => $playopacity,
				),
			);

			$mobile_selectors = array(
				' .responsive-block-editor-addons-video-popup__wrapper' => array(
					'max-width' => self::get_css_value( $attr['vidwidthMobile'], 'px' ),
					'height'    => self::get_css_value( $attr['vidheightMobile'], 'px' ),
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-video-popup__wrapper' => array(
					'max-width' => self::get_css_value( $attr['vidwidthTablet'], 'px' ),
					'height'    => self::get_css_value( $attr['vidheightTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-video-popup.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}

		/**
		 * Get Defaults for video popup block
		 *
		 * @return array
		 */
		public static function get_responsive_block_video_popup_default_attributes() {
			return array(
				'block_id'               => '',
				'align'                  => '',
				'videoLink'              => '',
				'videoID'                => '',
				'borderRadius'           => '',
				'shadow'                 => '',
				'playButtonType'         => 'normal',
				'playButtonColor'        => '',
				'playButtonSize'         => 30,
				'vidwidth'               => '',
				'vidwidthTablet'         => '',
				'vidwidthMobile'         => '',
				'vidheight'              => '',
				'vidheightTablet'        => '',
				'vidheightMobile'        => '',
				'vidBackgroundColor'     => '',
				'opacity'                => 50,
				'imgURL'                 => '',
				'imgID'                  => '',
				'imgAlt'                 => '',
				'counterId'              => 1,
				'butopacity'             => 100,
				'blockBorderStyle'       => 'none',
				'blockBorderWidth'       => 1,
				'blockBorderRadius'      => '',
				'blockBorderColor'       => '',
				'boxShadowColor'         => '',
				'boxShadowHOffset'       => 0,
				'boxShadowVOffset'       => 0,
				'boxShadowBlur'          => '',
				'boxShadowSpread'        => '',
				'boxShadowPosition'      => 'outset',
				'previewBackgroundColor' => '#000000',
				'hoverEffect'            => '',
			);
		}

		/**
		 * Get Defaults for advanced column block
		 *
		 * @return array
		 */
		public static function get_responsive_block_advanced_columns_default_attributes() {
			return array(
				'columnGap'                => 'default',
				'widthType'                => 'px',
				'contentWidth'             => 'theme',
				'stack'                    => 'mobile',
				'columns'                  => 2,
				'width'                    => 900,
				'topPadding'               => 10,
				'bottomPadding'            => 10,
				'leftPadding'              => 10,
				'rightPadding'             => 10,
				'topPaddingTablet'         => '',
				'bottomPaddingTablet'      => '',
				'leftPaddingTablet'        => '',
				'rightPaddingTablet'       => '',
				'topPaddingMobile'         => '',
				'bottomPaddingMobile'      => '',
				'leftPaddingMobile'        => '',
				'rightPaddingMobile'       => '',
				'topMargin'                => 0,
				'bottomMargin'             => 0,
				'topMarginTablet'          => '',
				'bottomMarginTablet'       => '',
				'topMarginMobile'          => '',
				'bottomMarginMobile'       => '',
				'blockBorderStyle'         => 'none',
				'blockBorderWidth'         => 1,
				'blockBorderRadius'        => '',
				'blockBorderColor'         => '',
				'boxShadowColor'           => '',
				'boxShadowHOffset'         => 0,
				'boxShadowVOffset'         => 0,
				'boxShadowBlur'            => 0,
				'boxShadowSpread'          => 0,
				'boxShadowPosition'        => 'outset',
				'opacity'                  => 20,
				'colorLocation1'           => 0,
				'colorLocation2'           => 100,
				'gradientDirection'        => 90,
				'backgroundType'           => '',
				'backgroundColor'          => '',
				'backgroundColor1'         => '',
				'backgroundColor2'         => '#fff',
				'backgroundImage'          => '',
				'backgroundPosition'       => 'center-center',
				'backgroundSize'           => 'cover',
				'backgroundRepeat'         => 'no-repeat',
				'backgroundAttachment'     => 'scroll',
				'backgroundImageColor'     => '',
				'overlayType'              => 'color',
				'gradientOverlayColor1'    => '',
				'gradientOverlayColor2'    => '',
				'gradientOverlayType'      => 'linear',
				'gradientOverlayLocation1' => 0,
				'gradientOverlayLocation2' => 100,
				'gradientOverlayAngle'     => 0,
				'gradientOverlayPosition'  => 'center center',
				'blockAlign'               => 'left',
				'verticalAlign'            => 'flex-start',
				'blockId'                  => '',
				'height'                   => 'normal',
				'customHeight'             => 50,
				'z_index'                  => 1,

			);
		}

		/**
		 * Get Defaults for count up block
		 *
		 * @return array
		 */
		public static function get_responsive_block_count_up_default_attributes() {
			return array(
				'block_id'              => '',
				'countUp'               => '',
				'count'                 => '',
				'gutter'                => 'medium',
				'contentAlign'          => 'center',
				'textColor'             => '',
				'itemBackgroundColor'   => '',
				'contentFontFamily'     => '',
				'headingFontFamily'     => '',
				'dateFontFamily'        => '',
				'dateLineHeight'        => 1,
				'dateFontWeight'        => '400',
				'dateFontSize'          => 40,
				'dateFontSizeMobile'    => 40,
				'dateFontSizeTablet'    => 40,
				'headingLineHeight'     => 1.8,
				'titleFontWeight'       => '900',
				'headingFontSize'       => 16,
				'headingFontSizeTablet' => '',
				'headingFontSizeMobile' => '',
				'blockBorderRadius'     => '',
				'blockBorderColor'      => '',
				'numColor'              => '',
				'titleColor'            => '',
				'titleSpacing'          => '',
				'numberSpacing'         => '',
				'descriptionSpacing'    => '',
				'contentLineHeight'     => 1.75,
				'contentFontWeight'     => '400',
				'contentFontSize'       => 16,
				'contentFontSizeMobile' => 16,
				'contentFontSizeTablet' => 16,
				'icon'                  => 'welcome-add-page',
				'resshowIcon'           => false,
				'resshowTitle'          => true,
				'resshowDesc'           => true,
				'blockBorderStyle'      => 'none',
				'blockBorderWidth'      => 1,
				'opacity'               => 10,
				'icon_color'            => '#3a3a3a',
				'iconsize'              => 16,
				'resshowNum'            => true,
				'titleSpace'            => 20,
				'contentSpace'          => 30,
				'numSpace'              => 20,
				'iconStyle'             => 'none',
				'shapeBorderRadius'     => 100,
				'shapePadding'          => 20,
				'shapeBorder'           => 2,
				'iconShapeColor'        => '#add5ef',
				'contentSpacing'        => 0,
				'iconSpacing'           => 16,
			);
		}

		/**
		 * Get Defaults for blockquote block
		 *
		 * @return array
		 */
		public static function get_responsive_block_blockquote_default_attributes() {
			return array(
				'block_id'                => '',
				'quoteContent'            => '',
				'quoteBackgroundColor'    => '',
				'quoteTextColor'          => '',
				'quoteFontFamily'         => '',
				'quoteFontSize'           => 18,
				'quoteFontWeight'         => '400',
				'quoteLineHeight'         => 1,
				'quoteSize'               => 70,
				'quoteColor'              => '',
				'borderStyle'             => 'none',
				'borderWidth'             => 1,
				'blockBorderRadius'       => 0,
				'borderColor'             => '',
				'leftPadding'             => 60,
				'rightPadding'            => 60,
				'topPadding'              => 70,
				'bottomPadding'           => 70,
				'leftPaddingMobile'       => 60,
				'rightPaddingMobile'      => 60,
				'topPaddingMobile'        => 70,
				'bottomPaddingMobile'     => 70,
				'leftPaddingTablet'       => 60,
				'rightPaddingTablet'      => 60,
				'topPaddingTablet'        => 70,
				'bottomPaddingTablet'     => 70,
				'quoteHposition'          => 30,
				'quoteVposition'          => 20,
				'quoteAlign'              => 'left-aligned',
				'quoteOpacity'            => 100,
				'showQuote'               => true,
				'opacity'                 => 100,
				'colorLocation1'          => 0,
				'colorLocation2'          => 100,
				'gradientDirection'       => 90,
				'backgroundImage'         => '',
				'backgroundVideo'         => '',
				'backgroundColor'         => '',
				'backgroundColor1'        => '',
				'backgroundColor2'        => '',
				'backgroundType'          => 'none',
				'icon'                    => 'round-fat',
				'boxShadowColor'          => '#fff',
				'boxShadowHOffset'        => 0,
				'boxShadowVOffset'        => 0,
				'boxShadowBlur'           => 20,
				'boxShadowSpread'         => 20,
				'boxShadowPosition'       => 'outset',
				'textSpacingTop'          => 60,
				'textSpacingTopMobile'    => 30,
				'textSpacingTopTablet'    => 30,
				'textSpacingBottom'       => 0,
				'textSpacingBottomMobile' => 0,
				'textSpacingBottomTablet' => 0,
				'textSpacingLeft'         => 70,
				'textSpacingLeftMobile'   => 35,
				'textSpacingLeftTablet'   => 35,
				'textSpacingRight'        => 70,
				'textSpacingRightMobile'  => 35,
				'textSpacingRightTablet'  => 35,

			);
		}
		/**
		 * Get Defaults for divider block
		 *
		 * @return array
		 */
		public static function get_responsive_block_divider_default_attributes() {
			return array(
				'block_id'               => '',
				'spacerHeight'           => 30,
				'spacerDivider'          => false,
				'spacerDividerStyle'     => 'solid',
				'spacerDividerColor'     => '#000',
				'spacerDividerHeight'    => 7,
				'spacerDividerWidth'     => 60,
				'spacerDividerAlignment' => 'center',
			);
		}

		/**
		 * Get Count Down Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_count_down_css( $attr, $id ) {
			$defaults = self::get_responsive_block_count_down_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$box_shadow_position_css = $attr['boxShadowPosition'];
			if ( 'outset' === $attr['boxShadowPosition'] ) {
				$box_shadow_position_css = '';
			}

			$display_days    = $attr['showDaysBox'] ? 'block' : 'none';
			$display_hours   = $attr['showHoursBox'] ? 'block' : 'none';
			$display_minutes = $attr['showMinutesBox'] ? 'block' : 'none';
			$display_seconds = $attr['showSecondsBox'] ? 'block' : 'none';

			$flex_column = $attr['stackOnMobile'] ? 'column' : 'row';

			$selectors = array(
				' .responsive-block-editor-addons-countdown-box-stylings' => array(
					'height'           => self::get_css_value( $attr['boxHeight'], 'px' ),
					'width'            => self::get_css_value( $attr['boxWidth'], 'px' ),
					'margin-left'      => self::get_css_value( $attr['boxMargin'], 'px' ),
					'padding'          => $attr['boxPaddingTop'] . 'px ' . $attr['boxPaddingRight'] . 'px ' . $attr['boxPaddingBottom'] . 'px ' . $attr['boxPaddingLeft'] . 'px',
					'border'           => $attr['boxBorderSize'] . 'px ' . $attr['boxBorderStyle'] . ' ' . $attr['boxBorderColor'],
					'border-radius'    => $attr['borderRadiusTopLeft'] . 'px ' . $attr['borderRadiusTopRight'] . 'px ' . $attr['borderRadiusBottomRight'] . 'px ' . $attr['borderRadiusBottomLeft'] . 'px',
					'background-color' => $attr['boxBackgroundColor'],
					'box-shadow'       => $attr['boxShadowHOffset'] . 'px ' . $attr['boxShadowVOffset'] . 'px ' . $attr['boxShadowBlur'] . 'px ' . $attr['boxShadowSpread'] . 'px ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
				),
				' .responsive-block-editor-addons-countdown-box-stylings:first-of-type' => array(
					'margin-left' => '0px !important',
				),
				' .responsive-block-editor-addons-countdown-digits' => array(
					'font-family'     => $attr['digitFontFamily'],
					'font-size'       => self::get_css_value( $attr['digitFontSize'], 'px' ),
					'font-weight'     => $attr['digitFontWeight'],
					'letter-spacing'  => self::get_css_value( $attr['digitLetterSpacing'], 'px' ),
					'line-height'     => $attr['digitLineHeight'],
					'color'           => $attr['digitColor'],
					'display'         => $attr['displayInline'] ? 'flex' : 'block',
					'flex'            => $attr['displayInline'] ? 1 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-end' : null,
				),
				' .responsive-block-editor-addons-countdown-label' => array(
					'font-family'     => $attr['labelFontFamily'],
					'font-size'       => self::get_css_value( $attr['labelFontSize'], 'px' ),
					'font-weight'     => $attr['labelFontWeight'],
					'line-height'     => $attr['labelLineHeight'],
					'padding-left'    => $attr['displayInline'] ? self::get_css_value( $attr['labelLeftPadding'], 'px' ) : '0px',
					'letter-spacing'  => self::get_css_value( $attr['labelLetterSpacing'], 'px' ),
					'color'           => $attr['labelColor'],
					'display'         => $attr['showDigitLabels'] ? ( $attr['displayInline'] ? 'flex' : 'block' ) : 'none',
					'flex'            => $attr['displayInline'] ? 1 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-start' : null,
				),
				' .responsive-block-editor-addons-countdown-box-margins' => array(
					'margin-top'      => self::get_css_value( $attr['boxItemMarginTop'], 'px' ),
					'margin-right'    => self::get_css_value( $attr['boxItemMarginRight'], 'px' ),
					'margin-bottom'   => self::get_css_value( $attr['boxItemMarginBottom'], 'px' ),
					'margin-left'     => self::get_css_value( $attr['boxItemMarginLeft'], 'px' ),
					'text-align'      => $attr['boxItemTextAlign'],
					'display'         => $attr['displayInline'] ? 'flex' : null,
					'justify-content' => $attr['displayInline'] ? 'center' : null,
					'align-items'     => $attr['displayInline'] ? 'center' : null,
				),
				'.responsive-block-editor-addons-countdown-wrapper' => array(
					'margin-top'     => self::get_css_value( $attr['containerMarginTop'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['containerMarginRight'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['containerMarginBottom'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['containerMarginLeft'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['containerPaddingTop'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['containerPaddingRight'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['containerPaddingBottom'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['containerPaddingLeft'], 'px' ),
				),
				' .responsive-block-editor-addons-countdown-container .responsive-block-editor-addons-countdown-items' => array(
					'justify-content' => $attr['justifyItems'],
					'margin'          => 0,
				),
				' .responsive-block-editor-addons-countdown-get-date' => array(
					'display' => 'none',
				),
				' .responsive-block-editor-addons-countdown-item.responsive-block-editor-addons-countdown-item-days' => array(
					'display' => $display_days,
				),
				' .responsive-block-editor-addons-countdown-item.responsive-block-editor-addons-countdown-item-hours' => array(
					'display' => $display_hours,
				),
				' .responsive-block-editor-addons-countdown-item.responsive-block-editor-addons-countdown-item-minutes' => array(
					'display' => $display_minutes,
				),
				' .responsive-block-editor-addons-countdown-item.responsive-block-editor-addons-countdown-item-seconds' => array(
					'display' => $display_seconds,
				),
			);

			$mobile_selectors = array(
				' .responsive-block-editor-addons-countdown-box-stylings' => array(
					'height'           => self::get_css_value( $attr['boxHeightMobile'], 'px' ),
					'width'            => self::get_css_value( $attr['boxWidthMobile'], 'px' ),
					'margin-left'      => true === $attr['stackOnMobile'] ? '0px' : self::get_css_value( $attr['boxMarginMobile'], 'px' ),
					'margin-bottom'    => true === $attr['stackOnMobile'] ? self::get_css_value( $attr['boxMarginMobile'], 'px' ) : '0px',
					'padding'          => $attr['boxPaddingTopMobile'] . 'px ' . $attr['boxPaddingRightMobile'] . 'px ' . $attr['boxPaddingBottomMobile'] . 'px ' . $attr['boxPaddingLeftMobile'] . 'px',
					'border'           => $attr['boxBorderSize'] . 'px ' . $attr['boxBorderStyle'] . ' ' . $attr['boxBorderColor'],
					'border-radius'    => $attr['borderRadiusTopLeft'] . 'px ' . $attr['borderRadiusTopRight'] . 'px ' . $attr['borderRadiusBottomRight'] . 'px ' . $attr['borderRadiusBottomLeft'] . 'px',
					'background-color' => $attr['boxBackgroundColor'],
					'box-shadow'       => $attr['boxShadowHOffset'] . 'px ' . $attr['boxShadowVOffset'] . 'px ' . $attr['boxShadowBlur'] . 'px ' . $attr['boxShadowSpread'] . 'px ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
				),
				' .responsive-block-editor-addons-countdown-box-stylings:first-of-type' => array(
					'margin-left' => true === $attr['stackOnMobile'] ? '' : '0px !important',
				),
				' .responsive-block-editor-addons-countdown-box-stylings:last-of-type' => array(
					'margin-bottom' => true === $attr['stackOnMobile'] ? '0px !important' : '',
				),
				' .responsive-block-editor-addons-countdown-digits' => array(
					'font-family'     => $attr['digitFontFamily'],
					'font-size'       => self::get_css_value( $attr['digitFontSizeMobile'], 'px' ),
					'font-weight'     => $attr['digitFontWeight'],
					'letter-spacing'  => self::get_css_value( $attr['digitLetterSpacing'], 'px' ),
					'line-height'     => $attr['digitLineHeight'],
					'color'           => $attr['digitColor'],
					'display'         => $attr['displayInline'] ? 'flex' : 'block',
					'flex'            => $attr['displayInline'] ? 1 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-end' : null,
				),
				' .responsive-block-editor-addons-countdown-label' => array(
					'font-family'     => $attr['labelFontFamily'],
					'font-size'       => self::get_css_value( $attr['labelFontSizeMobile'], 'px' ),
					'font-weight'     => $attr['labelFontWeight'],
					'line-height'     => $attr['labelLineHeight'],
					'padding-left'    => $attr['displayInline'] ? self::get_css_value( $attr['labelLeftPadding'], 'px' ) : '0px',
					'letter-spacing'  => self::get_css_value( $attr['labelLetterSpacing'], 'px' ),
					'color'           => $attr['labelColor'],
					'flex'            => $attr['displayInline'] ? 1.5 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-start' : null,
				),
				' .responsive-block-editor-addons-countdown-box-margins' => array(
					'margin-top'    => self::get_css_value( $attr['boxItemMarginTopMobile'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['boxItemMarginRightMobile'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['boxItemMarginBottomMobile'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['boxItemMarginLeftMobile'], 'px' ),
				),
				'.responsive-block-editor-addons-countdown-wrapper' => array(
					'margin-top'     => self::get_css_value( $attr['containerMarginTopMobile'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['containerMarginRightMobile'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['containerMarginBottomMobile'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['containerMarginLeftMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['containerPaddingTopMobile'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['containerPaddingRightMobile'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['containerPaddingBottomMobile'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['containerPaddingLeftMobile'], 'px' ),
				),
				' .responsive-block-editor-addons-countdown-container .responsive-block-editor-addons-countdown-items' => array(
					'flex-direction' => $flex_column,
					'align-items'    => 'center',
				),
			);

			$tablet_selectors = array(
				' .responsive-block-editor-addons-countdown-box-stylings' => array(
					'height'           => self::get_css_value( $attr['boxHeightTablet'], 'px' ),
					'width'            => self::get_css_value( $attr['boxWidthTablet'], 'px' ),
					'margin-left'      => self::get_css_value( $attr['boxMarginTablet'], 'px' ),
					'padding'          => $attr['boxPaddingTopTablet'] . 'px ' . $attr['boxPaddingRightTablet'] . 'px ' . $attr['boxPaddingBottomTablet'] . 'px ' . $attr['boxPaddingLeftTablet'] . 'px',
					'border'           => $attr['boxBorderSize'] . 'px ' . $attr['boxBorderStyle'] . ' ' . $attr['boxBorderColor'],
					'border-radius'    => $attr['borderRadiusTopLeft'] . 'px ' . $attr['borderRadiusTopRight'] . 'px ' . $attr['borderRadiusBottomRight'] . 'px ' . $attr['borderRadiusBottomLeft'] . 'px',
					'background-color' => $attr['boxBackgroundColor'],
					'box-shadow'       => $attr['boxShadowHOffset'] . 'px ' . $attr['boxShadowVOffset'] . 'px ' . $attr['boxShadowBlur'] . 'px ' . $attr['boxShadowSpread'] . 'px ' . $attr['boxShadowColor'] . ' ' . $box_shadow_position_css,
				),

				' .responsive-block-editor-addons-countdown-digits' => array(
					'font-family'     => $attr['digitFontFamily'],
					'font-size'       => self::get_css_value( $attr['digitFontSizeTablet'], 'px' ),
					'font-weight'     => $attr['digitFontWeight'],
					'letter-spacing'  => self::get_css_value( $attr['digitLetterSpacing'], 'px' ),
					'line-height'     => $attr['digitLineHeight'],
					'color'           => $attr['digitColor'],
					'display'         => $attr['displayInline'] ? 'flex' : 'block',
					'flex'            => $attr['displayInline'] ? 1 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-end' : null,
				),

				' .responsive-block-editor-addons-countdown-label' => array(
					'font-family'     => $attr['labelFontFamily'],
					'font-size'       => self::get_css_value( $attr['labelFontSizeTablet'], 'px' ),
					'font-weight'     => $attr['labelFontWeight'],
					'line-height'     => $attr['labelLineHeight'],
					'padding-left'    => $attr['displayInline'] ? self::get_css_value( $attr['labelLeftPadding'], 'px' ) : '0px',
					'letter-spacing'  => self::get_css_value( $attr['labelLetterSpacing'], 'px' ),
					'color'           => $attr['labelColor'],
					'flex'            => $attr['displayInline'] ? 1 : null,
					'justify-content' => $attr['displayInline'] ? 'flex-start' : null,
				),
				' .responsive-block-editor-addons-countdown-box-margins' => array(
					'margin-top'    => self::get_css_value( $attr['boxItemMarginTopTablet'], 'px' ),
					'margin-right'  => self::get_css_value( $attr['boxItemMarginRightTablet'], 'px' ),
					'margin-bottom' => self::get_css_value( $attr['boxItemMarginBottomTablet'], 'px' ),
					'margin-left'   => self::get_css_value( $attr['boxItemMarginLeftTablet'], 'px' ),
				),
				'.responsive-block-editor-addons-countdown-wrapper' => array(
					'margin-top'     => self::get_css_value( $attr['containerMarginTopTablet'], 'px' ),
					'margin-right'   => self::get_css_value( $attr['containerMarginRightTablet'], 'px' ),
					'margin-bottom'  => self::get_css_value( $attr['containerMarginBottomTablet'], 'px' ),
					'margin-left'    => self::get_css_value( $attr['containerMarginLeftTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['containerPaddingTopTablet'], 'px' ),
					'padding-right'  => self::get_css_value( $attr['containerPaddingRightTablet'], 'px' ),
					'padding-bottom' => self::get_css_value( $attr['containerPaddingBottomTablet'], 'px' ),
					'padding-left'   => self::get_css_value( $attr['containerPaddingLeftTablet'], 'px' ),
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-count-down.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );
			return $css;
		}
		/**
		 * Get Defaults for count down block
		 *
		 * @return array
		 */
		public static function get_responsive_block_count_down_default_attributes() {
			return array(
				'block_id'                     => '',
				'date'                         => '',
				'days'                         => '0',
				'hours'                        => '0',
				'minutes'                      => '0',
				'seconds'                      => '0',
				'digitDaysLabel'               => 'Days',
				'digitHoursLabel'              => 'Hours',
				'digitMinutesLabel'            => 'Minutes',
				'digitSecondsLabel'            => 'Seconds',
				'showDigitLabels'              => true,
				'showDaysBox'                  => true,
				'showHoursBox'                 => true,
				'showMinutesBox'               => true,
				'showSecondsBox'               => true,
				'digitFontFamily'              => '',
				'digitFontSize'                => 48,
				'digitFontSizeMobile'          => 14,
				'digitFontSizeTablet'          => 28,
				'digitFontWeight'              => '500',
				'digitLetterSpacing'           => 1,
				'digitLineHeight'              => 2,
				'digitColor'                   => '#fff',
				'labelFontFamily'              => '',
				'labelFontSize'                => 14,
				'labelFontSizeMobile'          => 12,
				'labelFontSizeTablet'          => 14,
				'labelColor'                   => '#fff',
				'labelLineHeight'              => 2,
				'labelFontWeight'              => '500',
				'labelLeftPadding'             => 0,
				'labelLetterSpacing'           => 1,
				'boxItemMarginTop'             => 0,
				'boxItemMarginRight'           => 0,
				'boxItemMarginBottom'          => 0,
				'boxItemMarginLeft'            => 0,
				'boxItemMarginTopTablet'       => 0,
				'boxItemMarginRightTablet'     => 0,
				'boxItemMarginBottomTablet'    => 0,
				'boxItemMarginLeftTablet'      => 0,
				'boxItemMarginTopMobile'       => 0,
				'boxItemMarginRightMobile'     => 0,
				'boxItemMarginBottomMobile'    => 0,
				'boxItemMarginLeftMobile'      => 0,
				'boxItemTextAlign'             => 'center',
				'boxHeight'                    => '',
				'boxWidth'                     => 140,
				'boxMargin'                    => 10,
				'boxHeightMobile'              => '',
				'boxWidthMobile'               => 80,
				'boxMarginMobile'              => 8,
				'boxHeightTablet'              => '',
				'boxWidthTablet'               => 140,
				'boxMarginTablet'              => 10,
				'boxPaddingTop'                => 0,
				'boxPaddingRight'              => 0,
				'boxPaddingBottom'             => 10,
				'boxPaddingLeft'               => 0,
				'boxPaddingTopMobile'          => 0,
				'boxPaddingRightMobile'        => 0,
				'boxPaddingBottomMobile'       => 10,
				'boxPaddingLeftMobile'         => 0,
				'boxPaddingTopTablet'          => 0,
				'boxPaddingRightTablet'        => 0,
				'boxPaddingBottomTablet'       => 10,
				'boxPaddingLeftTablet'         => 0,
				'showBoxBorder'                => true,
				'boxBorderColor'               => '000',
				'boxBorderSize'                => 0,
				'boxBorderStyle'               => 'solid',
				'borderRadiusTopLeft'          => 0,
				'borderRadiusTopRight'         => 0,
				'borderRadiusBottomRight'      => 0,
				'borderRadiusBottomLeft'       => 0,
				'showBoxShadow'                => true,
				'boxShadowHOffset'             => 0,
				'boxShadowVOffset'             => 0,
				'boxShadowBlur'                => 0,
				'boxShadowPosition'            => 'outset',
				'boxShadowSpread'              => 0,
				'boxShadowColor'               => '#000',
				'boxBackgroundColor'           => '#6EC1E4',
				'containerMarginTop'           => 0,
				'containerMarginRight'         => 0,
				'containerMarginBottom'        => 0,
				'containerMarginLeft'          => 0,
				'containerPaddingTop'          => 0,
				'containerPaddingRight'        => 0,
				'containerPaddingBottom'       => 0,
				'containerPaddingLeft'         => 0,
				'containerMarginTopTablet'     => 0,
				'containerMarginRightTablet'   => 0,
				'containerMarginBottomTablet'  => 0,
				'containerMarginLeftTablet'    => 0,
				'containerPaddingTopTablet'    => 0,
				'containerPaddingRightTablet'  => 0,
				'containerPaddingBottomTablet' => 0,
				'containerPaddingLeftTablet'   => 0,
				'containerMarginTopMobile'     => 0,
				'containerMarginRightMobile'   => 0,
				'containerMarginBottomMobile'  => 0,
				'containerMarginLeftMobile'    => 0,
				'containerPaddingTopMobile'    => 0,
				'containerPaddingRightMobile'  => 0,
				'containerPaddingBottomMobile' => 0,
				'containerPaddingLeftMobile'   => 0,
				'justifyItems'                 => 'center',
				'displayInline'                => false,
				'stackOnMobile'                => false,
			);
		}

		/**
		 * Get Table Of Contents Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_table_of_contents_css( $attr, $id ) {
			$defaults = self::get_responsive_block_table_of_contents_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );
			?>
			<script>
				( function( $ ) {

					RBEATableOfContents = {

						init: function() {
							$( document ).on( "click",'.responsive-block-editor-addons-toc__title-wrap', RBEATableOfContents._toggleCollapse )
						},

						_toggleCollapse: function( e ) {
							if ( $( this ).find( '.responsive-block-editor-addons-toc__collapsible-wrap' ).length > 0 ) {
								let $root = $( this ).closest( '.wp-block-responsive-block-editor-addons-table-of-contents' )
								if ( $root.hasClass( 'responsive-block-editor-addons-toc__collapse' ) ) {
									$root.removeClass( 'responsive-block-editor-addons-toc__collapse' );
								} else {
									$root.addClass( 'responsive-block-editor-addons-toc__collapse' );
								}
							}
						},

						_run: function( attr, id ) {
							var $this_scope = $( id );
							if ( $this_scope.find( '.responsive-block-editor-addons-toc__collapsible-wrap' ).length > 0 ) {
								$this_scope.find( '.responsive-block-editor-addons-toc__title-wrap' ).addClass( 'responsive-block-editor-addons-toc__is-collapsible' );
							}   
						},
					}

					$( document ).ready(function() {
						RBEATableOfContents.init()
						RBEATableOfContents._run( <?php echo wp_json_encode( $attr ); ?>, '<?php echo esc_attr( $id ); ?>' );
					})
				})( jQuery )       
			</script>
			<?php

			$mobile_selectors = array();
			$tablet_selectors = array();

			$justify_content = 'flex-start';
			if ( 'center' === $attr['align'] ) {
				$justify_content = 'center';
			} elseif ( 'right' === $attr['align'] ) {
				$justify_content = 'flex-end';
			}

			$updated_background_image = '';
			if ( $attr['backgroundImage'] ) {
				$updated_background_image = 'linear-gradient(' .
				self::hex_to_rgb( '#fff', 0 ) .
				',' .
				self::hex_to_rgb( '#fff', 0 ) .
				'),url(' .
				$attr['backgroundImage'] .
				')';
			}
			if ( 'image' !== $attr['backgroundType'] ) {
				$updated_background_image = '';
			}

			$selectors = array(
				' ' => array(
					'background-image'    => $updated_background_image,
					'padding-top'         => self::get_css_value( $attr['blockTopPadding'], 'px' ) . '!important',
					'padding-bottom'      => self::get_css_value( $attr['blockBottomPadding'], 'px' ) . '!important',
					'padding-left'        => self::get_css_value( $attr['blockLeftPadding'], 'px' ) . '!important',
					'padding-right'       => self::get_css_value( $attr['blockRightPadding'], 'px' ) . '!important',
					'margin-top'          => self::get_css_value( $attr['blockTopMargin'], 'px' ) . '!important',
					'margin-bottom'       => self::get_css_value( $attr['blockBottomMargin'], 'px' ) . '!important',
					'margin-left'         => self::get_css_value( $attr['blockLeftMargin'], 'px' ) . '!important',
					'margin-right'        => self::get_css_value( $attr['blockRightMargin'], 'px' ) . '!important',
					'z-index'             => $attr['zIndex'],
					'display'             => 'flex',
					'background-position' => $attr['backgroundPosition'],
					'background-repeat'   => $attr['backgroundRepeat'],
					'background-size'     => $attr['backgroundSize'],
					'background-color'    => 'color' === $attr['backgroundType'] ? self::hex_to_rgb(
						$attr['backgroundColor'],
						1
					) : null,
				),
				' .responsive-block-editor-addons-toc__title-wrap' => array(
					'justify-content'  => $justify_content,
					'font-family'      => $attr['headingFontFamily'],
					'font-weight'      => $attr['headingFontWeight'],
					'font-size'        => self::get_css_value( $attr['headingFontSize'], 'px' ),
					'line-height'      => $attr['headingLineHeight'],
					'color'            => $attr['headingColor'],
					'background-color' => $attr['headingBgColor'],
					'padding-top'      => self::get_css_value( $attr['headingTopPadding'], 'px' ) . '!important',
					'padding-bottom'   => self::get_css_value( $attr['headingBottomPadding'], 'px' ) . '!important',
					'padding-left'     => self::get_css_value( $attr['headingLeftPadding'], 'px' ) . '!important',
					'padding-right'    => self::get_css_value( $attr['headingRightPadding'], 'px' ) . '!important',
					'margin-top'       => self::get_css_value( $attr['headingTopMargin'], 'px' ) . '!important',
					'margin-bottom'    => self::get_css_value( $attr['headingBottomMargin'], 'px' ) . '!important',
					'margin-left'      => self::get_css_value( $attr['headingLeftMargin'], 'px' ) . '!important',
					'margin-right'     => self::get_css_value( $attr['headingRightMargin'], 'px' ) . '!important',
					'border-style'     => $attr['headingBorderStyle'],
					'border-color'     => $attr['headingBorderColor'],
					'border-radius'    => self::get_css_value( $attr['headingBorderRadius'], 'px' ) . ' !important',
					'border-width'     => self::get_css_value( $attr['headingBorderWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-toc__title-wrap:hover' => array(
					'color'            => $attr['headingColorHover'],
					'background-color' => $attr['headingBgColorHover'],
				),
				' .responsive-block-editor-addons-toc__list-wrap' => array(
					'font-family'         => $attr['contentFontFamily'],
					'font-weight'         => $attr['contentFontWeight'],
					'font-size'           => self::get_css_value( $attr['contentFontSize'], 'px' ),
					'line-height'         => $attr['contentLineHeight'],
					'background-color'    => $attr['bodyBgColor'],
					'padding-top'         => self::get_css_value( $attr['contentTopPadding'], 'px' ) . '!important',
					'padding-bottom'      => self::get_css_value( $attr['contentBottomPadding'], 'px' ) . '!important',
					'padding-left'        => self::get_css_value( $attr['contentLeftPadding'], 'px' ) . '!important',
					'padding-right'       => self::get_css_value( $attr['contentRightPadding'], 'px' ) . '!important',
					'margin-top'          => self::get_css_value( $attr['contentTopMargin'], 'px' ) . '!important',
					'margin-bottom'       => self::get_css_value( $attr['contentBottomMargin'], 'px' ) . '!important',
					'margin-left'         => self::get_css_value( $attr['contentLeftMargin'], 'px' ) . '!important',
					'margin-right'        => self::get_css_value( $attr['contentRightMargin'], 'px' ) . '!important',
					'border-style'        => $attr['bodyBorderStyle'],
					'border-color'        => $attr['bodyBorderColor'],
					'border-radius'       => self::get_css_value( $attr['bodyBorderRadius'], 'px' ) . ' !important',
					'border-top-width'    => self::get_css_value( 0, 'px' ),
					'border-left-width'   => self::get_css_value( $attr['bodyBorderWidth'], 'px' ),
					'border-right-width'  => self::get_css_value( $attr['bodyBorderWidth'], 'px' ),
					'border-bottom-width' => self::get_css_value( $attr['bodyBorderWidth'], 'px' ),
				),
				' .responsive-block-editor-addons-toc__list-wrap .responsive-block-editor-addons-toc__list li a' => array(
					'color' => $attr['bodyColor'],
				),
				' .responsive-block-editor-addons-toc__list-wrap:hover' => array(
					'background-color' => $attr['bodyBgColorHover'],
				),
				' .responsive-block-editor-addons-toc__list-wrap:hover .responsive-block-editor-addons-toc__list li a' => array(
					'color' => $attr['bodyColorHover'],
				),
				' .responsive-block-editor-addons-toc__wrap' => array(
					'width'         => self::get_css_value( $attr['blockWidth'], '%' ),
					'border-style'  => $attr['blockBorderStyle'],
					'border-color'  => $attr['blockBorderColor'],
					'border-radius' => self::get_css_value( $attr['blockBorderRadius'], 'px' ) . ' !important',
					'border-width'  => self::get_css_value( $attr['blockBorderWidth'], 'px' ),
				),
			);

			$mobile_selectors = array(
				' ' => array(
					'padding-top'    => self::get_css_value( $attr['blockTopPaddingMobile'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['blockBottomPaddingMobile'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['blockLeftPaddingMobile'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['blockRightPaddingMobile'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['blockTopMarginMobile'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['blockBottomMarginMobile'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['blockLeftMarginMobile'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['blockRightMarginMobile'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-toc__title-wrap' => array(
					'font-size'      => self::get_css_value( $attr['headingFontSizeMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['headingTopPaddingMobile'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['headingBottomPaddingMobile'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['headingLeftPaddingMobile'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['headingRightPaddingMobile'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['headingTopMarginMobile'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['headingBottomMarginMobile'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['headingLeftMarginMobile'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['headingRightMarginMobile'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-toc__list-wrap' => array(
					'font-size'      => self::get_css_value( $attr['contentFontSizeMobile'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['contentTopPaddingMobile'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['contentBottomPaddingMobile'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['contentLeftPaddingMobile'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['contentRightPaddingMobile'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['contentTopMarginMobile'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['contentBottomMarginMobile'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['contentLeftMarginMobile'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['contentRightMarginMobile'], 'px' ) . '!important',
				),
			);

			$tablet_selectors = array(
				' ' => array(
					'padding-top'    => self::get_css_value( $attr['blockTopPaddingTablet'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['blockBottomPaddingTablet'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['blockLeftPaddingTablet'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['blockRightPaddingTablet'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['blockTopMarginTablet'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['blockBottomMarginTablet'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['blockLeftMarginTablet'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['blockRightMarginTablet'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-toc__title-wrap' => array(
					'font-size'      => self::get_css_value( $attr['headingFontSizeTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['headingTopPaddingTablet'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['headingBottomPaddingTablet'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['headingLeftPaddingTablet'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['headingRightPaddingTablet'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['headingTopMarginTablet'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['headingBottomMarginTablet'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['headingLeftMarginTablet'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['headingRightMarginTablet'], 'px' ) . '!important',
				),
				' .responsive-block-editor-addons-toc__list-wrap' => array(
					'font-size'      => self::get_css_value( $attr['contentFontSizeTablet'], 'px' ),
					'padding-top'    => self::get_css_value( $attr['contentTopPaddingTablet'], 'px' ) . '!important',
					'padding-bottom' => self::get_css_value( $attr['contentBottomPaddingTablet'], 'px' ) . '!important',
					'padding-left'   => self::get_css_value( $attr['contentLeftPaddingTablet'], 'px' ) . '!important',
					'padding-right'  => self::get_css_value( $attr['contentRightPaddingTablet'], 'px' ) . '!important',
					'margin-top'     => self::get_css_value( $attr['contentTopMarginTablet'], 'px' ) . '!important',
					'margin-bottom'  => self::get_css_value( $attr['contentBottomMarginTablet'], 'px' ) . '!important',
					'margin-left'    => self::get_css_value( $attr['contentLeftMarginTablet'], 'px' ) . '!important',
					'margin-right'   => self::get_css_value( $attr['contentRightMarginTablet'], 'px' ) . '!important',
				),
			);

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-table-of-contents.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for Table Of Contents block
		 *
		 * @return array
		 */
		public static function get_responsive_block_table_of_contents_default_attributes() {

			return array(
				'block_id'                   => '',
				'classMigrate'               => false,
				'isCollapsible'              => false,
				'icon'                       => 'fa-angle-down',
				'heading'                    => 'Table Of Contents',
				'headingTitle'               => 'Table Of Contents',
				'borderStyle'                => 'solid',
				'borderWidth'                => 1,
				'borderRadius'               => 0,
				'borderColor'                => '#333',
				'blockTopPadding'            => 0,
				'blockTopPaddingMobile'      => 0,
				'blockTopPaddingTablet'      => 0,
				'blockBottomPadding'         => 0,
				'blockBottomPaddingTablet'   => 0,
				'blockBottomPaddingMobile'   => 0,
				'blockRightPadding'          => 0,
				'blockRightPaddingMobile'    => 0,
				'blockRightPaddingTablet'    => 0,
				'blockLeftPadding'           => 0,
				'blockLeftPaddingTablet'     => 0,
				'blockLeftPaddingMobile'     => 0,
				'blockTopMargin'             => 0,
				'blockTopMarginMobile'       => 0,
				'blockTopMarginTablet'       => 0,
				'blockBottomMargin'          => 0,
				'blockBottomMarginTablet'    => 0,
				'blockBottomMarginMobile'    => 0,
				'blockRightMargin'           => 0,
				'blockRightMarginMobile'     => 0,
				'blockRightMarginTablet'     => 0,
				'blockLeftMargin'            => 0,
				'blockLeftMarginTablet'      => 0,
				'blockLeftMarginMobile'      => 0,
				'zIndex'                     => 0,
				'headingFontFamily'          => 'Default',
				'headingFontWeight'          => '500',
				'headingFontSize'            => 16,
				'headingFontSizeTablet'      => 16,
				'headingFontSizeMobile'      => 14,
				'headingLineHeight'          => 1,
				'contentFontFamily'          => 'Default',
				'contentFontWeight'          => '500',
				'contentFontSize'            => 16,
				'contentFontSizeTablet'      => 16,
				'contentFontSizeMobile'      => 14,
				'contentLineHeight'          => 1.8,
				'align'                      => 'left',
				'headingColor'               => '#fff',
				'headingBgColor'             => '#0984ff',
				'headingColorHover'          => '',
				'headingBgColorHover'        => '',
				'bodyColor'                  => '',
				'bodyBgColor'                => '#fff',
				'bodyColorHover'             => '',
				'bodyBgColorHover'           => '',
				'headingTopPadding'          => 15,
				'headingTopPaddingMobile'    => 15,
				'headingTopPaddingTablet'    => 15,
				'headingBottomPadding'       => 15,
				'headingBottomPaddingTablet' => 15,
				'headingBottomPaddingMobile' => 15,
				'headingRightPadding'        => 20,
				'headingRightPaddingMobile'  => 20,
				'headingRightPaddingTablet'  => 20,
				'headingLeftPadding'         => 20,
				'headingLeftPaddingTablet'   => 20,
				'headingLeftPaddingMobile'   => 20,
				'headingTopMargin'           => 0,
				'headingTopMarginMobile'     => 0,
				'headingTopMarginTablet'     => 0,
				'headingBottomMargin'        => 0,
				'headingBottomMarginTablet'  => 0,
				'headingBottomMarginMobile'  => 0,
				'headingRightMargin'         => 0,
				'headingRightMarginMobile'   => 0,
				'headingRightMarginTablet'   => 0,
				'headingLeftMargin'          => 0,
				'headingLeftMarginTablet'    => 0,
				'headingLeftMarginMobile'    => 0,
				'contentTopPadding'          => 15,
				'contentTopPaddingMobile'    => 15,
				'contentTopPaddingTablet'    => 15,
				'contentBottomPadding'       => 15,
				'contentBottomPaddingTablet' => 15,
				'contentBottomPaddingMobile' => 15,
				'contentRightPadding'        => 20,
				'contentRightPaddingMobile'  => 20,
				'contentRightPaddingTablet'  => 20,
				'contentLeftPadding'         => 20,
				'contentLeftPaddingTablet'   => 20,
				'contentLeftPaddingMobile'   => 20,
				'contentTopMargin'           => 0,
				'contentTopMarginMobile'     => 0,
				'contentTopMarginTablet'     => 0,
				'contentBottomMargin'        => 0,
				'contentBottomMarginTablet'  => 0,
				'contentBottomMarginMobile'  => 0,
				'contentRightMargin'         => 0,
				'contentRightMarginMobile'   => 0,
				'contentRightMarginTablet'   => 0,
				'contentLeftMargin'          => 0,
				'contentLeftMarginTablet'    => 0,
				'contentLeftMarginMobile'    => 0,
				'blockWidth'                 => 100,
				'blockBorderStyle'           => 'solid',
				'blockBorderWidth'           => 1,
				'blockBorderRadius'          => '',
				'blockBorderColor'           => '#0984ff',
				'headingBorderStyle'         => '',
				'headingBorderWidth'         => 1,
				'headingBorderRadius'        => 0,
				'headingBorderColor'         => '',
				'bodyBorderStyle'            => '',
				'bodyBorderWidth'            => 1,
				'bodyBorderRadius'           => 0,
				'bodyBorderColor'            => '',
				'tableType'                  => 'unordered',
				'orderListType'              => 'none',
				'headerLayout'               => 'fill',
				'backgroundImage'            => '',
				'backgroundPosition'         => 'center-center',
				'backgroundSize'             => 'cover',
				'backgroundRepeat'           => 'no-repeat',
				'backgroundColor'            => '',
				'backgroundVideo'            => '',
				'backgroundType'             => 'none',
			);
		}

		/**
		 * Get Instagram Block CSS
		 *
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 * @return array Styles.
		 */
		public static function get_responsive_block_instagram_css( $attr, $id ) {
			$defaults = self::get_responsive_block_instagram_default_attributes();
			$attr     = array_merge( $defaults, (array) $attr );

			$mobile_selectors = array();
			$tablet_selectors = array();

			$selectors = array();

			$mobile_selectors = array();

			$tablet_selectors = array();

			$combined_selectors = array(
				'desktop' => $selectors,
				'tablet'  => $tablet_selectors,
				'mobile'  => $mobile_selectors,
			);

			$id  = '.responsive-block-editor-addons-block-instagram.block-' . $id;
			$css = Responsive_Block_Editor_Addons_Frontend_Styles_Helper::responsive_block_editor_addons_generate_all_css( $combined_selectors, $id );

			return $css;
		}

		/**
		 * Get Defaults for instagram block
		 *
		 * @return array
		 */
		public static function get_responsive_block_instagram_default_attributes() {
			return array(
				'block_id'               => '',
			);
		}

		/**
		 * Generate gradient effect
		 *
		 * @param string $color1  primary color.
		 * @param string $color2  secondary color.
		 * @param string $gradient_direction  gradient direction.
		 * @param string $color_location1  primary color location.
		 * @param string $color_location2  secondary color location.
		 */
		public static function generate_background_image_effect(
			$color1,
			$color2,
			$gradient_direction,
			$color_location1,
			$color_location2
		) {
			$css =
				'linear-gradient(' .
				$gradient_direction .
				'deg, ' .
				$color1 .
				' ' .
				$color_location1 .
				'%,' .
				$color2 .
				' ' .
				$color_location2 .
				'%)';

			return $css;
		}

		/**
		 * Get rgb value from hex value
		 *
		 * @param string $hex  color value.
		 * @param string $alpha  opacity.
		 */
		public static function hex_to_rgb( $hex, $alpha = false ) {
			$hex      = str_replace( '#', '', $hex );
			$length   = strlen( $hex );
			$rgb['r'] = hexdec( 6 === $length ? substr( $hex, 0, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 0, 1 ), 2 ) : 0 ) );
			$rgb['g'] = hexdec( 6 === $length ? substr( $hex, 2, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 1, 1 ), 2 ) : 0 ) );
			$rgb['b'] = hexdec( 6 === $length ? substr( $hex, 4, 2 ) : ( 3 === $length ? str_repeat( substr( $hex, 2, 1 ), 2 ) : 0 ) );
			if ( $alpha ) {
				$rgb['a'] = $alpha;
			} else {
				$rgb['a'] = '0.0';
			}
			return implode( array_keys( $rgb ) ) . '(' . implode( ', ', $rgb ) . ')';
		}

		/**
		 * Get CSS value
		 *
		 * @param string $value  CSS value.
		 * @param string $unit  CSS unit.
		 */
		public static function get_css_value( $value = '', $unit = '' ) {

			if ( '' == $value ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
				return $value;
			}

			$css_val = '';

			if ( 0 === $value ) {
				$css_val = 0;
			}

			if ( ! empty( $value ) ) {
				$css_val = esc_attr( $value ) . $unit;
			}

			return $css_val;
		}
	}
}
