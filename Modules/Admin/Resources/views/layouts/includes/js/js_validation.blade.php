{{-- Form Validation --}}
<script>
    if(typeof validation_id !== 'undefined' || typeof rules !== 'undefined' || typeof messages !== 'undefined'){
        $(document).ready(function() {
            $(validation_id).validate({
                rules: rules,
                messages: messages,
                errorElement: "em",

                errorPlacement: function(error, element) {
                    error.addClass("invalid-demandletter");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    }else if(element.prop("type") === "select-multiple" || element.attr('class').indexOf("select2") >= 0){
                        error.insertAfter(element.next(".select2-container"));
                    }else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.input-group').addClass("is-invalid").removeClass("is-valid");
                    $(element).closest('.input-group').addClass("focused");
                    $(element).closest('.input-group').addClass("is-focused");
                    $('button[type="submit"]').removeAttr('disabled');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.input-group').addClass("is-valid").removeClass("is-invalid")
                }

            });
        });
    }
</script>
