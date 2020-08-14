$(function () {
    $.widget('custom.loadTable', {
        options: {
            _uniq: null,
            url: '',
            filter: {},
            method: 'get',
            columns: [],
            afterInit: () => {
            },
        },
        _create: function () {
            this.options._uniq = uniqId();
            this.element.parent().prepend(this._makeButtons());
            this._getData();
            this._handleButtonEvents();
        },
        reload: function () {
            return this._getData();
        },
        _getData: function () {
            let _loader = $(this._makeLoader()), _table = this.element.html('');
            $.ajax({
                url: this.options.url,
                type: this.options.method,
                data: this.options.filter,
                beforeSend: () => {
                    $(`#table-data__tool_${this.options._uniq}`).find('button').prop('disabled', true);
                    _table.prepend(_loader);
                },
                complete: () => {
                    $(`#table-data__tool_${this.options._uniq}`).find('button').prop('disabled', false);
                    _loader.remove();
                },
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
        _makeButtons: function () {
            let dataTool = $(`<div id="table-data__tool_${this.options._uniq}" 
                             class="table-data__tool cst-loadTable">
                                <div class="table-data__tool-left"></div>
                                <div class="table-data__tool-right"></div>
                            </div>`);
            dataTool.find('.table-data__tool-left')
                .append(`<button id="data__tool_btn_refresh_${this.options._uniq}" class="btn btn-dark btn-sm">
                <i class="fas fa-refresh"></i></button>`);
            return dataTool;
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
            if (rowsData.length == 0) {
                return `<tr><td class="text-center" colspan="${this.options.columns.length}">
                    <i>Nenhum registro encontrado.</i></td></tr>`;
            }
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
        _handleButtonEvents: function () {
            let _self = this;
            document.getElementById(`data__tool_btn_refresh_${this.options._uniq}`)
                .addEventListener('click', function(){
                    _self.reload();
            });
        },
    });
});
