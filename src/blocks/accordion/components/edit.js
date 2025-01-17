/**
 * BLOCK: Accordion
 */

import classnames from "classnames";
import icons from "../../../utils/components/icons";
import renderSVG from "../../../renderIcon";
import FontIconPicker from "@fonticonpicker/react-fonticonpicker";
import times from "lodash/times";
import memoize from "memize";
import ResponsiveBlocksIcon from "../../../ResponsiveBlocksIcon.json";

import fontOptions from "../../../utils/googlefonts";
import { loadGoogleFont } from "../../../utils/font";
import EditorStyles from "./editor-styles";

const { __ } = wp.i18n;
const { compose } = wp.compose;
const { select, withSelect } = wp.data;
const { Component, Fragment } = wp.element;

const {
  ColorPalette,
  InspectorControls,
  InnerBlocks,
  PanelColorSettings,
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

const ALLOWED_BLOCKS = ["responsive-block-editor-addons/accordion-item"];

const accordion = [];

let svg_icons = Object.keys(ResponsiveBlocksIcon);
class ResponsiveBlockEditorAddonsAccordionEdit extends Component {
  constructor() {
    super(...arguments);
    this.onchangeIcon = this.onchangeIcon.bind(this);
    this.onchangeActiveIcon = this.onchangeActiveIcon.bind(this);
    this.onchangeLayout = this.onchangeLayout.bind(this);
    this.onchangeTag = this.onchangeTag.bind(this);
  }

  componentDidMount() {
    const { attributes, setAttributes } = this.props;

    const {
      titleBottomPaddingDesktop,
      vtitlePaddingDesktop,
      titleLeftPaddingDesktop,
      htitlePaddingDesktop,
      titleBottomPaddingTablet,
      vtitlePaddingTablet,
      titleLeftPaddingTablet,
      htitlePaddingTablet,
      titleBottomPaddingMobile,
      vtitlePaddingMobile,
      titleLeftPaddingMobile,
      htitlePaddingMobile,
    } = attributes;

    // Assigning block_id in the attribute.
    setAttributes({ block_id: this.props.clientId });

    setAttributes({ schema: JSON.stringify(this.props.schemaJsonData) });
    // Pushing Style tag for this block css.
    const $style = document.createElement("style");
    $style.setAttribute(
      "id",
      "responsive-block-editor-addons-style-accordion-style-" +
        this.props.clientId
    );
    document.head.appendChild($style);

    for (var i = 1; i <= 2; i++) {
      accordion.push({
        title: "What is Accordion?",
        content:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      });
    }

    if (10 === titleBottomPaddingDesktop && 10 !== vtitlePaddingDesktop) {
      setAttributes({ titleBottomPaddingDesktop: vtitlePaddingDesktop });
    }
    if (10 === titleLeftPaddingDesktop && 10 !== htitlePaddingDesktop) {
      setAttributes({ titleLeftPaddingDesktop: htitlePaddingDesktop });
    }

    if (10 === titleBottomPaddingTablet && 10 !== vtitlePaddingTablet) {
      setAttributes({ titleBottomPaddingTablet: vtitlePaddingTablet });
    }
    if (10 === titleLeftPaddingTablet && 10 !== htitlePaddingTablet) {
      setAttributes({ titleLeftPaddingTablet: htitlePaddingTablet });
    }

    if (10 === titleBottomPaddingMobile && 10 !== vtitlePaddingMobile) {
      setAttributes({ titleBottomPaddingMobile: vtitlePaddingMobile });
    }
    if (10 === titleLeftPaddingMobile && 10 !== htitlePaddingMobile) {
      setAttributes({ titleLeftPaddingMobile: htitlePaddingMobile });
    }
  }

  componentDidUpdate(prevProps, prevState) {
    if (
      JSON.stringify(this.props.schemaJsonData) !==
      JSON.stringify(prevProps.schemaJsonData)
    ) {
      this.props.setAttributes({
        schema: JSON.stringify(this.props.schemaJsonData),
      });
    }
    var element = document.getElementById(
      "responsive-block-editor-addons-style-accordion-style-" +
        this.props.clientId
    );

    if (null !== element && undefined !== element) {
      element.innerHTML = EditorStyles(this.props);
    }
  }
  onchangeIcon(value) {
    const { setAttributes } = this.props;
    let getChildBlocks = select("core/block-editor").getBlocks(
      this.props.clientId
    );
    getChildBlocks.forEach((accordionChild, key) => {
      accordionChild.attributes.icon = value;
    });

    setAttributes({ icon: value });
  }
  onchangeActiveIcon(value) {
    const { setAttributes } = this.props;
    const getChildBlocks = select("core/block-editor").getBlocks(
      this.props.clientId
    );

    getChildBlocks.forEach((accordionChild, key) => {
      accordionChild.attributes.iconActive = value;
    });

    setAttributes({ iconActive: value });
  }
  onchangeLayout(value) {
    const { setAttributes } = this.props;
    const getChildBlocks = select("core/block-editor").getBlocks(
      this.props.clientId
    );

    getChildBlocks.forEach((accordionChild, key) => {
      accordionChild.attributes.layout = value;
    });

    setAttributes({ layout: value });
  }
  onchangeTag(value) {
    const { setAttributes } = this.props;
    const getChildBlocks = select("core/block-editor").getBlocks(
      this.props.clientId
    );

    getChildBlocks.forEach((accordionChild, key) => {
      accordionChild.attributes.headingTag = value;
    });

    setAttributes({ headingTag: value });
  }

  render() {
    const { attributes, setAttributes } = this.props;
    const {
      block_id,
      layout,
      inactiveOtherItems,
      expandFirstItem,
      rowsGap,
      columnsGap,
      align,
      titleActiveTextColor,
      titleActiveBackgroundColor,
      titleTextColor,
      iconColor,
      iconActiveColor,
      titleFontWeight,
      titleFontFamily,
      titleFontSize,
      titleLineHeight,
      contentFontWeight,
      contentFontSize,
      contentFontFamily,
      contentLineHeight,
      icon,
      iconSizeType,
      iconActive,
      iconAlign,
      iconSizeMobile,
      iconSizeTablet,
      iconSize,
      columns,
      equalHeight,
      titleBackgroundColorOpacity,
      marginV,
      marginH,
      titleSecondaryBackgroundColor,
      titleGradientDegree,
      titleBgGradient,
      titleBackgroundColor,
      contentTextColor,
      contentSecondaryBackgroundColor,
      contentGradientDegree,
      contentBgGradient,
      contentBackgroundColor,
      contentBackgroundColorOpacity,
    } = attributes;

    const fontWeightOptions = [
      {
        value: "",
        label: __("Default", "responsive-block-editor-addons"),
      },
      {
        value: "100",
        label: __("100", "responsive-block-editor-addons"),
      },
      {
        value: "200",
        label: __("200", "responsive-block-editor-addons"),
      },
      {
        value: "300",
        label: __("300", "responsive-block-editor-addons"),
      },
      {
        value: "400",
        label: __("400", "responsive-block-editor-addons"),
      },
      {
        value: "500",
        label: __("500", "responsive-block-editor-addons"),
      },
      {
        value: "600",
        label: __("600", "responsive-block-editor-addons"),
      },
      {
        value: "700",
        label: __("700", "responsive-block-editor-addons"),
      },
      {
        value: "800",
        label: __("800", "responsive-block-editor-addons"),
      },
      {
        value: "900",
        label: __("900", "responsive-block-editor-addons"),
      },
    ];
    const getAccordionItemTemplate = memoize((accordion_count, accordion) => {
      return times(accordion_count, (n) => [
        "responsive-block-editor-addons/accordion-item",
        accordion[n],
      ]);
    });

    const equalHeightClass = equalHeight
      ? "responsive-block-editor-addons-accordion-equal-height"
      : "";

    const accordionGeneralSettings = () => {
      return (
        <PanelBody
          title={__("General")}
          initialOpen={true}
          className="responsive_block_editor_addons__url-panel-body"
        >
          <SelectControl
            label={__("Layout")}
            value={layout}
            options={[
              { value: "accordion", label: __("Accordion") },
              { value: "grid", label: __("Grid") },
            ]}
            onChange={(value) => this.onchangeLayout(value)}
          />
          {"accordion" === layout && (
            <Fragment>
              <ToggleControl
                label={__("Collapse other items")}
                checked={inactiveOtherItems}
                onChange={(value) =>
                  setAttributes({ inactiveOtherItems: !inactiveOtherItems })
                }
              />
              {true === inactiveOtherItems && (
                <ToggleControl
                  label={__("Expand First Item")}
                  checked={expandFirstItem}
                  onChange={(value) =>
                    setAttributes({ expandFirstItem: !expandFirstItem })
                  }
                />
              )}
            </Fragment>
          )}

          <hr className="responsive-block-editor-addons-editor__separator" />
          {"grid" === layout && (
            <RangeControl
              label={__("Columns")}
              value={columns}
              onChange={(value) => setAttributes({ columns: value })}
              min={0}
              max={4}
            />
          )}
          {"grid" === layout && (
            <Fragment>
              <h2> {__("Alignment")}</h2>
              <IconButton
                key={"left"}
                icon="editor-alignleft"
                label="Left"
                onClick={() => setAttributes({ align: "left" })}
                aria-pressed={"left" === align}
                isPrimary={"left" === align}
              />
              <IconButton
                key={"center"}
                icon="editor-aligncenter"
                label="Right"
                onClick={() => setAttributes({ align: "center" })}
                aria-pressed={"center" === align}
                isPrimary={"center" === align}
              />
              <IconButton
                key={"right"}
                icon="editor-alignright"
                label="Right"
                onClick={() => setAttributes({ align: "right" })}
                aria-pressed={"right" === align}
                isPrimary={"right" === align}
              />
            </Fragment>
          )}
          {"accordion" === layout && accordionIconSettings()}
        </PanelBody>
      );
    };

    const accordionColorSettings = () => {
      return (
        <PanelBody
          title={__("Color")}
          initialOpen={false}
          className="responsive_block_editor_addons__url-panel-body"
        >
          <PanelColorSettings
            title={__("Title", "responsive-block-editor-addons")}
            initialOpen={false}
            colorSettings={[
              {
                value: titleTextColor,
                onChange: (value) => setAttributes({ titleTextColor: value }),
                label: __("Text color", "responsive-block-editor-addons"),
              },
              {
                value: titleBackgroundColor,
                onChange: (value) =>
                  setAttributes({ titleBackgroundColor: value }),
                label: __("Background color", "responsive-block-editor-addons"),
              },
              {
                value: titleActiveTextColor,
                onChange: (value) =>
                  setAttributes({ titleActiveTextColor: value }),
                label: __(
                  "Active Text color",
                  "responsive-block-editor-addons"
                ),
              },
              {
                value: titleActiveBackgroundColor,
                onChange: (value) =>
                  setAttributes({ titleActiveBackgroundColor: value }),
                label: __(
                  "Active Background color",
                  "responsive-block-editor-addons"
                ),
              },
            ]}
          >
            <ToggleControl
              label="Gradient Background"
              checked={titleBgGradient}
              onChange={() =>
                this.props.setAttributes({
                  titleBgGradient: !titleBgGradient,
                })
              }
            />
            {titleBgGradient && (
              <PanelColorSettings
                title={__(
                  "Secondary Background Color",
                  "responsive-block-editor-addons"
                )}
                initialOpen={true}
                colorSettings={[
                  {
                    label: __(
                      "Secondary Background Color",
                      "responsive-block-editor-addons"
                    ),
                    value: titleSecondaryBackgroundColor,
                    onChange: (value) =>
                      setAttributes({ titleSecondaryBackgroundColor: value }),
                  },
                ]}
              ></PanelColorSettings>
            )}

            {titleBgGradient && (
              <RangeControl
                label={__("Gradient Degree", "responsive-block-editor-addons")}
                value={titleGradientDegree}
                onChange={(value) =>
                  setAttributes({
                    titleGradientDegree: value !== undefined ? value : 100,
                  })
                }
                min={0}
                max={360}
              />
            )}
            <RangeControl
              label={__(
                "Background Color Opacity",
                "responsive-block-editor-addons"
              )}
              value={titleBackgroundColorOpacity}
              onChange={(value) =>
                setAttributes({
                  titleBackgroundColorOpacity:
                    value !== undefined ? value : 100,
                })
              }
              min={0}
              max={100}
            />
          </PanelColorSettings>
          <PanelColorSettings
            title={__("Content", "responsive-block-editor-addons")}
            initialOpen={false}
            colorSettings={[
              {
                value: contentTextColor,
                onChange: (value) => setAttributes({ contentTextColor: value }),
                label: __("Text color", "responsive-block-editor-addons"),
              },
              {
                value: contentBackgroundColor,
                onChange: (value) =>
                  setAttributes({ contentBackgroundColor: value }),
                label: __("Background color", "responsive-block-editor-addons"),
              },
            ]}
          >
            <ToggleControl
              label="Gradient Background"
              checked={contentBgGradient}
              onChange={() =>
                this.props.setAttributes({
                  contentBgGradient: !contentBgGradient,
                })
              }
            />
            {contentBgGradient && [
              <PanelColorSettings
                title={__(
                  "Secondary Background Color",
                  "responsive-block-editor-addons"
                )}
                initialOpen={true}
                colorSettings={[
                  {
                    label: __(
                      "Secondary Background Color",
                      "responsive-block-editor-addons"
                    ),
                    value: contentSecondaryBackgroundColor,
                    onChange: (value) =>
                      setAttributes({ contentSecondaryBackgroundColor: value }),
                  },
                ]}
              ></PanelColorSettings>,
              <RangeControl
                label={__("Gradient Degree", "responsive-block-editor-addons")}
                value={contentGradientDegree}
                onChange={(value) =>
                  setAttributes({
                    contentGradientDegree: value !== undefined ? value : 100,
                  })
                }
                min={0}
                max={360}
              />,
            ]}
            <RangeControl
              label={__(
                "Background Color Opacity",
                "responsive-block-editor-addons"
              )}
              value={contentBackgroundColorOpacity}
              onChange={(value) =>
                setAttributes({
                  contentBackgroundColorOpacity:
                    value !== undefined ? value : 100,
                })
              }
              min={0}
              max={100}
            />
          </PanelColorSettings>
        </PanelBody>
      );
    };
    const accordionTypographySettings = () => {
      return (
        <PanelBody
          title={__("Typography")}
          initialOpen={false}
          className="responsive_block_editor_addons__url-panel-body"
        >
          <PanelBody
            title={__("Title", "responsive-block-editor-addons")}
            initialOpen={false}
          >
            <SelectControl
              label={__("Font Family", "responsive-block-editor-addons")}
              options={fontOptions}
              value={titleFontFamily}
              onChange={(value) => {
                setAttributes({
                  titleFontFamily: value,
                }),
                  loadGoogleFont(value);
              }}
            />
            <RangeControl
              label={__("Font Size", "responsive-block-editor-addons")}
              value={titleFontSize}
              onChange={(value) =>
                this.props.setAttributes({
                  titleFontSize: value,
                })
              }
              min={0}
              max={100}
              step={1}
            />
            <SelectControl
              label={__("Font Weight", "responsive-block-editor-addons")}
              options={fontWeightOptions}
              value={titleFontWeight}
              onChange={(value) =>
                this.props.setAttributes({
                  titleFontWeight: value,
                })
              }
            />
            <RangeControl
              label={__("Line Height", "responsive-block-editor-addons")}
              value={titleLineHeight}
              onChange={(value) =>
                this.props.setAttributes({
                  titleLineHeight: value,
                })
              }
              min={0}
              max={100}
              step={0.01}
            />
          </PanelBody>
          <PanelBody
            title={__("Content", "responsive-block-editor-addons")}
            initialOpen={false}
          >
            <SelectControl
              label={__("Font Family", "responsive-block-editor-addons")}
              options={fontOptions}
              value={contentFontFamily}
              onChange={(value) => {
                setAttributes({
                  contentFontFamily: value,
                }),
                  loadGoogleFont(value);
              }}
            />
            <RangeControl
              label={__("Font Size", "responsive-block-editor-addons")}
              value={contentFontSize}
              onChange={(value) =>
                this.props.setAttributes({
                  contentFontSize: value,
                })
              }
              min={0}
              max={100}
              step={1}
            />
            <SelectControl
              label={__("Font Weight", "responsive-block-editor-addons")}
              options={fontWeightOptions}
              value={contentFontWeight}
              onChange={(value) =>
                this.props.setAttributes({
                  contentFontWeight: value,
                })
              }
            />
            <RangeControl
              label={__("Line Height", "responsive-block-editor-addons")}
              value={contentLineHeight}
              onChange={(value) =>
                this.props.setAttributes({
                  contentLineHeight: value,
                })
              }
              min={0}
              max={100}
              step={0.01}
            />
          </PanelBody>
        </PanelBody>
      );
    };
    const accordionStylingSettings = () => {
      return (
        <PanelBody
          title={__("Spacing")}
          initialOpen={false}
          className="responsive_block_editor_addons__url-panel-body"
        >
          <RangeControl
            label={__("Rows Gap (px)")}
            value={rowsGap}
            onChange={(value) => setAttributes({ rowsGap: value })}
            min={0}
            max={50}
          />
          {"grid" === layout && (
            <Fragment>
              <RangeControl
                label={__("Columns Gap (px)")}
                value={columnsGap}
                onChange={(value) => setAttributes({ columnsGap: value })}
                min={0}
                max={50}
              />
              <ToggleControl
                label={__("Equal Height")}
                checked={equalHeight}
                onChange={(value) =>
                  setAttributes({ equalHeight: !equalHeight })
                }
              />
            </Fragment>
          )}
          <RangeControl
            label={__("Vertical Margin")}
            value={marginV}
            onChange={(value) => setAttributes({ marginV: value })}
            min={0}
            max={100}
          />
          <RangeControl
            label={__("Horizontal Margin")}
            value={marginH}
            onChange={(value) => setAttributes({ marginH: value })}
            min={0}
            max={100}
          />
        </PanelBody>
      );
    };
    const accordionIconSettings = () => {
      return (
        <Fragment>
          <h2> {__("Icon")} </h2>
          <p className="components-base-control__label">{__("Expand")}</p>
          <FontIconPicker
            icons={svg_icons}
            renderFunc={renderSVG}
            theme="default"
            value={icon}
            onChange={(value) => this.onchangeIcon(value)}
            isMulti={false}
            noSelectedPlaceholder={__("Select Icon")}
          />
          <p className="components-base-control__label">{__("Collapse")}</p>
          <FontIconPicker
            icons={svg_icons}
            renderFunc={renderSVG}
            theme="default"
            value={iconActive}
            onChange={(value) => this.onchangeActiveIcon(value)}
            isMulti={false}
            noSelectedPlaceholder={__("Select Icon")}
          />
          <h2> {__("Icon Alignment")}</h2>
          <IconButton
            key={"row"}
            icon="editor-alignleft"
            label="Left"
            onClick={() => setAttributes({ iconAlign: "row" })}
            aria-pressed={"row" === iconAlign}
            isPrimary={"row" === iconAlign}
          />
          <IconButton
            key={"row-reverse"}
            icon="editor-alignright"
            label="Right"
            onClick={() => setAttributes({ iconAlign: "row-reverse" })}
            aria-pressed={"row-reverse" === iconAlign}
            isPrimary={"row-reverse" === iconAlign}
          />
          {"accordion" === layout && (
            <Fragment>
              <hr className="responsive-block-editor-addons-editor__separator" />
              <h2>{__("Icon")}</h2>
              <TabPanel
                className="responsive-block-editor-addons-size-type-field-tabs responsive-block-editor-addons-size-type-field__common-tabs responsive-block-editor-addons-inline-margin"
                activeClass="active-tab"
                tabs={[
                  {
                    name: "desktop",
                    title: <Dashicon icon="desktop" />,
                    className:
                      "responsive-block-editor-addons-desktop-tab responsive-block-editor-addons-responsive-tabs",
                  },
                  {
                    name: "tablet",
                    title: <Dashicon icon="tablet" />,
                    className:
                      "responsive-block-editor-addons-tablet-tab responsive-block-editor-addons-responsive-tabs",
                  },
                  {
                    name: "mobile",
                    title: <Dashicon icon="smartphone" />,
                    className:
                      "responsive-block-editor-addons-mobile-tab responsive-block-editor-addons-responsive-tabs",
                  },
                ]}
              >
                {(tab) => {
                  let tabout;

                  if ("mobile" === tab.name) {
                    tabout = (
                      <Fragment>
                        <ButtonGroup
                          className="responsive-block-editor-addons-size-type-field"
                          aria-label={__("Size Type")}
                        >
                          <Button
                            key={"px"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "px"}
                            aria-pressed={iconSizeType === "px"}
                            onClick={() =>
                              setAttributes({ iconSizeType: "px" })
                            }
                          >
                            {"px"}
                          </Button>
                          <Button
                            key={"%"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "%"}
                            aria-pressed={iconSizeType === "%"}
                            onClick={() => setAttributes({ iconSizeType: "%" })}
                          >
                            {"%"}
                          </Button>
                        </ButtonGroup>
                        <h2>{__("Size")}</h2>
                        <RangeControl
                          value={iconSizeMobile}
                          onChange={(value) =>
                            setAttributes({ iconSizeMobile: value })
                          }
                          min={0}
                          max={100}
                          allowReset
                        />
                      </Fragment>
                    );
                  } else if ("tablet" === tab.name) {
                    tabout = (
                      <Fragment>
                        <ButtonGroup
                          className="responsive-block-editor-addons-size-type-field"
                          aria-label={__("Size Type")}
                        >
                          <Button
                            key={"px"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "px"}
                            aria-pressed={iconSizeType === "px"}
                            onClick={() =>
                              setAttributes({ iconSizeType: "px" })
                            }
                          >
                            {"px"}
                          </Button>
                          <Button
                            key={"%"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "%"}
                            aria-pressed={iconSizeType === "%"}
                            onClick={() => setAttributes({ iconSizeType: "%" })}
                          >
                            {"%"}
                          </Button>
                        </ButtonGroup>
                        <h2>{__("Size")}</h2>
                        <RangeControl
                          value={iconSizeTablet}
                          onChange={(value) =>
                            setAttributes({ iconSizeTablet: value })
                          }
                          min={0}
                          max={100}
                          allowReset
                        />
                      </Fragment>
                    );
                  } else {
                    tabout = (
                      <Fragment>
                        <ButtonGroup
                          className="responsive-block-editor-addons-size-type-field"
                          aria-label={__("Size Type")}
                        >
                          <Button
                            key={"px"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "px"}
                            aria-pressed={iconSizeType === "px"}
                            onClick={() =>
                              setAttributes({ iconSizeType: "px" })
                            }
                          >
                            {"px"}
                          </Button>
                          <Button
                            key={"%"}
                            className="responsive-block-editor-addons-size-btn"
                            isSmall
                            isPrimary={iconSizeType === "%"}
                            aria-pressed={iconSizeType === "%"}
                            onClick={() => setAttributes({ iconSizeType: "%" })}
                          >
                            {"%"}
                          </Button>
                        </ButtonGroup>
                        <h2>{__("Size")}</h2>
                        <RangeControl
                          value={iconSize}
                          onChange={(value) =>
                            setAttributes({ iconSize: value })
                          }
                          min={0}
                          max={100}
                          allowReset
                        />
                      </Fragment>
                    );
                  }

                  return <div>{tabout}</div>;
                }}
              </TabPanel>
              <p className="responsive-block-editor-addons-setting-label">
                {__("Color")}
                <span className="components-base-control__label">
                  <span
                    className="component-color-indicator"
                    style={{ backgroundColor: iconColor }}
                  ></span>
                </span>
              </p>
              <ColorPalette
                value={iconColor}
                onChange={(value) => setAttributes({ iconColor: value })}
                allowReset
              />
              <p className="responsive-block-editor-addons-setting-label">
                {__("Active Color")}
                <span className="components-base-control__label">
                  <span
                    className="component-color-indicator"
                    style={{ backgroundColor: iconActiveColor }}
                  ></span>
                </span>
              </p>
              <ColorPalette
                value={iconActiveColor}
                onChange={(value) => setAttributes({ iconActiveColor: value })}
                allowReset
              />
            </Fragment>
          )}
        </Fragment>
      );
    };
    return (
      <Fragment>
        <InspectorControls>
          {accordionGeneralSettings()}
          {accordionColorSettings()}
          {accordionStylingSettings()}
          {accordionTypographySettings()}
          {titleFontFamily && loadGoogleFont(titleFontFamily)}
          {contentFontFamily && loadGoogleFont(contentFontFamily)}
        </InspectorControls>
        <div
          className={classnames(
            "responsive-block-editor-addons-accordion__outer-wrap",
            `responsive-block-editor-addons-block-${block_id}`,
            `responsive-block-editor-addons-accordion-icon-${this.props.attributes.iconAlign}`,
            `responsive-block-editor-addons-accordion-layout-${this.props.attributes.layout}`,
            `responsive-block-editor-addons-accordion-expand-first-${this.props.attributes.expandFirstItem}`,
            `responsive-block-editor-addons-accordion-inactive-other-${this.props.attributes.inactiveOtherItems}`,
            equalHeightClass
          )}
        >
          <InnerBlocks
            template={getAccordionItemTemplate(2, accordion)}
            templateLock={false}
            allowedBlocks={ALLOWED_BLOCKS}
            __experimentalMoverDirection={"vertical"}
          />
        </div>
      </Fragment>
    );
  }
}

export default compose(
  withSelect((select, ownProps) => {
    var accordion_data = {};
    var json_data = {
      "@context": "https://schema.org",
      "@type": "AccordionPage",
      mainEntity: [],
    };
    const accordionChildBlocks = select("core/block-editor").getBlocks(
      ownProps.clientId
    );

    accordionChildBlocks.forEach((accordionChild, key) => {
      accordion_data = {
        "@type": "Title",
        name: accordionChild.attributes.title,
        acceptedContent: {
          "@type": "Content",
          text: accordionChild.attributes.content,
        },
      };
      json_data["mainEntity"][key] = accordion_data;
    });

    return {
      schemaJsonData: json_data,
    };
  })
)(ResponsiveBlockEditorAddonsAccordionEdit);
