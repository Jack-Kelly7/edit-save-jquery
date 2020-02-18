$(document).ready(function() {
    loadForm();
});

function loadForm() {
    $.ajax({
        url: `objects/form_handler.php`,
        type: 'post',
        data: {y: 'load'},
        success: function(pre_result) {
            let result = $.parseJSON(pre_result);
            $('#formText').html(`${result[0].Text}`)
        },
        error: function(e) {
            alert(e);
        },
    })
}

function editForm() {
    $('#edit-btn').replaceWith(`<button type="submit" class="float-right" id="save-btn"></button>`);
    $('#formText').attr("contenteditable", true);
}

$(document).ready(function() {
    $("#mainForm").on("submit", function() { 
        let text = $("#formText").text();
        $.ajax({
            url: `objects/form_handler.php`,
            type: 'post',
            data: {y: 'save', text: text},
            success: function(pre_result) {
                let result = $.parseJSON(pre_result);
                alert(result.message);
            },
            error: function(pre_result) {
                let result = $.parseJSON(pre_result);
                alert(result.message);
            },
        })
    })
    $('#formText').attr("contenteditable", false);
    $('#save-btn').replaceWith(`<button type="button" id="edit-btn" onclick="editForm()"></button>`);
});