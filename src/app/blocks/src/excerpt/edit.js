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
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { useEntityProp } from '@wordpress/core-data';

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
	const [ postExcerpt, updatePostExcerpt ] = useEntityProp(
		'postType',
		postType,
		'excerpt',
		postId
	);

	const { excerpt } = postExcerpt;


	console.log( postType );
    console.log( postId );
	console.log( excerpt );

	return (
		<div { ...useBlockProps(
			{
				className: `wp-block-post-excerpt`
			}
		) }>
			<RichText
				title={ __( 'Excerpt', 'site-functionality' ) }
				tagName="p"
				placeholder={ __( 'Add excerpt...', 'site-functionality' ) }
				allowedFormats={ [ 'core/italic', 'core/bold', 'core/link' ] }
				value={ excerpt }
				onChange={ ( value ) =>
					updatePostExcerpt( {
						...postExcerpt,
						excerpt: value
					} )
				}
			/>
		</div>
	);
}
