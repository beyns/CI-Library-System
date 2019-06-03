$(document).ready(() => {
    var base_url = window.location.origin;
    var category_table;
    var book_list;
    var max_field = 10;
    var wrapper = $(".form-group-input"); //Fields wrapper

    $('.student_info').hide();

    borrower = $("#borrowersTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/user/borrowers/borrowersTable",
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
                data: "fullname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "student_num",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "address",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 10);
                }
            },
            {
                data: "contact",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "id",
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
                        "<button  data-id='" + data + "' class='btn btn-sm btn-icon btn-secondary borrower_view '  data-backdrop='static' data-keyboard='false' id='btn-modal-view'>  <i class='far fa-eye'></i></button>" +
                        "<button  data-id='" + data + "' class='btn btn-sm btn-icon btn-secondary borrower_edit '   >  <i class='fa fa-pencil-alt'></i></button>"

                    );

                    ("Edit");
                    ("</button>");
                }
            }
        ],
        drawCallback: function () {

            $('.borrower_view').click(function () {
                var id = $(this).data("id");
                $('.br_id').val(id);
                $.post(base_url + '/admin/user/borrowers/show_books', $('.br_form').serialize()).done(function (result) {
                    var res = JSON.parse(result);
                    $.each(res, function (k, v) {
                        console.log(v.title);
                        console.log(v.date_borrowed);
                        $('.media-body').append(

                            ' <p class="mb-0">' +
                            v.title
                            + ' </p> <span class="timeline-date">' +
                            v.date_borrowed
                            + '</span >'
                        );
                        // $("#result").append(k + ": " + v.title + '<br>');
                    });
                });
                $('#modal_view').modal({ backdrop: 'static', keyboard: false, show: true })
            }
            );

            $('.borrower_edit').click(function () {
                var id = $(this).data("id");
                $('.br_id').val(id);
                $.get(base_url + '/admin/user/borrowers/edit', { id: id }).done(function (result) {
                    var res = JSON.parse(result);

                    $('.student_num').val(res.student_num);
                    $('.fullname').val(res.fullname);
                    $('.address').val(res.address);
                    $('.contact').val(res.contact);
                    $("#modal_borrower_info").modal('show');

                })
            })
            $('#btn-cancel').click(function () {
                $('#modal_view').modal('hide');

                $(".media-body").empty();
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
    $('.btn-br-update').click(function () {

        $.post(base_url + '/admin/user/borrowers/update', $('.student_form').serialize()).done(function (result) {
            Swal.fire(
                'Changes saved',
                'success'
            )
            console.log(result);
        }).fail(function (result) {
            Swal.fire(
                'Unable to save changes',
                // result.responseJSON.message,
                'error'
            )
            console.log(result);
        })
    })

    // $('#btn-borrow').click(function () {
    //     $.post(base_url + '/books/booklist/borrow_book', $('.borrow_form').serialize()).done(function (result) {
    //         console.log(result);
    //     })
    // })

})