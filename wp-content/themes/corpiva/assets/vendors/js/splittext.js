/*!
 * SplitText
 * https://github.com/netgfx/SplitText
 *
 * @license Copyright 2021, GreenSock. All rights reserved.
 * Subject to the terms at https://github.com/netgfx/SplitText?tab=MIT-1-ov-file#readme or for Club GreenSock members, the agreement issued with that membership.
 */
! function(D, u) {
    "object" == typeof exports && "undefined" != typeof module ? u(exports) : "function" == typeof define && define.amd ? define(["exports"], u) : u((D = D || self).window = D.window || {})
}(this, function(D) {
    "use strict";
    var _ = /([\uD800-\uDBFF][\uDC00-\uDFFF](?:[\u200D\uFE0F][\uD800-\uDBFF][\uDC00-\uDFFF]){2,}|\uD83D\uDC69(?:\u200D(?:(?:\uD83D\uDC69\u200D)?\uD83D\uDC67|(?:\uD83D\uDC69\u200D)?\uD83D\uDC66)|\uD83C[\uDFFB-\uDFFF])|\uD83D\uDC69\u200D(?:\uD83D\uDC69\u200D)?\uD83D\uDC66\u200D\uD83D\uDC66|\uD83D\uDC69\u200D(?:\uD83D\uDC69\u200D)?\uD83D\uDC67\u200D(?:\uD83D[\uDC66\uDC67])|\uD83C\uDFF3\uFE0F\u200D\uD83C\uDF08|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3D\uDD3E\uDDD6-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2640\u2642]\uFE0F|\uD83D\uDC69(?:\uD83C[\uDFFB-\uDFFF])\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92])|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC6F\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3C-\uDD3E\uDDD6-\uDDDF])\u200D[\u2640\u2642]\uFE0F|\uD83C\uDDFD\uD83C\uDDF0|\uD83C\uDDF6\uD83C\uDDE6|\uD83C\uDDF4\uD83C\uDDF2|\uD83C\uDDE9(?:\uD83C[\uDDEA\uDDEC\uDDEF\uDDF0\uDDF2\uDDF4\uDDFF])|\uD83C\uDDF7(?:\uD83C[\uDDEA\uDDF4\uDDF8\uDDFA\uDDFC])|\uD83C\uDDE8(?:\uD83C[\uDDE6\uDDE8\uDDE9\uDDEB-\uDDEE\uDDF0-\uDDF5\uDDF7\uDDFA-\uDDFF])|(?:\u26F9|\uD83C[\uDFCB\uDFCC]|\uD83D\uDD75)(?:\uFE0F\u200D[\u2640\u2642]|(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2640\u2642])\uFE0F|(?:\uD83D\uDC41\uFE0F\u200D\uD83D\uDDE8|\uD83D\uDC69(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2695\u2696\u2708]|\uD83D\uDC69\u200D[\u2695\u2696\u2708]|\uD83D\uDC68(?:(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2695\u2696\u2708]|\u200D[\u2695\u2696\u2708]))\uFE0F|\uD83C\uDDF2(?:\uD83C[\uDDE6\uDDE8-\uDDED\uDDF0-\uDDFF])|\uD83D\uDC69\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92]|\u2764\uFE0F\u200D(?:\uD83D\uDC8B\u200D(?:\uD83D[\uDC68\uDC69])|\uD83D[\uDC68\uDC69]))|\uD83C\uDDF1(?:\uD83C[\uDDE6-\uDDE8\uDDEE\uDDF0\uDDF7-\uDDFB\uDDFE])|\uD83C\uDDEF(?:\uD83C[\uDDEA\uDDF2\uDDF4\uDDF5])|\uD83C\uDDED(?:\uD83C[\uDDF0\uDDF2\uDDF3\uDDF7\uDDF9\uDDFA])|\uD83C\uDDEB(?:\uD83C[\uDDEE-\uDDF0\uDDF2\uDDF4\uDDF7])|[#\*0-9]\uFE0F\u20E3|\uD83C\uDDE7(?:\uD83C[\uDDE6\uDDE7\uDDE9-\uDDEF\uDDF1-\uDDF4\uDDF6-\uDDF9\uDDFB\uDDFC\uDDFE\uDDFF])|\uD83C\uDDE6(?:\uD83C[\uDDE8-\uDDEC\uDDEE\uDDF1\uDDF2\uDDF4\uDDF6-\uDDFA\uDDFC\uDDFD\uDDFF])|\uD83C\uDDFF(?:\uD83C[\uDDE6\uDDF2\uDDFC])|\uD83C\uDDF5(?:\uD83C[\uDDE6\uDDEA-\uDDED\uDDF0-\uDDF3\uDDF7-\uDDF9\uDDFC\uDDFE])|\uD83C\uDDFB(?:\uD83C[\uDDE6\uDDE8\uDDEA\uDDEC\uDDEE\uDDF3\uDDFA])|\uD83C\uDDF3(?:\uD83C[\uDDE6\uDDE8\uDDEA-\uDDEC\uDDEE\uDDF1\uDDF4\uDDF5\uDDF7\uDDFA\uDDFF])|\uD83C\uDFF4\uDB40\uDC67\uDB40\uDC62(?:\uDB40\uDC77\uDB40\uDC6C\uDB40\uDC73|\uDB40\uDC73\uDB40\uDC63\uDB40\uDC74|\uDB40\uDC65\uDB40\uDC6E\uDB40\uDC67)\uDB40\uDC7F|\uD83D\uDC68(?:\u200D(?:\u2764\uFE0F\u200D(?:\uD83D\uDC8B\u200D)?\uD83D\uDC68|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC66\u200D\uD83D\uDC66|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC67\u200D(?:\uD83D[\uDC66\uDC67])|\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92])|(?:\uD83C[\uDFFB-\uDFFF])\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92]))|\uD83C\uDDF8(?:\uD83C[\uDDE6-\uDDEA\uDDEC-\uDDF4\uDDF7-\uDDF9\uDDFB\uDDFD-\uDDFF])|\uD83C\uDDF0(?:\uD83C[\uDDEA\uDDEC-\uDDEE\uDDF2\uDDF3\uDDF5\uDDF7\uDDFC\uDDFE\uDDFF])|\uD83C\uDDFE(?:\uD83C[\uDDEA\uDDF9])|\uD83C\uDDEE(?:\uD83C[\uDDE8-\uDDEA\uDDF1-\uDDF4\uDDF6-\uDDF9])|\uD83C\uDDF9(?:\uD83C[\uDDE6\uDDE8\uDDE9\uDDEB-\uDDED\uDDEF-\uDDF4\uDDF7\uDDF9\uDDFB\uDDFC\uDDFF])|\uD83C\uDDEC(?:\uD83C[\uDDE6\uDDE7\uDDE9-\uDDEE\uDDF1-\uDDF3\uDDF5-\uDDFA\uDDFC\uDDFE])|\uD83C\uDDFA(?:\uD83C[\uDDE6\uDDEC\uDDF2\uDDF3\uDDF8\uDDFE\uDDFF])|\uD83C\uDDEA(?:\uD83C[\uDDE6\uDDE8\uDDEA\uDDEC\uDDED\uDDF7-\uDDFA])|\uD83C\uDDFC(?:\uD83C[\uDDEB\uDDF8])|(?:\u26F9|\uD83C[\uDFCB\uDFCC]|\uD83D\uDD75)(?:\uD83C[\uDFFB-\uDFFF])|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3D\uDD3E\uDDD6-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])|(?:[\u261D\u270A-\u270D]|\uD83C[\uDF85\uDFC2\uDFC7]|\uD83D[\uDC42\uDC43\uDC46-\uDC50\uDC66\uDC67\uDC70\uDC72\uDC74-\uDC76\uDC78\uDC7C\uDC83\uDC85\uDCAA\uDD74\uDD7A\uDD90\uDD95\uDD96\uDE4C\uDE4F\uDEC0\uDECC]|\uD83E[\uDD18-\uDD1C\uDD1E\uDD1F\uDD30-\uDD36\uDDD1-\uDDD5])(?:\uD83C[\uDFFB-\uDFFF])|\uD83D\uDC68(?:\u200D(?:(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC67|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC66)|\uD83C[\uDFFB-\uDFFF])|(?:[\u261D\u26F9\u270A-\u270D]|\uD83C[\uDF85\uDFC2-\uDFC4\uDFC7\uDFCA-\uDFCC]|\uD83D[\uDC42\uDC43\uDC46-\uDC50\uDC66-\uDC69\uDC6E\uDC70-\uDC78\uDC7C\uDC81-\uDC83\uDC85-\uDC87\uDCAA\uDD74\uDD75\uDD7A\uDD90\uDD95\uDD96\uDE45-\uDE47\uDE4B-\uDE4F\uDEA3\uDEB4-\uDEB6\uDEC0\uDECC]|\uD83E[\uDD18-\uDD1C\uDD1E\uDD1F\uDD26\uDD30-\uDD39\uDD3D\uDD3E\uDDD1-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])?|(?:[\u231A\u231B\u23E9-\u23EC\u23F0\u23F3\u25FD\u25FE\u2614\u2615\u2648-\u2653\u267F\u2693\u26A1\u26AA\u26AB\u26BD\u26BE\u26C4\u26C5\u26CE\u26D4\u26EA\u26F2\u26F3\u26F5\u26FA\u26FD\u2705\u270A\u270B\u2728\u274C\u274E\u2753-\u2755\u2757\u2795-\u2797\u27B0\u27BF\u2B1B\u2B1C\u2B50\u2B55]|\uD83C[\uDC04\uDCCF\uDD8E\uDD91-\uDD9A\uDDE6-\uDDFF\uDE01\uDE1A\uDE2F\uDE32-\uDE36\uDE38-\uDE3A\uDE50\uDE51\uDF00-\uDF20\uDF2D-\uDF35\uDF37-\uDF7C\uDF7E-\uDF93\uDFA0-\uDFCA\uDFCF-\uDFD3\uDFE0-\uDFF0\uDFF4\uDFF8-\uDFFF]|\uD83D[\uDC00-\uDC3E\uDC40\uDC42-\uDCFC\uDCFF-\uDD3D\uDD4B-\uDD4E\uDD50-\uDD67\uDD7A\uDD95\uDD96\uDDA4\uDDFB-\uDE4F\uDE80-\uDEC5\uDECC\uDED0-\uDED2\uDEEB\uDEEC\uDEF4-\uDEF8]|\uD83E[\uDD10-\uDD3A\uDD3C-\uDD3E\uDD40-\uDD45\uDD47-\uDD4C\uDD50-\uDD6B\uDD80-\uDD97\uDDC0\uDDD0-\uDDE6])|(?:[#\*0-9\xA9\xAE\u203C\u2049\u2122\u2139\u2194-\u2199\u21A9\u21AA\u231A\u231B\u2328\u23CF\u23E9-\u23F3\u23F8-\u23FA\u24C2\u25AA\u25AB\u25B6\u25C0\u25FB-\u25FE\u2600-\u2604\u260E\u2611\u2614\u2615\u2618\u261D\u2620\u2622\u2623\u2626\u262A\u262E\u262F\u2638-\u263A\u2640\u2642\u2648-\u2653\u2660\u2663\u2665\u2666\u2668\u267B\u267F\u2692-\u2697\u2699\u269B\u269C\u26A0\u26A1\u26AA\u26AB\u26B0\u26B1\u26BD\u26BE\u26C4\u26C5\u26C8\u26CE\u26CF\u26D1\u26D3\u26D4\u26E9\u26EA\u26F0-\u26F5\u26F7-\u26FA\u26FD\u2702\u2705\u2708-\u270D\u270F\u2712\u2714\u2716\u271D\u2721\u2728\u2733\u2734\u2744\u2747\u274C\u274E\u2753-\u2755\u2757\u2763\u2764\u2795-\u2797\u27A1\u27B0\u27BF\u2934\u2935\u2B05-\u2B07\u2B1B\u2B1C\u2B50\u2B55\u3030\u303D\u3297\u3299]|\uD83C[\uDC04\uDCCF\uDD70\uDD71\uDD7E\uDD7F\uDD8E\uDD91-\uDD9A\uDDE6-\uDDFF\uDE01\uDE02\uDE1A\uDE2F\uDE32-\uDE3A\uDE50\uDE51\uDF00-\uDF21\uDF24-\uDF93\uDF96\uDF97\uDF99-\uDF9B\uDF9E-\uDFF0\uDFF3-\uDFF5\uDFF7-\uDFFF]|\uD83D[\uDC00-\uDCFD\uDCFF-\uDD3D\uDD49-\uDD4E\uDD50-\uDD67\uDD6F\uDD70\uDD73-\uDD7A\uDD87\uDD8A-\uDD8D\uDD90\uDD95\uDD96\uDDA4\uDDA5\uDDA8\uDDB1\uDDB2\uDDBC\uDDC2-\uDDC4\uDDD1-\uDDD3\uDDDC-\uDDDE\uDDE1\uDDE3\uDDE8\uDDEF\uDDF3\uDDFA-\uDE4F\uDE80-\uDEC5\uDECB-\uDED2\uDEE0-\uDEE5\uDEE9\uDEEB\uDEEC\uDEF0\uDEF3-\uDEF8]|\uD83E[\uDD10-\uDD3A\uDD3C-\uDD3E\uDD40-\uDD45\uDD47-\uDD4C\uDD50-\uDD6B\uDD80-\uDD97\uDDC0\uDDD0-\uDDE6])\uFE0F)/;

    function k(D) {
        return e.getComputedStyle(D)
    }

    function n(D, u) {
        var e;
        return i(D) ? D : "string" == (e = typeof D) && !u && D ? E.call(X.querySelectorAll(D), 0) : D && "object" == e && "length" in D ? E.call(D, 0) : D ? [D] : []
    }

    function o(D) {
        return "absolute" === D.position || !0 === D.absolute
    }

    function p(D, u) {
        for (var e, t = u.length; - 1 < --t;)
            if (e = u[t], D.substr(0, e.length) === e) return e.length
    }

    function r(D, u) {
        void 0 === D && (D = "");
        var e = ~D.indexOf("++"),
            t = 1;
        return e && (D = D.split("++").join("")),
            function() {
                return "<" + u + " style='position:relative;display:inline-block;'" + (D ? " class='" + D + (e ? t++ : "") + "'>" : ">")
            }
    }

    function s(D, u, e) {
        var t = D.nodeType;
        if (1 === t || 9 === t || 11 === t)
            for (D = D.firstChild; D; D = D.nextSibling) s(D, u, e);
        else 3 !== t && 4 !== t || (D.nodeValue = D.nodeValue.split(u).join(e))
    }

    function t(D, u) {
        for (var e = u.length; - 1 < --e;) D.push(u[e])
    }

    function u(D, u, e) {
        for (var t; D && D !== u;) {
            if (t = D._next || D.nextSibling) return t.textContent.charAt(0) === e;
            D = D.parentNode || D._parent
        }
    }

    function v(D) {
        var u, e, t = n(D.childNodes),
            F = t.length;
        for (u = 0; u < F; u++)(e = t[u])._isSplit ? v(e) : u && e.previousSibling && 3 === e.previousSibling.nodeType ? (e.previousSibling.nodeValue += 3 === e.nodeType ? e.nodeValue : e.firstChild.nodeValue, D.removeChild(e)) : 3 !== e.nodeType && (D.insertBefore(e.firstChild, e), D.removeChild(e))
    }

    function w(D, u) {
        return parseFloat(u[D]) || 0
    }

    function x(D, e, F, C, i, n, E) {
        var r, l, p, d, a, h, B, f, A, c, x, g, y = k(D),
            _ = w("paddingLeft", y),
            b = -999,
            S = w("borderBottomWidth", y) + w("borderTopWidth", y),
            T = w("borderLeftWidth", y) + w("borderRightWidth", y),
            m = w("paddingTop", y) + w("paddingBottom", y),
            N = w("paddingLeft", y) + w("paddingRight", y),
            L = w("fontSize", y) * (e.lineThreshold || .2),
            W = y.textAlign,
            H = [],
            O = [],
            V = [],
            j = e.wordDelimiter || " ",
            M = e.tag ? e.tag : e.span ? "span" : "div",
            R = e.type || e.split || "chars,words,lines",
            z = i && ~R.indexOf("lines") ? [] : null,
            P = ~R.indexOf("words"),
            q = ~R.indexOf("chars"),
            G = o(e),
            I = e.linesClass,
            J = ~(I || "").indexOf("++"),
            K = [],
            Q = "flex" === y.display,
            U = D.style.display;
        for (J && (I = I.split("++").join("")), Q && (D.style.display = "block"), p = (l = D.getElementsByTagName("*")).length, a = [], r = 0; r < p; r++) a[r] = l[r];
        if (z || G)
            for (r = 0; r < p; r++)((h = (d = a[r]).parentNode === D) || G || q && !P) && (g = d.offsetTop, z && h && Math.abs(g - b) > L && ("BR" !== d.nodeName || 0 === r) && (B = [], z.push(B), b = g), G && (d._x = d.offsetLeft, d._y = g, d._w = d.offsetWidth, d._h = d.offsetHeight), z && ((d._isSplit && h || !q && h || P && h || !P && d.parentNode.parentNode === D && !d.parentNode._isSplit) && (B.push(d), d._x -= _, u(d, D, j) && (d._wordEnd = !0)), "BR" === d.nodeName && (d.nextSibling && "BR" === d.nextSibling.nodeName || 0 === r) && z.push([])));
        for (r = 0; r < p; r++)
            if (h = (d = a[r]).parentNode === D, "BR" !== d.nodeName)
                if (G && (A = d.style, P || h || (d._x += d.parentNode._x, d._y += d.parentNode._y), A.left = d._x + "px", A.top = d._y + "px", A.position = "absolute", A.display = "block", A.width = d._w + 1 + "px", A.height = d._h + "px"), !P && q)
                    if (d._isSplit)
                        for (d._next = l = d.nextSibling, d.parentNode.appendChild(d); l && 3 === l.nodeType && " " === l.textContent;) d._next = l.nextSibling, d.parentNode.appendChild(l), l = l.nextSibling;
                    else d.parentNode._isSplit ? (d._parent = d.parentNode, !d.previousSibling && d.firstChild && (d.firstChild._isFirst = !0), d.nextSibling && " " === d.nextSibling.textContent && !d.nextSibling.nextSibling && K.push(d.nextSibling), d._next = d.nextSibling && d.nextSibling._isFirst ? null : d.nextSibling, d.parentNode.removeChild(d), a.splice(r--, 1), p--) : h || (g = !d.nextSibling && u(d.parentNode, D, j), d.parentNode._parent && d.parentNode._parent.appendChild(d), g && d.parentNode.appendChild(X.createTextNode(" ")), "span" === M && (d.style.display = "inline"), H.push(d));
        else d.parentNode._isSplit && !d._isSplit && "" !== d.innerHTML ? O.push(d) : q && !d._isSplit && ("span" === M && (d.style.display = "inline"), H.push(d));
        else z || G ? (d.parentNode && d.parentNode.removeChild(d), a.splice(r--, 1), p--) : P || D.appendChild(d);
        for (r = K.length; - 1 < --r;) K[r].parentNode.removeChild(K[r]);
        if (z) {
            for (G && (c = X.createElement(M), D.appendChild(c), x = c.offsetWidth + "px", g = c.offsetParent === D ? 0 : D.offsetLeft, D.removeChild(c)), A = D.style.cssText, D.style.cssText = "display:none;"; D.firstChild;) D.removeChild(D.firstChild);
            for (f = " " === j && (!G || !P && !q), r = 0; r < z.length; r++) {
                for (B = z[r], (c = X.createElement(M)).style.cssText = "display:block;text-align:" + W + ";position:" + (G ? "absolute;" : "relative;"), I && (c.className = I + (J ? r + 1 : "")), V.push(c), p = B.length, l = 0; l < p; l++) "BR" !== B[l].nodeName && (d = B[l], c.appendChild(d), f && d._wordEnd && c.appendChild(X.createTextNode(" ")), G && (0 === l && (c.style.top = d._y + "px", c.style.left = _ + g + "px"), d.style.top = "0px", g && (d.style.left = d._x - g + "px")));
                0 === p ? c.innerHTML = "&nbsp;" : P || q || (v(c), s(c, String.fromCharCode(160), " ")), G && (c.style.width = x, c.style.height = d._h + "px"), D.appendChild(c)
            }
            D.style.cssText = A
        }
        G && (E > D.clientHeight && (D.style.height = E - m + "px", D.clientHeight < E && (D.style.height = E + S + "px")), n > D.clientWidth && (D.style.width = n - N + "px", D.clientWidth < n && (D.style.width = n + T + "px"))), Q && (U ? D.style.display = U : D.style.removeProperty("display")), t(F, H), P && t(C, O), t(i, V)
    }

    function y(D, u, e, t) {
        var F, C, i, n, E, r, l, d, a = u.tag ? u.tag : u.span ? "span" : "div",
            h = ~(u.type || u.split || "chars,words,lines").indexOf("chars"),
            B = o(u),
            f = u.wordDelimiter || " ",
            A = " " !== f ? "" : B ? "&#173; " : " ",
            c = "</" + a + ">",
            x = 1,
            g = u.specialChars ? "function" == typeof u.specialChars ? u.specialChars : p : null,
            y = X.createElement("div"),
            v = D.parentNode;
        for (v.insertBefore(y, D), y.textContent = D.nodeValue, v.removeChild(D), l = -1 !== (F = function getText(D) {
                var u = D.nodeType,
                    e = "";
                if (1 === u || 9 === u || 11 === u) {
                    if ("string" == typeof D.textContent) return D.textContent;
                    for (D = D.firstChild; D; D = D.nextSibling) e += getText(D)
                } else if (3 === u || 4 === u) return D.nodeValue;
                return e
            }(D = y)).indexOf("<"), !1 !== u.reduceWhiteSpace && (F = F.replace(S, " ").replace(b, "")), l && (F = F.split("<").join("{{LT}}")), E = F.length, C = (" " === F.charAt(0) ? A : "") + e(), i = 0; i < E; i++)
            if (r = F.charAt(i), g && (d = g(F.substr(i), u.specialChars))) r = F.substr(i, d || 1), C += h && " " !== r ? t() + r + "</" + a + ">" : r, i += d - 1;
            else if (r === f && F.charAt(i - 1) !== f && i) {
            for (C += x ? c : "", x = 0; F.charAt(i + 1) === f;) C += A, i++;
            i === E - 1 ? C += A : ")" !== F.charAt(i + 1) && (C += A + e(), x = 1)
        } else "{" === r && "{{LT}}" === F.substr(i, 6) ? (C += h ? t() + "{{LT}}</" + a + ">" : "{{LT}}", i += 5) : 55296 <= r.charCodeAt(0) && r.charCodeAt(0) <= 56319 || 65024 <= F.charCodeAt(i + 1) && F.charCodeAt(i + 1) <= 65039 ? (n = ((F.substr(i, 12).split(_) || [])[1] || "").length || 2, C += h && " " !== r ? t() + F.substr(i, n) + "</" + a + ">" : F.substr(i, n), i += n - 1) : C += h && " " !== r ? t() + r + "</" + a + ">" : r;
        D.outerHTML = C + (x ? c : ""), l && s(v, "{{LT}}", "<")
    }

    function z(D, u, e, t) {
        var F, C, i = n(D.childNodes),
            E = i.length,
            s = o(u);
        if (3 !== D.nodeType || 1 < E) {
            for (u.absolute = !1, F = 0; F < E; F++)(C = i[F])._next = C._isFirst = C._parent = C._wordEnd = null, 3 === C.nodeType && !/\S+/.test(C.nodeValue) || (s && 3 !== C.nodeType && "inline" === k(C).display && (C.style.display = "inline-block", C.style.position = "relative"), C._isSplit = !0, z(C, u, e, t));
            return u.absolute = s, void(D._isSplit = !0)
        }
        y(D, u, e, t)
    }
    var X, e, F, C, b = /(?:\r|\n|\t\t)/g,
        S = /(?:\s\s+)/g,
        i = Array.isArray,
        E = [].slice,
        l = ((C = SplitText.prototype).split = function split(D) {
            this.isSplit && this.revert(), this.vars = D = D || this.vars, this._originals.length = this.chars.length = this.words.length = this.lines.length = 0;
            for (var u, e, t, F = this.elements.length, C = D.tag ? D.tag : D.span ? "span" : "div", i = r(D.wordsClass, C), n = r(D.charsClass, C); - 1 < --F;) t = this.elements[F], this._originals[F] = t.innerHTML, u = t.clientHeight, e = t.clientWidth, z(t, D, i, n), x(t, D, this.chars, this.words, this.lines, e, u);
            return this.chars.reverse(), this.words.reverse(), this.lines.reverse(), this.isSplit = !0, this
        }, C.revert = function revert() {
            var e = this._originals;
            if (!e) throw "revert() call wasn't scoped properly.";
            return this.elements.forEach(function(D, u) {
                return D.innerHTML = e[u]
            }), this.chars = [], this.words = [], this.lines = [], this.isSplit = !1, this
        }, SplitText.create = function create(D, u) {
            return new SplitText(D, u)
        }, SplitText);

    function SplitText(D, u) {
        F || function _initCore() {
            X = document, e = window, F = 1
        }(), this.elements = n(D), this.chars = [], this.words = [], this.lines = [], this._originals = [], this.vars = u || {}, this.split(u)
    }
    l.version = "3.6.1", D.SplitText = l, D.default = l;
    if (typeof(window) === "undefined" || window !== D) {
        Object.defineProperty(D, "__esModule", {
            value: !0
        })
    } else {
        delete D.default
    }
});

! function(t, e) {
    "object" == typeof exports && "undefined" != typeof module ? e(exports) : "function" == typeof define && define.amd ? define(["exports"], e) : e((t = t || self).window = t.window || {})
}(this, function(e) {
    "use strict";

    function _inheritsLoose(t, e) {
        t.prototype = Object.create(e.prototype), (t.prototype.constructor = t).__proto__ = e
    }

    function _assertThisInitialized(t) {
        if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return t
    }

    function o(t) {
        return "string" == typeof t
    }

    function p(t) {
        return "function" == typeof t
    }

    function q(t) {
        return "number" == typeof t
    }

    function r(t) {
        return void 0 === t
    }

    function s(t) {
        return "object" == typeof t
    }

    function t(t) {
        return !1 !== t
    }

    function u() {
        return "undefined" != typeof window
    }

    function v(t) {
        return p(t) || o(t)
    }

    function M(t) {
        return (h = mt(t, ot)) && he
    }

    function N(t, e) {
        return console.warn("Invalid property", t, "set to", e, "Missing plugin? gsplit.registerPlugin()")
    }

    function O(t, e) {
        return !e && console.warn(t)
    }

    function P(t, e) {
        return t && (ot[t] = e) && h && (h[t] = e) || ot
    }

    function Q() {
        return 0
    }

    function $(t) {
        var e, r, i = t[0];
        if (s(i) || p(i) || (t = [t]), !(e = (i._gsplit || {}).harness)) {
            for (r = pt.length; r-- && !pt[r].targetTest(i););
            e = pt[r]
        }
        for (r = t.length; r--;) t[r] && (t[r]._gsplit || (t[r]._gsplit = new Lt(t[r], e))) || t.splice(r, 1);
        return t
    }

    function _(t) {
        return t._gsplit || $(xt(t))[0]._gsplit
    }

    function aa(t, e, i) {
        return (i = t[e]) && p(i) ? t[e]() : r(i) && t.getAttribute && t.getAttribute(e) || i
    }

    function ba(t, e) {
        return (t = t.split(",")).forEach(e) || t
    }

    function ca(t) {
        return Math.round(1e5 * t) / 1e5 || 0
    }

    function da(t) {
        return Math.round(1e7 * t) / 1e7 || 0
    }

    function ea(t, e) {
        var r = e.charAt(0),
            i = parseFloat(e.substr(2));
        return t = parseFloat(t), "+" === r ? t + i : "-" === r ? t - i : "*" === r ? t * i : t / i
    }

    function fa(t, e) {
        for (var r = e.length, i = 0; t.indexOf(e[i]) < 0 && ++i < r;);
        return i < r
    }

    function ga() {
        var t, e, r = ht.length,
            i = ht.slice(0);
        for (lt = {}, t = ht.length = 0; t < r; t++)(e = i[t]) && e._lazy && (e.render(e._lazy[0], e._lazy[1], !0)._lazy = 0)
    }

    function ha(t, e, r, i) {
        ht.length && ga(), t.render(e, r, i), ht.length && ga()
    }

    function ia(t) {
        var e = parseFloat(t);
        return (e || 0 === e) && (t + "").match(at).length < 2 ? e : o(t) ? t.trim() : t
    }

    function ja(t) {
        return t
    }

    function ka(t, e) {
        for (var r in e) r in t || (t[r] = e[r]);
        return t
    }

    function na(t, e) {
        for (var r in e) "__proto__" !== r && "constructor" !== r && "prototype" !== r && (t[r] = s(e[r]) ? na(t[r] || (t[r] = {}), e[r]) : e[r]);
        return t
    }

    function oa(t, e) {
        var r, i = {};
        for (r in t) r in e || (i[r] = t[r]);
        return i
    }

    function pa(e) {
        var r = e.parent || I,
            i = e.keyframes ? function _setKeyframeDefaults(i) {
                return function(t, e) {
                    for (var r in e) r in t || "duration" === r && i || "ease" === r || (t[r] = e[r])
                }
            }(J(e.keyframes)) : ka;
        if (t(e.inherit))
            for (; r;) i(e, r.vars.defaults), r = r.parent || r._dp;
        return e
    }

    function ra(t, e, r, i, n) {
        void 0 === r && (r = "_first"), void 0 === i && (i = "_last");
        var a, s = t[i];
        if (n)
            for (a = e[n]; s && s[n] > a;) s = s._prev;
        return s ? (e._next = s._next, s._next = e) : (e._next = t[r], t[r] = e), e._next ? e._next._prev = e : t[i] = e, e._prev = s, e.parent = e._dp = t, e
    }

    function sa(t, e, r, i) {
        void 0 === r && (r = "_first"), void 0 === i && (i = "_last");
        var n = e._prev,
            a = e._next;
        n ? n._next = a : t[r] === e && (t[r] = a), a ? a._prev = n : t[i] === e && (t[i] = n), e._next = e._prev = e.parent = null
    }

    function ta(t, e) {
        !t.parent || e && !t.parent.autoRemoveChildren || t.parent.remove(t), t._act = 0
    }

    function ua(t, e) {
        if (t && (!e || e._end > t._dur || e._start < 0))
            for (var r = t; r;) r._dirty = 1, r = r.parent;
        return t
    }

    function xa(t) {
        return t._repeat ? gt(t._tTime, t = t.duration() + t._rDelay) * t : 0
    }

    function za(t, e) {
        return (t - e._start) * e._ts + (0 <= e._ts ? 0 : e._dirty ? e.totalDuration() : e._tDur)
    }

    function Aa(t) {
        return t._end = da(t._start + (t._tDur / Math.abs(t._ts || t._rts || V) || 0))
    }

    function Ba(t, e) {
        var r = t._dp;
        return r && r.smoothChildTiming && t._ts && (t._start = da(r._time - (0 < t._ts ? e / t._ts : ((t._dirty ? t.totalDuration() : t._tDur) - e) / -t._ts)), Aa(t), r._dirty || ua(r, t)), t
    }

    function Ca(t, e) {
        var r;
        if ((e._time || e._initted && !e._dur) && (r = za(t.rawTime(), e), (!e._dur || bt(0, e.totalDuration(), r) - e._tTime > V) && e.render(r, !0)), ua(t, e)._dp && t._initted && t._time >= t._dur && t._ts) {
            if (t._dur < t.duration())
                for (r = t; r._dp;) 0 <= r.rawTime() && r.totalTime(r._tTime), r = r._dp;
            t._zTime = -V
        }
    }

    function Da(t, e, r, i) {
        return e.parent && ta(e), e._start = da((q(r) ? r : r || t !== I ? Tt(t, r, e) : t._time) + e._delay), e._end = da(e._start + (e.totalDuration() / Math.abs(e.timeScale()) || 0)), ra(t, e, "_first", "_last", t._sort ? "_start" : 0), vt(e) || (t._recent = e), i || Ca(t, e), t
    }

    function Ea(t, e) {
        return (ot.ScrollTrigger || N("scrollTrigger", e)) && ot.ScrollTrigger.create(e, t)
    }

    function Fa(t, e, r, i) {
        return Xt(t, e), t._initted ? !r && t._pt && (t._dur && !1 !== t.vars.lazy || !t._dur && t.vars.lazy) && f !== Dt.frame ? (ht.push(t), t._lazy = [e, i], 1) : void 0 : 1
    }

    function Ka(t, e, r, i) {
        var n = t._repeat,
            a = da(e) || 0,
            s = t._tTime / t._tDur;
        return s && !i && (t._time *= a / t._dur), t._dur = a, t._tDur = n ? n < 0 ? 1e10 : da(a * (n + 1) + t._rDelay * n) : a, 0 < s && !i ? Ba(t, t._tTime = t._tDur * s) : t.parent && Aa(t), r || ua(t.parent, t), t
    }

    function La(t) {
        return t instanceof Ut ? ua(t) : Ka(t, t._dur)
    }

    function Oa(e, r, i) {
        var n, a, s = q(r[1]),
            o = (s ? 2 : 1) + (e < 2 ? 0 : 1),
            u = r[o];
        if (s && (u.duration = r[1]), u.parent = i, e) {
            for (n = u, a = i; a && !("immediateRender" in n);) n = a.vars.defaults || {}, a = t(a.vars.inherit) && a.parent;
            u.immediateRender = t(n.immediateRender), e < 2 ? u.runBackwards = 1 : u.startAt = r[o - 1]
        }
        return new $t(r[0], u, r[1 + o])
    }

    function Pa(t, e) {
        return t || 0 === t ? e(t) : e
    }

    function Ra(t, e) {
        return o(t) && (e = st.exec(t)) ? e[1] : ""
    }

    function Ua(t, e) {
        return t && s(t) && "length" in t && (!e && !t.length || t.length - 1 in t && s(t[0])) && !t.nodeType && t !== i
    }

    function Ya(t) {
        return t.sort(function() {
            return .5 - Math.random()
        })
    }

    function Za(t) {
        if (p(t)) return t;
        var c = s(t) ? t : {
                each: t
            },
            m = Bt(c.ease),
            g = c.from || 0,
            v = parseFloat(c.base) || 0,
            y = {},
            e = 0 < g && g < 1,
            T = isNaN(g) || e,
            b = c.axis,
            w = g,
            x = g;
        return o(g) ? w = x = {
                center: .5,
                edges: .5,
                end: 1
            }[g] || 0 : !e && T && (w = g[0], x = g[1]),
            function(t, e, r) {
                var i, n, a, s, o, u, h, l, f, d = (r || c).length,
                    _ = y[d];
                if (!_) {
                    if (!(f = "auto" === c.grid ? 0 : (c.grid || [1, Y])[1])) {
                        for (h = -Y; h < (h = r[f++].getBoundingClientRect().left) && f < d;);
                        f--
                    }
                    for (_ = y[d] = [], i = T ? Math.min(f, d) * w - .5 : g % f, n = f === Y ? 0 : T ? d * x / f - .5 : g / f | 0, l = Y, u = h = 0; u < d; u++) a = u % f - i, s = n - (u / f | 0), _[u] = o = b ? Math.abs("y" === b ? s : a) : G(a * a + s * s), h < o && (h = o), o < l && (l = o);
                    "random" === g && Ya(_), _.max = h - l, _.min = l, _.v = d = (parseFloat(c.amount) || parseFloat(c.each) * (d < f ? d - 1 : b ? "y" === b ? d / f : f : Math.max(f, d / f)) || 0) * ("edges" === g ? -1 : 1), _.b = d < 0 ? v - d : v, _.u = Ra(c.amount || c.each) || 0, m = m && d < 0 ? Ft(m) : m
                }
                return d = (_[t] - _.min) / _.max || 0, da(_.b + (m ? m(d) : d) * _.v) + _.u
            }
    }

    function $a(r) {
        var i = Math.pow(10, ((r + "").split(".")[1] || "").length);
        return function(t) {
            var e = Math.round(parseFloat(t) / r) * r * i;
            return (e - e % 1) / i + (q(t) ? 0 : Ra(t))
        }
    }

    function _a(u, t) {
        var h, l, e = J(u);
        return !e && s(u) && (h = e = u.radius || Y, u.values ? (u = xt(u.values), (l = !q(u[0])) && (h *= h)) : u = $a(u.increment)), Pa(t, e ? p(u) ? function(t) {
            return l = u(t), Math.abs(l - t) <= h ? l : t
        } : function(t) {
            for (var e, r, i = parseFloat(l ? t.x : t), n = parseFloat(l ? t.y : 0), a = Y, s = 0, o = u.length; o--;)(e = l ? (e = u[o].x - i) * e + (r = u[o].y - n) * r : Math.abs(u[o] - i)) < a && (a = e, s = o);
            return s = !h || a <= h ? u[s] : t, l || s === t || q(t) ? s : s + Ra(t)
        } : $a(u))
    }

    function ab(t, e, r, i) {
        return Pa(J(t) ? !e : !0 === r ? !!(r = 0) : !i, function() {
            return J(t) ? t[~~(Math.random() * t.length)] : (r = r || 1e-5) && (i = r < 1 ? Math.pow(10, (r + "").length - 2) : 1) && Math.floor(Math.round((t - r / 2 + Math.random() * (e - t + .99 * r)) / r) * r * i) / i
        })
    }

    function eb(e, r, t) {
        return Pa(t, function(t) {
            return e[~~r(t)]
        })
    }

    function hb(t) {
        for (var e, r, i, n, a = 0, s = ""; ~(e = t.indexOf("random(", a));) i = t.indexOf(")", e), n = "[" === t.charAt(e + 7), r = t.substr(e + 7, i - e - 7).match(n ? at : tt), s += t.substr(a, e - a) + ab(n ? r : +r[0], n ? 0 : +r[1], +r[2] || 1e-5), a = i + 1;
        return s + t.substr(a, t.length - a)
    }

    function kb(t, e, r) {
        var i, n, a, s = t.labels,
            o = Y;
        for (i in s)(n = s[i] - e) < 0 == !!r && n && o > (n = Math.abs(n)) && (a = i, o = n);
        return a
    }

    function mb(t) {
        return ta(t), t.scrollTrigger && t.scrollTrigger.kill(!1), t.progress() < 1 && Ot(t, "onInterrupt"), t
    }

    function rb(t, e, r) {
        return (6 * (t += t < 0 ? 1 : 1 < t ? -1 : 0) < 1 ? e + (r - e) * t * 6 : t < .5 ? r : 3 * t < 2 ? e + (r - e) * (2 / 3 - t) * 6 : e) * Pt + .5 | 0
    }

    function sb(t, e, r) {
        var i, n, a, s, o, u, h, l, f, d, _ = t ? q(t) ? [t >> 16, t >> 8 & Pt, t & Pt] : 0 : Mt.black;
        if (!_) {
            if ("," === t.substr(-1) && (t = t.substr(0, t.length - 1)), Mt[t]) _ = Mt[t];
            else if ("#" === t.charAt(0)) {
                if (t.length < 6 && (t = "#" + (i = t.charAt(1)) + i + (n = t.charAt(2)) + n + (a = t.charAt(3)) + a + (5 === t.length ? t.charAt(4) + t.charAt(4) : "")), 9 === t.length) return [(_ = parseInt(t.substr(1, 6), 16)) >> 16, _ >> 8 & Pt, _ & Pt, parseInt(t.substr(7), 16) / 255];
                _ = [(t = parseInt(t.substr(1), 16)) >> 16, t >> 8 & Pt, t & Pt]
            } else if ("hsl" === t.substr(0, 3))
                if (_ = d = t.match(tt), e) {
                    if (~t.indexOf("=")) return _ = t.match(et), r && _.length < 4 && (_[3] = 1), _
                } else s = +_[0] % 360 / 360, o = _[1] / 100, i = 2 * (u = _[2] / 100) - (n = u <= .5 ? u * (o + 1) : u + o - u * o), 3 < _.length && (_[3] *= 1), _[0] = rb(s + 1 / 3, i, n), _[1] = rb(s, i, n), _[2] = rb(s - 1 / 3, i, n);
            else _ = t.match(tt) || Mt.transparent;
            _ = _.map(Number)
        }
        return e && !d && (i = _[0] / Pt, n = _[1] / Pt, a = _[2] / Pt, u = ((h = Math.max(i, n, a)) + (l = Math.min(i, n, a))) / 2, h === l ? s = o = 0 : (f = h - l, o = .5 < u ? f / (2 - h - l) : f / (h + l), s = h === i ? (n - a) / f + (n < a ? 6 : 0) : h === n ? (a - i) / f + 2 : (i - n) / f + 4, s *= 60), _[0] = ~~(s + .5), _[1] = ~~(100 * o + .5), _[2] = ~~(100 * u + .5)), r && _.length < 4 && (_[3] = 1), _
    }

    function tb(t) {
        var r = [],
            i = [],
            n = -1;
        return t.split(Ct).forEach(function(t) {
            var e = t.match(rt) || [];
            r.push.apply(r, e), i.push(n += e.length + 1)
        }), r.c = i, r
    }

    function ub(t, e, r) {
        var i, n, a, s, o = "",
            u = (t + o).match(Ct),
            h = e ? "hsla(" : "rgba(",
            l = 0;
        if (!u) return t;
        if (u = u.map(function(t) {
                return (t = sb(t, e, 1)) && h + (e ? t[0] + "," + t[1] + "%," + t[2] + "%," + t[3] : t.join(",")) + ")"
            }), r && (a = tb(t), (i = r.c).join(o) !== a.c.join(o)))
            for (s = (n = t.replace(Ct, "1").split(rt)).length - 1; l < s; l++) o += n[l] + (~i.indexOf(l) ? u.shift() || h + "0,0,0,0)" : (a.length ? a : u.length ? u : r).shift());
        if (!n)
            for (s = (n = t.split(Ct)).length - 1; l < s; l++) o += n[l] + u[l];
        return o + n[s]
    }

    function xb(t) {
        var e, r = t.join(" ");
        if (Ct.lastIndex = 0, Ct.test(r)) return e = At.test(r), t[1] = ub(t[1], e), t[0] = ub(t[0], e, tb(t[1])), !0
    }

    function Gb(t) {
        var e = (t + "").split("("),
            r = zt[e[0]];
        return r && 1 < e.length && r.config ? r.config.apply(null, ~t.indexOf("{") ? [function _parseObjectInString(t) {
            for (var e, r, i, n = {}, a = t.substr(1, t.length - 3).split(":"), s = a[0], o = 1, u = a.length; o < u; o++) r = a[o], e = o !== u - 1 ? r.lastIndexOf(",") : r.length, i = r.substr(0, e), n[s] = isNaN(i) ? i.replace(Et, "").trim() : +i, s = r.substr(e + 1).trim();
            return n
        }(e[1])] : function _valueInParentheses(t) {
            var e = t.indexOf("(") + 1,
                r = t.indexOf(")"),
                i = t.indexOf("(", e);
            return t.substring(e, ~i && i < r ? t.indexOf(")", r + 1) : r)
        }(t).split(",").map(ia)) : zt._CE && Rt.test(t) ? zt._CE("", t) : r
    }

    function Ib(t, e) {
        for (var r, i = t._first; i;) i instanceof Ut ? Ib(i, e) : !i.vars.yoyoEase || i._yoyo && i._repeat || i._yoyo === e || (i.timeline ? Ib(i.timeline, e) : (r = i._ease, i._ease = i._yEase, i._yEase = r, i._yoyo = e)), i = i._next
    }

    function Kb(t, e, r, i) {
        void 0 === r && (r = function easeOut(t) {
            return 1 - e(1 - t)
        }), void 0 === i && (i = function easeInOut(t) {
            return t < .5 ? e(2 * t) / 2 : 1 - e(2 * (1 - t)) / 2
        });
        var n, a = {
            easeIn: e,
            easeOut: r,
            easeInOut: i
        };
        return ba(t, function(t) {
            for (var e in zt[t] = ot[t] = a, zt[n = t.toLowerCase()] = r, a) zt[n + ("easeIn" === e ? ".in" : "easeOut" === e ? ".out" : ".inOut")] = zt[t + "." + e] = a[e]
        }), a
    }

    function Lb(e) {
        return function(t) {
            return t < .5 ? (1 - e(1 - 2 * t)) / 2 : .5 + e(2 * (t - .5)) / 2
        }
    }

    function Mb(r, t, e) {
        function em(t) {
            return 1 === t ? 1 : i * Math.pow(2, -10 * t) * Z((t - a) * n) + 1
        }
        var i = 1 <= t ? t : 1,
            n = (e || (r ? .3 : .45)) / (t < 1 ? t : 1),
            a = n / X * (Math.asin(1 / i) || 0),
            s = "out" === r ? em : "in" === r ? function(t) {
                return 1 - em(1 - t)
            } : Lb(em);
        return n = X / n, s.config = function(t, e) {
            return Mb(r, t, e)
        }, s
    }

    function Nb(e, r) {
        function mm(t) {
            return t ? --t * t * ((r + 1) * t + r) + 1 : 0
        }
        void 0 === r && (r = 1.70158);
        var t = "out" === e ? mm : "in" === e ? function(t) {
            return 1 - mm(1 - t)
        } : Lb(mm);
        return t.config = function(t) {
            return Nb(e, t)
        }, t
    }
    var B, I, i, n, a, h, l, f, d, c, m, g, y, T, b, w, x, k, C, A, D, S, z, R, E, F, U = {
            autoSleep: 120,
            force3D: "auto",
            nullTargetWarn: 1,
            units: {
                lineHeight: ""
            }
        },
        L = {
            duration: .5,
            overwrite: !1,
            delay: 0
        },
        Y = 1e8,
        V = 1 / Y,
        X = 2 * Math.PI,
        j = X / 4,
        K = 0,
        G = Math.sqrt,
        W = Math.cos,
        Z = Math.sin,
        H = "function" == typeof ArrayBuffer && ArrayBuffer.isView || function() {},
        J = Array.isArray,
        tt = /(?:-?\.?\d|\.)+/gi,
        et = /[-+=.]*\d+[.e\-+]*\d*[e\-+]*\d*/g,
        rt = /[-+=.]*\d+[.e-]*\d*[a-z%]*/g,
        it = /[-+=.]*\d+\.?\d*(?:e-|e\+)?\d*/gi,
        nt = /[+-]=-?[.\d]+/,
        at = /[^,'"\[\]\s]+/gi,
        st = /^[+\-=e\s\d]*\d+[.\d]*([a-z]*|%)\s*$/i,
        ot = {},
        ut = {},
        ht = [],
        lt = {},
        ft = {},
        dt = {},
        _t = 30,
        pt = [],
        ct = "",
        mt = function _merge(t, e) {
            for (var r in e) t[r] = e[r];
            return t
        },
        gt = function _animationCycle(t, e) {
            var r = Math.floor(t /= e);
            return t && r === t ? r - 1 : r
        },
        vt = function _isFromOrFromStart(t) {
            var e = t.data;
            return "isFromStart" === e || "isStart" === e
        },
        yt = {
            _start: 0,
            endTime: Q,
            totalDuration: Q
        },
        Tt = function _parsePosition(t, e, r) {
            var i, n, a, s = t.labels,
                u = t._recent || yt,
                h = t.duration() >= Y ? u.endTime(!1) : t._dur;
            return o(e) && (isNaN(e) || e in s) ? (n = e.charAt(0), a = "%" === e.substr(-1), i = e.indexOf("="), "<" === n || ">" === n ? (0 <= i && (e = e.replace(/=/, "")), ("<" === n ? u._start : u.endTime(0 <= u._repeat)) + (parseFloat(e.substr(1)) || 0) * (a ? (i < 0 ? u : r).totalDuration() / 100 : 1)) : i < 0 ? (e in s || (s[e] = h), s[e]) : (n = parseFloat(e.charAt(i - 1) + e.substr(i + 1)), a && r && (n = n / 100 * (J(r) ? r[0] : r).totalDuration()), 1 < i ? _parsePosition(t, e.substr(0, i - 1), r) + n : h + n)) : null == e ? h : +e
        },
        bt = function _clamp(t, e, r) {
            return r < t ? t : e < r ? e : r
        },
        wt = [].slice,
        xt = function toArray(t, e, r) {
            return !o(t) || r || !n && St() ? J(t) ? function _flatten(t, e, r) {
                return void 0 === r && (r = []), t.forEach(function(t) {
                    return o(t) && !e || Ua(t, 1) ? r.push.apply(r, xt(t)) : r.push(t)
                }) || r
            }(t, r) : Ua(t) ? wt.call(t, 0) : t ? [t] : [] : wt.call((e || a).querySelectorAll(t), 0)
        },
        kt = function mapRange(e, t, r, i, n) {
            var a = t - e,
                s = i - r;
            return Pa(n, function(t) {
                return r + ((t - e) / a * s || 0)
            })
        },
        Ot = function _callback(t, e, r) {
            var i, n, a = t.vars,
                s = a[e];
            if (s) return i = a[e + "Params"], n = a.callbackScope || t, r && ht.length && ga(), i ? s.apply(n, i) : s.call(n)
        },
        Pt = 255,
        Mt = {
            aqua: [0, Pt, Pt],
            lime: [0, Pt, 0],
            silver: [192, 192, 192],
            black: [0, 0, 0],
            maroon: [128, 0, 0],
            teal: [0, 128, 128],
            blue: [0, 0, Pt],
            navy: [0, 0, 128],
            white: [Pt, Pt, Pt],
            olive: [128, 128, 0],
            yellow: [Pt, Pt, 0],
            orange: [Pt, 165, 0],
            gray: [128, 128, 128],
            purple: [128, 0, 128],
            green: [0, 128, 0],
            red: [Pt, 0, 0],
            pink: [Pt, 192, 203],
            cyan: [0, Pt, Pt],
            transparent: [Pt, Pt, Pt, 0]
        },
        Ct = function() {
            var t, e = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#(?:[0-9a-f]{3,4}){1,2}\\b";
            for (t in Mt) e += "|" + t + "\\b";
            return new RegExp(e + ")", "gi")
        }(),
        At = /hsl[a]?\(/,
        Dt = (x = Date.now, k = 500, C = 33, A = x(), D = A, z = S = 1e3 / 240, T = {
            time: 0,
            frame: 0,
            tick: function tick() {
                Vk(!0)
            },
            deltaRatio: function deltaRatio(t) {
                return b / (1e3 / (t || 60))
            },
            wake: function wake() {
                l && (!n && u() && (i = n = window, a = i.document || {}, ot.gsplit = he, (i.gsplitVersions || (i.gsplitVersions = [])).push(he.version), M(h || i.GreenSockGlobals || !i.gsplit && i || {}), y = i.requestAnimationFrame), m && T.sleep(), g = y || function(t) {
                    return setTimeout(t, z - 1e3 * T.time + 1 | 0)
                }, c = 1, Vk(2))
            },
            sleep: function sleep() {
                (y ? i.cancelAnimationFrame : clearTimeout)(m), c = 0, g = Q
            },
            lagSmoothing: function lagSmoothing(t, e) {
                k = t || 1e8, C = Math.min(e, k, 0)
            },
            fps: function fps(t) {
                S = 1e3 / (t || 240), z = 1e3 * T.time + S
            },
            add: function add(n, t, e) {
                var a = t ? function(t, e, r, i) {
                    n(t, e, r, i), T.remove(a)
                } : n;
                return T.remove(n), R[e ? "unshift" : "push"](a), St(), a
            },
            remove: function remove(t, e) {
                ~(e = R.indexOf(t)) && R.splice(e, 1) && e <= w && w--
            },
            _listeners: R = []
        }),
        St = function _wake() {
            return !c && Dt.wake()
        },
        zt = {},
        Rt = /^[\d.\-M][\d.\-,\s]/,
        Et = /["']/g,
        Ft = function _invertEase(e) {
            return function(t) {
                return 1 - e(1 - t)
            }
        },
        Bt = function _parseEase(t, e) {
            return t && (p(t) ? t : zt[t] || Gb(t)) || e
        };

    function Vk(t) {
        var e, r, i, n, a = x() - D,
            s = !0 === t;
        if (k < a && (A += a - C), (0 < (e = (i = (D += a) - A) - z) || s) && (n = ++T.frame, b = i - 1e3 * T.time, T.time = i /= 1e3, z += e + (S <= e ? 4 : S - e), r = 1), s || (m = g(Vk)), r)
            for (w = 0; w < R.length; w++) R[w](i, b, n, t)
    }

    function Dm(t) {
        return t < F ? E * t * t : t < .7272727272727273 ? E * Math.pow(t - 1.5 / 2.75, 2) + .75 : t < .9090909090909092 ? E * (t -= 2.25 / 2.75) * t + .9375 : E * Math.pow(t - 2.625 / 2.75, 2) + .984375
    }
    ba("Linear,Quad,Cubic,Quart,Quint,Strong", function(t, e) {
        var r = e < 5 ? e + 1 : e;
        Kb(t + ",Power" + (r - 1), e ? function(t) {
            return Math.pow(t, r)
        } : function(t) {
            return t
        }, function(t) {
            return 1 - Math.pow(1 - t, r)
        }, function(t) {
            return t < .5 ? Math.pow(2 * t, r) / 2 : 1 - Math.pow(2 * (1 - t), r) / 2
        })
    }), zt.Linear.easeNone = zt.none = zt.Linear.easeIn, Kb("Elastic", Mb("in"), Mb("out"), Mb()), E = 7.5625, F = 1 / 2.75, Kb("Bounce", function(t) {
        return 1 - Dm(1 - t)
    }, Dm), Kb("Expo", function(t) {
        return t ? Math.pow(2, 10 * (t - 1)) : 0
    }), Kb("Circ", function(t) {
        return -(G(1 - t * t) - 1)
    }), Kb("Sine", function(t) {
        return 1 === t ? 1 : 1 - W(t * j)
    }), Kb("Back", Nb("in"), Nb("out"), Nb()), zt.SteppedEase = zt.steps = ot.SteppedEase = {
        config: function config(t, e) {
            void 0 === t && (t = 1);
            var r = 1 / t,
                i = t + (e ? 0 : 1),
                n = e ? 1 : 0;
            return function(t) {
                return ((i * bt(0, .99999999, t) | 0) + n) * r
            }
        }
    }, L.ease = zt["quad.out"], ba("onComplete,onUpdate,onStart,onRepeat,onReverseComplete,onInterrupt", function(t) {
        return ct += t + "," + t + "Params,"
    });
    var It, Lt = function GSCache(t, e) {
            this.id = K++, (t._gsplit = this).target = t, this.harness = e, this.get = e ? e.get : aa, this.set = e ? e.getSetter : Ht
        },
        Nt = ((It = Animation.prototype).delay = function delay(t) {
            return t || 0 === t ? (this.parent && this.parent.smoothChildTiming && this.startTime(this._start + t - this._delay), this._delay = t, this) : this._delay
        }, It.duration = function duration(t) {
            return arguments.length ? this.totalDuration(0 < this._repeat ? t + (t + this._rDelay) * this._repeat : t) : this.totalDuration() && this._dur
        }, It.totalDuration = function totalDuration(t) {
            return arguments.length ? (this._dirty = 0, Ka(this, this._repeat < 0 ? t : (t - this._repeat * this._rDelay) / (this._repeat + 1))) : this._tDur
        }, It.totalTime = function totalTime(t, e) {
            if (St(), !arguments.length) return this._tTime;
            var r = this._dp;
            if (r && r.smoothChildTiming && this._ts) {
                for (Ba(this, t), !r._dp || r.parent || Ca(r, this); r && r.parent;) r.parent._time !== r._start + (0 <= r._ts ? r._tTime / r._ts : (r.totalDuration() - r._tTime) / -r._ts) && r.totalTime(r._tTime, !0), r = r.parent;
                !this.parent && this._dp.autoRemoveChildren && (0 < this._ts && t < this._tDur || this._ts < 0 && 0 < t || !this._tDur && !t) && Da(this._dp, this, this._start - this._delay)
            }
            return (this._tTime !== t || !this._dur && !e || this._initted && Math.abs(this._zTime) === V || !t && !this._initted && (this.add || this._ptLookup)) && (this._ts || (this._pTime = t), ha(this, t, e)), this
        }, It.time = function time(t, e) {
            return arguments.length ? this.totalTime(Math.min(this.totalDuration(), t + xa(this)) % (this._dur + this._rDelay) || (t ? this._dur : 0), e) : this._time
        }, It.totalProgress = function totalProgress(t, e) {
            return arguments.length ? this.totalTime(this.totalDuration() * t, e) : this.totalDuration() ? Math.min(1, this._tTime / this._tDur) : this.ratio
        }, It.progress = function progress(t, e) {
            return arguments.length ? this.totalTime(this.duration() * (!this._yoyo || 1 & this.iteration() ? t : 1 - t) + xa(this), e) : this.duration() ? Math.min(1, this._time / this._dur) : this.ratio
        }, It.iteration = function iteration(t, e) {
            var r = this.duration() + this._rDelay;
            return arguments.length ? this.totalTime(this._time + (t - 1) * r, e) : this._repeat ? gt(this._tTime, r) + 1 : 1
        }, It.timeScale = function timeScale(t) {
            if (!arguments.length) return this._rts === -V ? 0 : this._rts;
            if (this._rts === t) return this;
            var e = this.parent && this._ts ? za(this.parent._time, this) : this._tTime;
            return this._rts = +t || 0, this._ts = this._ps || t === -V ? 0 : this._rts, this.totalTime(bt(-this._delay, this._tDur, e), !0), Aa(this),
                function _recacheAncestors(t) {
                    for (var e = t.parent; e && e.parent;) e._dirty = 1, e.totalDuration(), e = e.parent;
                    return t
                }(this)
        }, It.paused = function paused(t) {
            return arguments.length ? (this._ps !== t && ((this._ps = t) ? (this._pTime = this._tTime || Math.max(-this._delay, this.rawTime()), this._ts = this._act = 0) : (St(), this._ts = this._rts, this.totalTime(this.parent && !this.parent.smoothChildTiming ? this.rawTime() : this._tTime || this._pTime, 1 === this.progress() && Math.abs(this._zTime) !== V && (this._tTime -= V)))), this) : this._ps
        }, It.startTime = function startTime(t) {
            if (arguments.length) {
                this._start = t;
                var e = this.parent || this._dp;
                return !e || !e._sort && this.parent || Da(e, this, t - this._delay), this
            }
            return this._start
        }, It.endTime = function endTime(e) {
            return this._start + (t(e) ? this.totalDuration() : this.duration()) / Math.abs(this._ts || 1)
        }, It.rawTime = function rawTime(t) {
            var e = this.parent || this._dp;
            return e ? t && (!this._ts || this._repeat && this._time && this.totalProgress() < 1) ? this._tTime % (this._dur + this._rDelay) : this._ts ? za(e.rawTime(t), this) : this._tTime : this._tTime
        }, It.globalTime = function globalTime(t) {
            for (var e = this, r = arguments.length ? t : e.rawTime(); e;) r = e._start + r / (e._ts || 1), e = e._dp;
            return r
        }, It.repeat = function repeat(t) {
            return arguments.length ? (this._repeat = t === 1 / 0 ? -2 : t, La(this)) : -2 === this._repeat ? 1 / 0 : this._repeat
        }, It.repeatDelay = function repeatDelay(t) {
            if (arguments.length) {
                var e = this._time;
                return this._rDelay = t, La(this), e ? this.time(e) : this
            }
            return this._rDelay
        }, It.yoyo = function yoyo(t) {
            return arguments.length ? (this._yoyo = t, this) : this._yoyo
        }, It.seek = function seek(e, r) {
            return this.totalTime(Tt(this, e), t(r))
        }, It.restart = function restart(e, r) {
            return this.play().totalTime(e ? -this._delay : 0, t(r))
        }, It.play = function play(t, e) {
            return null != t && this.seek(t, e), this.reversed(!1).paused(!1)
        }, It.reverse = function reverse(t, e) {
            return null != t && this.seek(t || this.totalDuration(), e), this.reversed(!0).paused(!1)
        }, It.pause = function pause(t, e) {
            return null != t && this.seek(t, e), this.paused(!0)
        }, It.resume = function resume() {
            return this.paused(!1)
        }, It.reversed = function reversed(t) {
            return arguments.length ? (!!t !== this.reversed() && this.timeScale(-this._rts || (t ? -V : 0)), this) : this._rts < 0
        }, It.invalidate = function invalidate() {
            return this._initted = this._act = 0, this._zTime = -V, this
        }, It.isActive = function isActive() {
            var t, e = this.parent || this._dp,
                r = this._start;
            return !(e && !(this._ts && this._initted && e.isActive() && (t = e.rawTime(!0)) >= r && t < this.endTime(!0) - V))
        }, It.eventCallback = function eventCallback(t, e, r) {
            var i = this.vars;
            return 1 < arguments.length ? (e ? (i[t] = e, r && (i[t + "Params"] = r), "onUpdate" === t && (this._onUpdate = e)) : delete i[t], this) : i[t]
        }, It.then = function then(t) {
            var i = this;
            return new Promise(function(e) {
                function Un() {
                    var t = i.then;
                    i.then = null, p(r) && (r = r(i)) && (r.then || r === i) && (i.then = t), e(r), i.then = t
                }
                var r = p(t) ? t : ja;
                i._initted && 1 === i.totalProgress() && 0 <= i._ts || !i._tTime && i._ts < 0 ? Un() : i._prom = Un
            })
        }, It.kill = function kill() {
            mb(this)
        }, Animation);

    function Animation(t) {
        this.vars = t, this._delay = +t.delay || 0, (this._repeat = t.repeat === 1 / 0 ? -2 : t.repeat || 0) && (this._rDelay = t.repeatDelay || 0, this._yoyo = !!t.yoyo || !!t.yoyoEase), this._ts = 1, Ka(this, +t.duration, 1, 1), this.data = t.data, c || Dt.wake()
    }
    ka(Nt.prototype, {
        _time: 0,
        _start: 0,
        _end: 0,
        _tTime: 0,
        _tDur: 0,
        _dirty: 0,
        _repeat: 0,
        _yoyo: !1,
        parent: null,
        _initted: !1,
        _rDelay: 0,
        _ts: 1,
        _dp: 0,
        ratio: 0,
        _zTime: -V,
        _prom: 0,
        _ps: !1,
        _rts: 1
    });
    var Ut = function(n) {
        function Timeline(e, r) {
            var i;
            return void 0 === e && (e = {}), (i = n.call(this, e) || this).labels = {}, i.smoothChildTiming = !!e.smoothChildTiming, i.autoRemoveChildren = !!e.autoRemoveChildren, i._sort = t(e.sortChildren), I && Da(e.parent || I, _assertThisInitialized(i), r), e.reversed && i.reverse(), e.paused && i.paused(!0), e.scrollTrigger && Ea(_assertThisInitialized(i), e.scrollTrigger), i
        }
        _inheritsLoose(Timeline, n);
        var e = Timeline.prototype;
        return e.to = function to(t, e, r) {
            return Oa(0, arguments, this), this
        }, e.from = function from(t, e, r) {
            return Oa(1, arguments, this), this
        }, e.fromTo = function fromTo(t, e, r, i) {
            return Oa(2, arguments, this), this
        }, e.set = function set(t, e, r) {
            return e.duration = 0, e.parent = this, pa(e).repeatDelay || (e.repeat = 0), e.immediateRender = !!e.immediateRender, new $t(t, e, Tt(this, r), 1), this
        }, e.call = function call(t, e, r) {
            return Da(this, $t.delayedCall(0, t, e), r)
        }, e.staggerTo = function staggerTo(t, e, r, i, n, a, s) {
            return r.duration = e, r.stagger = r.stagger || i, r.onComplete = a, r.onCompleteParams = s, r.parent = this, new $t(t, r, Tt(this, n)), this
        }, e.staggerFrom = function staggerFrom(e, r, i, n, a, s, o) {
            return i.runBackwards = 1, pa(i).immediateRender = t(i.immediateRender), this.staggerTo(e, r, i, n, a, s, o)
        }, e.staggerFromTo = function staggerFromTo(e, r, i, n, a, s, o, u) {
            return n.startAt = i, pa(n).immediateRender = t(n.immediateRender), this.staggerTo(e, r, n, a, s, o, u)
        }, e.render = function render(t, e, r) {
            var i, n, a, s, o, u, h, l, f, d, _, p, c = this._time,
                m = this._dirty ? this.totalDuration() : this._tDur,
                g = this._dur,
                v = t <= 0 ? 0 : da(t),
                y = this._zTime < 0 != t < 0 && (this._initted || !g);
            if (this !== I && m < v && 0 <= t && (v = m), v !== this._tTime || r || y) {
                if (c !== this._time && g && (v += this._time - c, t += this._time - c), i = v, f = this._start, u = !(l = this._ts), y && (g || (c = this._zTime), !t && e || (this._zTime = t)), this._repeat) {
                    if (_ = this._yoyo, o = g + this._rDelay, this._repeat < -1 && t < 0) return this.totalTime(100 * o + t, e, r);
                    if (i = da(v % o), v === m ? (s = this._repeat, i = g) : ((s = ~~(v / o)) && s === v / o && (i = g, s--), g < i && (i = g)), d = gt(this._tTime, o), !c && this._tTime && d !== s && (d = s), _ && 1 & s && (i = g - i, p = 1), s !== d && !this._lock) {
                        var T = _ && 1 & d,
                            b = T === (_ && 1 & s);
                        if (s < d && (T = !T), c = T ? 0 : g, this._lock = 1, this.render(c || (p ? 0 : da(s * o)), e, !g)._lock = 0, this._tTime = v, !e && this.parent && Ot(this, "onRepeat"), this.vars.repeatRefresh && !p && (this.invalidate()._lock = 1), c && c !== this._time || u != !this._ts || this.vars.onRepeat && !this.parent && !this._act) return this;
                        if (g = this._dur, m = this._tDur, b && (this._lock = 2, c = T ? g : -1e-4, this.render(c, !0), this.vars.repeatRefresh && !p && this.invalidate()), this._lock = 0, !this._ts && !u) return this;
                        Ib(this, p)
                    }
                }
                if (this._hasPause && !this._forcing && this._lock < 2 && (h = function _findNextPauseTween(t, e, r) {
                        var i;
                        if (e < r)
                            for (i = t._first; i && i._start <= r;) {
                                if ("isPause" === i.data && i._start > e) return i;
                                i = i._next
                            } else
                                for (i = t._last; i && i._start >= r;) {
                                    if ("isPause" === i.data && i._start < e) return i;
                                    i = i._prev
                                }
                    }(this, da(c), da(i))) && (v -= i - (i = h._start)), this._tTime = v, this._time = i, this._act = !l, this._initted || (this._onUpdate = this.vars.onUpdate, this._initted = 1, this._zTime = t, c = 0), !c && i && !e && (Ot(this, "onStart"), this._tTime !== v)) return this;
                if (c <= i && 0 <= t)
                    for (n = this._first; n;) {
                        if (a = n._next, (n._act || i >= n._start) && n._ts && h !== n) {
                            if (n.parent !== this) return this.render(t, e, r);
                            if (n.render(0 < n._ts ? (i - n._start) * n._ts : (n._dirty ? n.totalDuration() : n._tDur) + (i - n._start) * n._ts, e, r), i !== this._time || !this._ts && !u) {
                                h = 0, a && (v += this._zTime = -V);
                                break
                            }
                        }
                        n = a
                    } else {
                        n = this._last;
                        for (var w = t < 0 ? t : i; n;) {
                            if (a = n._prev, (n._act || w <= n._end) && n._ts && h !== n) {
                                if (n.parent !== this) return this.render(t, e, r);
                                if (n.render(0 < n._ts ? (w - n._start) * n._ts : (n._dirty ? n.totalDuration() : n._tDur) + (w - n._start) * n._ts, e, r), i !== this._time || !this._ts && !u) {
                                    h = 0, a && (v += this._zTime = w ? -V : V);
                                    break
                                }
                            }
                            n = a
                        }
                    }
                if (h && !e && (this.pause(), h.render(c <= i ? 0 : -V)._zTime = c <= i ? 1 : -1, this._ts)) return this._start = f, Aa(this), this.render(t, e, r);
                this._onUpdate && !e && Ot(this, "onUpdate", !0), (v === m && this._tTime >= this.totalDuration() || !v && c) && (f !== this._start && Math.abs(l) === Math.abs(this._ts) || this._lock || (!t && g || !(v === m && 0 < this._ts || !v && this._ts < 0) || ta(this, 1), e || t < 0 && !c || !v && !c && m || (Ot(this, v === m && 0 <= t ? "onComplete" : "onReverseComplete", !0), !this._prom || v < m && 0 < this.timeScale() || this._prom())))
            }
            return this
        }, e.add = function add(t, e) {
            var r = this;
            if (q(e) || (e = Tt(this, e, t)), !(t instanceof Nt)) {
                if (J(t)) return t.forEach(function(t) {
                    return r.add(t, e)
                }), this;
                if (o(t)) return this.addLabel(t, e);
                if (!p(t)) return this;
                t = $t.delayedCall(0, t)
            }
            return this !== t ? Da(this, t, e) : this
        }, e.getChildren = function getChildren(t, e, r, i) {
            void 0 === t && (t = !0), void 0 === e && (e = !0), void 0 === r && (r = !0), void 0 === i && (i = -Y);
            for (var n = [], a = this._first; a;) a._start >= i && (a instanceof $t ? e && n.push(a) : (r && n.push(a), t && n.push.apply(n, a.getChildren(!0, e, r)))), a = a._next;
            return n
        }, e.getById = function getById(t) {
            for (var e = this.getChildren(1, 1, 1), r = e.length; r--;)
                if (e[r].vars.id === t) return e[r]
        }, e.remove = function remove(t) {
            return o(t) ? this.removeLabel(t) : p(t) ? this.killTweensOf(t) : (sa(this, t), t === this._recent && (this._recent = this._last), ua(this))
        }, e.totalTime = function totalTime(t, e) {
            return arguments.length ? (this._forcing = 1, !this._dp && this._ts && (this._start = da(Dt.time - (0 < this._ts ? t / this._ts : (this.totalDuration() - t) / -this._ts))), n.prototype.totalTime.call(this, t, e), this._forcing = 0, this) : this._tTime
        }, e.addLabel = function addLabel(t, e) {
            return this.labels[t] = Tt(this, e), this
        }, e.removeLabel = function removeLabel(t) {
            return delete this.labels[t], this
        }, e.addPause = function addPause(t, e, r) {
            var i = $t.delayedCall(0, e || Q, r);
            return i.data = "isPause", this._hasPause = 1, Da(this, i, Tt(this, t))
        }, e.removePause = function removePause(t) {
            var e = this._first;
            for (t = Tt(this, t); e;) e._start === t && "isPause" === e.data && ta(e), e = e._next
        }, e.killTweensOf = function killTweensOf(t, e, r) {
            for (var i = this.getTweensOf(t, r), n = i.length; n--;) Yt !== i[n] && i[n].kill(t, e);
            return this
        }, e.getTweensOf = function getTweensOf(t, e) {
            for (var r, i = [], n = xt(t), a = this._first, s = q(e); a;) a instanceof $t ? fa(a._targets, n) && (s ? (!Yt || a._initted && a._ts) && a.globalTime(0) <= e && a.globalTime(a.totalDuration()) > e : !e || a.isActive()) && i.push(a) : (r = a.getTweensOf(n, e)).length && i.push.apply(i, r), a = a._next;
            return i
        }, e.tweenTo = function tweenTo(t, e) {
            e = e || {};
            var r, i = this,
                n = Tt(i, t),
                a = e.startAt,
                s = e.onStart,
                o = e.onStartParams,
                u = e.immediateRender,
                h = $t.to(i, ka({
                    ease: e.ease || "none",
                    lazy: !1,
                    immediateRender: !1,
                    time: n,
                    overwrite: "auto",
                    duration: e.duration || Math.abs((n - (a && "time" in a ? a.time : i._time)) / i.timeScale()) || V,
                    onStart: function onStart() {
                        if (i.pause(), !r) {
                            var t = e.duration || Math.abs((n - (a && "time" in a ? a.time : i._time)) / i.timeScale());
                            h._dur !== t && Ka(h, t, 0, 1).render(h._time, !0, !0), r = 1
                        }
                        s && s.apply(h, o || [])
                    }
                }, e));
            return u ? h.render(0) : h
        }, e.tweenFromTo = function tweenFromTo(t, e, r) {
            return this.tweenTo(e, ka({
                startAt: {
                    time: Tt(this, t)
                }
            }, r))
        }, e.recent = function recent() {
            return this._recent
        }, e.nextLabel = function nextLabel(t) {
            return void 0 === t && (t = this._time), kb(this, Tt(this, t))
        }, e.previousLabel = function previousLabel(t) {
            return void 0 === t && (t = this._time), kb(this, Tt(this, t), 1)
        }, e.currentLabel = function currentLabel(t) {
            return arguments.length ? this.seek(t, !0) : this.previousLabel(this._time + V)
        }, e.shiftChildren = function shiftChildren(t, e, r) {
            void 0 === r && (r = 0);
            for (var i, n = this._first, a = this.labels; n;) n._start >= r && (n._start += t, n._end += t), n = n._next;
            if (e)
                for (i in a) a[i] >= r && (a[i] += t);
            return ua(this)
        }, e.invalidate = function invalidate() {
            var t = this._first;
            for (this._lock = 0; t;) t.invalidate(), t = t._next;
            return n.prototype.invalidate.call(this)
        }, e.clear = function clear(t) {
            void 0 === t && (t = !0);
            for (var e, r = this._first; r;) e = r._next, this.remove(r), r = e;
            return this._dp && (this._time = this._tTime = this._pTime = 0), t && (this.labels = {}), ua(this)
        }, e.totalDuration = function totalDuration(t) {
            var e, r, i, n = 0,
                a = this,
                s = a._last,
                o = Y;
            if (arguments.length) return a.timeScale((a._repeat < 0 ? a.duration() : a.totalDuration()) / (a.reversed() ? -t : t));
            if (a._dirty) {
                for (i = a.parent; s;) e = s._prev, s._dirty && s.totalDuration(), o < (r = s._start) && a._sort && s._ts && !a._lock ? (a._lock = 1, Da(a, s, r - s._delay, 1)._lock = 0) : o = r, r < 0 && s._ts && (n -= r, (!i && !a._dp || i && i.smoothChildTiming) && (a._start += r / a._ts, a._time -= r, a._tTime -= r), a.shiftChildren(-r, !1, -Infinity), o = 0), s._end > n && s._ts && (n = s._end), s = e;
                Ka(a, a === I && a._time > n ? a._time : n, 1, 1), a._dirty = 0
            }
            return a._tDur
        }, Timeline.updateRoot = function updateRoot(t) {
            if (I._ts && (ha(I, za(t, I)), f = Dt.frame), Dt.frame >= _t) {
                _t += U.autoSleep || 120;
                var e = I._first;
                if ((!e || !e._ts) && U.autoSleep && Dt._listeners.length < 2) {
                    for (; e && !e._ts;) e = e._next;
                    e || Dt.sleep()
                }
            }
        }, Timeline
    }(Nt);
    ka(Ut.prototype, {
        _lock: 0,
        _hasPause: 0,
        _forcing: 0
    });

    function Ub(t, e, r, i, n, a) {
        var u, h, l, f;
        if (ft[t] && !1 !== (u = new ft[t]).init(n, u.rawVars ? e[t] : function _processVars(t, e, r, i, n) {
                if (p(t) && (t = Qt(t, n, e, r, i)), !s(t) || t.style && t.nodeType || J(t) || H(t)) return o(t) ? Qt(t, n, e, r, i) : t;
                var a, u = {};
                for (a in t) u[a] = Qt(t[a], n, e, r, i);
                return u
            }(e[t], i, n, a, r), r, i, a) && (r._pt = h = new oe(r._pt, n, t, 0, 1, u.render, u, 0, u.priority), r !== d))
            for (l = r._ptLookup[r._targets.indexOf(n)], f = u._props.length; f--;) l[u._props[f]] = h;
        return u
    }

    function $b(t, r, e, i) {
        var n, a, s = r.ease || i || "power1.inOut";
        if (J(r)) a = e[t] || (e[t] = []), r.forEach(function(t, e) {
            return a.push({
                t: e / (r.length - 1) * 100,
                v: t,
                e: s
            })
        });
        else
            for (n in r) a = e[n] || (e[n] = []), "ease" === n || a.push({
                t: parseFloat(t),
                v: r[n],
                e: s
            })
    }
    var Yt, qt, Vt = function _addPropTween(t, e, r, i, n, a, s, u, h) {
            p(i) && (i = i(n || 0, t, a));
            var l, f = t[e],
                d = "get" !== r ? r : p(f) ? h ? t[e.indexOf("set") || !p(t["get" + e.substr(3)]) ? e : "get" + e.substr(3)](h) : t[e]() : f,
                _ = p(f) ? h ? Zt : Wt : Gt;
            if (o(i) && (~i.indexOf("random(") && (i = hb(i)), "=" === i.charAt(1) && (!(l = ea(d, i) + (Ra(d) || 0)) && 0 !== l || (i = l))), d !== i || qt) return isNaN(d * i) || "" === i ? (f || e in t || N(e, i), function _addComplexStringPropTween(t, e, r, i, n, a, s) {
                var o, u, h, l, f, d, _, p, c = new oe(this._pt, t, e, 0, 1, ee, null, n),
                    m = 0,
                    g = 0;
                for (c.b = r, c.e = i, r += "", (_ = ~(i += "").indexOf("random(")) && (i = hb(i)), a && (a(p = [r, i], t, e), r = p[0], i = p[1]), u = r.match(it) || []; o = it.exec(i);) l = o[0], f = i.substring(m, o.index), h ? h = (h + 1) % 5 : "rgba(" === f.substr(-5) && (h = 1), l !== u[g++] && (d = parseFloat(u[g - 1]) || 0, c._pt = {
                    _next: c._pt,
                    p: f || 1 === g ? f : ",",
                    s: d,
                    c: "=" === l.charAt(1) ? ea(d, l) - d : parseFloat(l) - d,
                    m: h && h < 4 ? Math.round : 0
                }, m = it.lastIndex);
                return c.c = m < i.length ? i.substring(m, i.length) : "", c.fp = s, (nt.test(i) || _) && (c.e = 0), this._pt = c
            }.call(this, t, e, d, i, _, u || U.stringFilter, h)) : (l = new oe(this._pt, t, e, +d || 0, i - (d || 0), "boolean" == typeof f ? te : Jt, 0, _), h && (l.fp = h), s && l.modifier(s, this, t), this._pt = l)
        },
        Xt = function _initTween(e, r) {
            var i, n, a, s, o, u, h, l, f, d, p, c, m, g = e.vars,
                v = g.ease,
                y = g.startAt,
                T = g.immediateRender,
                b = g.lazy,
                w = g.onUpdate,
                x = g.onUpdateParams,
                k = g.callbackScope,
                O = g.runBackwards,
                P = g.yoyoEase,
                M = g.keyframes,
                C = g.autoRevert,
                A = e._dur,
                D = e._startAt,
                S = e._targets,
                z = e.parent,
                R = z && "nested" === z.data ? z.parent._targets : S,
                E = "auto" === e._overwrite && !B,
                F = e.timeline;
            if (!F || M && v || (v = "none"), e._ease = Bt(v, L.ease), e._yEase = P ? Ft(Bt(!0 === P ? v : P, L.ease)) : 0, P && e._yoyo && !e._repeat && (P = e._yEase, e._yEase = e._ease, e._ease = P), e._from = !F && !!g.runBackwards, !F || M && !g.stagger) {
                if (c = (l = S[0] ? _(S[0]).harness : 0) && g[l.prop], i = oa(g, ut), D && (ta(D.render(-1, !0)), D._lazy = 0), y)
                    if (ta(e._startAt = $t.set(S, ka({
                            data: "isStart",
                            overwrite: !1,
                            parent: z,
                            immediateRender: !0,
                            lazy: t(b),
                            startAt: null,
                            delay: 0,
                            onUpdate: w,
                            onUpdateParams: x,
                            callbackScope: k,
                            stagger: 0
                        }, y))), r < 0 && !T && !C && e._startAt.render(-1, !0), T) {
                        if (0 < r && !C && (e._startAt = 0), A && r <= 0) return void(r && (e._zTime = r))
                    } else !1 === C && (e._startAt = 0);
                else if (O && A)
                    if (D) C || (e._startAt = 0);
                    else if (r && (T = !1), a = ka({
                        overwrite: !1,
                        data: "isFromStart",
                        lazy: T && t(b),
                        immediateRender: T,
                        stagger: 0,
                        parent: z
                    }, i), c && (a[l.prop] = c), ta(e._startAt = $t.set(S, a)), r < 0 && e._startAt.render(-1, !0), e._zTime = r, T) {
                    if (!r) return
                } else _initTween(e._startAt, V);
                for (e._pt = e._ptCache = 0, b = A && t(b) || b && !A, n = 0; n < S.length; n++) {
                    if (h = (o = S[n])._gsplit || $(S)[n]._gsplit, e._ptLookup[n] = d = {}, lt[h.id] && ht.length && ga(), p = R === S ? n : R.indexOf(o), l && !1 !== (f = new l).init(o, c || i, e, p, R) && (e._pt = s = new oe(e._pt, o, f.name, 0, 1, f.render, f, 0, f.priority), f._props.forEach(function(t) {
                            d[t] = s
                        }), f.priority && (u = 1)), !l || c)
                        for (a in i) ft[a] && (f = Ub(a, i, e, p, o, R)) ? f.priority && (u = 1) : d[a] = s = Vt.call(e, o, a, "get", i[a], p, R, 0, g.stringFilter);
                    e._op && e._op[n] && e.kill(o, e._op[n]), E && e._pt && (Yt = e, I.killTweensOf(o, d, e.globalTime(r)), m = !e.parent, Yt = 0), e._pt && b && (lt[h.id] = 1)
                }
                u && se(e), e._onInit && e._onInit(e)
            }
            e._onUpdate = w, e._initted = (!e._op || e._pt) && !m, M && r <= 0 && F.render(Y, !0, !0)
        },
        Qt = function _parseFuncOrString(t, e, r, i, n) {
            return p(t) ? t.call(e, r, i, n) : o(t) && ~t.indexOf("random(") ? hb(t) : t
        },
        jt = ct + "repeat,repeatDelay,yoyo,repeatRefresh,yoyoEase,autoRevert",
        Kt = {};
    ba(jt + ",id,stagger,delay,duration,paused,scrollTrigger", function(t) {
        return Kt[t] = 1
    });
    var $t = function(R) {
        function Tween(e, r, i, n) {
            var a;
            "number" == typeof r && (i.duration = r, r = i, i = null);
            var o, u, h, l, f, d, _, p, c = (a = R.call(this, n ? r : pa(r)) || this).vars,
                m = c.duration,
                g = c.delay,
                y = c.immediateRender,
                T = c.stagger,
                b = c.overwrite,
                w = c.keyframes,
                x = c.defaults,
                k = c.scrollTrigger,
                P = c.yoyoEase,
                M = r.parent || I,
                C = (J(e) || H(e) ? q(e[0]) : "length" in r) ? [e] : xt(e);
            if (a._targets = C.length ? $(C) : O("GSPLIT target " + e + " not found. https://greensock.com", !U.nullTargetWarn) || [], a._ptLookup = [], a._overwrite = b, w || T || v(m) || v(g)) {
                if (r = a.vars, (o = a.timeline = new Ut({
                        data: "nested",
                        defaults: x || {}
                    })).kill(), o.parent = o._dp = _assertThisInitialized(a), o._start = 0, T || v(m) || v(g)) {
                    if (l = C.length, _ = T && Za(T), s(T))
                        for (f in T) ~jt.indexOf(f) && ((p = p || {})[f] = T[f]);
                    for (u = 0; u < l; u++)(h = oa(r, Kt)).stagger = 0, P && (h.yoyoEase = P), p && mt(h, p), d = C[u], h.duration = +Qt(m, _assertThisInitialized(a), u, d, C), h.delay = (+Qt(g, _assertThisInitialized(a), u, d, C) || 0) - a._delay, !T && 1 === l && h.delay && (a._delay = g = h.delay, a._start += g, h.delay = 0), o.to(d, h, _ ? _(u, d, C) : 0), o._ease = zt.none;
                    o.duration() ? m = g = 0 : a.timeline = 0
                } else if (w) {
                    pa(ka(o.vars.defaults, {
                        ease: "none"
                    })), o._ease = Bt(w.ease || r.ease || "none");
                    var A, D, S, z = 0;
                    if (J(w)) w.forEach(function(t) {
                        return o.to(C, t, ">")
                    });
                    else {
                        for (f in h = {}, w) "ease" === f || "easeEach" === f || $b(f, w[f], h, w.easeEach);
                        for (f in h)
                            for (A = h[f].sort(function(t, e) {
                                    return t.t - e.t
                                }), u = z = 0; u < A.length; u++)(S = {
                                ease: (D = A[u]).e,
                                duration: (D.t - (u ? A[u - 1].t : 0)) / 100 * m
                            })[f] = D.v, o.to(C, S, z), z += S.duration;
                        o.duration() < m && o.to({}, {
                            duration: m - o.duration()
                        })
                    }
                }
                m || a.duration(m = o.duration())
            } else a.timeline = 0;
            return !0 !== b || B || (Yt = _assertThisInitialized(a), I.killTweensOf(C), Yt = 0), Da(M, _assertThisInitialized(a), i), r.reversed && a.reverse(), r.paused && a.paused(!0), (y || !m && !w && a._start === da(M._time) && t(y) && function _hasNoPausedAncestors(t) {
                return !t || t._ts && _hasNoPausedAncestors(t.parent)
            }(_assertThisInitialized(a)) && "nested" !== M.data) && (a._tTime = -V, a.render(Math.max(0, -g))), k && Ea(_assertThisInitialized(a), k), a
        }
        _inheritsLoose(Tween, R);
        var e = Tween.prototype;
        return e.render = function render(t, e, r) {
            var i, n, a, s, o, u, h, l, f, d = this._time,
                _ = this._tDur,
                p = this._dur,
                c = _ - V < t && 0 <= t ? _ : t < V ? 0 : t;
            if (p) {
                if (c !== this._tTime || !t || r || !this._initted && this._tTime || this._startAt && this._zTime < 0 != t < 0) {
                    if (i = c, l = this.timeline, this._repeat) {
                        if (s = p + this._rDelay, this._repeat < -1 && t < 0) return this.totalTime(100 * s + t, e, r);
                        if (i = da(c % s), c === _ ? (a = this._repeat, i = p) : ((a = ~~(c / s)) && a === c / s && (i = p, a--), p < i && (i = p)), (u = this._yoyo && 1 & a) && (f = this._yEase, i = p - i), o = gt(this._tTime, s), i === d && !r && this._initted) return this._tTime = c, this;
                        a !== o && (l && this._yEase && Ib(l, u), !this.vars.repeatRefresh || u || this._lock || (this._lock = r = 1, this.render(da(s * a), !0).invalidate()._lock = 0))
                    }
                    if (!this._initted) {
                        if (Fa(this, t < 0 ? t : i, r, e)) return this._tTime = 0, this;
                        if (d !== this._time) return this;
                        if (p !== this._dur) return this.render(t, e, r)
                    }
                    if (this._tTime = c, this._time = i, !this._act && this._ts && (this._act = 1, this._lazy = 0), this.ratio = h = (f || this._ease)(i / p), this._from && (this.ratio = h = 1 - h), i && !d && !e && (Ot(this, "onStart"), this._tTime !== c)) return this;
                    for (n = this._pt; n;) n.r(h, n.d), n = n._next;
                    l && l.render(t < 0 ? t : !i && u ? -V : l._dur * l._ease(i / this._dur), e, r) || this._startAt && (this._zTime = t), this._onUpdate && !e && (t < 0 && this._startAt && this._startAt.render(t, !0, r), Ot(this, "onUpdate")), this._repeat && a !== o && this.vars.onRepeat && !e && this.parent && Ot(this, "onRepeat"), c !== this._tDur && c || this._tTime !== c || (t < 0 && this._startAt && !this._onUpdate && this._startAt.render(t, !0, !0), !t && p || !(c === this._tDur && 0 < this._ts || !c && this._ts < 0) || ta(this, 1), e || t < 0 && !d || !c && !d || (Ot(this, c === _ ? "onComplete" : "onReverseComplete", !0), !this._prom || c < _ && 0 < this.timeScale() || this._prom()))
                }
            } else ! function _renderZeroDurationTween(t, e, r, i) {
                var n, a, s, o = t.ratio,
                    u = e < 0 || !e && (!t._start && function _parentPlayheadIsBeforeStart(t) {
                        var e = t.parent;
                        return e && e._ts && e._initted && !e._lock && (e.rawTime() < 0 || _parentPlayheadIsBeforeStart(e))
                    }(t) && (t._initted || !vt(t)) || (t._ts < 0 || t._dp._ts < 0) && !vt(t)) ? 0 : 1,
                    h = t._rDelay,
                    l = 0;
                if (h && t._repeat && (l = bt(0, t._tDur, e), a = gt(l, h), t._yoyo && 1 & a && (u = 1 - u), a !== gt(t._tTime, h) && (o = 1 - u, t.vars.repeatRefresh && t._initted && t.invalidate())), u !== o || i || t._zTime === V || !e && t._zTime) {
                    if (!t._initted && Fa(t, e, i, r)) return;
                    for (s = t._zTime, t._zTime = e || (r ? V : 0), r = r || e && !s, t.ratio = u, t._from && (u = 1 - u), t._time = 0, t._tTime = l, n = t._pt; n;) n.r(u, n.d), n = n._next;
                    t._startAt && e < 0 && t._startAt.render(e, !0, !0), t._onUpdate && !r && Ot(t, "onUpdate"), l && t._repeat && !r && t.parent && Ot(t, "onRepeat"), (e >= t._tDur || e < 0) && t.ratio === u && (u && ta(t, 1), r || (Ot(t, u ? "onComplete" : "onReverseComplete", !0), t._prom && t._prom()))
                } else t._zTime || (t._zTime = e)
            }(this, t, e, r);
            return this
        }, e.targets = function targets() {
            return this._targets
        }, e.invalidate = function invalidate() {
            return this._pt = this._op = this._startAt = this._onUpdate = this._lazy = this.ratio = 0, this._ptLookup = [], this.timeline && this.timeline.invalidate(), R.prototype.invalidate.call(this)
        }, e.resetTo = function resetTo(t, e, r, i) {
            c || Dt.wake(), this._ts || this.play();
            var n, a = Math.min(this._dur, (this._dp._time - this._start) * this._ts);
            return this._initted || Xt(this, a), n = this._ease(a / this._dur),
                function _updatePropTweens(t, e, r, i, n, a, s) {
                    var o, u, h, l = (t._pt && t._ptCache || (t._ptCache = {}))[e];
                    if (!l)
                        for (l = t._ptCache[e] = [], u = t._ptLookup, h = t._targets.length; h--;) {
                            if ((o = u[h][e]) && o.d && o.d._pt)
                                for (o = o.d._pt; o && o.p !== e;) o = o._next;
                            if (!o) return qt = 1, t.vars[e] = "+=0", Xt(t, s), qt = 0, 1;
                            l.push(o)
                        }
                    for (h = l.length; h--;)(o = l[h]).s = !i && 0 !== i || n ? o.s + (i || 0) + a * o.c : i, o.c = r - o.s, o.e && (o.e = ca(r) + Ra(o.e)), o.b && (o.b = o.s + Ra(o.b))
                }(this, t, e, r, i, n, a) ? this.resetTo(t, e, r, i) : (Ba(this, 0), this.parent || ra(this._dp, this, "_first", "_last", this._dp._sort ? "_start" : 0), this.render(0))
        }, e.kill = function kill(t, e) {
            if (void 0 === e && (e = "all"), !(t || e && "all" !== e)) return this._lazy = this._pt = 0, this.parent ? mb(this) : this;
            if (this.timeline) {
                var r = this.timeline.totalDuration();
                return this.timeline.killTweensOf(t, e, Yt && !0 !== Yt.vars.overwrite)._first || mb(this), this.parent && r !== this.timeline.totalDuration() && Ka(this, this._dur * this.timeline._tDur / r, 0, 1), this
            }
            var i, n, a, s, u, h, l, f = this._targets,
                d = t ? xt(t) : f,
                p = this._ptLookup,
                c = this._pt;
            if ((!e || "all" === e) && function _arraysMatch(t, e) {
                    for (var r = t.length, i = r === e.length; i && r-- && t[r] === e[r];);
                    return r < 0
                }(f, d)) return "all" === e && (this._pt = 0), mb(this);
            for (i = this._op = this._op || [], "all" !== e && (o(e) && (u = {}, ba(e, function(t) {
                    return u[t] = 1
                }), e = u), e = function _addAliasesToVars(t, e) {
                    var r, i, n, a, s = t[0] ? _(t[0]).harness : 0,
                        o = s && s.aliases;
                    if (!o) return e;
                    for (i in r = mt({}, e), o)
                        if (i in r)
                            for (n = (a = o[i].split(",")).length; n--;) r[a[n]] = r[i];
                    return r
                }(f, e)), l = f.length; l--;)
                if (~d.indexOf(f[l]))
                    for (u in n = p[l], "all" === e ? (i[l] = e, s = n, a = {}) : (a = i[l] = i[l] || {}, s = e), s)(h = n && n[u]) && ("kill" in h.d && !0 !== h.d.kill(u) || sa(this, h, "_pt"), delete n[u]), "all" !== a && (a[u] = 1);
            return this._initted && !this._pt && c && mb(this), this
        }, Tween.to = function to(t, e, r) {
            return new Tween(t, e, r)
        }, Tween.from = function from(t, e) {
            return Oa(1, arguments)
        }, Tween.delayedCall = function delayedCall(t, e, r, i) {
            return new Tween(e, 0, {
                immediateRender: !1,
                lazy: !1,
                overwrite: !1,
                delay: t,
                onComplete: e,
                onReverseComplete: e,
                onCompleteParams: r,
                onReverseCompleteParams: r,
                callbackScope: i
            })
        }, Tween.fromTo = function fromTo(t, e, r) {
            return Oa(2, arguments)
        }, Tween.set = function set(t, e) {
            return e.duration = 0, e.repeatDelay || (e.repeat = 0), new Tween(t, e)
        }, Tween.killTweensOf = function killTweensOf(t, e, r) {
            return I.killTweensOf(t, e, r)
        }, Tween
    }(Nt);
    ka($t.prototype, {
        _targets: [],
        _lazy: 0,
        _startAt: 0,
        _op: 0,
        _onInit: 0
    }), ba("staggerTo,staggerFrom,staggerFromTo", function(r) {
        $t[r] = function() {
            var t = new Ut,
                e = wt.call(arguments, 0);
            return e.splice("staggerFromTo" === r ? 5 : 4, 0, 0), t[r].apply(t, e)
        }
    });

    function gc(t, e, r) {
        return t.setAttribute(e, r)
    }

    function oc(t, e, r, i) {
        i.mSet(t, e, i.m.call(i.tween, r, i.mt), i)
    }
    var Gt = function _setterPlain(t, e, r) {
            return t[e] = r
        },
        Wt = function _setterFunc(t, e, r) {
            return t[e](r)
        },
        Zt = function _setterFuncWithParam(t, e, r, i) {
            return t[e](i.fp, r)
        },
        Ht = function _getSetter(t, e) {
            return p(t[e]) ? Wt : r(t[e]) && t.setAttribute ? gc : Gt
        },
        Jt = function _renderPlain(t, e) {
            return e.set(e.t, e.p, Math.round(1e6 * (e.s + e.c * t)) / 1e6, e)
        },
        te = function _renderBoolean(t, e) {
            return e.set(e.t, e.p, !!(e.s + e.c * t), e)
        },
        ee = function _renderComplexString(t, e) {
            var r = e._pt,
                i = "";
            if (!t && e.b) i = e.b;
            else if (1 === t && e.e) i = e.e;
            else {
                for (; r;) i = r.p + (r.m ? r.m(r.s + r.c * t) : Math.round(1e4 * (r.s + r.c * t)) / 1e4) + i, r = r._next;
                i += e.c
            }
            e.set(e.t, e.p, i, e)
        },
        re = function _renderPropTweens(t, e) {
            for (var r = e._pt; r;) r.r(t, r.d), r = r._next
        },
        ie = function _addPluginModifier(t, e, r, i) {
            for (var n, a = this._pt; a;) n = a._next, a.p === i && a.modifier(t, e, r), a = n
        },
        ne = function _killPropTweensOf(t) {
            for (var e, r, i = this._pt; i;) r = i._next, i.p === t && !i.op || i.op === t ? sa(this, i, "_pt") : i.dep || (e = 1), i = r;
            return !e
        },
        se = function _sortPropTweensByPriority(t) {
            for (var e, r, i, n, a = t._pt; a;) {
                for (e = a._next, r = i; r && r.pr > a.pr;) r = r._next;
                (a._prev = r ? r._prev : n) ? a._prev._next = a: i = a, (a._next = r) ? r._prev = a : n = a, a = e
            }
            t._pt = i
        },
        oe = (PropTween.prototype.modifier = function modifier(t, e, r) {
            this.mSet = this.mSet || this.set, this.set = oc, this.m = t, this.mt = r, this.tween = e
        }, PropTween);

    function PropTween(t, e, r, i, n, a, s, o, u) {
        this.t = e, this.s = i, this.c = n, this.p = r, this.r = a || Jt, this.d = s || this, this.set = o || Gt, this.pr = u || 0, (this._next = t) && (t._prev = this)
    }
    ba(ct + "parent,duration,ease,delay,overwrite,runBackwards,startAt,yoyo,immediateRender,repeat,repeatDelay,data,paused,reversed,lazy,callbackScope,stringFilter,id,yoyoEase,stagger,inherit,repeatRefresh,keyframes,autoRevert,scrollTrigger", function(t) {
        return ut[t] = 1
    }), ot.TweenMax = ot.TweenLite = $t, ot.TimelineLite = ot.TimelineMax = Ut, I = new Ut({
        sortChildren: !1,
        defaults: L,
        autoRemoveChildren: !0,
        id: "root",
        smoothChildTiming: !0
    }), U.stringFilter = xb;
    var ue = {
        registerPlugin: function registerPlugin() {
            for (var t = arguments.length, e = new Array(t), r = 0; r < t; r++) e[r] = arguments[r];
            e.forEach(function(t) {
                return function _createPlugin(t) {
                    var e = (t = !t.name && t.default || t).name,
                        r = p(t),
                        i = e && !r && t.init ? function() {
                            this._props = []
                        } : t,
                        n = {
                            init: Q,
                            render: re,
                            add: Vt,
                            kill: ne,
                            modifier: ie,
                            rawVars: 0
                        },
                        a = {
                            targetTest: 0,
                            get: 0,
                            getSetter: Ht,
                            aliases: {},
                            register: 0
                        };
                    if (St(), t !== i) {
                        if (ft[e]) return;
                        ka(i, ka(oa(t, n), a)), mt(i.prototype, mt(n, oa(t, a))), ft[i.prop = e] = i, t.targetTest && (pt.push(i), ut[e] = 1), e = ("css" === e ? "CSS" : e.charAt(0).toUpperCase() + e.substr(1)) + "Plugin"
                    }
                    P(e, i), t.register && t.register(he, i, oe)
                }(t)
            })
        },
        timeline: function timeline(t) {
            return new Ut(t)
        },
        getTweensOf: function getTweensOf(t, e) {
            return I.getTweensOf(t, e)
        },
        getProperty: function getProperty(i, t, e, r) {
            o(i) && (i = xt(i)[0]);
            var n = _(i || {}).get,
                a = e ? ja : ia;
            return "native" === e && (e = ""), i ? t ? a((ft[t] && ft[t].get || n)(i, t, e, r)) : function(t, e, r) {
                return a((ft[t] && ft[t].get || n)(i, t, e, r))
            } : i
        },
        quickSetter: function quickSetter(r, e, i) {
            if (1 < (r = xt(r)).length) {
                var n = r.map(function(t) {
                        return he.quickSetter(t, e, i)
                    }),
                    a = n.length;
                return function(t) {
                    for (var e = a; e--;) n[e](t)
                }
            }
            r = r[0] || {};
            var s = ft[e],
                o = _(r),
                u = o.harness && (o.harness.aliases || {})[e] || e,
                h = s ? function(t) {
                    var e = new s;
                    d._pt = 0, e.init(r, i ? t + i : t, d, 0, [r]), e.render(1, e), d._pt && re(1, d)
                } : o.set(r, u);
            return s ? h : function(t) {
                return h(r, u, i ? t + i : t, o, 1)
            }
        },
        quickTo: function quickTo(t, i, e) {
            function iw(t, e, r) {
                return n.resetTo(i, t, e, r)
            }
            var r, n = he.to(t, mt(((r = {})[i] = "+=0.1", r.paused = !0, r), e || {}));
            return iw.tween = n, iw
        },
        isTweening: function isTweening(t) {
            return 0 < I.getTweensOf(t, !0).length
        },
        defaults: function defaults(t) {
            return t && t.ease && (t.ease = Bt(t.ease, L.ease)), na(L, t || {})
        },
        config: function config(t) {
            return na(U, t || {})
        },
        registerEffect: function registerEffect(t) {
            var i = t.name,
                n = t.effect,
                e = t.plugins,
                a = t.defaults,
                r = t.extendTimeline;
            (e || "").split(",").forEach(function(t) {
                return t && !ft[t] && !ot[t] && O(i + " effect requires " + t + " plugin.")
            }), dt[i] = function(t, e, r) {
                return n(xt(t), ka(e || {}, a), r)
            }, r && (Ut.prototype[i] = function(t, e, r) {
                return this.add(dt[i](t, s(e) ? e : (r = e) && {}, this), r)
            })
        },
        registerEase: function registerEase(t, e) {
            zt[t] = Bt(e)
        },
        parseEase: function parseEase(t, e) {
            return arguments.length ? Bt(t, e) : zt
        },
        getById: function getById(t) {
            return I.getById(t)
        },
        exportRoot: function exportRoot(e, r) {
            void 0 === e && (e = {});
            var i, n, a = new Ut(e);
            for (a.smoothChildTiming = t(e.smoothChildTiming), I.remove(a), a._dp = 0, a._time = a._tTime = I._time, i = I._first; i;) n = i._next, !r && !i._dur && i instanceof $t && i.vars.onComplete === i._targets[0] || Da(a, i, i._start - i._delay), i = n;
            return Da(I, a, 0), a
        },
        utils: {
            wrap: function wrap(e, t, r) {
                var i = t - e;
                return J(e) ? eb(e, wrap(0, e.length), t) : Pa(r, function(t) {
                    return (i + (t - e) % i) % i + e
                })
            },
            wrapYoyo: function wrapYoyo(e, t, r) {
                var i = t - e,
                    n = 2 * i;
                return J(e) ? eb(e, wrapYoyo(0, e.length - 1), t) : Pa(r, function(t) {
                    return e + (i < (t = (n + (t - e) % n) % n || 0) ? n - t : t)
                })
            },
            distribute: Za,
            random: ab,
            snap: _a,
            normalize: function normalize(t, e, r) {
                return kt(t, e, 0, 1, r)
            },
            getUnit: Ra,
            clamp: function clamp(e, r, t) {
                return Pa(t, function(t) {
                    return bt(e, r, t)
                })
            },
            splitColor: sb,
            toArray: xt,
            selector: function selector(r) {
                return r = xt(r)[0] || O("Invalid scope") || {},
                    function(t) {
                        var e = r.current || r.nativeElement || r;
                        return xt(t, e.querySelectorAll ? e : e === r ? O("Invalid scope") || a.createElement("div") : r)
                    }
            },
            mapRange: kt,
            pipe: function pipe() {
                for (var t = arguments.length, e = new Array(t), r = 0; r < t; r++) e[r] = arguments[r];
                return function(t) {
                    return e.reduce(function(t, e) {
                        return e(t)
                    }, t)
                }
            },
            unitize: function unitize(e, r) {
                return function(t) {
                    return e(parseFloat(t)) + (r || Ra(t))
                }
            },
            interpolate: function interpolate(e, r, t, i) {
                var n = isNaN(e + r) ? 0 : function(t) {
                    return (1 - t) * e + t * r
                };
                if (!n) {
                    var a, s, u, h, l, f = o(e),
                        d = {};
                    if (!0 === t && (i = 1) && (t = null), f) e = {
                        p: e
                    }, r = {
                        p: r
                    };
                    else if (J(e) && !J(r)) {
                        for (u = [], h = e.length, l = h - 2, s = 1; s < h; s++) u.push(interpolate(e[s - 1], e[s]));
                        h--, n = function func(t) {
                            t *= h;
                            var e = Math.min(l, ~~t);
                            return u[e](t - e)
                        }, t = r
                    } else i || (e = mt(J(e) ? [] : {}, e));
                    if (!u) {
                        for (a in r) Vt.call(d, e, a, "get", r[a]);
                        n = function func(t) {
                            return re(t, d) || (f ? e.p : e)
                        }
                    }
                }
                return Pa(t, n)
            },
            shuffle: Ya
        },
        install: M,
        effects: dt,
        ticker: Dt,
        updateRoot: Ut.updateRoot,
        plugins: ft,
        globalTimeline: I,
        core: {
            PropTween: oe,
            globals: P,
            Tween: $t,
            Timeline: Ut,
            Animation: Nt,
            getCache: _,
            _removeLinkedListItem: sa,
            suppressOverwrites: function suppressOverwrites(t) {
                return B = t
            }
        }
    };
    ba("to,from,fromTo,delayedCall,set,killTweensOf", function(t) {
        return ue[t] = $t[t]
    }), Dt.add(Ut.updateRoot), d = ue.to({}, {
        duration: 0
    });

    function sc(t, e) {
        for (var r = t._pt; r && r.p !== e && r.op !== e && r.fp !== e;) r = r._next;
        return r
    }

    function uc(t, n) {
        return {
            name: t,
            rawVars: 1,
            init: function init(t, i, e) {
                e._onInit = function(t) {
                    var e, r;
                    if (o(i) && (e = {}, ba(i, function(t) {
                            return e[t] = 1
                        }), i = e), n) {
                        for (r in e = {}, i) e[r] = n(i[r]);
                        i = e
                    }! function _addModifiers(t, e) {
                        var r, i, n, a = t._targets;
                        for (r in e)
                            for (i = a.length; i--;)(n = (n = t._ptLookup[i][r]) && n.d) && (n._pt && (n = sc(n, r)), n && n.modifier && n.modifier(e[r], t, a[i], r))
                    }(t, i)
                }
            }
        }
    }
    var he = ue.registerPlugin({
        name: "attr",
        init: function init(t, e, r, i, n) {
            var a, s;
            for (a in e)(s = this.add(t, "setAttribute", (t.getAttribute(a) || 0) + "", e[a], i, n, 0, 0, a)) && (s.op = a), this._props.push(a)
        }
    }, {
        name: "endArray",
        init: function init(t, e) {
            for (var r = e.length; r--;) this.add(t, r, t[r] || 0, e[r])
        }
    }, uc("roundProps", $a), uc("modifiers"), uc("snap", _a)) || ue;
    $t.version = Ut.version = he.version = "3.10.4", l = 1, u() && St();

    function dd(t, e) {
        return e.set(e.t, e.p, Math.round(1e4 * (e.s + e.c * t)) / 1e4 + e.u, e)
    }

    function ed(t, e) {
        return e.set(e.t, e.p, 1 === t ? e.e : Math.round(1e4 * (e.s + e.c * t)) / 1e4 + e.u, e)
    }

    function fd(t, e) {
        return e.set(e.t, e.p, t ? Math.round(1e4 * (e.s + e.c * t)) / 1e4 + e.u : e.b, e)
    }

    function gd(t, e) {
        var r = e.s + e.c * t;
        e.set(e.t, e.p, ~~(r + (r < 0 ? -.5 : .5)) + e.u, e)
    }

    function hd(t, e) {
        return e.set(e.t, e.p, t ? e.e : e.b, e)
    }

    function id(t, e) {
        return e.set(e.t, e.p, 1 !== t ? e.b : e.e, e)
    }

    function jd(t, e, r) {
        return t.style[e] = r
    }

    function kd(t, e, r) {
        return t.style.setProperty(e, r)
    }

    function ld(t, e, r) {
        return t._gsplit[e] = r
    }

    function md(t, e, r) {
        return t._gsplit.scaleX = t._gsplit.scaleY = r
    }

    function nd(t, e, r, i, n) {
        var a = t._gsplit;
        a.scaleX = a.scaleY = r, a.renderTransform(n, a)
    }

    function od(t, e, r, i, n) {
        var a = t._gsplit;
        a[e] = r, a.renderTransform(n, a)
    }

    function sd(t, e) {
        var r = fe.createElementNS ? fe.createElementNS((e || "http://www.w3.org/1999/xhtml").replace(/^https/, "http"), t) : fe.createElement(t);
        return r.style ? r : fe.createElement(t)
    }

    function td(t, e, r) {
        var i = getComputedStyle(t);
        return i[e] || i.getPropertyValue(e.replace(Ne, "-$1").toLowerCase()) || i.getPropertyValue(e) || !r && td(t, je(e) || e, 1) || ""
    }

    function wd() {
        (function _windowExists() {
            return "undefined" != typeof window
        })() && window.document && (le = window, fe = le.document, de = fe.documentElement, pe = sd("div") || {
            style: {}
        }, sd("div"), Ve = je(Ve), Xe = Ve + "Origin", pe.style.cssText = "border-width:0;line-height:0;position:absolute;padding:0", me = !!je("perspective"), _e = 1)
    }

    function xd(t) {
        var e, r = sd("svg", this.ownerSVGElement && this.ownerSVGElement.getAttribute("xmlns") || "http://www.w3.org/2000/svg"),
            i = this.parentNode,
            n = this.nextSibling,
            a = this.style.cssText;
        if (de.appendChild(r), r.appendChild(this), this.style.display = "block", t) try {
            e = this.getBBox(), this._gsplitBBox = this.getBBox, this.getBBox = xd
        } catch (t) {} else this._gsplitBBox && (e = this._gsplitBBox());
        return i && (n ? i.insertBefore(this, n) : i.appendChild(this)), de.removeChild(r), this.style.cssText = a, e
    }

    function yd(t, e) {
        for (var r = e.length; r--;)
            if (t.hasAttribute(e[r])) return t.getAttribute(e[r])
    }

    function zd(e) {
        var r;
        try {
            r = e.getBBox()
        } catch (t) {
            r = xd.call(e, !0)
        }
        return r && (r.width || r.height) || e.getBBox === xd || (r = xd.call(e, !0)), !r || r.width || r.x || r.y ? r : {
            x: +yd(e, ["x", "cx", "x1"]) || 0,
            y: +yd(e, ["y", "cy", "y1"]) || 0,
            width: 0,
            height: 0
        }
    }

    function Ad(t) {
        return !(!t.getCTM || t.parentNode && !t.ownerSVGElement || !zd(t))
    }

    function Bd(t, e) {
        if (e) {
            var r = t.style;
            e in Fe && e !== Xe && (e = Ve), r.removeProperty ? ("ms" !== e.substr(0, 2) && "webkit" !== e.substr(0, 6) || (e = "-" + e), r.removeProperty(e.replace(Ne, "-$1").toLowerCase())) : r.removeAttribute(e)
        }
    }

    function Cd(t, e, r, i, n, a) {
        var s = new oe(t._pt, e, r, 0, 1, a ? id : hd);
        return (t._pt = s).b = i, s.e = n, t._props.push(r), s
    }

    function Ed(t, e, r, i) {
        var n, a, s, o, u = parseFloat(r) || 0,
            h = (r + "").trim().substr((u + "").length) || "px",
            l = pe.style,
            f = Ue.test(e),
            d = "svg" === t.tagName.toLowerCase(),
            p = (d ? "client" : "offset") + (f ? "Width" : "Height"),
            c = "px" === i,
            m = "%" === i;
        return i === h || !u || Ke[i] || Ke[h] ? u : ("px" === h || c || (u = Ed(t, e, r, "px")), o = t.getCTM && Ad(t), !m && "%" !== h || !Fe[e] && !~e.indexOf("adius") ? (l[f ? "width" : "height"] = 100 + (c ? h : i), a = ~e.indexOf("adius") || "em" === i && t.appendChild && !d ? t : t.parentNode, o && (a = (t.ownerSVGElement || {}).parentNode), a && a !== fe && a.appendChild || (a = fe.body), (s = a._gsplit) && m && s.width && f && s.time === Dt.time ? ca(u / s.width * 100) : (!m && "%" !== h || (l.position = td(t, "position")), a === t && (l.position = "static"), a.appendChild(pe), n = pe[p], a.removeChild(pe), l.position = "absolute", f && m && ((s = _(a)).time = Dt.time, s.width = a[p]), ca(c ? n * u / 100 : n && u ? 100 / n * u : 0))) : (n = o ? t.getBBox()[f ? "width" : "height"] : t[p], ca(m ? u / n * 100 : u / 100 * n)))
    }

    function Fd(t, e, r, i) {
        var n;
        return _e || wd(), e in qe && "transform" !== e && ~(e = qe[e]).indexOf(",") && (e = e.split(",")[0]), Fe[e] && "transform" !== e ? (n = He(t, i), n = "transformOrigin" !== e ? n[e] : n.svg ? n.origin : Je(td(t, Xe)) + " " + n.zOrigin + "px") : (n = t.style[e]) && "auto" !== n && !i && !~(n + "").indexOf("calc(") || (n = Ge[e] && Ge[e](t, e, r) || td(t, e) || aa(t, e) || ("opacity" === e ? 1 : 0)), r && !~(n + "").trim().indexOf(" ") ? Ed(t, e, n, r) + r : n
    }

    function Gd(t, e, r, i) {
        if (!r || "none" === r) {
            var n = je(e, t, 1),
                a = n && td(t, n, 1);
            a && a !== r ? (e = n, r = a) : "borderColor" === e && (r = td(t, "borderTopColor"))
        }
        var s, o, u, h, l, f, d, _, p, c, m, g = new oe(this._pt, t.style, e, 0, 1, ee),
            v = 0,
            y = 0;
        if (g.b = r, g.e = i, r += "", "auto" === (i += "") && (t.style[e] = i, i = td(t, e) || i, t.style[e] = r), xb(s = [r, i]), i = s[1], u = (r = s[0]).match(rt) || [], (i.match(rt) || []).length) {
            for (; o = rt.exec(i);) d = o[0], p = i.substring(v, o.index), l ? l = (l + 1) % 5 : "rgba(" !== p.substr(-5) && "hsla(" !== p.substr(-5) || (l = 1), d !== (f = u[y++] || "") && (h = parseFloat(f) || 0, m = f.substr((h + "").length), "=" === d.charAt(1) && (d = ea(h, d) + m), _ = parseFloat(d), c = d.substr((_ + "").length), v = rt.lastIndex - c.length, c || (c = c || U.units[e] || m, v === i.length && (i += c, g.e += c)), m !== c && (h = Ed(t, e, f, c) || 0), g._pt = {
                _next: g._pt,
                p: p || 1 === y ? p : ",",
                s: h,
                c: _ - h,
                m: l && l < 4 || "zIndex" === e ? Math.round : 0
            });
            g.c = v < i.length ? i.substring(v, i.length) : ""
        } else g.r = "display" === e && "none" === i ? id : hd;
        return nt.test(i) && (g.e = 0), this._pt = g
    }

    function Id(t) {
        var e = t.split(" "),
            r = e[0],
            i = e[1] || "50%";
        return "top" !== r && "bottom" !== r && "left" !== i && "right" !== i || (t = r, r = i, i = t), e[0] = $e[r] || r, e[1] = $e[i] || i, e.join(" ")
    }

    function Jd(t, e) {
        if (e.tween && e.tween._time === e.tween._dur) {
            var r, i, n, a = e.t,
                s = a.style,
                o = e.u,
                u = a._gsplit;
            if ("all" === o || !0 === o) s.cssText = "", i = 1;
            else
                for (n = (o = o.split(",")).length; - 1 < --n;) r = o[n], Fe[r] && (i = 1, r = "transformOrigin" === r ? Xe : Ve), Bd(a, r);
            i && (Bd(a, Ve), u && (u.svg && a.removeAttribute("transform"), He(a, 1), u.uncache = 1))
        }
    }

    function Nd(t) {
        return "matrix(1, 0, 0, 1, 0, 0)" === t || "none" === t || !t
    }

    function Od(t) {
        var e = td(t, Ve);
        return Nd(e) ? We : e.substr(7).match(et).map(ca)
    }

    function Pd(t, e) {
        var r, i, n, a, s = t._gsplit || _(t),
            o = t.style,
            u = Od(t);
        return s.svg && t.getAttribute("transform") ? "1,0,0,1,0,0" === (u = [(n = t.transform.baseVal.consolidate().matrix).a, n.b, n.c, n.d, n.e, n.f]).join(",") ? We : u : (u !== We || t.offsetParent || t === de || s.svg || (n = o.display, o.display = "block", (r = t.parentNode) && t.offsetParent || (a = 1, i = t.nextSibling, de.appendChild(t)), u = Od(t), n ? o.display = n : Bd(t, "display"), a && (i ? r.insertBefore(t, i) : r ? r.appendChild(t) : de.removeChild(t))), e && 6 < u.length ? [u[0], u[1], u[4], u[5], u[12], u[13]] : u)
    }

    function Qd(t, e, r, i, n, a) {
        var s, o, u, h = t._gsplit,
            l = n || Pd(t, !0),
            f = h.xOrigin || 0,
            d = h.yOrigin || 0,
            _ = h.xOffset || 0,
            p = h.yOffset || 0,
            c = l[0],
            m = l[1],
            g = l[2],
            v = l[3],
            y = l[4],
            T = l[5],
            b = e.split(" "),
            w = parseFloat(b[0]) || 0,
            x = parseFloat(b[1]) || 0;
        r ? l !== We && (o = c * v - m * g) && (u = w * (-m / o) + x * (c / o) - (c * T - m * y) / o, w = w * (v / o) + x * (-g / o) + (g * T - v * y) / o, x = u) : (w = (s = zd(t)).x + (~b[0].indexOf("%") ? w / 100 * s.width : w), x = s.y + (~(b[1] || b[0]).indexOf("%") ? x / 100 * s.height : x)), i || !1 !== i && h.smooth ? (y = w - f, T = x - d, h.xOffset = _ + (y * c + T * g) - y, h.yOffset = p + (y * m + T * v) - T) : h.xOffset = h.yOffset = 0, h.xOrigin = w, h.yOrigin = x, h.smooth = !!i, h.origin = e, h.originIsAbsolute = !!r, t.style[Xe] = "0px 0px", a && (Cd(a, h, "xOrigin", f, w), Cd(a, h, "yOrigin", d, x), Cd(a, h, "xOffset", _, h.xOffset), Cd(a, h, "yOffset", p, h.yOffset)), t.setAttribute("data-svg-origin", w + " " + x)
    }

    function Td(t, e, r) {
        var i = Ra(e);
        return ca(parseFloat(e) + parseFloat(Ed(t, "x", r + "px", i))) + i
    }

    function $d(t, e, r, i, n) {
        var a, s, u = 360,
            h = o(n),
            l = parseFloat(n) * (h && ~n.indexOf("rad") ? Be : 1) - i,
            f = i + l + "deg";
        return h && ("short" === (a = n.split("_")[1]) && (l %= u) !== l % 180 && (l += l < 0 ? u : -u), "cw" === a && l < 0 ? l = (l + 36e9) % u - ~~(l / u) * u : "ccw" === a && 0 < l && (l = (l - 36e9) % u - ~~(l / u) * u)), t._pt = s = new oe(t._pt, e, r, i, l, ed), s.e = f, s.u = "deg", t._props.push(r), s
    }

    function _d(t, e) {
        for (var r in e) t[r] = e[r];
        return t
    }

    function ae(t, e, r) {
        var i, n, a, s, o, u, h, l = _d({}, r._gsplit),
            f = r.style;
        for (n in l.svg ? (a = r.getAttribute("transform"), r.setAttribute("transform", ""), f[Ve] = e, i = He(r, 1), Bd(r, Ve), r.setAttribute("transform", a)) : (a = getComputedStyle(r)[Ve], f[Ve] = e, i = He(r, 1), f[Ve] = a), Fe)(a = l[n]) !== (s = i[n]) && "perspective,force3D,transformOrigin,svgOrigin".indexOf(n) < 0 && (o = Ra(a) !== (h = Ra(s)) ? Ed(r, n, a, h) : parseFloat(a), u = parseFloat(s), t._pt = new oe(t._pt, i, n, o, u - o, dd), t._pt.u = h || 0, t._props.push(n));
        _d(i, l)
    }
    var le, fe, de, _e, pe, ce, me, ge = zt.Power0,
        ve = zt.Power1,
        ye = zt.Power2,
        Te = zt.Power3,
        be = zt.Power4,
        we = zt.Linear,
        xe = zt.Quad,
        ke = zt.Cubic,
        Oe = zt.Quart,
        Pe = zt.Quint,
        Me = zt.Strong,
        Ce = zt.Elastic,
        Ae = zt.Back,
        De = zt.SteppedEase,
        Se = zt.Bounce,
        ze = zt.Sine,
        Re = zt.Expo,
        Ee = zt.Circ,
        Fe = {},
        Be = 180 / Math.PI,
        Ie = Math.PI / 180,
        Le = Math.atan2,
        Ne = /([A-Z])/g,
        Ue = /(left|right|width|margin|padding|x)/i,
        Ye = /[\s,\(]\S/,
        qe = {
            autoAlpha: "opacity,visibility",
            scale: "scaleX,scaleY",
            alpha: "opacity"
        },
        Ve = "transform",
        Xe = Ve + "Origin",
        Qe = "O,Moz,ms,Ms,Webkit".split(","),
        je = function _checkPropPrefix(t, e, r) {
            var i = (e || pe).style,
                n = 5;
            if (t in i && !r) return t;
            for (t = t.charAt(0).toUpperCase() + t.substr(1); n-- && !(Qe[n] + t in i););
            return n < 0 ? null : (3 === n ? "ms" : 0 <= n ? Qe[n] : "") + t
        },
        Ke = {
            deg: 1,
            rad: 1,
            turn: 1
        },
        $e = {
            top: "0%",
            bottom: "100%",
            left: "0%",
            right: "100%",
            center: "50%"
        },
        Ge = {
            clearProps: function clearProps(t, e, r, i, n) {
                if ("isFromStart" !== n.data) {
                    var a = t._pt = new oe(t._pt, e, r, 0, 0, Jd);
                    return a.u = i, a.pr = -10, a.tween = n, t._props.push(r), 1
                }
            }
        },
        We = [1, 0, 0, 1, 0, 0],
        Ze = {},
        He = function _parseTransform(t, e) {
            var r = t._gsplit || new Lt(t);
            if ("x" in r && !e && !r.uncache) return r;
            var i, n, a, s, o, u, h, l, f, d, _, p, c, m, g, v, y, T, b, w, x, k, O, P, M, C, A, D, S, z, R, E, F = t.style,
                B = r.scaleX < 0,
                I = "deg",
                L = td(t, Xe) || "0";
            return i = n = a = u = h = l = f = d = _ = 0, s = o = 1, r.svg = !(!t.getCTM || !Ad(t)), m = Pd(t, r.svg), r.svg && (P = (!r.uncache || "0px 0px" === L) && !e && t.getAttribute("data-svg-origin"), Qd(t, P || L, !!P || r.originIsAbsolute, !1 !== r.smooth, m)), p = r.xOrigin || 0, c = r.yOrigin || 0, m !== We && (T = m[0], b = m[1], w = m[2], x = m[3], i = k = m[4], n = O = m[5], 6 === m.length ? (s = Math.sqrt(T * T + b * b), o = Math.sqrt(x * x + w * w), u = T || b ? Le(b, T) * Be : 0, (f = w || x ? Le(w, x) * Be + u : 0) && (o *= Math.abs(Math.cos(f * Ie))), r.svg && (i -= p - (p * T + c * w), n -= c - (p * b + c * x))) : (E = m[6], z = m[7], A = m[8], D = m[9], S = m[10], R = m[11], i = m[12], n = m[13], a = m[14], h = (g = Le(E, S)) * Be, g && (P = k * (v = Math.cos(-g)) + A * (y = Math.sin(-g)), M = O * v + D * y, C = E * v + S * y, A = k * -y + A * v, D = O * -y + D * v, S = E * -y + S * v, R = z * -y + R * v, k = P, O = M, E = C), l = (g = Le(-w, S)) * Be, g && (v = Math.cos(-g), R = x * (y = Math.sin(-g)) + R * v, T = P = T * v - A * y, b = M = b * v - D * y, w = C = w * v - S * y), u = (g = Le(b, T)) * Be, g && (P = T * (v = Math.cos(g)) + b * (y = Math.sin(g)), M = k * v + O * y, b = b * v - T * y, O = O * v - k * y, T = P, k = M), h && 359.9 < Math.abs(h) + Math.abs(u) && (h = u = 0, l = 180 - l), s = ca(Math.sqrt(T * T + b * b + w * w)), o = ca(Math.sqrt(O * O + E * E)), g = Le(k, O), f = 2e-4 < Math.abs(g) ? g * Be : 0, _ = R ? 1 / (R < 0 ? -R : R) : 0), r.svg && (P = t.getAttribute("transform"), r.forceCSS = t.setAttribute("transform", "") || !Nd(td(t, Ve)), P && t.setAttribute("transform", P))), 90 < Math.abs(f) && Math.abs(f) < 270 && (B ? (s *= -1, f += u <= 0 ? 180 : -180, u += u <= 0 ? 180 : -180) : (o *= -1, f += f <= 0 ? 180 : -180)), e = e || r.uncache, r.x = i - ((r.xPercent = i && (!e && r.xPercent || (Math.round(t.offsetWidth / 2) === Math.round(-i) ? -50 : 0))) ? t.offsetWidth * r.xPercent / 100 : 0) + "px", r.y = n - ((r.yPercent = n && (!e && r.yPercent || (Math.round(t.offsetHeight / 2) === Math.round(-n) ? -50 : 0))) ? t.offsetHeight * r.yPercent / 100 : 0) + "px", r.z = a + "px", r.scaleX = ca(s), r.scaleY = ca(o), r.rotation = ca(u) + I, r.rotationX = ca(h) + I, r.rotationY = ca(l) + I, r.skewX = f + I, r.skewY = d + I, r.transformPerspective = _ + "px", (r.zOrigin = parseFloat(L.split(" ")[2]) || 0) && (F[Xe] = Je(L)), r.xOffset = r.yOffset = 0, r.force3D = U.force3D, r.renderTransform = r.svg ? ar : me ? nr : tr, r.uncache = 0, r
        },
        Je = function _firstTwoOnly(t) {
            return (t = t.split(" "))[0] + " " + t[1]
        },
        tr = function _renderNon3DTransforms(t, e) {
            e.z = "0px", e.rotationY = e.rotationX = "0deg", e.force3D = 0, nr(t, e)
        },
        er = "0deg",
        rr = "0px",
        ir = ") ",
        nr = function _renderCSSTransforms(t, e) {
            var r = e || this,
                i = r.xPercent,
                n = r.yPercent,
                a = r.x,
                s = r.y,
                o = r.z,
                u = r.rotation,
                h = r.rotationY,
                l = r.rotationX,
                f = r.skewX,
                d = r.skewY,
                _ = r.scaleX,
                p = r.scaleY,
                c = r.transformPerspective,
                m = r.force3D,
                g = r.target,
                v = r.zOrigin,
                y = "",
                T = "auto" === m && t && 1 !== t || !0 === m;
            if (v && (l !== er || h !== er)) {
                var b, w = parseFloat(h) * Ie,
                    x = Math.sin(w),
                    k = Math.cos(w);
                w = parseFloat(l) * Ie, b = Math.cos(w), a = Td(g, a, x * b * -v), s = Td(g, s, -Math.sin(w) * -v), o = Td(g, o, k * b * -v + v)
            }
            c !== rr && (y += "perspective(" + c + ir), (i || n) && (y += "translate(" + i + "%, " + n + "%) "), !T && a === rr && s === rr && o === rr || (y += o !== rr || T ? "translate3d(" + a + ", " + s + ", " + o + ") " : "translate(" + a + ", " + s + ir), u !== er && (y += "rotate(" + u + ir), h !== er && (y += "rotateY(" + h + ir), l !== er && (y += "rotateX(" + l + ir), f === er && d === er || (y += "skew(" + f + ", " + d + ir), 1 === _ && 1 === p || (y += "scale(" + _ + ", " + p + ir), g.style[Ve] = y || "translate(0, 0)"
        },
        ar = function _renderSVGTransforms(t, e) {
            var r, i, n, a, s, o = e || this,
                u = o.xPercent,
                h = o.yPercent,
                l = o.x,
                f = o.y,
                d = o.rotation,
                _ = o.skewX,
                p = o.skewY,
                c = o.scaleX,
                m = o.scaleY,
                g = o.target,
                v = o.xOrigin,
                y = o.yOrigin,
                T = o.xOffset,
                b = o.yOffset,
                w = o.forceCSS,
                x = parseFloat(l),
                k = parseFloat(f);
            d = parseFloat(d), _ = parseFloat(_), (p = parseFloat(p)) && (_ += p = parseFloat(p), d += p), d || _ ? (d *= Ie, _ *= Ie, r = Math.cos(d) * c, i = Math.sin(d) * c, n = Math.sin(d - _) * -m, a = Math.cos(d - _) * m, _ && (p *= Ie, s = Math.tan(_ - p), n *= s = Math.sqrt(1 + s * s), a *= s, p && (s = Math.tan(p), r *= s = Math.sqrt(1 + s * s), i *= s)), r = ca(r), i = ca(i), n = ca(n), a = ca(a)) : (r = c, a = m, i = n = 0), (x && !~(l + "").indexOf("px") || k && !~(f + "").indexOf("px")) && (x = Ed(g, "x", l, "px"), k = Ed(g, "y", f, "px")), (v || y || T || b) && (x = ca(x + v - (v * r + y * n) + T), k = ca(k + y - (v * i + y * a) + b)), (u || h) && (s = g.getBBox(), x = ca(x + u / 100 * s.width), k = ca(k + h / 100 * s.height)), s = "matrix(" + r + "," + i + "," + n + "," + a + "," + x + "," + k + ")", g.setAttribute("transform", s), w && (g.style[Ve] = s)
        };
    ba("padding,margin,Width,Radius", function(e, r) {
        var t = "Right",
            i = "Bottom",
            n = "Left",
            o = (r < 3 ? ["Top", t, i, n] : ["Top" + n, "Top" + t, i + t, i + n]).map(function(t) {
                return r < 2 ? e + t : "border" + t + e
            });
        Ge[1 < r ? "border" + e : e] = function(e, t, r, i, n) {
            var a, s;
            if (arguments.length < 4) return a = o.map(function(t) {
                return Fd(e, t, r)
            }), 5 === (s = a.join(" ")).split(a[0]).length ? a[0] : s;
            a = (i + "").split(" "), s = {}, o.forEach(function(t, e) {
                return s[t] = a[e] = a[e] || a[(e - 1) / 2 | 0]
            }), e.init(t, s, n)
        }
    });
    var sr, or, ur, hr = {
        name: "css",
        register: wd,
        targetTest: function targetTest(t) {
            return t.style && t.nodeType
        },
        init: function init(t, e, r, i, n) {
            var a, s, u, h, l, f, d, _, p, c, m, g, v, y, T, b = this._props,
                w = t.style,
                x = r.vars.startAt;
            for (d in _e || wd(), e)
                if ("autoRound" !== d && (s = e[d], !ft[d] || !Ub(d, e, r, i, t, n)))
                    if (l = typeof s, f = Ge[d], "function" === l && (l = typeof(s = s.call(r, i, t, n))), "string" === l && ~s.indexOf("random(") && (s = hb(s)), f) f(this, t, d, s, r) && (T = 1);
                    else if ("--" === d.substr(0, 2)) a = (getComputedStyle(t).getPropertyValue(d) + "").trim(), s += "", Ct.lastIndex = 0, Ct.test(a) || (_ = Ra(a), p = Ra(s)), p ? _ !== p && (a = Ed(t, d, a, p) + p) : _ && (s += _), this.add(w, "setProperty", a, s, i, n, 0, 0, d), b.push(d);
            else if ("undefined" !== l) {
                if (x && d in x ? (a = "function" == typeof x[d] ? x[d].call(r, i, t, n) : x[d], o(a) && ~a.indexOf("random(") && (a = hb(a)), Ra(a + "") || (a += U.units[d] || Ra(Fd(t, d)) || ""), "=" === (a + "").charAt(1) && (a = Fd(t, d))) : a = Fd(t, d), h = parseFloat(a), (c = "string" === l && "=" === s.charAt(1) && s.substr(0, 2)) && (s = s.substr(2)), u = parseFloat(s), d in qe && ("autoAlpha" === d && (1 === h && "hidden" === Fd(t, "visibility") && u && (h = 0), Cd(this, w, "visibility", h ? "inherit" : "hidden", u ? "inherit" : "hidden", !u)), "scale" !== d && "transform" !== d && ~(d = qe[d]).indexOf(",") && (d = d.split(",")[0])), m = d in Fe)
                    if (g || ((v = t._gsplit).renderTransform && !e.parseTransform || He(t, e.parseTransform), y = !1 !== e.smoothOrigin && v.smooth, (g = this._pt = new oe(this._pt, w, Ve, 0, 1, v.renderTransform, v, 0, -1)).dep = 1), "scale" === d) this._pt = new oe(this._pt, v, "scaleY", v.scaleY, (c ? ea(v.scaleY, c + u) : u) - v.scaleY || 0), b.push("scaleY", d), d += "X";
                    else {
                        if ("transformOrigin" === d) {
                            s = Id(s), v.svg ? Qd(t, s, 0, y, 0, this) : ((p = parseFloat(s.split(" ")[2]) || 0) !== v.zOrigin && Cd(this, v, "zOrigin", v.zOrigin, p), Cd(this, w, d, Je(a), Je(s)));
                            continue
                        }
                        if ("svgOrigin" === d) {
                            Qd(t, s, 1, y, 0, this);
                            continue
                        }
                        if (d in Ze) {
                            $d(this, v, d, h, c ? ea(h, c + s) : s);
                            continue
                        }
                        if ("smoothOrigin" === d) {
                            Cd(this, v, "smooth", v.smooth, s);
                            continue
                        }
                        if ("force3D" === d) {
                            v[d] = s;
                            continue
                        }
                        if ("transform" === d) {
                            ae(this, s, t);
                            continue
                        }
                    }
                else d in w || (d = je(d) || d);
                if (m || (u || 0 === u) && (h || 0 === h) && !Ye.test(s) && d in w) u = u || 0, (_ = (a + "").substr((h + "").length)) !== (p = Ra(s) || (d in U.units ? U.units[d] : _)) && (h = Ed(t, d, a, p)), this._pt = new oe(this._pt, m ? v : w, d, h, (c ? ea(h, c + u) : u) - h, m || "px" !== p && "zIndex" !== d || !1 === e.autoRound ? dd : gd), this._pt.u = p || 0, _ !== p && "%" !== p && (this._pt.b = a, this._pt.r = fd);
                else if (d in w) Gd.call(this, t, d, a, c ? c + s : s);
                else {
                    if (!(d in t)) {
                        N(d, s);
                        continue
                    }
                    this.add(t, d, a || t[d], c ? c + s : s, i, n)
                }
                b.push(d)
            }
            T && se(this)
        },
        get: Fd,
        aliases: qe,
        getSetter: function getSetter(t, e, i) {
            var n = qe[e];
            return n && n.indexOf(",") < 0 && (e = n), e in Fe && e !== Xe && (t._gsplit.x || Fd(t, "x")) ? i && ce === i ? "scale" === e ? md : ld : (ce = i || {}) && ("scale" === e ? nd : od) : t.style && !r(t.style[e]) ? jd : ~e.indexOf("-") ? kd : Ht(t, e)
        },
        core: {
            _removeProperty: Bd,
            _getMatrix: Pd
        }
    };
    he.utils.checkPrefix = je, ur = ba((sr = "x,y,z,scale,scaleX,scaleY,xPercent,yPercent") + "," + (or = "rotation,rotationX,rotationY,skewX,skewY") + ",transform,transformOrigin,svgOrigin,force3D,smoothOrigin,transformPerspective", function(t) {
        Fe[t] = 1
    }), ba(or, function(t) {
        U.units[t] = "deg", Ze[t] = 1
    }), qe[ur[13]] = sr + "," + or, ba("0:translateX,1:translateY,2:translateZ,8:rotate,8:rotationZ,8:rotateZ,9:rotateX,10:rotateY", function(t) {
        var e = t.split(":");
        qe[e[1]] = ur[e[0]]
    }), ba("x,y,z,top,right,bottom,left,width,height,fontSize,padding,margin,perspective", function(t) {
        U.units[t] = "px"
    }), he.registerPlugin(hr);
    var lr = he.registerPlugin(hr) || he,
        fr = lr.core.Tween;
    e.Back = Ae, e.Bounce = Se, e.CSSPlugin = hr, e.Circ = Ee, e.Cubic = ke, e.Elastic = Ce, e.Expo = Re, e.Linear = we, e.Power0 = ge, e.Power1 = ve, e.Power2 = ye, e.Power3 = Te, e.Power4 = be, e.Quad = xe, e.Quart = Oe, e.Quint = Pe, e.Sine = ze, e.SteppedEase = De, e.Strong = Me, e.TimelineLite = Ut, e.TimelineMax = Ut, e.TweenLite = $t, e.TweenMax = fr, e.default = lr, e.gsplit = lr;
    if (typeof(window) === "undefined" || window !== e) {
        Object.defineProperty(e, "__esModule", {
            value: !0
        })
    } else {
        delete e.default
    }
});

! function(r, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : (r = "undefined" != typeof globalThis ? globalThis : r || self).chromaSplit = e()
}(this, (function() {
    "use strict";
    for (var r = function(r, e, n) {
            return void 0 === e && (e = 0), void 0 === n && (n = 1), r < e ? e : r > n ? n : r
        }, e = r, n = {}, t = 0, a = ["Boolean", "Number", "String", "Function", "Array", "Date", "RegExp", "Undefined", "Null"]; t < a.length; t += 1) {
        var f = a[t];
        n["[object " + f + "]"] = f.toLowerCase()
    }
    var o = function(r) {
            return n[Object.prototype.toString.call(r)] || "object"
        },
        u = o,
        c = o,
        i = Math.PI,
        l = {
            clip_rgb: function(r) {
                r._clipped = !1, r._unclipped = r.slice(0);
                for (var n = 0; n <= 3; n++) n < 3 ? ((r[n] < 0 || r[n] > 255) && (r._clipped = !0), r[n] = e(r[n], 0, 255)) : 3 === n && (r[n] = e(r[n], 0, 1));
                return r
            },
            limit: r,
            type: o,
            unpack: function(r, e) {
                return void 0 === e && (e = null), r.length >= 3 ? Array.prototype.slice.call(r) : "object" == u(r[0]) && e ? e.split("").filter((function(e) {
                    return void 0 !== r[0][e]
                })).map((function(e) {
                    return r[0][e]
                })) : r[0]
            },
            last: function(r) {
                if (r.length < 2) return null;
                var e = r.length - 1;
                return "string" == c(r[e]) ? r[e].toLowerCase() : null
            },
            PI: i,
            TWOPI: 2 * i,
            PITHIRD: i / 3,
            DEG2RAD: i / 180,
            RAD2DEG: 180 / i
        },
        h = {
            format: {},
            autodetect: []
        },
        s = l.last,
        d = l.clip_rgb,
        b = l.type,
        p = h,
        g = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = this;
            if ("object" === b(r[0]) && r[0].constructor && r[0].constructor === this.constructor) return r[0];
            var t = s(r),
                a = !1;
            if (!t) {
                a = !0, p.sorted || (p.autodetect = p.autodetect.sort((function(r, e) {
                    return e.p - r.p
                })), p.sorted = !0);
                for (var f = 0, o = p.autodetect; f < o.length; f += 1) {
                    var u = o[f];
                    if (t = u.test.apply(u, r)) break
                }
            }
            if (!p.format[t]) throw new Error("unknown format: " + r);
            var c = p.format[t].apply(null, a ? r : r.slice(0, -1));
            n._rgb = d(c), 3 === n._rgb.length && n._rgb.push(1)
        };
    g.prototype.toString = function() {
        return "function" == b(this.hex) ? this.hex() : "[" + this._rgb.join(",") + "]"
    };
    var v = g,
        m = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            return new(Function.prototype.bind.apply(m.Color, [null].concat(r)))
        };
    m.Color = v, m.version = "2.4.2";
    var y = m,
        k = l.unpack,
        w = Math.max,
        M = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = k(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = 1 - w(t /= 255, w(a /= 255, f /= 255)),
                u = o < 1 ? 1 / (1 - o) : 0,
                c = (1 - t - o) * u,
                i = (1 - a - o) * u,
                l = (1 - f - o) * u;
            return [c, i, l, o]
        },
        N = l.unpack,
        _ = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = (r = N(r, "cmyk"))[0],
                t = r[1],
                a = r[2],
                f = r[3],
                o = r.length > 4 ? r[4] : 1;
            return 1 === f ? [0, 0, 0, o] : [n >= 1 ? 0 : 255 * (1 - n) * (1 - f), t >= 1 ? 0 : 255 * (1 - t) * (1 - f), a >= 1 ? 0 : 255 * (1 - a) * (1 - f), o]
        },
        x = y,
        A = v,
        E = h,
        F = l.unpack,
        P = l.type,
        O = M;
    A.prototype.cmyk = function() {
        return O(this._rgb)
    }, x.cmyk = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(A, [null].concat(r, ["cmyk"])))
    }, E.format.cmyk = _, E.autodetect.push({
        p: 2,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = F(r, "cmyk"), "array" === P(r) && 4 === r.length) return "cmyk"
        }
    });
    var j = l.unpack,
        G = l.last,
        R = function(r) {
            return Math.round(100 * r) / 100
        },
        q = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = j(r, "hsla"),
                t = G(r) || "lsa";
            return n[0] = R(n[0] || 0), n[1] = R(100 * n[1]) + "%", n[2] = R(100 * n[2]) + "%", "hsla" === t || n.length > 3 && n[3] < 1 ? (n[3] = n.length > 3 ? n[3] : 1, t = "hsla") : n.length = 3, t + "(" + n.join(",") + ")"
        },
        L = l.unpack,
        I = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = (r = L(r, "rgba"))[0],
                t = r[1],
                a = r[2];
            n /= 255, t /= 255, a /= 255;
            var f, o, u = Math.min(n, t, a),
                c = Math.max(n, t, a),
                i = (c + u) / 2;
            return c === u ? (f = 0, o = Number.NaN) : f = i < .5 ? (c - u) / (c + u) : (c - u) / (2 - c - u), n == c ? o = (t - a) / (c - u) : t == c ? o = 2 + (a - n) / (c - u) : a == c && (o = 4 + (n - t) / (c - u)), (o *= 60) < 0 && (o += 360), r.length > 3 && void 0 !== r[3] ? [o, f, i, r[3]] : [o, f, i]
        },
        B = l.unpack,
        C = l.last,
        D = q,
        Y = I,
        S = Math.round,
        T = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = B(r, "rgba"),
                t = C(r) || "rgb";
            return "hsl" == t.substr(0, 3) ? D(Y(n), t) : (n[0] = S(n[0]), n[1] = S(n[1]), n[2] = S(n[2]), ("rgba" === t || n.length > 3 && n[3] < 1) && (n[3] = n.length > 3 ? n[3] : 1, t = "rgba"), t + "(" + n.slice(0, "rgb" === t ? 3 : 4).join(",") + ")")
        },
        $ = l.unpack,
        z = Math.round,
        X = function() {
            for (var r, e = [], n = arguments.length; n--;) e[n] = arguments[n];
            var t, a, f, o = (e = $(e, "hsl"))[0],
                u = e[1],
                c = e[2];
            if (0 === u) t = a = f = 255 * c;
            else {
                var i = [0, 0, 0],
                    l = [0, 0, 0],
                    h = c < .5 ? c * (1 + u) : c + u - c * u,
                    s = 2 * c - h,
                    d = o / 360;
                i[0] = d + 1 / 3, i[1] = d, i[2] = d - 1 / 3;
                for (var b = 0; b < 3; b++) i[b] < 0 && (i[b] += 1), i[b] > 1 && (i[b] -= 1), 6 * i[b] < 1 ? l[b] = s + 6 * (h - s) * i[b] : 2 * i[b] < 1 ? l[b] = h : 3 * i[b] < 2 ? l[b] = s + (h - s) * (2 / 3 - i[b]) * 6 : l[b] = s;
                t = (r = [z(255 * l[0]), z(255 * l[1]), z(255 * l[2])])[0], a = r[1], f = r[2]
            }
            return e.length > 3 ? [t, a, f, e[3]] : [t, a, f, 1]
        },
        U = X,
        V = h,
        W = /^rgb\(\s*(-?\d+),\s*(-?\d+)\s*,\s*(-?\d+)\s*\)$/,
        K = /^rgba\(\s*(-?\d+),\s*(-?\d+)\s*,\s*(-?\d+)\s*,\s*([01]|[01]?\.\d+)\)$/,
        Z = /^rgb\(\s*(-?\d+(?:\.\d+)?)%,\s*(-?\d+(?:\.\d+)?)%\s*,\s*(-?\d+(?:\.\d+)?)%\s*\)$/,
        H = /^rgba\(\s*(-?\d+(?:\.\d+)?)%,\s*(-?\d+(?:\.\d+)?)%\s*,\s*(-?\d+(?:\.\d+)?)%\s*,\s*([01]|[01]?\.\d+)\)$/,
        J = /^hsl\(\s*(-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)%\s*,\s*(-?\d+(?:\.\d+)?)%\s*\)$/,
        Q = /^hsla\(\s*(-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)%\s*,\s*(-?\d+(?:\.\d+)?)%\s*,\s*([01]|[01]?\.\d+)\)$/,
        rr = Math.round,
        er = function(r) {
            var e;
            if (r = r.toLowerCase().trim(), V.format.named) try {
                return V.format.named(r)
            } catch (r) {}
            if (e = r.match(W)) {
                for (var n = e.slice(1, 4), t = 0; t < 3; t++) n[t] = +n[t];
                return n[3] = 1, n
            }
            if (e = r.match(K)) {
                for (var a = e.slice(1, 5), f = 0; f < 4; f++) a[f] = +a[f];
                return a
            }
            if (e = r.match(Z)) {
                for (var o = e.slice(1, 4), u = 0; u < 3; u++) o[u] = rr(2.55 * o[u]);
                return o[3] = 1, o
            }
            if (e = r.match(H)) {
                for (var c = e.slice(1, 5), i = 0; i < 3; i++) c[i] = rr(2.55 * c[i]);
                return c[3] = +c[3], c
            }
            if (e = r.match(J)) {
                var l = e.slice(1, 4);
                l[1] *= .01, l[2] *= .01;
                var h = U(l);
                return h[3] = 1, h
            }
            if (e = r.match(Q)) {
                var s = e.slice(1, 4);
                s[1] *= .01, s[2] *= .01;
                var d = U(s);
                return d[3] = +e[4], d
            }
        };
    er.test = function(r) {
        return W.test(r) || K.test(r) || Z.test(r) || H.test(r) || J.test(r) || Q.test(r)
    };
    var nr = y,
        tr = v,
        ar = h,
        fr = l.type,
        or = T,
        ur = er;
    tr.prototype.css = function(r) {
        return or(this._rgb, r)
    }, nr.css = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(tr, [null].concat(r, ["css"])))
    }, ar.format.css = ur, ar.autodetect.push({
        p: 5,
        test: function(r) {
            for (var e = [], n = arguments.length - 1; n-- > 0;) e[n] = arguments[n + 1];
            if (!e.length && "string" === fr(r) && ur.test(r)) return "css"
        }
    });
    var cr = v,
        ir = y,
        lr = l.unpack;
    h.format.gl = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        var n = lr(r, "rgba");
        return n[0] *= 255, n[1] *= 255, n[2] *= 255, n
    }, ir.gl = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(cr, [null].concat(r, ["gl"])))
    }, cr.prototype.gl = function() {
        var r = this._rgb;
        return [r[0] / 255, r[1] / 255, r[2] / 255, r[3]]
    };
    var hr = l.unpack,
        sr = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n, t = hr(r, "rgb"),
                a = t[0],
                f = t[1],
                o = t[2],
                u = Math.min(a, f, o),
                c = Math.max(a, f, o),
                i = c - u,
                l = 100 * i / 255,
                h = u / (255 - i) * 100;
            return 0 === i ? n = Number.NaN : (a === c && (n = (f - o) / i), f === c && (n = 2 + (o - a) / i), o === c && (n = 4 + (a - f) / i), (n *= 60) < 0 && (n += 360)), [n, l, h]
        },
        dr = l.unpack,
        br = Math.floor,
        pr = function() {
            for (var r, e, n, t, a, f, o = [], u = arguments.length; u--;) o[u] = arguments[u];
            var c, i, l, h = (o = dr(o, "hcg"))[0],
                s = o[1],
                d = o[2];
            d *= 255;
            var b = 255 * s;
            if (0 === s) c = i = l = d;
            else {
                360 === h && (h = 0), h > 360 && (h -= 360), h < 0 && (h += 360);
                var p = br(h /= 60),
                    g = h - p,
                    v = d * (1 - s),
                    m = v + b * (1 - g),
                    y = v + b * g,
                    k = v + b;
                switch (p) {
                    case 0:
                        c = (r = [k, y, v])[0], i = r[1], l = r[2];
                        break;
                    case 1:
                        c = (e = [m, k, v])[0], i = e[1], l = e[2];
                        break;
                    case 2:
                        c = (n = [v, k, y])[0], i = n[1], l = n[2];
                        break;
                    case 3:
                        c = (t = [v, m, k])[0], i = t[1], l = t[2];
                        break;
                    case 4:
                        c = (a = [y, v, k])[0], i = a[1], l = a[2];
                        break;
                    case 5:
                        c = (f = [k, v, m])[0], i = f[1], l = f[2]
                }
            }
            return [c, i, l, o.length > 3 ? o[3] : 1]
        },
        gr = l.unpack,
        vr = l.type,
        mr = y,
        yr = v,
        kr = h,
        wr = sr;
    yr.prototype.hcg = function() {
        return wr(this._rgb)
    }, mr.hcg = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(yr, [null].concat(r, ["hcg"])))
    }, kr.format.hcg = pr, kr.autodetect.push({
        p: 1,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = gr(r, "hcg"), "array" === vr(r) && 3 === r.length) return "hcg"
        }
    });
    var Mr = l.unpack,
        Nr = l.last,
        _r = Math.round,
        xr = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = Mr(r, "rgba"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = n[3],
                u = Nr(r) || "auto";
            void 0 === o && (o = 1), "auto" === u && (u = o < 1 ? "rgba" : "rgb");
            var c = (t = _r(t)) << 16 | (a = _r(a)) << 8 | (f = _r(f)),
                i = "000000" + c.toString(16);
            i = i.substr(i.length - 6);
            var l = "0" + _r(255 * o).toString(16);
            switch (l = l.substr(l.length - 2), u.toLowerCase()) {
                case "rgba":
                    return "#" + i + l;
                case "argb":
                    return "#" + l + i;
                default:
                    return "#" + i
            }
        },
        Ar = /^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/,
        Er = /^#?([A-Fa-f0-9]{8}|[A-Fa-f0-9]{4})$/,
        Fr = function(r) {
            if (r.match(Ar)) {
                4 !== r.length && 7 !== r.length || (r = r.substr(1)), 3 === r.length && (r = (r = r.split(""))[0] + r[0] + r[1] + r[1] + r[2] + r[2]);
                var e = parseInt(r, 16);
                return [e >> 16, e >> 8 & 255, 255 & e, 1]
            }
            if (r.match(Er)) {
                5 !== r.length && 9 !== r.length || (r = r.substr(1)), 4 === r.length && (r = (r = r.split(""))[0] + r[0] + r[1] + r[1] + r[2] + r[2] + r[3] + r[3]);
                var n = parseInt(r, 16);
                return [n >> 24 & 255, n >> 16 & 255, n >> 8 & 255, Math.round((255 & n) / 255 * 100) / 100]
            }
            throw new Error("unknown hex color: " + r)
        },
        Pr = y,
        Or = v,
        jr = l.type,
        Gr = h,
        Rr = xr;
    Or.prototype.hex = function(r) {
        return Rr(this._rgb, r)
    }, Pr.hex = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(Or, [null].concat(r, ["hex"])))
    }, Gr.format.hex = Fr, Gr.autodetect.push({
        p: 4,
        test: function(r) {
            for (var e = [], n = arguments.length - 1; n-- > 0;) e[n] = arguments[n + 1];
            if (!e.length && "string" === jr(r) && [3, 4, 5, 6, 7, 8, 9].indexOf(r.length) >= 0) return "hex"
        }
    });
    var qr = l.unpack,
        Lr = l.TWOPI,
        Ir = Math.min,
        Br = Math.sqrt,
        Cr = Math.acos,
        Dr = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n, t = qr(r, "rgb"),
                a = t[0],
                f = t[1],
                o = t[2],
                u = Ir(a /= 255, f /= 255, o /= 255),
                c = (a + f + o) / 3,
                i = c > 0 ? 1 - u / c : 0;
            return 0 === i ? n = NaN : (n = (a - f + (a - o)) / 2, n /= Br((a - f) * (a - f) + (a - o) * (f - o)), n = Cr(n), o > f && (n = Lr - n), n /= Lr), [360 * n, i, c]
        },
        Yr = l.unpack,
        Sr = l.limit,
        Tr = l.TWOPI,
        $r = l.PITHIRD,
        zr = Math.cos,
        Xr = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n, t, a, f = (r = Yr(r, "hsi"))[0],
                o = r[1],
                u = r[2];
            return isNaN(f) && (f = 0), isNaN(o) && (o = 0), f > 360 && (f -= 360), f < 0 && (f += 360), (f /= 360) < 1 / 3 ? t = 1 - ((a = (1 - o) / 3) + (n = (1 + o * zr(Tr * f) / zr($r - Tr * f)) / 3)) : f < 2 / 3 ? a = 1 - ((n = (1 - o) / 3) + (t = (1 + o * zr(Tr * (f -= 1 / 3)) / zr($r - Tr * f)) / 3)) : n = 1 - ((t = (1 - o) / 3) + (a = (1 + o * zr(Tr * (f -= 2 / 3)) / zr($r - Tr * f)) / 3)), [255 * (n = Sr(u * n * 3)), 255 * (t = Sr(u * t * 3)), 255 * (a = Sr(u * a * 3)), r.length > 3 ? r[3] : 1]
        },
        Ur = l.unpack,
        Vr = l.type,
        Wr = y,
        Kr = v,
        Zr = h,
        Hr = Dr;
    Kr.prototype.hsi = function() {
        return Hr(this._rgb)
    }, Wr.hsi = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(Kr, [null].concat(r, ["hsi"])))
    }, Zr.format.hsi = Xr, Zr.autodetect.push({
        p: 2,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = Ur(r, "hsi"), "array" === Vr(r) && 3 === r.length) return "hsi"
        }
    });
    var Jr = l.unpack,
        Qr = l.type,
        re = y,
        ee = v,
        ne = h,
        te = I;
    ee.prototype.hsl = function() {
        return te(this._rgb)
    }, re.hsl = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(ee, [null].concat(r, ["hsl"])))
    }, ne.format.hsl = X, ne.autodetect.push({
        p: 2,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = Jr(r, "hsl"), "array" === Qr(r) && 3 === r.length) return "hsl"
        }
    });
    var ae = l.unpack,
        fe = Math.min,
        oe = Math.max,
        ue = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n, t, a, f = (r = ae(r, "rgb"))[0],
                o = r[1],
                u = r[2],
                c = fe(f, o, u),
                i = oe(f, o, u),
                l = i - c;
            return a = i / 255, 0 === i ? (n = Number.NaN, t = 0) : (t = l / i, f === i && (n = (o - u) / l), o === i && (n = 2 + (u - f) / l), u === i && (n = 4 + (f - o) / l), (n *= 60) < 0 && (n += 360)), [n, t, a]
        },
        ce = l.unpack,
        ie = Math.floor,
        le = function() {
            for (var r, e, n, t, a, f, o = [], u = arguments.length; u--;) o[u] = arguments[u];
            var c, i, l, h = (o = ce(o, "hsv"))[0],
                s = o[1],
                d = o[2];
            if (d *= 255, 0 === s) c = i = l = d;
            else {
                360 === h && (h = 0), h > 360 && (h -= 360), h < 0 && (h += 360);
                var b = ie(h /= 60),
                    p = h - b,
                    g = d * (1 - s),
                    v = d * (1 - s * p),
                    m = d * (1 - s * (1 - p));
                switch (b) {
                    case 0:
                        c = (r = [d, m, g])[0], i = r[1], l = r[2];
                        break;
                    case 1:
                        c = (e = [v, d, g])[0], i = e[1], l = e[2];
                        break;
                    case 2:
                        c = (n = [g, d, m])[0], i = n[1], l = n[2];
                        break;
                    case 3:
                        c = (t = [g, v, d])[0], i = t[1], l = t[2];
                        break;
                    case 4:
                        c = (a = [m, g, d])[0], i = a[1], l = a[2];
                        break;
                    case 5:
                        c = (f = [d, g, v])[0], i = f[1], l = f[2]
                }
            }
            return [c, i, l, o.length > 3 ? o[3] : 1]
        },
        he = l.unpack,
        se = l.type,
        de = y,
        be = v,
        pe = h,
        ge = ue;
    be.prototype.hsv = function() {
        return ge(this._rgb)
    }, de.hsv = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(be, [null].concat(r, ["hsv"])))
    }, pe.format.hsv = le, pe.autodetect.push({
        p: 2,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = he(r, "hsv"), "array" === se(r) && 3 === r.length) return "hsv"
        }
    });
    var ve = {
            Kn: 18,
            Xn: .95047,
            Yn: 1,
            Zn: 1.08883,
            t0: .137931034,
            t1: .206896552,
            t2: .12841855,
            t3: .008856452
        },
        me = ve,
        ye = l.unpack,
        ke = Math.pow,
        we = function(r) {
            return (r /= 255) <= .04045 ? r / 12.92 : ke((r + .055) / 1.055, 2.4)
        },
        Me = function(r) {
            return r > me.t3 ? ke(r, 1 / 3) : r / me.t2 + me.t0
        },
        Ne = function(r, e, n) {
            return r = we(r), e = we(e), n = we(n), [Me((.4124564 * r + .3575761 * e + .1804375 * n) / me.Xn), Me((.2126729 * r + .7151522 * e + .072175 * n) / me.Yn), Me((.0193339 * r + .119192 * e + .9503041 * n) / me.Zn)]
        },
        _e = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = ye(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = Ne(t, a, f),
                u = o[0],
                c = o[1],
                i = o[2],
                l = 116 * c - 16;
            return [l < 0 ? 0 : l, 500 * (u - c), 200 * (c - i)]
        },
        xe = ve,
        Ae = l.unpack,
        Ee = Math.pow,
        Fe = function(r) {
            return 255 * (r <= .00304 ? 12.92 * r : 1.055 * Ee(r, 1 / 2.4) - .055)
        },
        Pe = function(r) {
            return r > xe.t1 ? r * r * r : xe.t2 * (r - xe.t0)
        },
        Oe = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n, t, a, f = (r = Ae(r, "lab"))[0],
                o = r[1],
                u = r[2];
            return t = (f + 16) / 116, n = isNaN(o) ? t : t + o / 500, a = isNaN(u) ? t : t - u / 200, t = xe.Yn * Pe(t), n = xe.Xn * Pe(n), a = xe.Zn * Pe(a), [Fe(3.2404542 * n - 1.5371385 * t - .4985314 * a), Fe(-.969266 * n + 1.8760108 * t + .041556 * a), Fe(.0556434 * n - .2040259 * t + 1.0572252 * a), r.length > 3 ? r[3] : 1]
        },
        je = l.unpack,
        Ge = l.type,
        Re = y,
        qe = v,
        Le = h,
        Ie = _e;
    qe.prototype.lab = function() {
        return Ie(this._rgb)
    }, Re.lab = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(qe, [null].concat(r, ["lab"])))
    }, Le.format.lab = Oe, Le.autodetect.push({
        p: 2,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = je(r, "lab"), "array" === Ge(r) && 3 === r.length) return "lab"
        }
    });
    var Be = l.unpack,
        Ce = l.RAD2DEG,
        De = Math.sqrt,
        Ye = Math.atan2,
        Se = Math.round,
        Te = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = Be(r, "lab"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = De(a * a + f * f),
                u = (Ye(f, a) * Ce + 360) % 360;
            return 0 === Se(1e4 * o) && (u = Number.NaN), [t, o, u]
        },
        $e = l.unpack,
        ze = _e,
        Xe = Te,
        Ue = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = $e(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = ze(t, a, f),
                u = o[0],
                c = o[1],
                i = o[2];
            return Xe(u, c, i)
        },
        Ve = l.unpack,
        We = l.DEG2RAD,
        Ke = Math.sin,
        Ze = Math.cos,
        He = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = Ve(r, "lch"),
                t = n[0],
                a = n[1],
                f = n[2];
            return isNaN(f) && (f = 0), [t, Ze(f *= We) * a, Ke(f) * a]
        },
        Je = l.unpack,
        Qe = He,
        rn = Oe,
        en = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = (r = Je(r, "lch"))[0],
                t = r[1],
                a = r[2],
                f = Qe(n, t, a),
                o = f[0],
                u = f[1],
                c = f[2],
                i = rn(o, u, c),
                l = i[0],
                h = i[1],
                s = i[2];
            return [l, h, s, r.length > 3 ? r[3] : 1]
        },
        nn = l.unpack,
        tn = en,
        an = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = nn(r, "hcl").reverse();
            return tn.apply(void 0, n)
        },
        fn = l.unpack,
        on = l.type,
        un = y,
        cn = v,
        ln = h,
        hn = Ue;
    cn.prototype.lch = function() {
        return hn(this._rgb)
    }, cn.prototype.hcl = function() {
        return hn(this._rgb).reverse()
    }, un.lch = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(cn, [null].concat(r, ["lch"])))
    }, un.hcl = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(cn, [null].concat(r, ["hcl"])))
    }, ln.format.lch = en, ln.format.hcl = an, ["lch", "hcl"].forEach((function(r) {
        return ln.autodetect.push({
            p: 2,
            test: function() {
                for (var e = [], n = arguments.length; n--;) e[n] = arguments[n];
                if (e = fn(e, r), "array" === on(e) && 3 === e.length) return r
            }
        })
    }));
    var sn = {
            aliceblue: "#f0f8ff",
            antiquewhite: "#faebd7",
            aqua: "#00ffff",
            aquamarine: "#7fffd4",
            azure: "#f0ffff",
            beige: "#f5f5dc",
            bisque: "#ffe4c4",
            black: "#000000",
            blanchedalmond: "#ffebcd",
            blue: "#0000ff",
            blueviolet: "#8a2be2",
            brown: "#a52a2a",
            burlywood: "#deb887",
            cadetblue: "#5f9ea0",
            chartreuse: "#7fff00",
            chocolate: "#d2691e",
            coral: "#ff7f50",
            cornflower: "#6495ed",
            cornflowerblue: "#6495ed",
            cornsilk: "#fff8dc",
            crimson: "#dc143c",
            cyan: "#00ffff",
            darkblue: "#00008b",
            darkcyan: "#008b8b",
            darkgoldenrod: "#b8860b",
            darkgray: "#a9a9a9",
            darkgreen: "#006400",
            darkgrey: "#a9a9a9",
            darkkhaki: "#bdb76b",
            darkmagenta: "#8b008b",
            darkolivegreen: "#556b2f",
            darkorange: "#ff8c00",
            darkorchid: "#9932cc",
            darkred: "#8b0000",
            darksalmon: "#e9967a",
            darkseagreen: "#8fbc8f",
            darkslateblue: "#483d8b",
            darkslategray: "#2f4f4f",
            darkslategrey: "#2f4f4f",
            darkturquoise: "#00ced1",
            darkviolet: "#9400d3",
            deeppink: "#ff1493",
            deepskyblue: "#00bfff",
            dimgray: "#696969",
            dimgrey: "#696969",
            dodgerblue: "#1e90ff",
            firebrick: "#b22222",
            floralwhite: "#fffaf0",
            forestgreen: "#228b22",
            fuchsia: "#ff00ff",
            gainsboro: "#dcdcdc",
            ghostwhite: "#f8f8ff",
            gold: "#ffd700",
            goldenrod: "#daa520",
            gray: "#808080",
            green: "#008000",
            greenyellow: "#adff2f",
            grey: "#808080",
            honeydew: "#f0fff0",
            hotpink: "#ff69b4",
            indianred: "#cd5c5c",
            indigo: "#4b0082",
            ivory: "#fffff0",
            khaki: "#f0e68c",
            laserlemon: "#ffff54",
            lavender: "#e6e6fa",
            lavenderblush: "#fff0f5",
            lawngreen: "#7cfc00",
            lemonchiffon: "#fffacd",
            lightblue: "#add8e6",
            lightcoral: "#f08080",
            lightcyan: "#e0ffff",
            lightgoldenrod: "#fafad2",
            lightgoldenrodyellow: "#fafad2",
            lightgray: "#d3d3d3",
            lightgreen: "#90ee90",
            lightgrey: "#d3d3d3",
            lightpink: "#ffb6c1",
            lightsalmon: "#ffa07a",
            lightseagreen: "#20b2aa",
            lightskyblue: "#87cefa",
            lightslategray: "#778899",
            lightslategrey: "#778899",
            lightsteelblue: "#b0c4de",
            lightyellow: "#ffffe0",
            lime: "#00ff00",
            limegreen: "#32cd32",
            linen: "#faf0e6",
            magenta: "#ff00ff",
            maroon: "#800000",
            maroon2: "#7f0000",
            maroon3: "#b03060",
            mediumaquamarine: "#66cdaa",
            mediumblue: "#0000cd",
            mediumorchid: "#ba55d3",
            mediumpurple: "#9370db",
            mediumseagreen: "#3cb371",
            mediumslateblue: "#7b68ee",
            mediumspringgreen: "#00fa9a",
            mediumturquoise: "#48d1cc",
            mediumvioletred: "#c71585",
            midnightblue: "#191970",
            mintcream: "#f5fffa",
            mistyrose: "#ffe4e1",
            moccasin: "#ffe4b5",
            navajowhite: "#ffdead",
            navy: "#000080",
            oldlace: "#fdf5e6",
            olive: "#808000",
            olivedrab: "#6b8e23",
            orange: "#ffa500",
            orangered: "#ff4500",
            orchid: "#da70d6",
            palegoldenrod: "#eee8aa",
            palegreen: "#98fb98",
            paleturquoise: "#afeeee",
            palevioletred: "#db7093",
            papayawhip: "#ffefd5",
            peachpuff: "#ffdab9",
            peru: "#cd853f",
            pink: "#ffc0cb",
            plum: "#dda0dd",
            powderblue: "#b0e0e6",
            purple: "#800080",
            purple2: "#7f007f",
            purple3: "#a020f0",
            rebeccapurple: "#663399",
            red: "#ff0000",
            rosybrown: "#bc8f8f",
            royalblue: "#4169e1",
            saddlebrown: "#8b4513",
            salmon: "#fa8072",
            sandybrown: "#f4a460",
            seagreen: "#2e8b57",
            seashell: "#fff5ee",
            sienna: "#a0522d",
            silver: "#c0c0c0",
            skyblue: "#87ceeb",
            slateblue: "#6a5acd",
            slategray: "#708090",
            slategrey: "#708090",
            snow: "#fffafa",
            springgreen: "#00ff7f",
            steelblue: "#4682b4",
            tan: "#d2b48c",
            teal: "#008080",
            thistle: "#d8bfd8",
            tomato: "#ff6347",
            turquoise: "#40e0d0",
            violet: "#ee82ee",
            wheat: "#f5deb3",
            white: "#ffffff",
            whitesmoke: "#f5f5f5",
            yellow: "#ffff00",
            yellowgreen: "#9acd32"
        },
        dn = h,
        bn = l.type,
        pn = sn,
        gn = Fr,
        vn = xr;
    v.prototype.name = function() {
        for (var r = vn(this._rgb, "rgb"), e = 0, n = Object.keys(pn); e < n.length; e += 1) {
            var t = n[e];
            if (pn[t] === r) return t.toLowerCase()
        }
        return r
    }, dn.format.named = function(r) {
        if (r = r.toLowerCase(), pn[r]) return gn(pn[r]);
        throw new Error("unknown color name: " + r)
    }, dn.autodetect.push({
        p: 5,
        test: function(r) {
            for (var e = [], n = arguments.length - 1; n-- > 0;) e[n] = arguments[n + 1];
            if (!e.length && "string" === bn(r) && pn[r.toLowerCase()]) return "named"
        }
    });
    var mn = l.unpack,
        yn = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = mn(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2];
            return (t << 16) + (a << 8) + f
        },
        kn = l.type,
        wn = function(r) {
            if ("number" == kn(r) && r >= 0 && r <= 16777215) return [r >> 16, r >> 8 & 255, 255 & r, 1];
            throw new Error("unknown num color: " + r)
        },
        Mn = y,
        Nn = v,
        _n = h,
        xn = l.type,
        An = yn;
    Nn.prototype.num = function() {
        return An(this._rgb)
    }, Mn.num = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(Nn, [null].concat(r, ["num"])))
    }, _n.format.num = wn, _n.autodetect.push({
        p: 5,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (1 === r.length && "number" === xn(r[0]) && r[0] >= 0 && r[0] <= 16777215) return "num"
        }
    });
    var En = y,
        Fn = v,
        Pn = h,
        On = l.unpack,
        jn = l.type,
        Gn = Math.round;
    Fn.prototype.rgb = function(r) {
        return void 0 === r && (r = !0), !1 === r ? this._rgb.slice(0, 3) : this._rgb.slice(0, 3).map(Gn)
    }, Fn.prototype.rgba = function(r) {
        return void 0 === r && (r = !0), this._rgb.slice(0, 4).map((function(e, n) {
            return n < 3 ? !1 === r ? e : Gn(e) : e
        }))
    }, En.rgb = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(Fn, [null].concat(r, ["rgb"])))
    }, Pn.format.rgb = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        var n = On(r, "rgba");
        return void 0 === n[3] && (n[3] = 1), n
    }, Pn.autodetect.push({
        p: 3,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = On(r, "rgba"), "array" === jn(r) && (3 === r.length || 4 === r.length && "number" == jn(r[3]) && r[3] >= 0 && r[3] <= 1)) return "rgb"
        }
    });
    var Rn = Math.log,
        qn = function(r) {
            var e, n, t, a = r / 100;
            return a < 66 ? (e = 255, n = a < 6 ? 0 : -155.25485562709179 - .44596950469579133 * (n = a - 2) + 104.49216199393888 * Rn(n), t = a < 20 ? 0 : .8274096064007395 * (t = a - 10) - 254.76935184120902 + 115.67994401066147 * Rn(t)) : (e = 351.97690566805693 + .114206453784165 * (e = a - 55) - 40.25366309332127 * Rn(e), n = 325.4494125711974 + .07943456536662342 * (n = a - 50) - 28.0852963507957 * Rn(n), t = 255), [e, n, t, 1]
        },
        Ln = qn,
        In = l.unpack,
        Bn = Math.round,
        Cn = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            for (var n, t = In(r, "rgb"), a = t[0], f = t[2], o = 1e3, u = 4e4, c = .4; u - o > c;) {
                var i = Ln(n = .5 * (u + o));
                i[2] / i[0] >= f / a ? u = n : o = n
            }
            return Bn(n)
        },
        Dn = y,
        Yn = v,
        Sn = h,
        Tn = Cn;
    Yn.prototype.temp = Yn.prototype.kelvin = Yn.prototype.temperature = function() {
        return Tn(this._rgb)
    }, Dn.temp = Dn.kelvin = Dn.temperature = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(Yn, [null].concat(r, ["temp"])))
    }, Sn.format.temp = Sn.format.kelvin = Sn.format.temperature = qn;
    var $n = l.unpack,
        zn = Math.cbrt,
        Xn = Math.pow,
        Un = Math.sign,
        Vn = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = $n(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = [Wn(t / 255), Wn(a / 255), Wn(f / 255)],
                u = o[0],
                c = o[1],
                i = o[2],
                l = zn(.4122214708 * u + .5363325363 * c + .0514459929 * i),
                h = zn(.2119034982 * u + .6806995451 * c + .1073969566 * i),
                s = zn(.0883024619 * u + .2817188376 * c + .6299787005 * i);
            return [.2104542553 * l + .793617785 * h - .0040720468 * s, 1.9779984951 * l - 2.428592205 * h + .4505937099 * s, .0259040371 * l + .7827717662 * h - .808675766 * s]
        };

    function Wn(r) {
        var e = Math.abs(r);
        return e < .04045 ? r / 12.92 : (Un(r) || 1) * Xn((e + .055) / 1.055, 2.4)
    }
    var Kn = l.unpack,
        Zn = Math.pow,
        Hn = Math.sign,
        Jn = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = (r = Kn(r, "lab"))[0],
                t = r[1],
                a = r[2],
                f = Zn(n + .3963377774 * t + .2158037573 * a, 3),
                o = Zn(n - .1055613458 * t - .0638541728 * a, 3),
                u = Zn(n - .0894841775 * t - 1.291485548 * a, 3);
            return [255 * Qn(4.0767416621 * f - 3.3077115913 * o + .2309699292 * u), 255 * Qn(-1.2684380046 * f + 2.6097574011 * o - .3413193965 * u), 255 * Qn(-.0041960863 * f - .7034186147 * o + 1.707614701 * u), r.length > 3 ? r[3] : 1]
        };

    function Qn(r) {
        var e = Math.abs(r);
        return e > .0031308 ? (Hn(r) || 1) * (1.055 * Zn(e, 1 / 2.4) - .055) : 12.92 * r
    }
    var rt = l.unpack,
        et = l.type,
        nt = y,
        tt = v,
        at = h,
        ft = Vn;
    tt.prototype.oklab = function() {
        return ft(this._rgb)
    }, nt.oklab = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(tt, [null].concat(r, ["oklab"])))
    }, at.format.oklab = Jn, at.autodetect.push({
        p: 3,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = rt(r, "oklab"), "array" === et(r) && 3 === r.length) return "oklab"
        }
    });
    var ot = l.unpack,
        ut = Vn,
        ct = Te,
        it = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = ot(r, "rgb"),
                t = n[0],
                a = n[1],
                f = n[2],
                o = ut(t, a, f),
                u = o[0],
                c = o[1],
                i = o[2];
            return ct(u, c, i)
        },
        lt = l.unpack,
        ht = He,
        st = Jn,
        dt = function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            var n = (r = lt(r, "lch"))[0],
                t = r[1],
                a = r[2],
                f = ht(n, t, a),
                o = f[0],
                u = f[1],
                c = f[2],
                i = st(o, u, c),
                l = i[0],
                h = i[1],
                s = i[2];
            return [l, h, s, r.length > 3 ? r[3] : 1]
        },
        bt = l.unpack,
        pt = l.type,
        gt = y,
        vt = v,
        mt = h,
        yt = it;
    vt.prototype.oklch = function() {
        return yt(this._rgb)
    }, gt.oklch = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        return new(Function.prototype.bind.apply(vt, [null].concat(r, ["oklch"])))
    }, mt.format.oklch = dt, mt.autodetect.push({
        p: 3,
        test: function() {
            for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
            if (r = bt(r, "oklch"), "array" === pt(r) && 3 === r.length) return "oklch"
        }
    });
    var kt = v,
        wt = l.type;
    kt.prototype.alpha = function(r, e) {
        return void 0 === e && (e = !1), void 0 !== r && "number" === wt(r) ? e ? (this._rgb[3] = r, this) : new kt([this._rgb[0], this._rgb[1], this._rgb[2], r], "rgb") : this._rgb[3]
    }, v.prototype.clipped = function() {
        return this._rgb._clipped || !1
    };
    var Mt = v,
        Nt = ve;
    Mt.prototype.darken = function(r) {
        void 0 === r && (r = 1);
        var e = this.lab();
        return e[0] -= Nt.Kn * r, new Mt(e, "lab").alpha(this.alpha(), !0)
    }, Mt.prototype.brighten = function(r) {
        return void 0 === r && (r = 1), this.darken(-r)
    }, Mt.prototype.darker = Mt.prototype.darken, Mt.prototype.brighter = Mt.prototype.brighten, v.prototype.get = function(r) {
        var e = r.split("."),
            n = e[0],
            t = e[1],
            a = this[n]();
        if (t) {
            var f = n.indexOf(t) - ("ok" === n.substr(0, 2) ? 2 : 0);
            if (f > -1) return a[f];
            throw new Error("unknown channel " + t + " in mode " + n)
        }
        return a
    };
    var _t = v,
        xt = l.type,
        At = Math.pow;
    _t.prototype.luminance = function(r) {
        if (void 0 !== r && "number" === xt(r)) {
            if (0 === r) return new _t([0, 0, 0, this._rgb[3]], "rgb");
            if (1 === r) return new _t([255, 255, 255, this._rgb[3]], "rgb");
            var e = this.luminance(),
                n = 20,
                t = function(e, a) {
                    var f = e.interpolate(a, .5, "rgb"),
                        o = f.luminance();
                    return Math.abs(r - o) < 1e-7 || !n-- ? f : o > r ? t(e, f) : t(f, a)
                },
                a = (e > r ? t(new _t([0, 0, 0]), this) : t(this, new _t([255, 255, 255]))).rgb();
            return new _t(a.concat([this._rgb[3]]))
        }
        return Et.apply(void 0, this._rgb.slice(0, 3))
    };
    var Et = function(r, e, n) {
            return .2126 * (r = Ft(r)) + .7152 * (e = Ft(e)) + .0722 * (n = Ft(n))
        },
        Ft = function(r) {
            return (r /= 255) <= .03928 ? r / 12.92 : At((r + .055) / 1.055, 2.4)
        },
        Pt = {},
        Ot = v,
        jt = l.type,
        Gt = Pt,
        Rt = function(r, e, n) {
            void 0 === n && (n = .5);
            for (var t = [], a = arguments.length - 3; a-- > 0;) t[a] = arguments[a + 3];
            var f = t[0] || "lrgb";
            if (Gt[f] || t.length || (f = Object.keys(Gt)[0]), !Gt[f]) throw new Error("interpolation mode " + f + " is not defined");
            return "object" !== jt(r) && (r = new Ot(r)), "object" !== jt(e) && (e = new Ot(e)), Gt[f](r, e, n).alpha(r.alpha() + n * (e.alpha() - r.alpha()))
        },
        qt = v,
        Lt = Rt;
    qt.prototype.mix = qt.prototype.interpolate = function(r, e) {
        void 0 === e && (e = .5);
        for (var n = [], t = arguments.length - 2; t-- > 0;) n[t] = arguments[t + 2];
        return Lt.apply(void 0, [this, r, e].concat(n))
    };
    var It = v;
    It.prototype.premultiply = function(r) {
        void 0 === r && (r = !1);
        var e = this._rgb,
            n = e[3];
        return r ? (this._rgb = [e[0] * n, e[1] * n, e[2] * n, n], this) : new It([e[0] * n, e[1] * n, e[2] * n, n], "rgb")
    };
    var Bt = v,
        Ct = ve;
    Bt.prototype.saturate = function(r) {
        void 0 === r && (r = 1);
        var e = this.lch();
        return e[1] += Ct.Kn * r, e[1] < 0 && (e[1] = 0), new Bt(e, "lch").alpha(this.alpha(), !0)
    }, Bt.prototype.desaturate = function(r) {
        return void 0 === r && (r = 1), this.saturate(-r)
    };
    var Dt = v,
        Yt = l.type;
    Dt.prototype.set = function(r, e, n) {
        void 0 === n && (n = !1);
        var t = r.split("."),
            a = t[0],
            f = t[1],
            o = this[a]();
        if (f) {
            var u = a.indexOf(f) - ("ok" === a.substr(0, 2) ? 2 : 0);
            if (u > -1) {
                if ("string" == Yt(e)) switch (e.charAt(0)) {
                    case "+":
                    case "-":
                        o[u] += +e;
                        break;
                    case "*":
                        o[u] *= +e.substr(1);
                        break;
                    case "/":
                        o[u] /= +e.substr(1);
                        break;
                    default:
                        o[u] = +e
                } else {
                    if ("number" !== Yt(e)) throw new Error("unsupported%20value%20for%20Color.html");
                    o[u] = e
                }
                var c = new Dt(o, a);
                return n ? (this._rgb = c._rgb, this) : c
            }
            throw new Error("unknown channel " + f + " in mode " + a)
        }
        return o
    };
    var St = v;
    Pt.rgb = function(r, e, n) {
        var t = r._rgb,
            a = e._rgb;
        return new St(t[0] + n * (a[0] - t[0]), t[1] + n * (a[1] - t[1]), t[2] + n * (a[2] - t[2]), "rgb")
    };
    var Tt = v,
        $t = Math.sqrt,
        zt = Math.pow;
    Pt.lrgb = function(r, e, n) {
        var t = r._rgb,
            a = t[0],
            f = t[1],
            o = t[2],
            u = e._rgb,
            c = u[0],
            i = u[1],
            l = u[2];
        return new Tt($t(zt(a, 2) * (1 - n) + zt(c, 2) * n), $t(zt(f, 2) * (1 - n) + zt(i, 2) * n), $t(zt(o, 2) * (1 - n) + zt(l, 2) * n), "rgb")
    };
    var Xt = v;
    Pt.lab = function(r, e, n) {
        var t = r.lab(),
            a = e.lab();
        return new Xt(t[0] + n * (a[0] - t[0]), t[1] + n * (a[1] - t[1]), t[2] + n * (a[2] - t[2]), "lab")
    };
    var Ut = v,
        Vt = function(r, e, n, t) {
            var a, f, o, u, c, i, l, h, s, d, b, p, g;
            return "hsl" === t ? (o = r.hsl(), u = e.hsl()) : "hsv" === t ? (o = r.hsv(), u = e.hsv()) : "hcg" === t ? (o = r.hcg(), u = e.hcg()) : "hsi" === t ? (o = r.hsi(), u = e.hsi()) : "lch" === t || "hcl" === t ? (t = "hcl", o = r.hcl(), u = e.hcl()) : "oklch" === t && (o = r.oklch().reverse(), u = e.oklch().reverse()), "h" !== t.substr(0, 1) && "oklch" !== t || (c = (a = o)[0], l = a[1], s = a[2], i = (f = u)[0], h = f[1], d = f[2]), isNaN(c) || isNaN(i) ? isNaN(c) ? isNaN(i) ? p = Number.NaN : (p = i, 1 != s && 0 != s || "hsv" == t || (b = h)) : (p = c, 1 != d && 0 != d || "hsv" == t || (b = l)) : p = c + n * (i > c && i - c > 180 ? i - (c + 360) : i < c && c - i > 180 ? i + 360 - c : i - c), void 0 === b && (b = l + n * (h - l)), g = s + n * (d - s), new Ut("oklch" === t ? [g, b, p] : [p, b, g], t)
        },
        Wt = Vt,
        Kt = function(r, e, n) {
            return Wt(r, e, n, "lch")
        };
    Pt.lch = Kt, Pt.hcl = Kt;
    var Zt = v;
    Pt.num = function(r, e, n) {
        var t = r.num(),
            a = e.num();
        return new Zt(t + n * (a - t), "num")
    };
    var Ht = Vt;
    Pt.hcg = function(r, e, n) {
        return Ht(r, e, n, "hcg")
    };
    var Jt = Vt;
    Pt.hsi = function(r, e, n) {
        return Jt(r, e, n, "hsi")
    };
    var Qt = Vt;
    Pt.hsl = function(r, e, n) {
        return Qt(r, e, n, "hsl")
    };
    var ra = Vt;
    Pt.hsv = function(r, e, n) {
        return ra(r, e, n, "hsv")
    };
    var ea = v;
    Pt.oklab = function(r, e, n) {
        var t = r.oklab(),
            a = e.oklab();
        return new ea(t[0] + n * (a[0] - t[0]), t[1] + n * (a[1] - t[1]), t[2] + n * (a[2] - t[2]), "oklab")
    };
    var na = Vt;
    Pt.oklch = function(r, e, n) {
        return na(r, e, n, "oklch")
    };
    var ta = v,
        aa = l.clip_rgb,
        fa = Math.pow,
        oa = Math.sqrt,
        ua = Math.PI,
        ca = Math.cos,
        ia = Math.sin,
        la = Math.atan2,
        ha = function(r, e) {
            for (var n = r.length, t = [0, 0, 0, 0], a = 0; a < r.length; a++) {
                var f = r[a],
                    o = e[a] / n,
                    u = f._rgb;
                t[0] += fa(u[0], 2) * o, t[1] += fa(u[1], 2) * o, t[2] += fa(u[2], 2) * o, t[3] += u[3] * o
            }
            return t[0] = oa(t[0]), t[1] = oa(t[1]), t[2] = oa(t[2]), t[3] > .9999999 && (t[3] = 1), new ta(aa(t))
        },
        sa = y,
        da = l.type,
        ba = Math.pow,
        pa = function(r) {
            var e = "rgb",
                n = sa("#ccc"),
                t = 0,
                a = [0, 1],
                f = [],
                o = [0, 0],
                u = !1,
                c = [],
                i = !1,
                l = 0,
                h = 1,
                s = !1,
                d = {},
                b = !0,
                p = 1,
                g = function(r) {
                    if ((r = r || ["#fff", "#000"]) && "string" === da(r) && sa.brewer && sa.brewer[r.toLowerCase()] && (r = sa.brewer[r.toLowerCase()]), "array" === da(r)) {
                        1 === r.length && (r = [r[0], r[0]]), r = r.slice(0);
                        for (var e = 0; e < r.length; e++) r[e] = sa(r[e]);
                        f.length = 0;
                        for (var n = 0; n < r.length; n++) f.push(n / (r.length - 1))
                    }
                    return k(), c = r
                },
                v = function(r) {
                    return r
                },
                m = function(r) {
                    return r
                },
                y = function(r, t) {
                    var a, i;
                    if (null == t && (t = !1), isNaN(r) || null === r) return n;
                    if (t) i = r;
                    else if (u && u.length > 2) {
                        var s = function(r) {
                            if (null != u) {
                                for (var e = u.length - 1, n = 0; n < e && r >= u[n];) n++;
                                return n - 1
                            }
                            return 0
                        }(r);
                        i = s / (u.length - 2)
                    } else i = h !== l ? (r - l) / (h - l) : 1;
                    i = m(i), t || (i = v(i)), 1 !== p && (i = ba(i, p)), i = o[0] + i * (1 - o[0] - o[1]), i = Math.min(1, Math.max(0, i));
                    var g = Math.floor(1e4 * i);
                    if (b && d[g]) a = d[g];
                    else {
                        if ("array" === da(c))
                            for (var y = 0; y < f.length; y++) {
                                var k = f[y];
                                if (i <= k) {
                                    a = c[y];
                                    break
                                }
                                if (i >= k && y === f.length - 1) {
                                    a = c[y];
                                    break
                                }
                                if (i > k && i < f[y + 1]) {
                                    i = (i - k) / (f[y + 1] - k), a = sa.interpolate(c[y], c[y + 1], i, e);
                                    break
                                }
                            } else "function" === da(c) && (a = c(i));
                        b && (d[g] = a)
                    }
                    return a
                },
                k = function() {
                    return d = {}
                };
            g(r);
            var w = function(r) {
                var e = sa(y(r));
                return i && e[i] ? e[i]() : e
            };
            return w.classes = function(r) {
                if (null != r) {
                    if ("array" === da(r)) u = r, a = [r[0], r[r.length - 1]];
                    else {
                        var e = sa.analyze(a);
                        u = 0 === r ? [e.min, e.max] : sa.limits(e, "e", r)
                    }
                    return w
                }
                return u
            }, w.domain = function(r) {
                if (!arguments.length) return a;
                l = r[0], h = r[r.length - 1], f = [];
                var e = c.length;
                if (r.length === e && l !== h)
                    for (var n = 0, t = Array.from(r); n < t.length; n += 1) {
                        var o = t[n];
                        f.push((o - l) / (h - l))
                    } else {
                        for (var u = 0; u < e; u++) f.push(u / (e - 1));
                        if (r.length > 2) {
                            var i = r.map((function(e, n) {
                                    return n / (r.length - 1)
                                })),
                                s = r.map((function(r) {
                                    return (r - l) / (h - l)
                                }));
                            s.every((function(r, e) {
                                return i[e] === r
                            })) || (m = function(r) {
                                if (r <= 0 || r >= 1) return r;
                                for (var e = 0; r >= s[e + 1];) e++;
                                var n = (r - s[e]) / (s[e + 1] - s[e]);
                                return i[e] + n * (i[e + 1] - i[e])
                            })
                        }
                    }
                return a = [l, h], w
            }, w.mode = function(r) {
                return arguments.length ? (e = r, k(), w) : e
            }, w.range = function(r, e) {
                return g(r), w
            }, w.out = function(r) {
                return i = r, w
            }, w.spread = function(r) {
                return arguments.length ? (t = r, w) : t
            }, w.correctLightness = function(r) {
                return null == r && (r = !0), s = r, k(), v = s ? function(r) {
                    for (var e = y(0, !0).lab()[0], n = y(1, !0).lab()[0], t = e > n, a = y(r, !0).lab()[0], f = e + (n - e) * r, o = a - f, u = 0, c = 1, i = 20; Math.abs(o) > .01 && i-- > 0;) t && (o *= -1), o < 0 ? (u = r, r += .5 * (c - r)) : (c = r, r += .5 * (u - r)), a = y(r, !0).lab()[0], o = a - f;
                    return r
                } : function(r) {
                    return r
                }, w
            }, w.padding = function(r) {
                return null != r ? ("number" === da(r) && (r = [r, r]), o = r, w) : o
            }, w.colors = function(e, n) {
                arguments.length < 2 && (n = "hex");
                var t = [];
                if (0 === arguments.length) t = c.slice(0);
                else if (1 === e) t = [w(.5)];
                else if (e > 1) {
                    var f = a[0],
                        o = a[1] - f;
                    t = ga(0, e, !1).map((function(r) {
                        return w(f + r / (e - 1) * o)
                    }))
                } else {
                    r = [];
                    var i = [];
                    if (u && u.length > 2)
                        for (var l = 1, h = u.length, s = 1 <= h; s ? l < h : l > h; s ? l++ : l--) i.push(.5 * (u[l - 1] + u[l]));
                    else i = a;
                    t = i.map((function(r) {
                        return w(r)
                    }))
                }
                return sa[n] && (t = t.map((function(r) {
                    return r[n]()
                }))), t
            }, w.cache = function(r) {
                return null != r ? (b = r, w) : b
            }, w.gamma = function(r) {
                return null != r ? (p = r, w) : p
            }, w.nodata = function(r) {
                return null != r ? (n = sa(r), w) : n
            }, w
        };

    function ga(r, e, n) {
        for (var t = [], a = r < e, f = n ? a ? e + 1 : e - 1 : e, o = r; a ? o < f : o > f; a ? o++ : o--) t.push(o);
        return t
    }
    var va = v,
        ma = pa,
        ya = y,
        ka = function(r, e, n) {
            if (!ka[n]) throw new Error("unknown blend mode " + n);
            return ka[n](r, e)
        },
        wa = function(r) {
            return function(e, n) {
                var t = ya(n).rgb(),
                    a = ya(e).rgb();
                return ya.rgb(r(t, a))
            }
        },
        Ma = function(r) {
            return function(e, n) {
                var t = [];
                return t[0] = r(e[0], n[0]), t[1] = r(e[1], n[1]), t[2] = r(e[2], n[2]), t
            }
        };
    ka.normal = wa(Ma((function(r) {
        return r
    }))), ka.multiply = wa(Ma((function(r, e) {
        return r * e / 255
    }))), ka.screen = wa(Ma((function(r, e) {
        return 255 * (1 - (1 - r / 255) * (1 - e / 255))
    }))), ka.overlay = wa(Ma((function(r, e) {
        return e < 128 ? 2 * r * e / 255 : 255 * (1 - 2 * (1 - r / 255) * (1 - e / 255))
    }))), ka.darken = wa(Ma((function(r, e) {
        return r > e ? e : r
    }))), ka.lighten = wa(Ma((function(r, e) {
        return r > e ? r : e
    }))), ka.dodge = wa(Ma((function(r, e) {
        return 255 === r || (r = e / 255 * 255 / (1 - r / 255)) > 255 ? 255 : r
    }))), ka.burn = wa(Ma((function(r, e) {
        return 255 * (1 - (1 - e / 255) / (r / 255))
    })));
    for (var Na = ka, _a = l.type, xa = l.clip_rgb, Aa = l.TWOPI, Ea = Math.pow, Fa = Math.sin, Pa = Math.cos, Oa = y, ja = v, Ga = Math.floor, Ra = Math.random, qa = o, La = Math.log, Ia = Math.pow, Ba = Math.floor, Ca = Math.abs, Da = function(r, e) {
            void 0 === e && (e = null);
            var n = {
                min: Number.MAX_VALUE,
                max: -1 * Number.MAX_VALUE,
                sum: 0,
                values: [],
                count: 0
            };
            return "object" === qa(r) && (r = Object.values(r)), r.forEach((function(r) {
                e && "object" === qa(r) && (r = r[e]), null == r || isNaN(r) || (n.values.push(r), n.sum += r, r < n.min && (n.min = r), r > n.max && (n.max = r), n.count += 1)
            })), n.domain = [n.min, n.max], n.limits = function(r, e) {
                return Ya(n, r, e)
            }, n
        }, Ya = function(r, e, n) {
            void 0 === e && (e = "equal"), void 0 === n && (n = 7), "array" == qa(r) && (r = Da(r));
            var t = r.min,
                a = r.max,
                f = r.values.sort((function(r, e) {
                    return r - e
                }));
            if (1 === n) return [t, a];
            var o = [];
            if ("c" === e.substr(0, 1) && (o.push(t), o.push(a)), "e" === e.substr(0, 1)) {
                o.push(t);
                for (var u = 1; u < n; u++) o.push(t + u / n * (a - t));
                o.push(a)
            } else if ("l" === e.substr(0, 1)) {
                if (t <= 0) throw new Error("Logarithmic scales are only possible for values > 0");
                var c = Math.LOG10E * La(t),
                    i = Math.LOG10E * La(a);
                o.push(t);
                for (var l = 1; l < n; l++) o.push(Ia(10, c + l / n * (i - c)));
                o.push(a)
            } else if ("q" === e.substr(0, 1)) {
                o.push(t);
                for (var h = 1; h < n; h++) {
                    var s = (f.length - 1) * h / n,
                        d = Ba(s);
                    if (d === s) o.push(f[d]);
                    else {
                        var b = s - d;
                        o.push(f[d] * (1 - b) + f[d + 1] * b)
                    }
                }
                o.push(a)
            } else if ("k" === e.substr(0, 1)) {
                var p, g = f.length,
                    v = new Array(g),
                    m = new Array(n),
                    y = !0,
                    k = 0,
                    w = null;
                (w = []).push(t);
                for (var M = 1; M < n; M++) w.push(t + M / n * (a - t));
                for (w.push(a); y;) {
                    for (var N = 0; N < n; N++) m[N] = 0;
                    for (var _ = 0; _ < g; _++)
                        for (var x = f[_], A = Number.MAX_VALUE, E = void 0, F = 0; F < n; F++) {
                            var P = Ca(w[F] - x);
                            P < A && (A = P, E = F), m[E]++, v[_] = E
                        }
                    for (var O = new Array(n), j = 0; j < n; j++) O[j] = null;
                    for (var G = 0; G < g; G++) null === O[p = v[G]] ? O[p] = f[G] : O[p] += f[G];
                    for (var R = 0; R < n; R++) O[R] *= 1 / m[R];
                    y = !1;
                    for (var q = 0; q < n; q++)
                        if (O[q] !== w[q]) {
                            y = !0;
                            break
                        }
                    w = O, ++k > 200 && (y = !1)
                }
                for (var L = {}, I = 0; I < n; I++) L[I] = [];
                for (var B = 0; B < g; B++) L[p = v[B]].push(f[B]);
                for (var C = [], D = 0; D < n; D++) C.push(L[D][0]), C.push(L[D][L[D].length - 1]);
                C = C.sort((function(r, e) {
                    return r - e
                })), o.push(C[0]);
                for (var Y = 1; Y < C.length; Y += 2) {
                    var S = C[Y];
                    isNaN(S) || -1 !== o.indexOf(S) || o.push(S)
                }
            }
            return o
        }, Sa = {
            analyze: Da,
            limits: Ya
        }, Ta = v, $a = v, za = Math.sqrt, Xa = Math.pow, Ua = Math.min, Va = Math.max, Wa = Math.atan2, Ka = Math.abs, Za = Math.cos, Ha = Math.sin, Ja = Math.exp, Qa = Math.PI, rf = v, ef = v, nf = y, tf = pa, af = {
            cool: function() {
                return tf([nf.hsl(180, 1, .9), nf.hsl(250, .7, .4)])
            },
            hot: function() {
                return tf(["#000", "#f00", "#ff0", "#fff"]).mode("rgb")
            }
        }, ff = {
            OrRd: ["#fff7ec", "#fee8c8", "#fdd49e", "#fdbb84", "#fc8d59", "#ef6548", "#d7301f", "#b30000", "#7f0000"],
            PuBu: ["#fff7fb", "#ece7f2", "#d0d1e6", "#a6bddb", "#74a9cf", "#3690c0", "#0570b0", "#045a8d", "#023858"],
            BuPu: ["#f7fcfd", "#e0ecf4", "#bfd3e6", "#9ebcda", "#8c96c6", "#8c6bb1", "#88419d", "#810f7c", "#4d004b"],
            Oranges: ["#fff5eb", "#fee6ce", "#fdd0a2", "#fdae6b", "#fd8d3c", "#f16913", "#d94801", "#a63603", "#7f2704"],
            BuGn: ["#f7fcfd", "#e5f5f9", "#ccece6", "#99d8c9", "#66c2a4", "#41ae76", "#238b45", "#006d2c", "#00441b"],
            YlOrBr: ["#ffffe5", "#fff7bc", "#fee391", "#fec44f", "#fe9929", "#ec7014", "#cc4c02", "#993404", "#662506"],
            YlGn: ["#ffffe5", "#f7fcb9", "#d9f0a3", "#addd8e", "#78c679", "#41ab5d", "#238443", "#006837", "#004529"],
            Reds: ["#fff5f0", "#fee0d2", "#fcbba1", "#fc9272", "#fb6a4a", "#ef3b2c", "#cb181d", "#a50f15", "#67000d"],
            RdPu: ["#fff7f3", "#fde0dd", "#fcc5c0", "#fa9fb5", "#f768a1", "#dd3497", "#ae017e", "#7a0177", "#49006a"],
            Greens: ["#f7fcf5", "#e5f5e0", "#c7e9c0", "#a1d99b", "#74c476", "#41ab5d", "#238b45", "#006d2c", "#00441b"],
            YlGnBu: ["#ffffd9", "#edf8b1", "#c7e9b4", "#7fcdbb", "#41b6c4", "#1d91c0", "#225ea8", "#253494", "#081d58"],
            Purples: ["#fcfbfd", "#efedf5", "#dadaeb", "#bcbddc", "#9e9ac8", "#807dba", "#6a51a3", "#54278f", "#3f007d"],
            GnBu: ["#f7fcf0", "#e0f3db", "#ccebc5", "#a8ddb5", "#7bccc4", "#4eb3d3", "#2b8cbe", "#0868ac", "#084081"],
            Greys: ["#ffffff", "#f0f0f0", "#d9d9d9", "#bdbdbd", "#969696", "#737373", "#525252", "#252525", "#000000"],
            YlOrRd: ["#ffffcc", "#ffeda0", "#fed976", "#feb24c", "#fd8d3c", "#fc4e2a", "#e31a1c", "#bd0026", "#800026"],
            PuRd: ["#f7f4f9", "#e7e1ef", "#d4b9da", "#c994c7", "#df65b0", "#e7298a", "#ce1256", "#980043", "#67001f"],
            Blues: ["#f7fbff", "#deebf7", "#c6dbef", "#9ecae1", "#6baed6", "#4292c6", "#2171b5", "#08519c", "#08306b"],
            PuBuGn: ["#fff7fb", "#ece2f0", "#d0d1e6", "#a6bddb", "#67a9cf", "#3690c0", "#02818a", "#016c59", "#014636"],
            Viridis: ["#440154", "#482777", "#3f4a8a", "#31678e", "#26838f", "#1f9d8a", "#6cce5a", "#b6de2b", "#fee825"],
            Spectral: ["#9e0142", "#d53e4f", "#f46d43", "#fdae61", "#fee08b", "#ffffbf", "#e6f598", "#abdda4", "#66c2a5", "#3288bd", "#5e4fa2"],
            RdYlGn: ["#a50026", "#d73027", "#f46d43", "#fdae61", "#fee08b", "#ffffbf", "#d9ef8b", "#a6d96a", "#66bd63", "#1a9850", "#006837"],
            RdBu: ["#67001f", "#b2182b", "#d6604d", "#f4a582", "#fddbc7", "#f7f7f7", "#d1e5f0", "#92c5de", "#4393c3", "#2166ac", "#053061"],
            PiYG: ["#8e0152", "#c51b7d", "#de77ae", "#f1b6da", "#fde0ef", "#f7f7f7", "#e6f5d0", "#b8e186", "#7fbc41", "#4d9221", "#276419"],
            PRGn: ["#40004b", "#762a83", "#9970ab", "#c2a5cf", "#e7d4e8", "#f7f7f7", "#d9f0d3", "#a6dba0", "#5aae61", "#1b7837", "#00441b"],
            RdYlBu: ["#a50026", "#d73027", "#f46d43", "#fdae61", "#fee090", "#ffffbf", "#e0f3f8", "#abd9e9", "#74add1", "#4575b4", "#313695"],
            BrBG: ["#543005", "#8c510a", "#bf812d", "#dfc27d", "#f6e8c3", "#f5f5f5", "#c7eae5", "#80cdc1", "#35978f", "#01665e", "#003c30"],
            RdGy: ["#67001f", "#b2182b", "#d6604d", "#f4a582", "#fddbc7", "#ffffff", "#e0e0e0", "#bababa", "#878787", "#4d4d4d", "#1a1a1a"],
            PuOr: ["#7f3b08", "#b35806", "#e08214", "#fdb863", "#fee0b6", "#f7f7f7", "#d8daeb", "#b2abd2", "#8073ac", "#542788", "#2d004b"],
            Set2: ["#66c2a5", "#fc8d62", "#8da0cb", "#e78ac3", "#a6d854", "#ffd92f", "#e5c494", "#b3b3b3"],
            Accent: ["#7fc97f", "#beaed4", "#fdc086", "#ffff99", "#386cb0", "#f0027f", "#bf5b17", "#666666"],
            Set1: ["#e41a1c", "#377eb8", "#4daf4a", "#984ea3", "#ff7f00", "#ffff33", "#a65628", "#f781bf", "#999999"],
            Set3: ["#8dd3c7", "#ffffb3", "#bebada", "#fb8072", "#80b1d3", "#fdb462", "#b3de69", "#fccde5", "#d9d9d9", "#bc80bd", "#ccebc5", "#ffed6f"],
            Dark2: ["#1b9e77", "#d95f02", "#7570b3", "#e7298a", "#66a61e", "#e6ab02", "#a6761d", "#666666"],
            Paired: ["#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99", "#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
            Pastel2: ["#b3e2cd", "#fdcdac", "#cbd5e8", "#f4cae4", "#e6f5c9", "#fff2ae", "#f1e2cc", "#cccccc"],
            Pastel1: ["#fbb4ae", "#b3cde3", "#ccebc5", "#decbe4", "#fed9a6", "#ffffcc", "#e5d8bd", "#fddaec", "#f2f2f2"]
        }, of = 0, uf = Object.keys(ff); of < uf.length; of += 1) {
        var cf = uf[ of ];
        ff[cf.toLowerCase()] = ff[cf]
    }
    var lf = ff,
        hf = y;
    return hf.average = function(r, e, n) {
        void 0 === e && (e = "lrgb"), void 0 === n && (n = null);
        var t = r.length;
        n || (n = Array.from(new Array(t)).map((function() {
            return 1
        })));
        var a = t / n.reduce((function(r, e) {
            return r + e
        }));
        if (n.forEach((function(r, e) {
                n[e] *= a
            })), r = r.map((function(r) {
                return new ta(r)
            })), "lrgb" === e) return ha(r, n);
        for (var f = r.shift(), o = f.get(e), u = [], c = 0, i = 0, l = 0; l < o.length; l++)
            if (o[l] = (o[l] || 0) * n[0], u.push(isNaN(o[l]) ? 0 : n[0]), "h" === e.charAt(l) && !isNaN(o[l])) {
                var h = o[l] / 180 * ua;
                c += ca(h) * n[0], i += ia(h) * n[0]
            }
        var s = f.alpha() * n[0];
        r.forEach((function(r, t) {
            var a = r.get(e);
            s += r.alpha() * n[t + 1];
            for (var f = 0; f < o.length; f++)
                if (!isNaN(a[f]))
                    if (u[f] += n[t + 1], "h" === e.charAt(f)) {
                        var l = a[f] / 180 * ua;
                        c += ca(l) * n[t + 1], i += ia(l) * n[t + 1]
                    } else o[f] += a[f] * n[t + 1]
        }));
        for (var d = 0; d < o.length; d++)
            if ("h" === e.charAt(d)) {
                for (var b = la(i / u[d], c / u[d]) / ua * 180; b < 0;) b += 360;
                for (; b >= 360;) b -= 360;
                o[d] = b
            } else o[d] = o[d] / u[d];
        return s /= t, new ta(o, e).alpha(s > .99999 ? 1 : s, !0)
    }, hf.bezier = function(r) {
        var e = function(r) {
            var e, n, t, a, f, o, u;
            if (2 === (r = r.map((function(r) {
                    return new va(r)
                }))).length) e = r.map((function(r) {
                return r.lab()
            })), f = e[0], o = e[1], a = function(r) {
                var e = [0, 1, 2].map((function(e) {
                    return f[e] + r * (o[e] - f[e])
                }));
                return new va(e, "lab")
            };
            else if (3 === r.length) n = r.map((function(r) {
                return r.lab()
            })), f = n[0], o = n[1], u = n[2], a = function(r) {
                var e = [0, 1, 2].map((function(e) {
                    return (1 - r) * (1 - r) * f[e] + 2 * (1 - r) * r * o[e] + r * r * u[e]
                }));
                return new va(e, "lab")
            };
            else if (4 === r.length) {
                var c;
                t = r.map((function(r) {
                    return r.lab()
                })), f = t[0], o = t[1], u = t[2], c = t[3], a = function(r) {
                    var e = [0, 1, 2].map((function(e) {
                        return (1 - r) * (1 - r) * (1 - r) * f[e] + 3 * (1 - r) * (1 - r) * r * o[e] + 3 * (1 - r) * r * r * u[e] + r * r * r * c[e]
                    }));
                    return new va(e, "lab")
                }
            } else {
                if (!(r.length >= 5)) throw new RangeError("No point in running bezier with only one color.");
                var i, l, h;
                i = r.map((function(r) {
                    return r.lab()
                })), h = r.length - 1, l = function(r) {
                    for (var e = [1, 1], n = 1; n < r; n++) {
                        for (var t = [1], a = 1; a <= e.length; a++) t[a] = (e[a] || 0) + e[a - 1];
                        e = t
                    }
                    return e
                }(h), a = function(r) {
                    var e = 1 - r,
                        n = [0, 1, 2].map((function(n) {
                            return i.reduce((function(t, a, f) {
                                return t + l[f] * Math.pow(e, h - f) * Math.pow(r, f) * a[n]
                            }), 0)
                        }));
                    return new va(n, "lab")
                }
            }
            return a
        }(r);
        return e.scale = function() {
            return ma(e)
        }, e
    }, hf.blend = Na, hf.cubehelix = function(r, e, n, t, a) {
        void 0 === r && (r = 300), void 0 === e && (e = -1.5), void 0 === n && (n = 1), void 0 === t && (t = 1), void 0 === a && (a = [0, 1]);
        var f, o = 0;
        "array" === _a(a) ? f = a[1] - a[0] : (f = 0, a = [a, a]);
        var u = function(u) {
            var c = Aa * ((r + 120) / 360 + e * u),
                i = Ea(a[0] + f * u, t),
                l = (0 !== o ? n[0] + u * o : n) * i * (1 - i) / 2,
                h = Pa(c),
                s = Fa(c);
            return Oa(xa([255 * (i + l * (-.14861 * h + 1.78277 * s)), 255 * (i + l * (-.29227 * h - .90649 * s)), 255 * (i + l * (1.97294 * h)), 1]))
        };
        return u.start = function(e) {
            return null == e ? r : (r = e, u)
        }, u.rotations = function(r) {
            return null == r ? e : (e = r, u)
        }, u.gamma = function(r) {
            return null == r ? t : (t = r, u)
        }, u.hue = function(r) {
            return null == r ? n : ("array" === _a(n = r) ? 0 === (o = n[1] - n[0]) && (n = n[1]) : o = 0, u)
        }, u.lightness = function(r) {
            return null == r ? a : ("array" === _a(r) ? (a = r, f = r[1] - r[0]) : (a = [r, r], f = 0), u)
        }, u.scale = function() {
            return Oa.scale(u)
        }, u.hue(n), u
    }, hf.mix = hf.interpolate = Rt, hf.random = function() {
        for (var r = "#", e = 0; e < 6; e++) r += "0123456789abcdef".charAt(Ga(16 * Ra()));
        return new ja(r, "hex")
    }, hf.scale = pa, hf.analyze = Sa.analyze, hf.contrast = function(r, e) {
        r = new Ta(r), e = new Ta(e);
        var n = r.luminance(),
            t = e.luminance();
        return n > t ? (n + .05) / (t + .05) : (t + .05) / (n + .05)
    }, hf.deltaE = function(r, e, n, t, a) {
        void 0 === n && (n = 1), void 0 === t && (t = 1), void 0 === a && (a = 1);
        var f = function(r) {
                return 360 * r / (2 * Qa)
            },
            o = function(r) {
                return 2 * Qa * r / 360
            };
        r = new $a(r), e = new $a(e);
        var u = Array.from(r.lab()),
            c = u[0],
            i = u[1],
            l = u[2],
            h = Array.from(e.lab()),
            s = h[0],
            d = h[1],
            b = h[2],
            p = (c + s) / 2,
            g = (za(Xa(i, 2) + Xa(l, 2)) + za(Xa(d, 2) + Xa(b, 2))) / 2,
            v = .5 * (1 - za(Xa(g, 7) / (Xa(g, 7) + Xa(25, 7)))),
            m = i * (1 + v),
            y = d * (1 + v),
            k = za(Xa(m, 2) + Xa(l, 2)),
            w = za(Xa(y, 2) + Xa(b, 2)),
            M = (k + w) / 2,
            N = f(Wa(l, m)),
            _ = f(Wa(b, y)),
            x = N >= 0 ? N : N + 360,
            A = _ >= 0 ? _ : _ + 360,
            E = Ka(x - A) > 180 ? (x + A + 360) / 2 : (x + A) / 2,
            F = 1 - .17 * Za(o(E - 30)) + .24 * Za(o(2 * E)) + .32 * Za(o(3 * E + 6)) - .2 * Za(o(4 * E - 63)),
            P = A - x;
        P = Ka(P) <= 180 ? P : A <= x ? P + 360 : P - 360, P = 2 * za(k * w) * Ha(o(P) / 2);
        var O = s - c,
            j = w - k,
            G = 1 + .015 * Xa(p - 50, 2) / za(20 + Xa(p - 50, 2)),
            R = 1 + .045 * M,
            q = 1 + .015 * M * F,
            L = 30 * Ja(-Xa((E - 275) / 25, 2)),
            I = -(2 * za(Xa(M, 7) / (Xa(M, 7) + Xa(25, 7)))) * Ha(2 * o(L)),
            B = za(Xa(O / (n * G), 2) + Xa(j / (t * R), 2) + Xa(P / (a * q), 2) + I * (j / (t * R)) * (P / (a * q)));
        return Va(0, Ua(100, B))
    }, hf.distance = function(r, e, n) {
        void 0 === n && (n = "lab"), r = new rf(r), e = new rf(e);
        var t = r.get(n),
            a = e.get(n),
            f = 0;
        for (var o in t) {
            var u = (t[o] || 0) - (a[o] || 0);
            f += u * u
        }
        return Math.sqrt(f)
    }, hf.limits = Sa.limits, hf.valid = function() {
        for (var r = [], e = arguments.length; e--;) r[e] = arguments[e];
        try {
            return new(Function.prototype.bind.apply(ef, [null].concat(r))), !0
        } catch (r) {
            return !1
        }
    }, hf.scales = af, hf.colors = sn, hf.brewer = lf, hf
}));