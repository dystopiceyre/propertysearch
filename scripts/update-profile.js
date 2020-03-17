/**
 * Hides the display fields and edit button,
 * shows the editing input fields and buttons to
 * cancel, delete profile, and save
 */
$("#editBtn").click(function() {
    $(this).hide();
    $("#editBtn, #nameTitle, #emailDisplay, #passDisplay, #phoneDisplay, #statusDisplay").hide();
    $('#nameEditTitle, #newFName, #newLName, #emailEditDisplay, #newPassword, #newPassRepeat,' +
        '#phoneEditDisplay, #statusRadioDisplay, #cancel, #save, #delete').show();
});

/**
 * Shows the display fields and edit button,
 * hides the editing input fields and buttons to
 * cancel, delete profile, and save
 */
$("#cancel").click(function() {
    $(this).hide();
    $("#editBtn, #nameTitle, #emailDisplay, #passDisplay, #phoneDisplay, #statusDisplay").show();
    $('#nameEditTitle, #newFName, #newLName, #emailEditDisplay, #newPassword, #newPassRepeat,' +
        '#phoneEditDisplay, #statusRadioDisplay, #cancel, #save, #delete').hide();
});