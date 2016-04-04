/**
 * Created by rashmi-dholakiya on 30/3/16.
 */
$(document).ready(function () {
    $('.roles').click(function (e) {
        var roles = $(this);
        var role_value = $(this).val();
        var project_id = $(this).data('project-id');
        $('table').find('.multiselect').remove();

        $.ajax({
            type: 'POST',
            url: base_url + "/folio/public/get-users",
            data: {role: role_value},
            error: function () {
                sweetAlert("Oops...", "Error Occurred", "error");
            },
            dataType: 'json',
            success: function (data) {
                var select = '<div class="multiselect">' +
                    '<div class="selectBox" onclick="showCheckboxes(this)">' + '<select>' + '<option>Select ' + role_value + '</option>' + '</select>' + '<div class="overSelect"></div>' + '</div>' + '<div class="checkboxes">';
                var check = false;
                $.each(data, function (index, value) {

                    $.ajax({
                        type: 'POST',
                        url: base_url + "/folio/public/get-user-projects",
                        async: false,
                        data: {'user_id': value.id, 'project_id': project_id},
                        error: function () {
                            sweetAlert("Oops...", "Error Occurred", "error");
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data > 0) {
                                check = true;
                            }
                            else {
                                check = false;
                            }
                        }
                    });

                    swal({
                        title: "Loading",
                        text: "Loading Please wait..",
                        timer: 700,
                        showConfirmButton: false
                    });
                    if (check) {
                        var option =
                            '<label><input type="checkbox" checked="checked" class="checkboxvalue" data-user-id="' + value.id + '"' + 'data-project-id="' + project_id + '"' + '/>' + value.name + '</label>';
                    }
                    else {
                        var option =
                            '<label><input type="checkbox"  class="checkboxvalue" data-user-id="' + value.id + '"' + 'data-project-id="' + project_id + '"' + '/>' + value.name + '</label>';
                    }
                    select += option;
                });
                select += '</div>' + '</div>';

                $(roles).parent().append(select);
                $('.checkboxvalue').on('click', function (e) {
                    var user_id = ($(this).data('user-id'));
                    var project_id = ($(this).data('project-id'));

                    $.ajax({
                        type: 'POST',
                        url: base_url + "/folio/public/assign-project-to-user",
                        data: {user_id: user_id, project_id: project_id},
                        error: function () {
                            sweetAlert("Oops...", "Error Occurred", "error");
                        },
                        success: function () {
                            sweetAlert("Success", "Project assigned successfully", "success");
                        }
                    });
                });
            }
        });
    });
});
var expanded = false;
function showCheckboxes(e) {
    var checkboxes = $(e).parent().find('.checkboxes');
    if (!expanded) {
        checkboxes.css('display', "block");
        expanded = true;
    } else {
        checkboxes.css('display', "none");
        expanded = false;
    }
}