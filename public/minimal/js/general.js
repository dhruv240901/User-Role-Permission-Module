$("#signupform").validate({
    rules: {
        firstname: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 6,
        },
        confirmpassword:{
            required:true,
            minlength: 6,
            equalTo: "#password"
        }
    },
    messages: {
        firstname: "Please enter your firstname",
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        password: {
            required: "Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
        },
        confirmpassword: {
            required: "Please enter confirm password",
            minlength:"Please enter password greater than or equal to 6 characters",
            equalTo:"Please enter the same password as above"
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#loginform").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 6,
        },
    },
    messages: {
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        password: {
            required: "Please enter password",
            minlength: "Please enter password greater than or equal to 6 characters",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});
