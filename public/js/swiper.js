let productSwiper = new Swiper(".product-content", {
  loop: true,

  grabCursor: true,

  navigation: {
    nextEl: "#next",
    prevEl: "#prev",
  },

  breakpoints: {
    360: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    430: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    540: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    768: {
      slidesPerView: 1.5,
      spaceBetween: 16,
    },

    912: {
      slidesPerView: 1.5,
      spaceBetween: 16,
    },

    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },

    1280: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});

let order = new Swiper(".order-content", {
  loop: true,

  grabCursor: true,

  navigation: {
    nextEl: "#next2",
    prevEl: "#prev2",
  },

  breakpoints: {
    360: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    430: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    540: {
      slidesPerView: 1,
      spaceBetween: 16,
    },

    768: {
      slidesPerView: 1.5,
      spaceBetween: 16,
    },

    912: {
      slidesPerView: 1.5,
      spaceBetween: 16,
    },

    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },

    1280: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});
