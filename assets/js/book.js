$(document).ready(() => {
    var base_url = window.location.origin;
    var category_table;
    var book_table;
    var max_field = 10;
    var wrapper = $(".form-group-input"); //Fields wrapper
    $(".subcat").hide();


    book_table = $("#bookTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/book/books/booksTable",
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
                data: "isbn",
                render: function (data, type, row, meta) {

                    return textTruncate(type, data, 0);
                }
            },
            {
                data: "title",
                render: function (data, type, row, meta) {
                    return data.substr(0, 10) + '…';
                }
            },
            {
                data: "description",
                render: function (data, type, row, meta) {
                    return data.substr(0, 10) + '…';
                    return textTruncate(type, data, 0);
                }
            },
            {
                data: "author",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 0);
                }
            },

            {
                data: "category",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 0);
                }
            },
            {
                data: "subcategory",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 0);
                }
            },
            {
                data: "qty",
                render: function (data, type, row, meta) {
                    if (data == 0) {
                        return '<span class="badge badge-danger">NO AVAILABLE BOOK </span>'

                    }
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "borrowed_qty",
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
                        "<button  data-id='" +
                        data +
                        "' class='btn btn-sm btn-icon btn-secondary  btn-modal' id='btn-modal-view' >  <i class='far fa-eye'></i></button>" +
                        "<button data-id='" +
                        data +
                        "' class='btn btn-sm btn-icon btn-secondary btn-modal' id ='btn-modal-edit'>   <i class='fa fa-pencil-alt'></i></button>" +
                        "<button data-id='" +
                        data +
                        "' class='btn btn-sm btn-icon btn-secondary  btn-modal ' id='btn-modal-del' href='#' id ='btn-modal-edit'><i class='far fa-trash-alt'></i></button>" +
                        "<button data-id='" +
                        data +
                        "' class='btn btn-sm btn-icon btn-secondary  btn-modal ' id='btn-mb' href='#'><i class='fas fa-book-reader'></i></button>"

                    );

                    ("Edit");
                    ("</button>");
                }
            }
        ],
        drawCallback: function () {

            $('.btn-modal').click(function () {
                var btn_class = $(this).attr("id");
                var id = $(this).data("id");
                if (btn_class == 'btn-modal-view') {

                    $(".id").val(id);
                    $.get(base_url + '/book/show', { id: id }).done(function (result) {
                        let parseResult = JSON.parse(result);
                        $(".booktitle").text(parseResult.title);
                        $(".description").text(parseResult.description);
                        $(".author").text(parseResult.author);
                        $(".category").text(parseResult.category);
                        $(".isbn").text(parseResult.isbn);
                    });
                    $('#modal_view').modal('show');

                }
                else if (btn_class == 'btn-modal-edit') {
                    $(".id").val(id);
                    $.get(base_url + '/book/show', { id: id }).done(function (result) {
                        console.log(result);
                        let parseResult = JSON.parse(result);
                        $("#b_id").val(parseResult.id);
                        $("#b_title").val(parseResult.title);
                        $("#b_description").val(parseResult.description);
                        $("#b_isbn").val(parseResult.isbn);
                        $("#update_category").val(parseResult.category).change();
                        $("#b_author").val(parseResult.author);
                        $("#b_qty").val(parseResult.qty);
                        $("#b_borrowed").val(parseResult.borrowed_qty);


                    });
                    $('#modal_edit').modal('show');
                }

                else if (btn_class == 'btn-modal-del') {
                    $(".id").val(id);
                    $.get(base_url + '/book/show', { id: id }).done(function (result) {
                        console.log(result);
                        let parseResult = JSON.parse(result);
                        $("#bbid").val(parseResult.id);
                        $(".book_title").text(parseResult.title);

                    });
                    $('#modal_del').modal('show');
                }
                else {
                    $(".id").val(id);
                    $.get(base_url + '/book/show', { id: id }).done(function (result) {
                        console.log(result);
                        let parseResult = JSON.parse(result);
                        $(".bbid").val(parseResult.id);
                        $(".book_title").text(parseResult.title);
                        $(".bbook_title").val(parseResult.title);
                        $(".bbook_qty").val(parseResult.qty);
                        $(".book_ids").val(parseResult.id);


                    });
                    $.get(base_url + '/admin/book/books/totalBooks', { id: id }).done(function (result) {
                        var allowed_books = 3;
                        var res = $.parseJSON(result);
                        // console.log(resParse.fullname);
                        $.each(res, function (k, v) {
                            $(".br_qty").val(v);
                        });
                    })

                    $('#modal_borrow').modal('show');

                }



                // $('#modal_view').modal('show');
            });

            $(".subCat").click(function () {
                let id = $(this).data("id"),
                    sub_category = $('.frm-grp-subcat');
                console.log(id);

                $.post(base_url + "/admin/book/category/get_category", { id: id }).done(function (result) {
                    console.log(result);

                    var res = jQuery.parseJSON(result);
                    console.log(res.category);
                    console.log(res);
                    $.each(res, function (k, v) {
                        $('.frm-grp-subcat').empty();
                        $('.category').text(v.category);
                        $("#id").val(v.id);
                        (sub_category).append(
                            '<div class="todo ">' +
                            ' <div class="custom-control custom-checkbox">' +
                            '<input type="checkbox" class="custom-control-input" name="subcat[]" id="' + v.id + '">' +
                            '<label class="custom-control-label" for="' + v.id + '">' + v.sub_category + '</label>' +
                            '</div>' +
                            '</div>'

                        );
                    });
                    if (res.length) {
                        sub_category.attr('disabled', false);
                    } else {
                        sub_category.attr('disabled', 'disabled');
                    }
                })

                $(".modal_subCat").modal('show');
            });
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

    $('#update_category').change(function () {
        let id = $(this).find(":selected").data('id'),
            sub_category = $('#update_sub_category');
        $.post(base_url + "/admin/book/books/select_sub_category", { id: id }).done(function (result) {

            var res = jQuery.parseJSON(result);
            sub_category.empty();
            $.each(res, function (k, v) {
                sub_category.append($('<option>', {
                    value: v.sub_category,
                    text: v.sub_category
                }));
            });
            if (res.length) {
                // sub_category.attr('disabled', false);
                $(".subcategory").show();
            } else {
                // sub_category.attr('disabled', 'disabled');
                $(".subcategory").hide();
            }
        })
        // console.log(id);
    })

    $('.btn-update-book').click(function () {
        $.post(base_url + '/admin/book/books/update', $('.editfrmbook').serialize()).done(function (result) {
            Swal.fire(
                '',
                result.message,
                'success'
            )
            $('#modal_edit').modal('hide');
            book_table.ajax.reload();
        }).fail(function (result) {
            Swal.fire(
                'Unable to save changes',
                result.responseJSON.message,
                'error'
            )
        });
    })
    $('#show-bookModal').click(function () {
        $('.modal_book').modal('show');
        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        var barcode = 'CIE-' + makeid(5) + '-LMS';
        $('.barcode').val(barcode);
    })

    $('.btn-add-book').click(function () {
        $.post(base_url + '/admin/book/books/insert', $('.frmbook').serialize()).done(function (result) {
            console.log(result);
            $('.frmbook')[0].reset();
            book_table.ajax.reload();
            Swal.fire(
                '',
                result.message,
                'success'
            )
            $('.modal_book').modal('hide');
        }).fail(function (result) {
            Swal.fire(
                'Failed To Add Book',
                result.responseJSON.message,
                'error'
            )
        });
    });
    $('#select_category').change(function () {
        let id = $(this).find(":selected").data('id'),
            sub_category = $('#sub_category');
        $.post(base_url + "/admin/book/books/select_sub_category", { id: id }).done(function (result) {

            var res = jQuery.parseJSON(result);
            sub_category.empty();
            $.each(res, function (k, v) {
                sub_category.append($('<option>', {
                    value: v.sub_category,
                    text: v.sub_category
                }));
            });
            if (res.length) {
                // sub_category.attr('disabled', false);
                $(".subcategory").show();

            } else {
                // sub_category.attr('disabled', 'disabled');
                $(".subcategory").hide();
                $(".subcat").show();
                $(".cat").hide();
            }
        })
        // console.log(id);
    })

    $('.js-select').change(function () {
        let id = $(this).find(":selected").data('id');

        console.log($(this).find(':selected').data('id'));
    })

    $('.btn-rembook').click(function () {
        var frm = $(".rembook").serialize();
        console.log(frm);
        $.post(base_url + '/admin/book/books/destroy', frm).done(function (result) {
            console.log(result);
            book_table.ajax.reload();
        }).fail(function () {
            alert('Error');
        })
    })


    $.get(base_url + '/admin/book/books/show_student').done(function (result) {
        var data = $.map(JSON.parse(result), function (obj) {
            obj.id = obj.id;
            obj.text = obj.fullname;
            obj.value = obj.id;
            return obj;
        });
        $(".js-select").select2({
            placeholder: "Select a student",
            allowClear: true,
            data: data
        }).on("change", function (e) {
            var obj = $(".js-select").select2("data");
            var id = obj[0].id;
            $('.stud_id').val(obj[0].id);
            var std_id = $(".stud_id").serialize();
            var b_id = $(".book_id").serialize();
            $.get(base_url + '/admin/book/books/allowedBooks', std_id).done(function (result) {
                var allowed_books = 3;
                var res = $.parseJSON(result);
                $.each(res, function (k, v) {
                    var borrowed_books = v.count;
                    console.log(v.count);
                    if (borrowed_books == allowed_books) {
                        Swal.fire(
                            'Unable to borrow',
                            'User still have unreturned Books',
                            'error'
                        )
                        // $(".js-select").select2();
                        $('.btn-borrow').attr('disabled', true);
                        $('.btn-new').hide();
                    } else {
                        $('.btn-borrow').attr('disabled', false);
                        $('.btn-new').hide();

                    }

                });
            })

            // $('.js-select').val([]);
            if (obj) {
                $('.btn-borrow').show();
            } else {
                $('.btn-new').hide();
            }
        })
    })
    $('.btn-new').click(function () {
        // $('.js-select2').empty();
        $(".studentfrm").hide();
        $('.student_info').show();
        $('.btn-save').show();
        $('.btn-new').hide();
        $('.btn-borrow').hide();

    })
    $('.btn-borrow').click(function () {
        var frm = $(".borrowForm").serialize();
        $.post(base_url + '/admin/book/books/borrow', frm).done(function (result) {
            $(".borrowForm")[0].reset();
            $('#modal_borrow').modal('hide');

            book_table.ajax.reload();
            Swal.fire(
                '',
                'Successfully Borrowed',
                'success'
            )
            $('.btn-new').show();
            $('.btn-borrow').hide();

        })
        $(".js-select").val([]).trigger("change");

    })

    $('.btn-xcancel').click(function () {
        $('#modal_borrow').modal('hide');
        window.location.reload()
    })

    $('.cat_del').click(function () {
        // $.post(base_url + '/admin/book/category/remove_cat', $('.delcat').serialize).done(function (result) {
        //     console.log(result);
        // })
        alert('hello');
    })
})