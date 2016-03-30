/**
 * Created by rashmi-dholakiya on 29/3/16.
 */
$(document).ready(function () {
    $('.roles').click(function (){

            var role_value =$(this).val();

            var user_id=$(this).data('user-id');
            $.ajax({
                type: 'POST',
                url: base_url + "/folio/public/update-role",
                data: { role : role_value, user_id : user_id },
                error: function () {
                    sweetAlert("Oops...", "Error Occurred", "error");
                },
                success: function () {
                    sweetAlert("Success", "Role changed successfully", "success");
                    location.reload();
                }
            });

    });
});