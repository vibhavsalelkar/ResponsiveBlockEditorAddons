/**
 * Internal dependencies
 */
import classnames from "classnames";
import Style from "style-it";

/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const { RichText } = wp.editor;

export default class Save extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const {
      headingTitle,
      headingId,
      headingDesc,
      seperatorStyle,
      seperatorPosition,
      headingTag,
      showHeading,
      showSubHeading,
      showSeparator,
      block_id,
    } = this.props.attributes;

    var seprator_output = "";
    if (seperatorStyle !== "none") {
      seprator_output = (
        <div className="responsive-heading-seperator-wrap">
          <div className="responsive-heading-seperator"></div>
        </div>
      );
    }
    return [
      <div
        className={classnames(
          "responsive-block-editor-addons-block-advanced-heading",
          `block-${block_id}`
        )}
      >
        {showHeading && (
          <RichText.Content
            tagName={headingTag}
            value={headingTitle}
            className="responsive-heading-title-text"
            id={headingId}
          />
        )}
        {seperatorPosition == "belowTitle" && showSeparator && seprator_output}
        {showSubHeading && (
          <RichText.Content
            tagName="p"
            value={headingDesc}
            className="responsive-heading-desc-text"
          />
        )}
        {seperatorPosition == "belowDesc" && showSeparator && seprator_output}
      </div>,
    ];
  }
}
