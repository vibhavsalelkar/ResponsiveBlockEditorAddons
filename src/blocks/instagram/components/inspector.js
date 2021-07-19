/**
 * Inspector Controls
 */

// Setup the block
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

// Import block components
const {
  InspectorControls, 
  PanelColorSettings 
} = wp.editor;

// Import Inspector components
const {
  PanelBody,
	ToggleControl,
	TextareaControl,
	RangeControl,
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {
  constructor(props) {
    super(...arguments);
  }

  render() {
    // Setup the attributes
    const {
      attributes: {
        token,
        columns,
        instaPosts,
        numberOfItems,
        imagesGap,
        borderRadius,
        hasEqualImages,
        showCaptions,
      },
      setAttributes,
    } = this.props;

    return <InspectorControls key="inspector">
      <PanelBody title={__("API Key")}>
				<TextareaControl
					label={__("Access Token")}
					value={token}
					onChange={(value) => {
						setAttributes({ token: value });
					}}
				/>
      <p>Note: This block requires you to obtain an Instagram Access Token to connect Instagram with WordPress. You will need to use your Instagram credentials to get access token.</p>
			</PanelBody>

			{true && (
				<>
					<PanelBody title={__("Settings")}>
						
            <RangeControl
							label={__("Number Of Items")}
							value={numberOfItems}
							onChange={(value) => {
								setAttributes({ numberOfItems: value });
							}}
							min={1}
							max={20}
						/>

						<RangeControl
							label={__("Columns")}
							value={columns}
							onChange={(value) => {
								setAttributes({ columns: value });
							}}
							min={1}
							max={8}
						/>

						<RangeControl
							label={__("Spacing")}
							value={imagesGap}
							onChange={(value) => setAttributes({ imagesGap: value })}
							min={0}
							max={30}
						/>

						<RangeControl
							label={__("Border Radius")}
							value={borderRadius}
							onChange={(borderRadius) => setAttributes({ borderRadius })}
							min={0}
							max={50}
						/>
					</PanelBody>
				</>
			)}
    </InspectorControls>;
  }
}
