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
import { InnerBlocks, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';


const TEMPLATE = [
	[ 'core/buttons', 
		{
			'className': 'buy-buttons',
			'layout': {
				'type':'flex',
				'orientation':'horizontal',
				'justifyContent': 'center'
			}
		},
		[
			[
				'core/button',
				{
					'className': 'buy-button',
					'placeholder': __( 'Add Buy Button...', 'site-functionality' ),
					'url': '#',
					'linkTarget': '_blank',
				}
			],
			[
				'core/button',
				{
					'className': 'buy-button',
					'placeholder': __( 'Add Buy Button...', 'site-functionality' ),
					'url': '#',
					'linkTarget': '_blank'
				}
			],
			[
				'core/button',
				{
					'className': 'buy-button',
					'placeholder': __( 'Add Buy Button...', 'site-functionality' ),
					'url': '#',
					'linkTarget': '_blank'
				}
			],
			[
				'core/button',
				{
					'className': 'buy-button',
					'placeholder': __( 'Add Buy Button...', 'site-functionality' ),
					'url': '#',
					'linkTarget': '_blank'
				}
			]
		]
	]
];

const DEFAULT_BLOCK = [
	{
		'core/button': {
			'className': 'buy-button',
			'placeholder': __( 'Add Buy Button...', 'site-functionality' ),
			'url': '#',
			'linkTarget': '_blank'
		}
	}
]

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
		attributes
	}
) {
	const { allowedBlocks } = attributes;
	const blockProps = useBlockProps();
	// const innerBlocksProps = useInnerBlocksProps( blockProps );

	return (
		
		<div { ...blockProps }>
			<InnerBlocks
                template={ TEMPLATE }
				allowedBlocks={ allowedBlocks }
				defaultBlock={ DEFAULT_BLOCK }
				directInsert
            />
		</div>
	);
}
