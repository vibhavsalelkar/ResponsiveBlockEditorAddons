/**
 * Internal dependencies
 */
import classnames from "classnames";
import Inspector from "./inspector";
import EditorStyles from "./editor-styles";

import { Spinner } from "@wordpress/components";

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

export default class Edit extends Component {
  constructor() {
    super(...arguments);
    this.fetchPhotos = this.fetchPhotos.bind(this);
    this.state = {
      token: '',
      loading: true,
      responseCode: 200,
      errorMessage: "",
    };
  }

  fetchPhotos() {
    if (!this.props.attributes.token) {
      return false;
    }

    return fetch(
      `https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=${this.props.attributes.token}`
    )
      .then((res) => res.json())
      .then((json) => {
        if (json.error) {
          this.setState({ ...this.state, errorMessage: json.error.message });
        }
        if (json.data) {
          this.setState({ ...this.state, responseCode: 200 });
          this.setState({ ...this.state, loading: false });

          if (json.data.length > 0) {
            this.props.setAttributes({ instaPosts: json.data });
            this.setState({...this.state, token: this.props.attributes.token})
          } else {
            this.props.setAttributes({ instaPosts: [] });
            this.setState({ ...this.state, responseCode: 500 });
          }
        }
      });
  }

  componentDidUpdate(prevProps, prevState) {
    var element = document.getElementById(
      "responsive-block-editor-addons-instagram-style-" + this.props.clientId
    );

    if (null !== element && undefined !== element) {
      element.innerHTML = EditorStyles(this.props);
    }

    if(prevState.token !== this.state.token) {
      this.fetchPhotos();
    }    
  }

  componentDidMount() {
    // Assigning block_id in the attribute.
    this.props.setAttributes({ block_id: this.props.clientId });

    this.props.setAttributes({ classMigrate: true });

    // Pushing Style tag for this block css.
    const $style = document.createElement("style");
    $style.setAttribute(
      "id",
      "responsive-block-editor-addons-instagram-style-" + this.props.clientId
    );
    document.head.appendChild($style);

    this.fetchPhotos();
  }

  render() {
    const {
      attributes: {
        block_id,
        token,
        numberOfItems,
        instaPosts,
        hasEqualImages,
        borderRadius,
      },
      setAttributes,
    } = this.props;

    const instaPost = [
      {
         "id": "18019505695309560",
         "caption": "Chilling with Mummy",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/218379006_548880436242567_422932205340561110_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=tE0T8Ea5FlsAX867n-d&_nc_ht=scontent.cdninstagram.com&oh=b6dd8a7d5b202d354ad530ea50b73d36&oe=60F72DA3",
         "permalink": "https://www.instagram.com/p/CRTLEc-lOn1/",
         "timestamp": "2021-07-14T07:41:28+0000",
         "username": "rbeatester"
      },
      {
         "id": "18113224096245211",
         "caption": "Seven Island State Birding Park",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/217406899_104240641861967_396797914456864941_n.jpg?_nc_cat=103&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=B1Re8Dj2NAMAX9k4Agv&_nc_ht=scontent.cdninstagram.com&oh=87ce23fd5ed4a4a3e40ec1811f8037b8&oe=60F6F959",
         "permalink": "https://www.instagram.com/p/CRTK9t_l-Lw/",
         "timestamp": "2021-07-14T07:40:33+0000",
         "username": "rbeatester"
      },
      {
         "id": "17917020775830877",
         "caption": "Waterfall, peace",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/217400179_507048327078469_5745601635336141931_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=4D2kYeFwDzwAX_d6MOQ&_nc_ht=scontent.cdninstagram.com&oh=ea3d8c3184b94614242cbda64e45c75a&oe=60F564AF",
         "permalink": "https://www.instagram.com/p/CRTK2idlo-w/",
         "timestamp": "2021-07-14T07:39:34+0000",
         "username": "rbeatester"
      },
      {
         "id": "17876321612399080",
         "caption": "The Great Wall of China",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/217428027_566514374514306_6686132859344931662_n.jpg?_nc_cat=105&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=HSpLuIqKpgsAX-93vWb&_nc_ht=scontent.cdninstagram.com&oh=d2ac906e35904405e2eb5fbddef80797&oe=60F5BF40",
         "permalink": "https://www.instagram.com/p/CRTKxuClNHU/",
         "timestamp": "2021-07-14T07:38:55+0000",
         "username": "rbeatester"
      },
      {
         "id": "17904155582051936",
         "caption": "Taj Mahal",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/214287374_284859110060390_8933417364757289264_n.jpg?_nc_cat=105&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=5CkxKtfuFsIAX8aXGyX&_nc_ht=scontent.cdninstagram.com&oh=bcf7a07c481ac4b7c0d930bd97c325df&oe=60F69BBB",
         "permalink": "https://www.instagram.com/p/CRTKYT5FeN6/",
         "timestamp": "2021-07-14T07:35:26+0000",
         "username": "rbeatester"
      },
      {
         "id": "18136849528200238",
         "caption": "First Post",
         "media_type": "IMAGE",
         "media_url": "https://scontent.cdninstagram.com/v/t51.29350-15/218321035_614182562840234_64209907609503256_n.jpg?_nc_cat=104&ccb=1-3&_nc_sid=8ae9d6&_nc_ohc=JGgldyS_9OQAX_gkszc&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=85fa7b4e539a94480cf92c3db304c905&oe=60F5D797",
         "permalink": "https://www.instagram.com/p/CRTKVEql1wT/",
         "timestamp": "2021-07-14T07:35:00+0000",
         "username": "rbeatester"
      }
   ]
   let instagramContents = (
    <div
      className="responsive-block-editor-addons-instagram-posts-container responsive-block-editor-addons-grid"
    >
      {instaPost &&
        instaPost.slice(0, numberOfItems).map((img) => {
          return (
            <div
              className={
                "responsive-block-editor-addons-image-wrapper has-equal-images" 
              }
              key={img.id}
            >
              <img
                className="responsive-block-editor-addons-instagram-image"
                src={
                  img.media_type === "IMAGE"
                    ? img.media_url
                    : img.thumbnail_url
                }
                alt={img.caption ? img.caption : ""}
              />
            </div>
          );
        })}
    </div>
  );

    let instagramContent;

    if (token && this.state.responseCode === 200) {
      if (this.state.loading) {
        instagramContent = (
          <p>
            <Spinner />
            {__("Fetching feed, Please wait")}
          </p>
        );
      } else {
        instagramContent = (
          <div
            className="responsive-block-editor-addons-instagram-posts-container responsive-block-editor-addons-grid"
          >
            {instaPosts &&
              instaPosts.slice(0, numberOfItems).map((img) => {
                return (
                  <div
                    className={
                      "responsive-block-editor-addons-image-wrapper has-equal-images" 
                    }
                    key={img.id}
                  >
                    <img
                      className="responsive-block-editor-addons-instagram-image"
                      src={
                        img.media_type === "IMAGE"
                          ? img.media_url
                          : img.thumbnail_url
                      }
                      alt={img.caption ? img.caption : ""}
                    />
                  </div>
                );
              })}
          </div>
        );
      }
    } else if (this.state.responseCode !== 200) {
      instagramContent = (
        <div>Something went wrong: {this.state.errorMessage} </div>
      );
    } else {
      instagramContent = (
        <div className="responsive-block-editor-addons-intro-page">
          <p>
            <strong>Instagram Block</strong>
          </p>
          <p>
            {" "}
            To get started please add an Instagram Access Token into the 'Access
            Token' setting. You can follow these
            <a
              target="_blank"
              rel="noopener noreferrer"
              href="https://docs.oceanwp.org/article/487-how-to-get-instagram-access-token"
            >
              {" steps "}
            </a>
            to generate token.
          </p>
        </div>
      );
    }

    return [
      <Inspector key={"inspector"} {...{ setAttributes, ...this.props }} />,
      <div
        key={"instawrap"}
        className={classnames(
          "responsive-block-editor-addons-block-instagram",
          `block-${block_id}`
        )}
      >
        <div className="responsive-block-editor-addons-instagram-wrapper">
          {instagramContent}
        </div>
      </div>,
    ];
  }
}
