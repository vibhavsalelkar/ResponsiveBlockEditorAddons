/**
 * External dependencies
 */
import classnames from "classnames";
import filter from "lodash/filter";
import Masonry from "react-masonry-component";

/**
 * Internal dependencies
 */
import { icon } from "./icon";
import Inspector from "./inspector";
import GalleryImage from "../../../utils/components/block-gallery/gallery-image";
import GalleryPlaceholder from "../../../utils/components/block-gallery/gallery-placeholder";
import { GalleryClasses } from "../../../utils/components/block-gallery/shared";

/**
 * WordPress dependencies
 */
import { __, sprintf } from "@wordpress/i18n";
import { Component, Fragment } from "@wordpress/element";
import { compose } from "@wordpress/compose";
import { withSelect } from "@wordpress/data";
import { withNotices } from "@wordpress/components";

/**
 * Block consts
 */
const masonryOptions = {
  transitionDuration: 0,
  percentPosition: true,
};

class GalleryMasonryEdit extends Component {
  constructor() {
    super(...arguments);

    this.onSelectImage = this.onSelectImage.bind(this);
    this.onRemoveImage = this.onRemoveImage.bind(this);
    this.onMove = this.onMove.bind(this);
    this.onMoveForward = this.onMoveForward.bind(this);
    this.onMoveBackward = this.onMoveBackward.bind(this);
    this.setImageAttributes = this.setImageAttributes.bind(this);

    this.state = {
      selectedImage: null,
    };
  }

  componentDidMount() {
    if (
      this.props.wideControlsEnabled === true &&
      !this.props.attributes.align &&
      this.props.attributes.gridSize === "lrg"
    ) {
      this.props.setAttributes({
        align: "",
        gridSize: "lrg",
      });
    }
  }

  componentDidUpdate(prevProps) {
    // Deselect images when deselecting the block.
    if (!this.props.isSelected && prevProps.isSelected) {
      this.setState({
        selectedImage: null,
        captionSelected: false,
      });
    }
  }

  onSelectImage(index) {
    return () => {
      if (this.state.selectedImage !== index) {
        this.setState({
          selectedImage: index,
        });
      }
    };
  }

  onMove(oldIndex, newIndex) {
    const images = [...this.props.attributes.images];
    images.splice(newIndex, 1, this.props.attributes.images[oldIndex]);
    images.splice(oldIndex, 1, this.props.attributes.images[newIndex]);
    this.setState({ selectedImage: newIndex });
    this.props.setAttributes({ images });
  }

  onMoveForward(oldIndex) {
    return () => {
      if (oldIndex === this.props.attributes.images.length - 1) {
        return;
      }
      this.onMove(oldIndex, oldIndex + 1);
    };
  }

  onMoveBackward(oldIndex) {
    return () => {
      if (oldIndex === 0) {
        return;
      }
      this.onMove(oldIndex, oldIndex - 1);
    };
  }

  onRemoveImage(index) {
    return () => {
      const images = filter(
        this.props.attributes.images,
        (_img, i) => index !== i
      );
      this.setState({ selectedImage: null });
      this.props.setAttributes({
        images,
      });
    };
  }

  setImageAttributes(index, attributes) {
    const {
      attributes: { images },
      setAttributes,
    } = this.props;
    if (!images[index]) {
      return;
    }
    setAttributes({
      images: [
        ...images.slice(0, index),
        {
          ...images[index],
          ...attributes,
        },
        ...images.slice(index + 1),
      ],
    });
  }

  render() {
    const {
      attributes,
      className,
      editorSidebarOpened,
      isSelected,
      noticeUI,
      pluginSidebarOpened,
      publishSidebarOpened,
    } = this.props;

    const {
      align,
      captions,
      gridSize,
      gutter,
      gutterMobile,
      images,
      linkTo,
      lightbox,
    } = attributes;

    const hasImages = !!images.length;

    const sidebarIsOpened =
      editorSidebarOpened || pluginSidebarOpened || publishSidebarOpened;

    const innerClasses = classnames(
      ...GalleryClasses(attributes),
      sidebarIsOpened,
      {
        [`align${align}`]: align,
        "has-gutter": gutter > 0,
        "has-lightbox": lightbox,
        [`link-type-${linkTo}`]: linkTo && !lightbox,
      }
    );

    const masonryClasses = classnames(`has-grid-${gridSize}`, {
      [`has-gutter-${gutter}`]: gutter > 0,
      [`has-gutter-null`]: gutter === 0,
      [`has-gutter-mobile-${gutterMobile}`]: gutterMobile > 0,
    });

    const masonryGalleryPlaceholder = (
      <Fragment>
        {!hasImages ? noticeUI : null}
        <GalleryPlaceholder
          {...this.props}
          label={__("Masonry", "responsive-block-editor-addons")}
          icon={icon}
          gutter={gutter}
        />
      </Fragment>
    );

    if (!hasImages) {
      return masonryGalleryPlaceholder;
    }

    return (
      <Fragment>
        {isSelected && <Inspector {...this.props} />}
        {noticeUI}
        <div className={className}>
          <div className={innerClasses}>
            <Masonry
              elementType={"ul"}
              className={masonryClasses}
              options={masonryOptions}
              disableImagesLoaded={false}
              updateOnEachImageLoad={false}
            >
              {images.map((img, index) => {
                const ariaLabel = sprintf(
                  /* translators: %1$d is the order number of the image, %2$d is the total number of images */
                  __(
                    "image %1$d of %2$d in gallery",
                    "responsive-block-editor-addons"
                  ),
                  index + 1,
                  images.length
                );

                return (
                  <li
                    className="responsive-block-editor-addons-gallery--item"
                    key={img.id || img.url}
                  >
                    <GalleryImage
                  caption={img.caption}
                  lightbox={lightbox}
                  url={img.url}
                      alt={img.alt}
                      id={img.id}
                      imgLink={img.imgLink}
                      linkTo={linkTo}
                      isFirstItem={index === 0}
                      isLastItem={index + 1 === images.length}
                      isSelected={
                        isSelected && this.state.selectedImage === index
                      }
                      onMoveBackward={this.onMoveBackward(index)}
                      onMoveForward={this.onMoveForward(index)}
                      onRemove={this.onRemoveImage(index)}
                      onSelect={this.onSelectImage(index)}
                      setAttributes={(attrs) =>
                        this.setImageAttributes(index, attrs)
                      }

                      aria-label={ariaLabel}
                      captions={captions}
                      supportsCaption={true}
                    />
                  </li>
                );
              })}
            </Masonry>
          </div>
          {masonryGalleryPlaceholder}
        </div>
      </Fragment>
    );
  }
}

export default compose([
  withSelect((select) => ({
    editorSidebarOpened: select("core/edit-post").isEditorSidebarOpened(),
    pluginSidebarOpened: select("core/edit-post").isPluginSidebarOpened(),
    publishSidebarOpened: select("core/edit-post").isPublishSidebarOpened(),
    wideControlsEnabled: select("core/editor").getEditorSettings().alignWide,
  })),
  withNotices,
])(GalleryMasonryEdit);
