/**
 * Created by rashmi-dholakiya on 30/3/16.
 */
$(document).ready(function () {
    $('.roles').click(function () {

            var role_value = $(this).val();
            var project_id = $(this).attr('data-project-id');

            $.ajax({
                type: 'POST',
                url: base_url + "/folio/public/assign",
                data: { role : role_value , project_id : project_id},
                error: function () {
                    sweetAlert("Oops...", "Error Occurred", "error");
                },
                success: function () {
                    sweetAlert("Success", "Project assigned successfully", "success");
                }
            });
    });
});