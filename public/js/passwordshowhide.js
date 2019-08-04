
$('.toggle-password').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('glyphicon-eye-close');
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});