$( document ).ready(function() {
    $("#myModal").modal({
        backdrop: 'static',
        keyboard: true,
        autoopen: true
    });
});
$("#studentSearchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#StudentTableItem tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
    });
});
$(function () {
    function myAjax(url, data) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function (res) {
                console.log(res);
            }
        });
    }
    $(document).delegate(".change_password", "click", function () {
        var new_pass = $(this).parent('div').siblings('input').val();
        var change_password = {new_pass: new_pass, _csrf: yii.getCsrfToken()};
        myAjax('/user/changepassword', change_password);
    });
});