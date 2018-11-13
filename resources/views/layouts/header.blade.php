<!doctype html>
<html lang="en">
<!--Contact Me
  Name: Tô Nguyên
  Facebook:https://www.facebook.com/tbn198
  Phone:01659444980
  Group: S-Developers.com
  -->
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png') }}"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.png') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>MC Shiper</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Core -->
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <!-- Favicon -->
    <link href="{{ asset('assets/img/brand/favicon.png" rel="icon" type="image/png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('assets/css/argon.css?v=1.0.0') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

</head>
<body>
@include('layouts.sidebar')
<div class="main-content">
    <!-- Top navbar -->
@include('layouts.navbar')
<!-- Header -->

    <!-- Page content -->
@yield('content')
<!-- Footer -->

    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2018 <a href="" class="font-weight-bold ml-1" target="_blank">S-Developers</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="#" class="nav-link" target="_blank">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://mobilecity.vn/" class="nav-link" target="_blank">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" target="_blank">MIT License</a>
                    </li>
                </ul>
            </div>
        </div>

    </footer>

</div>
<div class="beep" style="display: none;"></div>
</body>
<script>
    @if(Session::has('message'))
    $(document).ready(function () {
        $.notify({
            icon: "notifications",
            message: "{{ Session::get('message') }}"
        });
        var filename = 'audio/ring';
        $(".beep").html('<audio autoplay="autoplay"><source src="' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename + '.mp3" /></audio>');
    });
    @endif
</script>
<script type="text/javascript">
    function checkForm(form) {
        form.myButton.disabled = true;
        form.myButton.value = "Đợi tí";
        return true;
    }
</script>
<script type="text/javascript">
    $(function () {
        $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('Y/MM/DD H:mm:s') + ' - ' + picker.endDate.format('Y/MM/DD H:mm:s'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    });
</script>
<!--numbertext -->
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $demoValue = $('#getvalue'),
            $demoResult = $('#setresult');
        $demoValue.bind('keydown keyup keypress focus blur paste change', function () {
            var result = accounting.formatMoney(
                $demoValue.val(),
                'đ ',
                0
            );
            $demoResult.text(result);
        });
    });
</script>
<!-- Argon Scripts -->

<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- Argon JS -->
<script src="{{ asset('assets/js/argon.js?v=1.0.0') }}"></script>
<script src="{{ asset('js/accounting.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
<script type="text/javascript" src="{{ asset('source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('source/jquery.fancybox.css?v=2.1.5') }}" media="screen"/>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({
            type: 'iframe',
            'width': 1300,
            afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                parent.location.reload(true);
                $.notify({icon: "notifications", message: 'Change value'});
            }
        });
    });

</script>
<script type="text/javascript">
    $(function () {
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'Y/MM/DD H:mm:s',
                cancelLabel: 'Clear'
            }
        });
        $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('Y/MM/DD H:mm:s') + ' - ' + picker.endDate.format('Y/MM/DD H:mm:s'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    });
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#reg_form').bootstrapValidator({
            fields: {
                ho_ten: {
                    validators: {
                        stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Vui lòng cung cấp tên khách hàng.'
                        }
                    }
                },
                so_dt: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng cung cấp số điện thoại.'
                        }
                    }
                },
                dia_chi: {
                    validators: {
                        stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Vui lòng cung cấp địa chỉ đường phố của khách hàng'
                        }
                    }
                },
                ten_may: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng cung cấp tên thiết bị của khách hàng'
                        }
                    }
                },
                so_tien: {
                    validators: {
                        integer: {
                            message: 'Số tiền phải bằng số và trên trên 1.000.000 đ'
                        },
                        stringLength: {
                            min: 7,
                        },
                        notEmpty: {
                            message: 'Vui lòng cung cấp số tiền'
                        }
                    }
                },
                ma_the: {
                    validators: {
                        stringLength: {
                            min: 5,
                            message: 'Sai mã thẻ'
                        },
                        notEmpty: {
                            message: 'Vui lòng cung cấp mã thẻ điện thoại'
                        }
                    }
                },
                ma_seri: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng cung cấp seri mã thẻ'
                        }
                    }
                },
                phukien: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng cung cấp phụ kiện kèm theo sản phẩm'
                        }
                    }
                },
                ghi_chu: {
                    validators: {
                        notEmpty: {
                            message: 'Vui lòng cung cấp ghi chú '
                        }
                    }
                },
            }
        })


            .on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow") // Do something ...
                $('#reg_form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    console.log(result);
                }, 'json');
            });
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122322089-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-122322089-1');
</script>

</html>