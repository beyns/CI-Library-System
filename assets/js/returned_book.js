$(document).ready(function () {
    var base_url = window.location.origin;
    var borrowed_table;
    returned_table = $("#returnedBookTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/transaction/returnedbooks/returnedTable",
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
                data: "fullname",
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
                data: "date_borrowed",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "due_date",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 10);
                }
            },
            {
                data: "borrowed_status",
                render: function (data, type, row, meta) {
                    return (
                        '<span class="badge badge-success">' + data + '</span>'
                    );
                }
            },
            {
                data: "date_returned",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            }, {
                data: "penalty",
                render: function (data, type, row, meta) {
                    if (data == 'No Penalty') {
                        return (
                            '<span class="badge badge-success">' + data + '</span>'
                        );
                    }
                    else {
                        return (
                            '<span class="badge badge-danger">' + 'PHP' + ' ' + data + '.00' + '</span>'
                        );
                    }
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
})