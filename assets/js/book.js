$(document).ready(() => {
    var base_url = window.location.origin;
    var category_table;
    var book_table;
    var max_field = 10;
    var wrapper = $(".form-group-input"); //Fields wrapper


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
                data: "title",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "description",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 10);
                }
            },
            {
                data: "author",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "isbn",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "category",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "subcategory",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "qty",
                render: function (data, type, row, meta) {
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
                        "' class='btn btn-sm btn-icon btn-secondary  btn-modal ' id='btn-modal-del' href='#' id ='btn-modal-edit'><i class='far fa-trash-alt'></i></button>"
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
                        $("#b_author").val(parseResult.author);
                        $("#b_category").val(parseResult.category);
                        $("#b_subcategory").val(parseResult.subcategory);
                        $("#b_quantity").val(parseResult.qty);

                    });
                    $('#modal_edit').modal('show');
                }

                else {
                    $(".id").val(id);
                    $.get(base_url + '/book/show', { id: id }).done(function (result) {
                        console.log(result);
                        let parseResult = JSON.parse(result);
                        $("#book_id").val(parseResult.id);
                        $(".book_title").text(parseResult.title);
                    });
                    $('#modal_del').modal('show');
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


    $('#show-bookModal').click(function () {
        $('.modal_book').modal('show');
    })

    $('.btn-add-book').click(function () {
        $.post(base_url + '/admin/book/books/insert', $('.frmbook').serialize()).done(function (result) {
            book_table.ajax.reload();
            $('.modal_book').modal('hide');
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
            }
        })
        // console.log(id);
    })

    $('#btn-remove-book').click(function () {
        var frm = $("removebook").serialize();
        $.get(base_url + '/book/remove', frm).done(function (result) {
            book_table.ajax.reload();
        })
    })

})