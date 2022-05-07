$(document).on("turbolinks:load", function() {
    //var $ = jQuery.noConflict();
    if (ajax_auth_object.logined == 0 && ajax_auth_object.recaptcha == 1) {
        var a = document.createElement("script");
        a.src = "//www.google.com/recaptcha/api.js?onload=onloadCallback&render=" + ajax_auth_object.sitekey;
        $("head").append(a);
    }

    jQuery(document).ready(function (a) {

        a("body").on("submit", "form#login", function (b) {

            let ctrl = a(this);
            let username = a("form#login #username").val();
            let password = a("form#login #password").val();
            let recaptcha = a("#g-recaptcha-response").val();
            let btn = ctrl.find('button[type=submit]');
            let btnText = btn.text();
            btn.prop("disabled", true);
            btn.text(ajax_auth_object.loadingmessage);

            a.ajax({
                type: "POST",
                dataType: "json",
                url: ajax_auth_object.login_url,
                data: {
                    email: username,
                    password: password,
                    recaptcha: recaptcha
                },
                success: function (b) {
                    if (b.status) {
                        if (b.redirect) {
                            window.location.href = b.redirect;
                        } else {
                            window.location.href = ajax_auth_object.redirecturl;
                        }

                        return false;
                    }

                    a("p.status", ctrl).text(b.message);
                    btn.prop("disabled", false);
                    btn.text(btnText);

                    /*if (ajax_auth_object.recaptcha == 1) {
                        load_recaptcha();
                    }*/
                }
            }).done(function(response) {
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            }).fail(function(response) {
                a("p.status", ctrl).text(response.responseJSON.message);
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            });

            b.preventDefault()
        });

        a("body").on("submit", "form#register", function (b) {

            let name = a('#signup_name').val();
            let password = a("#signup_password").val();
            let email = a("#signup_email").val();
            let recaptcha = a("#g-recaptcha-response").val();
            let ctrl = a(this);

            let btn = ctrl.find('button[type=submit]');
            let btnText = btn.text();
            btn.prop("disabled", true);
            btn.text(ajax_auth_object.loadingmessage);

            a.ajax({
                type: "POST",
                dataType: "json",
                url: ajax_auth_object.register_url,
                data: {
                    name: name,
                    email: email,
                    password: password,
                    recaptcha: recaptcha
                },
                success: function (b) {
                    if (b.status) {
                        if (b.redirect) {
                            window.location.href = b.redirect;
                        } else {
                            window.location.href = ajax_auth_object.redirecturl;
                        }
                        return false;
                    }

                    a("p.status", ctrl).text(b.message);
                    btn.prop("disabled", false);
                    btn.text(btnText);

                    /*if (ajax_auth_object.recaptcha == 1) {
                        load_recaptcha();
                    }*/

                    return false;
                }
            }).done(function(response) {
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            }).fail(function(response) {
                a("p.status", ctrl).text(response.responseJSON.message);
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            });

            b.preventDefault()
        });

        a("body").on("submit", "form#forgot_password", function (b) {
            let ctrl = a(this);
            let btn = ctrl.find('button[type=submit]');
            let btnText = btn.text();
            btn.prop("disabled", true);
            btn.text(ajax_auth_object.loadingmessage);

            a.ajax({
                type: "POST",
                dataType: "json",
                url: ajax_auth_object.forgot_password_url,
                data: {
                    email: a("#user_login").val(),
                    recaptcha: a("#g-recaptcha-response").val()
                },
                success: function (b) {
                    if (b.status) {
                        if (b.redirect) {
                            window.location.href = b.redirect;
                        } else {
                            window.location.href = ajax_auth_object.redirecturl;
                        }

                        return false;
                    }

                    a("p.status", ctrl).text(b.message);
                    btn.prop("disabled", false);
                    btn.text(btnText);

                    /*if (ajax_auth_object.recaptcha == 1) {
                        load_recaptcha();
                    }*/
                }
            }).done(function(response) {
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            }).fail(function(response) {
                a("p.status", ctrl).text(response.responseJSON.message);
                btn.prop("disabled", false);
                btn.text(btnText);
                return false;
            }), b.preventDefault(), !1
        });

    });

    $('#userInfo').on('click', function () {
        openLoginModal();
    });

    $('body').on('click', '#showRegisterFrom', function () {
        openRegisterModal();
    });

    $('body').on('click', '#showLoginFrom', function () {
        openLoginModal();
    });

    $('body').on('click', '#showForgotPasswordForm', function () {
        showForgotPasswordForm();
    });

    function showRegisterForm() {
        $(".loginBox").fadeOut("fast", function () {
            $(".registerBox").fadeIn("fast");
            $(".forgotPasswordBox").fadeOut("fast");
            $(".login-footer").fadeOut("fast", function () {
                $(".register-footer").fadeIn("fast")
            });

            $(".modal-title").html(ajax_auth_object.languages.register_with)
        });
        $(".error").removeClass("alert alert-danger").html("")
    }

    function showForgotPasswordForm() {
        $(".loginBox").fadeOut("fast", function () {
            $(".forgotPasswordBox").fadeIn("fast");
            $(".login-footer").fadeOut("fast", function () {
                $(".register-footer").fadeIn("fast")
            });
            $(".modal-title").html(ajax_auth_object.languages.forgotpassword)
        });
        $(".error").removeClass("alert alert-danger").html("")
    }

    function showLoginForm() {
        $("#loginModal .registerBox").fadeOut("fast", function () {
            $(".loginBox").fadeIn("fast");
            $(".forgotPasswordBox").fadeOut("fast");
            $(".register-footer").fadeOut("fast", function () {
                $(".login-footer").fadeIn("fast")
            });
            $(".modal-title").html(ajax_auth_object.languages.login_with)
        });
        $(".error").removeClass("alert alert-danger").html("")
    }

    function openLoginModal() {
        showLoginForm();

        var b = '<div class="modal fade login" id="loginModal">\n' +
            '    <div class="modal-dialog login animated">' +
            '   <input type="hidden" id="g-recaptcha-response" value="">\n' +
            '        <div class="modal-content">\n' +
            '            <div class="modal-header">\n' +
            '                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">\xD7</button>\n' +
            '                <h4 class="modal-title">' + ajax_auth_object.languages.login + '</h4></div>\n' +
            '            <div class="modal-body">\n' +
            '                <div class="content">\n' +
            '                    <!--<div class="social" id="ajax-social-login">\n' +
            '                        <a id="facebook_login" class="circle facebook" href="javascript:showNotice();">\n' +
            '                            <i class="hl-facebook"></i> </a>\n' +
            '                        <a id="google_login" class="circle google" href="javascript:showNotice();">\n' +
            '                            <i class="hl-gplus"></i> </a>\n' +
            '                        <a id="twitter_login" class="circle twitter" href="javascript:showNotice();">\n' +
            '                            <i class="hl-twitter"></i> </a></div>\n' +
            '                    <div class="division">\n' +
            '                        <div class="line l"></div>\n' +
            '                        <span>' + ajax_auth_object.languages.or + '</span>\n' +
            '                        <div class="line r"></div>\n' +
            '                    </div> -->\n' +
            '                    <div class="error"></div>\n' +
            '                    <div class="form loginBox">\n' +
            '                        <form id="login" method="post" accept-charset="UTF-8">' +
            '<p class="status color-red"></p>\n' +
            '                            <input id="username" class="form-control" type="text" placeholder="' + ajax_auth_object.languages.email + '" name="username">\n' +
            '                            <input id="password" class="form-control" type="password" placeholder="' + ajax_auth_object.languages.password + '" name="password">\n' +
            '                            <button class="btn btn-default btn-login" type="submit">' + ajax_auth_object.languages.login + '</button>\n' +
            '                        </form>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="content registerBox" style="display:none;">\n' +
            '                    <div class="form">\n' +
            '                        <form id="register" method="post" accept-charset="UTF-8">\n' +
            '                            <p class="status color-red"></p>\n' +
            '                            <input id="signup_name" class="form-control" type="text" placeholder="' + ajax_auth_object.languages.username + '" name="name" class="required">\n' +
            '                            <input id="signup_email" class="form-control" type="text" placeholder="' + ajax_auth_object.languages.email + '" name="email">\n' +
            '                            <input id="signup_password" class="form-control" type="password" placeholder="' + ajax_auth_object.languages.password + '" name="password">\n' +
            '<button class="btn btn-default btn-register" type="submit">' + ajax_auth_object.languages.create_account + '</button>\n' +
            '                        </form>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="content forgotPasswordBox" style="display:none;">\n' +
            '                    <div class="form">\n' +
            '                        <form id="forgot_password" method="post" accept-charset="UTF-8"><p class="status color-red"></p>\n' +
            '                            <input id="user_login" class="form-control" type="text" placeholder="' + ajax_auth_object.languages.username_email + '" class="required" name="user_login">\n' +
            '                            <button class="btn btn-default btn-forgot" type="submit">' + ajax_auth_object.languages.reset_password + '</button>\n' +
            '                        </form>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '            <div class="modal-footer">\n' +
            '                <div class="forgot login-footer">\n' +
            '                    ' + (ajax_auth_object.user_registration == 1 ? '<span><a id="showRegisterFrom" href="javascript:void(0);">' + ajax_auth_object.languages.register + ' </a></span>| \n' : '\n') +
            '<span><a id="showForgotPasswordForm" href="javascript:void(0);">' + ajax_auth_object.languages.forgotpassword + '</a>                </span>\n' +
            '                </div>\n' +
            '                <div class="forgot register-footer" style="display:none">\n' +
            '                    <span>' + ajax_auth_object.languages.already_account + '</span>\n' +
            '                    <a href="javascript:void(0);" id="showLoginFrom">' + ajax_auth_object.languages.login + '</a></div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>';

        $("body").append(b);
        load_recaptcha();

        setTimeout(function () {
            $("#loginModal").modal("show");
            $("#loginModal").on("hidden.bs.modal", function () {
                $(this).remove()
            });
        }, 200)
    }

    function load_recaptcha() {
        if (ajax_auth_object.recaptcha == 1) {
            grecaptcha.ready(function () {
                grecaptcha.execute(ajax_auth_object.sitekey, {action: 'submit'}).then(function (token) {
                    $('#g-recaptcha-response').val(token);
                });
            });
        }
    }

    function openRegisterModal() {
        showRegisterForm(), setTimeout(function () {
            $("#loginModal").modal("show")
        }, 200)
    }

    function showNotice() {
        alert("Comming soon...")
    }
});