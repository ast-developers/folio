/**
 * Created by rashmi-dholakiya on 30/3/16.
 */
$(document).ready(function () {
    $('.roles').click(function () {
        var role_value = $(this).val();
        var project_id = $(this).attr('data-project-id');
        call_ajax(role_value, project_id);

    });
    $('.check_all_sales').click(function () {

        var checkboxes = document.getElementsByName('roles');
        for (var i = 0; i < checkboxes.length; i++) {

            if (checkboxes[i].value == 'Sales' && checkboxes[i].checked == false) {
                checkboxes[i].checked = true;
                var role_value = 'Sales';
                var project_id = checkboxes[i].getAttribute('data-project-id');
                call_ajax(role_value, project_id);
            }
        }
    });
    $('.check_all_manager').click(function () {
        var checkboxes = document.getElementsByName('roles');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].value == 'Manager' && checkboxes[i].checked == false) {
                checkboxes[i].checked = true;
                var role_value = 'Manager';
                var project_id = checkboxes[i].getAttribute('data-project-id');
                call_ajax(role_value, project_id);

            }
        }
    });

    function call_ajax(role_value, project_id) {
        var result;
        $.ajax({
            type: 'POST',
            url: base_url + "/folio/public/assign",
            data: {role: role_value, project_id: project_id},
            error: function () {
                sweetAlert("Oops...", "Error Occurred", "error");
            },
            success: function () {
            }
        });
    }
});