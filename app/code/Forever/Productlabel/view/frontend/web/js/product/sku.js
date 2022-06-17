define([
    'Magento_Ui/js/grid/columns/column',
    'Magento_Catalog/js/product/list/column-status-validator'
], function (Column, columnStatusValidator) {
    'use strict';

        // console.log(columnStatusValidator);
    return Column.extend({

        /**
         * @param row
         * @returns {boolean}
         */
        hasValue: function (row) {
            // console.log(row);
            // return "sku" in row['extension_attributes'];
            return "productlabel" in row['extension_attributes'];
        },

        /**
         * @param row
         * @returns {*}
         */
        getValue: function (row) {
            console.log(row);
            console.log(row['extension_attributes']['productlabel']);
            var data = row['extension_attributes']['productlabel'];
            var option = row['extension_attributes']['productoption'];
            
            
            var id = row['id'];


            var productlabel;
            var lower;
            console.log(option);
            // jQuery.each(option,function(key,value){
                productlabel = jQuery('.labelvalue').append("<div class='product_label_wrapper "+option+"'></div>");
                // productlabel = jQuery('.labelvalue').append("<a href='http://local.m234.com/quickview/catalog_product/view/id/"+id+"/'><span>quick</span></a>");
                // productlabel = jQuery('this').append("<div class='product_label_wrapper "+option+"'></div>");
            // });
            jQuery.each(data,function(key,value){
                    if(!isNaN(value)) {
                        lower='discount';
                        value=value+' % off';
                    } else{
                        lower=value.toString().toLowerCase().replace(' ','');
                    }
                    // productlabel = jQuery('.product-item-info').append("<div class='"+value.toLower().replace(' ','')+"'>"+value+"</div>");
                    productlabel = jQuery('.product_label_wrapper').append("<span class='"+lower+"'>"+value+"</span>");
                    // productlabel = jQuery('.product-item-info').append("<div class='"+lower.replace(' ','')+"'>"+data[i]+"</div>");
                // }
                console.log(value);
            //}
            });
            // return row['extension_attributes']['sku'];
            /*var productlabel;
            $.each(row['extension_attributes']['productlabel'] as function(value){
                return productlabel = value;
            });*/
            // return row['extension_attributes']['productlabel'];
            return productlabel;
        },

        /**
         * @param row
         * @returns {*|boolean}
         */
        isAllowed: function (row) {
            // console.log(row);
            // return (columnStatusValidator.isValid(this.source(), 'sku', 'show_attributes') && this.hasValue(row) );
            return (columnStatusValidator.isValid(this.source(), 'productlabel', 'show_attributes') && this.hasValue(row) );
        }

    });
});