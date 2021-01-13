$(function () {
    $("#selectMonth").on("change", function () {
        let selectMonth = $(this).val();
        console.log("selectMonth");
        $.ajax({
            url: "ConditionController.php",
            type: "POST",
            dataType: "json",
            data: {
                selectMonth: selectMonth,
            },
        }).fail(function (XMLHttpRequest, textStatus, error) {
            alert("エラーが発生しました");
        });
    });
});
