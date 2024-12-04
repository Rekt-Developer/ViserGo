"user strict";

// Preloader
$(window).on("load", function () {
  $(".preloader").fadeOut(1000);
});

// ============== Header Hide Click On Body Js Start ========
$(".header-button").on("click", function () {
  $(".body-overlay").toggleClass("show");
});
$(".body-overlay").on("click", function () {
  $(".header-button").trigger("click");
  $(this).removeClass("show");
});
// =============== Header Hide Click On Body Js End =========

// ========================= Header Sticky Js Start ==============
$(window).on("scroll", function () {
  if ($(window).scrollTop() >= 200) {
    $(".header").addClass("fixed-header");
  } else {
    $(".header").removeClass("fixed-header");
  }
});
// ========================= Header Sticky Js End===================

//============================ Scroll To Top Icon Js Start =========
var btn = $(".scroll-top");

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass("show");
  } else {
    btn.removeClass("show");
  }
});

btn.on("click", function (e) {
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "300");
});
//========================= Scroll To Top Icon Js End ======================

$(".testimonial-slider").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
  // autoplay: true,
  pauseOnHover: true,
  centerMode: false,
  dots: true,
  arrows: false,
  nextArrow: '<i class="las la-arrow-right arrow-right"></i>',
  prevArrow: '<i class="las la-arrow-left arrow-left"></i> ',
  responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      },
    },

    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

// ================== Password Show Hide Js Start ==========
$(".toggle-password").on("click", function () {
  $(this).toggleClass(" fa-eye-slash");
  var input = $($(this).attr("id"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
// =============== Password Show Hide Js End =================

$(".top-investor-slider").slick({
  // fade: false,
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
  autoplay: true,
  pauseOnHover: true,
  centerMode: false,
  dots: false,
  arrows: false,
  responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 450,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});

// $(function () {
//   const second = 1000,
//     minute = second * 60,
//     hour = minute * 60,
//     day = hour * 24;

//   let today = new Date(),
//     dd = String(today.getDate()).padStart(2, "0"),
//     mm = String(today.getMonth() + 1).padStart(2, "0"),
//     yyyy = today.getFullYear(),
//     nextYear = yyyy + 1,
//     dayMonth = "09/30/",
//     birthday = dayMonth + yyyy;

//   today = mm + "/" + dd + "/" + yyyy;
//   if (today > birthday) {
//     birthday = dayMonth + nextYear;
//   }

//   const countdownElements = $(".countdown-item"),
//     daysElement = $(".days"),
//     hoursElement = $(".hours"),
//     minutesElement = $(".minutes"),
//     secondsElement = $(".seconds");

//   const countDown = new Date(birthday).getTime();

//   function updateCountdown() {
//     const now = new Date().getTime(),
//       distance = countDown - now;
//     daysElement.text(Math.floor(distance / day));
//     hoursElement.text(Math.floor((distance % day) / hour));
//     minutesElement.text(Math.floor((distance % hour) / minute));
//     secondsElement.text(Math.floor((distance % minute) / second));
//     requestAnimationFrame(updateCountdown);
//   }

//   updateCountdown();
// });

//==================== countdown js end here ====================

//====== quantity cart css start here ==============
$(document).ready(function () {
  const minus = $(".qtyminus");
  const plus = $(".qtyplus");
  const input = $(".qty input");
  minus.click(function (e) {
    e.preventDefault();
    var value = input.val();
    if (value > 1) {
      value--;
    }
    input.val(value);
  });

  plus.click(function (e) {
    e.preventDefault();
    var value = input.val();
    value++;
    input.val(value);
  });
});

// table cart js
const productQty = $(".product-qty");
productQty.each(function () {
  const qtyIncrement = $(this).find(".product-qty__increment");
  const qtyDecrement = $(this).find(".product-qty__decrement");
  let qtyValue = $(this).find(".qty-value");
  qtyIncrement.on("click", function () {
    var oldValue = parseFloat(qtyValue.val());
    var newVal = oldValue + 1;
    qtyValue.val(newVal).trigger("change");
  });
  qtyDecrement.on("click", function () {
    var oldValue = parseFloat(qtyValue.val());
    if (oldValue <= 0) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    qtyValue.val(newVal).trigger("change");
  });
});

//====== quantity cart css end here ===============

//============== competition details slider js start here ==============
$(".competition-details__wrapper").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  fade: true,
  asNavFor: ".competition-details__gallery",
  prevArrow:
    '<button type="button" class="slick-prev gig-details-thumb-arrow"><i class="las la-long-arrow-alt-left"></i></button>',
  nextArrow:
    '<button type="button" class="slick-next gig-details-thumb-arrow"><i class="las la-long-arrow-alt-right"></i></button>',
});
$(".competition-details__gallery").slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: ".competition-details__wrapper",
  dots: false,
  arrows: false,

  focusOnSelect: true,
  prevArrow:
    '<button type="button" class="slick-prev gig-details-arrow"><i class="las la-long-arrow-alt-left"></i></button>',
  nextArrow:
    '<button type="button" class="slick-next gig-details-arrow"><i class="las la-long-arrow-alt-right"></i></button>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 340,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
//============== competition details slider js end here ==============

// function competitionProduct() {
//   setTimeout(() => {
//     $(".competition-details__ticket-range").slick({
//       // fade: true,
//       slidesToShow: 8,
//       slidesToScroll: 1,
//       infinite: true,
//       // autoplay: true,
//       pauseOnHover: true,
//       centerMode: false,
//       dots: false,
//       arrows: true,
//       nextArrow: '<i class="las la-angle-right arrow-right"></i>',
//       prevArrow: '<i class="las la-angle-left arrow-left"></i> ',
//       responsive: [
//         {
//           breakpoint: 1200,
//           settings: {
//             slidesToShow: 6,
//             slidesToScroll: 1,
//           },
//         },
//         {
//           breakpoint: 991,
//           settings: {
//             slidesToShow: 5,
//             slidesToScroll: 1,
//           },
//         },
//         {
//           breakpoint: 768,
//           settings: {
//             slidesToShow: 4,
//             slidesToScroll: 1,
//           },
//         },
//         {
//           breakpoint: 460,
//           settings: {
//             slidesToShow: 3,
//             slidesToScroll: 1,
//           },
//         },
//         {
//           breakpoint: 400,
//           settings: {
//             slidesToShow: 2,
//             slidesToScroll: 1,
//           },
//         },
//       ],
//     });
//   }, 200);
// }

// let isCalledSick = null;
// $("#pills-history-tab").on("click", function () {
//   if (!isCalledSick) {
//     competitionProduct();
//     isCalledSick = true;
//   }
// });

$(".competition-details__ticket-range").slick({
  // fade: true,
  slidesToShow: 8,
  slidesToScroll: 1,
  infinite: true,
  // autoplay: true,
  pauseOnHover: true,
  centerMode: false,
  dots: false,
  arrows: true,
  nextArrow: '<i class="las la-angle-right arrow-right"></i>',
  prevArrow: '<i class="las la-angle-left arrow-left"></i> ',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 460,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 400,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});

// ================== Sidebar Menu Js Start ===============
// Sidebar Dropdown Menu Start
$(".has-dropdown > a").on("click", function () {
  $(".sidebar-submenu").slideUp(200);
  if ($(this).parent().hasClass("active")) {
    $(".has-dropdown").removeClass("active");
    $(this).parent().removeClass("active");
  } else {
    $(".has-dropdown").removeClass("active");
    $(this).next(".sidebar-submenu").slideDown(200);
    $(this).parent().addClass("active");
  }
});
// Sidebar Dropdown Menu End
// Sidebar Icon & Overlay js
$(".dashboard-body__bar-icon").on("click", function () {
  $(".sidebar-menu").addClass("show-sidebar");
  $(".body-overlay").addClass("show");
});
$(".sidebar-menu__close, .body-overlay").on("click", function () {
  $(".sidebar-menu").removeClass("show-sidebar");
  $(".body-overlay").removeClass("show");
});
// Sidebar Icon & Overlay js
// ===================== Sidebar Menu Js End =================

// ==================== Dashboard User Profile Dropdown Start ==================
$(".user-info__button").on("click", function (event) {
  event.stopPropagation(); // Prevent the click event from propagating to the body
  $(".user-info-dropdown").toggleClass("show");
});

$(".user-info-dropdown__link").on("click", function (event) {
  event.stopPropagation(); // Prevent the click event from propagating to the body
  $(".user-info-dropdown").addClass("show");
});

$("body").on("click", function () {
  $(".user-info-dropdown").removeClass("show");
});
// ==================== Dashboard User Profile Dropdown End ==================

/*==================== custom dropdown select js ====================*/
$(".custom--dropdown > .custom--dropdown__selected").on("click", function () {
  $(this).parent().toggleClass("open");
});
$(".custom--dropdown > .dropdown-list > .dropdown-list__item").on(
  "click",
  function () {
    $(".custom--dropdown > .dropdown-list > .dropdown-list__item").removeClass(
      "selected"
    );
    $(this)
      .addClass("selected")
      .parent()
      .parent()
      .removeClass("open")
      .children(".custom--dropdown__selected")
      .html($(this).html());
  }
);
$(document).on("keyup", function (evt) {
  if ((evt.keyCode || evt.which) === 27) {
    $(".custom--dropdown").removeClass("open");
  }
});
$(document).on("click", function (evt) {
  if (
    $(evt.target).closest(".custom--dropdown > .custom--dropdown__selected")
      .length === 0
  ) {
    $(".custom--dropdown").removeClass("open");
  }
});

/*=============== custom dropdown select js end =================*/

// ==================== Custom Sidebar Dropdown Menu Js Start ==================
$(".has-submenu").on("click", function (event) {
  event.preventDefault(); // Prevent the default anchor link behavior

  // Check if this submenu is currently visible
  var isOpen = $(this).find(".sidebar-submenu").is(":visible");

  // Hide all submenus initially
  $(".sidebar-submenu").slideUp();

  // Remove the "active" class from all li elements
  $(".sidebar-menu__item").removeClass("active");

  // If this submenu was not open, toggle its visibility and add the "active" class to the clicked li
  if (!isOpen) {
    $(this).find(".sidebar-submenu").slideToggle(500);
    $(this).addClass("active");
  }
});
// ==================== Custom Sidebar Dropdown Menu Js End ==================

//Faq js
$(".faq-item__title").on("click", function (e) {
  var element = $(this).parent(".faq-item");
  if (element.hasClass("open")) {
    element.removeClass("open");
    element.find(".faq-item__content").removeClass("open");
    element.find(".faq-item__content").slideUp(300, "swing");
  } else {
    element.addClass("open");
    element.children(".faq-item__content").slideDown(300, "swing");
    element
      .siblings(".faq-item")
      .children(".faq-item__content")
      .slideUp(300, "swing");
    element.siblings(".faq-item").removeClass("open");
    element
      .siblings(".faq-item")
      .find(".faq-item__content")
      .slideUp(300, "swing");
  }
});

//  ===================================03. Card Delete Js Start Here ===========================
// $(".clear-btn").on("click", function () {
//   $(this).closest(".cart-item").addClass("d-none");
// });
//  =================================== Card Delete Js End Here ===========================
// ========================14. tooltip js start here ==================
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
//======================== tooltip end here =======================

// ========================= Odometer Counter Up Js End ==========
$(".counterup-item").each(function () {
  $(this).isInViewport(function (status) {
    if (status === "entered") {
      for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
        var el = document.querySelectorAll(".odometer")[i];
        el.innerHTML = el.getAttribute("data-odometer-final");
      }
    }
  });
});
// ========================= Odometer Up Counter Js End =====================

$(document).ready(function () {
  // Event listener for file input change
  $("#image").on("change", function () {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      // Read the image file as a data URL
      reader.onload = function (e) {
        // Update the background image of the preview div
        $(".profilePicPreview").css(
          "background-image",
          "url(" + e.target.result + ")"
        );
      };

      // Trigger the file reading
      reader.readAsDataURL(input.files[0]);
    }
  });
});

let inputField = $("#update-photo");
let uploadImg = $("#upload-img");

inputField.on("change", function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      const result = reader.result;
      uploadImg.attr("src", result);
    };
    reader.readAsDataURL(file);
  }
});
