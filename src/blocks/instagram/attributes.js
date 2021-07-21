const attributes = {
  block_id: {
    type: "string",
  },
  token: {
    type: "string",
  },
  columns: {
    type: "string",
    default: 4,
  },
  numberOfItems: {
    type: "number",
    default: 4,
  },
  imagesGap: {
    type: "number",
  },
  instaPosts: {
    type: "array",
    default: [],
  },
  borderRadius: {
    type: "number",
    default: 0,
  },
  hasEqualImages: {
    type: "boolean",
    default: false,
  },
  showCaptions: {
    type: "boolean",
    default: false,
  },
};
export default attributes;
