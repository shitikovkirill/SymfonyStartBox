function includeJs(jsFilePath) {
    var js = document.createElement('script');
    js.type = 'text/javascript';
    js.src = jsFilePath;
    document.getElementsByTagName('head')[0].appendChild(js);
}

if (!window.jQuery) {
    includeJs('//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
}
window.onload = function () {
    console.log('b24go');
    jQuery('form').submit(function (event) {

        console.log('submit');

        var thisForm = jQuery(this);
        var errorStatus = 0;
        var ignoreStatus = 0;

        var jsName = '';
        var jsPhone = 'tel';
        var jsEmail = '';
        var jsCity = '';
        var jsYandex1 = '';
        var jsYandex2 = '';
        var jsGoogle1 = '';
        var jsGoogle2 = '';
        var jsGoogle3 = '';
        var jsIgnore1 = ''.split(',');
        var jsIgnore2 = ''.split(',');

        jsName = jsName.trim();
        jsPhone = jsPhone.trim();
        jsEmail = jsEmail.trim();
        jsCity = jsCity.trim();

        if (!thisForm.hasClass('modaration-b24go')) {

            if (jsIgnore1['0'] != '') {
                jQuery.each(jsIgnore1, function (indexIgn1, valueIgn1) {
                    if (thisForm.attr('id') && (valueIgn1.trim() != '')) {
                        if (thisForm.attr('id') == valueIgn1.trim()) {
                            ignoreStatus = 1;
                        }
                    }
                });
            }
            if (jsIgnore2['0'] != '') {
                jQuery.each(jsIgnore2, function (indexIgn2, valueIgn2) {
                    if (valueIgn2.trim() != '') {
                        if (thisForm.hasClass(valueIgn2.trim())) {
                            ignoreStatus = 1;
                        }
                    }
                });
            }

            if ((jsIgnore1['0'] == '') && (jsIgnore2['0'] == '')) {
                ignoreStatus = 1;
            }

            if (((jsPhone != '') || (jsEmail != '')) && (ignoreStatus == 1)) {

                if ((jsPhone != '') && (thisForm.find('[name="' + jsPhone + '"]').val().length == 0)) {
                    thisForm.find('[name="' + jsPhone + '"]').css('border-color', '#e74c3c');
                    errorStatus = 1;
                }

                if ((jsEmail != '') && (thisForm.find('[name="' + jsEmail + '"]').val().length == 0)) {
                    thisForm.find('[name="' + jsEmail + '"]').css('border-color', '#e74c3c');
                    errorStatus = 1;
                }

                if (errorStatus == 1) {
                    return false;
                }

                thisForm.addClass('modaration-b24go');

                var msg = '';

                if (jsName != '') {
                    if (thisForm.find('[name="' + jsName + '"]').val()) {
                        msg += '' + jsName + '=' + thisForm.find('[name="' + jsName + '"]').val();
                    }

                }

                if (jsPhone != '') {
                    if (thisForm.find('[name="' + jsPhone + '"]').val()) {
                        if (msg != '') {
                            msg += '&'
                        }
                        msg += '' + jsPhone + '=' + thisForm.find('[name="' + jsPhone + '"]').val();
                    }
                }

                if (jsEmail != '') {
                    if (thisForm.find('[name="' + jsEmail + '"]').val()) {
                        if (msg != '') {
                            msg += '&'
                        }
                        msg += '' + jsEmail + '=' + thisForm.find('[name="' + jsEmail + '"]').val();
                    }
                }

                if (jsCity != '') {
                    if (thisForm.find('[name="' + jsCity + '"]').val()) {
                        if (msg != '') {
                            msg += '&'
                        }
                        msg += '' + jsCity + '=' + thisForm.find('[name="' + jsCity + '"]').val();
                    }
                }

                jQuery.ajax({
                    type: 'POST',
                    url: 'https://b24go.com/form/v1/clining.bitrix24.ru/save',
                    data: msg,
                    success: function (data) {
                        console.log(jQuery.parseJSON(data)['ERROR']);
                        if (jQuery.parseJSON(data)['ERROR'] == '') {
                            thisForm.find('button[type=submit]').attr('disabled', true).val('Отправлено');
                            thisForm.find('input[type=submit]').attr('disabled', true).val('Отправлено');

                            if (jsYandex1 && jsYandex2) {
                                yaCounter.reachGoal('');
                            }
                            if (jsGoogle1 && jsGoogle2) {
                                if (jsGoogle3) {
                                    ga('send', 'event', jsGoogle1, jsGoogle2, jsGoogle3);
                                } else {
                                    ga('send', 'event', jsGoogle1, jsGoogle2);
                                }
                            }
                        } else {
                            thisForm.submit();
                        }
                    },
                    error: function (xhr, str) {
                        console.log(str);
                    }
                });

                if (thisForm.hasClass('refresh-b24go')) {
                    thisForm.submit();
                }

                event.preventDefault();

            } else {

                thisForm.addClass('modaration-b24go');
                thisForm.submit();

            }

        }

    });
}
						