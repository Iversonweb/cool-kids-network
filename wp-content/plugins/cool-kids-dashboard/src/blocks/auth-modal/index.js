import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './main.css'

registerBlockType('cool-kids-dashboard/auth-modal', {
  edit({ attributes, setAttributes }) {
    const { showRegister } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __('General', 'cool-kids-dashboard') }>
            <ToggleControl 
                label = { __('Show Register', 'cool-kids-dashboard') }
                help = {
                    showRegister ?
                    __('Showing Registration Form', 'cool-kids-dashboard') :
                    __('Hiding Registration Form', 'cool-kids-dashboard')
                }
                checked = { showRegister }
                onChange = { ( newVal ) => setAttributes( { showRegister: newVal } ) }
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          { __('This block is not previewable from the editor. View your site for a live demo.', 'cool-kids-dashboard' )}
        </div>
      </>
    );
  }
});