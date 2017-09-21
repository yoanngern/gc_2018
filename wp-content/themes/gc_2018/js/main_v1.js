// @codekit-prepend "vendor/jquery-2.2.2.js"


$(document).ready(function () {

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        $('body').addClass("mobile");

    }


    $("body > header").on("click", "#burger", function (event) {
        event.preventDefault();


        if ($("body > header #burger").hasClass("open")) {
            closeNav();

            closeForm();
        } else {
            openNav();
        }
    });


    $("iframe.video").each(function () {

        var iframe = $(this);

        var iframe_width = $(this).width();
        var iframe_height = $(this).height();

        $(this).attr("width", "100%");
        $(this).attr("height", "100%");


        console.log(iframe);
        console.log("width: " + iframe_width);
        console.log("height: " + iframe_height);


        var container = ' <section class="player" style="max-width: ' + iframe_width + 'px" data-width="' + iframe_width + '"><div class="container"></div></section> ';

        $(this).wrapAll(container);


    });


    $("#content.blog header").on("click", "#current_act", function (event) {
        event.preventDefault();
        $("#content.blog header select").toggleClass("show");
        $("#content.blog header #current_act").hide();

        openSelect("#content.blog header select");
    });


    $("#mc_embed_signup").on("click", "input.show_optional", function (event) {


        if ($("#mc_embed_signup input.show_optional").is(":checked")) {
            $("#mc_embed_signup fieldset.optional_fields").addClass("visible");
        } else {
            $("#mc_embed_signup fieldset.optional_fields").removeClass("visible");
        }


    });


    $("#content.blog header select").change(function (event) {
        event.preventDefault();

        $("#content.blog header option:selected").each(function () {


            var url = $("#content.blog header #current_act").data("url");

            if (this.value) {
                var slug = this.value;
            } else {
                var slug = "";
            }

            window.location.href = url + "category/" + slug;
        });

    });


    $("header #language select").on('change', function (event) {
        event.preventDefault();

        $("header #language option:selected").each(function () {


            if (this.value) {
                var url = this.value;
            } else {
                var url = "";
            }

            window.location.href = url;
        });

    });


    $("#content.blog header #search_input").blur(function (event) {
        event.preventDefault();

        var url = $(this).data("url");

        var val = this.value;


        if (val) {
            window.location.href = url + "/search/" + val + "?post_type=post";
        }


    });


    $("#content.blog header").on("click", ".search .box", function (event) {
        event.preventDefault();

        $('#search_input').focus();

    });


    $("#content.blog header #search_input").change(function (event) {
        event.preventDefault();

        var val = this.value;


        if (val) {
            window.location.href = "/search/" + val + "?post_type=post";
        }


    });

    $("#slider .bullets a").on("click", function () {

        $("#slider").addClass("stop");

        var id = $(this).data("slide");

        $("#slider .bullets a").removeClass("current");
        $("#slider > article").removeClass("current");

        $("#slider .bullets a[data-slide=" + id + "]").addClass("current");
        $("#slider > article[data-slide=" + id + "]").addClass("current");

    });


    $("header div.principal-nav div > ul > li.menu-item-has-children").on("touchstart", function () {


        if ($(this).hasClass("open")) {
            return;


        } else {
            event.preventDefault();

            var parent = $(this).parent();

            $("> li", parent).each(function () {
                $(this).removeClass("open");
            });

            $(this).addClass("open");
        }


    });


    $(document).on('scroll', function () {
        scrollEvent();
    });

});


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


function openNav() {


    $("body > header ul").addClass("show");
    $("body > header #burger").addClass("open");

    $("body > #content").addClass("hide");
    $("body > footer").addClass("hide");
    $("body").addClass("black");

}


function closeNav() {


    $("body > header ul").removeClass("show");
    $("body > header #burger").removeClass("open");

    $("body > #content").removeClass("hide");
    $("body > footer").removeClass("hide");
    $("body").removeClass("black");
}