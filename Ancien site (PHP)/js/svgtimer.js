! function(t) {
    t.fn.svgTimer = function(s) {
        var r = t.extend({}, t.fn.svgTimer.defaults, s),
            e = "<button style='padding-right: 10px; background-color:transparent; background-repeat:no-repeat; border: none; overflow:hidden;' disabled><div class='svg-hexagonal-counter'><h2><i class='fas fa-play' style='color: rgb(104, 214, 198); padding-left:10px;'></i></h2><svg class='counter' x='0px' y='0px' viewBox='0 0 776 628'><path class='track' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z'></path><path class='fill' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z'></path></svg></div></button>";
        return this.each(function() {
            var s = t(this);
            s.append(e);
            var i = s.find(".track"),
                a = s.find(".fill"),
                n = s.find("h2"),
                o = r.time,
                f = 2160,
                c = 1,
                string = '<i class="fas fa-check" style="padding-left:10px;"></i>';
            i.css("stroke", r.track), a.css({
                stroke: r.fill,
                "stroke-dashoffset": f + "px",
                transition: "stroke-dashoffset 1s" + r.transition
            });
            var l = setInterval(function() {
                if (i.css("stroke", r.track), a.css({
                        stroke: r.fill,
                        "stroke-dashoffset": f - c * (f / o) + "px",
                        transition: "stroke-dashoffset 1s " + r.transition
                    }), "forward" === r.direction) n.text(c);
                else if ("backward" === r.direction) {
                    var t = r.time - c + 1;
                    n.text(t);
                }
                //console.log(n.text());
                if(n.text() == "1"){
                    n.html(string);
                }
                c == o && clearInterval(l), c++
            }, r.interval);
        });
    }, t.fn.svgTimer.defaults = {
        time: 60,
        track: "rgb(56, 71, 83)",
        fill: "rgb(104, 214, 198)",
        transition: "linear",
        direction: "forward",
        interval: 1e3
    }
}(jQuery);