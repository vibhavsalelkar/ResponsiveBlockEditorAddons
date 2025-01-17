/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from "../../../generateCSS";
import generateCSSUnit from "../../../generateCSSUnit";

function EditorStyles(props) {
  const {
    block_id,
    expandAlignment,
    linkSpace,
    textSpace,
    titleSpace,
    titleFontFamily,
    titleFontSize,
    titleFontWeight,
    titleLineHeight,
    textFontFamily,
    textFontSize,
    textFontWeight,
    textLineHeight,
    linkFontFamily,
    linkFontSize,
    linkFontWeight,
    linkLineHeight,
    textColor,
    linkColor,
    titleColor,
  } = props.attributes;

  var selectors = {
    " .responsive-block-editor-addons-expand-block-content": {
      "text-align": expandAlignment,
    },

    " .responsive-block-editor-addons-expand-title": {
      "margin-bottom": generateCSSUnit(titleSpace, "px"),
      "font-family": titleFontFamily,
      "font-size": generateCSSUnit(titleFontSize, "px"),
      "font-weight": titleFontWeight,
      "line-height": titleLineHeight,
      "color": titleColor,
    },

    " .responsive-block-editor-addons-expand-less-text": {
      "margin-bottom": generateCSSUnit(textSpace, "px"),
      "font-family": textFontFamily,
      "font-size": generateCSSUnit(textFontSize, "px"),
      "font-weight": textFontWeight,
      "line-height": textLineHeight,
      "color": textColor,
    },

    " .responsive-block-editor-addons-expand-more-toggle-text": {
      "margin-bottom": generateCSSUnit(linkSpace, "px"),
      "font-family": linkFontFamily,
      "font-size": generateCSSUnit(linkFontSize, "px"),
      "font-weight": linkFontWeight,
      "line-height": linkLineHeight,
      "color": linkColor,
    },

    " .responsive-block-editor-addons-expand-more-text": {
      "margin-bottom": generateCSSUnit(textSpace, "px"),
      "font-family": textFontFamily,
      "font-size": generateCSSUnit(textFontSize, "px"),
      "font-weight": textFontWeight,
      "line-height": textLineHeight,
      "color": textColor,
    },

    " .responsive-block-editor-addons-expand-less-toggle-text": {
      "margin-bottom": generateCSSUnit(linkSpace, "px"),
      "font-family": linkFontFamily,
      "font-size": generateCSSUnit(linkFontSize, "px"),
      "font-weight": linkFontWeight,
      "line-height": linkLineHeight,
      "color": linkColor,
    },
  };

  var mobile_selectors = {};

  var tablet_selectors = {};

  var styling_css = "";
  var id = `.responsive-block-editor-addons-block-expand.block-${block_id}`;

  styling_css = generateCSS(selectors, id);
  styling_css += generateCSS(tablet_selectors, id, true, "tablet");
  styling_css += generateCSS(mobile_selectors, id, true, "mobile");

  return styling_css;
}

export default EditorStyles;
