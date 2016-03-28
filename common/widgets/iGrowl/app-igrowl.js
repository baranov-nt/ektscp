/**
 * Created by User on 12.01.2016.
 */
function timeIsUp() {
    $.iGrowl({
        type: 'error',
        title: 'Время заявки истекло.',
        icon: 'linecons-fire',
        placement : {
            x: 	'center',
            y: 	'bottom'
        }
    });
}

function errorAcceptDeal() {
    $.iGrowl({
        type: 'error',
        title: 'Заявка не принята.',
        icon: 'linecons-fire',
        placement : {
            x: 	'center',
            y: 	'bottom'
        }
    });
}

function acceptDeal() {
    $.iGrowl({
        message: 'Вы успешно согласовали заявку. Ожидайте звонка исполнителя.',
        icon: 'vicons-support',
        placement : {
            x: 	'center',
            y: 	'bottom'
        }
    });
}

function successSms() {
    $.iGrowl({
        type: 'success',
        message: 'Смс успешно отправленно!',
        icon: 'vicons-cart',
        placement : {
            x: 	'center'
        },
        animShow: 'fadeInLeftBig',
        animHide: 'fadeOutDown'
    });
    var element = $("#smsKey");
    element.css("display", "block");
}

function errorSms() {
    var message = $( "#regform-error" ).val();
    $.iGrowl({
        type: 'error',
        title: message,
        icon: 'linecons-fire',
        placement : {
            x: 	'center',
            y: 	'top'
        }
    });
}

function startTimer() {
    alert(111);
    /*$.pjax({
        type: "POST",
        url: "update-sms",
        data: jQuery("#form").serialize(),
        container: "#w0",
        push: false
    })*/
}