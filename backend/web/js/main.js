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
        var group_id = $(this).attr('data-id');
        var class_data = {group_id: group_id, _csrf: yii.getCsrfToken()};
        myAjax('/groups/archivegroup', class_data);
    });

    $("#studentSearchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#StudentTableItem .searchbar_item").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#select_filter").on("change", function() {
        var type = jQuery(this).val();
        var all='group'.concat(type);
        $("#StudentTableItem .searchbar_item").filter(function() {
            $("#StudentTableItem .searchbar_item").hide();
        });
    });

    $(".abled").change(function(){
        var val = $(this).val();
        if (val=='enable') {
            $("#StudentTableItem tr").filter(function () {
                $("#StudentTableItem .disable").hide();
                $("#StudentTableItem .enable").show();
            });
        }else if(val=='disable'){
            $("#StudentTableItem tr").filter(function () {
                $("#StudentTableItem .enable").hide();
                $("#StudentTableItem .disable").show();
            });
        }
        });

      $(document).delegate(".btn_finish", "click", function () {
          if ($('#userform').find(".has-success").length >= 5 ){
              $( function() {
                  $( "#dialog-confirm" ).html('Do you want to save student?').dialog({
                      resizable: false,
                      modal: true,
                      title: 'Confirmation',
                      buttons: [
                          {
                              text: "Yes",
                              "class": 'btn yesButtonClass',
                              click:function() {
                                 $('#userform').submit();
                              }},
                          {text: "No",
                              "class": 'btn noButtonClass',
                              click:function() {
                                  $( this ).dialog( "close" );
                                  window.location='/user/students/';
                          }
                          }
                      ]
                  });
              });
          }else{
              window.location='/user/students/';
          }
      }
      );
    var type = jQuery("#user-role").val();
    if (type != 'Student') {
        $(".student_items").prop("disabled", true).hide();
    } else{
        $(".student_items").prop("disabled", false).hide();
    }
    $('#user-role').on('change', function () {
        var type = jQuery("#user-role").val();
        console.log(type);
        if (type == 'Student') {
            $(".student_items").prop("disabled", false).show();
        } else{
            $(".student_items").prop("disabled", true).hide();
        }
    });
    $('#select_filter').on('change', function () {
        var type = jQuery("#select_filter").val();
        var all='.group'.concat(type);
        if (type!='') {
            $("tr").hide();
            $("tr").filter(all).show();
        }else{
            $("tr").show();
        }
    });
    $( function() {
        var dateFormat = "yyyy-mm-dd",
            from = $( "#from" )
                .datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#to" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                numberOfMonths: 3
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }
            return date;
        }
    } );

    var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }























});