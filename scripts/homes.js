/*
* jQuery input slider for the user to define a price range
* to search for properties in
*/
$(function () {
    $("#price-range").slider({
        range: true,
        step: 500,
        min: 500,
        max: 50000000,
        values: [500, 200000],
        slide: function (event, ui) {
            $("#price").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#price").val("$" + $("#price-range").slider("values", 0) +
        " - $" + $("#price-range").slider("values", 1));
});

/*
* jQuery input slider for the user to define the number
*  of bedrooms to search for properties in
*/
$(function () {
    $("#bed-range").slider({
        range: true,
        step: 1,
        min: 1,
        max: 10,
        values: [1, 3],
        slide: function (event, ui) {
            $("#beds").val(ui.values[0] + " - " + ui.values[1]);
        }
    });
    $("#beds").val($("#bed-range").slider("values", 0) + " - " +
        $("#bed-range").slider("values", 1));
});

/*
* jQuery input slider for the user to define the number
*  of bathrooms to search for properties in
*/
$(function () {
    $("#bath-range").slider({
        range: true,
        step: 0.5,
        min: 1,
        max: 10,
        values: [1, 2.5],
        slide: function (event, ui) {
            $("#baths").val(ui.values[0] + " - " + ui.values[1]);
        }
    });
    $("#baths").val($("#bath-range").slider("values", 0) + " - " +
        $("#bath-range").slider("values", 1));
});