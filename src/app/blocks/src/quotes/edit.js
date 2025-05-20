/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { useEntityProp, getEntityRecord, store as coreDataStore } from '@wordpress/core-data';
import { parse } from '@wordpress/block-serialization-default-parser';
import { RawHTML } from '@wordpress/element';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(
	{
		context: { postType, postId },
		attributes: { number },
		setAttributes
	}
) {

	const [ postContent ] = useEntityProp(
		'postType',
		postType,
		'content',
		postId
	);

	let output = __( 'There are no quotes in the content.', 'site-functionality' );

	if( ! postContent ) {
		return (
			<>
				<div { ...useBlockProps(
					{
						'className': `wp-block-quote is-style-background`
					}
				) }>
					{ output }
				</div>
				
			</>
		);
	}

	const blocks = parse( postContent );

	const quotes = blocks?.filter( block => block.blockName === 'core/quote' );

	if( quotes ) {
		output = Object.values( quotes ).slice( 0, number ).map( ( quote, index ) => {
			let content = '';
			let open = '';
			let close = ''

			if( quote.length ) {
				open = quote.innerContent[0];
				close = quote.innerContent[2];
			}

			const innerBlocks = quote.innerBlocks.filter( innerBlock => innerBlock.blockName === 'core/paragraph' );

			if( innerBlocks ) {
				const paragraphs = innerBlocks.map( ( block ) => {
					return block.innerHTML;
				} );
		
				content = open + paragraphs.toString() + close;
			}

			return (
				<RawHTML key={ index }>{ content }</RawHTML>
			);
		} );
	}

	const SidePanel = () => (
		<Panel header={ __( '', 'site-functionality' ) }>
			<PanelBody title={ __( 'Display Options', 'site-functionality' ) } >
				<PanelRow>
					<TextControl
						label={ __( 'Number', 'site-functionality' ) }
						type={ 'text' }
						value={ number }
						onChange={ ( value ) =>
							setAttributes(
								{
									number: value
								}
							)
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	);

	return (
		<>

			<div { ...useBlockProps(
				{
					'className': `wp-block-quote is-style-background`
				}
			) }>
				{ output }
			</div>
			{ postContent && 
				( 	
					<InspectorControls>
						<SidePanel />
					</InspectorControls> 
				)
			}
		</>
	);
}
