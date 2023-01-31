<script>
    function CallAjax(url, requestMethod, requestData, successhandler, errorhandler = null) {
        $.ajax({
            url: url,
            global: false,
            type: requestMethod,
            data: requestData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // ShowInfoAlert("Requesting");
            },
            success: function(response) {
                successhandler(response);
            },
            error: function(xhr) {
                errorhandler();
            }
        });

    }


    function CallAjax_withoutdata(url, requestMethod, successhandler, errorhandler = null) {
        $.ajax({
            url: url,
            global: false,
            type: requestMethod,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // ShowInfoAlert("Requesting");
            },
            success: function(response) {
                successhandler(response);
            },
            error: function(xhr) {
                errorhandler();
            }
        });

    }
</script>
