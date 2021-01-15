try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("bootstrap");
} catch (e) {}

$(function () {
    $("#selectMonth").on("change", function () {
        let selectMonth = $(this).val();
        console.log("selectMonth");
        $.ajax({
            url: "/{id}/index/" + selectMonth,
            type: "GET",
            dataType: "json",
            data: {
                selectMonth: selectMonth,
            },
        })
            .done(function (data) {
                console.log("OK");
                console.log(data);
            })
            .fail(function (XMLHttpRequest, textStatus, error) {
                alert("エラーが発生しました");
            });
    });
});
