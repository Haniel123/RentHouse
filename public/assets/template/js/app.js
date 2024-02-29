
// Config function
function isExist(ele) {
    return ele.length;
}
//  function decodeHtmlChars($htmlChars)
// {
//     return htmlspecialchars_decode($htmlChars ?: '');
// }
function isNumeric(value) {
    return /^\d+$/.test(value);
}


OwlData = function (obj) {
    if (!isExist(obj)) return false;
    var items = obj.attr('data-items');
    var rewind = Number(obj.attr('data-rewind')) ? true : false;
    var autoplay = Number(obj.attr('data-autoplay')) ? true : false;
    var loop = Number(obj.attr('data-loop')) ? true : false;
    var lazyLoad = Number(obj.attr('data-lazyload')) ? true : false;
    var mouseDrag = Number(obj.attr('data-mousedrag')) ? true : false;
    var touchDrag = Number(obj.attr('data-touchdrag')) ? true : false;
    var animations = obj.attr('data-animations') || false;
    var smartSpeed = Number(obj.attr('data-smartspeed')) || 800;
    var autoplaySpeed = Number(obj.attr('data-autoplayspeed')) || 800;
    var autoplayTimeout = Number(obj.attr('data-autoplaytimeout')) || 5000;
    var dots = Number(obj.attr('data-dots')) ? true : false;
    var responsive = {};
    var responsiveClass = true;
    var responsiveRefreshRate = 200;
    var nav = Number(obj.attr('data-nav')) ? true : false;
    var navContainer = obj.attr('data-navcontainer') || false;
    var navTextTemp =
        "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-narrow-left' width='50' height='37' viewBox='0 0 24 24' stroke-width='1' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='5' y1='12' x2='19' y2='12' /><line x1='5' y1='12' x2='9' y2='16' /><line x1='5' y1='12' x2='9' y2='8' /></svg>|<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-narrow-right' width='50' height='37' viewBox='0 0 24 24' stroke-width='1' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='5' y1='12' x2='19' y2='12' /><line x1='15' y1='16' x2='19' y2='12' /><line x1='15' y1='8' x2='19' y2='12' /></svg>";
    var navText = obj.attr('data-navtext');
    navText =
        nav &&
        navContainer &&
        (((navText === undefined || Number(navText)) && navTextTemp) ||
            (isNaN(Number(navText)) && navText) ||
            (Number(navText) === 0 && false));

    if (items) {
        items = items.split(',');

        if (items.length) {
            var itemsCount = items.length;

            for (var i = 0; i < itemsCount; i++) {
                var options = items[i].split('|'),
                    optionsCount = options.length,
                    responsiveKey;

                for (var j = 0; j < optionsCount; j++) {
                    const attr = options[j].indexOf(':') ? options[j].split(':') : options[j];

                    if (attr[0] === 'screen') {
                        responsiveKey = Number(attr[1]);
                    } else if (Number(responsiveKey) >= 0) {
                        responsive[responsiveKey] = {
                            ...responsive[responsiveKey],
                            [attr[0]]: (isNumeric(attr[1]) && Number(attr[1])) ?? attr[1]
                        };
                    }
                }
            }
        }
    }

    if (nav && navText) {
        navText = navText.indexOf('|') > 0 ? navText.split('|') : navText.split(':');
        navText = [navText[0], navText[1]];
    }

    obj.owlCarousel({
        rewind,
        autoplay,
        loop,
        lazyLoad,
        mouseDrag,
        touchDrag,
        smartSpeed,
        autoplaySpeed,
        autoplayTimeout,
        dots,
        nav,
        navText,
        navContainer: nav && navText && navContainer,
        responsiveClass,
        responsiveRefreshRate,
        responsive
    });

    if (autoplay) {
        obj.on('translate.owl.carousel', function (event) {
            obj.trigger('stop.owl.autoplay');
        });

        obj.on('translated.owl.carousel', function (event) {
            obj.trigger('play.owl.autoplay', [autoplayTimeout]);
        });
    }

    if (animations && isExist(obj.find('[owl-item-animation]'))) {
        var animation_now = '';
        var animation_count = 0;
        var animations_excuted = [];
        var animations_list = animations.indexOf(',') ? animations.split(',') : animations;

        obj.on('changed.owl.carousel', function (event) {
            $(this).find('.owl-item.active').find('[owl-item-animation]').removeClass(animation_now);
        });

        obj.on('translate.owl.carousel', function (event) {
            var item = event.item.index;

            if (Array.isArray(animations_list)) {
                var animation_trim = animations_list[animation_count].trim();

                if (!animations_excuted.includes(animation_trim)) {
                    animation_now = 'animate__animated ' + animation_trim;
                    animations_excuted.push(animation_trim);
                    animation_count++;
                }

                if (animations_excuted.length == animations_list.length) {
                    animation_count = 0;
                    animations_excuted = [];
                }
            } else {
                animation_now = 'animate__animated ' + animations_list.trim();
            }
            $(this).find('.owl-item').eq(item).find('[owl-item-animation]').addClass(animation_now);
        });
    }
};
OwlPage = function () {
    if (isExist($('.owl-page'))) {
        $('.owl-page').each(function () {
            OwlData($(this));
        });
    }
};

btnThueClick = function () {
    if (isExist($('.btn-thue-ngay'))) {
        $('.btn-thue-ngay').click(function () {
            var idPhong = $(this).data('id');
            var namePhong = $(this).data('name');
            var typeClick = $(this).data('type');
            var priceTT = $(this).data('giathanhtoan');
            var pricePhong = $(this).data('price');
            $('.btn-accept2').attr('data-id', idPhong);
            $('.box-info-thue-nhanh .thuenhanh-name').text(namePhong);
            $('.box-info-thue-nhanh .thuenhanh-price').text(format_price(pricePhong));
            $('.box-info-thue-nhanh .thuenhanh-pricerq').text(format_price(pricePhong * (20 / 100)));
            $('.giadatnhanh').attr('value', pricePhong);
            $('.datnhanh-id').attr('value', idPhong);
        })
    }
};
datNhanhClick = function () {
    if (isExist($('.btn-dat-ngay'))) {
        $('.btn-dat-ngay').click(function () {
            var idPhong = $(this).data('id');
            var namePhong = $(this).data('name');
            var typeClick = $(this).data('type');
            var priceTT = $(this).data('giathanhtoan');
            var pricePhong = $(this).data('price');
            $('.btn-accept2').attr('data-id', idPhong);
            $('.box-info-thue-nhanh .thuenhanh-name').text(namePhong);
            $('.box-info-thue-nhanh .thuenhanh-price').text(format_price(pricePhong));
            $('.box-info-thue-nhanh .thuenhanh-pricerq').text(format_price(pricePhong * (20 / 100)));
            $('.giadatnhanh').attr('value', pricePhong * (20 / 100));
            if (typeClick == 'thanhtoandt'
            ) {
                $('.giadatnhanh').attr('value', pricePhong - priceTT);
            }
            $('.datnhanh-id').attr('value', idPhong);
        })
    }
};

format_price = function (price) {
    if (price > 0 && price != "Liên hệ") {
        var new_price = new Intl.NumberFormat("vi-VI", {
            maximumSignificantDigits: 3,
        }).format(price);
        return new_price + "đ";
    }
    return price;
};


$('#messages-facebook').one('DOMSubtreeModified', function () {
    $('.js-facebook-messenger-box').on('click', function () {
        $('.js-facebook-messenger-box, .js-facebook-messenger-container').toggleClass('open'),
            $('.js-facebook-messenger-tooltip').length && $('.js-facebook-messenger-tooltip').toggle();
    }),
        $('.js-facebook-messenger-box').hasClass('cfm') &&
        setTimeout(function () {
            $('.js-facebook-messenger-box').addClass('rubberBand animated');
        }, 3500),
        $('.js-facebook-messenger-tooltip').length &&
        ($('.js-facebook-messenger-tooltip').hasClass('fixed')
            ? $('.js-facebook-messenger-tooltip').show()
            : $('.js-facebook-messenger-box').on('hover', function () {
                $('.js-facebook-messenger-tooltip').show();
            }),
            $('.js-facebook-messenger-close-tooltip').on('click', function () {
                $('.js-facebook-messenger-tooltip').addClass('closed');
            }));
    $('.search_open').click(function () {
        $('.search_box_hide').toggleClass('opening');
    });
});
$(document).ready(function () {
    OwlPage();
    btnThueClick();
    datNhanhClick();
});