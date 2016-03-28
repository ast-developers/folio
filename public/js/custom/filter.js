/**
 * Created by rashmi-dholakiya on 23/3/16.
 */
$(document).ready(function () {

    $("#datepickerFrom").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText, inst) {
            if ($('#datepickerTo').val() != '') {
                if ($('#datepickerTo').val() < $('#datepickerFrom').val()) {
                    sweetAlert("Oops...", "Your To-Date must be greater then From-Date", "error");
                }
                else {
                    store_date($("#datepickerFrom").val(), $("#datepickerTo").val());
                }
            }
        }
    });

    $("#datepickerTo").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText, inst) {
            if ($('#datepickerFrom').val() == '') {
                alert('Select From date');
            }
            else {
                if ($('#datepickerTo').val() < $('#datepickerFrom').val()) {
                    sweetAlert("Oops...", "Your To-Date must be greater then From-Date", "error");
                }
                else {
                    store_date($("#datepickerFrom").val(), $("#datepickerTo").val());
                }
            }
        }
    });

    function store_date(from, to) {
        var base_url = window.location.origin;
        $.ajax({
            type: 'POST',
            url: base_url + "/folio/public/filter",
            data: {from_date: from, to_date: to},
            error: function () {
                $('#info').html('<p>An error has occurred</p>');
            },
            dataType: 'json',
            success: function (data) {
            }
        });
        location.reload();
    }
});
