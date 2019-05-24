$(document).ready(() => {
    var base_url = window.location.origin;
    var category_table;
    var book_table;
    var max_field = 10;
    var wrapper = $(".form-group-input"); //Fields wrapper

    $("#btn_show_category").click(() => {
        $(".modal_category").modal('show');
    });

    $(".subcategory").hide();
    category_table = $("#categoryTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/book/category/categoryTable",
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
                data: "category",
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
                        "<button data-toggle='modal' data-id='" +
                        data +
                        "' class='btn btn-danger btn-xs subCat'><i class='fas fa-plus'></i></button>" +
                        "<button type='button' data-toggle='modal' data-id='" +
                        data +
                        "' class='btn  btn-xs btn-primary editUserInfo' id='editmodal'>Edit</button>"
                    );

                    ("Edit");
                    ("</button>");
                }
            }
        ],
        drawCallback: function () {
            $(".subCat").click(function () {
                let id = $(this).data("id"),
                    sub_category = $('.frm-grp-subcat');

                $.post(base_url + "/admin/book/category/get_category", { id: id }).done(function (result) {

                    var res = jQuery.parseJSON(result);

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
            // $(".editUserInfo").click(function () {
            //     var id = $(this).data("id");
            //     $.post(base_url + "/user/getUser", { id: id }).done(function (result) {
            //         var jsonResult = JSON.parse(result);
            //         $("#userid").val(jsonResult.id);
            //         $("#fname").val(jsonResult.firstname);
            //         $("#lname").val(jsonResult.lastname);
            //         $("#email").val(jsonResult.email);
            //         $("#editModal").modal("show");
            //     });
            // });
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



    $('#btn-category').click(function () {
        // $.post(base_url + "/admin/book/category/add_book_category", $(".frm-category").serialize()).done(function (result) {
        $.post(base_url + "/category/add", $(".frm-category").serialize()).done(function (result) {
            $('.frm-category')[0].reset();
            $(".modal_category").modal('hide');
            category_table.ajax.reload();
        }).fail(function (result) {
            console.log(result);
        })
    })

    $('#btn-fields').click(function () {
        var x = 1;
        if (x < max_field) {
            x++;
            $(wrapper).append('<div class="form-group ">' +
                '<input type="text" class="form-control" id="sub_category"name="sub_category[]"' +
                'placeholder="" /></div>'); //add input box
        }
    })

    $('#btn-sub_category').click(function () {
        let data = $(".frm_sub_category").serialize();
        $.post(base_url + "/subcategory/add", data).done(function (result) {
            console.log(result);
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



})