$(document).ready(function () {

    //Scroll to down to form
    $("#scroll-btn").click(function () {
        $('html,body').animate({
                scrollTop: $("#hero-body-4").offset().top
            },
            'slow');
        $("#name").focus();
    });

    $(".modal-btn").click(function () {
        $('html,body').animate({
                scrollTop: $("#hero-body-4").offset().top
            },
            'slow');
        $("#name").focus();
        dismissModal();

    });

    //Postcode verification
    $("#postcode-btn").click(function () {
        var postcode = $("#postcode").val();
        if (postcode === "") {
            alert('You need to fill in the postcode first');
            $("#postcode").focus();
        } else {
            $("#postcode").val('');
            $.ajax({
                url: '/control/json-decoder.php',
                type: 'POST',
                data: {'postcode': postcode},
                success: function (returnedData) {
                    if (returnedData != "") {
                        $("#success-modal").addClass('is-active');
                        $("#html").addClass('is-clipped');
                        $("#returnedData").html(returnedData);
                    } else {
                        $("#error-modal").addClass('is-active');
                    }
                }
            })
        }
    });

    //Try again button
    $("#try-again-btn").click(function () {
        $("#error-modal").removeClass("is-active");
        $("#html").removeClass('is-clipped');
        $("#postcode").focus();
    });

    //Close modal button
    $(".modal-close").click(function () {
        dismissModal();
    });

    $(".modal-background").click(function () {
        dismissModal();
    });

    //Email
    $("#email-btn").click(function () {
        var name,
            email,
            phone,
            checkbox;

        name = $("#name").val();
        email = $("#email").val();
        phone = $("#phone").val();
        if ($("#checkbox").is(":checked"))
            checkbox = "Checked";
        else
            checkbox = "Not checked";

        if (name === "" || email === "" || phone === "") {
            alert("Please fill in all the fields");
            $("#name").focus();
        }else{
            $.ajax({
                url:"/control/mail.php",
                type: 'POST',
                data: {'name':name, 'email':email, 'phone':phone, 'checkbox':checkbox},
                success: alert('Email sent with success!')
            })
        }
    });

});

function dismissModal(){
    $("#success-modal").removeClass('is-active');
    $("#error-modal").removeClass('is-active');
    $("#html").removeClass('is-clipped');
}