$(function () {

    // custom loadTable
    $.widget('custom.loadTable', {
        options: {
            url: '',
            filter: {},
            method: 'get',
            primaryKey: 'id',
            columns: [],
        },

        _create: function () {
            this._getData();
        },

        _getData: function () {
            $.ajax({
                url: this.options.url,
                type: this.options.method,
                data: this.options.filter,
                success: response => {
                    console.log(response);
                }
            });
        }
    });

});
