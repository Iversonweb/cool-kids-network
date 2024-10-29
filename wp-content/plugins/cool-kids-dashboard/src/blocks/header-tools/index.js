import { registerBlockType } from '@wordpress/blocks';
import block from './block.json';

registerBlockType( block.name, {
    edit() {
        return <p>Test Hello</p>
    }
} );