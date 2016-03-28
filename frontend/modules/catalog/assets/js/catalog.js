function showNewField(id, id2) {
    $(id).css('display','block');
    $(id2).css('display','none');
}
function hideField(id, id2, clearInput) {
    $(id).css('display','none');
    $(id2).css('display','block');
    $(clearInput).val('');
}
function showNewProductField() {
    var display = $("#product_2_field").attr("style");
    if(display == 'display: none;') {
        $("#product_2_field").css('display','block');
    } else {
        var display = $("#product_3_field").attr("style");
        if(display == 'display: none;') {
            $("#product_3_field").css('display', 'block');
        } else {
            var display = $("#product_4_field").attr("style");
            if(display == 'display: none;') {
                $("#product_4_field").css('display', 'block');
            } else {
                var display = $("#product_5_field").attr("style");
                if(display == 'display: none;') {
                    $("#product_5_field").css('display', 'block');
                } else {
                    var display = $("#product_6_field").attr("style");
                    if(display == 'display: none;') {
                        $("#product_6_field").css('display', 'block');
                    } else {
                        var display = $("#product_7_field").attr("style");
                        if(display == 'display: none;') {
                            $("#product_7_field").css('display', 'block');
                            $("#product-plus-circle-btn").css('display', 'none');
                        }
                    }
                }
            }
        }
    }
}
function hideProductField(id, id2) {
    $(id).css('display',' none');
    $(id2).css('display',' block');
}
function showNewServiceField() {
    var display = $("#service_2_field").attr("style");
    if(display == 'display: none;') {
        $("#service_2_field").css('display','block');
    } else {
        var display = $("#service_3_field").attr("style");
        if(display == 'display: none;') {
            $("#service_3_field").css('display', 'block');
        } else {
            var display = $("#service_4_field").attr("style");
            if(display == 'display: none;') {
                $("#service_4_field").css('display', 'block');
            } else {
                var display = $("#service_5_field").attr("style");
                if(display == 'display: none;') {
                    $("#service_5_field").css('display', 'block');
                } else {
                    var display = $("#service_6_field").attr("style");
                    if(display == 'display: none;') {
                        $("#service_6_field").css('display', 'block');
                    } else {
                        var display = $("#service_7_field").attr("style");
                        if(display == 'display: none;') {
                            $("#service_7_field").css('display', 'block');
                            $("#service-plus-circle-btn").css('display', 'none');
                        }
                    }
                }
            }
        }
    }
}
function hideServiceField(id, id2) {
    $(id).css('display',' none');
    $(id2).css('display',' block');
}
function showNewSaleField() {
    var display = $("#sale_2_field").attr("style");
    if(display == 'display: none;') {
        $("#sale_2_field").css('display','block');
    } else {
        var display = $("#sale_3_field").attr("style");
        if(display == 'display: none;') {
            $("#sale_3_field").css('display', 'block');
            $("#sale-plus-circle-btn").css('display', 'none');
        } else {
            var display = $("#sale_4_field").attr("style");
            if(display == 'display: none;') {
                $("#sale_4_field").css('display', 'block');
            } else {
                var display = $("#sale_5_field").attr("style");
                if(display == 'display: none;') {
                    $("#sale_5_field").css('display', 'block');
                } else {
                    var display = $("#sale_6_field").attr("style");
                    if(display == 'display: none;') {
                        $("#sale_6_field").css('display', 'block');
                    } else {
                        var display = $("#sale_7_field").attr("style");
                        if(display == 'display: none;') {
                            $("#sale_7_field").css('display', 'block');
                            $("#sale-plus-circle-btn").css('display', 'none');
                        }
                    }
                }
            }
        }
    }
}
function hideSaleField(id, id2) {
    $(id).css('display',' none');
    $(id2).css('display',' block');
}
function radioWorkModeClick(workmode) {
    if(workmode.value == 1) {
        $("#daysOfWeek-block").css('display', 'block');
    } else {
        $("#daysOfWeek-block").css('display', 'none');
    }
}

function checkboxTimeoutClick() {
    if($("#checkbox-timeout").is(':checked')) {
        $("#catalog-timiout-block").css('display','block');
    } else {
        $("#catalog-timiout-block").css('display','none');
    }
}

$(document).ready(function() {
    makeCardsColumns();
    $(window).resize(makeCardsColumns);
});

function makeCardsColumns() {
    var cols = 3;
    switch($(".cards-inner").width()) {
        case 940:
            cols = 3;
            break;
        case 620:
            cols = 2;
            break;
        default:
            cols = 1;
            break;
    }
    var i = 0;
    var cards = $(".catalog-card");
    cards.sort(function (a, b) {
        var contentA = parseInt( $(a).attr('data-sort')) || 0;
        var contentB = parseInt( $(b).attr('data-sort')) || 0;
        if (contentA == 0) contentA = 999999;
        if (contentB == 0) contentB = 999999;
        return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
    });
    var j = 1;
    for(i = 0; i < cards.length; i++) {
        $(".cards-col.ccol-"+j).append($(cards[i]));
        $(cards[i]).attr('data-sort', i+1);
        j++;
        if(j > cols) j = 1;
    }
}