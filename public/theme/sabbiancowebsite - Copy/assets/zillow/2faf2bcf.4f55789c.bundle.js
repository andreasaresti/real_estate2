"use strict";
(self.webpackChunk_zillow_search_page_sub_app =
  self.webpackChunk_zillow_search_page_sub_app || []).push([
  [360],
  {
    79785: (e, n, t) => {
      t.d(n, { $0: () => ct, Bw: () => D, Rj: () => Mn, gz: () => Et });
      var r = t(94783),
        o = t(87462),
        i = t(45987),
        a = t(70885),
        l = t(80150),
        c = t.n(l),
        s = (t(45697), t(25325), t(65436)),
        u = t.n(s),
        d = t(700),
        m = t(68389),
        _ = t(30998),
        f = t.n(_),
        g = t(42982),
        h = t(1164),
        p = t(81880),
        S = t(13516),
        N = t(57557),
        v = t.n(N),
        E = t(41609),
        b = t.n(E),
        y = t(43916),
        R = t(97326),
        C = t(94578),
        x = t(71002),
        A = t(47069),
        I = "init-local-results",
        O = "freeform",
        T = 0.005,
        L = 42,
        w = {
          CLAIMED_HOME: "CLAIMED_HOME",
          CURRENT_LOCATION: "CURRENT_LOCATION",
          SAVED_SEARCH: "SAVED_SEARCH",
          SAVED_HOME: "SAVED_HOME",
          RECENT_SEARCH: "RECENT_SEARCH",
          REGION: "REGION",
          SEMANTIC: "SEMANTIC",
          ADDRESS: "ADDRESS",
          RAW_SEARCH: "RAW_SEARCH",
        },
        k = ["RAW_SEARCH", "REGION", "ADDRESS", "RECENT_SEARCH"],
        M = ["REGION", "ADDRESS", "RECENT_SEARCH"];
      function D(e, n, t, o, i, a) {
        if ((void 0 === i && (i = !1), void 0 === a && (a = !1), !e.category))
          throw new Error(
            "Search submit handler invoked without category property"
          );
        var l;
        switch (e.category) {
          case w.CLAIMED_HOME:
          case w.SAVED_SEARCH:
            l = e.url;
            break;
          case w.SAVED_HOME:
            l = "/savedhomes/";
            break;
          case w.SEMANTIC:
            l = (function (e) {
              var n,
                t = e.displayName,
                r = void 0 === t ? "" : t,
                o = e.regions,
                i = void 0 === o ? [] : o,
                a = e.filters,
                l = void 0 === a ? {} : a,
                c = {
                  filterState: Object.assign({}, l, {
                    sortSelection: {
                      value: (
                        null === (n = l.isForRent) || void 0 === n
                          ? void 0
                          : n.value
                      )
                        ? "priorityscore"
                        : "globalrelevanceex",
                    },
                  }),
                  regionSelection: i,
                  usersSearchTerm: r,
                };
              return (
                0 === i.length && delete c.regionSelection,
                "/homes/?searchQueryState=" +
                  encodeURIComponent(JSON.stringify(c))
              );
            })(e);
            break;
          default:
            l = (function (e, n, t, r) {
              void 0 === n && (n = {}), void 0 === r && (r = {});
              var o,
                i,
                a,
                l,
                c,
                s,
                u = e.category,
                d = e.displayName,
                m = n,
                _ = m.latitude,
                f = m.longitude,
                g =
                  ((i =
                    null == (o = null == e ? void 0 : e.data)
                      ? void 0
                      : o.addressType),
                  (a = null == o ? void 0 : o.lat),
                  (l = null == o ? void 0 : o.lng),
                  i && "community_address" === i && a && l),
                h = Object.assign({}, r),
                p = "/homes/";
              if (
                (g && (p = "/b/"),
                t && (p += t + "/"),
                "string" == typeof d &&
                  "CURRENT_LOCATION" !== u &&
                  (g
                    ? ((p +=
                        d
                          .split(/,/g)
                          .map(function (e) {
                            return e.trim().replace(/[;\\/ ]/g, "-");
                          })
                          .join("-") + "/"),
                      (p +=
                        (null == e || null === (c = e.data) || void 0 === c
                          ? void 0
                          : c.lat) +
                        "," +
                        (null == e || null === (s = e.data) || void 0 === s
                          ? void 0
                          : s.lng) +
                        "_ll/"))
                    : (p +=
                        encodeURIComponent(
                          String(d)
                            .replace(/-/g, ".dash.")
                            .replace(/[;\\/ ]/g, "-")
                            .replace(/%/g, "")
                        )
                          .replace(/%2C/g, ",")
                          .replace(/%23/g, ".num.") + "_rb/")),
                "CURRENT_LOCATION" === u)
              ) {
                if (void 0 === _ || void 0 === f)
                  return {
                    error: "No location provided for CURRENT_LOCATION search",
                  };
                h.userPosition = f + "," + _;
                var S = _ + T,
                  N = _ - T,
                  v = f + T,
                  E = f - T;
                (h.userPositionBounds = S + "," + v + "," + N + "," + E),
                  (h.currentLocationSearch = !0);
              }
              var b,
                y =
                  ((b = h),
                  Object.keys(b)
                    .map(function (e) {
                      return e + "=" + b[e];
                    })
                    .join("&"));
              return y && (p += "?" + y), p;
            })(e, n, t, o);
        }
        l && l.error
          ? console.error("Search handler failed. Reason: " + l.error)
          : "string" == typeof l && 0 === l.length
          ? console.error("Search handler did not produce a URL")
          : window && window.location
          ? ((function (e, n, t) {
              return (n || t ? M : k).includes(e.category);
            })(e, i, a) && r.RecentSearchClient.addToRecentSearches(e),
            (window.location.href = l))
          : console.error(
              "Failed to navigate to new search page. window.location undefined"
            );
      }
      var B = function (e) {
          var n = e.chosenSuggestion,
            t = e.chosenIndex;
          return n.category + " | " + t;
        },
        F = function (e) {
          var n,
            t = e.chosenSuggestion,
            r = e.chosenIndex,
            o = e.searchBoxValue;
          return (
            t.category +
            " | " +
            r +
            " | " +
            (null != o ? o : "") +
            " | " +
            (null !== (n = t.displayName) && void 0 !== n ? n : "")
          );
        },
        H = {
          SAVED_SEARCH: {
            getSearchBoxClickLabel: function (e) {
              var n,
                t = e.chosenSuggestion,
                r = e.chosenIndex;
              return (
                t.category +
                " | " +
                r +
                " | " +
                (null !== (n = t.notificationCount) && void 0 !== n ? n : "")
              );
            },
          },
          RECENT_SEARCH: {
            getSearchBoxClickLabel: function (e) {
              var n = e.chosenSuggestion,
                t = e.chosenIndex,
                r = e.allSuggestions,
                o = void 0 === r ? [] : r,
                i = function (e) {
                  return "RECENT_SEARCH" === e.category;
                },
                a = o.filter(i).length,
                l = t - f()(o, i);
              return n.category + " | " + t + " | " + l + " | " + a;
            },
          },
          CLAIMED_HOME: { getSearchBoxClickLabel: B },
          SAVED_HOME: { getSearchBoxClickLabel: B },
          CURRENT_LOCATION: { getSearchBoxClickLabel: B },
          REGION: { getSearchBoxClickLabel: F },
          SEMANTIC: { getSearchBoxClickLabel: F },
          ADDRESS: { getSearchBoxClickLabel: F },
          RAW_SEARCH: {
            getSearchBoxClickLabel: function (e) {
              var n,
                t = e.chosenSuggestion,
                r = e.searchBoxValue;
              return (
                t.category +
                " | " +
                (null != r ? r : "") +
                " | " +
                (null !== (n = t.displayName) && void 0 !== n ? n : "")
              );
            },
          },
        };
      function U() {
        var e = (0, p.Z)([
          "\n    fragment SemanticResultFields on SearchAssistanceSemanticResult {\n        regionIds\n        regionDisplayIds\n        queryResolutionStatus\n        filters {\n            amenitiesFilters\n            basementStatusType\n            baths {\n                min\n                max\n            }\n            beds {\n                min\n                max\n            }\n            excludeTypes\n            hoaFeesPerMonth {\n                min\n                max\n            }\n            homeType\n            keywords\n            listingStatusType\n            livingAreaSqft {\n                min\n                max\n            }\n            lotSizeSqft {\n                min\n                max\n            }\n            parkingSpots {\n                min\n                max\n            }\n            price {\n                min\n                max\n            }\n            searchRentalFilters {\n                monthlyPayment {\n                    min\n                    max\n                }\n                petsAllowed\n                rentalAvailabilityDate {\n                    min\n                    max\n                }\n            }\n            searchSaleFilters {\n                daysOnZillow {\n                    min\n                    max\n                }\n            }\n            showOnlyType\n            userSearchContext\n            view\n            yearBuilt {\n                min\n                max\n            }\n        }\n    }\n",
        ]);
        return (
          (U = function () {
            return e;
          }),
          e
        );
      }
      function P() {
        var e = (0, p.Z)([
          "\n    fragment RentalCommunityResultFields on SearchAssistanceRentalCommunityResult {\n        location {\n            latitude\n            longitude\n        }\n    }\n",
        ]);
        return (
          (P = function () {
            return e;
          }),
          e
        );
      }
      function G() {
        var e = (0, p.Z)([
          "\n    fragment RegionResultFields on SearchAssistanceRegionResult {\n        regionId\n        subType\n    }\n",
        ]);
        return (
          (G = function () {
            return e;
          }),
          e
        );
      }
      var Z = (0, S.ZP)(G()),
        q = (0, S.ZP)(P()),
        z = (0, S.ZP)(U());
      function j() {
        var e = (0, p.Z)([
          "\n    query getAutocompleteResults(\n        $query: String!\n        $queryOptions: SearchAssistanceQueryOptions\n        $resultType: [SearchAssistanceResultType]\n    ) {\n        searchAssistanceResult: zgsAutocompleteRequest(\n            query: $query\n            queryOptions: $queryOptions\n            resultType: $resultType\n        ) {\n            requestId\n            results {\n                __typename\n                id\n                ...RegionResultFields\n                ...SemanticResultFields\n                ...RentalCommunityResultFields\n            }\n        }\n    }\n    ",
          "\n    ",
          "\n    ",
          "\n",
        ]);
        return (
          (j = function () {
            return e;
          }),
          e
        );
      }
      var V,
        W = (0, S.ZP)(j(), Z, z, q);
      !(function (e) {
        (e.address = "ADDRESS"),
          (e.claimedHome = "CLAIMED_HOME"),
          (e.currentLocation = "CURRENT_LOCATION"),
          (e.rawSearch = "RAW_SEARCH"),
          (e.recentSearch = "RECENT_SEARCH"),
          (e.region = "REGION"),
          (e.savedHome = "SAVED_HOME"),
          (e.savedSearch = "SAVED_SEARCH"),
          (e.semantic = "SEMANTIC");
      })(V || (V = {}));
      var Y = function (e) {
          return e.category === V.recentSearch;
        },
        K = function (e) {
          return e.category === V.region;
        },
        $ = function (e) {
          return Y(e) && e.subCategory === V.region;
        },
        Q = function (e) {
          return e.category === V.semantic;
        },
        J = function (e) {
          return Y(e) && e.subCategory === V.semantic;
        },
        X = function (e) {
          var n;
          return (
            e.category === V.address &&
            "community_address" ===
              (null === (n = e.data) || void 0 === n ? void 0 : n.addressType)
          );
        },
        ee = {},
        ne = { category: w.CURRENT_LOCATION, displayName: "Current Location" },
        te = function (e) {
          var n, t, r, o, i, a;
          switch (e.__typename) {
            case "SearchAssistanceRegionResult":
              return {
                category: w.REGION,
                displayName: e.id,
                data: {
                  regionId: e.regionId,
                  regionType: e.subType.toLowerCase(),
                },
              };
            case "SearchAssistanceSemanticResult":
              return {
                category: w.SEMANTIC,
                displayName: e.id,
                data: {
                  regionIds:
                    null !==
                      (n =
                        null === (t = e.regionIds) || void 0 === t
                          ? void 0
                          : t.slice(0, 5)) && void 0 !== n
                      ? n
                      : null,
                  regionNames:
                    null !==
                      (r =
                        null === (o = e.regionDisplayIds) || void 0 === o
                          ? void 0
                          : o.slice(0, 5)) && void 0 !== r
                      ? r
                      : null,
                  filters: e.filters,
                  queryResolutionStatus: e.queryResolutionStatus,
                },
              };
            case "SearchAssistanceAddressResult":
              return { category: w.ADDRESS, displayName: e.id };
            case "SearchAssistanceRentalCommunityResult":
              return {
                category: w.ADDRESS,
                displayName: e.id,
                data: {
                  addressType: "community_address",
                  lat:
                    null === (i = e.location) || void 0 === i
                      ? void 0
                      : i.latitude,
                  lng:
                    null === (a = e.location) || void 0 === a
                      ? void 0
                      : a.longitude,
                },
              };
            default:
              return null;
          }
        },
        re = function (e, n) {
          return new Promise(function (t, r) {
            var o, i, a, l, c, s, u, d, m, _, f, g, h, p, S;
            (o = n.zgGraphClient),
              (i = n.graphqlQuery),
              (a = n.autocompleteConfig),
              (c = void 0 === (l = n.extraVariables) ? {} : l);
            var N = function (e) {
              try {
                return console.error(e), t({ suggestions: [] });
              } catch (e) {
                return r(e);
              }
            };
            try {
              return (
                (d = a.abKey),
                (m = a.userSearchContext),
                (_ = a.centroid),
                (f = a.fetchLimit),
                (h =
                  void 0 === (g = a.resultTypes)
                    ? ["REGIONS", "FORSALE", "RENTALS", "SOLD"]
                    : g),
                (p = Object.assign(
                  {
                    query: e,
                    queryOptions: {
                      maxResults: f,
                      userIdentity: { abKey: d },
                      userSearchContext: m,
                    },
                    resultType: h,
                  },
                  c
                )),
                (null == _ ? void 0 : _.lat) &&
                  (null == _ ? void 0 : _.lon) &&
                  (p.queryOptions.userLocation = {
                    latitude: _.lat,
                    longitude: _.lon,
                  }),
                Promise.resolve(o.query({ query: i, variables: p })).then(
                  function (e) {
                    try {
                      return (
                        (S = e.data),
                        t({
                          suggestions:
                            null == S ||
                            null === (s = S.searchAssistanceResult) ||
                            void 0 === s
                              ? void 0
                              : s.results.map(te).filter(Boolean),
                          requestId:
                            null == S ||
                            null === (u = S.searchAssistanceResult) ||
                            void 0 === u
                              ? void 0
                              : u.requestId,
                        })
                      );
                    } catch (e) {
                      return N(e);
                    }
                  },
                  N
                )
              );
            } catch (e) {
              N(e);
            }
          });
        };
      function oe(e, n, t, r, o, i) {
        return new Promise(function (l, c) {
          var s, u, d, m, _, f, p, S, N, v, E;
          return (
            (s = n.latitude),
            (u = n.longitude),
            void 0 === o && (o = 3),
            void 0 === i && (i = void 0),
            (d = t.disableCurrentLocation),
            (m = Object.assign({}, t)),
            void 0 !== s && void 0 !== u && (m.centroid = { lat: s, lon: u }),
            r === I && (ee.autocompleteManager = null),
            !m.centroid ||
              (m.centroid.lat === ee.latitude &&
                m.centroid.lon === ee.longitude) ||
              ((ee.latitude = m.centroid.lat),
              (ee.longitude = m.centroid.lon),
              (ee.autocompleteManager = null)),
            ee.autocompleteManager || (ee.autocompleteManager = new h.ZP(m)),
            (_ = e.length < o || "input-focused" === r || r === I),
            (f = function () {
              return (function (e, n, t, r) {
                return n
                  .fetchResults(
                    "",
                    [h.yq.RECENT_SEARCH, h.yq.SAVED_HOMES, h.yq.SAVED_SEARCH],
                    t
                  )
                  .then(function (e) {
                    return r ? e : [ne].concat((0, g.Z)(e));
                  });
              })(0, ee.autocompleteManager, m, d);
            }),
            i
              ? ((p = Object.assign({}, m, { fetchLimit: _ ? 3 : 10 })),
                Promise.resolve(
                  Promise.all([
                    re(_ ? "" : e, {
                      zgGraphClient: i,
                      graphqlQuery: W,
                      autocompleteConfig: p,
                    }),
                    _ ? f() : Promise.resolve([]),
                  ])
                ).then(function (e) {
                  try {
                    return (
                      (S = e),
                      (N = (0, a.Z)(S, 2)),
                      (v = N[0]),
                      (E = N[1]),
                      l([].concat((0, g.Z)(E), (0, g.Z)(v.suggestions)))
                    );
                  } catch (e) {
                    return c(e);
                  }
                }, c))
              : l(
                  _
                    ? f()
                    : (function (e, n, t) {
                        return n.fetchResults(
                          e,
                          [h.yq.REGION, h.yq.ADDRESS],
                          t
                        );
                      })(e, ee.autocompleteManager, m)
                )
          );
        });
      }
      var ie, ae, le, ce, se, ue, de;
      function me(e, n, t) {
        void 0 === n && (n = !1), void 0 === t && (t = !1);
        var r = e.filter(function (e) {
            return e.category === V.currentLocation;
          }),
          o = e.filter(function (e) {
            return e.category === V.savedSearch;
          });
        o.splice(2);
        var i = e.filter(function (e) {
          return e.category === V.claimedHome;
        });
        i.splice(1);
        var a = e.filter(function (e) {
          return e.category === V.savedHome;
        });
        a.splice(1);
        var l = (function (e, n, t) {
          return e.filter(function (e) {
            var r = e.category,
              o = e.subCategory;
            return (
              r === w.RECENT_SEARCH &&
              (function (e) {
                return t
                  ? [w.SEMANTIC, w.REGION, w.ADDRESS].includes(e)
                  : n
                  ? [w.REGION, w.ADDRESS].includes(e)
                  : null === e || ![w.SEMANTIC, w.CURRENT_LOCATION].includes(e);
              })(o)
            );
          });
        })(e, n, t);
        l.splice(3);
        var c = e.filter(function (e) {
          return [V.region, V.address, V.semantic].indexOf(e.category) >= 0;
        });
        return c.splice(10), [].concat(r, o, i, a, l, c);
      }
      function _e(e) {
        var n = e.category,
          t = e.displayName;
        return [
          V.region,
          V.semantic,
          V.address,
          V.recentSearch,
          V.rawSearch,
        ].indexOf(n) >= 0
          ? t
          : "";
      }
      var fe = "SELECT_SEARCH_SUGGESTION",
        ge = "RAW_SEARCH",
        he = "SELECT_RECENT_SEARCH",
        pe = "REMOVE_MULTIREGION",
        Se = "CURRENT_LOCATION_SEARCH",
        Ne = "REMOVE_ALL_MULTIREGION",
        ve = "DISMISS_SEARCH",
        Ee = "QUERY_UNDERSTANDING_RESPONSE",
        be = "AUTOCOMPLETE_RESPONSE",
        ye =
          (((ie = {
            SELECT_SEARCH_SUGGESTION: "74",
            RAW_SEARCH: "73",
            SELECT_RECENT_SEARCH: "1032",
            REMOVE_MULTIREGION: "1069",
            CURRENT_LOCATION_SEARCH: "1079",
            REMOVE_ALL_MULTIREGION: "1082",
            ADD_NTH_REGION: "1081",
            DISMISS_SEARCH: "1080",
          })[Ee] = "3875"),
          (ie[be] = "3875"),
          ie),
        Re =
          (((ae = {
            SELECT_SEARCH_SUGGESTION: "16",
            RAW_SEARCH: "16",
            SELECT_RECENT_SEARCH: "1",
            REMOVE_MULTIREGION: "16",
            CURRENT_LOCATION_SEARCH: "16",
            REMOVE_ALL_MULTIREGION: "16",
            ADD_NTH_REGION: "16",
            DISMISS_SEARCH: "16",
          })[Ee] = "16"),
          (ae[be] = "16"),
          ae),
        Ce =
          (((le = {
            SELECT_SEARCH_SUGGESTION: "interaction",
            RAW_SEARCH: "interaction",
            SELECT_RECENT_SEARCH: "interaction",
            REMOVE_MULTIREGION: "interaction",
            CURRENT_LOCATION_SEARCH: "interaction",
            REMOVE_ALL_MULTIREGION: "interaction",
            ADD_NTH_REGION: "interaction",
            DISMISS_SEARCH: "interaction",
          })[Ee] = "interaction"),
          (le[be] = "interaction"),
          le),
        xe =
          (((ce = {
            SELECT_SEARCH_SUGGESTION: "search_field",
            RAW_SEARCH: "search_field",
            SELECT_RECENT_SEARCH: "search_field",
            REMOVE_MULTIREGION: "search_field",
            CURRENT_LOCATION_SEARCH: "search_box",
            REMOVE_ALL_MULTIREGION: "search_box",
            ADD_NTH_REGION: "search_box",
            DISMISS_SEARCH: "no_trigger_object",
          })[Ee] = "search_field"),
          (ce[be] = "search_field"),
          ce),
        Ae =
          (((se = {
            SELECT_SEARCH_SUGGESTION: "select_search_suggestion",
            RAW_SEARCH: "manual_search_selection",
            SELECT_RECENT_SEARCH: "button_to_select_recent_search",
            REMOVE_MULTIREGION: "button_to_remove_multiregion",
            CURRENT_LOCATION_SEARCH: "current_location",
            REMOVE_ALL_MULTIREGION: "button_remove_regions",
            ADD_NTH_REGION: "add_region",
            DISMISS_SEARCH: "button_to_dismiss_search_dropdown",
          })[Ee] = "manual_search_selection"),
          (se[be] = "select_search_suggestion"),
          se),
        Ie =
          (((ue = {
            SELECT_SEARCH_SUGGESTION: "search_home",
            RAW_SEARCH: "search_home",
            SELECT_RECENT_SEARCH: "search_home",
            REMOVE_MULTIREGION: "change_search_filter",
            CURRENT_LOCATION_SEARCH: "search_home",
            REMOVE_ALL_MULTIREGION: "search_home",
            ADD_NTH_REGION: "search_home",
            DISMISS_SEARCH: "dismiss_search",
          })[Ee] = "search_home"),
          (ue[be] = "search_home"),
          ue),
        Oe =
          (((de = {
            SELECT_SEARCH_SUGGESTION: ["search"],
            RAW_SEARCH: ["search"],
            SELECT_RECENT_SEARCH: ["search"],
            REMOVE_MULTIREGION: ["search"],
            CURRENT_LOCATION_SEARCH: ["search"],
            REMOVE_ALL_MULTIREGION: ["search"],
            ADD_NTH_REGION: ["search"],
            DISMISS_SEARCH: ["search"],
          })[Ee] = ["search"]),
          (de[be] = ["search"]),
          de),
        Te = function (e) {
          return {
            event_template_id: Re[e],
            event_template_version_id: "1",
            event_type_id: ye[e],
            event_type_version_id: "1",
            event_client_start_dtm: new Date().toISOString(),
          };
        },
        Le = function (e) {
          return {
            trigger_location_nm: "search_results",
            trigger_type_nm: Ce[e],
            trigger_object_nm: xe[e],
            trigger_source_nm: Ae[e],
          };
        },
        we = function (e) {
          return { semantic_event_nm: Ie[e], topic_tag_txt: Oe[e] };
        },
        ke = function (e, n) {
          var t = (null == n ? void 0 : n.search_filter) || {};
          if (!e || b()(e)) return t;
          var r,
            o = e.displayName,
            i = e.data,
            a = e.metadata;
          return (
            (t.request_id = null == a ? void 0 : a.requestId),
            (t.interaction_id = null == a ? void 0 : a.interactionId),
            (t.search_type_txt = (function (e) {
              return K(e) || $(e)
                ? "REGION"
                : Q(e) || J(e)
                ? "NATURAL"
                : (function (e) {
                    var n;
                    return (
                      e.category === V.address &&
                      "community_address" !==
                        (null === (n = e.data) || void 0 === n
                          ? void 0
                          : n.addressType)
                    );
                  })(e) ||
                  (function (e) {
                    var n;
                    return (
                      Y(e) &&
                      e.subCategory === V.address &&
                      "community_address" !==
                        (null === (n = e.data) || void 0 === n
                          ? void 0
                          : n.addressType)
                    );
                  })(e)
                ? "ADDRESS"
                : X(e) || X(e)
                ? "RENTAL_COMMUNITY"
                : null;
            })(e)),
            (t.search_selection_type_txt =
              null == a ? void 0 : a.selectionType),
            (t.selection_index_nb = null == a ? void 0 : a.selectionIndex),
            (t.understood_query_txt = o),
            (t.user_search_terms_txt = (null == a ? void 0 : a.rawValue)
              ? [null == a ? void 0 : a.rawValue]
              : []),
            Q(e) || J(e)
              ? ((t.query_resolution_status_txt = i.queryResolutionStatus),
                (t.changed_filter_fields =
                  null !== (r = null == a ? void 0 : a.changedFilterFields) &&
                  void 0 !== r
                    ? r
                    : []))
              : (t.query_resolution_status_txt = "FULL_RESOLUTION"),
            t
          );
        },
        Me = function (e, n) {
          var t,
            r = n.search_map || {};
          return (
            !e ||
              b()(e) ||
              ((K(e) || $(e)) && (r.selected_regions_txt = [e.displayName]),
              (Q(e) || J(e)) &&
                (null === (t = e.data) || void 0 === t
                  ? void 0
                  : t.regionNames) &&
                (r.selected_regions_txt = (0, g.Z)(e.data.regionNames))),
            r
          );
        },
        De = { name: "city", id: 6 },
        Be = { name: "zipcode", id: 7 },
        Fe = { name: "neighborhood", id: 8 },
        He = { name: "state", id: 2 },
        Ue = function (e) {
          return new Promise(function (n, t) {
            var r, o, i, a, l, c, s, u, d, m, _, f, h, p, S, N, E, R, C, x, A;
            if (
              ((r = e.trackEventProp),
              (o = e.autocompleteResult),
              (i = void 0 === o ? null : o),
              (a = e.regionIndex),
              (l = void 0 === a ? null : a),
              (c = e.isMultiregionSearch),
              (s = void 0 !== c && c),
              (u = e.isRegionInMultiRegionSelection),
              (d = void 0 !== u && u),
              (m = e.eventName),
              (_ = void 0 === m ? "" : m),
              (f = e.clickstreamTriggerOverrides),
              (h = void 0 === f ? null : f),
              (p = e.clickstreamDecorators),
              (S = void 0 === p ? null : p),
              (E = void 0 === (N = e.screenName) ? "sxp" : N),
              (R = e.allowEmptyInitialClickstreamBlocks),
              (C = void 0 !== R && R),
              (x = {}),
              !(0, y.isInitialized)())
            )
              return (0, y.track)(r), L.call(this);
            var I = function (e) {
                return function (n) {
                  try {
                    return (
                      A && !b()(A) && (x = A),
                      Object.keys(x).length || C
                        ? ((x =
                            _ === pe || _ === Ne
                              ? (function (e, n, t) {
                                  var r = n.search_filter || {},
                                    o = n.search_map || {},
                                    i = (0, g.Z)(r.user_search_terms_txt),
                                    a = (0, g.Z)(r.custom_region_ids),
                                    l = (0, g.Z)(r.region_types),
                                    c = (0, g.Z)(o.selected_regions_txt);
                                  switch (e) {
                                    case pe:
                                      var s;
                                      return (
                                        i.splice(t - 1, 1),
                                        a.splice(t - 1, 1),
                                        l.splice(t - 1, 1),
                                        c.splice(t - 1, 1),
                                        (r.user_search_terms_txt = i),
                                        (r.custom_region_ids = a),
                                        (r.region_types = l),
                                        (o.selected_regions_txt = c),
                                        (null === (s = r.custom_region_ids) ||
                                        void 0 === s
                                          ? void 0
                                          : s.length) ||
                                          ((r.city_nm = null),
                                          (r.city_id = null),
                                          (r.state_id = null),
                                          (r.state_cd = null),
                                          (r.zip_cd = null),
                                          (r.neighborhood_nm = null),
                                          (r.neighborhood_id = null)),
                                        Object.assign({}, n, {
                                          search_filter: r,
                                          search_map: o,
                                          semantic: we(pe),
                                          clickstream_trigger: Le(pe),
                                          envelope: Te(pe),
                                        })
                                      );
                                    case Ne:
                                      return (
                                        i.splice(0),
                                        a.splice(0),
                                        l.splice(0),
                                        c.splice(0),
                                        (r.user_search_terms_txt = i),
                                        (r.custom_region_ids = a),
                                        (r.region_types = l),
                                        (r.city_nm = null),
                                        (r.city_id = null),
                                        (r.state_id = null),
                                        (r.state_cd = null),
                                        (r.zip_cd = null),
                                        (r.neighborhood_nm = null),
                                        (r.neighborhood_id = null),
                                        (o.selected_regions_txt = c),
                                        Object.assign({}, n, {
                                          search_filter: r,
                                          search_map: o,
                                          semantic: we(Ne),
                                          clickstream_trigger: Le(Ne),
                                          envelope: Te(Ne),
                                        })
                                      );
                                    default:
                                      return null;
                                  }
                                })(_, x, l)
                              : (function (e, n, t, r) {
                                  void 0 === r && (r = !1);
                                  var o,
                                    i = null,
                                    a = n.search_filter || {},
                                    l = n.search_map || {},
                                    c = null,
                                    s = null,
                                    u = (function (e, n) {
                                      switch (null == e ? void 0 : e.category) {
                                        case "RECENT_SEARCH":
                                          var t = v()(n, [
                                            "search_map",
                                            "search_result",
                                          ]);
                                          return Object.assign({}, t, {
                                            semantic: we(he),
                                            clickstream_trigger: Le(he),
                                            envelope: Te(he),
                                          });
                                        case "RAW_SEARCH":
                                          return Object.assign({}, n, {
                                            semantic: we(ge),
                                            clickstream_trigger: Le(ge),
                                            envelope: Te(ge),
                                          });
                                        case "CURRENT_LOCATION":
                                          return Object.assign({}, n, {
                                            semantic: we(Se),
                                            clickstream_trigger: Le(Se),
                                            envelope: Te(Se),
                                          });
                                        default:
                                          return Object.assign({}, n, {
                                            semantic: we(fe),
                                            clickstream_trigger: Le(fe),
                                            envelope: Te(fe),
                                          });
                                      }
                                    })(e, n);
                                  if (
                                    e &&
                                    (null == e ? void 0 : e.displayName)
                                  ) {
                                    if (
                                      ((i = (o =
                                        null == e
                                          ? void 0
                                          : e.displayName).includes(",")
                                        ? o.split(",")[0]
                                        : o),
                                      ((null == a
                                        ? void 0
                                        : a.custom_region_ids) &&
                                        (null == a
                                          ? void 0
                                          : a.region_types)) ||
                                        1 !==
                                          (null == a
                                            ? void 0
                                            : a.user_search_terms_txt.length) ||
                                        (a.user_search_terms_txt = []),
                                      null == e ? void 0 : e.data)
                                    ) {
                                      var d,
                                        m,
                                        _ = De,
                                        f = Be,
                                        h = Fe,
                                        p = He;
                                      (c =
                                        null == e ||
                                        null === (d = e.data) ||
                                        void 0 === d
                                          ? void 0
                                          : d.regionId),
                                        (s =
                                          null == e ||
                                          null === (m = e.data) ||
                                          void 0 === m
                                            ? void 0
                                            : m.regionType),
                                        (a.city_nm = _.name === s ? i : null),
                                        (a.city_id = _.name === s ? c : null),
                                        (a.state_cd = p.name === s ? i : null),
                                        (a.state_id = p.name === s ? c : null),
                                        (a.zip_cd = f.name === s ? i : null),
                                        (a.neighborhood_nm =
                                          h.name === s ? i : null),
                                        (a.neighborhood_id =
                                          h.name === s ? c : null);
                                    }
                                    if ("CURRENT_LOCATION" === e.category)
                                      (a.user_search_terms_txt = [i]),
                                        (a.custom_region_ids = []),
                                        (a.region_types = []),
                                        (a.city_id = null),
                                        (a.city_nm = null),
                                        (a.neighborhood_id = null),
                                        (a.neighborhood_nm = null),
                                        (a.state_cd = null),
                                        (a.state_id = null),
                                        (a.zip_cd = null),
                                        (l.selected_regions_txt = []);
                                    else if (t) {
                                      if (r) return Object.assign({}, u);
                                      (a.user_search_terms_txt = [].concat(
                                        (0, g.Z)(a.user_search_terms_txt),
                                        [i]
                                      )),
                                        a.custom_region_ids ||
                                          (a.custom_region_ids = []),
                                        (a.custom_region_ids = [].concat(
                                          (0, g.Z)(a.custom_region_ids),
                                          [c]
                                        )),
                                        a.region_types || (a.region_types = []),
                                        (a.region_types = [].concat(
                                          (0, g.Z)(a.region_types),
                                          [s]
                                        )),
                                        "RECENT_SEARCH" === e.category ||
                                          ("REGION" !== e.category &&
                                            "REGION" !==
                                              (null == e
                                                ? void 0
                                                : e.subCategory)) ||
                                          (l.selected_regions_txt = [].concat(
                                            (0, g.Z)(l.selected_regions_txt),
                                            [i]
                                          ));
                                    } else
                                      (a.user_search_terms_txt = [i]),
                                        (a.custom_region_ids = [c]),
                                        (a.region_types = [s]),
                                        "RECENT_SEARCH" === e.category ||
                                          ("REGION" !== e.category &&
                                            "REGION" !==
                                              (null == e
                                                ? void 0
                                                : e.subCategory)) ||
                                          (l.selected_regions_txt = [i]);
                                    return "RECENT_SEARCH" !== e.category
                                      ? Object.assign({}, u, {
                                          search_filter: a,
                                          search_map: l,
                                        })
                                      : Object.assign({}, u, {
                                          search_filter: a,
                                        });
                                  }
                                  return null;
                                })(i, x, s, d)),
                          h &&
                            (x = Object.assign({}, x, {
                              clickstream_trigger: Object.assign(
                                {},
                                x.clickstream_trigger,
                                h
                              ),
                            })),
                          S && (x = Object.assign({}, x, S)),
                          (0, y.track)(r, { newLaneEvent: x }))
                        : (0, y.track)(r),
                      e && e.call(this, n)
                    );
                  } catch (e) {
                    return t(e);
                  }
                }.bind(this);
              }.bind(this),
              O = function () {
                try {
                  return L.call(this);
                } catch (e) {
                  return t(e);
                }
              }.bind(this),
              T = function (e) {
                try {
                  throw e;
                } catch (e) {
                  return I(t)(e);
                }
              };
            try {
              if (E)
                return Promise.resolve(
                  y.datalayer.getAll({ screenName: E })
                ).then(
                  function (e) {
                    try {
                      return (A = e), w.call(this);
                    } catch (e) {
                      return T(e);
                    }
                  }.bind(this),
                  T
                );
              function w() {
                return I(O)();
              }
              return w.call(this);
            } catch (k) {
              T(k);
            }
            function L() {
              return n();
            }
          });
        },
        Pe = function (e) {
          return new Promise(function (n, t) {
            var r, o, i, a, l, c, s, u, d, m, _, f, g;
            if (
              ((r = e.eventName),
              (o = e.suggestion),
              (i = void 0 === o ? null : o),
              (a = e.clickstreamTriggerOverrides),
              (l = void 0 === a ? null : a),
              (c = e.clickstreamDecorators),
              (s = void 0 === c ? null : c),
              (d = void 0 === (u = e.screenName) ? "sxp" : u),
              (m = e.allowEmptyInitialClickstreamBlocks),
              (_ = void 0 !== m && m),
              (f = {}),
              (0, y.isInitialized)())
            ) {
              var h = function (e) {
                  return function (n) {
                    try {
                      return (
                        g && !b()(g) && (f = g),
                        (Object.keys(f).length || _) &&
                          ((f = Object.assign({}, f, {
                            semantic: we(r),
                            clickstream_trigger: Le(r),
                            envelope: Te(r),
                          })),
                          !i ||
                            (r !== Ee && r !== be) ||
                            (f = Object.assign({}, f, {
                              search_filter: ke(i, f),
                              search_map: Me(i, f),
                            })),
                          l &&
                            (f = Object.assign({}, f, {
                              clickstream_trigger: Object.assign(
                                {},
                                f.clickstream_trigger,
                                l
                              ),
                            })),
                          s && (f = Object.assign({}, f, s)),
                          (0, y.event)(f)),
                        e && e.call(this, n)
                      );
                    } catch (e) {
                      return t(e);
                    }
                  }.bind(this);
                }.bind(this),
                p = function () {
                  try {
                    return N.call(this);
                  } catch (e) {
                    return t(e);
                  }
                }.bind(this),
                S = function (e) {
                  try {
                    throw e;
                  } catch (e) {
                    return h(t)(e);
                  }
                };
              try {
                if (d)
                  return Promise.resolve(
                    y.datalayer.getAll({ screenName: d })
                  ).then(
                    function (e) {
                      try {
                        return (g = e), v.call(this);
                      } catch (e) {
                        return S(e);
                      }
                    }.bind(this),
                    S
                  );
                function v() {
                  return h(p)();
                }
                return v.call(this);
              } catch (E) {
                S(E);
              }
            }
            function N() {
              return n();
            }
            return N.call(this);
          });
        },
        Ge = {
          DESKTOP: {
            placeholderText:
              "Enter an address, neighborhood, city, or ZIP code",
          },
          DESKTOP_RESULTS_PAGE: {
            placeholderText: "Address, neighborhood, or ZIP",
          },
          MOBILE: {
            placeholderText: "Address, neighborhood, city, ZIP",
            supportsLocationIcon: !0,
          },
          MOBILE_RESULTS_PAGE: {
            placeholderText: "Address, neighborhood, city, ZIP",
            supportsLocationIcon: !0,
          },
        },
        Ze =
          "/builds/zillow/searchxp/static-search-box/src/LocationAccessButton.jsx",
        qe = (function (e) {
          function n(n) {
            var t;
            return (
              ((t = e.call(this, n) || this)._requestLocationAccess =
                t._requestLocationAccess.bind((0, R.Z)(t))),
              t
            );
          }
          (0, C.Z)(n, e);
          var r = n.prototype;
          return (
            (r._requestLocationAccess = function (e) {
              e.preventDefault(),
                t.g.navigator && t.g.navigator.geolocation
                  ? t.g.navigator.geolocation.getCurrentPosition(
                      this.props.onLocationAccessGranted,
                      this.props.onLocationAccessFailed
                    )
                  : console.warn("No location object available");
            }),
            (r.render = function () {
              var e = this,
                n = this.props,
                t = n.isCurrentLocationSearch,
                r = n.isUserPositionInMapBounds,
                i = n.onReCenter,
                a = n.useConstellationComponents,
                l = n.enableNaturalLanguageSearch,
                s = function (n) {
                  return l
                    ? c().createElement(
                        m.IconLocationArrowOutline,
                        (0, o.Z)({}, n, {
                          __self: e,
                          __source: {
                            fileName: Ze,
                            lineNumber: 43,
                            columnNumber: 17,
                          },
                        })
                      )
                    : c().createElement(
                        m.IconLocationOutline,
                        (0, o.Z)({}, n, {
                          __self: e,
                          __source: {
                            fileName: Ze,
                            lineNumber: 45,
                            columnNumber: 17,
                          },
                        })
                      );
                },
                u = function (n) {
                  return l
                    ? c().createElement(
                        m.IconLocationArrow,
                        (0, o.Z)({}, n, {
                          __self: e,
                          __source: {
                            fileName: Ze,
                            lineNumber: 49,
                            columnNumber: 17,
                          },
                        })
                      )
                    : c().createElement(
                        m.IconLocation,
                        (0, o.Z)({}, n, {
                          __self: e,
                          __source: {
                            fileName: Ze,
                            lineNumber: 51,
                            columnNumber: 17,
                          },
                        })
                      );
                };
              return a
                ? c().createElement(m.IconButton, {
                    title: "Use your location",
                    onMouseDown: t ? i : this._requestLocationAccess,
                    icon:
                      t && !r
                        ? c().createElement(s, {
                            __self: this,
                            __source: {
                              fileName: Ze,
                              lineNumber: 63,
                              columnNumber: 29,
                            },
                          })
                        : c().createElement(u, {
                            __self: this,
                            __source: {
                              fileName: Ze,
                              lineNumber: 65,
                              columnNumber: 29,
                            },
                          }),
                    size: m.BUTTON_SIZES.sm,
                    type: "button",
                    bare: !0,
                    __self: this,
                    __source: {
                      fileName: Ze,
                      lineNumber: 56,
                      columnNumber: 17,
                    },
                  })
                : c().createElement(
                    "button",
                    {
                      type: "button",
                      className: "locationBtn searchBtn",
                      onMouseDown: t ? i : this._requestLocationAccess,
                      onClick: function (e) {
                        return e.preventDefault();
                      },
                      "aria-label": "Use your location",
                      __self: this,
                      __source: {
                        fileName: Ze,
                        lineNumber: 81,
                        columnNumber: 13,
                      },
                    },
                    t && !r
                      ? c().createElement(s, {
                          className: "icon-location-outline",
                          "aria-hidden": "true",
                          __self: this,
                          __source: {
                            fileName: Ze,
                            lineNumber: 89,
                            columnNumber: 21,
                          },
                        })
                      : c().createElement(u, {
                          className: "icon-location",
                          "aria-hidden": "true",
                          __self: this,
                          __source: {
                            fileName: Ze,
                            lineNumber: 91,
                            columnNumber: 21,
                          },
                        })
                  );
            }),
            n
          );
        })(l.Component);
      (qe.propTypes = {}),
        (qe.defaultProps = {
          onLocationAccessGranted: function () {},
          onLocationAccessFailed: function () {},
          isUserPositionInMapBounds: !0,
          onReCenter: function () {},
          isCurrentLocationSearch: !1,
          useConstellationComponents: !1,
        });
      var ze,
        je = qe,
        Ve = [
          "FSBA",
          "FSBO",
          "AUCTION",
          "COMINGSOON",
          "FORECLOSURE",
          "NEWCONSTRUCTION",
        ],
        We = {
          SINGLE_STORY: "singleStory",
          INCOME_RESTRICTED: "onlyRentalIncomeRestricted",
          INUNIT_LAUNDRY: "onlyRentalInUnitLaundry",
          ASSIGNED_PARKING: "onlyRentalParkingAvailable",
          OPEN_HOUSES: "isOpenHousesOnly",
          WATER_FRONT: "isWaterfront",
          AIRCONDITIONING: "hasAirConditioning",
          POOL: "hasPool",
          ACCEPTS_RENTAL_APPLICATIONS: "onlyRentalAcceptsApplications",
          GARAGE: "hasGarage",
          APPROVED_VIRTUALTOUR: "is3dHome",
        },
        Ye = {
          FINISHED: "isBasementFinished",
          UNFINISHED: "isBasementUnfinished",
        },
        Ke = {
          TOWNHOME: "isTownhouse",
          LAND: "isLotLand",
          MANUFACTURED: "isManufactured",
          MULTIFAMILY: "isMultiFamily",
          APARTMENT: "isApartment",
          CONDO: "isCondo",
          SINGLEFAMILY: "isSingleFamily",
        },
        $e = {
          RECENTLY_SOLD: "isRecentlySold",
          SOLD: "isRecentlySold",
          PREFORECLOSURE: "isPreMarketPreForeclosure",
          FORECLOSED: "isPreMarketForeclosure",
          FOR_RENT: "isForRent",
          FSBA: "isForSaleByAgent",
          FSBO: "isForSaleByOwner",
          AUCTION: "isAuction",
          COMINGSOON: "isComingSoon",
          FORECLOSURE: "isForSaleForeclosure",
          NEWCONSTRUCTION: "isNewConstruction",
        },
        Qe = {
          LARGEDOGS: "onlyRentalLargeDogsAllowed",
          SMALLDOGS: "onlyRentalSmallDogsAllowed",
          CATS: "onlyRentalCatsAllowed",
        },
        Je = {
          CITY: "isCityView",
          PARK: "isParkView",
          MOUNTAIN: "isMountainView",
          WATER: "isWaterView",
        },
        Xe =
          (((ze = {})[1] = "1"),
          (ze[7] = "7"),
          (ze[14] = "14"),
          (ze[30] = "30"),
          (ze[90] = "90"),
          (ze[182] = "6m"),
          (ze[365] = "12m"),
          (ze[730] = "24m"),
          (ze[1095] = "36m"),
          ze),
        en = 217800,
        nn = 435600,
        tn = 871200,
        rn = 2178e3,
        on = {
          SINGLE_STORY: "single_story_ind",
          INCOME_RESTRICTED: "rental_income_restricted_ind",
          INUNIT_LAUNDRY: "rental_in_unit_laundry_ind",
          ASSIGNED_PARKING: "rental_parking_available_ind",
          OPEN_HOUSES: "only_open_house_ind",
          WATER_FRONT: "waterfront_ind",
          AIRCONDITIONING: "ac_ind",
          POOL: "pool_ind",
          ACCEPTS_RENTAL_APPLICATIONS: "rental_accepts_application_ind",
          GARAGE: "garage_ind",
          APPROVED_VIRTUALTOUR: "tour_3d_ind",
        },
        an = {
          FINISHED: "finished_basement_ind",
          UNFINISHED: "unfinished_basement_ind",
        },
        ln = {
          TOWNHOME: "townhouse_ind",
          LAND: "lot_land_ind",
          MANUFACTURED: "manufactured_ind",
          MULTIFAMILY: "multi_family_ind",
          APARTMENT: "apt_ind",
          CONDO: "condo_ind",
          SINGLEFAMILY: "single_family_ind",
        },
        cn = {
          RECENTLY_SOLD: "recently_sold_ind",
          SOLD: "recently_sold_ind",
          PREFORECLOSURE: "preforclosure_ind",
          FORECLOSED: "premarket_foreclosure_ind",
          FOR_RENT: "for_rent_ind",
          FSBA: "fsba_ind",
          FSBO: "fsbo_ind",
          AUCTION: "auction_ind",
          COMINGSOON: "coming_soon_ind",
          FORECLOSURE: "forclosure_ind",
          NEWCONSTRUCTION: "new_construction_ind",
        },
        sn = {
          LARGEDOGS: "rent_large_pets_allowed_ind",
          SMALLDOGS: "rental_small_pets_allowed_ind",
          CATS: "rental_cats_allowed_ind",
        },
        un = {
          CITY: "city_view_ind",
          PARK: "park_view_ind",
          MOUNTAIN: "mountain_view_ind",
          WATER: "water_view_ind",
        },
        dn = function (e, n, t) {
          return ("up" === t ? Math.ceil : Math.floor)(e / n) * n;
        },
        mn = function (e, n) {
          var t;
          return null !==
            (t = n.find(function (n) {
              var t = (0, a.Z)(n, 2),
                r = t[0],
                o = t[1];
              return r <= e && e <= o;
            })) && void 0 !== t
            ? t
            : [];
        },
        _n = function (e, n, t) {
          var r = n[0][0],
            o = n[n.length - 1][1];
          if (e < r) return "min" === t ? null : r;
          if (e > o) return "min" === t ? o : null;
          var i = mn(e, n),
            l = (0, a.Z)(i, 2),
            c = l[0],
            s = l[1];
          return e === c || e === s ? e : "min" === t ? c : s;
        },
        fn = function (e, n) {
          var t, r;
          if (!e) return { filterState: {}, clickstreamFilterFields: [] };
          var o = e.baths,
            i = e.beds,
            l = e.hoaFeesPerMonth,
            c = e.livingAreaSqft,
            s = e.lotSizeSqft,
            u = e.parkingSpots,
            d = e.price,
            m = e.yearBuilt,
            _ = e.searchRentalFilters,
            f = e.searchSaleFilters,
            h = e.keywords,
            p = e.showOnlyType,
            S = e.basementStatusType,
            N = e.homeType,
            v = e.listingStatusType,
            E = e.view,
            b = e.excludeTypes,
            y = [],
            R = [],
            C = [];
          if (
            (n && C.push("custom_region_ids"),
            (null == o ? void 0 : o.min) &&
              (y.push({ filterName: "baths", min: o.min, max: null }),
              C.push("bath_cnt_txt")),
            i)
          ) {
            var x = i.min,
              A = i.max;
            y.push({ filterName: "beds", min: x, max: A }),
              x && C.push("bed_min_cnt_txt"),
              A && C.push("bed_max_cnt_txt");
          }
          if ("number" == typeof (null == l ? void 0 : l.max)) {
            var I =
              l.max > 1e3
                ? null
                : l.max < 75
                ? dn(l.max, 50, "up")
                : dn(l.max, 100, "up");
            y.push({ filterName: "hoa", min: null, max: I }),
              C.push("hoa_max_amt");
          }
          if (c) {
            var O = c.min,
              T = c.max,
              L = [
                [500, 750],
                [750, 1e3],
                [1e3, 1250],
                [1250, 1500],
                [1500, 1750],
                [1750, 2e3],
                [2e3, 2250],
                [2250, 2500],
                [2500, 2750],
                [2750, 3e3],
                [3e3, 3500],
                [3500, 4e3],
                [4e3, 5e3],
                [5e3, 7500],
              ];
            y.push({
              filterName: "sqft",
              min: O ? _n(O, L, "min") : null,
              max: T ? _n(T, L, "max") : null,
            }),
              O && C.push("sqft_min_nb"),
              T && C.push("sqft_max_nb");
          }
          if (s) {
            var w = s.min,
              k = s.max,
              M = [
                [1e3, 2e3],
                [2e3, 3e3],
                [4e3, 5e3],
                [5e3, 7500],
                [7500, 10890],
                [10890, 21780],
                [21780, 43560],
                [43560, 87120],
                [87120, en],
                [en, nn],
                [nn, tn],
                [tn, rn],
                [rn, 4356e3],
              ];
            y.push({
              filterName: "lotSize",
              min: w ? _n(w, M, "min") : null,
              max: k ? _n(k, M, "max") : null,
            }),
              w && C.push("lot_size_sqft_min_nb"),
              k && C.push("lot_size_sqft_max_nb");
          }
          if (
            ((null == u ? void 0 : u.min) &&
              (y.push({ filterName: "parkingSpots", min: u.min, max: null }),
              C.push("parking_spot_txt")),
            d)
          ) {
            var D = d.min,
              B = d.max;
            y.push({ filterName: "price", min: D, max: B }),
              D && C.push("price_range_min_amt"),
              B && C.push("price_range_max_amt");
          }
          if (m) {
            var F = m.min,
              H = m.max;
            y.push({ filterName: "built", min: F, max: H }),
              F && C.push("built_year_min_nb"),
              H && C.push("built_year_max_nb");
          }
          if (null == _ ? void 0 : _.monthlyPayment) {
            var U = _.monthlyPayment,
              P = U.min,
              G = U.max;
            y.push({ filterName: "monthlyPayment", min: P, max: G }),
              P && C.push("monthly_payment_min_amt"),
              G && C.push("monthly_payment_max_amt");
          }
          var Z,
            q,
            z,
            j,
            V,
            W = (function (e) {
              var n = {};
              return (
                e.forEach(function (e) {
                  var t = e.filterName,
                    r = e.min,
                    o = void 0 === r ? null : r,
                    i = e.max,
                    a = void 0 === i ? null : i;
                  n[t] = { min: o, max: a };
                }),
                n
              );
            })(y);
          if (
            null == f || null === (t = f.daysOnZillow) || void 0 === t
              ? void 0
              : t.max
          ) {
            var Y =
              ((Z = f.daysOnZillow.max),
              (q = mn(Z, [
                [1, 7],
                [7, 14],
                [14, 30],
                [30, 90],
                [90, 182],
                [182, 365],
                [365, 730],
                [730, 1095],
              ])),
              (j = (z = (0, a.Z)(q, 2))[0]),
              (V = z[1]),
              Z === j || Z === V
                ? Z
                : "number" == typeof j && "number" == typeof V
                ? V
                : null);
            Y && (W.doz = { value: Xe[Y] }), C.push("day_on_zillow_nb");
          }
          (null == h ? void 0 : h.length) &&
            ((W.keywords = { value: h.toString() }), C.push("keywords_txt")),
            (null == p ? void 0 : p.length) &&
              R.push({
                searchFilterList: p,
                filterStateMap: We,
                clickstreamMap: on,
              }),
            (null == S ? void 0 : S.length) &&
              R.push({
                searchFilterList: S,
                filterStateMap: Ye,
                clickstreamMap: an,
              }),
            (null == N ? void 0 : N.length) &&
              R.push({
                searchFilterList: N,
                filterStateMap: Ke,
                clickstreamMap: ln,
              }),
            (null == v ? void 0 : v.length) &&
              R.push({
                searchFilterList: v.includes("FOR_SALE")
                  ? [].concat((0, g.Z)(v), (0, g.Z)(Ve))
                  : v,
                filterStateMap: $e,
                clickstreamMap: cn,
              }),
            (null == _ || null === (r = _.petsAllowed) || void 0 === r
              ? void 0
              : r.length) &&
              R.push({
                searchFilterList: _.petsAllowed,
                filterStateMap: Qe,
                clickstreamMap: sn,
              }),
            (null == E ? void 0 : E.length) &&
              R.push({
                searchFilterList: E,
                filterStateMap: Je,
                clickstreamMap: un,
              });
          var K = (function (e, n, t) {
            var r = Object.assign({}, n),
              o = (0, g.Z)(t);
            return (
              e.forEach(function (e) {
                var n = e.searchFilterList,
                  t = e.filterStateMap,
                  i = e.clickstreamMap;
                Object.values(t).forEach(function (e) {
                  r[e] = { value: !1 };
                }),
                  n.forEach(function (e) {
                    if (e) {
                      var n = r[t[e]];
                      n && (n.value = !0);
                      var a = i[e];
                      a && o.push(a);
                    }
                  });
              }),
              { filterState: r, clickstreamFilterFields: o }
            );
          })(R, W, C);
          if (null == b ? void 0 : b.length) {
            if (b.includes("NO_HOA_DATA")) {
              K.filterState.includeHomesWithNoHoaData = { value: !1 };
              var $ = (0, g.Z)(K.clickstreamFilterFields);
              $.push("hoa_ind"), (K.clickstreamFilterFields = $);
            }
            if (b.includes("SENIOR_COMMUNITY")) {
              K.filterState.ageRestricted55Plus = { value: "e" };
              var Q = (0, g.Z)(K.clickstreamFilterFields);
              Q.push("senior_living_ind"), (K.clickstreamFilterFields = Q);
            }
          }
          return (
            (null == N ? void 0 : N.length) &&
              (K.filterState.isApartmentOrCondo = {
                value: N.includes("APARTMENT") || N.includes("CONDO"),
              }),
            K
          );
        },
        gn = function e(n) {
          var t = ["listingStatusType", "homeType", "userSearchContext"];
          return Object.entries(n).every(function (n) {
            var r = (0, a.Z)(n, 2),
              o = r[0],
              i = r[1];
            return "object" !== (0, x.Z)(i) || null === i || Array.isArray(i)
              ? t.includes(o) || null === i
              : e(i);
          });
        },
        hn = function (e, n, t) {
          (0, l.useEffect)(
            function () {
              var r = function (r) {
                var o = r.target;
                e.current &&
                  (e.current.contains(o)
                    ? null == n || n(o)
                    : null == t || t());
              };
              return (
                document.addEventListener("click", r),
                function () {
                  document.removeEventListener("click", r);
                }
              );
            },
            [e, t, n]
          );
        };
      function pn() {
        var e = (0, p.Z)([
          "\n    query getQueryUnderstandingResults(\n        $query: String!\n        $queryOptions: SearchAssistanceQueryOptions\n        $querySource: SearchAssistanceQuerySource = UNKNOWN\n        $resultType: [SearchAssistanceResultType]\n    ) {\n        searchAssistanceResult: zgsQueryUnderstandingRequest(\n            query: $query\n            queryOptions: $queryOptions\n            querySource: $querySource\n            resultType: $resultType\n        ) {\n            requestId\n            results {\n                __typename\n                id\n                ...RegionResultFields\n                ...SemanticResultFields\n                ...RentalCommunityResultFields\n            }\n        }\n    }\n    ",
          "\n    ",
          "\n    ",
          "\n",
        ]);
        return (
          (pn = function () {
            return e;
          }),
          e
        );
      }
      var Sn = (0, S.ZP)(pn(), Z, z, q),
        Nn = void 0,
        vn = "/builds/zillow/searchxp/static-search-box/src/SearchBox.jsx",
        En = /^\[[A-Z_]+\]/g,
        bn = u()(m.Adornment).withConfig({
          displayName: "SearchBox__StyledSearchBoxAdornment",
          componentId: "rxevgz-0",
        })(
          [
            "padding:0 0 0 5px;border-radius:0 4px 4px 0;button{border-radius:0 4px 4px 0;",
            "}",
            " ",
            ";",
          ],
          function (e) {
            return !e.enableNaturalLanguageSearch && "width: 44px;";
          },
          function (e) {
            return (
              e.enableNaturalLanguageSearch &&
              "\n        display: flex;\n        justify-content: center;\n        padding: 0px;\n        width: 36px;\n    "
            );
          },
          function (e) {
            return e.shouldHideAdornment && "display: none;";
          }
        ),
        yn = u()(m.IconButton).withConfig({
          displayName: "SearchBox__StyledSearchBoxButton",
          componentId: "rxevgz-1",
        })(["&:focus{box-shadow:none;}"]),
        Rn = u()(m.AdornedInput).withConfig({
          displayName: "SearchBox__StyledAdornedInput",
          componentId: "rxevgz-2",
        })(["", ""], function (e) {
          return e.addRightPadding && "padding-right: 6px;";
        }),
        Cn = u()(m.Combobox).withConfig({
          displayName: "SearchBox__StyledCombobox",
          componentId: "rxevgz-3",
        })(
          [
            "@media screen and (max-width:889px){&&& [role='listbox'],&&& [role='dialog']{width:100vw !important;}}&&& [role='listbox'],&&& [role='dialog']{height:auto;max-height:calc(100vh - 75px);z-index:100;}input,label{background-color:",
            ";border:none;}",
          ],
          (0, m.token)("colors.backgroundWhite")
        ),
        xn = u()(m.Form).withConfig({
          displayName: "SearchBox__StyledForm",
          componentId: "rxevgz-4",
        })(
          [
            "border:1px solid;border-radius:4px;border-color:",
            ";background-color:",
            ";&:active,&:hover,&:focus{border-color:",
            ";}",
          ],
          (0, m.token)("colors.gray300"),
          (0, m.token)("colors.backgroundWhite"),
          (0, m.token)("colors.blue400")
        ),
        An = u().span.withConfig({
          displayName: "SearchBox__StyledListboxOptionLabelText",
          componentId: "rxevgz-5",
        })(["overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"]),
        In = u()(m.ListboxOptionLabel).withConfig({
          displayName: "SearchBox__StyledListboxOptionLabel",
          componentId: "rxevgz-6",
        })(["display:flex;"]),
        On = u()(m.Gleam).withConfig({
          displayName: "SearchBox__StyledListboxOptionLabelGleam",
          componentId: "rxevgz-7",
        })(["align-self:center;margin-left:auto;"]),
        Tn = function (e, n) {
          return "[" + n + "]" + e;
        },
        Ln = function (e, n) {
          switch ((void 0 === n && (n = !1), e)) {
            case V.currentLocation:
              return n
                ? c().createElement(m.IconLocationOutline, {
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 178,
                      columnNumber: 50,
                    },
                  })
                : c().createElement(m.IconLocation, {
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 178,
                      columnNumber: 76,
                    },
                  });
            case V.recentSearch:
              return n
                ? c().createElement(m.IconClockOutline, {
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 180,
                      columnNumber: 50,
                    },
                  })
                : c().createElement(m.IconClock, {
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 180,
                      columnNumber: 73,
                    },
                  });
            case V.savedSearch:
              return n
                ? c().createElement(m.IconSavedSearchOutline, {
                    "data-test": "saved-search-icon",
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 183,
                      columnNumber: 17,
                    },
                  })
                : c().createElement(m.IconSavedSearch, {
                    "data-test": "saved-search-icon",
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 185,
                      columnNumber: 17,
                    },
                  });
            case V.savedHome:
            case V.claimedHome:
              return c().createElement(m.IconFavoriteHome, {
                __self: Nn,
                __source: { fileName: vn, lineNumber: 189, columnNumber: 20 },
              });
            default:
              return null;
          }
        },
        wn = function (e) {
          var n = e.abKey,
            s = e.className,
            u = e.centroid,
            _ = e.clientId,
            f = e.disableCurrentLocation,
            g = e.enableNaturalLanguageSearch,
            h = e.fetchResults,
            p = e.fetchResultsError,
            S = e.filterResults,
            N = e.gaEventsConfig,
            v = e.handleChangeCallback,
            E = e.handleSubmit,
            b = e.initSearchTerm,
            y = e.inputRef,
            R = e.isCurrentLocationSearch,
            C = e.isUserPositionInMapBounds,
            x = e.onReCenter,
            A = e.platform,
            T = e.platformConfig,
            L = e.recentSearchLocalStorageKey,
            w = e.regionAddressAutocompleteURL,
            k = e.resultTypes,
            M = e.searchBoxOnPopState,
            D = e.searchBoxDidFocusInput,
            B = e.searchBoxDidSelectOption,
            F = e.shouldShowSavedHomes,
            U = e.shouldShowSavedSearches,
            P = e.showAdornments,
            G = e.size,
            Z = e.trackSearchBoxInputFocus,
            q = e.userSearchContext,
            z = e.zgGraphClient,
            j = e.clickstreamTriggerOverrides,
            W = e.clickstreamDecorators,
            X = e.allowEmptyInitialClickstreamBlocks,
            ee = (0, l.useState)("local"),
            ne = (0, a.Z)(ee, 2),
            te = ne[0],
            oe = ne[1],
            ie = (0, l.useState)([]),
            ae = (0, a.Z)(ie, 2),
            le = ae[0],
            ce = ae[1],
            se = (0, l.useState)({}),
            ue = (0, a.Z)(se, 2),
            de = ue[0],
            me = ue[1],
            fe = (0, l.useState)(b),
            ge = (0, a.Z)(fe, 2),
            he = ge[0],
            pe = ge[1],
            Se = (0, l.useState)(!0),
            Ne = (0, a.Z)(Se, 2),
            ye = Ne[0],
            Re = Ne[1],
            Ce = (0, l.useState)(null),
            xe = (0, a.Z)(Ce, 2),
            Ae = xe[0],
            Ie = xe[1],
            Oe = (0, l.useState)(!1),
            Te = (0, a.Z)(Oe, 2),
            Le = Te[0],
            we = Te[1],
            ke = (0, l.useRef)(),
            Me = (0, l.useRef)(),
            De = (0, l.useRef)(),
            Be = (0, l.useRef)(),
            Fe = (0, l.useRef)();
          (0, l.useEffect)(
            function () {
              pe(b);
            },
            [b]
          ),
            hn(
              Fe,
              function () {
                g && we(!0);
              },
              function () {
                var e;
                g &&
                  document.activeElement !==
                    (null === (e = Fe.current) || void 0 === e
                      ? void 0
                      : e.querySelector("input")) &&
                  we(!1);
              }
            );
          var He = function (e) {
              return e.replace(En, "");
            },
            Ze = function (e, t) {
              h(
                e,
                de,
                {
                  abKey: n,
                  clientId: _,
                  centroid: u,
                  regionAddressAutocompleteURL: w,
                  recentSearchLocalStorageKey: L,
                  fetchSavedHomes: F,
                  fetchSavedSearches: U,
                  disableCurrentLocation: f,
                  resultTypes: k,
                  userSearchContext: q,
                },
                t,
                void 0,
                g ? z : void 0
              )
                .then(function (e) {
                  var n,
                    t,
                    r = null !== (n = e.suggestions) && void 0 !== n ? n : e,
                    o = S(r, !1, g);
                  oe(
                    (t = o).length && t[0].category === V.currentLocation
                      ? "local"
                      : "remote"
                  ),
                    ce(o),
                    e.requestId && (Be.current = e.requestId);
                })
                .catch(p);
            },
            qe = (0, d.Z)(Ze, 400);
          (0, l.useEffect)(
            function () {
              var e = function () {
                return null == M ? void 0 : M(Me);
              };
              return (
                window.addEventListener("popstate", e),
                function () {
                  return window.removeEventListener("popstate", e);
                }
              );
            },
            [M]
          ),
            (0, l.useEffect)(
              function () {
                var e;
                (e = g && he.displayName.length > 0 ? O : I),
                  Ze(he.displayName, e);
              },
              [F, U]
            ),
            (0, l.useEffect)(
              function () {
                return (
                  Ie(
                    le.length +
                      " suggested results are available. Use up and down arrow keys to navigate"
                  ),
                  clearTimeout(ke.current),
                  (ke.current = setTimeout(function () {
                    Ie(null);
                  }, 500)),
                  function () {
                    return clearTimeout(ke.current);
                  }
                );
              },
              [le]
            );
          var ze = function (e) {
              var n = {
                displayName: "Current Location",
                category: V.currentLocation,
              };
              me(e),
                pe(n),
                Re(!0),
                E(n, {
                  accuracy: e.coords.accuracy,
                  latitude: e.coords.latitude,
                  longitude: e.coords.longitude,
                });
            },
            Ve = function () {
              Re(!1),
                alert(
                  "There is no location support on this device or it is disabled. Please check your settings."
                );
            },
            We = function (e, n) {
              var t,
                o,
                i = e.displayName,
                a = e.data;
              return K(e) || $(e)
                ? (r.RecentSearchClient.addToRecentSearches(e),
                  E(
                    {
                      displayName: i,
                      regions: [{ regionId: a.regionId }],
                      category: V.region,
                    },
                    de
                  ))
                : Q(e) || J(e)
                ? (r.RecentSearchClient.addToRecentSearches(e),
                  E({
                    displayName: i,
                    category: V.semantic,
                    regions:
                      null !==
                        (t =
                          null === (o = a.regionIds) || void 0 === o
                            ? void 0
                            : o.map(function (e) {
                                return { regionId: parseInt(e, 10) };
                              })) && void 0 !== t
                        ? t
                        : [],
                    filters: n,
                    queryResolutionStatus: a.queryResolutionStatus,
                    isSemanticSearchResult: !0,
                    isSimpleFilterChange: gn(e.data.filters),
                  }))
                : E(e, de);
            },
            Ye = function (e, r) {
              return new Promise(function (o, i) {
                var a, l, c, s, d, m, _, f, h, p, S, v, b, R, C, x, A, I, O, T;
                if (
                  ((a = he.displayName),
                  null == B || B(Me),
                  (function (e, n) {
                    var t = H[e.category],
                      r = t && t.getSearchBoxClickLabel;
                    if ("function" != typeof r)
                      console.error(
                        "No ga click event configured for search term with category " +
                          e.category
                      );
                    else {
                      var o = {
                        category: N.category,
                        action: N.getClickActionName(e.category),
                        label: r({
                          chosenSuggestion: e,
                          allSuggestions: le,
                          chosenIndex: n + 1,
                          searchBoxValue: he.displayName,
                        }),
                      };
                      Ue({
                        trackEventProp: o,
                        autocompleteResult: e,
                        clickstreamTriggerOverrides: j,
                        clickstreamDecorators: W,
                        allowEmptyInitialClickstreamBlocks: X,
                      });
                    }
                  })(e, r),
                  pe(e),
                  !(function (e) {
                    return e.category === V.currentLocation;
                  })(e) ||
                    (de.accuracy && de.latitude && de.longitude))
                ) {
                  if (g) {
                    return 0 ===
                      (null == e || null === (l = e.displayName) || void 0 === l
                        ? void 0
                        : l.length)
                      ? o()
                      : -1 !== r
                      ? ((m = (d = fn(
                          null == e || null === (c = e.data) || void 0 === c
                            ? void 0
                            : c.filters,
                          null == e || null === (s = e.data) || void 0 === s
                            ? void 0
                            : s.regionIds
                        )).clickstreamFilterFields),
                        (_ = d.filterState),
                        (f = function () {
                          return Y(e)
                            ? "RECENT"
                            : "local" === te && Q(e)
                            ? "SUGGESTED"
                            : "AUTOCOMPLETE";
                        }),
                        (h = {
                          interactionId: null == De ? void 0 : De.current,
                          requestId: null == Be ? void 0 : Be.current,
                          selectionType: f(),
                          selectionIndex: r,
                          rawValue: a,
                          changedFilterFields: m,
                        }),
                        Pe({
                          eventName: be,
                          suggestion: Object.assign({}, e, { metadata: h }),
                          clickstreamTriggerOverrides: j,
                          clickstreamDecorators: W,
                          allowEmptyInitialClickstreamBlocks: X,
                        }),
                        We(e, _),
                        Ze(e.displayName, "listbox event"),
                        M.call(this))
                      : Promise.resolve(
                          re(e.displayName, {
                            zgGraphClient: z,
                            graphqlQuery: Sn,
                            autocompleteConfig: {
                              abKey: n,
                              centroid: u,
                              resultTypes: k,
                              userSearchContext: q,
                              fetchLimit: 1,
                            },
                            extraVariables: { querySource: "MANUAL" },
                          })
                        ).then(
                          function (n) {
                            try {
                              return (
                                (R = (b = n).suggestions),
                                (C = b.requestId),
                                (x =
                                  null !== (p = null == R ? void 0 : R[0]) &&
                                  void 0 !== p
                                    ? p
                                    : {
                                        category: V.semantic,
                                        displayName: null,
                                        data: {
                                          queryResolutionStatus: "FAILED",
                                        },
                                      }),
                                (A = fn(
                                  null == x ||
                                    null === (S = x.data) ||
                                    void 0 === S
                                    ? void 0
                                    : S.filters,
                                  null == x ||
                                    null === (v = x.data) ||
                                    void 0 === v
                                    ? void 0
                                    : v.regionIds
                                )),
                                (I = A.clickstreamFilterFields),
                                (O = A.filterState),
                                (T = {
                                  interactionId:
                                    null == De ? void 0 : De.current,
                                  requestId: C,
                                  selectionType: "MANUAL",
                                  selectionIndex: r,
                                  rawValue: a,
                                  changedFilterFields: I,
                                }),
                                Pe({
                                  eventName: Ee,
                                  suggestion: Object.assign({}, x, {
                                    metadata: T,
                                  }),
                                  clickstreamTriggerOverrides: j,
                                  clickstreamDecorators: W,
                                  allowEmptyInitialClickstreamBlocks: X,
                                }),
                                x.displayName
                                  ? We(x, O)
                                  : E({
                                      displayName: e.displayName,
                                      regions: [],
                                      filters: {},
                                      queryResolutionStatus: "FAILED",
                                      category: V.semantic,
                                      isSimpleFilterChange: !0,
                                    }),
                                (null == y ? void 0 : y.current) instanceof
                                  HTMLElement && y.current.blur(),
                                M.call(this)
                              );
                            } catch (e) {
                              return i(e);
                            }
                          }.bind(this),
                          i
                        );
                    function M() {
                      return w.call(this);
                    }
                  }
                  return E(e, de), w.call(this);
                  function w() {
                    return L.call(this);
                  }
                }
                return (
                  t.g.navigator && t.g.navigator.geolocation
                    ? t.g.navigator.geolocation.getCurrentPosition(ze, Ve)
                    : console.warn("No location object available"),
                  L.call(this)
                );
                function L() {
                  return o();
                }
              });
            },
            Ke = function () {
              var e = T || Ge;
              return A in e ? e[A] : {};
            },
            $e = g
              ? "Try searching with home features & locations"
              : Ke().placeholderText,
            Qe =
              "local" === te
                ? (function (e, n) {
                    var t;
                    if ((void 0 === n && (n = !1), !n))
                      return e.map(function (e, n) {
                        var t = e.displayName,
                          r = e.category,
                          o = e.notificationCount;
                        return {
                          index: n,
                          label: t,
                          value: Tn(t, r),
                          icon: Ln(r),
                          notificationCount: o,
                        };
                      });
                    var r =
                      (((t = {})[V.currentLocation] = [
                        { label: "Current Location", visuallyHidden: !0 },
                      ]),
                      (t[V.recentSearch] = [{ label: "Search History" }]),
                      (t[V.semantic] = [{ label: "Suggested Searches" }]),
                      (t[V.savedSearch] = [{ label: "Saved Searches" }]),
                      t);
                    return (
                      e.forEach(function (e, t) {
                        var o = e.displayName,
                          i = e.category,
                          a = e.notificationCount;
                        r[i] &&
                          r[i].push({
                            index: t,
                            label: o,
                            value: Tn(o, i),
                            icon: Ln(i, n),
                            notificationCount: a,
                          });
                      }),
                      Object.values(r).filter(function (e) {
                        return e.length > 1;
                      })
                    );
                  })(le, g)
                : le.map(function (e, n) {
                    var t = e.displayName,
                      r = e.category;
                    return { index: n, label: t, value: Tn(t, r) };
                  });
          return c().createElement(
            xn,
            {
              ref: Fe,
              className: s,
              onSubmit: function (e) {
                e.preventDefault(), he.category === V.rawSearch && Ye(he, -1);
              },
              autocomplete: "off",
              __self: Nn,
              __source: { fileName: vn, lineNumber: 805, columnNumber: 9 },
            },
            c().createElement(Cn, {
              allowSubmitWhileOpen: !0,
              fluidDropdown: !0,
              freeForm: !0,
              appearance: "input",
              autoCompleteBehavior: "manual",
              optionFilter: null,
              renderEmptyState: null,
              focusFirstOption: !1,
              size: "xl" === G ? "lg" : G,
              selectCallbackFrequency: m.CALLBACK_FREQUENCY.ALWAYS,
              ref: Me,
              renderInput: function (e) {
                e.onClear;
                var n = e.onBlur;
                e.onTagClose;
                var t,
                  r,
                  a,
                  l = (0, i.Z)(e, ["onClear", "onBlur", "onTagClose"]),
                  s = l.value,
                  u = Object.assign(
                    {},
                    l,
                    "xl" === G && {
                      paddingY: { sm: "sm", md: "md", lg: "md" },
                    },
                    {
                      autoComplete: "off",
                      onBlur: function (e) {
                        Pe({
                          eventName: ve,
                          clickstreamTriggerOverrides: j,
                          clickstreamDecorators: W,
                          allowEmptyInitialClickstreamBlocks: X,
                        }),
                          "function" == typeof n && n(e),
                          we(!1);
                      },
                      value: He(s),
                    }
                  );
                return P
                  ? c().createElement(Rn, {
                      input: c().createElement(
                        m.Input,
                        (0, o.Z)({ ref: y }, u, {
                          __self: Nn,
                          __source: {
                            fileName: vn,
                            lineNumber: 718,
                            columnNumber: 28,
                          },
                        })
                      ),
                      rightAdornment:
                        ((t = Ke().supportsLocationIcon),
                        (r = !f && ye && (t || R)),
                        (a = c().createElement(yn, {
                          title: "Submit Search",
                          icon: c().createElement(
                            m.IconSearch,
                            {
                              "aria-hidden": "false",
                              "aria-describedby":
                                "search-icon-title search-icon-desc",
                              __self: Nn,
                              __source: {
                                fileName: vn,
                                lineNumber: 647,
                                columnNumber: 21,
                              },
                            },
                            c().createElement(
                              "title",
                              {
                                id: "search-icon-title",
                                __self: Nn,
                                __source: {
                                  fileName: vn,
                                  lineNumber: 651,
                                  columnNumber: 25,
                                },
                              },
                              "Search"
                            ),
                            c().createElement(
                              "desc",
                              {
                                id: "search-icon-desc",
                                __self: Nn,
                                __source: {
                                  fileName: vn,
                                  lineNumber: 652,
                                  columnNumber: 25,
                                },
                              },
                              "A magnifying glass"
                            )
                          ),
                          size: "xl" === G ? "lg" : G,
                          buttonType: "secondary",
                          type: "submit",
                          bare: !0,
                          enableNaturalLanguageSearch: g,
                          __self: Nn,
                          __source: {
                            fileName: vn,
                            lineNumber: 644,
                            columnNumber: 13,
                          },
                        })),
                        g &&
                          (a = c().createElement(m.IconSearch, {
                            __self: Nn,
                            __source: {
                              fileName: vn,
                              lineNumber: 664,
                              columnNumber: 25,
                            },
                          })),
                        r &&
                          (a = c().createElement(je, {
                            onLocationAccessGranted: ze,
                            onLocationAccessFailed: Ve,
                            isCurrentLocationSearch: R,
                            isUserPositionInMapBounds: C,
                            onReCenter: x,
                            useConstellationComponents: !0,
                            enableNaturalLanguageSearch: g,
                            __self: Nn,
                            __source: {
                              fileName: vn,
                              lineNumber: 669,
                              columnNumber: 17,
                            },
                          })),
                        c().createElement(
                          bn,
                          {
                            "aria-hidden": "false",
                            enableNaturalLanguageSearch: g,
                            shouldHideAdornment: Le && g,
                            __self: Nn,
                          },
                          a
                        )),
                      addRightPadding: Le && g,
                      __self: Nn,
                      __source: {
                        fileName: vn,
                        lineNumber: 717,
                        columnNumber: 17,
                      },
                    })
                  : c().createElement(
                      m.Input,
                      (0, o.Z)({ ref: y }, u, {
                        __self: Nn,
                        __source: {
                          fileName: vn,
                          lineNumber: 724,
                          columnNumber: 16,
                        },
                      })
                    );
              },
              renderOption: function (e) {
                var n,
                  t = e.label,
                  r = e.notificationCount,
                  i = ((n = _e(he)), "remote" === te && n.trim() ? n : null),
                  a = r
                    ? c().createElement(On, {
                        count: r,
                        maxSuffix: !0,
                        __self: Nn,
                        __source: {
                          fileName: vn,
                          lineNumber: 733,
                          columnNumber: 13,
                        },
                      })
                    : null,
                  l = c().createElement(
                    In,
                    {
                      __self: Nn,
                      __source: {
                        fileName: vn,
                        lineNumber: 737,
                        columnNumber: 13,
                      },
                    },
                    c().createElement(
                      An,
                      {
                        __self: Nn,
                        __source: {
                          fileName: vn,
                          lineNumber: 738,
                          columnNumber: 17,
                        },
                      },
                      c().createElement(m.Highlighter, {
                        text: t,
                        pattern: i,
                        __self: Nn,
                        __source: {
                          fileName: vn,
                          lineNumber: 739,
                          columnNumber: 21,
                        },
                      })
                    ),
                    a
                  );
                return c().createElement(
                  m.ComboboxOption,
                  (0, o.Z)({}, e, {
                    label: l,
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 745,
                      columnNumber: 16,
                    },
                  })
                );
              },
              onChange: function (e, n) {
                var t = n.reason;
                (t !== O && "clear input" !== t) ||
                  (v(),
                  pe({ displayName: e, category: "RAW_SEARCH" }),
                  Re(!1),
                  qe(e, t));
              },
              onFocus: function () {
                we(!0),
                  Z(),
                  g &&
                    ((De.current = n + "-" + new Date().toISOString()),
                    setTimeout(function () {
                      var e = y.current.value.length;
                      y.current.setSelectionRange(e, e);
                    })),
                  null == D || D();
              },
              onKeyDown: function () {
                Re(!1);
              },
              onOptionSelect: function (e) {
                var n = e.index,
                  t = le[n];
                Ye(t, n);
              },
              placeholder: $e,
              value: _e(he),
              options: Qe,
              __self: Nn,
              __source: { fileName: vn, lineNumber: 806, columnNumber: 13 },
            }),
            Ae &&
              c().createElement(
                m.VisuallyHidden,
                {
                  "aria-live": "polite",
                  "aria-atomic": "true",
                  __self: Nn,
                  __source: { fileName: vn, lineNumber: 829, columnNumber: 17 },
                },
                c().createElement(
                  "p",
                  {
                    __self: Nn,
                    __source: {
                      fileName: vn,
                      lineNumber: 830,
                      columnNumber: 21,
                    },
                  },
                  Ae
                )
              )
          );
        };
      (wn.propTypes = {}),
        (wn.defaultProps = {
          disableCurrentLocation: !1,
          enableNaturalLanguageSearch: !1,
          gaEventsConfig: {
            category: "searchbox",
            getClickActionName: function (e) {
              return "RAW_SEARCH" === e ? "submit" : "select-suggestion";
            },
            getFocusActionName: function () {
              return "focus";
            },
          },
          fetchResults: oe,
          fetchResultsError: function (e) {
            return console.log(e);
          },
          filterResults: me,
          handleChangeCallback: function () {},
          handleSubmit: function () {},
          initSearchTerm: { displayName: "", category: "RAW_SEARCH" },
          inputRef: c().createRef(),
          isCurrentLocationSearch: !1,
          isUserPositionInMapBounds: !0,
          onReCenter: function () {},
          platform: "DESKTOP",
          platformConfig: null,
          showAdornments: !0,
          size: m.INPUT_SIZES.sm,
          trackSearchBoxInputFocus: function () {},
          userSearchContext: "FOR_SALE",
          clickstreamTriggerOverrides: null,
          clickstreamDecorators: null,
          allowEmptyInitialClickstreamBlocks: !1,
        });
      var kn,
        Mn = wn,
        Dn = void 0,
        Bn =
          "/builds/zillow/searchxp/static-search-box/src/SearchBoxCombobox.tsx";
      !(function (e) {
        (e.region = "REGION"), (e.multiRegion = "MULTI_REGION");
      })(kn || (kn = {}));
      var Fn = function (e) {
          return Boolean(e && e.category === kn.multiRegion);
        },
        Hn = w.CLAIMED_HOME,
        Un = w.CURRENT_LOCATION,
        Pn = w.RECENT_SEARCH,
        Gn = w.SAVED_HOME,
        Zn = w.SAVED_SEARCH,
        qn = /^\[[A-Z_]+\]/g,
        zn = u()(m.Adornment).withConfig({
          displayName: "SearchBoxCombobox__StyledSearchBoxAdornment",
          componentId: "sc-1qvxrzk-0",
        })(
          [
            "position:absolute;top:calc(50% - ",
            "px);right:0;padding:0;width:",
            "px;height:",
            "px;justify-content:center;",
            ";button{width:",
            "px;height:",
            "px;&:after{margin-top:-",
            "px;min-width:",
            "px;height:",
            "px;}}",
          ],
          21,
          L,
          L,
          function (e) {
            return e.shouldHideAdornment && "display: none;";
          },
          L,
          L,
          21,
          L,
          L
        ),
        jn = u()(m.Form).withConfig({
          displayName: "SearchBoxCombobox__StyledForm",
          componentId: "sc-1qvxrzk-1",
        })(
          [
            "position:absolute;z-index:2;top:0;left:0;right:0;border:1px solid;border-radius:4px;border-color:",
            ";background-color:",
            ";&:active,&:hover,&:focus{border-color:",
            ";}",
          ],
          (0, m.token)("colors.gray300"),
          (0, m.token)("colors.backgroundWhite"),
          (0, m.token)("colors.blue400")
        ),
        Vn = u()(m.Combobox).withConfig({
          displayName: "SearchBoxCombobox__StyledCombobox",
          componentId: "sc-1qvxrzk-2",
        })(
          [
            "background-color:",
            ";border:none;border-radius:4px;&:focus,&:focus-within{box-shadow:0 0 0px 1px #fff,0 0 2px 3px #a6e5ff,0 0 2px 4px #006aff;}label{border:none;background-color:",
            ";&:focus{box-shadow:none;}}@media screen and (max-width:889px){&&& [role='listbox'],&&& [role='dialog']{width:100vw !important;}}&&& [role='listbox'],&&& [role='dialog']{height:auto;max-height:100vh;z-index:100;}",
          ],
          (0, m.token)("colors.backgroundWhite"),
          (0, m.token)("colors.backgroundWhite")
        ),
        Wn = u()(m.ComboboxInput).withConfig({
          displayName: "SearchBoxCombobox__StyledComboboxInput",
          componentId: "sc-1qvxrzk-3",
        })(
          [
            "border:none;padding-left:8px;width:100%;box-shadow:none;background-color:",
            ";&:focus,&:focus-within{box-shadow:none;}span[class*='StyledTag']{position:relative;display:block;flex:0 auto;min-width:60px;padding-right:32px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;> button{position:absolute;top:calc(50% - 8px);right:8px;height:100%;}&:last-of-type{margin-right:8px;}}input[role='combobox']{background-color:",
            ";text-overflow:ellipsis;",
            ";&:focus{box-shadow:none;}}",
            "",
          ],
          (0, m.token)("colors.backgroundWhite"),
          (0, m.token)("colors.backgroundWhite"),
          function (e) {
            return e.isRegionSelectionAtLimit && "display: none;";
          },
          function (e) {
            return e.isContainerFocused
              ? '\n                // Forces input onto new line and full width\n                input[role="combobox"] {\n                    flex-basis: 100%;\n                }\n            '
              : (0, s.css)(
                  [
                    "flex-wrap:nowrap;padding-right:",
                    "px;> button[class*='StyleTagCloseButton']{display:none;}&&& span[class*='StyledTag']:nth-child(1):nth-last-child(4){flex-shrink:0;padding-right:8px;> button{display:none;}}@media screen and (max-width:",
                    "px){span[class*='StyledTag']:nth-child(2) + input[role='combobox']{display:none;}}",
                  ],
                  L,
                  428
                );
          }
        ),
        Yn = u().span.withConfig({
          displayName: "SearchBoxCombobox__StyledListboxOptionLabelText",
          componentId: "sc-1qvxrzk-4",
        })(["overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"]),
        Kn = u()(m.ListboxOptionLabel).withConfig({
          displayName: "SearchBoxCombobox__StyledListboxOptionLabel",
          componentId: "sc-1qvxrzk-5",
        })(["display:flex;"]),
        $n = u()(m.Gleam).withConfig({
          displayName: "SearchBoxCombobox__StyledListboxOptionLabelGleam",
          componentId: "sc-1qvxrzk-6",
        })(["align-self:center;margin-left:auto;"]),
        Qn = function (e) {
          return e.replace(qn, "");
        },
        Jn = function (e, n) {
          return "[" + n + "]" + e;
        },
        Xn = function (e) {
          switch (e) {
            case Un:
              return c().createElement(m.IconLocation, {
                __self: Dn,
                __source: { fileName: Bn, lineNumber: 480, columnNumber: 20 },
              });
            case Pn:
              return c().createElement(m.IconClock, {
                __self: Dn,
                __source: { fileName: Bn, lineNumber: 482, columnNumber: 20 },
              });
            case Zn:
              return c().createElement(m.IconSavedSearch, {
                "data-test": "saved-search-icon",
                __self: Dn,
                __source: { fileName: Bn, lineNumber: 484, columnNumber: 20 },
              });
            case Gn:
            case Hn:
              return c().createElement(m.IconFavoriteHome, {
                __self: Dn,
                __source: { fileName: Bn, lineNumber: 487, columnNumber: 20 },
              });
            default:
              return null;
          }
        },
        et = function (e) {
          return e.length
            ? e[0].category === Un
              ? e.map(function (e, n) {
                  var t = e.displayName,
                    r = void 0 === t ? "" : t,
                    o = e.category,
                    i = e.notificationCount;
                  return {
                    index: n,
                    label: r,
                    value: Jn(r, o),
                    icon: Xn(o),
                    notificationCount: i,
                  };
                })
              : e.map(function (e, n) {
                  var t = e.displayName,
                    r = void 0 === t ? "" : t;
                  return { index: n, label: r, value: r };
                })
            : [];
        },
        nt = function (e) {
          return Boolean(e.length && e[0].category === Un);
        },
        tt = function (e, n) {
          var t = n.regionId;
          return Boolean(
            e.regions.find(function (e) {
              return e.regionId === t;
            })
          );
        },
        rt = function (e) {
          return e.regions.length >= 5;
        },
        ot = function (e) {
          return Boolean(
            e.regions.find(function (e) {
              return !0 === e.isPointRegion;
            })
          );
        },
        it = function (e) {
          return (
            null === e ||
            (Fn(e) ? ot(e) || 0 === e.regions.length : !e.displayName)
          );
        },
        at = function (e) {
          return (
            it(e) ||
            (function (e) {
              return Boolean(e && e.category === V.rawSearch);
            })(e)
          );
        },
        lt = function (e) {
          var n = e.autocompleteConfig,
            t = e.className,
            s = e.fetchResultsError,
            u = e.gaEventsConfig,
            _ =
              void 0 === u
                ? {
                    category: "searchbox",
                    getClickActionName: function (e) {
                      return e === V.rawSearch ? "submit" : "select-suggestion";
                    },
                    getFocusActionName: function () {
                      return "focus";
                    },
                    getAddRegionName: function () {
                      return "add-region";
                    },
                    getRemoveRegionName: function () {
                      return "remove-region";
                    },
                    getRemoveAllRegionsName: function () {
                      return "remove-all-regions";
                    },
                    getRemoveAllRegionsExternalLocation: function () {
                      return "map-clear";
                    },
                  }
                : u,
            f = e.handleSubmit,
            h = e.initialSelection,
            p = e.isCurrentLocationSearch,
            S = e.isUserPositionInMapBounds,
            N = e.onReCenter,
            v = e.showAdornments,
            E = e.supportsLocationIcon,
            b = e.trackSearchBoxInputFocus,
            R = e.searchBoxDidFocusInput,
            C = e.searchBoxDidClickTag,
            x = e.searchBoxDidSubmitForm,
            I = e.searchBoxDidSelectOption,
            O = e.searchBoxDidClearAllSelections,
            T = e.searchBoxOnPopState,
            L = e.shouldClearSelection,
            w = (0, l.useState)("local"),
            k = (0, a.Z)(w, 2),
            M = k[0],
            D = k[1],
            B = (0, l.useState)([]),
            F = (0, a.Z)(B, 2),
            U = F[0],
            P = F[1],
            G = (0, l.useState)(!1),
            Z = (0, a.Z)(G, 2),
            q = Z[0],
            z = Z[1],
            j = (0, l.useState)(!1),
            W = (0, a.Z)(j, 2),
            Y = W[0],
            Q = W[1],
            J = (0, l.useState)({}),
            X = (0, a.Z)(J, 2),
            ee = X[0],
            ne = X[1],
            te = (0, l.useState)(null),
            re = (0, a.Z)(te, 2),
            ie = re[0],
            ae = re[1],
            le = (0, l.useState)(!0),
            ce = (0, a.Z)(le, 2),
            se = ce[0],
            ue = ce[1],
            de = (0, l.useState)(!1),
            _e = (0, a.Z)(de, 2),
            fe = _e[0],
            ge = _e[1],
            he = (0, l.useState)(!1),
            Se = (0, a.Z)(he, 2),
            Ee = Se[0],
            be = Se[1],
            ye = (0, l.useState)(null != h ? h : null),
            Re = (0, a.Z)(ye, 2),
            Ce = Re[0],
            xe = Re[1],
            Ae = (0, l.useState)(!1),
            Ie = (0, a.Z)(Ae, 2),
            Oe = Ie[0],
            Te = Ie[1],
            Le = (0, l.useState)(!1),
            we = (0, a.Z)(Le, 2),
            ke = we[0],
            Me = we[1],
            De = (0, l.useState)(!1),
            Be = (0, a.Z)(De, 2),
            Fe = Be[0],
            He = Be[1];
          (0, A.F_)(
            function () {
              xe(null != h ? h : null);
            },
            [h]
          );
          var Ge = (0, l.useCallback)(
              function () {
                return it(Ce)
                  ? "City, Neighborhood, ZIP, Address"
                  : fe
                  ? "City, Neighborhood, ZIP"
                  : "Add another location";
              },
              [Ce, fe]
            ),
            Ze = (0, l.useState)(Ge()),
            qe = (0, a.Z)(Ze, 2),
            ze = qe[0],
            je = qe[1];
          (0, l.useEffect)(
            function () {
              je(Ge);
            },
            [Ge]
          );
          var Ve = (0, l.useRef)(null),
            We = (0, l.useRef)(null),
            Ye = (0, l.useRef)(),
            Ke = (0, l.useCallback)(
              function () {
                var e,
                  n =
                    null === (e = We.current) || void 0 === e
                      ? void 0
                      : e.querySelector("input");
                return n ? n.value : "";
              },
              [We]
            ),
            $e = function () {
              be(!1), Q(!1), P([]);
            },
            Qe = (0, l.useCallback)(
              function (e, t) {
                return new Promise(function (r, o) {
                  var i,
                    a,
                    l = function (e) {
                      return function (n) {
                        try {
                          return z(!1), e && e.call(this, n);
                        } catch (e) {
                          return o(e);
                        }
                      }.bind(this);
                    }.bind(this),
                    c = function () {
                      try {
                        return r();
                      } catch (e) {
                        return o(e);
                      }
                    },
                    u = function (e) {
                      try {
                        return (
                          s(
                            (function (e) {
                              return e instanceof Error
                                ? e.message
                                : "string" == typeof e
                                ? e
                                : "Unknown error occured fetching AutoComplete results.";
                            })(e)
                          ),
                          be(!1),
                          Q(!0),
                          l(c)()
                        );
                      } catch (e) {
                        return l(o)(e);
                      }
                    };
                  try {
                    return (
                      z(!0),
                      Promise.resolve(oe(e, ee, n, t, 1)).then(function (e) {
                        try {
                          return (
                            D(nt((i = e)) ? "local" : "remote"),
                            (a = me(i, !0)),
                            P(a),
                            at(Ce) || a.length ? Q(!1) : Q(!0),
                            l(c)()
                          );
                        } catch (e) {
                          return u(e);
                        }
                      }, u)
                    );
                  } catch (e) {
                    u(e);
                  }
                });
              },
              [n, s, ee, Ce]
            ),
            Je = (0, d.Z)(Qe, 400);
          (0, l.useEffect)(
            function () {
              var e;
              return (
                U.length &&
                  (ae(
                    U.length +
                      " suggested results are available. Use up and down arrow keys to navigate"
                  ),
                  clearTimeout(Ye.current),
                  (null === (e = window) || void 0 === e
                    ? void 0
                    : e.setTimeout) &&
                    (Ye.current = window.setTimeout(function () {
                      ae(null);
                    }, 500))),
                function () {
                  clearTimeout(Ye.current);
                }
              );
            },
            [U]
          ),
            (0, l.useEffect)(
              function () {
                var e = function () {
                  return null == T ? void 0 : T(We);
                };
                return (
                  window.addEventListener("popstate", e),
                  function () {
                    return window.removeEventListener("popstate", e);
                  }
                );
              },
              [T]
            );
          var Xe = function (e, n, t) {
              var r = n.regionId,
                o = {
                  category: _.category,
                  action:
                    "add" === e
                      ? _.getAddRegionName()
                      : _.getRemoveRegionName(),
                  label: r + " | " + t,
                };
              "remove" === e
                ? Ue({
                    trackEventProp: o,
                    regionIndex: t,
                    isMultiregionSearch: !0,
                    eventName: pe,
                  })
                : (0, y.track)(o);
            },
            en = function (e, n) {
              var t,
                r = H[e.category].getSearchBoxClickLabel,
                o = K(e) || $(e);
              if ("function" != typeof r)
                console.error(
                  "No GA click event configured for search term with category " +
                    e.category
                );
              else {
                var i = {
                  category: _.category,
                  action: _.getClickActionName(e.category),
                  label: r({
                    chosenSuggestion: e,
                    allSuggestions: U,
                    chosenIndex: n,
                    searchBoxValue: Ke(),
                  }),
                };
                if (o) {
                  t = {
                    category: kn.region,
                    displayName: e.displayName,
                    regionId: e.data.regionId,
                    regionType: e.data.regionType,
                  };
                  var a = Fn(Ce) && (rt(Ce) || tt(Ce, t));
                  Ue({
                    trackEventProp: i,
                    autocompleteResult: e,
                    isMultiregionSearch: !0,
                    isRegionInMultiRegionSelection: a,
                  });
                } else
                  Ue({
                    trackEventProp: i,
                    autocompleteResult: e,
                    isMultiregionSearch: !0,
                  });
              }
            },
            nn = (0, l.useCallback)(
              function (e, n) {
                f(e, n);
              },
              [f]
            ),
            tn = (0, l.useCallback)(
              function (e, n) {
                void 0 === n && (n = ee), xe(e), nn(e, n);
              },
              [xe, nn, ee]
            ),
            rn = function (e) {
              void 0 === e && (e = !0);
              var n = { category: kn.multiRegion, regions: [] };
              e && nn(n, ee), xe(null), $e();
            };
          (0, l.useEffect)(
            function () {
              Fn(Ce) &&
                Ce.regions.length &&
                L &&
                (rn(!1),
                (0, y.track)({
                  category: _.category,
                  action: _.getRemoveAllRegionsName(),
                  label:
                    Ce.regions.length +
                    " | " +
                    _.getRemoveAllRegionsExternalLocation(),
                }));
            },
            [L]
          );
          var on = (0, l.useCallback)(
              function (e) {
                var n = e.coords,
                  t = {
                    category: V.currentLocation,
                    displayName: "Current Location",
                  };
                ne(n), ue(!0), tn(t, n);
              },
              [tn]
            ),
            an = (0, l.useCallback)(function () {
              ue(!1),
                alert(
                  "There is no location support on this device or it is disabled. Please check your settings."
                );
            }, []),
            ln = (0, l.useCallback)(
              function () {
                var e, n;
                (
                  null === (e = navigator) ||
                  void 0 === e ||
                  null === (n = e.geolocation) ||
                  void 0 === n
                    ? void 0
                    : n.getCurrentPosition
                )
                  ? navigator.geolocation.getCurrentPosition(on, an)
                  : console.warn("No location object available");
              },
              [on, an]
            ),
            cn = (0, l.useCallback)(
              function () {
                p && "function" == typeof N ? N() : ln();
              },
              [p, N, ln]
            ),
            sn = function () {
              if ((rn(), null == O || O(We), Fn(Ce) && Ce.regions.length)) {
                var e = {
                  category: _.category,
                  action: _.getRemoveAllRegionsName(),
                  label: Ce.regions.length + " | searchbox-clear",
                };
                Me(!0),
                  Ue({
                    trackEventProp: e,
                    isMultiregionSearch: !0,
                    eventName: Ne,
                  });
              }
            },
            un = (0, l.useCallback)(function (e) {
              "BUTTON" === e.nodeName || ge(!0);
            }, []),
            dn = (0, l.useCallback)(
              function () {
                var e;
                He(function (e) {
                  var n, t;
                  return (
                    e &&
                      (null === (n = We.current) ||
                        void 0 === n ||
                        null === (t = n.querySelector("input")) ||
                        void 0 === t ||
                        t.focus()),
                    !1
                  );
                }),
                  document.activeElement !==
                    (null === (e = We.current) || void 0 === e
                      ? void 0
                      : e.querySelector("input")) &&
                    (ge(!1), Te(!1), Me(!1), $e());
              },
              [We]
            );
          hn(Ve, un, dn);
          var mn = function () {
            ge(!0),
              Je(Ke(), "input-focused"),
              "function" == typeof b && b(),
              null == R || R(We);
          };
          (0, l.useEffect)(
            function () {
              Oe && !ke && (Pe({ eventName: ve }), Te(!1), Me(!1));
            },
            [Oe, ke]
          );
          var _n = function (e) {
              var n = e.index;
              if (U.length && "number" == typeof n) {
                Je.isPending() && Je.cancel(), null == I || I(We);
                var t = U[n];
                en(t, n + 1),
                  t.category !== Un ||
                  (function (e) {
                    return e.latitude && e.longitude;
                  })(ee)
                    ? (function (e) {
                        if (K(e) || $(e)) {
                          var n = {
                            category: kn.region,
                            displayName: e.displayName,
                            regionId: e.data.regionId,
                            regionType: e.data.regionType,
                          };
                          if (!Fn(Ce) || (!rt(Ce) && !tt(Ce, n))) {
                            var t = {
                              category: kn.multiRegion,
                              regions:
                                Fn(Ce) && !ot(Ce)
                                  ? [].concat((0, g.Z)(Ce.regions), [n])
                                  : [n],
                            };
                            tn(t),
                              Fn(Ce) &&
                                Ce.regions.length > 0 &&
                                Pe({ eventName: "ADD_NTH_REGION" }),
                              Xe("add", n, t.regions.length),
                              K(e) &&
                                r.RecentSearchClient.addToRecentSearches(e);
                          }
                        } else tn(e);
                      })(t)
                    : ln(),
                  $e(),
                  ge(!1),
                  document.activeElement instanceof HTMLElement &&
                    document.activeElement.blur();
              }
            },
            fn = function (e) {
              if (e) {
                var n = { category: V.rawSearch, displayName: e };
                en(n, -1), tn(n);
              }
            };
          (0, l.useEffect)(
            function () {
              q ||
                !Ee ||
                nt(U) ||
                (U.length ? _n({ index: 0 }) : at(Ce) && fn(Ke()), be(!1));
            },
            [q, Ee, U, Ce]
          );
          var gn = function (e) {
              if (Fn(Ce)) {
                var n = Ce.regions.filter(function (n) {
                    return n.displayName !== e;
                  }),
                  t = Ce.regions.reduce(
                    function (n, t, r) {
                      return t.displayName === e ? [t, r + 1] : n;
                    },
                    [void 0, -1]
                  ),
                  r = (0, a.Z)(t, 2),
                  o = r[0],
                  i = r[1],
                  l = Object.assign({}, Ce, { regions: n });
                0 === n.length ? rn() : tn(l),
                  o &&
                    (Me(!0),
                    4 !== n.length || Fe || He(!0),
                    Xe("remove", o, i));
              }
            },
            pn = (0, l.useCallback)(
              function (e) {
                "tag" !== e.target.dataset.componentName
                  ? e.stopPropagation()
                  : null == C || C(We);
              },
              [We, C]
            ),
            Sn = function (e) {
              return c().createElement(
                m.Tag,
                (0, o.Z)({}, e, {
                  onClick: pn,
                  "data-component-name": "tag",
                  textTransform: "none",
                  __self: Dn,
                  __source: { fileName: Bn, lineNumber: 1186, columnNumber: 9 },
                })
              );
            },
            Nn = (0, l.useCallback)(
              function () {
                var e;
                return (
                  (e =
                    se && (E || p)
                      ? c().createElement(m.IconButton, {
                          title: "Use your location",
                          onClick: cn,
                          icon:
                            p && !S
                              ? c().createElement(m.IconLocationOutline, {
                                  __self: Dn,
                                  __source: {
                                    fileName: Bn,
                                    lineNumber: 1249,
                                    columnNumber: 29,
                                  },
                                })
                              : c().createElement(m.IconLocation, {
                                  __self: Dn,
                                  __source: {
                                    fileName: Bn,
                                    lineNumber: 1251,
                                    columnNumber: 29,
                                  },
                                }),
                          size: m.BUTTON_SIZES.sm,
                          type: "button",
                          bare: !0,
                          __self: Dn,
                          __source: {
                            fileName: Bn,
                            lineNumber: 1244,
                            columnNumber: 17,
                          },
                        })
                      : c().createElement(m.IconSearch, {
                          __self: Dn,
                          __source: {
                            fileName: Bn,
                            lineNumber: 1260,
                            columnNumber: 25,
                          },
                        })),
                  c().createElement(
                    zn,
                    { shouldHideAdornment: fe, __self: Dn },
                    e
                  )
                );
              },
              [fe, p, S, cn, se, E]
            ),
            vn = (0, l.useCallback)(
              function () {
                return Y
                  ? c().createElement(
                      m.ComboboxEmptyState,
                      {
                        __self: Dn,
                        __source: {
                          fileName: Bn,
                          lineNumber: 1323,
                          columnNumber: 17,
                        },
                      },
                      "We couldn't find a location match."
                    )
                  : null;
              },
              [Y]
            ),
            En = (0, l.useCallback)(
              function () {
                if (Ce) {
                  var e;
                  if (Fn(Ce)) {
                    if (
                      Ce.regions.find(function (e) {
                        return e.isPointRegion;
                      })
                    )
                      return [];
                    var n = Ce.regions.map(function (e) {
                      return e.displayName;
                    });
                    if (fe || n.length < 2) return n;
                    var t = n.slice(-1)[0];
                    return [n.length - 1 + " more", t];
                  }
                  return null !== (e = Ce.displayName) && void 0 !== e ? e : [];
                }
                return [];
              },
              [Ce, fe]
            );
          return c().createElement(
            jn,
            {
              ref: Ve,
              onSubmit: function (e) {
                e.preventDefault(),
                  null == x || x(We),
                  Ke().length &&
                    (Je.isPending()
                      ? (Je.flush(), be(!0))
                      : at(Ce) && fn(Ke()));
              },
              className: t,
              __self: Dn,
              __source: { fileName: Bn, lineNumber: 1354, columnNumber: 9 },
            },
            c().createElement(Vn, {
              allowSubmitWhileOpen: !0,
              ref: We,
              focusFirstOption: "remote" === M,
              appearance: "input",
              autoCompleteBehavior: "manual",
              optionFilter: null,
              renderEmptyState: vn,
              size: "md",
              selectCallbackFrequency: "always",
              renderInput: function (e) {
                var n = e.value,
                  t = e.onBlur,
                  r = (0, i.Z)(e, ["value", "onBlur"]),
                  a = Object.assign({}, r, {
                    autoComplete: "off",
                    value: n ? Qn(n) : n,
                    onBlur: function (e) {
                      "function" == typeof t && t(e),
                        ge(function (e) {
                          return e && Te(!0), !1;
                        });
                    },
                  }),
                  l = c().createElement(
                    Wn,
                    (0, o.Z)({}, a, {
                      onFocus: mn,
                      onClear: sn,
                      onTagClose: gn,
                      renderTag: Sn,
                      isContainerFocused: fe,
                      isRegionSelectionAtLimit: Fn(Ce) && rt(Ce),
                      __self: Dn,
                      __source: {
                        fileName: Bn,
                        lineNumber: 1300,
                        columnNumber: 13,
                      },
                    })
                  );
                return v
                  ? c().createElement(m.AdornedInput, {
                      input: l,
                      rightAdornment: Nn(),
                      __self: Dn,
                      __source: {
                        fileName: Bn,
                        lineNumber: 1314,
                        columnNumber: 20,
                      },
                    })
                  : l;
              },
              renderOption: function (e) {
                var n,
                  t = e.label,
                  r = e.notificationCount;
                e.appearance;
                var a,
                  l,
                  s = (0, i.Z)(e, ["label", "notificationCount", "appearance"]),
                  u = ((a = Ke()), "remote" === M && a.trim() ? a : null),
                  d = r
                    ? c().createElement($n, {
                        count: r,
                        maxSuffix: !0,
                        __self: Dn,
                        __source: {
                          fileName: Bn,
                          lineNumber: 1211,
                          columnNumber: 13,
                        },
                      })
                    : null;
                return (
                  "string" == typeof t &&
                    (l = c().createElement(
                      Kn,
                      {
                        __self: Dn,
                        __source: {
                          fileName: Bn,
                          lineNumber: 1218,
                          columnNumber: 17,
                        },
                      },
                      c().createElement(
                        Yn,
                        {
                          __self: Dn,
                          __source: {
                            fileName: Bn,
                            lineNumber: 1219,
                            columnNumber: 21,
                          },
                        },
                        c().createElement(m.Highlighter, {
                          text: t,
                          pattern: u,
                          __self: Dn,
                          __source: {
                            fileName: Bn,
                            lineNumber: 1220,
                            columnNumber: 25,
                          },
                        })
                      ),
                      d
                    )),
                  c().createElement(
                    m.ComboboxOption,
                    (0, o.Z)({}, s, {
                      label: null !== (n = l) && void 0 !== n ? n : t,
                      __self: Dn,
                      __source: {
                        fileName: Bn,
                        lineNumber: 1227,
                        columnNumber: 16,
                      },
                    })
                  )
                );
              },
              onOptionSelect: _n,
              options: et(U),
              onChange: function (e, n) {
                "clear input" === n.reason && rn(!1);
              },
              onKeyUp: function (e) {
                var n = e.currentTarget,
                  t = e.key;
                [
                  "Enter",
                  "ArrowDown",
                  "ArrowUp",
                  "ArrowLeft",
                  "ArrowRight",
                ].includes(t) || Je(n.value, "freeform");
              },
              placeholder: ze,
              value: En(),
              __self: Dn,
              __source: { fileName: Bn, lineNumber: 1355, columnNumber: 13 },
            }),
            Fn(Ce) &&
              rt(Ce) &&
              fe &&
              c().createElement(
                m.Paragraph,
                {
                  margin: "xs",
                  __self: Dn,
                  __source: {
                    fileName: Bn,
                    lineNumber: 1380,
                    columnNumber: 21,
                  },
                },
                "You can only search up to ",
                c().createElement(
                  "strong",
                  {
                    __self: Dn,
                    __source: {
                      fileName: Bn,
                      lineNumber: 1381,
                      columnNumber: 51,
                    },
                  },
                  "five locations"
                ),
                " at once."
              ),
            ie &&
              c().createElement(
                m.VisuallyHidden,
                {
                  "aria-live": "polite",
                  "aria-atomic": "true",
                  __self: Dn,
                  __source: {
                    fileName: Bn,
                    lineNumber: 1385,
                    columnNumber: 17,
                  },
                },
                c().createElement(
                  "p",
                  {
                    __self: Dn,
                    __source: {
                      fileName: Bn,
                      lineNumber: 1386,
                      columnNumber: 21,
                    },
                  },
                  ie
                )
              )
          );
        };
      lt.defaultProps = {
        fetchResultsError: function (e) {
          return console.log(e);
        },
        isCurrentLocationSearch: !1,
        isUserPositionInMapBounds: !1,
        onReCenter: function () {},
        showAdornments: !0,
        supportsLocationIcon: !1,
        trackSearchBoxInputFocus: function () {},
      };
      var ct = lt,
        st = void 0,
        ut = "/builds/zillow/searchxp/static-search-box/src/SearchBoxModal.tsx";
      function dt() {
        var e = (0, p.Z)([
          "\n    html,\n    body {\n        overflow: hidden !important;\n    }\n",
        ]);
        return (
          (dt = function () {
            return e;
          }),
          e
        );
      }
      var mt = (0, s.createGlobalStyle)(dt()),
        _t = u().div.withConfig({
          displayName: "SearchBoxModal__SearchBoxDialog",
          componentId: "xw1c73-0",
        })(
          [
            "&.fullscreen{position:fixed;top:0px;left:0px;z-index:",
            ";height:100%;width:100%;box-sizing:border-box;display:flex;justify-content:center;align-items:center;padding:0px;-webkit-overflow-scrolling:touch;}",
          ],
          (0, m.token)("zIndices.modal")
        ),
        ft = u().section.withConfig({
          displayName: "SearchBoxModal__SearchBoxDialogSection",
          componentId: "xw1c73-1",
        })(
          [
            ".fullscreen &{z-index:2;max-width:100%;border-radius:0px;min-height:100%;max-height:100%;box-sizing:border-box;background-color:",
            ";outline:none;position:relative;display:flex;flex-direction:column;height:auto;width:100%;form{margin-left:",
            "px;margin-right:",
            "px;}}",
          ],
          (0, m.token)("colors.backgroundWhite"),
          (0, m.token)("spacing.xl"),
          (0, m.token)("spacing.md")
        ),
        gt = u().div.withConfig({
          displayName: "SearchBoxModal__SearchBoxDialogBody",
          componentId: "xw1c73-2",
        })(
          [
            ".fullscreen &{overflow-y:auto;padding:12px ",
            "px 0px;flex:1 1 auto;margin-top:0px;section{box-shadow:none;border-top:1px solid ",
            ";border-color:none;margin-top:",
            "px !important;border-radius:0;ul{border:none;}}}form{position:relative;z-index:2;}",
          ],
          (0, m.token)("spacing.sm"),
          (0, m.token)("colors.borderDark"),
          (0, m.token)("spacing.xs")
        ),
        ht = u().div.withConfig({
          displayName: "SearchBoxModal__SearchBoxDialogClose",
          componentId: "xw1c73-3",
        })(
          [
            ".fullscreen &{position:absolute;z-index:",
            ";top:",
            "px;left:0px;}",
          ],
          (0, m.token)("zIndices.dialog"),
          (0, m.token)("spacing.xs")
        ),
        pt = u()(Mn).withConfig({
          displayName: "SearchBoxModal__StyledSearchBox",
          componentId: "xw1c73-4",
        })([".fullscreen &{position:absolute;left:0px;right:0px;}"]),
        St = u()(ct).withConfig({
          displayName: "SearchBoxModal__StyledSearchComboBox",
          componentId: "xw1c73-5",
        })([".fullscreen &{top:", "px;}"], (0, m.token)("spacing.xs")),
        Nt = u()(m.IconButton).withConfig({
          displayName: "SearchBoxModal__StyledIconButton",
          componentId: "xw1c73-6",
        })(["display:flex;"]),
        vt = function (e) {
          var n = e.children,
            t = e.fullScreen,
            r = e.onClose;
          return c().createElement(
            _t,
            {
              className: t ? "fullscreen" : "",
              "aria-label": "Search box modal",
              __self: st,
              __source: { fileName: ut, lineNumber: 124, columnNumber: 5 },
            },
            c().createElement(
              ft,
              {
                __self: st,
                __source: { fileName: ut, lineNumber: 125, columnNumber: 9 },
              },
              c().createElement(
                gt,
                {
                  __self: st,
                  __source: { fileName: ut, lineNumber: 126, columnNumber: 13 },
                },
                n
              ),
              t &&
                c().createElement(
                  ht,
                  {
                    __self: st,
                    __source: {
                      fileName: ut,
                      lineNumber: 128,
                      columnNumber: 17,
                    },
                  },
                  c().createElement(Nt, {
                    "aria-label": "Close modal",
                    title: "Close modal",
                    icon: c().createElement(m.IconChevronLeft, {
                      __self: st,
                      __source: {
                        fileName: ut,
                        lineNumber: 132,
                        columnNumber: 31,
                      },
                    }),
                    onClick: function () {
                      return r();
                    },
                    size: m.BUTTON_SIZES.md,
                    buttonType: "secondary",
                    type: "button",
                    bare: !0,
                    __self: st,
                    __source: {
                      fileName: ut,
                      lineNumber: 129,
                      columnNumber: 21,
                    },
                  })
                )
            ),
            t &&
              c().createElement(mt, {
                __self: st,
                __source: { fileName: ut, lineNumber: 142, columnNumber: 24 },
              })
          );
        },
        Et = function (e) {
          var n = (0, l.useState)(!1),
            t = (0, a.Z)(n, 2),
            r = t[0],
            i = t[1],
            s = e.modalDidUpdate,
            u = (0, l.useRef)();
          (0, l.useEffect)(function () {
            return clearTimeout(u.current);
          }, []);
          var d = (0, l.useCallback)(
              function () {
                i(!0), null == s || s(!0);
              },
              [s]
            ),
            m = (0, l.useCallback)(
              function (e) {
                var n, t;
                i(!1),
                  null == s || s(!1),
                  null === (n = e.current) ||
                    void 0 === n ||
                    null === (t = n.querySelector("input")) ||
                    void 0 === t ||
                    t.blur();
              },
              [s]
            ),
            _ = (0, l.useCallback)(
              function (e) {
                i(!0),
                  null == s || s(!0),
                  (u.current = setTimeout(function () {
                    var n, t;
                    return null === (n = e.current) ||
                      void 0 === n ||
                      null === (t = n.querySelector("input")) ||
                      void 0 === t
                      ? void 0
                      : t.focus();
                  }));
              },
              [s]
            ),
            f = (0, l.useCallback)(
              function () {
                i(!1), null == s || s(!1);
              },
              [s]
            );
          (0, l.useEffect)(
            function () {
              return f;
            },
            [f]
          );
          var g = Object.assign({}, e, {
              searchBoxDidFocusInput: d,
              searchBoxDidClickTag: _,
              searchBoxDidSelectOption: m,
              searchBoxOnPopState: m,
            }),
            h = Object.assign({}, e, {
              searchBoxDidFocusInput: d,
              searchBoxDidSelectOption: m,
              searchBoxOnPopState: m,
            });
          return c().createElement(
            vt,
            {
              fullScreen: r,
              onClose: f,
              __self: st,
              __source: { fileName: ut, lineNumber: 216, columnNumber: 9 },
            },
            (null == e ? void 0 : e.enableNaturalLanguageSearch)
              ? c().createElement(
                  pt,
                  (0, o.Z)({}, h, {
                    __self: st,
                    __source: {
                      fileName: ut,
                      lineNumber: 218,
                      columnNumber: 17,
                    },
                  })
                )
              : c().createElement(
                  St,
                  (0, o.Z)({}, g, {
                    __self: st,
                    __source: {
                      fileName: ut,
                      lineNumber: 220,
                      columnNumber: 17,
                    },
                  })
                )
          );
        };
    },
  },
]);
