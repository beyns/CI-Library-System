var borrowed_table;

$(document).ready(function () {


    var base_url = window.location.origin;
    borrowed_table = $("#borrowedtable").DataTable({
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
                visible: false
            },

            {
                data: "fullname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "count",
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
            {
                data: "borrower_id",
                className: "v-align",
                searchable: false,
                orderable: false,
                render: function (data, type, row, meta) {
                    /**
                     * Attach actions
                     */
                    //   return "<div class=\"btn-group\" role=\"group\" aria-label=\"actions\">" +
                    //           "<button class='btn btn-xs btn-primary viewBtn' type='button' title='View' data-toggle='modal' data-target='#viewCategoryModal' value='"+data+"'><span class='fa fa-eye'></span></button> " +
                    //           "<button class='btn btn-xs btn-success editBtn' type='button' title='Edit' data-toggle='modal' data-target='#editCategoryModal' value='"+data+"'><span class='fa fa-pencil'></span></button>" +
                    //           "<button class='btn btn-xs btn-danger delBtn' type='button' title='Delete' data-toggle='modal' data-target='#deleteCategoryModal' value='"+data+"'><span class='fa fa-trash'></span></button>" +
                    //           "</div>";
                    return (
                        "<button  data-id='" +
                        data +
                        "' class='btn btn-sm btn-icon btn-secondary borrowed_bookss  ' id='' data-toggle='modal'  >  <i class='far fa-eye'></i></button>" +
                        "<button data-id='"
                    );

                    ("Edit");
                    ("</button>");
                }
            }
        ],
        drawCallback: function () {
            $('.borrowed_bookss').click(function () {
                var id = $(this).data("id");
                $(".bid").val(id);

                $("#borrowedbookstable").DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": false,
                    "bAutoWidth": false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: base_url + "/admin/book/borrow/booksborrowedTable/" + id,
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
                            orderable: false,
                            searchable: false,
                            visible: true,

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
                                return textTruncate(type, data, 10);
                            }
                        },
                        {
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
                        {
                            data: "book_id",
                            className: "v-align",
                            searchable: false,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                /**
                                 * Attach actions
                                 */
                                //   return "<div class=\"btn-group\" role=\"group\" aria-label=\"actions\">" +
                                //           "<button class='btn btn-xs btn-primary viewBtn' type='button' title='View' data-toggle='modal' data-target='#viewCategoryModal' value='"+data+"'><span class='fa fa-eye'></span></button> " +
                                //           "<button class='btn btn-xs btn-success editBtn' type='button' title='Edit' data-toggle='modal' data-target='#editCategoryModal' value='"+data+"'><span class='fa fa-pencil'></span></button>" +
                                //           "<button class='btn btn-xs btn-danger delBtn' type='button' title='Delete' data-toggle='modal' data-target='#deleteCategoryModal' value='"+data+"'><span class='fa fa-trash'></span></button>" +
                                //           "</div>";
                                return (
                                    "<button  data-id='" +
                                    data +
                                    "' class='btn btn-sm btn-icon btn-secondary change_status  ' id='' data-toggle='modal' href='#modal-change-status' > <i class='fal fa-pencil'></i></button>" +
                                    "<button data-id='"
                                );

                                ("Edit");
                                ("</button>");
                            }
                        }
                    ],
                    drawCallback: function () {

                    },
                    order: []
                });
                $(".borrowinfo-modal").modal({ backdrop: 'static', keyboard: false, show: true })

            })

            $('.btn-borrowed').click(function () {
                var id = $(this).data("id");
                $(".bid").val(id);

                $.get(base_url + '/admin/transaction/borrowedbooks/edit', { id: id }).done(function (result) {

                    $resultParse = JSON.parse(result);
                    console.log($resultParse);
                    $(".bname").val($resultParse.fullname);
                    $(".bdate").val($resultParse.date_borrowed);
                    $(".bbooktitle").text($resultParse.title);
                    $(".bbookid").val($resultParse.book_id);
                    $(".b_name").text($resultParse.fullname);
                    $(".br_date").text($resultParse.date_borrowed);
                    $(".b_code").text($resultParse.barcode);
                    $(".fls1").val($resultParse.borrowed_status).change();
                    $(".abook").val($resultParse.qty);
                    $(".bbqty").val($resultParse.borrowed_qty);


                })
                $('#borrowed_view').modal('show');
            })
        },
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

    $.get(base_url + '/admin/transaction/borrowedbooks/edit').done(function (result) {

        $resultParse = JSON.parse(result);
        console.log($resultParse);
        // $(".bdate").val($resultParse.due_date);

    })

    // $.post(base_url + '/admin/transaction/borrowedbooks').done(function (result) {

    //     console.log(result);
    // })

    $.get(base_url + '/admin/transaction/borrowedbooks/show').done(function (result) {
        var resultParse = JSON.parse(result);
        $.each(resultParse, function (v, k) {
            console.log(k.borrowed_date);
        });

    })
    $(".btn-update").click(function () {
        var frm = $('.br_form').serialize();
        $.post('/admin/transaction/borrowedbooks/update', frm).done(function (result) {
            console.log(result);
            Swal.fire(
                'Book Returned',
                result.message,
                'success'
            )
            borrowed_table.ajax.reload();

            $('#borrowed_view').modal('hide');
        }).fail(function (result) {
            Swal.fire(
                'Book Returned',
                result.text.message,
                'success'
            )
        });
    });

    $(".btn-update").click(function () {
        var frm = $('.br_form').serialize();
        $.post('/admin/transaction/borrowedbooks/update', frm).done(function (result) {
            console.log(result);
            Swal.fire(
                'Book Returned',
                result.message,
                'success'
            )
            borrowed_table.ajax.reload();

            $('#borrowed_view').modal('hide');
        }).fail(function (result) {
            Swal.fire(
                'Book Returned',
                result.text.message,
                'success'
            )
        });
    });
})