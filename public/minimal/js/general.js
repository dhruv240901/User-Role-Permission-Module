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

$("#userchangepassword").validate({
    rules: {
        oldpassword:{
            required: true,
            minlength: 6,
        },
        newpassword: {
            required: true,
            minlength: 6,
        },
        confirmpassword: {
            required: true,
            minlength: 6,
            equalTo: "#newpassword"
        },
    },
    messages: {
        oldpassword: {
            required: "Please enter your password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        newpassword: {
            required: "Please enter your new password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        confirmpassword: {
            required: "Please enter password",
            minlength: "Please enter password greater than or equal to 6 characters",
            equalTo:"Please enter the same password as above"
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#changepasswordform").validate({
    rules: {
        newpassword: {
            required: true,
            minlength: 6,
        },
        confirmpassword: {
            required: true,
            minlength: 6,
            equalTo: "#newpassword"
        },
    },
    messages: {
        newpassword: {
            required: "Please enter your new password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        confirmpassword: {
            required: "Please enter password",
            minlength: "Please enter password greater than or equal to 6 characters",
            equalTo:"Please enter the same password as above"
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

 $("#userform").validate({
    rules: {
        firstname: {
            required: true,
        },
        email:{
            required: true,
            email:true
        },
        roles:{
            required:true
        }
    },
    messages: {
        firstname: {
            required: "Please enter firstname",
        },
        email:{
            required:"Please enter email",
            email:"Please enter valid email"
        },
        roles: {
            required: "Please select at least one role",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#roleform").validate({
    rules: {
        rolename: {
            required: true,
        },
        description:{
            required: true,
        },
        permissions:{
            required:true
        }
    },
    messages: {
        rolename: {
            required: "Please enter role name",
        },
        description:{
            required:"Please enter description",
        },
        permissions: {
            required: "Please select at least one role",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#permissionform").validate({
    rules: {
        permissionname: {
            required: true,
        },
        description:{
            required: true,
        },
    },
    messages: {
        permissionname: {
            required: "Please enter permission name",
        },
        description:{
            required:"Please enter description",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#moduleform").validate({
    rules: {
        modulecode: {
            required: true,
        },
        modulename:{
            required: true,
        },
    },
    messages: {
        modulecode: {
            required: "Please enter module code",
        },
        modulename:{
            required:"Please enter module name",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});
