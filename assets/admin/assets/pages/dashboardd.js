!(function (e) {
  "use strict";
  var a = function () {};

  var t,
    r = new Skycons({ color: "#fff" }, { resizeClear: !0 }),
    i = [
      "clear-day",
      "clear-night",
      "partly-cloudy-day",
      "partly-cloudy-night",
      "cloudy",
      "rain",
      "sleet",
      "snow",
      "wind",
      "fog",
    ];
  for (t = i.length; t--; ) r.set(i[t], i[t]);
  r.play();
  (e.Dashboard = new a()), (e.Dashboard.Constructor = a);
})(window.jQuery),
  (function (e) {
    "use strict";
  })();
