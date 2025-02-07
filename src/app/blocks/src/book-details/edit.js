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
import { Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';

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
		edition, 
		isbn, 
		language, 
		pages, 
		publication_date, 
		publisher, 
		subtitle
	} = meta;

	console.log( meta );

	const { excerpt } = postExcerpt;

	const SidePanel = () => (
		<Panel header={ __( '', 'site-functionality' ) }>
			<PanelBody title={ __( 'Book Details!', 'site-functionality' ) } initialOpen={ true }>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Subtitle', 'site-functionality' ) }
						type={ 'text' }
						value={ subtitle }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								subtitle: value
							} )
						}
					/>
				</PanelRow>
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
						label={ __( 'ISBN', 'site-functionality' ) }
						type={ 'text' }
						value={ isbn }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								isbn: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Edition', 'site-functionality' ) }
						type={ 'text' }
						value={ edition }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								edition: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Pages', 'site-functionality' ) }
						type={ 'number' }
						value={ pages }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								pages: value
							} )
						}
					/>
				</PanelRow>
				<PanelRow>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Language', 'site-functionality' ) }
						type={ 'text' }
						value={ language }
						onChange={ ( value ) =>
							updateMeta( {
								...meta,
								language: value
							} )
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	);

	return (
		<>
			<InspectorControls>
				<SidePanel />
			</InspectorControls>
			<div { ...useBlockProps() }>
				<label for="subtitle">{ __( 'Subtitle', 'site-functionality' ) }</label>
				<RichText
					tagName="h3"
					title={ __( 'Subtitle', 'site-functionality' ) }
					placeholder={ __( 'Add Subtitle...', 'site-functionality' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
					disableLineBreaks
					value={ subtitle }
					identifier="subtitle"
					id="subtitle"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							subtitle: value
						} )
					}
				/>
				<label for="publication-date">{ __( 'Publication Date', 'site-functionality' ) }</label>
				<RichText
					title={ __( 'Publication Date', 'site-functionality' ) }
					tagName="p"
					placeholder={ __( 'Add Publication Date (YYYY-MM-DD)...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ publication_date }
					identifier="publication_date"
					id="publication-date"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							publication_date: value
						} )
					}
				/>
				<label for="publisher">{ __( 'Publisher', 'site-functionality' ) }</label>
				<RichText
					title={ __( 'Publisher', 'site-functionality' ) }
					tagName="p"
					placeholder={ __( 'Add Publisher Name...', 'site-functionality' ) }
					allowedFormats={ [ 'core/italic', 'core/link' ] }
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
				<label for="edition">{ __( 'Edition', 'site-functionality' ) }</label>
				<RichText
					tagName="p"
					title={ __( 'Edition', 'site-functionality' ) }
					placeholder={ __( 'Add edition...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ edition }
					identifier="edition"
					id="edition"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							edition: value
						} )
					}
				/>
				<label for="isbn">{ __( 'ISBN', 'site-functionality' ) }</label>
				<RichText
					tagName="p"
					title={ __( 'ISBN', 'site-functionality' ) }
					placeholder={ __( 'Add ISBN...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ isbn }
					identifier="isbn"
					id="isbin"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							isbn: value
						} )
					}
				/>
				<label for="language">{ __( 'Language', 'site-functionality' ) }</label>
				<RichText
					tagName="p"
					title={ __( 'Language', 'site-functionality' ) }
					placeholder={ __( 'Add language...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ language }
					identifier="language"
					id="language"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							language: value
						} )
					}
				/>
				<label for="pages">{ __( 'Pages', 'site-functionality' ) }</label>
				<RichText
					tagName="p"
					title={ __( 'Pages', 'site-functionality' ) }
					placeholder={ __( 'Add number of pages...', 'site-functionality' ) }
					allowedFormats={ [] }
					disableLineBreaks
					value={ pages }
					identifier="pages"
					id="pages"
					onChange={ ( value ) =>
						updateMeta( {
							...meta,
							pages: value
						} )
					}
				/>
			</div>
		</>
	);
}
