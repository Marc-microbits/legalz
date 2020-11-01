// Validation

$('#add_appointment').validate({
        debug: false,
        //ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                    mobile: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    number: true
                },
                     date:"required",
                     time:"required",
                     new_client:"required",
                     exists_client:"required",
                },
        messages: {
           mobile: {
                        required: "Please enter mobile.",
                        minlength: "Mobile must be at least 6 digits.",
                        maxlength: "Mobile must be max 20 digits.",
                        number: "please enter digit 0-9.",
                    },
                     date: "Please select date.",
                     time: "Please enter time.",
                     new_client: "Please enter client name.",
                     exists_client: "Please select client name."
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent()).addClass('text-danger');
        },
        submitHandler: function (e) {
          $('#show_loader').removeClass('fa-save');
               $('#show_loader').addClass('fa-spin fa-spinner');
               $("button[name='btn_add_appointment']").attr("disabled", "disabled").button('refresh');
            return true;
        }
    })



