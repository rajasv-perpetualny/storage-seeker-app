var review = typeof(review) !== 'undefined' ? review : {};

review.saveReview = function() {
    var title = $("#review_title").val();
    var rating = $("input[name=rating]").val();
    var nickname = $("#review_nickname").val();
    var message = $("#review_message").val();
    var email = $("#review_email").val();

    $.ajax({
        type: "POST",
        url: $('#send-review-form').attr('action'),
        data: {
            title: title,
            rating: rating,
            nickname: nickname,
            message: message,
            email: email,
            _token: $('input[name=_token]').val()
        },
        success: function(answer){
            if (answer.responseCode == -1) {
                $('#review-form .modal-body').html('<input id="review-submit" type="submit" value="Submit Review" class="btn btn-success">');
            } else if (answer.message.match(/^\s*Vserify/)) {
                $('#review-form-title').html('Thanks for giving your feedback!');
                $('#review-form .modal-body').html('<span id="review-success">Thanks for giving your feedback! Please check your email to verify that your review has been submitted.</span><div class="form-group"><br/><button type="submit" id="message-modal-ok" data-dismiss="modal" class="btn-default btn">Ok</button></div>');
            } else {
                $('#review-form-title').html('Thanks for giving your feedback!');
                $('#review-form .modal-body').html('<span id="review-success">' + answer.message + '</span><div class="form-group"><br/><button type="submit" id="message-modal-ok" data-dismiss="modal" class="btn-default btn">Ok</button></div>');
            }
        },
        error: function (xhr, ajaxOptions, thrownError){
            $('#review-form .modal-body').html('There was an error posting this review.');
        },
        complete: function(){
            $("div#review-submit").replaceWith('<input id="review-submit" type="submit" value="Submit Review" class="btn btn-primary btn-large">');
        }
    });
}

review.validateReview = (fields) => {
    return fields.reduce((errors, item) => {
        if ('undefined' == typeof item.attr('value') || item.attr('value') == "") {
            item.css('color', 'red');
            errors++;
        }
    }, 0);
}

review.initBackToTop = () => {
        let button = $('#back-to-top');
        let w = $(window);

        button.click((e) => {
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, 'slow');
        });

        w.scroll(() => {
            if (w.scrollTop() == 0) {
                button.slideUp('slow', 'easeOutBounce');
            } else {
                button.slideDown('slow', 'easeOutBounce');
            }
        });
}


$(document).ready(function () {
    review.initBackToTop();
    $("#send-review-form").submit(function(e){
        e.preventDefault();
        review.saveReview();
        return false;
    });
});

function showMessageModal(title,body,hidefooter){
    if ($('#message-modal').length == 0) {
        $('body').append('<div id="message-modal" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">&#215;</button><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"><a href="#" id="message-modal-ok" data-dismiss="modal" class="btn btn-primary">OK</a></div></div></div></div>');
    }

    $modal = $('#message-modal');

    if(hidefooter) {
        $modal.find('.modal-footer').hide();
    } else {
        $modal.find('.modal-footer').show();
    }
    $modal.find('.modal-header h4').text(title);
    $modal.find('.modal-body').html(body);
    $modal.modal();
}

$('#facility-page .js-show-tab, #page-facility .js-show-tab').click(function(event){
    event.preventDefault();
    var target = $(this).attr('href');
    var scrollTargetEl = $('#tabs');
    var scrollTargetElOffset = scrollTargetEl.offset().top - 50;

    // scroll to tabs
    $('html,body').animate({
        scrollTop: scrollTargetElOffset
    }, 1000);

    $('#facility-page .nav-tabs a[href="'+target+'"], #page-facility .nav-tabs a[href="'+target+'"]').click();
});
$('#facility-page .js-show-review-form').click(function(event){
    event.preventDefault();
    $('#facility-page .nav-tabs a[href="#reviews"]').click();
    var tmp_pos = $('#facility-page #review-form').offset().top - 30;
    $('html,body').animate({
        scrollTop: tmp_pos
    }, 'fast');
});

$('#unit-page .js-show-tab').click(function(event){
    event.preventDefault();
    var target = $(this).attr('href');
    $('#unit-page a[href="'+target+'"]').tab('show');
    var tmp_pos = $(target).offset().top - 60;
    $('html,body').animate({
        scrollTop: tmp_pos
    }, 'fast');
});
$('#unit-page .js-show-review-form').click(function(event){
    event.preventDefault();
    $('#unit-page a[href="#reviews"]').tab('show');
    var tmp_pos = $('#unit-page #review-form').offset().top - 30;
    $('html,body').animate({
        scrollTop: tmp_pos
    }, 'fast');
});

$('#unit-page .js-show-review-form').click(function(event){
    $('#facility-page .nav-tabs a[href="#map"]').click();
    var tmp_pos = $('#facility-page #review-form').offset().top - 30;
    $('html,body').animate({
        scrollTop: tmp_pos
    }, 'fast');

});

$(document).ready(function () {
    try {
        var $reviews_slideshow = $('#facility-page #reviews-slideshow');
        if (  $('#facility-page #reviews-slideshow').find('.review-block').length > 1 )
            $('#facility-page #reviews-slideshow').cycle({
                fx:         'scrollHorz',
                timeout:    0,
                prev:       '#prev',
                next:       '#next',
                speed:      'fast'
            });
    }
    catch (err){}
});



/**
 * Reviews
 */


function loadReviews(){
    $('.pagination a').on('click', function(e) {
        e.preventDefault();
        $('#loadReviews a').css('color', '#dfecf6');
        var me = $(this);

        if(me.data('processing')==undefined){
            me.data('processing', false);
        }
        else if(me.data('processing')){
            return;
        }

        var params = $(this).attr('href').split('/');
        params = params[params.length-1].split('?page=');
        $.ajax({
            url : basePath+'/reviews',
            data: {
                'facilityId':params[0],
                'page': params[1]
            },
            type: 'POST',
            async : true,
            beforeSend: function(){
                me.data('processing', true);
            },
            success: function (data) {
                $('#loadReviews').html(data);
                $('#loadReviews a').off();
                loadReviews();
            }
        });
    });
}

$(document).ready(function () {
    loadReviews();
});