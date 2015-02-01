$(function() {
    $('.dataTable').DataTable({
        paging: true,
        //scrollY: 400,
        "iDisplayLength": 10,
        "sPaginationType": "full_numbers",
        //"sDom": 'r<"search">tlp',
        "bProcessing": true,
        "aaSorting": [[0, 'asc']],
        "bSortClasses": false,
        //"sPaginationType" : "",
    });

});
function redirectDelay(url, timer) {
    setTimeout(function() {
        window.location.href = url; //will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function print_properties_in_object(object) {
    var output = '';
    for (var property in object) {
        output += property + ': ' + object[property] + '; ';
    }
    return output;
}
function reloadDelay(timer) {
    setTimeout(function() {
        window.location.reload();//will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function goUrl(url) {
    window.location.href = url; //will redirect to your blog page (an ex: blog.html)
}
// validate engine url : https://github.com/posabsolute/jQuery-Validation-Engine/blob/master/demos/demoValidators.html
function PostJson(formid, url) {
    $.ajax({
        url: url,
        data: $('#' + formid).serialize(),
        type: 'post',
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
            if (data.status == 'success') {
                uk_notify(data.msg, 'success', 3);
                redirectDelay(data.url, 2);
            } else {
                uk_notify(data.msg, 'error', 3);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR : ' + jqXHR + ' \n textStatus : ' + textStatus + ' \n errorThrown : ' + errorThrown);
        }
    });
}

function deleteItem(id, url) {
    if (confirm('ยืนยันการลบข้อมูล รหัส [ ' + id + ' ]  ใช่ [OK], ไม่ใช่ [Cancel] ')) {
        $.ajax({
            url: url,
            data: {
                id: id,
            },
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if (data.status == 'success') {
                    uk_notify(data.msg, 'success', 3);
                    reloadDelay(1);
                } else {
                    uk_notify(data.msg, 'error', 3);
                }
            }
        });
        return true;
    }
    return false;
}
function uk_notify(msg, type, delay) {
    var message = "";
    if (type == 'info') {
        message = "<i class='uk-icon-info'></i>";
    } else if (type == 'success') {
        message = "<i class='uk-icon-check'></i>";
    } else if (type == 'warning') {
        message = "<i class='uk-icon-warning'></i>";
    } else if (type == 'danger') {
        message = "<i class='uk-icon-remove '></i>";
    } else {
        message = msg;
    }
    message = message + " " + msg;
    var options = {
        //message: message,
        status: type, // status:'info',success,warning,danger
        timeout: (delay * 1000),
        pos: 'top-right' //top-left,top-right,bottom-center,bottom-left,bottom-right
    }
    $.UIkit.notify(message, options);
}

function appendDropdownProductType(code) {
    $.ajax({
        url: '../database/db_type.php?method=get_list_type_all',
        data: {},
        type: 'post',
        dataType: 'json',
        success: function(data) {
            var dropdownParent = $('#pro_type' + code);
            $.each(data, function(index, object) {
                var option = ' <option value="' + object.type_id + '">';
                option += object.type_name;
                option += '</option>';
                dropdownParent.append(option);
            });
        }
    })
}
function validateInteger(element) {
    var value = $(element).val();
    if (!typeof value === "number" || !parseInt(value)) {
        uk_notify('กรุณากรอก จำนวน เป็นตัวเลขเท่านั้น', 'error', 3);
        $(element).val("");
    }
}
function isInt(element) {
    var value = $(element).val();
    if (isNaN(value)) {
        uk_notify('กรุณากรอกตัวเลขเท่านั้น ครับ', 'danger', 3);
        $(element).focus();
        $(element).val('');
        return false;
    } else {
        return true;
    }
}
function getFormData(formId) {
    var unindexed_array = $('#' + formId).serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

