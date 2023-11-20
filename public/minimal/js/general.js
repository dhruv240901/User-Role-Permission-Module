$("#signupform").validate({
    rules: {
        firstName: {
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
        confirmPassword:{
            required:true,
            minlength: 6,
            equalTo: "#password"
        }
    },
    messages: {
        firstName: "Please enter your firstname",
        email: {
            required: "Please enter your email",
            email: "Please enter valid email",
        },
        password: {
            required: "Please enter password",
            minlength:"Please enter password greater than or equal to 6 characters",
        },
        confirmPassword: {
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
        oldPassword:{
            required: true,
            minlength: 6,
        },
        newPassword: {
            required: true,
            minlength: 6,
        },
        confirmPassword: {
            required: true,
            minlength: 6,
            equalTo: "#newPassword"
        },
    },
    messages: {
        oldPassword: {
            required: "Please enter your password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        newPassword: {
            required: "Please enter your new password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        confirmPassword: {
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
        newPassword: {
            required: true,
            minlength: 6,
        },
        confirmPassword: {
            required: true,
            minlength: 6,
            equalTo: "#newPassword"
        },
    },
    messages: {
        newPassword: {
            required: "Please enter your new password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        confirmPassword: {
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
        firstName: {
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
        firstName: {
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
        roleName: {
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
        roleName: {
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
        permissionName: {
            required: true,
        },
        description:{
            required: true,
        },
    },
    messages: {
        permissionName: {
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
        moduleCode: {
            required: true,
        },
        moduleName:{
            required: true,
        },
    },
    messages: {
        moduleCode: {
            required: "Please enter module code",
        },
        moduleName:{
            required:"Please enter module name",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#resetpasswordform").validate({
    rules: {
        newPassword: {
            required: true,
            minlength: 6,
        },
        confirmPassword: {
            required: true,
            minlength: 6,
            equalTo: "#newPassword"
        },
    },
    messages: {
        newPassword: {
            required: "Please enter your new password",
            minlength: "Please enter password greater than or equals to 6 character",
        },
        confirmPassword: {
            required: "Please enter confirm password",
            minlength: "Please enter password greater than or equal to 6 characters",
            equalTo:"Please enter the same password as above"
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#forgetpasswordform").validate({
    rules: {
        email: {
            required: true,
            email:true
        },
    },
    messages: {
        email: {
            required: "Please enter email",
            email: "Please enter valid email",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});
