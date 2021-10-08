const { __ } = wp.i18n;

const rbeaControls = {
  tooltipPositions: [
    {
      value: "top",
      label: __("Top", "responsive-block-editor-addons"),
    },
    {
      value: "right",
      label: __("Right", "responsive-block-editor-addons"),
    },
    {
      value: "bottom",
      label: __("Bottom", "responsive-block-editor-addons"),
    },
    {
      value: "left",
      label: __("Left", "responsive-block-editor-addons"),
    },
  ],
  modalTabNames: [
    {
      name: "content",
      title: __("Content", "responsive-block-editor-addons"),
      className: "components-button",
    },
    {
        name: "style",
        title: __("Style", "responsive-block-editor-addons"),
        className: "components-button",
    },
    {
      name: "advance",
      title: __("Advanced", "responsive-block-editor-addons"),
      className: "components-button",
    }, 
  ],
  tooltipTheme: [
    {
      value: "light",
      label: __("Default", "responsive-block-editor-addons"),
    },
    {
      value: "light-border",
      label: __(
        "Light Border",
        "responsive-block-editor-addons"
      ),
    },
    {
      value: "dark",
      label: __("Dark", "responsive-block-editor-addons"),
    },
    {
      value: "material",
      label: __("Material", "responsive-block-editor-addons"),
    },
    {
      value: "translucent",
      label: __(
        "Translucent",
        "responsive-block-editor-addons"
      ),
    },
  ],
  tooltipAnimation: [
    { value: 'shift-away'  , label: __( 'Shift Away', 'responsive-block-editor-addons' ) },
    { value: 'shift-away-subtle'  , label: __( 'Shift Away Subtle', 'responsive-block-editor-addons' ) },
    { value: 'shift-away-extreme'  , label: __( 'Shift Away Extreme', 'responsive-block-editor-addons' ) },
    { value: 'shift-toward', label: __( 'Shift Toward', 'responsive-block-editor-addons' ) },
    { value: 'shift-toward-subtle', label: __( 'Shift Toward Subtle', 'responsive-block-editor-addons' ) },
    { value: 'shift-toward-extreme', label: __( 'Shift Toward Extreme', 'responsive-block-editor-addons' ) },
    { value: 'scale'       , label: __( 'Scale', 'responsive-block-editor-addons' ) },
    { value: 'scale-subtle'       , label: __( 'Scale Subtle', 'responsive-block-editor-addons' ) },
    { value: 'scale-extreme'       , label: __( 'Scale Extreme', 'responsive-block-editor-addons' ) },
    { value: 'perspective' , label: __( 'Perspective', 'responsive-block-editor-addons' ) },
    { value: 'perspective-subtle' , label: __( 'Perspective Subtle', 'responsive-block-editor-addons' ) },
    { value: 'perspective-extreme' , label: __( 'Perspective Extreme', 'responsive-block-editor-addons' ) },
  ],
  rbeaAnimation: [
    { value: "none", label: "None" },
    { value: "fade", label: __("Fade") },
    { value: "slide", label: __("Slide") },
    { value: "bounce", label: __("Bounce") },
    { value: "zoom", label: __("Zoom") },
    { value: "flip", label: __("Flip") },
    { value: "fold", label: __("Fold") },
    { value: "rotate", label: "Rotate" },
  ],
  rbeaAnimationCurve: [
    { value: "ease-in-out", label: "ease-in-out" },
    { value: "ease", label: "ease" },
    { value: "ease-in", label: "ease-in" },
    { value: "ease-out", label: "ease-out" },
    { value: "linear", label: "linear" },
  ],
  openTooltip: [
    {
      value: "hover",
      label: __("On Hover", "responsive-block-editor-addons"),
    },
    {
      value: "click",
      label: __("On Click", "responsive-block-editor-addons"),
    },
  ],
  imageSize: [
    { value: "full", label: __("Full Size") },
    { value: "thumbnail", label: __("Thumbnail") },
    { value: "medium", label: __("Medium") },
  ],
};

export default rbeaControls;
