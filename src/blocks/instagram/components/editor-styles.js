/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from "../../../generateCSS";
import generateCSSUnit from "../../../generateCSSUnit";

function EditorStyles(props) {
  const { 
    block_id,
    columns,
    imagesGap,
    borderRadius, 
  } = props.attributes;

  var selectors = {
    " .responsive-block-editor-addons-intro-page": {
      border: '1px solid black',
      padding: '0 20px',
    },
    " .responsive-block-editor-addons-intro-page p > a": {
      color: "blue",
    },
    " .responsive-block-editor-addons-instagram-posts-container": {
      "grid-template-columns": `repeat(${columns}, 1fr)`,
      "grid-gap": generateCSSUnit(imagesGap,"px"),
    },
    " .responsive-block-editor-addons-instagram-image": {
      "border-radius": generateCSSUnit(borderRadius, "%"),
    }
  };

  var mobile_selectors = {};

  var tablet_selectors = {};

  var styling_css = "";
  var id = `.responsive-block-editor-addons-block-instagram.block-${block_id}`;

  styling_css = generateCSS(selectors, id);
  styling_css += generateCSS(tablet_selectors, id, true, "tablet");
  styling_css += generateCSS(mobile_selectors, id, true, "mobile");

  return styling_css;
}

export default EditorStyles;
