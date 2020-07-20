jQuery(document).ready(function ($) {
    "use strict";

    //Contact
    $('form.contactForm').submit(function () {
        let f = $(this).find('.form-group'), $loadingMessage = $('#loading-message'),
            ferror = false, $form = $(this), actionRoute = $form.attr('action'),
            emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

        f.children('input').each(function () { // run all inputs
            let i = $(this), rule = i.attr('data-rule');

            if (rule !== undefined) {
                let ierror = false, pos = rule.indexOf(':', 0);
                if (pos >= 0) {
                    var exp = rule.substr(pos + 1, rule.length);
                    rule = rule.substr(0, pos);
                } else {
                    rule = rule.substr(pos + 1, rule.length);
                }

                switch (rule) {
                    case 'required':
                        if (i.val() === '') {
                            ferror = ierror = true;
                        }
                        break;
                    case 'minlen':
                        if (i.val().length < parseInt(exp)) {
                            ferror = ierror = true;
                        }
                        break;
                    case 'email':
                        if (!emailExp.test(i.val())) {
                            ferror = ierror = true;
                        }
                        break;
                    case 'checked':
                        if (!i.attr('checked')) {
                            ferror = ierror = true;
                        }
                        break;
                    case 'regexp':
                        exp = new RegExp(exp);
                        if (!exp.test(i.val())) {
                            ferror = ierror = true;
                        }
                        break;
                }
                i.next('.validation').html((ierror ? (i.attr('data-msg') !== undefined
                    ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
            }
        });
        f.children('textarea').each(function () { // run all inputs
            let i = $(this), rule = i.attr('data-rule');
            if (rule !== undefined) {
                let ierror = false, pos = rule.indexOf(':', 0);
                if (pos >= 0) {
                    var exp = rule.substr(pos + 1, rule.length);
                    rule = rule.substr(0, pos);
                } else {
                    rule = rule.substr(pos + 1, rule.length);
                }

                switch (rule) {
                    case 'required':
                        if (i.val() === '') {
                            ferror = ierror = true;
                        }
                        break;
                    case 'minlen':
                        if (i.val().length < parseInt(exp)) {
                            ferror = ierror = true;
                        }
                        break;
                }
                i.next('.validation').html((ierror ? (i.attr('data-msg') != undefined
                    ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
            }
        });
        if (ferror) return false;
        else var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: actionRoute,
            data: str,
            beforeSend: function () {
                $form.hide();
                $loadingMessage.show();
            },
            complete: function () {
                $form.show();
                $loadingMessage.attr('style', 'display: none !important');
            },
            success: function (response) {
                if (response.success) {
                    __toast.fire({
                        icon: 'success',
                        title: 'Mensagem enviada com sucesso!'
                    })
                    $form.trigger('reset');
                }
            },
            error: function (err) {
                __toast.fire({
                    icon: 'error',
                    title: err.responseJSON.message,
                });
            },
        });
        return false;
    });
});
