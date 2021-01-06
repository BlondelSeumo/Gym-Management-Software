
// Validate Booking Form
$("#DemoForm").validate({
    rules: {
        full_name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            minlength: 4
        }
        ,
        mobile: {
            required: true,
            digits: true
        },
        designation: {
            required: true
        },
        company: {
            required: true
        },
        industry: {
            required: true
        }
    },
    messages: {
        full_name: {
            required: "Please Enter Name",
            minlength: "Name must consist of at least 3 characters"
        },
        email: {
            required: "Please provide a Email",
            minlength: "Email must be at least 4 characters long"
        },
        mobile: {
            required: "Please provide Mobile Number",
            digits: "Please enter only digits"
        },
        designation: {
            required: "Please Enter Designation"
        },
        company: {
            required: "Please Enter Company Name"
        },
        industry: {
            required: "Please Select Industry Type"
        }
    },

    submitHandler: function(form) {
        //Send Booking Mail AJAX
        var formdata = jQuery("#DemoForm").serialize();
        jQuery.ajax({
            type:"POST",
            url:"contact_form/demo_request.php",
            data:formdata,
            dataType:'json',
            async: false,
            success:function(data){
                if(data.success){
                    alert('Thank You, Your Demo is Registered');
                }else{
                    alert('Error on Sending Request, Please Try Again');
                }

            },
            error:function(error){
                alert('Something Went Wrong');
            }

        });
    }
});

// Validate Contact Form
$("#ContactForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            minlength: 4
        }
        ,
        mobile: {
            required: true,
            digits: true
        },
        subject: {
            required: true
        },
        message: {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please Enter Name",
            minlength: "Name must consist of at least 3 characters"
        },
        email: {
            required: "Please provide a Email",
            minlength: "Email must be at least 4 characters long"
        },
        mobile: {
            required: "Please provide Mobile Number",
            digits: "Please enter only digits"
        },
        subject: {
            required: "Please Enter Subject"
        },
        message: {
            required: "Please Enter Message"
        }
    },

    submitHandler: function(form) {
        //Send Booking Mail AJAX
        var formdata = jQuery("#ContactForm").serialize();
        jQuery.ajax({
            type:"POST",
            url: contactSubmitUrl,
            data:formdata,
            dataType:'json',
            async: false,
            success:function(data){
                $('#form-response').html(data.message);
                if(data.success){
                    $('#ContactForm')[0].remove();
                }
            },
            error:function(error){
                alert('Something Went Wrong');
            }

        });
    }
});


