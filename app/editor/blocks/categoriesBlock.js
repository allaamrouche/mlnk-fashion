// (function(wp) {
//     var el = wp.element.createElement;
//     var registerBlockType = wp.blocks.registerBlockType;
//     var withSelect = wp.data.withSelect;
//     var SelectControl = wp.components.SelectControl;

//     registerBlockType('malanka/fashion-category-products', {
//         title: 'Malanka Fashion Category Products',
//         icon: 'screenoptions',
//         category: 'design',

//         attributes: {
//             selectedCategory: {
//                 type: 'string',
//                 default: ''
//             }
//         },

//         edit: withSelect(function(select) {
//             var categories = select('core').getEntityRecords('taxonomy', 'product_cat', { per_page: -1 }) || [];
//             return { categories: categories };
//         })(function(props) {
//             var categories = props.categories;
//             var setAttributes = props.setAttributes;
//             var options = [{ label: 'Select a Category', value: '' }];

//             categories.forEach(function(cat) {
//                 options.push({ label: cat.name, value: cat.id });
//             });

//             function onChangeCategory(newValue) {
//                 console.log(newValue);  // Now directly logging the new value
//                 setAttributes({ selectedCategory: newValue });
//             }

//             return el('div', {},
//                 el(SelectControl, {
//                     label: 'Select Product Category',
//                     value: props.attributes.selectedCategory,
//                     options: options,
//                     onChange: onChangeCategory
//                 })
//             );
//         }),

//         save: function() {
//             return null; // Data is dynamically loaded and thus saved into post content as null.
//         }
//     });
// })(window.wp);


(function(wp) {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var withSelect = wp.data.withSelect;
    var SelectControl = wp.components.SelectControl;

    registerBlockType('malanka/fashion-category-products', {
        title: 'Malanka Fashion Category Products',
        icon: 'screenoptions',
        category: 'design',

        attributes: {
            selectedCategory: {
                type: 'string',
                default: ''
            }
        },

        edit: withSelect(function(select) {
            var categories = select('core').getEntityRecords('taxonomy', 'product_cat', { per_page: -1 });
            // Filter to include only categories with products
            var filteredCategories = categories ? categories.filter(cat => cat.count > 0) : [];
            return { categories: filteredCategories };
        })(function(props) {
            var categories = props.categories;
            var setAttributes = props.setAttributes;
            var options = [{ label: 'Select a Category', value: '' }];

            categories.forEach(function(cat) {
                options.push({ label: cat.name, value: cat.slug });
            });

            function onChangeCategory(selectedSlug) {
                setAttributes({ selectedCategory: selectedSlug });
            }

            return el('div', {},
                el(SelectControl, {
                    label: 'Select Product Category',
                    value: props.attributes.selectedCategory,
                    options: options,
                    onChange: onChangeCategory
                })
            );
        }),

        save: function() {
            return null; // Content is rendered via PHP on the server.
        }
    });
})(window.wp);

