$('#type').on('change', function () {
    let type = $('input[name="type"]:checked').val();
    if (type === 'house') {
        rentbuy();
    }
    if (type === 'apartment' || type === 'condo') {
        floor();
    } else {
        alert('Please choose a given property type');
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