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
    $(window).resize(function() {
        fitPortalToScreen();
    });

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

    $('div.progressbar').each(function() {
        $(this).progressbar({
            value: parseInt($(this).attr("data-value")),
            max: parseInt($(this).attr("data-max"))
        });
        $(this).find("div.ui-progressbar-value").css({
            "background-color": $(this).attr("data-color")
        });
    });

    $('.multi-select').each(function() {
        $(this).multiSelect({
            selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Zoeken...'>",
            selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Zoeken...'>",
            afterInit: function(ms) {
                var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
            },
            afterSelect: function() {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function() {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    });
});

function fitPortalToScreen() {
    i = 0;
    $('div.portalColumn').each(function() {
        i++;
    });
    $('div.portalColumn').height($(window).height() - $('#navbar').height() - 1);
    $('div.portalColumn').width($(window).width() / i);
}

function processForm(form) {
    var error = false;
    var formData = new Array();
    var actionPage = String($(form).attr('action'));
    $(form).find('input[name]').each(function() {
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
    $(form).find('textarea[name]').each(function() {
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