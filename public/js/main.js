$(document).ready(function() {
    $('button.autopostSubmit').button().click(function(e) {
        e.preventDefault();
        if (form = $(this).parents('.autopost')) {
            processForm(form);
        }
    });

    $('#tabs').tabs();
    $('input.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        yearRange: "1900:2014"
    });
    fitPortalToScreen();

    $('div.slider').each(function() {
        var minI = parseInt($(this).attr('data-min'));
        var maxI = parseInt($(this).attr('data-max'));
        $(this).slider({
            min: minI,
            max: maxI,
            stop: function() {
                $($(this).attr('data-target')).val($(this).slider('value'));
            }
        });
    });
});

function fitPortalToScreen() {
    i = 0;
    $('div.portalColumn').each(function() {
        i++;
    })
    $('div.portalColumn').width($(document).width() / i);
    $('div.portalColumn').each(function() {
        $(this).height($(document).height() - $('#navbar').height() - 1);
    });
}

function processForm(form) {
    var error = false;
    var formData = new Array();
    var actionPage = String($(form).attr('action'));
    $(form).find('input').each(function() {
        formData.push(new Array($(this).attr('name'), $(this).val()));
        if ($(this).hasClass("required") && $(this).val() == "") {
            $(this).addClass("ui-state-error");
            $('div#' + $(form).attr("name") + '-result').html("Niet alle verplichte velden zijn ingevuld!");
            $('div#' + $(form).attr("name") + '-result').addClass('ui-state-highlight');
            error = true;
        } else if ($(this).hasClass("ui-state-error") && $(this).val() != "") {
            $(this).removeClass("ui-state-error");
        }
    });
    $(form).find('select').each(function() {
        formData.push(new Array($(this).attr('name'), $(this).val()));
        if ($(this).hasClass("required") && $(this).children('select option:selected').val() == "") {
            $(this).addClass("ui-state-error");
            $('div#' + $(form).attr("name") + '-result').html("Niet alle verplichte velden zijn ingevuld!");
            $('div#' + $(form).attr("name") + '-result').addClass('ui-state-highlight');
            error = true;
        } else if ($(this).hasClass("ui-state-error") && $(this).val() != "") {
            $(this).removeClass("ui-state-error");
        }
    });
    if (error) {
        return;
    }
    $.ajax({
        type: "POST",
        url: actionPage,
        data: {form: formData},
        success: function(data) {
            switch (data.split('-')[0]) {
                case 'error':
                    $('div#' + $(form).attr("name") + '-result').addClass('ui-state-error');
                    $('div#' + $(form).attr("name") + '-result').html(data.split('-')[1]);
                    break;
                case 'info':
                    $('div#' + $(form).attr("name") + '-result').addClass('ui-state-highlight');
                    $('div#' + $(form).attr("name") + '-result').html(data.split('-')[1]);
                    break;
                case 'relocate':
                    window.location = data.split('-')[1];
                    break;
                case 'alert':
                    alert(data.split('-')[1]);
                    break;
                case 'reload':
                    location.reload();
                    break;
            }
        }
    });
}