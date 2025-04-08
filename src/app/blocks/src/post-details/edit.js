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
import { InspectorControls } from '@wordpress/editor';
import { DateTimePicker, Panel, PanelBody, PanelRow, TextareaControl, TextControl } from '@wordpress/components';

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

	const [ postExcerpt, updatePostExcerpt ] = useEntityProp(
		'postType',
		postType,
		'excerpt',
		postId
	);

	const { 
		publisher, 
		publication_date,
		publication_link,
		blurb,
		_links_to,
		_links_to_target = '_blank'
	} = meta;

	const SidePanel = () => (
		<Panel header={ __( '', 'site-functionality' ) }>
			<PanelBody title={ __( 'Article Details', 'site-functionality' ) } initialOpen={ true }>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Publisher', 'site-functionality' ) }
						type={ 'text' }
						value={ publisher }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								publisher: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
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
				</PanelRow>	
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Publisher Link', 'site-functionality' ) }
						placeholder={ __( 'https://', 'site-functionality' ) }
						type={ 'url' }
						value={ _links_to }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								_links_to: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
					<TextareaControl
						__nextHasNoMarginBottom
						label={ __( 'Details', 'site-functionality' ) }
						help={ __( 'Extra details to display (e.g. "Edited by").', 'site-functionality' ) }
						value={ blurb }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								blurb: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Link Target', 'site-functionality' ) }
						type={ 'text' }
						value={ _links_to_target }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								_links_to_target: value
							} )
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	);

	return (
		<>
			<div { ...useBlockProps() }>
				<label htmlFor="publisher">{ __( 'Publisher', 'site-functionality' ) }</label>
				<RichText
					tagName="p"
					title={ __( 'Publisher', 'site-functionality' ) }
					placeholder={ __( 'Add Publisher...', 'site-functionality' ) }
					allowedFormats={ [ 'core/italic' ] }
					disableLineBreaks
					value={ publisher }
					identifier="publisher"
					id="publisher"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							publisher: value
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

				<label htmlFor="publication_link">{ __( 'Publication Link', 'site-functionality' ) }</label>
				<RichText
					title={ __( 'Publication Link', 'site-functionality' ) }
					tagName="p"
					placeholder={ __( 'Add Link...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ _links_to }
					identifier="publication_link"
					id="publication_link"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							_links_to: value
						} )
					}
				/>
				<label htmlFor="publication_link_target">{ __( 'Link Target', 'site-functionality' ) }</label>
				<RichText
					title={ __( 'Link Target', 'site-functionality' ) }
					tagName="p"
					placeholder={ __( '_blank', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ _links_to_target }
					identifier="publication_link_target"
					id="publication_link_target"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							_links_to_target: value
						} )
					}
				/>
				<label htmlFor="blurb">{ __( 'Details', 'site-functionality' ) }</label>
				<RichText
					title={ __( 'Details', 'site-functionality' ) }
					tagName="p"
					placeholder={ __( 'Extra details to display (e.g. "Edited by").', 'site-functionality' ) }
					allowedFormats={ [ 'core/bold', 'core/italic', 'core/link' ] }
					// disableLineBreaks
					value={ blurb }
					identifier="blurb"
					id="blurb"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							blurb: value
						} )
					}
				/>
			</div>
		</>
	);
}
