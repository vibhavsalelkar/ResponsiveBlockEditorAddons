/**
 * BLOCK: Accordion - Item
 */

import classnames from "classnames";
import renderSVG from "../../../../renderIcon";
import BoxShadowControl from "../../../../utils/components/box-shadow";
import EditorStyles from "./editor-styles";
import BlockBorderHelperControl from "../../../../settings-components/Block Border Settings";
import ResponsiveSpacingControl from "../../../../settings-components/Responsive Spacing Settings";
import InspectorTab from "../../../../components/InspectorTab"
import InspectorTabs from "../../../../components/InspectorTabs"

const { __ } = wp.i18n;

const { Component, Fragment } = wp.element;

const {
  ColorPalette,
  InspectorControls,
  InnerBlocks,
  PanelColorSettings,
  RichText,
} = wp.blockEditor;

const {
  PanelBody,
  SelectControl,
  RangeControl,
  TabPanel,
  ButtonGroup,
  Button,
  Dashicon,
  ToggleControl,
  IconButton,
} = wp.components;

class ResponsiveBlockEditorAddonsAccordionItemEdit extends Component {
  constructor() {
    super(...arguments);
    this.state = {
      isFocused: "false",
    };
  }

  componentDidMount() {
    // Assigning block_id in the attribute.
    this.props.setAttributes({ block_id: this.props.clientId });
    this.props.setAttributes({ classMigrate: true });

    // Pushing Style tag for this block css.
    const $style = document.createElement("style");
    $style.setAttribute(
      "id",
      "responsive-block-editor-addons-accordian-item-style-" +
      this.props.clientId
    );
    document.head.appendChild($style);
  }
  componentDidUpdate(prevProps, prevState) {
    if (
      !this.props.isSelected &&
      prevProps.isSelected &&
      this.state.isFocused
    ) {
      this.setState({
        isFocused: "false",
      });
    }
    if (this.props.isSelected && !prevProps.isSelected) {
      this.setState({
        isFocused: true,
      });
    }

    var element = document.getElementById(
      "responsive-block-editor-addons-accordian-item-style-" +
      this.props.clientId
    );

    if (null !== element && undefined !== element) {
      element.innerHTML = EditorStyles(this.props);
    }
  }
  render() {
    const { attributes, setAttributes } = this.props;
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
    } = attributes;

    var boxShadowPositionCSS = boxShadowPosition;

    if ("outset" === boxShadowPosition) {
      boxShadowPositionCSS = "";
    }

    const accordionRenderIcon = () => {
      return (
        <Fragment>
          <span className="responsive-block-editor-addons-icon responsive-block-editor-addons-accordion-icon-wrap">
            {renderSVG(icon)}
          </span>
          <span className="responsive-block-editor-addons-icon-active responsive-block-editor-addons-accordion-icon-wrap">
            {renderSVG(iconActive)}
          </span>
        </Fragment>
      );
    };
    const accordionChildControls = () => {
      return (
        <InspectorControls key="inspector">
          <InspectorTabs>
            <InspectorTab key={'content'}>

            </InspectorTab>
            <InspectorTab key={'style'}>
              <PanelBody
                title={__("Style")}
                initialOpen={false}
                className="responsive_block_editor_addons__url-panel-body"
              >
                <p className="responsive-block-editor-addons-settings-notice">
                  {__("For the styling options please select the Parent Block.")}
                </p>
                <hr className="responsive-block-editor-addons-editor__separator" />
                <h2>{__("Border")}</h2>
                <BlockBorderHelperControl
                  attrNameTemplate="block%s"
                  values={{ radius: blockBorderRadius, style: blockBorderStyle, width: blockBorderWidth, color: blockBorderColor }}
                  setAttributes={setAttributes}
                  {...this.props}
                />
                <BoxShadowControl
                  setAttributes={setAttributes}
                  label={__("Box Shadow")}
                  boxShadowColor={{ value: boxShadowColor, label: __("Color") }}
                  boxShadowHOffset={{
                    value: boxShadowHOffset,
                    label: __("Horizontal"),
                  }}
                  boxShadowVOffset={{
                    value: boxShadowVOffset,
                    label: __("Vertical"),
                  }}
                  boxShadowBlur={{ value: boxShadowBlur, label: __("Blur") }}
                  boxShadowSpread={{
                    value: boxShadowSpread,
                    label: __("Spread"),
                  }}
                  boxShadowPosition={{
                    value: boxShadowPosition,
                    label: __("Position"),
                  }}
                />
              </PanelBody>
              <PanelBody
                title={__("Spacing")}
                initialOpen={false}
                className="responsive_block_editor_addons__url-panel-body"
              >
                <ResponsiveSpacingControl
                  title={"Title Padding"}
                  attrNameTemplate="titlePadding%s"
                  values={{ desktop: titlePadding, tablet: titlePaddingTablet, mobile: titlePaddingMobile }}
                  setAttributes={setAttributes}
                  {...this.props}
                />
                <ResponsiveSpacingControl
                  title={"Content Padding"}
                  attrNameTemplate="contentPadding%s"
                  values={{ desktop: contentPadding, tablet: contentPaddingTablet, mobile: contentPaddingMobile }}
                  setAttributes={setAttributes}
                  {...this.props}
                />
              </PanelBody>
            </InspectorTab>
            <InspectorTab key={'advance'}>

            </InspectorTab>
          </InspectorTabs>
        </InspectorControls>
      );
    };

    const accordionRenderHtml = () => {
      return (
        <div className="responsive-block-editor-addons-accordion-item__wrapper">
          <div
            className="responsive-block-editor-addons-accordion-item"
            role="tab"
          >
            <div className="responsive-block-editor-addons-accordion-titles-button responsive-block-editor-addons-accordion-titles">
              {"accordion" === layout && accordionRenderIcon()}
              <RichText
                tagName={"span" != headingTag ? headingTag : "div"}
                placeholder={__("Title")}
                value={title}
                onChange={(value) => setAttributes({ title: value })}
                className="responsive-block-editor-addons-title"
                multiline={false}
                allowedFormats={[
                  "core/bold",
                  "core/italic",
                  "core/strikethrough",
                ]}
              />
            </div>
            <div className="responsive-block-editor-addons-accordion-content">
              <span>
                <RichText
                  tagName="p"
                  placeholder={__("Content")}
                  value={content}
                  onChange={(value) => setAttributes({ content: value })}
                  multiline={false}
                  allowedFormats={[
                    "core/bold",
                    "core/italic",
                    "core/strikethrough",
                    "core/link",
                  ]}
                />
              </span>
            </div>
          </div>
        </div>
      );
    };
    return (
      <Fragment>
        <InspectorControls>{accordionChildControls}</InspectorControls>
        <div
          className={classnames(
            "responsive-block-editor-addons-accordion-item__outer-wrap",
            `responsive-block-editor-addons-block-${this.props.clientId}`,
            this.props.isSelected && false !== this.state.isFocused
              ? "responsive-block-editor-addons-accordion__active"
              : ""
          )}
        >
          {accordionRenderHtml()}
        </div>
      </Fragment>
    );
  }
}

export default ResponsiveBlockEditorAddonsAccordionItemEdit;
