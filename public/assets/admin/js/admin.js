FRAMEWORK.Init = function () {
    $(document).ready(function () {
        $(".modal-body input").keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
};

FRAMEWORK.Menu = function () {
    if ($(".box-menuside").length) {
        $(".menu-btn").on("click", function () {
            if ($(".box-menuside").hasClass("active")) {
                $(".box-menuside").removeClass("active");
                $(".wrap-main").removeClass("active");
            } else {
                $(".box-menuside").addClass("active");
                $(".wrap-main").addClass("active");
            }
        });
    }
};
// Function Phòng
FRAMEWORK.Room = function () {
    if ($("#phong").length) {
        roomPagination();
        var myModal = new bootstrap.Modal("#phong");
        $("#btnthem").on("click", function () {
            $("#phong .modal-title").text("Thêm phòng mới");
            $('#phong .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $(".pic-container").replaceWith(
                "<div class='pic-container'></div>"
            );
            $("#formphong").trigger("reset");
            addRoom(myModal);
            $('#status').parent().parent().css('display', 'block');
            FRAMEWORK.Cke();
            myModal.show();
        });
        $(".btn-close,#phong .btn-danger").on("click", function () {
            myModal.hide();
        });
        getRoomDataUpdate(myModal);
        deleteRoom(myModal);
        showRoomStatus();
        changeImage();
        showDown();
        cancelContract(myModal);
    }
};
// Chạy Cke
FRAMEWORK.Cke = function () {
    $(".modal .ck").remove();
    $(".ckeditor").each(function (indexInArray, valueOfElement) {
        ClassicEditor.create(
            document.querySelector("#" + $(this).attr("id") + ".ckeditor")
        ).then((editor) => {
            window.editor = editor;
            editor.setData($(this).val());
        });
    });
};

// Function Hợp đồng
FRAMEWORK.Contract = function () {
    if ($("#hopdong").length) {
        contractPagination();
        var myModal = new bootstrap.Modal("#hopdong");
        $("#btnthem").on("click", function () {
            $("#hopdong .modal-title").text("Thêm hợp đồng mới");
            $('#hopdong .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            dieukhoan = $(".itemsdieukhoan").parent().children("label").text();
            dieukhoan = dieukhoan.split(":");
            dieukhoan = dieukhoan[0] + ": " + 0;
            console.log($(".ck.ck-content").val());
            $(".itemsdieukhoan").parent().children("label").text(dieukhoan);
            $("#formhopdong").trigger("reset");
           
            addContract(myModal);
            FRAMEWORK.Cke();
            myModal.show();
        });

        $(".btn-close,#hopdong .btn-danger").on("click", function () {
            myModal.hide();
        });
        getContractDataUpdate(myModal);
        deleteContract(myModal);
        showDown();
    }

    $('.show-term-item').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).parent().parent().children('.content-term').slideUp();
        } else {
            $(this).addClass('active');
            $(this).parent().parent().children('.content-term').slideDown();
        }
    });
};

// Function dịch vụ
FRAMEWORK.Service = function () {
    if ($("#dichvu").length) {
        servicePagination();
        var myModal = new bootstrap.Modal("#dichvu");
        $("#btnthem").on("click", function () {
            $("#dichvu .modal-title").text("Thêm dịch vụ mới");
            $('#dichvu .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formdichvu").trigger("reset");
            addService(myModal);
            FRAMEWORK.Cke();
            myModal.show();
        });

        $(".btn-close,#dichvu .btn-danger").on("click", function () {
            myModal.hide();
        });
        getServiceDataUpdate(myModal);
        deleteService(myModal);
    }
};

// Function điều khoản
FRAMEWORK.Term = function () {
    if ($("#dieukhoan").length) {
        termPagination();
        var myModal = new bootstrap.Modal("#dieukhoan");
        $("#btnthem").on("click", function () {
            $("#dieukhoan .modal-title").text("Thêm điều khoản mới");
            $('#dieukhoan .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formdieukhoan").trigger("reset");
            addTerm(myModal);
            FRAMEWORK.Cke();
            myModal.show();
        });

        $(".btn-close,#dieukhoan .btn-danger").on("click", function () {
            myModal.hide();
        });
        getTermDataUpdate(myModal);
        deleteTerm(myModal);
    }
};

// Function khách hàng
FRAMEWORK.Customer = function () {
    if ($("#khachhang").length) {
        customerPagination();
        changeAccountImage();
        var myModal = new bootstrap.Modal("#khachhang");
        $("#btnthem").on("click", function () {
            $("#khachhang .modal-title").text("Thêm khách hàng mới");
            $('#khachhang .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formkhachhang").trigger("reset");
            $(".pic-container-1").html(
                '<div class="pic"><img src="../public/assets/images/noimage.png" alt=""></div>'
            );
            addCustomer(myModal);
            myModal.show();
        });

        $(".btn-close,#khachhang .btn-danger").on("click", function () {
            myModal.hide();
        });
        getCustomerDataUpdate(myModal);
        showCustomerStatus();
        deleteCustomer(myModal);
    }
};

// Function quản trị
FRAMEWORK.Admin = function () {
    if ($("#quantri").length) {
        adminPagination();
        changeAccountImage();
        var myModal = new bootstrap.Modal("#quantri");
        $("#btnthem").on("click", function () {
            $("#quantri .modal-title").text("Thêm quản trị mới");
            $('#quantri .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formquantri").trigger("reset");
            $(".pic-container-1").html(
                '<div class="pic"><img src="../public/assets/images/noimage.png" alt=""></div>'
            );
            $("#formquantri").trigger("reset");
            addAdmin(myModal);
            $('#status').parent().parent().css('display', 'block');
            $('input[name="username"]').parent().parent().css('display', 'block');
            FRAMEWORK.Cke();
            myModal.show();
        });

        $(".btn-close,#quantri .btn-danger").on("click", function () {
            myModal.hide();
        });
        getAdminDataUpdate(myModal);
        showAdminStatus();
        deleteAdmin(myModal);
    }
};
//Function Chi
FRAMEWORK.Chi = function () {
    if ($("#chi").length) {
        chiPagination();
        var myModal = new bootstrap.Modal("#chi");
        $("#btnthem").on("click", function () {
            $("#chi .modal-title").text("Thêm phiếu chi mới");
            $('#chi .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formchi").trigger("reset");
            addChi(myModal);
            myModal.show();
        });

        $(".btn-close,#chi .btn-danger").on("click", function () {
            myModal.hide();
        });
        getChiDataUpdate(myModal);
        deleteChi(myModal);
    }
};
//Function Thu
FRAMEWORK.Thu = function () {
    if ($("#thu").length) {
        thuPagination();
        var myModal = new bootstrap.Modal("#thu");
        $("#btnthem").on("click", function () {
            $("#thu .modal-title").text("Thêm phiếu thu mới");
            $('#thu .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formthu").trigger("reset");
            addThu(myModal);
            myModal.show();
        });

        $(".btn-close,#thu .btn-danger").on("click", function () {
            myModal.hide();
        });
        getThuDataUpdate(myModal);
        deleteThu(myModal);
    }
};
//Function Giới thiệu
FRAMEWORK.Intro = function () {
    if ($("#formgioithieu").length) {
        changeBvImage();
        UpdateGt();
        FRAMEWORK.Cke();
    }
};
// Function bài viết tin tức
FRAMEWORK.Tintuc = function () {
    if ($("#tintuc").length) {
        tintucPagination();
        changeAccountImage();
        var myModal = new bootstrap.Modal("#tintuc");
        $("#btnthem").on("click", function () {
            $("#tintuc .modal-title").text("Thêm bài viết mới");
            $('#tintuc .modal-footer button[type="submit"]').replaceWith(
                '<button type="submit" class="btn btn-block btn-primary add">Thêm mới</button>'
            );
            $("#formkhachhang").trigger("reset");
            $(".pic-container-1").html(
                '<div class="pic"><img src="../public/assets/images/noimage.png" alt=""></div>'
            );
            $("#formtintuc").trigger("reset");
            addTintuc(myModal);
            FRAMEWORK.Cke();
            myModal.show();
        });

        $(".btn-close,#tintuc .btn-danger").on("click", function () {
            myModal.hide();
        });
        getTintucDataUpdate(myModal);
        deleteTintuc(myModal);
    }
};
// Function phản hồi
FRAMEWORK.Report = function () {
    if ($("#phanhoi").length) {
        customerPagination();
        changeAccountImage();
        var myModal = new bootstrap.Modal("#phanhoi");
        $(".btn-close,#phanhoi .btn-danger").on("click", function () {
            myModal.hide();
        });
        getReportDataUpdate(myModal);
        showReportStatus();
        deleteReport(myModal);
    }
};

$(document).ready(function () {
    FRAMEWORK.Init();
    FRAMEWORK.Menu();
    FRAMEWORK.Room();
    FRAMEWORK.Contract();
    FRAMEWORK.Service();
    FRAMEWORK.Term();
    FRAMEWORK.Customer();
    FRAMEWORK.Report();
    FRAMEWORK.Admin();
    FRAMEWORK.Intro();
    FRAMEWORK.Tintuc();
    FRAMEWORK.Chi();
    FRAMEWORK.Thu();
});
