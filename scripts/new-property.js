$('#type').on('change', function () {
    let type = $('input[name="type"]:checked').val();
    if (type === 'house') {
        rentbuy();
    } else if (type === 'apartment' || type === 'condo') {
        floor();
    } else {
        $('#typeErr').html("Please choose a valid property type");
    }
});

function rentbuy() {
    $('#rentDiv').show();
    $('#floorDiv').hide();
}

function floor() {
    $('#floorDiv').show();
    $('#rentDiv').hide();
}