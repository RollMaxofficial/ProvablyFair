var jsonData = [];


$(document).ready(function() {
    initialize();
});

function initialize() {
    getJsonData();
    formatSelect();
    getClientSeed();
    $('#verifyForm').submit(function(e) {
        e.preventDefault(); 
        getResult();
    });
}

function getJsonData() {
    $.ajax({
        url: 'js/data.json',
        dataType: 'json',
        async: false,
        success: function(data) {
            jsonData = data;
        },
        error: function(xhr, status, error) {
            console.error('Failed to load data.json: ', xhr.status);
        }
    });
}

function getClientSeed() {
    $.get("getSeed", function(data) {
        $("#clientSeed").val(data.clientSeed);
        $("#serverSeed").val(data.serverSeed);
        // $("#hash").val(data.hmac);
        $("#hashServerSeed").val(data.hashServerSeed);
    }).fail(function(xhr, status, error) {
        console.error(xhr.responseText);
    });
}

function getResult() {
    var formData = $("#verifyForm").serialize();
    var type = $("#type").val();
    $.get("provable?" + formData, function(data) {
        // $("#hash").val(data.hmac);
        $("#hashServerSeed").val(data.hashServerSeed);
        formatData(data.data, type);
    }).fail(function(xhr, status, error) {
        console.log(error);
    });
}

function formatSelect() {
    var select = $("#type");
    $.each(jsonData, function(index, item) {
        var option = $("<option>").val(index).text(item.name);
        select.append(option);
    });
}

function formatData(data, type) {
    var resultDiv = $("#results");
    switch (type) {
        case "7":
        case "9":
        case "10":
            resultDiv.html("<ol id='array-result'>" + data.map(item => "<li>" + item + "</li>").join("") + "</ol>");
            break;
        case "8":
            var minesType = $("#minesTypeInput").val();
            var selectedData = data.slice(0, minesType);
            var html = "<div class='mines-result'>";
            data.forEach(function(item, index) {
                html += "<div class='item " + (selectedData.includes(index + 1) ? "bg-red" : "") + "'></div>";
            });
            html += "</div>";
            resultDiv.html(html);
            break;
        case "11":
            var closNum = getClosNum();
            var html = "<div class='dargan-result dargan-result-clo-" + closNum + "'>";
            data.reverse().forEach(function(row) {
                var rowData = serializeArray(row, closNum);
                rowData.forEach(function(item) {
                    html += "<div class='item " + (item != 0 ? "bg-gray" : "") + "'></div>";
                });
            });
            html += "</div>";
            resultDiv.html(html);
            break;
        default:
            resultDiv.html("<ul id='number-result'><li>" + data + "</li></ul>");
    }
}

function getClosNum() {
    var shuffleType = $("#shuffleTypeInput").val();
    var closNum = 4;
    if (shuffleType % 2 == 0) {
        closNum = 3;
    } else if (shuffleType == 3) {
        closNum = 2;
    }
    return closNum;
}

function serializeArray(array, length) {
    var result = [];
    array.sort((a, b) => a - b);
    for (var i = 1; i <= length; i++) {
        result.push(array.includes(i) ? i : 0);
    }
    return result;
}

function increment() {
    updateNonceValue(1);
}

function decrement() {
    updateNonceValue(-1);
}

function updateNonceValue(delta) {
    var nonceInput = $("#nonce");
    var currentValue = parseInt(nonceInput.val());
    if (currentValue + delta >= 1 && currentValue + delta <= 9) {
        nonceInput.val(currentValue + delta);
    }
}

function changeType(index) {
    var currentData = jsonData[index];
    $("#min").val(currentData.min);
    $("#max").val(currentData.max);
    if (index == 6) {
        $("#min, #max").removeAttr("disabled");
    } else {
        $("#min, #max").attr("disabled", "disabled");
    }
    $("#shuffleType").toggle(index == 11);
    $("#minesType").toggle(index == 8);
    $('#firstRow').children().toggleClass("mb-3 col-lg-3", index == 11 || index == 8);
    $('#firstRow').children().toggleClass("mb-3 col-lg-4", index != 11 && index != 8);
}

function changeShuffleType(type) {
    var max = 4;
    switch (type) {
        case "3":
            max = 2;
            break;
        case "2":
        case "4":
            max = 3;
            break;
    }
    $("#max").val(max);

}

function toggleDesc() {
    $('.provable-desc').toggle();
}