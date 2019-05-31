$(document).ready(function () {
    var base_url = window.location.origin;
    var borrowed_table;
    var unreturned_table
    unreturned_table = $("#unreturnedBookTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/dashboard/reportTable",
            dataType: "json",
            // data: {_token : $('meta[name="token_"]').attr('content')},
            type: "POST"
        },

        lengthMenu: [10, 25, 50, 75, 100, 250, 500],
        rowReorder: {
            selector: ".sort-column",
            update: false
        },
        columns: [
            {
                data: "id",
                orderable: true,
                searchable: true,
                visible: true
            },
            {
                data: "title",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "fullname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },

            {
                data: "address",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "contact",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "date_borrowed",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },


        ],
        order: []
    });

    function textTruncate(type, data, length) {
        if (data.length) {
            return data;
        }

        return type === "display" && data.length > length
            ? '<span class="cursor-pointer truncated-text" data-text="' +
            data +
            '">' +
            data.substr(0, length - 2) +
            "...</span>"
            : data;
        // DO NOT DELETE WILL BE USED LATER ON...
        /*return type === 'display' && data.length > length ? '<span ' + ((isLink) ? 'class="cursor-pointer truncated-text"' : "") + ' data-text="'+data+'">'+data.substr( 0, length - 2 )+'...</span>' : data;*/
    }


    borrowed_table = $("#borrowedBookTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/transaction/borrowedbooks/borrowedTable",
            dataType: "json",
            // data: {_token : $('meta[name="token_"]').attr('content')},
            type: "POST"
        },

        lengthMenu: [10, 25, 50, 75, 100, 250, 500],
        rowReorder: {
            selector: ".sort-column",
            update: false
        },
        columns: [
            {
                data: "id",
                orderable: true,
                searchable: true,
                visible: true
            },
            {
                data: "barcode",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },

            {
                data: "title",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "fullname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "date_borrowed",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },

        ],

        order: []
    });

    function textTruncate(type, data, length) {
        if (data.length) {
            return data;
        }

        return type === "display" && data.length > length
            ? '<span class="cursor-pointer truncated-text" data-text="' +
            data +
            '">' +
            data.substr(0, length - 2) +
            "...</span>"
            : data;
        // DO NOT DELETE WILL BE USED LATER ON...
        /*return type === 'display' && data.length > length ? '<span ' + ((isLink) ? 'class="cursor-pointer truncated-text"' : "") + ' data-text="'+data+'">'+data.substr( 0, length - 2 )+'...</span>' : data;*/
    }


    $(function () {
        $('input[name="date_borrowed"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2000,
            maxYear: parseInt(moment().format('YYYY'), 10)
        }, function (start, end, label) {
            var date = start.format('YYYY-MM-DD');
            ($(".date_borrowed").val(date));
            console.log('New date range selected: ' + start.format('YYYY-MM-DD'));
            $.post(base_url + '/admin/transaction/borrowedbooks/select', $('.datefrm').serialize()).done(function (result) {
                console.log(result);
                borrowed_table.ajax.reload();
            })

        });
    });
})