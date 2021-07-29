/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from "../../../../generateCSS";
import generateCSSUnit from "../../../../generateCSSUnit";
import { hexToRgba } from "../../../../utils";

function EditorStyles(props) {
  const {
    title,
    content,
    icon,
    iconActive,
    layout,
    headingTag,
    blockBorderStyle,
    blockBorderWidth,
    blockBorderRadius,
    blockBorderColor,
    boxShadowColor,
    boxShadowHOffset,
    boxShadowVOffset,
    boxShadowBlur,
    boxShadowSpread,
    boxShadowPosition,
    titlePadding,
    titlePaddingTablet,
    titlePaddingMobile,
    contentPadding,
    contentPaddingTablet,
    contentPaddingMobile,
  } = props.attributes;

  var selectors = {};
  var tablet_selectors = {};
  var mobile_selectors = {};

  var boxShadowPositionCSS = boxShadowPosition;

  if ("outset" === boxShadowPosition) {
    boxShadowPositionCSS = "";
  }
  selectors = {
    " ": {
      "box-shadow":
        boxShadowPositionCSS +
        " " +
        generateCSSUnit(boxShadowHOffset, "px") +
        " " +
        generateCSSUnit(boxShadowVOffset, "px") +
        " " +
        generateCSSUnit(boxShadowBlur, "px") +
        " " +
        generateCSSUnit(boxShadowSpread, "px") +
        " " +
        boxShadowColor,
      "border-color": blockBorderColor,
      "border-style": blockBorderStyle,
      "border-width": generateCSSUnit(blockBorderWidth, "px"),
      "border-radius": generateCSSUnit(blockBorderRadius, "px"),
      overflow: "hidden",
    },
    " .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles": {
      "box-shadow":
        boxShadowPositionCSS == "inset"
          ? boxShadowPositionCSS +
            " " +
            generateCSSUnit(boxShadowHOffset, "px") +
            " " +
            generateCSSUnit(boxShadowVOffset, "px") +
            " " +
            generateCSSUnit(boxShadowBlur, "px") +
            " " +
            generateCSSUnit(boxShadowSpread, "px") +
            " " +
            boxShadowColor
          : "",
      padding: generateCSSUnit(titlePadding, "px"),
    },
    " .responsive-block-editor-addons-accordion-content span": {
      margin: "0",
      padding: generateCSSUnit(contentPadding, "px"),
    },
  };

  tablet_selectors = {
    " .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles": {
        padding: generateCSSUnit(titlePaddingTablet, "px"),
    },
    " .responsive-block-editor-addons-accordion-content span": {
        padding: generateCSSUnit(contentPaddingTablet, "px"),
    },
  };

  mobile_selectors = {
    " .responsive-block-editor-addons-accordion-titles-button.responsive-block-editor-addons-accordion-titles": {
        padding: generateCSSUnit(titlePaddingMobile, "px"),
    },
    " .responsive-block-editor-addons-accordion-content span": {
        padding: generateCSSUnit(contentPaddingMobile, "px"),
    },
  };

  var styling_css = "";
  var id = `.responsive-block-editor-addons-accordion-item__outer-wrap.responsive-block-editor-addons-block-${props.clientId}`;

  styling_css = generateCSS(selectors, id);

  styling_css += generateCSS(tablet_selectors, id, true, "tablet");

  styling_css += generateCSS(mobile_selectors, id, true, "mobile");

  return styling_css;
}

export default EditorStyles;
