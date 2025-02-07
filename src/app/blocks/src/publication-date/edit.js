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
import { useBlockProps, InspectorAdvancedControls, RichText } from '@wordpress/block-editor';
import { useEntityProp } from '@wordpress/core-data';
import { DateTimePicker, Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { useState } from '@wordpress/element';

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
		context: { postType, postId }
	}
) {
	const [ meta, updateMeta ] = useEntityProp(
		'postType',
		postType,
		'meta',
		postId
	);

	const [ date, setDate ] = useState( new Date() );

	const { publication_date } = meta;

	return (
		<div { ...useBlockProps(
			{
				className: `wp-block-post-date`
			}
		) }>
			<RichText
				title={ __( 'Publication Date', 'site-functionality' ) }
				tagName="p"
				placeholder={ __( 'Add Publication Date (YYYY-MM-DD)...', 'site-functionality' ) }
				allowedFormats={ [] }
				disableLineBreaks
				value={ publication_date }
				onChange={ ( value ) =>
					updateMeta( {
						...meta,
						publication_date: value
					} )
				}
			/>
			<TextControl
				__nextHasNoMarginBottom
				__next40pxDefaultSize
				label={ __( 'Publication Date', 'site-functionality' ) }
				type={ 'date' }
				value={ publication_date }
				onChange={ ( value ) =>
					updateMeta( {
						...meta,
						publication_date: value
					} )
				}
			/>
		</div>
	);
}
