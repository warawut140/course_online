/*! @name @filmgardi/videojs-skip-button @version 2.0.0 @license MIT */
(function (global, factory) {
  typeof exports === "object" && typeof module !== "undefined"
    ? (module.exports = factory(require("video.js")))
    : typeof define === "function" && define.amd
    ? define(["video.js"], factory)
    : ((global =
        typeof globalThis !== "undefined" ? globalThis : global || self),
      (global.videojsSkipButton = factory(global.videojs)));
})(this, function (videojs) {
  "use strict";

  function _interopDefaultLegacy(e) {
    return e && typeof e === "object" && "default" in e ? e : { default: e };
  }

  var videojs__default = /*#__PURE__*/ _interopDefaultLegacy(videojs);

  function createCommonjsModule(fn, basedir, module) {
    return (
      (module = {
        path: basedir,
        exports: {},
        require: function (path, base) {
          return commonjsRequire(
            path,
            base === undefined || base === null ? module.path : base
          );
        },
      }),
      fn(module, module.exports),
      module.exports
    );
  }

  function commonjsRequire() {
    throw new Error(
      "Dynamic requires are not currently supported by @rollup/plugin-commonjs"
    );
  }

  var setPrototypeOf = createCommonjsModule(function (module) {
    function _setPrototypeOf(o, p) {
      module.exports = _setPrototypeOf =
        Object.setPrototypeOf ||
        function _setPrototypeOf(o, p) {
          o.__proto__ = p;
          return o;
        };

      (module.exports["default"] = module.exports),
        (module.exports.__esModule = true);
      return _setPrototypeOf(o, p);
    }

    module.exports = _setPrototypeOf;
    (module.exports["default"] = module.exports),
      (module.exports.__esModule = true);
  });

  var inheritsLoose = createCommonjsModule(function (module) {
    function _inheritsLoose(subClass, superClass) {
      subClass.prototype = Object.create(superClass.prototype);
      subClass.prototype.constructor = subClass;
      setPrototypeOf(subClass, superClass);
    }

    module.exports = _inheritsLoose;
    (module.exports["default"] = module.exports),
      (module.exports.__esModule = true);
  });

  var version = "2.0.0";

  videojs__default["default"].dom;

  var SkipButton = /*#__PURE__*/ (function () {
    function SkipButton(player, options) {
      this.player_ = player;
      this.options = options;
    }

    var _proto = SkipButton.prototype;

    _proto.init = function init() {
      var player_ = this.player_,
        options = this.options;

      if (options) {
        var text = options.text,
          from = options.from,
          to = options.to,
          style = options.style;

        if (from && to) {
          if (player_) {
            var skipButton = player_.addChild("button");
            skipButton.setAttribute("class", "vjs-fg-skip-button vjs-hidden");
            skipButton.controlText(text);
            this.setupPosition(skipButton.el_);

            if (style) {
              var keys = Object.keys(style);

              if (keys.length > 0) {
                keys.map(function (key) {
                  skipButton.el().style[key] = style[key];
                });
              }
            }

            var intervalId = skipButton.setInterval(function () {
              if (!player_.paused()) {
                if (
                  player_.currentTime() > from &&
                  player_.currentTime() < to
                ) {
                  skipButton.show();
                }

                if (player_.currentTime() > to) {
                  skipButton.hide();
                  clearInterval(intervalId);
                }
              }
            }, 250);
            skipButton.on("click", function () {
              player_.currentTime(to);
            });
          }
        } else {
          videojs__default["default"].log(
            "Initial data is required.{ from:0s, to:0s }"
          );
        }
      }
    };

    _proto.setupPosition = function setupPosition(el) {
      // Setup position
      var _this$options = this.options,
        offsetH = _this$options.offsetH,
        offsetV = _this$options.offsetV;

      switch (this.options.position) {
        case "top-left":
          el.style.top = offsetV + "px";
          el.style.left = offsetH + "px";
          break;

        case "top-right":
          el.style.top = offsetV + "px";
          el.style.right = offsetH + "px";
          break;

        case "bottom-left":
          el.style.bottom = offsetV + "px";
          el.style.left = offsetH + "px";
          break;

        case "bottom-right":
          el.style.bottom = offsetV + "px";
          el.style.right = offsetH + "px";
          break;

        default:
          el.style.top = offsetV + "px";
          el.style.right = offsetH + "px";
      }
    };

    return SkipButton;
  })();

  SkipButton.prototype.name = "skipButton";

  var Plugin = videojs__default["default"].getPlugin("plugin"); // Default options for the plugin.

  var defaults = {
    text: "Skip",
    from: 0,
    to: 60,
    position: "bottom-right",
    offsetH: 46,
    offsetV: 96,
  };
  /**
   * An advanced Video.js plugin. For more information on the API
   *
   * See: https://blog.videojs.com/feature-spotlight-advanced-plugins/
   */

  var Skip = /*#__PURE__*/ (function (_Plugin) {
    inheritsLoose(Skip, _Plugin);

    /**
     * Create a Skip plugin instance.
     *
     * @param  {Player} player
     *         A Video.js Player instance.
     *
     * @param  {Object} [options]
     *         An optional options object.
     *
     *         While not a core part of the Video.js plugin architecture, a
     *         second argument of options is a convenient way to accept inputs
     *         from your plugin's caller.
     */
    function Skip(player, options) {
      var _this;

      // the parent class will add player under this.player
      _this = _Plugin.call(this, player) || this;
      _this.options = videojs__default["default"].mergeOptions(
        defaults,
        options
      );

      _this.player.ready(function () {
        _this.player.addClass("vjs-fg-skip");

        _this.initial();

        videojs__default["default"].log("Create Skip-Button");
      });

      return _this;
    }
    /**
     * Initial `skip` logic
     *
     */

    var _proto = Skip.prototype;

    _proto.initial = function initial() {
      var skipButton = new SkipButton(this.player, this.options);
      skipButton.init();
    };

    return Skip;
  })(Plugin); // Define default values for the plugin's `state` object here.

  Skip.defaultState = {}; // Include the version number.

  Skip.VERSION = version; // Register the plugin with video.js.

  videojs__default["default"].registerPlugin("skipButton", Skip);

  return Skip;
});
