$(function () {
    $.widget('custom.loadTable', {
        options: {
            url: '',
            filter: {},
            method: 'get',
            columns: [],
            afterInit: () => {
            },
        },

        _create: function () {
            this._getData();
        },

        reload: function () {
            return this._create();
        },

        _getData: function () {
            let _loader = $(this._makeLoader()), _table = this.element.html('');
            $.ajax({
                url: this.options.url,
                type: this.options.method,
                data: this.options.filter,
                beforeSend: () => _table.prepend(_loader),
                complete: () => _loader.remove(),
                success: response => {
                    this._renderTable(response);
                },
            });
        },

        _makeLoader: function () {
            return '<div class="custom-preloader-widget">' +
                '<svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">' +
                '<circle cx="170" cy="170" r="135" stroke="#022b70"/>' +
                '<circle cx="170" cy="170" r="110" stroke="#2666ea"/>' +
                '<circle cx="170" cy="170" r="85" stroke="#21e3f7"/>' +
                '</svg>' +
                '</div>';
        },

        _renderTable: function (data) {
            let _table = this.element;
            _table.addClass(' table-earning table-borderless table-striped font-15 ');
            _table.html('<thead></thead><tbody></tbody>');
            _table.find('thead').html(this._makeHeader());
            _table.find('tbody').html(this._makeBody(data));
            this.options.afterInit();
        },

        _makeHeader: function () {
            let row = '<tr>';
            for (let col of this.options.columns) {
                row += `<th>${col.title}</th>`;
            }
            row += '</tr>';
            return row;
        },

        _makeBody: function (rowsData) {
            let row = '';
            for (let item of rowsData) {
                row += '<tr>';
                for (let col of this.options.columns) {
                    row += '<td>';
                    if (col.render != null) {
                        let data = col.data.map(t => item[t]);
                        row += col.render(col.data, data, item);
                    } else {
                        for (let field of col.data) {
                            row += `${item[field] != null ? item[field] : ' '} `;
                        }
                    }
                    row += '</td>';
                }
                row += '</tr>';
            }
            return row;
        },
    });
});
