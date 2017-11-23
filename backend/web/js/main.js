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
    $(document).delegate(".archive_class", "click", function () {
        var class_id = $(this).attr('data-id');
        var class_data = {class_id: class_id, _csrf: yii.getCsrfToken()};
        myAjax('/classes/archiveclass', class_data);
    });

    $("#studentSearchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#StudentTableItem tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});