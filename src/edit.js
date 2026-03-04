
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
import {
	useBlockProps,
	RichText,
	BlockControls,
	AlignmentToolbar,
	InspectorControls,
} from '@wordpress/block-editor';

import {
	PanelBody,
	TextControl,
	Notice,
} from '@wordpress/components';

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
export default function Edit( { attributes, setAttributes } ) {
	const { customFieldName, dateFormat, content, textAlign } = attributes;

	const blockProps = useBlockProps( {
		style: {
			textAlign: textAlign || undefined,
		},
	} );

	return (
		<>
			<BlockControls>
				<AlignmentToolbar
					value={ textAlign }
					onChange={ ( newAlign ) =>
						setAttributes( { textAlign: newAlign } )
					}
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody
					title={ __(
						'Expiry Settings',
						'next-date-expiry-block'
					) }
				>
					<TextControl
						label={ __(
							'Custom Field Name',
							'next-date-expiry-block'
						) }
						help={ __(
							'Enter the meta key name that stores the expiry date.',
							'next-date-expiry-block'
						) }
						value={ customFieldName }
						onChange={ ( value ) =>
							setAttributes( { customFieldName: value } )
						}
					/>
					<TextControl
						label={ __(
							'Date Format',
							'next-date-expiry-block'
						) }
						help={ __(
							'PHP date format of the custom field value. Default: Y-m-d',
							'next-date-expiry-block'
						) }
						value={ dateFormat }
						onChange={ ( value ) =>
							setAttributes( { dateFormat: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ ! customFieldName && (
					<div className="next-date-expiry-block-notice">
						<Notice status="warning" isDismissible={ false }>
							{ __(
								'Please set a custom field name in the block settings.',
								'next-date-expiry-block'
							) }
						</Notice>
					</div>
				) }
				<RichText
					tagName="p"
					value={ content }
					onChange={ ( value ) =>
						setAttributes( { content: value } )
					}
					placeholder={ __(
						'Enter text to display when the date has expired…',
						'next-date-expiry-block'
					) }
					allowedFormats={ [
						'core/bold',
						'core/italic',
						'core/link',
						'core/strikethrough',
						'core/underline',
						'core/text-color',
						'core/subscript',
						'core/superscript',
						'core/code',
					] }
				/>
			</div>
		</>
	);
}
