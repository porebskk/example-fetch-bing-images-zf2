(function(){
    $(document).ready(function(){
        $('#doSearchBtn').click(function(){
            $(this).closest('form').submit();
        });
    });
})();