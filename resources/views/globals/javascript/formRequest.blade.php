<script>

    function formRequest(element)
    {
        form_data         = new FormData(element);
        form_element      = $(element);
        form_action       = form_element.attr("action");
        form_method       = form_element.attr("method");
        form_data.append('_token', "{{ csrf_token() }}");
        loadingSwal(form_element.attr("title-loading-swal"), form_element.attr("message-loading-swal"));
        $.ajax({
            url         : form_action,
            method      : form_method,
            data        : form_data,
            processData : false,
            contentType : false,
            success     : function (response)
            {
                if(response.status==="success")
                {
                    successSwal("Parabéns!", response.message, null, 3000, false);
                    if(response.redirect){setTimeout(function () {location = response.redirect;}, 2000)}
                    if(response.url){setTimeout(function () {location = response.url;}, 2000)}
                }
                else
                {
                    errorSwal("Ops!", response.message, null, false, true);
                }
            },
            error       : function (response)
            {

                var htmlError = "" +
                    "<div class='m-5' style='width: 70%;text-align: center;position:relative;left: 7.5%;'>" +
                    "<h5 class='text-light'>"+response.responseJSON.exception+"</h5>" +
                    "<hr>" +
                    "<div style='position:relative;border: 1px dashed red; padding: 10px; text-align: left;'>" +
                    "<p class='text-danger'><span class='text-light'>Message: </span>"+response.responseJSON.message+"</p>" +
                    "<p class='text-info'><span class='text-light'>Arquivo:  </span>"+response.responseJSON.file+" | <span class='text-success'> Linha: "+response.responseJSON.line+"</span></p>" +
                    "</div>" +
                    "</div>";
                var lis_messages = "";
                if(response.responseJSON.message==="Validação de Campos não passou!!")
                {
                    $.each(response.responseJSON.data.errorValidation, function (key, arrayMessage) {
                        $("input[name="+key+"]").css("border", "1px dashed red");
                        $("select[name="+key+"]").css("border", "1px dashed red");
                        $("textarea[name="+key+"]").css("border", "1px dashed red");
                        $.each(arrayMessage, function (key, message) {
                            lis_messages += "<li>"+message+"</li>"
                        });
                    });
                    htmlError = "" +
                        "<div>" +
                        "<h5 class='text-light'>"+response.responseJSON.message+"</h5>" +
                        "<ol class='ol-validation'>" +
                        lis_messages +
                        "</ol>" +
                        "</div>";
                }
                if(response.responseJSON.message==="The given data was invalid.")
                {
                    $.each(response.responseJSON.errors, function (key, arrayMessage) {
                        $("input[name="+key+"]").css("border", "1px dashed red");
                        $("select[name="+key+"]").css("border", "1px dashed red");
                        $("textarea[name="+key+"]").css("border", "1px dashed red");
                        $.each(arrayMessage, function (key, message) {
                            lis_messages += "<li>"+message+"</li>"
                        });
                    });
                    htmlError = "" +
                        "<div>" +
                        "<h5 class='text-light'>Validação de Campos não passou!!</h5>" +
                        "<hr>" +
                        "<div style='border: 1px dashed red; padding: 10px 10px 0 0; text-align: left;'>" +
                        "<ol class='ol-validation'>" +
                        lis_messages +
                        "</ol>" +
                        "</div>" +
                        "</div>";
                }
                errorSwal("", null, htmlError, false, true);
            }
        });
    }
</script>
