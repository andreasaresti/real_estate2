/*! For license information please see dompurify.ace92cf9.bundle.js.LICENSE.txt */
(self.webpackChunk_zillow_search_page_sub_app =
  self.webpackChunk_zillow_search_page_sub_app || []).push([
  [565],
  {
    27856: function (e) {
      e.exports = (function () {
        "use strict";
        var e = Object.hasOwnProperty,
          t = Object.setPrototypeOf,
          r = Object.isFrozen,
          n = Object.freeze,
          o = Object.seal,
          i = Object.create,
          a = "undefined" != typeof Reflect && Reflect,
          l = a.apply,
          c = a.construct;
        l ||
          (l = function (e, t, r) {
            return e.apply(t, r);
          }),
          n ||
            (n = function (e) {
              return e;
            }),
          o ||
            (o = function (e) {
              return e;
            }),
          c ||
            (c = function (e, t) {
              return new (Function.prototype.bind.apply(
                e,
                [null].concat(
                  (function (e) {
                    if (Array.isArray(e)) {
                      for (var t = 0, r = Array(e.length); t < e.length; t++)
                        r[t] = e[t];
                      return r;
                    }
                    return Array.from(e);
                  })(t)
                )
              ))();
            });
        var s,
          u = T(Array.prototype.forEach),
          d = T(Array.prototype.pop),
          p = T(Array.prototype.push),
          f = T(String.prototype.toLowerCase),
          m = T(String.prototype.match),
          y = T(String.prototype.replace),
          h = T(String.prototype.indexOf),
          g = T(String.prototype.trim),
          v = T(RegExp.prototype.test),
          b =
            ((s = TypeError),
            function () {
              for (var e = arguments.length, t = Array(e), r = 0; r < e; r++)
                t[r] = arguments[r];
              return c(s, t);
            });
        function T(e) {
          return function (t) {
            for (
              var r = arguments.length, n = Array(r > 1 ? r - 1 : 0), o = 1;
              o < r;
              o++
            )
              n[o - 1] = arguments[o];
            return l(e, t, n);
          };
        }
        function A(e, n) {
          t && t(e, null);
          for (var o = n.length; o--; ) {
            var i = n[o];
            if ("string" == typeof i) {
              var a = f(i);
              a !== i && (r(n) || (n[o] = a), (i = a));
            }
            e[i] = !0;
          }
          return e;
        }
        function S(t) {
          var r = i(null),
            n = void 0;
          for (n in t) l(e, t, [n]) && (r[n] = t[n]);
          return r;
        }
        var _ = n([
            "a",
            "abbr",
            "acronym",
            "address",
            "area",
            "article",
            "aside",
            "audio",
            "b",
            "bdi",
            "bdo",
            "big",
            "blink",
            "blockquote",
            "body",
            "br",
            "button",
            "canvas",
            "caption",
            "center",
            "cite",
            "code",
            "col",
            "colgroup",
            "content",
            "data",
            "datalist",
            "dd",
            "decorator",
            "del",
            "details",
            "dfn",
            "dialog",
            "dir",
            "div",
            "dl",
            "dt",
            "element",
            "em",
            "fieldset",
            "figcaption",
            "figure",
            "font",
            "footer",
            "form",
            "h1",
            "h2",
            "h3",
            "h4",
            "h5",
            "h6",
            "head",
            "header",
            "hgroup",
            "hr",
            "html",
            "i",
            "img",
            "input",
            "ins",
            "kbd",
            "label",
            "legend",
            "li",
            "main",
            "map",
            "mark",
            "marquee",
            "menu",
            "menuitem",
            "meter",
            "nav",
            "nobr",
            "ol",
            "optgroup",
            "option",
            "output",
            "p",
            "picture",
            "pre",
            "progress",
            "q",
            "rp",
            "rt",
            "ruby",
            "s",
            "samp",
            "section",
            "select",
            "shadow",
            "small",
            "source",
            "spacer",
            "span",
            "strike",
            "strong",
            "style",
            "sub",
            "summary",
            "sup",
            "table",
            "tbody",
            "td",
            "template",
            "textarea",
            "tfoot",
            "th",
            "thead",
            "time",
            "tr",
            "track",
            "tt",
            "u",
            "ul",
            "var",
            "video",
            "wbr",
          ]),
          x = n([
            "svg",
            "a",
            "altglyph",
            "altglyphdef",
            "altglyphitem",
            "animatecolor",
            "animatemotion",
            "animatetransform",
            "audio",
            "canvas",
            "circle",
            "clippath",
            "defs",
            "desc",
            "ellipse",
            "filter",
            "font",
            "g",
            "glyph",
            "glyphref",
            "hkern",
            "image",
            "line",
            "lineargradient",
            "marker",
            "mask",
            "metadata",
            "mpath",
            "path",
            "pattern",
            "polygon",
            "polyline",
            "radialgradient",
            "rect",
            "stop",
            "style",
            "switch",
            "symbol",
            "text",
            "textpath",
            "title",
            "tref",
            "tspan",
            "video",
            "view",
            "vkern",
          ]),
          k = n([
            "feBlend",
            "feColorMatrix",
            "feComponentTransfer",
            "feComposite",
            "feConvolveMatrix",
            "feDiffuseLighting",
            "feDisplacementMap",
            "feDistantLight",
            "feFlood",
            "feFuncA",
            "feFuncB",
            "feFuncG",
            "feFuncR",
            "feGaussianBlur",
            "feMerge",
            "feMergeNode",
            "feMorphology",
            "feOffset",
            "fePointLight",
            "feSpecularLighting",
            "feSpotLight",
            "feTile",
            "feTurbulence",
          ]),
          w = n([
            "math",
            "menclose",
            "merror",
            "mfenced",
            "mfrac",
            "mglyph",
            "mi",
            "mlabeledtr",
            "mmultiscripts",
            "mn",
            "mo",
            "mover",
            "mpadded",
            "mphantom",
            "mroot",
            "mrow",
            "ms",
            "mspace",
            "msqrt",
            "mstyle",
            "msub",
            "msup",
            "msubsup",
            "mtable",
            "mtd",
            "mtext",
            "mtr",
            "munder",
            "munderover",
          ]),
          E = n(["#text"]),
          D = n([
            "accept",
            "action",
            "align",
            "alt",
            "autocapitalize",
            "autocomplete",
            "autopictureinpicture",
            "autoplay",
            "background",
            "bgcolor",
            "border",
            "capture",
            "cellpadding",
            "cellspacing",
            "checked",
            "cite",
            "class",
            "clear",
            "color",
            "cols",
            "colspan",
            "controls",
            "controlslist",
            "coords",
            "crossorigin",
            "datetime",
            "decoding",
            "default",
            "dir",
            "disabled",
            "disablepictureinpicture",
            "disableremoteplayback",
            "download",
            "draggable",
            "enctype",
            "enterkeyhint",
            "face",
            "for",
            "headers",
            "height",
            "hidden",
            "high",
            "href",
            "hreflang",
            "id",
            "inputmode",
            "integrity",
            "ismap",
            "kind",
            "label",
            "lang",
            "list",
            "loading",
            "loop",
            "low",
            "max",
            "maxlength",
            "media",
            "method",
            "min",
            "minlength",
            "multiple",
            "muted",
            "name",
            "noshade",
            "novalidate",
            "nowrap",
            "open",
            "optimum",
            "pattern",
            "placeholder",
            "playsinline",
            "poster",
            "preload",
            "pubdate",
            "radiogroup",
            "readonly",
            "rel",
            "required",
            "rev",
            "reversed",
            "role",
            "rows",
            "rowspan",
            "spellcheck",
            "scope",
            "selected",
            "shape",
            "size",
            "sizes",
            "span",
            "srclang",
            "start",
            "src",
            "srcset",
            "step",
            "style",
            "summary",
            "tabindex",
            "title",
            "translate",
            "type",
            "usemap",
            "valign",
            "value",
            "width",
            "xmlns",
          ]),
          L = n([
            "accent-height",
            "accumulate",
            "additive",
            "alignment-baseline",
            "ascent",
            "attributename",
            "attributetype",
            "azimuth",
            "basefrequency",
            "baseline-shift",
            "begin",
            "bias",
            "by",
            "class",
            "clip",
            "clippathunits",
            "clip-path",
            "clip-rule",
            "color",
            "color-interpolation",
            "color-interpolation-filters",
            "color-profile",
            "color-rendering",
            "cx",
            "cy",
            "d",
            "dx",
            "dy",
            "diffuseconstant",
            "direction",
            "display",
            "divisor",
            "dur",
            "edgemode",
            "elevation",
            "end",
            "fill",
            "fill-opacity",
            "fill-rule",
            "filter",
            "filterunits",
            "flood-color",
            "flood-opacity",
            "font-family",
            "font-size",
            "font-size-adjust",
            "font-stretch",
            "font-style",
            "font-variant",
            "font-weight",
            "fx",
            "fy",
            "g1",
            "g2",
            "glyph-name",
            "glyphref",
            "gradientunits",
            "gradienttransform",
            "height",
            "href",
            "id",
            "image-rendering",
            "in",
            "in2",
            "k",
            "k1",
            "k2",
            "k3",
            "k4",
            "kerning",
            "keypoints",
            "keysplines",
            "keytimes",
            "lang",
            "lengthadjust",
            "letter-spacing",
            "kernelmatrix",
            "kernelunitlength",
            "lighting-color",
            "local",
            "marker-end",
            "marker-mid",
            "marker-start",
            "markerheight",
            "markerunits",
            "markerwidth",
            "maskcontentunits",
            "maskunits",
            "max",
            "mask",
            "media",
            "method",
            "mode",
            "min",
            "name",
            "numoctaves",
            "offset",
            "operator",
            "opacity",
            "order",
            "orient",
            "orientation",
            "origin",
            "overflow",
            "paint-order",
            "path",
            "pathlength",
            "patterncontentunits",
            "patterntransform",
            "patternunits",
            "points",
            "preservealpha",
            "preserveaspectratio",
            "primitiveunits",
            "r",
            "rx",
            "ry",
            "radius",
            "refx",
            "refy",
            "repeatcount",
            "repeatdur",
            "restart",
            "result",
            "rotate",
            "scale",
            "seed",
            "shape-rendering",
            "specularconstant",
            "specularexponent",
            "spreadmethod",
            "startoffset",
            "stddeviation",
            "stitchtiles",
            "stop-color",
            "stop-opacity",
            "stroke-dasharray",
            "stroke-dashoffset",
            "stroke-linecap",
            "stroke-linejoin",
            "stroke-miterlimit",
            "stroke-opacity",
            "stroke",
            "stroke-width",
            "style",
            "surfacescale",
            "systemlanguage",
            "tabindex",
            "targetx",
            "targety",
            "transform",
            "text-anchor",
            "text-decoration",
            "text-rendering",
            "textlength",
            "type",
            "u1",
            "u2",
            "unicode",
            "values",
            "viewbox",
            "visibility",
            "version",
            "vert-adv-y",
            "vert-origin-x",
            "vert-origin-y",
            "width",
            "word-spacing",
            "wrap",
            "writing-mode",
            "xchannelselector",
            "ychannelselector",
            "x",
            "x1",
            "x2",
            "xmlns",
            "y",
            "y1",
            "y2",
            "z",
            "zoomandpan",
          ]),
          M = n([
            "accent",
            "accentunder",
            "align",
            "bevelled",
            "close",
            "columnsalign",
            "columnlines",
            "columnspan",
            "denomalign",
            "depth",
            "dir",
            "display",
            "displaystyle",
            "encoding",
            "fence",
            "frame",
            "height",
            "href",
            "id",
            "largeop",
            "length",
            "linethickness",
            "lspace",
            "lquote",
            "mathbackground",
            "mathcolor",
            "mathsize",
            "mathvariant",
            "maxsize",
            "minsize",
            "movablelimits",
            "notation",
            "numalign",
            "open",
            "rowalign",
            "rowlines",
            "rowspacing",
            "rowspan",
            "rspace",
            "rquote",
            "scriptlevel",
            "scriptminsize",
            "scriptsizemultiplier",
            "selection",
            "separator",
            "separators",
            "stretchy",
            "subscriptshift",
            "supscriptshift",
            "symmetric",
            "voffset",
            "width",
            "xmlns",
          ]),
          N = n([
            "xlink:href",
            "xml:id",
            "xlink:title",
            "xml:space",
            "xmlns:xlink",
          ]),
          O = o(/\{\{[\s\S]*|[\s\S]*\}\}/gm),
          R = o(/<%[\s\S]*|[\s\S]*%>/gm),
          F = o(/^data-[\-\w.\u00B7-\uFFFF]/),
          C = o(/^aria-[\-\w]+$/),
          H = o(
            /^(?:(?:(?:f|ht)tps?|mailto|tel|callto|cid|xmpp):|[^a-z]|[a-z+.\-]+(?:[^a-z+.\-:]|$))/i
          ),
          z = o(/^(?:\w+script|data):/i),
          I = o(/[\u0000-\u0020\u00A0\u1680\u180E\u2000-\u2029\u205F\u3000]/g),
          U =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
              ? function (e) {
                  return typeof e;
                }
              : function (e) {
                  return e &&
                    "function" == typeof Symbol &&
                    e.constructor === Symbol &&
                    e !== Symbol.prototype
                    ? "symbol"
                    : typeof e;
                };
        function j(e) {
          if (Array.isArray(e)) {
            for (var t = 0, r = Array(e.length); t < e.length; t++) r[t] = e[t];
            return r;
          }
          return Array.from(e);
        }
        var P = function () {
            return "undefined" == typeof window ? null : window;
          },
          W = function (e, t) {
            if (
              "object" !== (void 0 === e ? "undefined" : U(e)) ||
              "function" != typeof e.createPolicy
            )
              return null;
            var r = null,
              n = "data-tt-policy-suffix";
            t.currentScript &&
              t.currentScript.hasAttribute(n) &&
              (r = t.currentScript.getAttribute(n));
            var o = "dompurify" + (r ? "#" + r : "");
            try {
              return e.createPolicy(o, {
                createHTML: function (e) {
                  return e;
                },
              });
            } catch (e) {
              return (
                console.warn(
                  "TrustedTypes policy " + o + " could not be created."
                ),
                null
              );
            }
          };
        return (function e() {
          var t =
              arguments.length > 0 && void 0 !== arguments[0]
                ? arguments[0]
                : P(),
            r = function (t) {
              return e(t);
            };
          if (
            ((r.version = "2.2.2"),
            (r.removed = []),
            !t || !t.document || 9 !== t.document.nodeType)
          )
            return (r.isSupported = !1), r;
          var o = t.document,
            i = t.document,
            a = t.DocumentFragment,
            l = t.HTMLTemplateElement,
            c = t.Node,
            s = t.NodeFilter,
            T = t.NamedNodeMap,
            B = void 0 === T ? t.NamedNodeMap || t.MozNamedAttrMap : T,
            G = t.Text,
            q = t.Comment,
            K = t.DOMParser,
            V = t.trustedTypes;
          if ("function" == typeof l) {
            var Y = i.createElement("template");
            Y.content &&
              Y.content.ownerDocument &&
              (i = Y.content.ownerDocument);
          }
          var X = W(V, o),
            $ = X && De ? X.createHTML("") : "",
            Z = i,
            J = Z.implementation,
            Q = Z.createNodeIterator,
            ee = Z.getElementsByTagName,
            te = Z.createDocumentFragment,
            re = o.importNode,
            ne = {};
          try {
            ne = S(i).documentMode ? i.documentMode : {};
          } catch (e) {}
          var oe = {};
          r.isSupported = J && void 0 !== J.createHTMLDocument && 9 !== ne;
          var ie = O,
            ae = R,
            le = F,
            ce = C,
            se = z,
            ue = I,
            de = H,
            pe = null,
            fe = A({}, [].concat(j(_), j(x), j(k), j(w), j(E))),
            me = null,
            ye = A({}, [].concat(j(D), j(L), j(M), j(N))),
            he = null,
            ge = null,
            ve = !0,
            be = !0,
            Te = !1,
            Ae = !1,
            Se = !1,
            _e = !1,
            xe = !1,
            ke = !1,
            we = !1,
            Ee = !0,
            De = !1,
            Le = !0,
            Me = !0,
            Ne = !1,
            Oe = {},
            Re = A({}, [
              "annotation-xml",
              "audio",
              "colgroup",
              "desc",
              "foreignobject",
              "head",
              "iframe",
              "math",
              "mi",
              "mn",
              "mo",
              "ms",
              "mtext",
              "noembed",
              "noframes",
              "plaintext",
              "script",
              "style",
              "svg",
              "template",
              "thead",
              "title",
              "video",
              "xmp",
            ]),
            Fe = null,
            Ce = A({}, ["audio", "video", "img", "source", "image", "track"]),
            He = null,
            ze = A({}, [
              "alt",
              "class",
              "for",
              "id",
              "label",
              "name",
              "pattern",
              "placeholder",
              "summary",
              "title",
              "value",
              "style",
              "xmlns",
            ]),
            Ie = null,
            Ue = i.createElement("form"),
            je = function (e) {
              (Ie && Ie === e) ||
                ((e && "object" === (void 0 === e ? "undefined" : U(e))) ||
                  (e = {}),
                (e = S(e)),
                (pe = "ALLOWED_TAGS" in e ? A({}, e.ALLOWED_TAGS) : fe),
                (me = "ALLOWED_ATTR" in e ? A({}, e.ALLOWED_ATTR) : ye),
                (He =
                  "ADD_URI_SAFE_ATTR" in e
                    ? A(S(ze), e.ADD_URI_SAFE_ATTR)
                    : ze),
                (Fe =
                  "ADD_DATA_URI_TAGS" in e
                    ? A(S(Ce), e.ADD_DATA_URI_TAGS)
                    : Ce),
                (he = "FORBID_TAGS" in e ? A({}, e.FORBID_TAGS) : {}),
                (ge = "FORBID_ATTR" in e ? A({}, e.FORBID_ATTR) : {}),
                (Oe = "USE_PROFILES" in e && e.USE_PROFILES),
                (ve = !1 !== e.ALLOW_ARIA_ATTR),
                (be = !1 !== e.ALLOW_DATA_ATTR),
                (Te = e.ALLOW_UNKNOWN_PROTOCOLS || !1),
                (Ae = e.SAFE_FOR_TEMPLATES || !1),
                (Se = e.WHOLE_DOCUMENT || !1),
                (ke = e.RETURN_DOM || !1),
                (we = e.RETURN_DOM_FRAGMENT || !1),
                (Ee = !1 !== e.RETURN_DOM_IMPORT),
                (De = e.RETURN_TRUSTED_TYPE || !1),
                (xe = e.FORCE_BODY || !1),
                (Le = !1 !== e.SANITIZE_DOM),
                (Me = !1 !== e.KEEP_CONTENT),
                (Ne = e.IN_PLACE || !1),
                (de = e.ALLOWED_URI_REGEXP || de),
                Ae && (be = !1),
                we && (ke = !0),
                Oe &&
                  ((pe = A({}, [].concat(j(E)))),
                  (me = []),
                  !0 === Oe.html && (A(pe, _), A(me, D)),
                  !0 === Oe.svg && (A(pe, x), A(me, L), A(me, N)),
                  !0 === Oe.svgFilters && (A(pe, k), A(me, L), A(me, N)),
                  !0 === Oe.mathMl && (A(pe, w), A(me, M), A(me, N))),
                e.ADD_TAGS && (pe === fe && (pe = S(pe)), A(pe, e.ADD_TAGS)),
                e.ADD_ATTR && (me === ye && (me = S(me)), A(me, e.ADD_ATTR)),
                e.ADD_URI_SAFE_ATTR && A(He, e.ADD_URI_SAFE_ATTR),
                Me && (pe["#text"] = !0),
                Se && A(pe, ["html", "head", "body"]),
                pe.table && (A(pe, ["tbody"]), delete he.tbody),
                n && n(e),
                (Ie = e));
            },
            Pe = function (e) {
              p(r.removed, { element: e });
              try {
                e.parentNode.removeChild(e);
              } catch (t) {
                e.outerHTML = $;
              }
            },
            We = function (e, t) {
              try {
                p(r.removed, { attribute: t.getAttributeNode(e), from: t });
              } catch (e) {
                p(r.removed, { attribute: null, from: t });
              }
              t.removeAttribute(e);
            },
            Be = function (e) {
              var t = void 0,
                r = void 0;
              if (xe) e = "<remove></remove>" + e;
              else {
                var n = m(e, /^[\r\n\t ]+/);
                r = n && n[0];
              }
              var o = X ? X.createHTML(e) : e;
              try {
                t = new K().parseFromString(o, "text/html");
              } catch (e) {}
              if (!t || !t.documentElement) {
                var a = (t = J.createHTMLDocument("")).body;
                a.parentNode.removeChild(a.parentNode.firstElementChild),
                  (a.outerHTML = o);
              }
              return (
                e &&
                  r &&
                  t.body.insertBefore(
                    i.createTextNode(r),
                    t.body.childNodes[0] || null
                  ),
                ee.call(t, Se ? "html" : "body")[0]
              );
            },
            Ge = function (e) {
              return Q.call(
                e.ownerDocument || e,
                e,
                s.SHOW_ELEMENT | s.SHOW_COMMENT | s.SHOW_TEXT,
                function () {
                  return s.FILTER_ACCEPT;
                },
                !1
              );
            },
            qe = function (e) {
              return !(
                e instanceof G ||
                e instanceof q ||
                ("string" == typeof e.nodeName &&
                  "string" == typeof e.textContent &&
                  "function" == typeof e.removeChild &&
                  e.attributes instanceof B &&
                  "function" == typeof e.removeAttribute &&
                  "function" == typeof e.setAttribute &&
                  "string" == typeof e.namespaceURI)
              );
            },
            Ke = function (e) {
              return "object" === (void 0 === c ? "undefined" : U(c))
                ? e instanceof c
                : e &&
                    "object" === (void 0 === e ? "undefined" : U(e)) &&
                    "number" == typeof e.nodeType &&
                    "string" == typeof e.nodeName;
            },
            Ve = function (e, t, n) {
              oe[e] &&
                u(oe[e], function (e) {
                  e.call(r, t, n, Ie);
                });
            },
            Ye = function (e) {
              var t = void 0;
              if ((Ve("beforeSanitizeElements", e, null), qe(e)))
                return Pe(e), !0;
              if (m(e.nodeName, /[\u0080-\uFFFF]/)) return Pe(e), !0;
              var n = f(e.nodeName);
              if (
                (Ve("uponSanitizeElement", e, { tagName: n, allowedTags: pe }),
                ("svg" === n || "math" === n) &&
                  0 !== e.querySelectorAll("p, br, form, table").length)
              )
                return Pe(e), !0;
              if (
                !Ke(e.firstElementChild) &&
                (!Ke(e.content) || !Ke(e.content.firstElementChild)) &&
                v(/<[!/\w]/g, e.innerHTML) &&
                v(/<[!/\w]/g, e.textContent)
              )
                return Pe(e), !0;
              if (!pe[n] || he[n]) {
                if (Me && !Re[n] && "function" == typeof e.insertAdjacentHTML)
                  try {
                    var o = e.innerHTML;
                    e.insertAdjacentHTML("AfterEnd", X ? X.createHTML(o) : o);
                  } catch (e) {}
                return Pe(e), !0;
              }
              return ("noscript" !== n && "noembed" !== n) ||
                !v(/<\/no(script|embed)/i, e.innerHTML)
                ? (Ae &&
                    3 === e.nodeType &&
                    ((t = e.textContent),
                    (t = y(t, ie, " ")),
                    (t = y(t, ae, " ")),
                    e.textContent !== t &&
                      (p(r.removed, { element: e.cloneNode() }),
                      (e.textContent = t))),
                  Ve("afterSanitizeElements", e, null),
                  !1)
                : (Pe(e), !0);
            },
            Xe = function (e, t, r) {
              if (Le && ("id" === t || "name" === t) && (r in i || r in Ue))
                return !1;
              if (be && v(le, t));
              else if (ve && v(ce, t));
              else {
                if (!me[t] || ge[t]) return !1;
                if (He[t]);
                else if (v(de, y(r, ue, "")));
                else if (
                  ("src" !== t && "xlink:href" !== t && "href" !== t) ||
                  "script" === e ||
                  0 !== h(r, "data:") ||
                  !Fe[e]
                )
                  if (Te && !v(se, y(r, ue, "")));
                  else if (r) return !1;
              }
              return !0;
            },
            $e = function (e) {
              var t = void 0,
                n = void 0,
                o = void 0,
                i = void 0;
              Ve("beforeSanitizeAttributes", e, null);
              var a = e.attributes;
              if (a) {
                var l = {
                  attrName: "",
                  attrValue: "",
                  keepAttr: !0,
                  allowedAttributes: me,
                };
                for (i = a.length; i--; ) {
                  var c = (t = a[i]),
                    s = c.name,
                    u = c.namespaceURI;
                  if (
                    ((n = g(t.value)),
                    (o = f(s)),
                    (l.attrName = o),
                    (l.attrValue = n),
                    (l.keepAttr = !0),
                    (l.forceKeepAttr = void 0),
                    Ve("uponSanitizeAttribute", e, l),
                    (n = l.attrValue),
                    !l.forceKeepAttr && (We(s, e), l.keepAttr))
                  )
                    if (v(/\/>/i, n)) We(s, e);
                    else {
                      Ae && ((n = y(n, ie, " ")), (n = y(n, ae, " ")));
                      var p = e.nodeName.toLowerCase();
                      if (Xe(p, o, n))
                        try {
                          u ? e.setAttributeNS(u, s, n) : e.setAttribute(s, n),
                            d(r.removed);
                        } catch (e) {}
                    }
                }
                Ve("afterSanitizeAttributes", e, null);
              }
            },
            Ze = function e(t) {
              var r = void 0,
                n = Ge(t);
              for (Ve("beforeSanitizeShadowDOM", t, null); (r = n.nextNode()); )
                Ve("uponSanitizeShadowNode", r, null),
                  Ye(r) || (r.content instanceof a && e(r.content), $e(r));
              Ve("afterSanitizeShadowDOM", t, null);
            };
          return (
            (r.sanitize = function (e, n) {
              var i = void 0,
                l = void 0,
                s = void 0,
                u = void 0,
                d = void 0;
              if ((e || (e = "\x3c!--\x3e"), "string" != typeof e && !Ke(e))) {
                if ("function" != typeof e.toString)
                  throw b("toString is not a function");
                if ("string" != typeof (e = e.toString()))
                  throw b("dirty is not a string, aborting");
              }
              if (!r.isSupported) {
                if (
                  "object" === U(t.toStaticHTML) ||
                  "function" == typeof t.toStaticHTML
                ) {
                  if ("string" == typeof e) return t.toStaticHTML(e);
                  if (Ke(e)) return t.toStaticHTML(e.outerHTML);
                }
                return e;
              }
              if (
                (_e || je(n),
                (r.removed = []),
                "string" == typeof e && (Ne = !1),
                Ne)
              );
              else if (e instanceof c)
                (1 ===
                  (l = (i = Be("\x3c!----\x3e")).ownerDocument.importNode(
                    e,
                    !0
                  )).nodeType &&
                  "BODY" === l.nodeName) ||
                "HTML" === l.nodeName
                  ? (i = l)
                  : i.appendChild(l);
              else {
                if (!ke && !Ae && !Se && -1 === e.indexOf("<"))
                  return X && De ? X.createHTML(e) : e;
                if (!(i = Be(e))) return ke ? null : $;
              }
              i && xe && Pe(i.firstChild);
              for (var p = Ge(Ne ? e : i); (s = p.nextNode()); )
                (3 === s.nodeType && s === u) ||
                  Ye(s) ||
                  (s.content instanceof a && Ze(s.content), $e(s), (u = s));
              if (((u = null), Ne)) return e;
              if (ke) {
                if (we)
                  for (d = te.call(i.ownerDocument); i.firstChild; )
                    d.appendChild(i.firstChild);
                else d = i;
                return Ee && (d = re.call(o, d, !0)), d;
              }
              var f = Se ? i.outerHTML : i.innerHTML;
              return (
                Ae && ((f = y(f, ie, " ")), (f = y(f, ae, " "))),
                X && De ? X.createHTML(f) : f
              );
            }),
            (r.setConfig = function (e) {
              je(e), (_e = !0);
            }),
            (r.clearConfig = function () {
              (Ie = null), (_e = !1);
            }),
            (r.isValidAttribute = function (e, t, r) {
              Ie || je({});
              var n = f(e),
                o = f(t);
              return Xe(n, o, r);
            }),
            (r.addHook = function (e, t) {
              "function" == typeof t && ((oe[e] = oe[e] || []), p(oe[e], t));
            }),
            (r.removeHook = function (e) {
              oe[e] && d(oe[e]);
            }),
            (r.removeHooks = function (e) {
              oe[e] && (oe[e] = []);
            }),
            (r.removeAllHooks = function () {
              oe = {};
            }),
            r
          );
        })();
      })();
    },
  },
]);
