!(function (t) {
    "use strict";
    t("[data-background]").each(function () {
        t(this).css({
            "background-image": "url(" + t(this).data("background") + ")",
        });
    });
    if (0 !== t("#instafeed").length) {
        var d = t("#instafeed").attr("data-userId"),
            u = t("#instafeed").attr("data-accessToken");
        new Instafeed({
            get: "user",
            userId: d,
            resolution: "low_resolution",
            accessToken: u,
            limit: 6,
            template:
                '<div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4"><div class="instagram-post mx-2"><img class="img-fluid w-100" src="{{image}}" alt="instagram-image"><ul class="list-inline text-center"><li class="list-inline-item"><a href="{{link}}" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>{{likes}}</a></li><li class="list-inline-item"><a href="{{link}}" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>{{comments}}</a></li></ul></div></div>',
        }).run();
    }
    t(".label").click(function () {
        t(this).find(".size-checkbox").toggleClass("checked");
    }),
        t(function () {
            t('[data-toggle="tooltip"]').tooltip();
        });
    var navbar = t("#navbar"),
        mainWrapper = t(".main-wrapper"),
        g = navbar.offset()?.top;
    t(window).scroll(function () {
        t(document).scrollTop() >= g
            ? (navbar.addClass("sticky"),
              mainWrapper.addClass("main-wrapper-section"))
            : (navbar.removeClass("sticky"),
              mainWrapper.removeClass("main-wrapper-section"));
    });
})(jQuery);
