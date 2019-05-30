jQuery(function() {
    document.formvalidator.setHandler('numfracpos',
        function (value) {
            regex=/^(0|[1-9]\d*)(\.\d+)?$/;
            return regex.test(value);
    });
    document.formvalidator.setHandler('numdecpos',
        function (value) {
            regex=/^\d+$/;
            return regex.test(value);
    });
});

