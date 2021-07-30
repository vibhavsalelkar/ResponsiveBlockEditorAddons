/**
 * Dependencies
 */
import InspectorTabs from "../../../components/InspectorTabs";
import InspectorTab from "../../../components/InspectorTab";
import TypographyHelperControl from "../../../settings-components/Typography Settings";
import ResponsiveMarginControl from "../../../settings-components/Responsive Spacing Settings/Responsive Margin Control";
import ResponsivePaddingControl from "../../../settings-components/Responsive Spacing Settings/Responsive Padding Control";
import ColorBackgroundControl from "../../../settings-components/Block Background Settings/Color Background Settings";
import GradientBackgroundControl from "../../../settings-components/Block Background Settings/Gradient Background Settings";
import BlockBorderHelperControl from "../../../settings-components/Block Border Settings";
import BoxShadowControl from "../../../utils/components/box-shadow";


// Setup the block
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

// Import block components
const {
  InspectorControls,
  ColorPalette,
  AlignmentToolbar,
  BlockAlignmentToolbar,
  InspectorAdvancedControls,
} = wp.editor;

// Import Inspector components
const {
  PanelBody,
  BaseControl,
  TextControl,
  ToggleControl,
  SelectControl,
  RangeControl,
  TabPanel,
  Dashicon,
} = wp.components;

export default class Inspector extends Component {
  constructor(props) {
    super(...arguments);
  }

  render() {
    const {
      attributes: {
        block_id,
        tabsStyleD,
        tabsStyleM,
        tabsStyleT,
        tabBorderColor,
        tabBorderWidth,
        tabBackgroundColor,
        tabTitleColor,
        tabTitleActiveColor,
        tabTitleFontFamily,
        tabTitleFontSize,
        tabTitleFontSizeMobile,
        tabTitleFontSizeTablet,
        tabTitleFontWeight,
        tabTitleLineHeight,
        tabContentColor,
        tabContentFontFamily,
        tabContentFontSize,
        tabContentFontSizeMobile,
        tabContentFontSizeTablet,
        tabContentFontWeight,
        tabContentLineHeight,
        alignTabs,
        tabsZindex,
        tabsTopPadding,
        tabsBottomPadding,
        tabsLeftPadding,
        tabsRightPadding,
        tabsTopPaddingTablet,
        tabsBottomPaddingTablet,
        tabsLeftPaddingTablet,
        tabsRightPaddingTablet,
        tabsTopPaddingMobile,
        tabsBottomPaddingMobile,
        tabsLeftPaddingMobile,
        tabsRightPaddingMobile,
        tabsTopMargin,
        tabsBottomMargin,
        tabsLeftMargin,
        tabsRightMargin,
        tabsTopMarginTablet,
        tabsBottomMarginTablet,
        tabsLeftMarginTablet,
        tabsRightMarginTablet,
        tabsTopMarginMobile,
        tabsBottomMarginMobile,
        tabsLeftMarginMobile,
        tabsRightMarginMobile,
        backgroundType,
        backgroundColor,
        backgroundColor1,
        backgroundColor2,
        colorLocation1,
        colorLocation2,
        gradientDirection,
        hoverbackgroundColor1,
        hoverbackgroundColor2,
        hovercolorLocation1,
        hovercolorLocation2,
        hovergradientDirection,
        backgroundHoverColor,
        opacity,
        animationName,
        animationDirection,
        animationRepeat,
        animationDuration,
        animationDelay,
        animationCurve,
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
      },
      setAttributes,
      deviceType,
      className,
    } = this.props;

    const backgroundTypeOptions = [
      { value: "none", label: __("None", "responsive-block-editor-addons") },
      {
        value: "color",
        label: __("Classic", "responsive-block-editor-addons"),
      },
      {
        value: "gradient",
        label: __("Gradient", "responsive-block-editor-addons"),
      },
    ];

    const showAnimationDirections = (animation) => {
      let directionOptions =
        animation === "rotate"
          ? [
              { value: "DownLeft", label: "DownLeft" },
              { value: "DownRight", label: "DownRight" },
              { value: "UpLeft", label: "UpLeft" },
              { value: "UpRight", label: "UpRight" },
            ]
          : animation === "slide" ||
            animation === "flip" ||
            animation === "fold"
          ? [
              { value: "Right", label: "Right" },
              { value: "Left", label: "Left" },
              { value: "Up", label: "Up" },
              { value: "Down", label: "Down" },
            ]
          : [
              { value: "Center", label: "Center" },
              { value: "Right", label: "Right" },
              { value: "Left", label: "Left" },
              { value: "Up", label: "Up" },
              { value: "Down", label: "Down" },
            ];
      return directionOptions;
    };

    return (
      <InspectorControls key="controls">
        <InspectorTabs>
          <InspectorTab key={"content"}>
            <PanelBody
              title={__("Position", "responsive-block-editor-addons")}
              initialOpen={true}
            >
              <Fragment>
                <SelectControl
                  label={__("Position", "responsive-block-editor-addons")}
                  value={tabsStyleD}
                  onChange={(value) => setAttributes({ tabsStyleD: value })}
                  beforeIcon="editor-textcolor"
                  options={[
                    {
                      value: "hstyle3",
                      label: __("Horizontal", "responsive-block-editor-addons"),
                    },
                    {
                      value: "vstyle8",
                      label: __("Vertical", "responsive-block-editor-addons"),
                    },
                  ]}
                />
              </Fragment>
            </PanelBody>
            <PanelBody initialOpen={true}>
              <h2>{__("Alignment", "responsive-block-editor-addons")}</h2>
              <BlockAlignmentToolbar
                value={alignTabs}
                onChange={(value) =>
                  setAttributes({
                    alignTabs: value,
                  })
                }
                controls={["left", "center", "right"]}
                isCollapsed={false}
              />
            </PanelBody>
          </InspectorTab>
          <InspectorTab key={"style"}>
            <PanelBody
              title={__("Tabs", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <RangeControl
                label={__("Border width", "responsive-block-editor-addons")}
                value={tabBorderWidth}
                min={0}
                max={500}
                onChange={(value) => setAttributes({ tabBorderWidth: value })}
              />
              <p className="responsive-setting-label">
                {__("Border Color", "responsive-block-editor-addons")}
              </p>
              <span className="components-base-control__label">
                <span
                  className="component-color-indicator"
                  style={{ backgroundColor: tabBorderColor }}
                ></span>
              </span>
              <ColorPalette
                value={tabBorderColor}
                onChange={(value) => setAttributes({ tabBorderColor: value })}
                allowReset
              />
              <p className="responsive-setting-label">
                {__("Background Color", "responsive-block-editor-addons")}
              </p>
              <span className="components-base-control__label">
                <span
                  className="component-color-indicator"
                  style={{ backgroundColor: tabBackgroundColor }}
                ></span>
              </span>
              <ColorPalette
                value={tabBackgroundColor}
                onChange={(value) =>
                  setAttributes({ tabBackgroundColor: value })
                }
                allowReset
              />
            </PanelBody>
            <PanelBody
              title={__("Title", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <p className="responsive-setting-label">
                {__("Color", "responsive-block-editor-addons")}
              </p>
              <span className="components-base-control__label">
                <span
                  className="component-color-indicator"
                  style={{ backgroundColor: tabTitleColor }}
                ></span>
              </span>
              <ColorPalette
                value={tabTitleColor}
                onChange={(value) => setAttributes({ tabTitleColor: value })}
                allowReset
              />
              <p className="responsive-setting-label">
                {__("Active Color", "responsive-block-editor-addons")}
              </p>
              <span className="components-base-control__label">
                <span
                  className="component-color-indicator"
                  style={{ backgroundColor: tabTitleActiveColor }}
                ></span>
              </span>
              <ColorPalette
                value={tabTitleActiveColor}
                onChange={(value) =>
                  setAttributes({ tabTitleActiveColor: value })
                }
                allowReset
              />
              <hr className="responsive-block-editor-addons-editor__separator" />
              <TypographyHelperControl
                title={__("Typography", "responsive-block-editor-addons")}
                attrNameTemplate="tabTitle%s"
                values={{
                  family: tabTitleFontFamily,
                  size: tabTitleFontSize,
                  sizeMobile: tabTitleFontSizeMobile,
                  sizeTablet: tabTitleFontSizeTablet,
                  weight: tabTitleFontWeight,
                  height: tabTitleLineHeight,
                }}
                showLetterSpacing={false}
                showTextTransform={false}
                setAttributes={setAttributes}
                {...this.props}
              />
            </PanelBody>
            <PanelBody
              title={__("Content", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <p className="responsive-setting-label">
                {__("Color", "responsive-block-editor-addons")}
              </p>
              <span className="components-base-control__label">
                <span
                  className="component-color-indicator"
                  style={{ backgroundColor: tabContentColor }}
                ></span>
              </span>
              <ColorPalette
                value={tabContentColor}
                onChange={(value) => setAttributes({ tabContentColor: value })}
                allowReset
              />
              <hr className="responsive-block-editor-addons-editor__separator" />
              <TypographyHelperControl
                title={__("Typography", "responsive-block-editor-addons")}
                attrNameTemplate="tabContent%s"
                values={{
                  family: tabContentFontFamily,
                  size: tabContentFontSize,
                  sizeMobile: tabContentFontSizeMobile,
                  sizeTablet: tabContentFontSizeTablet,
                  weight: tabContentFontWeight,
                  height: tabContentLineHeight,
                }}
                showLetterSpacing={false}
                showTextTransform={false}
                setAttributes={setAttributes}
                {...this.props}
              />
            </PanelBody>
          </InspectorTab>
          <InspectorTab key={"advance"}>
            <PanelBody
              title={__("Motion Effects", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <PanelBody
                title={__(
                  "Entrance Animation",
                  "responsive-block-editor-addons"
                )}
                initialOpen={false}
              >
                <SelectControl
                  label={__("Animation", "responsive-block-editor-addons")}
                  value={animationName}
                  onChange={(value) => setAttributes({ animationName: value })}
                  options={[
                    { value: "none", label: "None" },
                    { value: "fade", label: __("Fade") },
                    { value: "slide", label: __("Slide") },
                    { value: "bounce", label: __("Bounce") },
                    { value: "zoom", label: __("Zoom") },
                    { value: "flip", label: __("Flip") },
                    { value: "fold", label: __("Fold") },
                    { value: "rotate", label: "Rotate" },
                  ]}
                />
                {animationName !== "none" && (
                  <Fragment>
                    <SelectControl
                      label={__("Direction", "responsive-block-editor-addons")}
                      value={animationDirection}
                      onChange={(value) =>
                        setAttributes({ animationDirection: value })
                      }
                      options={showAnimationDirections(animationName)}
                    />
                    <SelectControl
                      label={__("Repeat", "responsive-block-editor-addons")}
                      value={animationRepeat}
                      onChange={(value) =>
                        setAttributes({ animationRepeat: value })
                      }
                      options={[
                        { value: "once", label: __("Once") },
                        { value: "loop", label: __("Loop") },
                      ]}
                    />
                    <RangeControl
                      label={__("Duration", "responsive-block-editor-addons")}
                      value={animationDuration}
                      min={0}
                      max={2000}
                      allowReset={true}
                      onChange={(value) =>
                        setAttributes({ animationDuration: value })
                      }
                    />
                    <RangeControl
                      label={__("Delay", "responsive-block-editor-addons")}
                      value={animationDelay}
                      min={0}
                      max={3000}
                      allowReset={true}
                      onChange={(value) =>
                        setAttributes({ animationDelay: value })
                      }
                    />
                    <SelectControl
                      label={__("Curve", "responsive-block-editor-addons")}
                      value={animationCurve}
                      onChange={(value) =>
                        setAttributes({ animationCurve: value })
                      }
                      options={[
                        { value: "ease-in-out", label: "ease-in-out" },
                        { value: "ease", label: "ease" },
                        { value: "ease-in", label: "ease-in" },
                        { value: "ease-out", label: "ease-out" },
                        { value: "linear", label: "linear" },
                      ]}
                    />
                  </Fragment>
                )}
              </PanelBody>
            </PanelBody>
            <InspectorAdvancedControls>
              <ResponsiveMarginControl
                attrNameTemplate="tabs%s"
                values={{
                  desktopTop: tabsTopMargin,
                  desktopBottom: tabsBottomMargin,
                  desktopLeft: tabsLeftMargin,
                  desktopRight: tabsRightMargin,

                  tabletTop: tabsTopMarginTablet,
                  tabletBottom: tabsBottomMarginTablet,
                  tabletLeft: tabsLeftMarginTablet,
                  tabletRight: tabsRightMarginTablet,

                  mobileTop: tabsTopMarginMobile,
                  mobileBottom: tabsBottomMarginMobile,
                  mobileLeft: tabsLeftMarginMobile,
                  mobileRight: tabsRightMarginMobile,
                }}
                setAttributes={setAttributes}
                {...this.props}
              />
              <ResponsivePaddingControl
                attrNameTemplate="tabs%s"
                values={{
                  desktopTop: tabsTopPadding,
                  desktopBottom: tabsBottomPadding,
                  desktopLeft: tabsLeftPadding,
                  desktopRight: tabsRightPadding,

                  tabletTop: tabsTopPaddingTablet,
                  tabletBottom: tabsBottomPaddingTablet,
                  tabletLeft: tabsLeftPaddingTablet,
                  tabletRight: tabsRightPaddingTablet,

                  mobileTop: tabsTopPaddingMobile,
                  mobileBottom: tabsBottomPaddingMobile,
                  mobileLeft: tabsLeftPaddingMobile,
                  mobileRight: tabsRightPaddingMobile,
                }}
                setAttributes={setAttributes}
                {...this.props}
              />
              <RangeControl
                label={__("Z-Index", "responsive-block-editor-addons")}
                value={tabsZindex}
                min={-10}
                max={500}
                allowReset={true}
                onChange={(value) => setAttributes({ tabsZindex: value })}
              />
            </InspectorAdvancedControls>
            <PanelBody
              title={__("Background", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <SelectControl
                label={__("Background Type", "responsive-block-editor-addons")}
                value={backgroundType}
                onChange={(value) => setAttributes({ backgroundType: value })}
                options={backgroundTypeOptions}
              />
              {"color" == backgroundType && (
                <TabPanel
                  className="responsive-block-editor-addons-inspect-tabs responsive-block-editor-addons-inspect-tabs-col-2"
                  activeClass="active-tab"
                  tabs={[
                    {
                      name: "normal",
                      title: __("Normal"),
                      className: "responsive-block-editor-addons-normal-tab",
                    },
                    {
                      name: "hover",
                      title: __("Hover"),
                      className: "responsive-block-editor-addons-hover-tab",
                    },
                  ]}
                >
                  {(tabName) => {
                    let btn_color_tab;
                    if ("normal" === tabName.name) {
                      btn_color_tab = (
                        <Fragment>
                          <ColorBackgroundControl {...this.props} />
                        </Fragment>
                      );
                    } else {
                      btn_color_tab = (
                        <Fragment>
                          <p className="responsive-setting-label">
                            {__(
                              "Hover Background Color",
                              "responsive-block-editor-addons"
                            )}
                            <span className="components-base-control__label">
                              <span
                                className="component-color-indicator"
                                style={{
                                  backgroundColor: backgroundHoverColor,
                                }}
                              ></span>
                            </span>
                          </p>
                          <ColorPalette
                            value={backgroundHoverColor}
                            onChange={(colorValue) =>
                              setAttributes({
                                backgroundHoverColor: colorValue,
                              })
                            }
                            allowReset
                          />
                        </Fragment>
                      );
                    }
                    return <div>{btn_color_tab}</div>;
                  }}
                </TabPanel>
              )}
              {"gradient" == backgroundType && (
                <GradientBackgroundControl
                  {...this.props}
                  showHoverGradient={true}
                />
              )}
              <RangeControl
                label={__("Opacity", "responsive-block-editor-addons")}
                value={opacity}
                onChange={(value) =>
                  setAttributes({ opacity: value !== undefined ? value : 20 })
                }
                min={0}
                max={100}
                allowReset
              />
            </PanelBody>
            <PanelBody
              title={__("Border", "responsive-block-editor-addons")}
              initialOpen={false}
            >
              <BlockBorderHelperControl
                attrNameTemplate="block%s"
                values={{
                  radius: blockBorderRadius,
                  style: blockBorderStyle,
                  width: blockBorderWidth,
                  color: blockBorderColor,
                }}
                setAttributes={setAttributes}
                {...this.props}
              />
              <PanelBody title={__("Box Shadow", "responsive-block-editor-addons")}
								initialOpen={false}
							>
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
									boxShadowSpread={{ value: boxShadowSpread, label: __("Spread") }}
									boxShadowPosition={{
										value: boxShadowPosition,
										label: __("Position"),
									}}
								/>
							</PanelBody>
            </PanelBody>
          </InspectorTab>
        </InspectorTabs>
      </InspectorControls>
    );
  }
}