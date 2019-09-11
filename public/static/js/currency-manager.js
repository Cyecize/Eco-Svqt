$(function () {
    var COOKIE_CURRENCY_NAME = "currency";

    var currentCurrency = getCookie(COOKIE_CURRENCY_NAME);
    var options = $('.choose-currency');

    options.on('click', function (e) {
        var selectedValue = $(e.target).data('currency');

        if (selectedValue !== currentCurrency) {
            document.cookie = COOKIE_CURRENCY_NAME + "=" + selectedValue + ';path=/;';
            location.reload();
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
});

