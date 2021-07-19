/**
 * Internal dependencies
 */
import classnames from "classnames";

/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;

export default class Save extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    const { block_id, anchor } = this.props.attributes;

    return [
      <div
        id={anchor}
        className={classnames(
          "responsive-block-editor-addons-block-instagram",
          `block-${block_id}`
        )}
      ></div>,
    ];
  }
}
