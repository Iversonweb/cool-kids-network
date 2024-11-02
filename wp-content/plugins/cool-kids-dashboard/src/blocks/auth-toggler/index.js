import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import './main.css';

registerBlockType('cool-kids-dashboard/auth-toggler', {
  apiVersion: 2,
  title: 'Auth Toggler',
  icon: 'visibility',
  category: 'widgets',
  attributes: {
    isAuth: { type: 'boolean', default: false },
  },
  edit({ attributes }) {
    const { isAuth } = attributes;
    const blockProps = useBlockProps();

    return (
      <div {...blockProps}>
        {
          isAuth ? (
            <div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
                <h2 class="wp-block-heading ckn-content-toggle-heading has-text-align-left has-ckn-kanit-font-family">
                    How does it feel to be
                </h2>

                <h2 class="wp-block-heading ckn-content-toggle-subheading has-text-align-left has-text-color has-link-color has-ckn-kanit-font-family">
                    
                </h2>

                <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                    <div class="wp-block-button direct-signup-btn has-ckn-montserrat-font-family">
                        <a class="wp-block-button__link ckn-content-toggle-button has-ckn-gray-800-color has-text-color has-link-color wp-element-button">
                        My Dashboard
                        </a>
                    </div>
                </div>
            </div>
          ) : (
            <div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
                <h2 class="wp-block-heading ckn-content-toggle-heading has-text-align-left has-ckn-kanit-font-family">
                    Hey, Wanna Be Cool?
                </h2>

                <h2 class="wp-block-heading ckn-content-toggle-subheading has-text-align-left has-text-color has-link-color has-ckn-kanit-font-family">
                    Join The Coolest Kids In The World.
                </h2>

                <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                    <div class="wp-block-button direct-signup-btn has-ckn-montserrat-font-family">
                        <a class="wp-block-button__link ckn-content-toggle-button has-ckn-gray-800-color has-text-color has-link-color wp-element-button">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
          )
        }
      </div>
    );
  },
});
