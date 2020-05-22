var pathToRoot = "../../";

/// |----------------------------------------- when ever page loaded -----------------------------------
$(function() {

    /// ------------------------------------- Generate datatable --------------------------------------
    $("table.datatable").DataTable({
        "ordering": false
    });
    /// ------------------------------------- Generate datatable --------------------------------------

});
/// |----------------------------------------- when ever page loaded -----------------------------------






/// |----------------------------------------- Logout from Apps -----------------------------------
function LogOutApps(urlLogout) {
    sweetConfirm(
        "Perhatian",
        "Anda yakin akan logout dari aplikasi?",
        function() {
            document.location.href = urlLogout;
        }
    );
}
/// |----------------------------------------- Logout from Apps -----------------------------------







/// -------------------------------- show confirm dialog with sweet alert ------------------------------
function sweetConfirm(title, text, yesCallBack=null, noCallBack=null) {
    Swal.fire({
        title: title,
        html: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
        yesCallBack();
        } else {
        noCallBack();
        }
    });
}
/// -------------------------------- show confirm dialog with sweet alert ------------------------------







/// -------------------------------- show alert dialog with sweet alert ------------------------------
function sweetAlert(title, text) {
    Swal.fire({
        title: title,
        html: text,
        icon: 'info',
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false
    });
}
/// -------------------------------- show alert dialog with sweet alert ------------------------------







/// -------------------------------- validate form with jquery validation ------------------------------

/// | Main function to validate form
function formJqValidation(formElement, rules, messages, sbmtHandler) {
    $(formElement).validate({
        rules: rules,
        messages : messages,
        errorElement : "em",
        errorClass : "invalid-feedback",
        errorPlacement : function ( error, element ) {
        // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight : function ( element, errorClass, validClass ) {
            //$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight : function (element, errorClass, validClass) {
            //$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        submitHandler : function(form) {
            sbmtHandler(form);
        }
    });
}

/// | Add validate method to handle unique username while registerin user
$.validator.addMethod("uniqueUserName", function(value, element) {
    var dataReturn = true;
    $.ajax({
        async       : false,
        headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type        : "post",
        url         : pathToRoot + "ValidatorMethod/UniqueUserName",
        data        : {username:value},
        dataType    :"text",
        success     : function(r) {
        //alert(parseInt(r));
        if(parseInt(r) > 0)
            dataReturn = false;  // already exists
        
        //return true;   // username is free to use
        else
            dataReturn = true;
        }
    });

    return dataReturn;
}, "Username is Already Taken");
/// -------------------------------- validate form with jquery validation ------------------------------







/// -------------------------------- DHTMLX Calendar show datepicker ------------------------------
var txtDatepicker = document.getElementsByClassName("datepicker");
for(var i=0; i<txtDatepicker.length; i++) {
    var dateInput = txtDatepicker[i];
    dateInput.addEventListener("click", function() {
        popup.show(dateInput);
    });
    var calendar = new dhx.Calendar(null, {dateFormat: "%Y-%m-%d"});
    var popup = new dhx.Popup();
    popup.attach(calendar);
    calendar.events.on("change", function() {
        dateInput.value = calendar.getValue();
        popup.hide();
    });
    $(dateInput).addClass("text-center");
    $(dateInput).attr("readonly", "readonly");
}
/// -------------------------------- DHTMLX Calendar show datepicker ------------------------------







/// ------------------- Change textbox with .accounting format to number format -------------------
$(".accounting").each(function() {
    $(this).focus(function() {
        var formatted = $(this).val();
        var number = accounting.unformat(formatted);
        $(this).val(number);
    });
    
    $(this).focusout(function() {
        var number = $(this).val();
        var formatted = accounting.format(number, 2);
        $(this).val(formatted);
    });
});
/// ------------------- Change textbox with .accounting format to number format -------------------