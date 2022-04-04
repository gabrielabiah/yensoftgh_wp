var WidgetRadiantProgressbarHandler = function ($scope, $) {
	// RADIANTTHEMES PROGRESS BAR.
	$(document).bind('scroll', function (ev) {
		var scrollOffset = $(document).scrollTop();
		var containerOffset = $('.rt-progress-bar.element-one').offset().top - window.innerHeight;
		if (scrollOffset > containerOffset) {
			$(".rt-progress-bar").each(function(){
        		$(this).find(".progress-width").text( $(this).data("progress-bar-width") );
        		$(this).find(".progress").css({
        			"height": $(this).data("progress-bar-height")
        		});
        		$(this).find(".progress-bar").css({
        			"width": $(this).data("progress-bar-width")
        		});
        	});
			// unbind event not to load scrolsl again
			$(document).unbind('scroll');
		}
	});
	
    // Progress Bar
    if ($('.progress-line').length) {
        $('.progress-line').appear(function () {
            var el = $(this);
            var percent = el.data('width');
            $(el).css('width', percent + '%');
        }, {
            accY: 0
        });
    }
    if ($('.count-box').length) {
        $('.count-box').appear(function () {
            var $t = $(this),
                n = $t.find(".count-text").attr("data-stop"),
                r = parseInt($t.find(".count-text").attr("data-speed"), 10);

            if (!$t.hasClass("counted")) {
                $t.addClass("counted");
                $({
                    countNum: $t.find(".count-text").text()
                }).animate({
                    countNum: n
                }, {
                    duration: r,
                    easing: "linear",
                    step: function () {
                        $t.find(".count-text").text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $t.find(".count-text").text(this.countNum);
                    }
                });
            }

        }, {

        });
    }


};

jQuery(window).on("elementor/frontend/init", function () {
	elementorFrontend.hooks.addAction(
		"frontend/element_ready/radiant-progressbar.default",
		WidgetRadiantProgressbarHandler
	);
});
