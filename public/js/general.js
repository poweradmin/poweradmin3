$(document).ready(function(){

    $.ajaxSetup({
        cache: false
    });

    $('.xconfirm').click(function(){
        if(!confirm('Really delete the user?')) {
            return false;
        }
    });

});
