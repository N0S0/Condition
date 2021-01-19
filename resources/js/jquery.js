try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("bootstrap");
} catch (e) {}

$(function () {
    $("#selectMonth").on("change", function () {
        let selectMonth = $(this).val();
        let params = $("#month-form").serialize();

        $.ajax({
            url: "'/{id}/index/{selectMonth}",
            type: "GET",
            dataType: "json",
            data: params,
        })
            .done(function (data) {
                $("#condition-tbody").empty();
                const date = date[0].date.substr(0, 7);
                $("#listMonth").text(date + "の体温・体調一覧");
                for (i = 0; i < data.length; i++) {
                    let td1 = $("<td>");
                    const date = data[i].date.replace("00:00:00", "");
                    td1.text(date);

                    let td2 = $("<td>");

                    if (data[i].taion) {
                        td2.text(data[i].taion);
                    }
                    let td3 = $("<td>");
                    let text = "";
                    if (data[i].condition.indexOf("1")) {
                        text += "味覚異常";
                    }
                    if (data[i].condition.indexOf("2")) {
                        text += "/嗅覚異常";
                    }
                    if (data[i].condition.indexOf("3")) {
                        text += "/咳";
                    }
                    if (data[i].condition.indexOf("4")) {
                        text += "/倦怠感";
                    }
                    td3.text(text);
                    let td4 = $("<td>");

                    if (data[i].comment) {
                        td4.text(data[i].comment);
                    }
                    let text2 = "";
                    let td5 = $("<td>");

                    if (data[i].condition.indexOf("5")) {
                        text2 = "生理中";
                    }
                    td5.text(text2);

                    let td6 = $("<td>");
                    td6.text("編集");
                    let td7 = $("<td>");
                    td7.text("削除");

                    let tr = $("<tr>");
                    tr.appent(td1);
                    tr.appent(td2);
                    tr.appent(td3);
                    tr.appent(td4);
                    tr.appent(td5);
                    tr.appent(td6);
                    tr.appent(td7);
                    $("#condition-tbody").append(tr);
                }
            })
            .fail(function (XMLHttpRequest, textStatus, error) {
                alert("エラーが発生しました");
            });
    });
});
