$(document).ready(function () {

    var base_url = window.location.origin;
    var members_table;
    $('.cancel-btn').hide();
    $('.update-btn').hide();
    $(".chkc").hide();
    $('.cpassword').hide();

    members_table = $("#memberTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/user/members/membersTable",
            dataType: "json",
            // data: {_token : $('meta[name="token_"]').attr('content')},
            type: "GET"
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
                data: "firstname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "lastname",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },
            {
                data: "username",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 10);
                }
            },
            {
                data: "email",
                render: function (data, type, row, meta) {
                    return textTruncate(type, data, 20);
                }
            },

            {
                data: "role",
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
                        "<button data-id='"
                        // data +
                        // "' class='btn btn-sm btn-icon btn-secondary btn-modal' id ='btn-modal-edit'>   <i class='fa fa-pencil-alt'></i></button>" +
                        // "<button data-id='" +
                        // data +
                        // "' class='btn btn-sm btn-icon btn-secondary  btn-modal ' id='btn-modal-del' href='#' id ='btn-modal-edit'><i class='far fa-trash-alt'></i></button>"
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
                    $.get(base_url + '/admin/user/members/edit', { id: id }).done(function (result) {
                        let parseResult = JSON.parse(result);
                        console.log(parseResult);
                        $(".fname").val(parseResult.firstname);
                        $(".lname").val(parseResult.lastname);
                        $(".uname").val(parseResult.username);
                        $(".email").val(parseResult.email);
                        $(".role").val(parseResult.role).change();
                    });
                    $('#modal_edit').modal('show');

                }
                // $('#modal_view').modal('show');
            });

            $(document).on('click', '#btn-edit', function () {
                $(".fname").prop('disabled', false);
                $(".lname").prop('disabled', false);
                $(".uname").prop('disabled', false);
                $(".email").prop('disabled', false);
                $(".role").prop('disabled', false);
                $(".pass").prop('disabled', false);
                $(".cpass").prop('disabled', false);
                $(".chkc").show();

                $('.edit-btn').hide();

                $('.cancel-btn').show();
                $('.update-btn').show();
            })

            $(document).on('click', '#btn-cancel', function () {
                $(".fname").prop('disabled', true);
                $(".lname").prop('disabled', true);
                $(".uname").prop('disabled', true);
                $(".email").prop('disabled', true);
                $(".role").prop('disabled', true);


                $('.cancel-btn').hide();
                $('.chkc').toggle();
                $('.update-btn').hide();

                $('.edit-btn').show();
                $('#modal_edit').modal('hide');

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


    $('#ckb7').change(function () {
        $('.cpassword').toggle();
    });
    $('#member_show').click(function () {
        $('#member_modal').modal('show');
    })

    $('#btn-member').click(function () {

        $.post(base_url + '/admin/user/members/insert', $('.member_form').serialize()).done(function (result) {
            $('.member_form')[0].reset();
            console.log(result)
            Swal.fire(
                '',
                'User Added',
                'success'
            )
            $('#member_modal').modal('hide');
            members_table.ajax.reload();
        }).fail(function (result) {
            $('.member_form')[0].reset();
            Swal.fire(
                '',
                result.responseJSON.message,
                'error'
            )
            //   $('.err_message').html();
        });
    });

    $('#ckb7').change(function () {
        if ($(this).prop('checked')) {
            $(this).val('true');
        } else {
            $(this).val('false');
        }
    });
    $('#btn-update').click(function () {



        $.post(base_url + '/admin/user/members/update', $('.editMmbrForm').serialize()).done(function (result) {
            console.log(result);
            $('.editMmbrForm')[0].reset();
            $('#modal_edit').modal('hide');
            members_table.ajax.reload();
        }).fail(function (result) {
            Swal.fire(
                '',
                result.responseJSON.message,
                'error'
            )
        });
    })
});