// @codekit-prepend "vendor/jquery-2.2.2.js"
// @codekit-append "vendor/jquery.slides.js"


$(document).ready(function () {

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        $('body').addClass("mobile");

    }


    var service = getUrlParameter('service');
    var category = getUrlParameter('category');

    if (service) {


        $("#services article.service#service-" + service).each(function () {

            console.log(service);

            $(this).addClass("current");

            moveToAnchor('service-' + service);

        });

    } else if (category) {

        moveToAnchor('services');

    }

    $('body.page-template-page-team .team .member.has-bio .image').click(function () {

        parent = $(this).parent().parent();

        var visible = false;

        if($('.bio', parent).hasClass('show')) {
            visible = true;
        }

        $('body.page-template-page-team .team .member .bio').removeClass('show');

        if(!visible) {
            $('.bio', parent).addClass('show');
        }



    });

    $('body.page-template-page-team .team .member .close').click(function () {

        parent = $(this).parent();

        $('body.page-template-page-team .team .member .bio').removeClass('show');

    });

    $('#services article.service').click(function () {

        $('#services article.service').removeClass('current');
        $(this).addClass('current');

        var id = $(this).attr('id');

        id = id.replace('service-', '');


        updateQueryStringParam('service', id);

    });

    $("a[href^='#switch_player']").click(function (e) {
        e.preventDefault();

        $('div.video, div.audio').toggleClass('hide');
        $(this).toggleClass('audio');
    });

    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();

        var target = this.hash;
        target = target.replace('#', '');

        $("#services article.service").removeClass('current');
        $("#services article.service#" + target).addClass('current');

        scrollToAnchor(target);

    });


    $('#burger').click(function () {

        $('body > header > .local').toggleClass('open_nav');
    });

    $('#global-tab, #close-global-nav').click(function (e) {
        e.preventDefault();

        $('body > header > .global').toggleClass('open');
    });

    $('#open_lang').click(function (e) {
        e.preventDefault();

        $('body > header > .local #language').toggleClass('open');
    });

    $("iframe.video, iframe.audio").each(function () {


        var iframe = $(this);

        var iframe_width = $(this).width();
        var iframe_height = $(this).height();

        $(this).attr("width", "100%");
        $(this).attr("height", "100%");


        console.log(iframe);
        console.log("width: " + iframe_width);
        console.log("height: " + iframe_height);

        var ratio = 100 * ( parseInt(iframe_height) / parseInt(iframe_width) );


        var container = ' <section class="player" style="max-width: ' + iframe_width + 'px" data-width="' + iframe_width + '"><div class="container" style="padding-bottom: ' + ratio + '%"></div></section> ';

        $(this).wrapAll(container);


    });


    $(document).on('scroll', function () {
        scrollEvent();
    });

});

function moveToAnchor(aid) {

    $(document).scrollTop($('#' + aid).offset().top);
}

function scrollToAnchor(aid) {


    var aTag = $('#' + aid);

    $('html,body').animate({scrollTop: aTag.offset().top}, 'slow');
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


var openSelect = function (selector) {

    var element = $(selector)[0], worked = false;
    if (document.createEvent) { // all browsers
        var e = document.createEvent("MouseEvents");
        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        worked = element.dispatchEvent(e);
    } else if (element.fireEvent) { // ie
        worked = element.fireEvent("onmousedown");
    }
    if (!worked) { // unknown browser / error
        alert("It didn't worked in your browser.");
    }
}


function scrollEvent() {


    var scrollPos = $(document).scrollTop();

}


var updateQueryStringParam = function (key, value) {
    var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
        urlQueryString = document.location.search,
        newParam = key + '=' + value,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        keyRegex = new RegExp('([\?&])' + key + '[^&]*');

        // If param exists already, update it
        if (urlQueryString.match(keyRegex) !== null) {
            params = urlQueryString.replace(keyRegex, "$1" + newParam);
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }
    window.history.replaceState({}, "", baseUrl + params);
};