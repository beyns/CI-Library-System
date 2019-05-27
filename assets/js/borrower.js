$(document).ready(() => {
    var base_url = window.location.origin;
    var category_table;
    var book_list;
    var max_field = 10;
    var wrapper = $(".form-group-input"); //Fields wrapper


    book_list = $("#booklist").DataTable({
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
                        "' class='btn btn-sm btn-icon btn-secondary ' id='btn-modal-borrow' >  <i class='far fa-eye'></i></button>"
                    );

                    ("Edit");
                    ("</button>");
                }
            }
        ],
        drawCallback: function () {

            $('#btn-modal-borrow').click(function () {
                var id = $(this).data("id");

                $(".bk-id").val(id);
                $.get(base_url + '/book/show', { id: id }).done(function (result) {
                    let parseResult = JSON.parse(result);
                    $(".bk-id").val(id);
                    $(".bk-title").val(parseResult.title);
                    $(".booktitle").text(parseResult.title);
                    $(".description").text(parseResult.description);
                    $(".author").text(parseResult.author);
                    $(".category").text(parseResult.category);
                    $(".isbn").text(parseResult.isbn);
                });
                $('#modal_borrow').modal('show');
            }
            );
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


    $('#btn-borrow').click(function () {
        $.post(base_url + '/books/booklist/borrow_book', $('.borrow_form').serialize()).done(function (result) {
            console.log(result);
        })
    })

})