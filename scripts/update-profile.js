// enable name editing
$("#editBtn").click(function() {
    $(this).hide();
    $("#editBtn, #nameTitle, #emailDisplay, #passDisplay, #phoneDisplay, #statusDisplay").hide();
    $('#nameEditTitle, #newFName, #newLName, #emailEditDisplay, #newPassword, #newPassRepeat,' +
        '#phoneEditDisplay, #statusRadioDisplay, #cancel, #save').show();
});

// cancel all edit actions
$("#cancel").click(function() {
    $(this).hide();
    $("#editBtn, #nameTitle, #emailDisplay, #passDisplay, #phoneDisplay, #statusDisplay").show();
    $('#nameEditTitle, #newFName, #newLName, #emailEditDisplay, #newPassword, #newPassRepeat,' +
        '#phoneEditDisplay, #statusRadioDisplay, #cancel, #save').hide();
});