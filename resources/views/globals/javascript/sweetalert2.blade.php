<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('adminlte/plugins/promise-polyfill/polyfill.min.js') }}"></script>

<script>

    !function ($) {
        "use strict";
        var SweetAlert = function () { };
        SweetAlert.prototype.init = function () {

            //Success Message
            @if(session('success'))
            Swal.fire({
                title :"Parabéns",
                text :"{{ session('success') }}",
                icon :"success",
                timer: 2000,
                showConfirmButton: false,
            });
            @endif
            //Error Message
            @if(session('error') && !session('errors'))
            alert({{session('errors')}});
            Swal.fire({
                title :"Ops!",
                text :"{{ session('error') }}",
                icon :"error",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Error Message
            @if(session('error') && session('errors'))
            alert({{session('errors')}});
            Swal.fire({
                title :"Ops!",
                text :"{{ session('error') }}",
                icon :"error",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Errors Message
            @if(session('errors') && !session('error'))
            alert({{session('errors')}});
            Swal.fire({
                title :"Ops!",
                text :"Erro ao executar a ação!",
                icon :"error",
                timer: 2000,
                showConfirmButton: false
            });

            @endif
            //Warning Message
            @if(session('warning'))
            Swal.fire({
                title :"Alerta!",
                text :"{{ session('warning') }}",
                icon :"warning",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        },
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
    }(window.jQuery),
        function ($) {
            "use strict";
            $.SweetAlert.init()
        }(window.jQuery);
</script>

<script>

    function deleteGlobal(element) {
        var elementHTML = $(element);
        var url = elementHTML.attr("route-delete");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'mr-2 btn btn-danger'
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons.fire({
            title: 'Exclusão de item?',
            text: "Deseja mesmo excluir esse item?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, quero excluir!',
            cancelButtonText: 'Não, cancelar',
            reverseButtons: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                $.ajax(url, {
                    method : "GET",
                    success: function(response) {
                        if(response.code != '301')
                        {
                            swalWithBootstrapButtons.fire(
                                'Deletado!' ,
                                'Você deletou este item.' ,
                                'success'
                            );
                            setTimeout( function() {
                                location.reload();
                            } , 1000 );
                        }
                        else
                        {
                            Swal.fire( "Sistema" , "Não Autorizado" , "error" );
                        }
                    },
                    error:function(error) {
                        if(error.responseJSON.message)
                        {
                            Swal.fire("Sistema", error.responseJSON.message, "error");
                        }
                        else
                        {
                            Swal.fire("Sistema", "Não foi possível deletar este item", "error");
                        }
                    }
                });
            } else
            {
                if(
                    result.dismiss === Swal.DismissReason.cancel
                )
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado' ,
                        'você cancelou a exclusão :)' ,
                        'error'
                    );
                    /*setTimeout( function() {
                        location.reload();
                    } , 1000 );*/
                }
            }
        })
    }

    function resetAutoPasswordToDocumentNumber(element) {
        var elementHTML = $(element);
        var url = elementHTML.attr("route-reset-password-auto");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'mr-2 btn btn-danger'
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons.fire({
            title: 'Resetar senha?',
            text: "Deseja mesmo restar a senha desse usuário?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, quero resetar!',
            cancelButtonText: 'Não, cancelar',
            reverseButtons: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                $.ajax(url, {
                    method : "GET",
                    success: function(response) {

                        console.log(response);
                        if(response.code != '301')
                        {
                            swalWithBootstrapButtons.fire(
                                'Resetado!' ,
                                'Você resetou esta senha.' ,
                                'success'
                            );
                            setTimeout( function() {
                                location.reload();
                            } , 1000 );
                        }
                        else
                        {
                            Swal.fire( "Sistema" , "Não Autorizado" , "error" );
                        }
                    },
                    error:function(error) {
                        if(error.responseJSON.message)
                        {
                            Swal.fire("Sistema", error.responseJSON.message, "error");
                        }
                        else
                        {
                            Swal.fire("Sistema", "Não foi possível resetar a senha", "error");
                        }
                    }
                });
            } else
            {
                if(
                    result.dismiss === Swal.DismissReason.cancel
                )
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado' ,
                        'você cancelou a exclusão :)' ,
                        'error'
                    );
                    /*setTimeout( function() {
                        location.reload();
                    } , 1000 );*/
                }
            }
        })
    }

    function loadingSwal(title, message) {
        let timerInterval;
        Swal.fire({
            title: title,
            html: message,
            timer: false,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                }, 100)
            },
            onClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.timer
            ) {
                console.log('I was closed by the timer')
            }
        });
    }
    function successSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            icon  : "success",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }
    function errorSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            icon  : "error",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }
    function infoSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            icon  : "info",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }

    async function questionSwal(functionCallback, title, placeholder, groupSelect) {
        const {value: object} = await Swal.fire({
            title: title,
            input: 'select',
            inputOptions: groupSelect,
            inputPlaceholder: placeholder,
            showCancelButton: true,
            confirmButtonText : "Escolhe",
            cancelButtonText : "Cancelar",
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === '') {
                        resolve('Por favor selecione uma opção :)');
                    } else {
                        resolve();
                    }
                })
            }
        })
        if (object) {
            window[functionCallback](object);
        }
    }

</script>
