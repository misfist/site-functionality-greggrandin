// import { createSlotFill } from '@wordpress/components';

// const { Fill, Slot } = createSlotFill(  'CustomFieldsSlotFill'  );

// const SidePanel = () => (
//     <Panel header={ __( '', 'site-functionality' ) }>
//         <PanelBody title={ __( 'Book Details', 'site-functionality' ) } icon="book" initialOpen={ true }>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Subtitle', 'site-functionality' ) }
//                     type={ 'text' }
//                     value={ subtitle }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             subtitle: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Publisher', 'site-functionality' ) }
//                     type={ 'text' }
//                     value={ publisher }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             publisher: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Publication Date', 'site-functionality' ) }
//                     type={ 'date' }
//                     value={ publication_date }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             publication_date: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'ISBN', 'site-functionality' ) }
//                     type={ 'text' }
//                     value={ isbn }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             isbn: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Edition', 'site-functionality' ) }
//                     type={ 'text' }
//                     value={ edition }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             edition: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Edition', 'site-functionality' ) }
//                     type={ 'number' }
//                     value={ edition }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             edition: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Pages', 'site-functionality' ) }
//                     type={ 'number' }
//                     value={ pages }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             pages: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//             <PanelRow>
//                 <TextControl
//                     __nextHasNoMarginBottom
//                     __next40pxDefaultSize
//                     label={ __( 'Language', 'site-functionality' ) }
//                     type={ 'text' }
//                     value={ language }
//                     onChange={ ( value ) =>
//                         updateMeta( {
//                             ...meta,
//                             language: value
//                         } )
//                     }
//                 />
//             </PanelRow>
//         </PanelBody>
//     </Panel>
// );

// const CustomFieldsSlotFill = ( { children } ) => {
//     return <Fill>{ children }</Fill>;
// };

// CustomFieldsSlotFill.Slot = Slot;

// export default CustomFieldsSlotFill;