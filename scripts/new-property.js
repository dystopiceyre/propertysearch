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

/*
* If the property is of the house type, shows the rent div
* and hides the floor div
*/
function rentbuy() {
    $('#rentDiv').show();
    $('#floorDiv').hide();
}

/*
* If the property is of the condo or apartment type,
* hides the rent div and shows the floor div
*/
function floor() {
    $('#floorDiv').show();
    $('#rentDiv').hide();
}