$(function () {
    var COOKIE_LANG_NAME = "lang";

    var currentLang = getCookie(COOKIE_LANG_NAME);
    var options = $('.choose-lang');

    options.on('click', function (e) {
        var lng = $(e.target).data('locale');
        if (lng !== currentLang) {
            document.cookie = COOKIE_LANG_NAME + "=" + lng + ';path=/;';

            var newUrl = stripLangParamFromQueryString(window.location.toString());
            if (location.href === newUrl) {
                location.reload();
            } else {
                location.href = newUrl;
            }
        }
    });

    /**
     * Simple function that gets a cookie by name
     * @param cname
     * @returns {string}
     */
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    /**
     * Finds query param named lang and removes it, by generating a new URL.
     * @param url
     * @returns {*}
     */
    function stripLangParamFromQueryString(url) {
        var urlParts = url.split('?');

        if (!urlParts[1] || !urlParts[1].trim()) {
            return url;
        }

        var queryString = urlParts[1].replace(/lang=\w{2}/gi, "");

        return urlParts[0] + '?' + queryString;
    }

});

