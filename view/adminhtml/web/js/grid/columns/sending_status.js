
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html'
        },
        getLabel: function (record) {
            var label = this._super(record);

            if (label === 'sent') {
                label = '<span class="grid-severity-notice"><span>Sent</span></span>'
            }

            if (label === 'failed') {
                label = '<span class="grid-severity-major"><span>Failed</span></span>'
            }

            return label;
        }
    });
});