$('#show_more_button').unbind();
var searchFilters = {};

$(function(){
    $('#page-preloader').css('height',$('#main').height());
    // ID redirection for reviews is happening through URL hash, collides with searchfilter init, adding gard
    if(window.location.hash && window.location.hash !== "#reviews"){
        window.location = basePath + '/search?' + window.location.hash.substring(1,window.location.hash.length);
    }
    else{
        searchFilters.hideLoaders();
        searchFilters.initSearch();
    }
});

var show_more_button = $('#show_more_button');

searchFilters.hideLoaders = function() {
    $('.preloader').animate({opacity: 0}, 200, function() {
        $('.preloader').hide();
    });
}

searchFilters.initSearch = function (){
    $('[data-size-value]').click(function(element){
        $('#search_squareFoot').val($(this).attr('data-size-value'));
    })
    $('#select_order, [name="type"]').change(function(element){
        $('#search_sort').val($('#select_order').val());
        $('#search_form').submit();
    })
    $( "#search_form" ).submit(function( event ) {
        $('#search_page').val(1);
        $('#search_sort').val($('#search_sort').val());
    });
    $( "#show_more_button" ).click(function(event) {
        var me = $(this);
        event.preventDefault();
        if ( me.data('requestRunning') ) {
            return;
        }

        $('#search_source').val('ajax');
        $('#search_page').val(($('#search_page').val()*1)+1);
        var data = $("#search_form").serialize();
        $.ajax(this.href, {
            url: basePath + '/search',
            data: data,
            dataType:'json',
            type: 'POST',
            async : true,
            beforeSend: function (){
                $('#show_more_button').attr('disabled', true);
            },
            success: function(data) {
                $('#listings').html($('#listings').html()+data.html);
                $('#search_source').val('');
                show_more_button.attr('disabled', false);
                show_more_button.text("Show More");

                searchFilters.resetGoogle(JSON.parse(data.json));
            },
            error: function(e) {
                show_more_button.attr('disabled', true);
                show_more_button.text("There are no more facilities in the area");
                $('#search_page').val(($('#search_page').val()*1)-1);
                show_more_button.show();
            }
        });
    });
}

searchFilters.resetGoogle = function (data){
    listings = listings.concat(data);
    $('script[src$="/js/googlemaps.js"]').remove();
    $.getScript("/js/googlemaps.js", function() {
        $('script:last').attr('id', 'googlemapsjs');
    });
}

$(document).ready(function () {
    jQuery('main').find('[data-toggle="popover"]').popover();
});