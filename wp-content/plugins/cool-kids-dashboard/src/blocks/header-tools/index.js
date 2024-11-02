import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, CheckboxControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './main.css';

registerBlockType('cool-kids-dashboard/header-tools', {
  edit({ attributes, setAttributes }) {
    const { showAuth } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __('General', 'cool-kids-dashboard') }>
            <SelectControl
              label={ __( 'Show Login/Logout Link', 'cool-kids-dashboard' ) }
              value={ showAuth ? 'true' : 'false' }
              options={[
                { label: __( 'No', 'cool-kids-dashboard' ), value: 'false' },
                { label: __( 'Yes', 'cool-kids-dashboard' ), value: 'true' }
              ]}
              onChange={ (newVal) => setAttributes({ showAuth: newVal === 'true' }) }
            />
            <CheckboxControl 
              label={ __( 'Show Login/Logout Link', 'cool-kids-dashboard' ) }
              help={ 
                showAuth 
                  ? __( 'Showing Link', 'cool-kids-dashboard' ) 
                  : __( 'Hidden Link', 'cool-kids-dashboard' ) 
              }
              checked={ showAuth }
              onChange={ ( newVal ) => setAttributes( { showAuth: newVal } ) }
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          {
            showAuth ? (
              <a className="signin-link open-modal" href="#">
                Login
              </a>
            ) : null
          }
        </div>
      </>
    );
  }
});