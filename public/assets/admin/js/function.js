var images = [];
var imagetaghtml = [];
var data1 = new FormData();
var imageserver = [];

var desc = "";
var content = "";

function confirmDialog(
    action,
    text,
    value,
    title = "Thông báo",
    icon = "fas fa-exclamation-triangle",
    type = "blue"
) {
    $.confirm({
        title: title,
        icon: icon, // font awesome
        type: type, // red, green, orange, blue, purple, dark
        content: text, // html, text
        backgroundDismiss: true,
        animationSpeed: 600,
        animation: "zoom",
        closeAnimation: "scale",
        typeAnimated: true,
        animateFromElement: false,
        autoClose: "cancel|3000",
        escapeKey: "cancel",
        buttons: {
            success: {
                text: '<i class="fas fa-check align-middle mr-2"></i>Đồng ý',
                btnClass: "btn-blue btn-sm bg-gradient-primary",
                action: function () {
                    if (action == "delete-item") deleteItem(value);
                },
            },
            cancel: {
                text: '<i class="fas fa-times align-middle mr-2"></i>Hủy',
                btnClass: "btn-red btn-sm bg-gradient-danger",
            },
        },
    });
}

function formatMoney(price, unit = "đ") {
    if (price != 0) {
        var new_price = new Intl.NumberFormat("vi-VI", {
            maximumSignificantDigits: 3,
        }).format(price);
        return new_price + unit;
    }
    return price;
}

function holdonOpen(
    theme = "custom",
    text = "Đợi 1 xíu nhé :3",
    content = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;display:block;" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g>  <animateTransform attributeName="transform" type="rotate" values="360 50 50;0 50 50" keyTimes="0;1" dur="2s" repeatCount="indefinite" calcMode="spline" keySplines="0.5 0 0.5 1" begin="-0.2s"></animateTransform>  <circle cx="50" cy="50" r="39.891" stroke="#6994b7" stroke-width="14.4" fill="none" stroke-dasharray="0 300">    <animate attributeName="stroke-dasharray" values="15 300;55.1413599195142 300;15 300" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" calcMode="linear" keySplines="0 0.4 0.6 1;0.4 0 1 0.6" begin="-0.092s"></animate>  </circle>  <circle cx="50" cy="50" r="39.891" stroke="#eeeeee" stroke-width="7.2" fill="none" stroke-dasharray="0 300">    <animate attributeName="stroke-dasharray" values="15 300;55.1413599195142 300;15 300" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" calcMode="linear" keySplines="0 0.4 0.6 1;0.4 0 1 0.6" begin="-0.092s"></animate>  </circle>  <circle cx="50" cy="50" r="32.771" stroke="#000000" stroke-width="1" fill="none" stroke-dasharray="0 300">    <animate attributeName="stroke-dasharray" values="15 300;45.299378454348094 300;15 300" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" calcMode="linear" keySplines="0 0.4 0.6 1;0.4 0 1 0.6" begin="-0.092s"></animate>  </circle>  <circle cx="50" cy="50" r="47.171" stroke="#000000" stroke-width="1" fill="none" stroke-dasharray="0 300">    <animate attributeName="stroke-dasharray" values="15 300;66.03388996804073 300;15 300" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" calcMode="linear" keySplines="0 0.4 0.6 1;0.4 0 1 0.6" begin="-0.092s"></animate>  </circle></g><g>  <animateTransform attributeName="transform" type="rotate" values="360 50 50;0 50 50" keyTimes="0;1" dur="2s" repeatCount="indefinite" calcMode="spline" keySplines="0.5 0 0.5 1"></animateTransform>  <path fill="#6994b7" stroke="#000000" d="M97.2,50.1c0,6.1-1.2,12.2-3.5,17.9l-13.3-5.4c1.6-3.9,2.4-8.2,2.4-12.4"></path>  <path fill="#eeeeee" d="M93.5,49.9c0,1.2,0,2.7-0.1,3.9l-0.4,3.6c-0.4,2-2.3,3.3-4.1,2.8l-0.2-0.1c-1.8-0.5-3.1-2.3-2.7-3.9l0.4-3 c0.1-1,0.1-2.3,0.1-3.3"></path>  <path fill="#6994b7" stroke="#000000" d="M85.4,62.7c-0.2,0.7-0.5,1.4-0.8,2.1c-0.3,0.7-0.6,1.4-0.9,2c-0.6,1.1-2,1.4-3.2,0.8c-1.1-0.7-1.7-2-1.2-2.9 c0.3-0.6,0.5-1.2,0.8-1.8c0.2-0.6,0.6-1.2,0.7-1.8"></path>  <path fill="#6994b7" stroke="#000000" d="M94.5,65.8c-0.3,0.9-0.7,1.7-1,2.6c-0.4,0.9-0.7,1.7-1.1,2.5c-0.7,1.4-2.3,1.9-3.4,1.3h0 c-1.1-0.7-1.5-2.2-0.9-3.4c0.4-0.8,0.7-1.5,1-2.3c0.3-0.8,0.7-1.5,0.9-2.3"></path></g><g>  <animateTransform attributeName="transform" type="rotate" values="360 50 50;0 50 50" keyTimes="0;1" dur="2s" repeatCount="indefinite" calcMode="spline" keySplines="0.5 0 0.5 1" begin="-0.2s"></animateTransform>  <path fill="#eeeeee" stroke="#000000" d="M86.9,35.3l-6,2.4c-0.4-1.2-1.1-2.4-1.7-3.5c-0.2-0.5,0.3-1.1,0.9-1C82.3,33.8,84.8,34.4,86.9,35.3z"></path>  <path fill="#eeeeee" stroke="#000000" d="M87.1,35.3l6-2.4c-0.6-1.7-1.5-3.3-2.3-4.9c-0.3-0.7-1.2-0.6-1.4,0.1C88.8,30.6,88.2,33,87.1,35.3z"></path>  <path fill="#6994b7" stroke="#000000" d="M82.8,50.1c0-3.4-0.5-6.8-1.6-10c-0.2-0.8-0.4-1.5-0.3-2.3c0.1-0.8,0.4-1.6,0.7-2.4c0.7-1.5,1.9-3.1,3.7-4l0,0 c1.8-0.9,3.7-1.1,5.6-0.3c0.9,0.4,1.7,1,2.4,1.8c0.7,0.8,1.3,1.7,1.7,2.8c1.5,4.6,2.2,9.5,2.3,14.4"></path>  <path fill="#eeeeee" d="M86.3,50.2l0-0.9l-0.1-0.9l-0.1-1.9c0-0.9,0.2-1.7,0.7-2.3c0.5-0.7,1.3-1.2,2.3-1.4l0.3,0 c0.9-0.2,1.9,0,2.6,0.6c0.7,0.5,1.3,1.4,1.4,2.4l0.2,2.2l0.1,1.1l0,1.1"></path>  <path fill="#ff9922" d="M93.2,34.6c0.1,0.4-0.3,0.8-0.9,1c-0.6,0.2-1.2,0.1-1.4-0.2c-0.1-0.3,0.3-0.8,0.9-1 C92.4,34.2,93,34.3,93.2,34.6z"></path>  <path fill="#ff9922" d="M81.9,38.7c0.1,0.3,0.7,0.3,1.3,0.1c0.6-0.2,1-0.6,0.9-0.9c-0.1-0.3-0.7-0.3-1.3-0.1 C82.2,38,81.8,38.4,81.9,38.7z"></path>  <path fill="#000000" d="M88.5,36.8c0.1,0.3-0.2,0.7-0.6,0.8c-0.5,0.2-0.9,0-1.1-0.3c-0.1-0.3,0.2-0.7,0.6-0.8C87.9,36.3,88.4,36.4,88.5,36.8z"></path>  <path stroke="#000000" d="M85.9,38.9c0.2,0.6,0.8,0.9,1.4,0.7c0.6-0.2,0.9-0.9,0.6-2.1c0.3,1.2,1,1.7,1.6,1.5c0.6-0.2,0.9-0.8,0.8-1.4"></path>  <path fill="#6994b7" stroke="#000000" d="M86.8,42.3l0.4,2.2c0.1,0.4,0.1,0.7,0.2,1.1l0.1,1.1c0.1,1.2-0.9,2.3-2.2,2.3c-1.3,0-2.5-0.8-2.5-1.9l-0.1-1 c0-0.3-0.1-0.6-0.2-1l-0.3-1.9"></path>  <path fill="#6994b7" stroke="#000000" d="M96.2,40.3l0.5,2.7c0.1,0.5,0.2,0.9,0.2,1.4l0.1,1.4c0.1,1.5-0.9,2.8-2.2,2.9h0c-1.3,0-2.5-1.1-2.6-2.4 L92.1,45c0-0.4-0.1-0.8-0.2-1.2l-0.4-2.5"></path>  <path fill="#000000" d="M91.1,34.1c0.3,0.7,0,1.4-0.7,1.6c-0.6,0.2-1.3-0.1-1.6-0.7c-0.2-0.6,0-1.4,0.7-1.6C90.1,33.1,90.8,33.5,91.1,34.1z"></path>  <path fill="#000000" d="M85.5,36.3c0.2,0.6-0.1,1.2-0.7,1.5c-0.6,0.2-1.3,0-1.5-0.6C83,36.7,83.4,36,84,35.8C84.6,35.5,85.3,35.7,85.5,36.3z"></path></g></svg>',
    backgroundColor = "rgba(0,0,0,0.8)",
    textColor = "white"
) {
    var options = {
        theme: theme,
        message: text,
        content: content,
        backgroundColor: backgroundColor,
        textColor: textColor,
    };

    HoldOn.open(options);
}

function holdonClose() {
    HoldOn.close();
}

function showDown() {
    $(".show-down>label").on("click", function () {
        if ($(this).hasClass("show")) {
            $(this).removeClass("show");
            $(this).parent().children("div").slideUp();
        } else {
            $(this).addClass("show");
            $(this).parent().children("div").slideDown();
        }
    });
    $(".hopdong-item").on("click", function () {
        if ($(this).children().is(":checked")) {
            var text1 = $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .children("label")
                .text();
            text1 = text1.split(":");
            text1 = text1[0] + ":";
            var text2 = $(this).text();
            $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .children("label")
                .text(text1 + " " + text2);
        }
    });
    $(".dichvu-item").on("click", function () {
        var text1 = $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .children("label")
            .text();
        text1 = text1.split(":");
        text1 =
            text1[0] +
            ": " +
            $(".custom-checkbox input[type='checkbox']:checked").length;
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .children("label")
            .text(text1);
    });
    $(".dieukhoan-item").on("click", function () {
        loadSelected();
        var text1 = $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .children("label")
            .text();
        text1 = text1.split(":");
        text1 =
            text1[0] +
            ": " +
            $(".custom-checkbox input[type='checkbox']:checked").length;
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .children("label")
            .text(text1);
    });
}

function loadSelected() {
    $(".itemsdieukhoan .input-group .form-group.col-3").each(function () {
        if ($(this).children().children().prop("checked")) {
        }
    });
}

/*--------------------------------------------------------- Phòng trọ ---------------------------------------------------------*/

function roomPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "phong-tro/pagination",
        data: { page: page },
        success: function (response) {
            $(".room-pagination").html(response);
        },
    });
}

function cancelContract(myModal) {
    $('.huy-room').on('click', function () {
        Swal.fire({
            title: "Bạn có muốn hủy hợp đồng của phòng này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xác nhận !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                var id = $(this).parent().parent().data("id");
                $.ajax({
                    type: "get",
                    url: "phong-tro/huy-hopdong-phong",
                    data: { id: id },
                }).done(function (response) {
                    $('tr[data-id="' + id + '"]').html(response);
                    Swal.fire("Sửa hủy thành công!", "", "success");
                    holdonClose();
                    deleteRoom(myModal);
                    getRoomDataUpdate(myModal);
                    showRoomStatus(id);
                    cancelContract();
                });
            }
        });
    });
}

function deleteRoom(myModal) {
    $(".delete-room").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá phòng này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "phong-tro/xoa-phong",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteRoom(myModal);
                    roomPagination();
                    getRoomDataUpdate(myModal);
                    showRoomStatus();
                    showDown();
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function addRoom(myModal) {
    hopdong = $(".itemshopdong").parent().children("label").text();
    hopdong = hopdong.split(":");
    hopdong = hopdong[0] + ":";
    $(".itemshopdong").parent().children("label").text(hopdong);

    dichvu = $(".itemsdichvu").parent().children("label").text();
    dichvu = dichvu.split(":");
    dichvu = dichvu[0] + ":";
    $(".itemsdichvu").parent().children("label").text(dichvu);

    images = [];
    imagetaghtml = [];
    imageserver = [];
    $("#phong .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formphong")[0]);
        data.append("page", page);
        if (images.length != 0) {
            data.append("imagesLength", images.length);
            for (var i = 0; i < images.length; i++) {
                data.append("files" + i, images[i]);
            }
        }
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            if (data.get("price") != "") {
                if (data.get("deposittime") != "") {
                    $.ajax({
                        type: "POST",
                        url: "phong-tro/them-phong",
                        data: data,
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function (response) {
                            if (response == 1) {
                                Swal.fire("Vui lòng chọn 1 hợp đồng", "", "error");
                                holdonClose();
                            } else if (response == 2) {
                                Swal.fire(
                                    "Vui lòng chọn ít nhất 1 dịch vụ",
                                    "",
                                    "error"
                                );
                                holdonClose();
                            } else {
                                Swal.fire("Thêm phòng thành công!", "", "success");
                                $(".main-content tbody").html(response);
                                $(".pic-container").replaceWith(
                                    "<div class='pic-container'></div>"
                                );
                                deleteRoom(myModal);
                                getRoomDataUpdate(myModal);
                                showRoomStatus();
                                roomPagination();
                                $("#formphong").trigger("reset");
                                myModal.hide();
                            }
                        },
                    });

                } else {
                    Swal.fire("Vui lòng nhập thời gian cọc", "", "error");
                    holdonClose();
                }
            } else {
                Swal.fire("Vui lòng nhập giá phòng", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên phòng", "", "error");
            holdonClose();
        }
    });
}

/* functions Hình ảnh */

function deleteImage() {
    $(".xoa-anh").on("click", function () {
        var stt = $(this).parent().data("stt");
        var id = $(".pic-container").data("id");
        if ($(this).parent().hasClass("saved")) {
            /* Đang xóa */
            thisitem = $(this).parent();
            $.ajax({
                type: "get",
                url: "phong-tro/xoa-hinh",
                data: { id: id, stt: stt },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data["success"] == 1) {
                        imageserver = [];
                        $(thisitem).slideUp(400, function () {
                            $(thisitem).remove();
                            $(".pic.saved").each(function (index) {
                                if ($(this).data("stt") != index) {
                                    $(this).data("stt", index);
                                    $(this).attr("data-stt", index);
                                }
                            });
                        });
                        var array = data["list"];
                        array = array.split(",");
                        console.log(array);
                        for (var i = 0; i < array.length; i++) {
                            imageserver.push(
                                '<div class="pic saved" data-stt="' +
                                i +
                                '"><img src="../public/uploads/room/' +
                                id +
                                "/" +
                                array[i] +
                                '"><button type="button" class="btn btn-danger xoa-anh"><i class="fa-regular fa-trash-can"></i></button></div>'
                            );
                        }
                    }
                },
            });
        }
        if (!$(this).parent().hasClass("saved")) {
            $(this)
                .parent()
                .slideUp(400, function () {
                    images.splice(stt, 1);
                    $(this).remove();
                    $(".pic:not(.saved)").each(function (index) {
                        if ($(this).data("stt") != index) {
                            $(this).data("stt", index);
                            $(this).attr("data-stt", index);
                        }
                    });
                });
        }
    });
}

function loadImageArray() {
    imagetaghtml = [];
    $.merge(imagetaghtml, imageserver);
    for (var i = 0; i < images.length; i++) {
        var path = (window.URL || window.webkitURL).createObjectURL(images[i]);
        imagetaghtml.push(
            '<div class="pic" data-stt="' +
            i +
            '"><img src="' +
            path +
            '"><button type="button" class="btn btn-danger xoa-anh"><i class="fa-regular fa-trash-can"></i></button></div>'
        );
    }
}

function replaceImage() {
    var id = $(".pic-container").data("id");
    loadImageArray();
    arraytag = "";
    for (var i = 0; i < imagetaghtml.length; i++) {
        arraytag += imagetaghtml[i];
    }
    $(".pic-container").replaceWith(
        '<div class="pic-container" data-id=' + id + ">" + arraytag + "</div>"
    );
    deleteImage();
}

function changeImage() {
    $("#image").change(function () {
        for (var i = 0; i < $(this).get(0).files.length; i++) {
            if ($(this).get(0).files[i]) {
                if (
                    $(this)
                        .get(0)
                        .files[i].name.match(/.(jpg|jpeg|png|gif)$/i)
                ) {
                    var size = parseInt($(this).get(0).files[i].size) / 1024;

                    if (size <= 4096) {
                        images.push($(this).get(0).files[i]);
                    } else {
                        Swal.fire(
                            "Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB",
                            "",
                            "error"
                        );
                        return false;
                    }
                } else {
                    Swal.fire("Định dạng hình ảnh không hợp lệ", "", "error");
                    return false;
                }
            } else {
                return false;
            }
        }
        $("#image").val("");
        replaceImage();
    });
    var holder = $("input.custom-file");
    $(holder).on("dragover", function () {
        $(this).addClass("drag");
    });
    $(holder).on("dragleave drop", function () {
        $(this).removeClass("drag");
    });
}

/* functions Hình ảnh */

/* functions Sửa phòng */
/* ----------Đổ dữ liệu phòng vào form---------- */
function changeRoomData(data) {
    $(".pic-container").replaceWith(
        '<div class="pic-container" data-id="' + data["id"] + '"></div>'
    );
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='price']").val(data["price"]);
    $(".form-add input[name='payday']").val(data["payday"]);
    $(".form-add input[name='deposittime']").val(data["deposittime"]);
    $(".form-add input[name='electricity_price']").val(
        data["electricity_price"]
    );
    $(".form-add input[name='water_price']").val(data["water_price"]);
    $(".form-add input[name='floor']").val(data["floor"]);
    $(".form-add input[name='area']").val(data["area"]);

    if (data["status"] != null) {
        $(".form-add select[name='status']").val(data["status"]);
    } else {
        $(".form-add select[name='status']").val("0");
    }
    if (data["desc"] != null) {
        $(".form-add textarea#desc").text(data["desc"]);
    }
    if (data["content"] != null) {
        $(".form-add textarea#content").text(data["content"]);
    }
    if (data["picture"] != null) {
        data["picture"] = data["picture"].split(",");
        if (data["picture"].length != 0) {
            for (var i = 0; i < data["picture"].length; i++) {
                $(".pic-container").append(
                    '<div class="pic saved" data-stt="' +
                    i +
                    '"><img src="../public/uploads/room/' +
                    data["id"] +
                    "/" +
                    data["picture"][i] +
                    '"><button type="button" class="btn btn-danger xoa-anh"><i class="fa-regular fa-trash-can"></i></button></div>'
                );
                imageserver.push(
                    '<div class="pic saved" data-stt="' +
                    i +
                    '"><img src="../public/uploads/room/' +
                    data["id"] +
                    "/" +
                    data["picture"][i] +
                    '"><button type="button" class="btn btn-danger xoa-anh"><i class="fa-regular fa-trash-can"></i></button></div>'
                );
            }
        }
    }
    if (data["id_hopdong"] != null) {
        for (var i = 0; i < data["id_hopdong"].length; i++) {
            $(
                ".hopdong-item input[value='" + data["id_hopdong"][i] + "']"
            ).prop("checked", true);
        }
    }
    if (data["id_dichvu"] != null) {
        for (var i = 0; i < data["id_dichvu"].length; i++) {
            $(".dichvu-item input[value='" + data["id_dichvu"][i] + "']").prop(
                "checked",
                true
            );
        }
    }
    hopdong = $(".itemshopdong").parent().children("label").text();
    hopdong = hopdong.split(":");
    hopdong =
        hopdong[0] +
        ": " +
        $(".custom-radio:has(input[type='radio']:checked)").text();
    $(".itemshopdong").parent().children("label").text(hopdong);

    dichvu = $(".itemsdichvu").parent().children("label").text();
    dichvu = dichvu.split(":");
    dichvu = dichvu[0] + ": " + data["id_dichvu"].length;
    $(".itemsdichvu").parent().children("label").text(dichvu);

    if (data['status'] == 2) {
        $('#status').parent().parent().css('display', 'none');
    }
    if (data['status'] != 2) {
        $('#status').parent().parent().css('display', 'block');
    }
}

/* ----------Lấy dữ liệu phòng muốn đổi---------- */
function getRoomDataUpdate(myModal) {
    $(".update-room").on("click", function () {
        $("#formphong").trigger("reset");
        images = [];
        imagetaghtml = [];
        imageserver = [];
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "phong-tro/lay-phong",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#phong .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#phong .modal-title").text("Sửa phòng");
            changeRoomData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateRoom(myModal, id);
            deleteImage();
        });
    });
}
/* ----------Cập nhật phòng---------- */
function updateRoom(myModal, id) {
    $("#phong .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formphong")[0]);
        data.append("id", id);
        data.append("imagesLength", images.length);
        for (var i = 0; i < images.length; i++) {
            data.append("files" + i, images[i]);
        }

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            if (data.get("price") != "") {
                if (data.get("deposittime") != "") {
                    $.ajax({
                        type: "POST",
                        url: "phong-tro/sua-phong",
                        data: data,
                        processData: false,
                        cache: false,
                        contentType: false,
                    }).done(function (response) {
                        if (response == 1) {
                            Swal.fire("Vui lòng chọn 1 hợp đồng", "", "error");
                            holdonClose();
                        } else if (response == 2) {
                            Swal.fire("Vui lòng chọn ít nhất 1 dịch vụ", "", "error");
                            holdonClose();
                        } else {
                            $('tr[data-id="' + id + '"]').html(response);
                            Swal.fire("Sửa thành công!", "", "success");
                            holdonClose();
                            deleteRoom(myModal);
                            getRoomDataUpdate(myModal);
                            showRoomStatus(id);
                            myModal.hide();
                            $("#formphong").trigger("reset");
                        }
                    });
                } else {
                    Swal.fire("Vui lòng nhập thời gian cọc", "", "error");
                    holdonClose();
                }
            } else {
                Swal.fire("Vui lòng nhập giá phòng", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên phòng", "", "error");
            holdonClose();
        }

    });
}
/* ----------Đổi trạng thái phòng---------- */

/* ----------Xử lý trạng thái qua Ajax---------- */
function roomAjaxHandle(idRoom, element, statusValue) {
    $.ajax({
        type: "GET",
        url: "phong-tro/doi-status-phong",
        data: { id: idRoom, status: statusValue },
        error: function (e) {
            console.log(e);
        },
    }).done(function (response) {
        $(element).html(response);
        $(element.children().children(".status-name")).on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        $(
            element
                .children()
                .children(".status-r")
                .children()
                .on("click", function () {
                    roomAjaxHandle(idRoom, element, $(this).data("value"));
                })
        );
    });
}
/* ----------Xử lý nút bấm---------- */
function handleRoomStatus() {
    $(".status-r .value").on("click", function (e) {
        e.preventDefault();
        var idRoom = $(this).parent().parent().parent().parent().data("id");
        var element = $(this).parent().parent().parent();
        var statusValue = $(this).data("value");
        roomAjaxHandle(idRoom, element, statusValue);
    });
}
/* ----------Xử lý trạng thái danh sách---------- */
function showRoomStatus(id = null) {
    $("body").click(function (e) {
        if (!$(e.target).is(".value")) {
            $("tr").each(function () {
                if (
                    $(this)
                        .children()
                        .children(".change-status")
                        .hasClass("active")
                ) {
                    $(this)
                        .children()
                        .children(".change-status")
                        .removeClass("active");
                    $(this)
                        .children()
                        .children()
                        .children(".status-r")
                        .slideUp();
                }
            });
        }
    });
    if (id != null) {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().parent().parent().data("id") == id) {
                if ($(this).parent().hasClass("active")) {
                    $(this).parent().removeClass("active");
                    $(this).parent().children(".status-r").slideUp();
                    return false;
                } else {
                    $(this).parent().addClass("active");
                    $(this).parent().children(".status-r").slideDown();
                    return false;
                }
            }
        });
        handleRoomStatus();
    } else {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        handleRoomStatus();
    }
}

/* ----------Đổi trạng thái phòng----------*/

/* functions Sửa phòng */

/*--------------------------------------------------------- Phòng trọ ---------------------------------------------------------*/

/*--------------------------------------------------------- Hợp đồng ---------------------------------------------------------*/

function contractPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "hop-dong/pagination",
        data: { page: page },
        success: function (response) {
            $(".contract-pagination").html(response);
        },
    });
}

function addContract(myModal) {
    $("#hopdong .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formhopdong")[0]);
        data.append("page", page);
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            myModal.hide();
            $("#formhopdong").trigger("reset");
            $.ajax({
                type: "POST",
                url: "hop-dong/them-hopdong",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $(".main-content tbody").html(respose);
                deleteContract(myModal);
                getContractDataUpdate(myModal);
                contractPagination();
            });
        } else {
            Swal.fire("Vui lòng nhập tên hợp đồng", "", "error");
            holdonClose();
        }
    });
}

function deleteContract(myModal) {
    $(".delete-contract").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá hợp đồng này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "hop-dong/xoa-hopdong",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteContract(myModal);
                    contractPagination();
                    getContractDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeContractData(data) {
    $(
        ".dieukhoan-item input"
    ).prop("checked", false);
    $(".form-add input[name='name']").val(data["name"]);

    if (data["content"] != null) {
        $(".form-add textarea#content").text(data["content"]);
    }
    if (data["id_dieukhoan"] != null) {
        for (var i = 0; i < data["id_dieukhoan"].length; i++) {
            $(
                ".dieukhoan-item input[value='" + data["id_dieukhoan"][i] + "']"
            ).prop("checked", true);
        }
    }
    dieukhoan = $(".itemsdieukhoan").parent().children("label").text();
    dieukhoan = dieukhoan.split(":");
    dieukhoan = dieukhoan[0] + ": " + data["id_dieukhoan"].length;
    $(".itemsdieukhoan").parent().children("label").text(dieukhoan);
}

function updateContract(myModal, id) {
    $("#hopdong .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formhopdong")[0]);
        data.append("id", id);

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("name") != "") {
            myModal.hide();
            $("#formhopdong").trigger("reset");
            $.ajax({
                type: "POST",
                url: "hop-dong/sua-hopdong",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $('tr[data-id="' + id + '"]').html(respose);
                holdonClose();
                deleteContract(myModal);
                getContractDataUpdate(myModal);
            });
        } else {
            Swal.fire("Vui lòng nhập tên hợp đồng", "", "error");
            holdonClose();
        }
    });
}

function getContractDataUpdate(myModal) {
    $(".update-contract").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "hop-dong/lay-hopdong",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#hopdong .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#hopdong .modal-title").text("Sửa hợp đồng");
            changeContractData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateContract(myModal, id);
            deleteImage();
        });
    });
}

/*--------------------------------------------------------- Hợp đồng ---------------------------------------------------------*/

/*--------------------------------------------------------- Điều khoản ---------------------------------------------------------*/

function termPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "dieu-khoan/pagination",
        data: { page: page },
        success: function (response) {
            $(".term-pagination").html(response);
        },
    });
}

function addTerm(myModal) {
    $("#dieukhoan .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formdieukhoan")[0]);
        data.append("page", page);
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            myModal.hide();
            $("#formdieukhoan").trigger("reset");
            $.ajax({
                type: "POST",
                url: "dieu-khoan/them-dieukhoan",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $(".main-content tbody").html(respose);
                deleteTerm(myModal);
                getTermDataUpdate(myModal);
                termPagination();
            });
        } else {
            Swal.fire("Vui lòng nhập tên điều khoản", "", "error");
            holdonClose();
        }
    });
}

function deleteTerm(myModal) {
    $(".delete-term").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá điều khoản này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "dieu-khoan/xoa-dieukhoan",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteTerm(myModal);
                    termPagination();
                    getTermDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeTermData(data) {
    $(".form-add input[name='name']").val(data["name"]);

    if (data["content"] != null) {
        $(".form-add textarea#content").text(data["content"]);
    }
}

function updateTerm(myModal, id) {
    $("#dieukhoan .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formdieukhoan")[0]);
        data.append("id", id);

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("name") != "") {
            myModal.hide();
            $("#formdieukhoan").trigger("reset");
            $.ajax({
                type: "POST",
                url: "dieu-khoan/sua-dieukhoan",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $('tr[data-id="' + id + '"]').html(respose);
                holdonClose();
                deleteTerm(myModal);
                getTermDataUpdate(myModal);
            });
        } else {
            Swal.fire("Vui lòng nhập tên điều khoản", "", "error");
            holdonClose();
        }
    });
}

function getTermDataUpdate(myModal) {
    $(".update-term").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "dieu-khoan/lay-dieukhoan",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#dieukhoan .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#dieukhoan .modal-title").text("Sửa điều khoản");
            changeTermData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateTerm(myModal, id);
        });
    });
}
/*--------------------------------------------------------- Điều khoản ---------------------------------------------------------*/

/*--------------------------------------------------------- Dịch vụ ---------------------------------------------------------*/

function servicePagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "dich-vu/pagination",
        data: { page: page },
        success: function (response) {
            $(".service-pagination").html(response);
        },
    });
}

function addService(myModal) {
    $("#dichvu .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formdichvu")[0]);
        data.append("page", page);
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            myModal.hide();
            $("#formdichvu").trigger("reset");
            $.ajax({
                type: "POST",
                url: "dich-vu/them-dichvu",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $(".main-content tbody").html(respose);
                deleteService(myModal);
                getServiceDataUpdate(myModal);
                servicePagination();
            });
        } else {
            Swal.fire("Vui lòng nhập tên dịch vụ", "", "error");
            holdonClose();
        }
    });
}

function deleteService(myModal) {
    $(".delete-service").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá dịch vụ này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "dich-vu/xoa-dichvu",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteService(myModal);
                    servicePagination();
                    getServiceDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeServiceData(data) {
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='price']").val(data["price"]);
}

function updateService(myModal, id) {
    $("#dichvu .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formdichvu")[0]);
        data.append("id", id);

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("name") != "") {
            myModal.hide();
            $("#formdichvu").trigger("reset");
            $.ajax({
                type: "POST",
                url: "dich-vu/sua-dichvu",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $('tr[data-id="' + id + '"]').html(respose);
                holdonClose();
                deleteService(myModal);
                getServiceDataUpdate(myModal);
            });
        } else {
            Swal.fire("Vui lòng nhập tên dịch vụ", "", "error");
            holdonClose();
        }
    });
}

function getServiceDataUpdate(myModal) {
    $(".update-service").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "dich-vu/lay-dichvu",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#dichvu .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#dichvu .modal-title").text("Sửa dịch vụ");
            changeServiceData(data);
            myModal.show();
            updateService(myModal, id);
        });
    });
}
/*--------------------------------------------------------- Dịch vụ ---------------------------------------------------------*/

/*--------------------------------------------------------- Tài khoản khách hàng ---------------------------------------------------------*/

function changeAccountImage() {
    $("#photo").change(function () {
        if ($(this).get(0).files[0]) {
            if (
                $(this)
                    .get(0)
                    .files[0].name.match(/.(jpg|jpeg|png|gif)$/i)
            ) {
                var size = parseInt($(this).get(0).files[0].size) / 1024;

                if (size <= 4096) {
                    $(".pic-container-1").html(
                        '<div class="pic"><img src="' + (window.URL || window.webkitURL).createObjectURL($(this).get(0).files[0]) + '"></div>'
                    );
                } else {
                    Swal.fire(
                        "Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB",
                        "",
                        "error"
                    );
                    return false;
                }
            } else {
                Swal.fire("Định dạng hình ảnh không hợp lệ", "", "error");
                return false;
            }
        } else {
            return false;
        }
    });
    var holder = $("input.custom-file-2");
    $(holder).on("dragover", function () {
        $(this).addClass("drag");
    });
    $(holder).on("dragleave drop", function () {
        $(this).removeClass("drag");
    });
}



function customerPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "khach-hang/pagination",
        data: { page: page },
        success: function (response) {
            $(".customer-pagination").html(response);
        },
    });
}

function deleteCustomer(myModal) {
    $(".delete-customer").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá tài khoản này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "khach-hang/xoa-khachhang",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteCustomer(myModal);
                    customerPagination();
                    getCustomerDataUpdate(myModal);
                    showCustomerStatus();
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function addCustomer(myModal) {
    $("#khachhang .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formkhachhang")[0]);
        data.append("page", page);
        if (data.get("name") != "") {
            $.ajax({
                type: "POST",
                url: "khach-hang/them-khachhang",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                if (respose == 1) {
                    holdonClose();
                    Swal.fire("Tên tài khoản đã tồn tại!", "", "error");
                } else if (respose == 2) {
                    holdonClose();
                    Swal.fire("Email đã tồn tại!", "", "error");
                } else {
                    $(".main-content tbody").html(respose);
                    $(".pic-container").replaceWith(
                        "<div class='pic-container'></div>"
                    );
                    myModal.hide();
                    $("#formkhachhang").trigger("reset");
                    deleteCustomer(myModal);
                    getCustomerDataUpdate(myModal);
                    showCustomerStatus();
                    customerPagination();
                }
            });
        } else {
            Swal.fire("Vui lòng nhập tên tài khoản", "", "error");
            holdonClose();
        }
    });
}

/* functions Sửa khách hàng */
/* ----------Đổ dữ liệu khách hàng vào form---------- */
function changeCustomerData(data) {
    $(".pic-container").replaceWith(
        '<div class="pic-container" data-id="' + data["id"] + '"></div>'
    );
    $(".form-add input[name='username']").val(data["username"]);
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='email']").val(data["email"]);
    $(".form-add input[name='phone']").val(data["phone"]);
    $(".form-add input[name='birthday']").val(data["birthday"]);
    $(".form-add input[name='address']").val(data["address"]);
    if (data["avatar"] != "" && data["avatar"] != null) {
        $(".pic-container-1").html(
            "<div class='pic'><img src='../public/uploads/users/customers/" +
            data["id"] +
            "/" +
            data["avatar"] +
            "' alt=''></div>"
        );
    }
    if (data["status"] != null) {
        $(".form-add select[name='status']").val(data["status"]);
    } else {
        $(".form-add select[name='status']").val("0");
    }
}

/* ----------Lấy dữ liệu khách hàng muốn đổi---------- */
function getCustomerDataUpdate(myModal) {
    $(".update-customer").on("click", function () {
        images = [];
        imagetaghtml = [];
        imageserver = [];
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "khach-hang/lay-khachhang",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#khachhang .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#khachhang .modal-title").text("Sửa khách hàng");
            changeCustomerData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateCustomer(myModal, id);
            deleteImage();
        });
    });
}
/* ----------Cập nhật khách hàng---------- */
function updateCustomer(myModal, id) {
    $("#khachhang .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formkhachhang")[0]);
        data.append("id", id);
        data.append("imagesLength", images.length);
        for (var i = 0; i < images.length; i++) {
            data.append("files" + i, images[i]);
        }

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("password") == data.get("repassword")) {
            if (data.get("email") != "") {
                if (data.get("username") != "") {
                    $.ajax({
                        type: "POST",
                        url: "khach-hang/sua-khachhang",
                        data: data,
                        processData: false,
                        cache: false,
                        contentType: false,
                    }).done(function (respose) {
                        if (respose == 1) {
                            holdonClose();
                            Swal.fire("Tên tài khoản đã tồn tại!", "", "error");
                        } else if (respose == 2) {
                            holdonClose();
                            Swal.fire("Email đã tồn tại!", "", "error");
                        } else if (respose == 3) {
                            Swal.fire(
                                "Không trùng mật khẩu nhập lại !",
                                "",
                                "error"
                            );
                            holdonClose();
                        } else {
                            $('tr[data-id="' + id + '"]').html(respose);
                            myModal.hide();
                            $("#formkhachhang").trigger("reset");
                            holdonClose();
                            deleteCustomer(myModal);
                            getCustomerDataUpdate(myModal);
                            showCustomerStatus(id);
                        }
                    });
                } else {
                    Swal.fire("Vui lòng nhập tên tài khoản", "", "error");
                    holdonClose();
                }
            } else {
                Swal.fire("Vui lòng nhập email", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Mật khẩu nhập lại không trùng khớp", "", "error");
            holdonClose();
        }
    });
}
/* ----------Đổi trạng thái khách hàng---------- */

/* ----------Xử lý trạng thái qua Ajax---------- */
function ajaxCustomerHandle(idCustomer, element, statusValue) {
    $.ajax({
        type: "GET",
        url: "khach-hang/doi-status-khachhang",
        data: { id: idCustomer, status: statusValue },
        error: function (e) {
            console.log(e);
        },
    }).done(function (response) {
        $(element).html(response);
        $(element.children().children(".status-name")).on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        $(
            element
                .children()
                .children(".status-r")
                .children()
                .on("click", function () {
                    ajaxCustomerHandle(idCustomer, element, $(this).data("value"));
                })
        );
    });
}
/* ----------Xử lý nút bấm---------- */
function handleCustomerStatus() {
    $(".status-r .value").on("click", function (e) {
        e.preventDefault();
        var idCustomer = $(this).parent().parent().parent().parent().data("id");
        var element = $(this).parent().parent().parent();
        var statusValue = $(this).data("value");
        ajaxCustomerHandle(idCustomer, element, statusValue);
    });
}
/* ----------Xử lý trạng thái danh sách---------- */
function showCustomerStatus(id = null) {
    $("body").click(function (e) {
        if (!$(e.target).is(".value")) {
            $("tr").each(function () {
                if (
                    $(this)
                        .children()
                        .children(".change-status")
                        .hasClass("active")
                ) {
                    $(this)
                        .children()
                        .children(".change-status")
                        .removeClass("active");
                    $(this)
                        .children()
                        .children()
                        .children(".status-r")
                        .slideUp();
                }
            });
        }
    });
    if (id != null) {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().parent().parent().data("id") == id) {
                if ($(this).parent().hasClass("active")) {
                    $(this).parent().removeClass("active");
                    $(this).parent().children(".status-r").slideUp();
                    return false;
                } else {
                    $(this).parent().addClass("active");
                    $(this).parent().children(".status-r").slideDown();
                    return false;
                }
            }
        });
        handleCustomerStatus();
    } else {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        handleCustomerStatus();
    }
}

/* ----------Đổi trạng thái khách hàng----------*/

/* functions Sửa khách hàng */

/*--------------------------------------------------------- Tài khoản khách hàng ---------------------------------------------------------*/
/*--------------------------------------------------------- Tài khoản quản trị ---------------------------------------------------------*/
function adminPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "quan-tri/pagination",
        data: { page: page },
        success: function (response) {
            $(".admin-pagination").html(response);
        },
    });
}

function deleteAdmin(myModal) {
    $(".delete-admin").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá tài khoản này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "quan-tri/xoa-quantri",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    $(".main-content tbody").html(respose);
                    deleteAdmin(myModal);
                    adminPagination();
                    getAdminDataUpdate(myModal);
                    showAdminStatus();
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function addAdmin(myModal) {
    $("#quantri .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formquantri")[0]);
        data.append("page", page);
        if (data.get("password") == data.get("repassword")) {
            if (data.get("username") != "") {
                if (data.get("username") != "admin") {
                    $.ajax({
                        type: "POST",
                        url: "quan-tri/them-quantri",
                        data: data,
                        processData: false,
                        cache: false,
                        contentType: false,
                    }).done(function (respose) {
                        if (respose == 1) {
                            holdonClose();
                            Swal.fire("Tên tài khoản đã tồn tại!", "", "error");
                        } else if (respose == 2) {
                            holdonClose();
                            Swal.fire("Email đã tồn tại!", "", "error");
                        } else {
                            $(".main-content tbody").html(respose);
                            $(".pic-container").replaceWith(
                                "<div class='pic-container'></div>"
                            );
                            deleteAdmin(myModal);
                            getAdminDataUpdate(myModal);
                            showAdminStatus();
                            adminPagination();
                            myModal.hide();
                            $("#formquantri").trigger("reset");
                        }
                    });
                } else {
                    Swal.fire(
                        "Tên tài khoản này không được sử dụng !!!",
                        "",
                        "error"
                    );
                    holdonClose();
                }
            } else {
                Swal.fire("Vui lòng nhập tên tài khoản", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Mật khẩu nhập lại không trùng khớp", "", "error");
            holdonClose();
        }
    });
}

/* functions Sửa quản trị */
/* ----------Đổ dữ liệu quản trị vào form---------- */
function changeAdminData(data) {
    $(".pic-container").replaceWith(
        '<div class="pic-container" data-id="' + data["id"] + '"></div>'
    );
    $(".form-add input[name='username']").val(data["username"]);
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='email']").val(data["email"]);
    $(".form-add input[name='phone']").val(data["phone"]);
    $(".form-add input[name='birthday']").val(data["birthday"]);
    $(".form-add input[name='address']").val(data["address"]);
    if (data["avatar"] != "" && data["avatar"] != null) {
        $(".pic-container-1").html(
            "<div class='pic'><img src='../public/uploads/users/admins/" +
            data["id"] +
            "/" +
            data["avatar"] +
            "' alt=''></div>"
        );
    }
    if (data["status"] != null) {
        $(".form-add select[name='status']").val(data["status"]);
    } else {
        $(".form-add select[name='status']").val("0");
    }
    if (data['status'] == -1) {
        $('#status').parent().parent().css('display', 'none');
    }
    if (data['status'] != -1) {
        $('#status').parent().parent().css('display', 'block');
    }
    if (data['status'] == -1) {
        $('input[name="username"]').parent().parent().css('display', 'none');
    }
    if (data['status'] != -1) {
        $('input[name="username"]').parent().parent().css('display', 'block');
    }
}

/* ----------Lấy dữ liệu quản trị muốn đổi---------- */
function getAdminDataUpdate(myModal) {
    $(".update-admin").on("click", function () {
        images = [];
        imagetaghtml = [];
        imageserver = [];
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "quan-tri/lay-quantri",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#quantri .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#quantri .modal-title").text("Sửa quản trị");
            changeAdminData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateAdmin(myModal, id);
            deleteImage();
        });
    });
}
/* ----------Cập nhật quản trị---------- */
function updateAdmin(myModal, id) {
    $("#quantri .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formquantri")[0]);
        data.append("id", id);
        data.append("imagesLength", images.length);
        for (var i = 0; i < images.length; i++) {
            data.append("files" + i, images[i]);
        }

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("password") == data.get("repassword")) {
            if (data.get("username") != "") {
                $.ajax({
                    type: "POST",
                    url: "quan-tri/sua-quantri",
                    data: data,
                    processData: false,
                    cache: false,
                    contentType: false,
                }).done(function (respose) {
                    if (respose == 1) {
                        holdonClose();
                        Swal.fire("Tên tài khoản đã tồn tại!", "", "error");
                    } else if (respose == 2) {
                        holdonClose();
                        Swal.fire("Email đã tồn tại!", "", "error");
                    } else if (respose == 3) {
                        Swal.fire(
                            "Không trùng mật khẩu nhập lại !",
                            "",
                            "error"
                        );
                        holdonClose();
                    } else {
                        $('tr[data-id="' + id + '"]').html(respose);
                        myModal.hide();
                        $("#formquantri").trigger("reset");
                        holdonClose();
                        deleteAdmin(myModal);
                        getAdminDataUpdate(myModal);
                        showAdminStatus(id);
                    }
                });
            } else {
                Swal.fire("Vui lòng nhập tên tài khoản", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Mật khẩu nhập lại không trùng khớp", "", "error");
            holdonClose();
        }
    });
}
/* ----------Đổi trạng thái quản trị---------- */

/* ----------Xử lý trạng thái qua Ajax---------- */
function ajaxAdminHandle(idAdmin, element, statusValue) {
    $.ajax({
        type: "GET",
        url: "quan-tri/doi-status-quantri",
        data: { id: idAdmin, status: statusValue },
        error: function (e) {
            console.log(e);
        },
    }).done(function (response) {
        $(element).html(response);
        $(element.children().children(".status-name")).on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        $(
            element
                .children()
                .children(".status-r")
                .children()
                .on("click", function () {
                    ajaxAdminHandle(idAdmin, element, $(this).data("value"));
                })
        );
    });
}
/* ----------Xử lý nút bấm---------- */
function handleAdminStatus() {
    $(".status-r .value").on("click", function (e) {
        e.preventDefault();
        var idAdmin = $(this).parent().parent().parent().parent().data("id");
        var element = $(this).parent().parent().parent();
        var statusValue = $(this).data("value");
        ajaxAdminHandle(idAdmin, element, statusValue);
    });
}
/* ----------Xử lý trạng thái danh sách---------- */
function showAdminStatus(id = null) {
    $("body").click(function (e) {
        if (!$(e.target).is(".value")) {
            $("tr").each(function () {
                if (
                    $(this)
                        .children()
                        .children(".change-status")
                        .hasClass("active")
                ) {
                    $(this)
                        .children()
                        .children(".change-status")
                        .removeClass("active");
                    $(this)
                        .children()
                        .children()
                        .children(".status-r")
                        .slideUp();
                }
            });
        }
    });
    if (id != null) {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().parent().parent().data("id") == id) {
                if ($(this).parent().hasClass("active")) {
                    $(this).parent().removeClass("active");
                    $(this).parent().children(".status-r").slideUp();
                    return false;
                } else {
                    $(this).parent().addClass("active");
                    $(this).parent().children(".status-r").slideDown();
                    return false;
                }
            }
        });
        handleAdminStatus();
    } else {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        handleAdminStatus();
    }
}

/* ----------Đổi trạng thái quản trị----------*/

/* functions Sửa quản trị */

/*--------------------------------------------------------- Tài khoản quản trị ---------------------------------------------------------*/

function loadImageArray2(img) {
    var path = (window.URL || window.webkitURL).createObjectURL(img);
    var tag = '<div class="pic"><img src="' + path + '"></div>';
    return tag;
}

function changeBvImage() {
    $("#photo").change(function () {
        if ($(this).get(0).files[0]) {
            if (
                $(this)
                    .get(0)
                    .files[0].name.match(/.(jpg|jpeg|png|gif)$/i)
            ) {
                var size = parseInt($(this).get(0).files[0].size) / 1024;

                if (size <= 4096) {
                    $(".pic-container-1").html(
                        loadImageArray2($(this).get(0).files[0])
                    );
                } else {
                    Swal.fire(
                        "Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB",
                        "",
                        "error"
                    );
                    return false;
                }
            } else {
                Swal.fire("Định dạng hình ảnh không hợp lệ", "", "error");
                return false;
            }
        } else {
            return false;
        }
    });
    var holder = $("input.custom-file-1");
    $(holder).on("dragover", function () {
        $(this).addClass("drag");
    });
    $(holder).on("dragleave drop", function () {
        $(this).removeClass("drag");
    });
}

function UpdateGt() {
    $("#btnluu.luugt").on("click", function () {
        holdonOpen();
        data = new FormData($("#formgioithieu")[0]);
        data.append("pic", $("#photo").get(0).files);
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });
        if (data.get("name") != "") {
            $.ajax({
                type: "POST",
                url: "gioi-thieu/sua-gioithieu",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                success: function (response) {
                    if (response == 1) {
                        Swal.fire("Chỉnh sửa thành công!", "", "success");
                        holdonClose();
                    }
                },
            });
        } else {
            Swal.fire("Vui lòng nhập tên bài viết", "", "error");
            holdonClose();
        }
    });
}

/*--------------------------------------------------------- Chi ---------------------------------------------------------*/

function chiPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "chi/pagination",
        data: { page: page },
        success: function (response) {
            $(".chi-pagination").html(response);
        },
    });
}

function addChi(myModal) {
    $("#chi .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formchi")[0]);
        data.append("page", page);

        if (data.get("name") != "") {
            if (data.get("price") != "") {
                myModal.hide();
                $("#formchi").trigger("reset");
                $.ajax({
                    type: "POST",
                    url: "chi/them-chi",
                    data: data,
                    processData: false,
                    cache: false,
                    contentType: false,
                }).done(function (respose) {
                    $(".main-content tbody").html(respose);
                    deleteChi(myModal);
                    getChiDataUpdate(myModal);
                    chiPagination();
                });
            } else {
                Swal.fire("Vui lòng nhập giá", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên điều khoản", "", "error");
            holdonClose();
        }
    });
}

function deleteChi(myModal) {
    $(".delete-chi").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá phiếu chi này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "chi/xoa-chi",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteChi(myModal);
                    chiPagination();
                    getChiDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeChiData(data) {
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='price']").val(data["price"]);
    $(".form-add textarea[name='content']").val(data["content"]);
}

function updateChi(myModal, id) {
    $("#chi .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formchi")[0]);
        data.append("id", id);

        if (data.get("name") != "") {
            if (data.get("price") != "") {
                myModal.hide();
                $("#formchi").trigger("reset");
                $.ajax({
                    type: "POST",
                    url: "chi/sua-chi",
                    data: data,
                    processData: false,
                    cache: false,
                    contentType: false,
                }).done(function (respose) {
                    $('tr[data-id="' + id + '"]').html(respose);
                    holdonClose();
                    deleteChi(myModal);
                    getChiDataUpdate(myModal);
                });
            } else {
                Swal.fire("Vui lòng nhập giá", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên phiếu chi", "", "error");
            holdonClose();
        }
    });
}

function getChiDataUpdate(myModal) {
    $(".update-chi").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "chi/lay-chi",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#chi .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#chi .modal-title").text("Sửa phiếu chi");
            changeChiData(data);
            myModal.show();
            updateChi(myModal, id);
        });
    });
}
/*--------------------------------------------------------- Chi ---------------------------------------------------------*/

/*--------------------------------------------------------- Thu ---------------------------------------------------------*/

function thuPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "thu/pagination",
        data: { page: page },
        success: function (response) {
            $(".thu-pagination").html(response);
        },
    });
}

function addThu(myModal) {
    $("#thu .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formthu")[0]);
        data.append("page", page);

        if (data.get("name") != "") {
            if (data.get("price") != "") {
                myModal.hide();
                $("#formthu").trigger("reset");
                $.ajax({
                    type: "POST",
                    url: "thu/them-thu",
                    data: data,
                    processData: false,
                    cache: false,
                    contentType: false,
                }).done(function (respose) {
                    $(".main-content tbody").html(respose);
                    deleteThu(myModal);
                    getThuDataUpdate(myModal);
                    thuPagination();
                });
            } else {
                Swal.fire("Vui lòng nhập giá", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên phiếu thu", "", "error");
            holdonClose();
        }
    });
}

function deleteThu(myModal) {
    $(".delete-thu").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá phiếu thu này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "thu/xoa-thu",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteThu(myModal);
                    thuPagination();
                    getThuDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeThuData(data) {
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='price']").val(data["price"]);
    $(".form-add textarea[name='content']").val(data["content"]);
}

function updateThu(myModal, id) {
    $("#thu .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formthu")[0]);
        data.append("id", id);

        if (data.get("name") != "") {
            if (data.get("price") != "") {
                myModal.hide();
                $("#formthu").trigger("reset");
                $.ajax({
                    type: "POST",
                    url: "thu/sua-thu",
                    data: data,
                    processData: false,
                    cache: false,
                    contentType: false,
                }).done(function (respose) {
                    $('tr[data-id="' + id + '"]').html(respose);
                    holdonClose();
                    deleteThu(myModal);
                    getThuDataUpdate(myModal);
                });
            } else {
                Swal.fire("Vui lòng nhập giá", "", "error");
                holdonClose();
            }
        } else {
            Swal.fire("Vui lòng nhập tên phiếu thu", "", "error");
            holdonClose();
        }
    });
}

function getThuDataUpdate(myModal) {
    $(".update-thu").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "thu/lay-thu",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#thu .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#thu .modal-title").text("Sửa phiếu thu");
            changeThuData(data);
            myModal.show();
            updateThu(myModal, id);
        });
    });
}
/*--------------------------------------------------------- Thu ---------------------------------------------------------*/
/*--------------------------------------------------------- Tin tức ---------------------------------------------------------*/
function tintucPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "tin-tuc/pagination",
        data: { page: page },
        success: function (response) {
            $(".tintuc-pagination").html(response);
        },
    });
}

function addTintuc(myModal) {
    $("#tintuc .modal-footer .add").on("click", function () {
        let currentUrl = new URLSearchParams(window.location.search);
        var page = currentUrl.get("page");
        if (page == null) {
            page = 1;
        }
        data = new FormData($("#formtintuc")[0]);
        data.append("page", page);

        if (data.get("name") != "") {
            myModal.hide();
            $("#formtintuc").trigger("reset");
            $.ajax({
                type: "POST",
                url: "tin-tuc/them-tintuc",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $(".main-content tbody").html(respose);
                deleteTintuc(myModal);
                getTintucDataUpdate(myModal);
                tintucPagination();
            });
        } else {
            Swal.fire("Vui lòng nhập tên bài viết", "", "error");
            holdonClose();
        }
    });
}

function deleteTintuc(myModal) {
    $(".delete-news").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá bài viết này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "tin-tuc/xoa-tintuc",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteTintuc(myModal);
                    tintucPagination();
                    getTintucDataUpdate(myModal);
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

function changeTintucData(data) {
    $(".form-add input[name='name']").val(data["name"]);
    if (data["desc"] != null) {
        $(".form-add textarea#desc").text(data["desc"]);
    }
    if (data["content"] != null) {
        $(".form-add textarea#content").text(data["content"]);
    }
    if (data["photo"] != "" && data["photo"] != null) {
        $(".pic-container-1").html(
            "<div class='pic'><img src='../public/uploads/news/tintuc/" +
            data["id"] +
            "/" +
            data["photo"] +
            "' alt=''></div>"
        );
    }
}

function updateTintuc(myModal, id) {
    $("#tintuc .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formtintuc")[0]);
        data.append("id", id);
        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        if (data.get("name") != "") {
            myModal.hide();
            $("#formtintuc").trigger("reset");
            $.ajax({
                type: "POST",
                url: "tin-tuc/sua-tintuc",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
            }).done(function (respose) {
                $('tr[data-id="' + id + '"]').html(respose);
                holdonClose();
                deleteTintuc(myModal);
                getTintucDataUpdate(myModal);
            });
        } else {
            Swal.fire("Vui lòng nhập tên bài viết", "", "error");
            holdonClose();
        }
    });
}

function getTintucDataUpdate(myModal) {
    $(".update-news").on("click", function () {
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "tin-tuc/lay-tintuc",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#tintuc .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#tintuc .modal-title").text("Sửa bài viết");
            changeTintucData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateTintuc(myModal, id);
        });
    });
}
/*--------------------------------------------------------- Tin tức ---------------------------------------------------------*/

/*--------------------------------------------------------- Phản Hồi ---------------------------------------------------------*/

function reportPagination() {
    let currentUrl = new URLSearchParams(window.location.search);
    var page = currentUrl.get("page");
    if (page == null) {
        page = 1;
    }
    $.ajax({
        type: "GET",
        url: "phan-hoi/pagination",
        data: { page: page },
        success: function (response) {
            $(".report-pagination").html(response);
        },
    });
}

function deleteReport(myModal) {
    $(".delete-report").on("click", function () {
        Swal.fire({
            title: "Bạn có muốn xoá phản hồi này ?",
            showDenyButton: true,
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: "Xoá !",
            denyButtonText: `Huỷ !`,
        }).then((result) => {
            if (result.isConfirmed) {
                holdonOpen();
                let currentUrl = new URLSearchParams(window.location.search);
                var id = $(this).parent().parent().data("id");
                var page = currentUrl.get("page");
                if (page == null) {
                    page = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "phan-hoi/xoa-phanhoi",
                    data: { id: id, page: page },
                    error: function () {
                        holdonClose();
                        Swal.fire("Xoá thất bại!", "", "error");
                    },
                }).done(function (respose) {
                    holdonClose();
                    $(".main-content tbody").html(respose);
                    deleteReport(myModal);
                    reportPagination();
                    getReportDataUpdate(myModal);
                    showReportStatus();
                    Swal.fire("Xoá thành công!", "", "success");
                });
            }
        });
    });
}

/* functions Sửa phản hồi */
/* ----------Đổ dữ liệu phản hồi vào form---------- */
function changeReportData(data) {
    $(".pic-container").replaceWith(
        '<div class="pic-container" data-id="' + data["id"] + '"></div>'
    );
    $(".form-add input[name='username']").val(data["username"]);
    $(".form-add input[name='name']").val(data["name"]);
    $(".form-add input[name='email']").val(data["email"]);
    $(".form-add input[name='phone']").val(data["phone"]);
    $(".form-add input[name='birthday']").val(data["birthday"]);
    $(".form-add input[name='address']").val(data["address"]);
    if (data["avatar"] != "" && data["avatar"] != null) {
        $(".pic-container-1").html(
            "<div class='pic'><img src='../public/uploads/users/reports/" +
            data["id"] +
            "/" +
            data["avatar"] +
            "' alt=''></div>"
        );
    }
    if (data["status"] != null) {
        $(".form-add select[name='status']").val(data["status"]);
    } else {
        $(".form-add select[name='status']").val("0");
    }
}

/* ----------Lấy dữ liệu phản hồi muốn đổi---------- */
function getReportDataUpdate(myModal) {
    $(".update-report").on("click", function () {
        images = [];
        imagetaghtml = [];
        imageserver = [];
        holdonOpen();
        var id = $(this).parent().parent().data("id");
        $.ajax({
            type: "GET",
            url: "phan-hoi/lay-phanhoi",
            data: { id: id },
        }).done(function (respose) {
            var data = JSON.parse(respose);
            holdonClose();
            $('#phanhoi .modal-footer button[type="submit"]').replaceWith(
                "<button data-id='" +
                data["id"] +
                "' type='submit' class='btn btn-block btn-success update'>Chỉnh sửa</button>"
            );
            $("#phanhoi .modal-title").text("Sửa phản hồi");
            changeReportData(data);
            FRAMEWORK.Cke();
            myModal.show();
            updateReport(myModal, id);
            deleteImage();
        });
    });
}
/* ----------Cập nhật phản hồi---------- */
function updateReport(myModal, id) {
    $("#phanhoi .modal-footer .update").on("click", function () {
        holdonOpen();

        data = new FormData($("#formphanhoi")[0]);
        data.append("id", id);
        data.append("imagesLength", images.length);
        for (var i = 0; i < images.length; i++) {
            data.append("files" + i, images[i]);
        }

        $(".ckeditor").each(function () {
            $(this)
                .parent()
                .children(".ck")
                .children(".ck.ck-editor__main")
                .children()
                .html();
            if ($(this).attr("id") == "desc") {
                data.append(
                    "ckedesc",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
            if ($(this).attr("id") == "content") {
                data.append(
                    "ckecontent",
                    $(this)
                        .parent()
                        .children(".ck")
                        .children(".ck.ck-editor__main")
                        .children(".ck.ck-content")
                        .html() != '<p><br data-cke-filler="true"></p>'
                        ? $(this)
                            .parent()
                            .children(".ck")
                            .children(".ck.ck-editor__main")
                            .children(".ck.ck-content")
                            .html()
                        : ""
                );
            }
        });

        $.ajax({
            type: "POST",
            url: "phan-hoi/sua-phanhoi",
            data: data,
            processData: false,
            cache: false,
            contentType: false,
        }).done(function (respose) {
            $('tr[data-id="' + id + '"]').html(respose);
            myModal.hide();
            $("#formphanhoi").trigger("reset");
            holdonClose();
            deleteReport(myModal);
            getReportDataUpdate(myModal);
            showReportStatus(id);
        });
    });
}
/* ----------Đổi trạng thái phản hồi---------- */

/* ----------Xử lý trạng thái qua Ajax---------- */
function ajaxReportHandle(idReport, element, statusValue) {
    $.ajax({
        type: "GET",
        url: "phan-hoi/doi-status-phanhoi",
        data: { id: idReport, status: statusValue },
        error: function (e) {
            console.log(e);
        },
    }).done(function (response) {
        $(element).html(response);
        $(element.children().children(".status-name")).on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        $(
            element
                .children()
                .children(".status-r")
                .children()
                .on("click", function () {
                    ajaxReportHandle(idReport, element, $(this).data("value"));
                })
        );
    });
}
/* ----------Xử lý nút bấm---------- */
function handleReportStatus() {
    $(".status-r .value").on("click", function (e) {
        e.preventDefault();
        var idReport = $(this).parent().parent().parent().parent().data("id");
        var element = $(this).parent().parent().parent();
        var statusValue = $(this).data("value");
        ajaxReportHandle(idReport, element, statusValue);
    });
}
/* ----------Xử lý trạng thái danh sách---------- */
function showReportStatus(id = null) {
    $("body").click(function (e) {
        if (!$(e.target).is(".value")) {
            $("tr").each(function () {
                if (
                    $(this)
                        .children()
                        .children(".change-status")
                        .hasClass("active")
                ) {
                    $(this)
                        .children()
                        .children(".change-status")
                        .removeClass("active");
                    $(this)
                        .children()
                        .children()
                        .children(".status-r")
                        .slideUp();
                }
            });
        }
    });
    if (id != null) {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().parent().parent().data("id") == id) {
                if ($(this).parent().hasClass("active")) {
                    $(this).parent().removeClass("active");
                    $(this).parent().children(".status-r").slideUp();
                    return false;
                } else {
                    $(this).parent().addClass("active");
                    $(this).parent().children(".status-r").slideDown();
                    return false;
                }
            }
        });
        handleReportStatus();
    } else {
        $(".change-status .status-name").on("click", function () {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
                $(this).parent().children(".status-r").slideUp();
                return false;
            } else {
                $(this).parent().addClass("active");
                $(this).parent().children(".status-r").slideDown();
                return false;
            }
        });
        handleReportStatus();
    }
}

/* ----------Đổi trạng thái phản hồi----------*/

/* functions Sửa phản hồi */

/*--------------------------------------------------------- Phản Hồi ---------------------------------------------------------*/