import $ from "jquery";
import barba from "@barba/core";
import gsap, { TweenLite, TweenMax } from "gsap";
import LocomotiveScroll from 'locomotive-scroll';
import slick from 'slick-carousel';
import './marquee.js';
import imagesLoaded from 'imagesLoaded';

let scroll;
let images;
let slicks;


$(document).ready(() => {
  init();
})

loaderStart();
sliders();

function sliders() {
  let slicks = jQuery('.slick').not('.slick-initialized');
  let marquees = jQuery('.lg-slider').not('.started');

  slicks.each(function () {
    $(this).slick({
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 5,
      centerMode: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            centerMode: true,
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
          }
        }
      ]
    });
  });

  marquees.each(function () {
    let that = $(this);
    that.addClass('started')
    that.marquee({
      duplicated: ($(window).width() > 768),
      direction: 'left',
      pauseOnHover: false
    });
  });
}

const navButton = $("#menuBtn");

const init = () => {
  navButton.on("click", function () {
    $(this).toggleClass("open");
    $('body').toggleClass('nav-open');
  });

  $(".sp-nav a").on("click", function () {
    navButton.removeClass("open");
    $('body').removeClass('nav-open');
  });

};

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}


function loaderStart() {
  let copy1 = document.getElementsByClassName("pLoad_copy_line")[0];
  let copy2 = document.getElementsByClassName("pLoad_copy_line")[1];
  let copy3 = document.getElementsByClassName("pLoad_copy_line")[2];

  gsap.fromTo(copy1, {
    x: -100
  }, {
    x: 0,
    duration: 3,
    onStart: function () {
      gsap.to(copy1.getElementsByClassName("jsLoad_item"), {
        x: 0,
        duration: 3
      });
      gsap.to(copy1.getElementsByClassName("jsLoad_item_inner"), {
        x: 0,
        duration: 3
      });
    }
  });

  gsap.fromTo(copy2, {
    x: -100
  }, {
    x: 0,
    duration: 3,
    delay: 0.5,
    onStart: function () {
      gsap.to(copy2.getElementsByClassName("jsLoad_item"), {
        x: 0,
        duration: 3
      });
      gsap.to(copy2.getElementsByClassName("jsLoad_item_inner"), {
        x: 0,
        duration: 3
      });
    },
  });

  gsap.fromTo(copy3, {
    x: -100
  }, {
    x: 0,
    duration: 3,
    delay: 0.7,
    onStart: function () {
      gsap.to(copy3.getElementsByClassName("jsLoad_item"), {
        x: 0,
        duration: 3
      });
      gsap.to(copy3.getElementsByClassName("jsLoad_item_inner"), {
        x: 0,
        duration: 3
      });
    },
    onComplete: function () {
      initImages(jQuery('#app'));
    }
  });

  gsap.fromTo(document.getElementsByClassName("jsLoad_logo"), {
    x: -100
  }, {
    x: 0,
    duration: 3,
    delay: 1,
    onStart: function () {
      gsap.to(document.getElementsByClassName("jsLoad_logo_inner"), {
        x: 0,
        duration: 3,
      });
      gsap.to(document.getElementsByClassName("jsLoad_logo_cover"), {
        x: 0,
        duration: 3,
      });
    }
  });

}


function imagesLoad(container, callback) {
  images = new imagesLoaded(container, sliders);
  images.on('done', callback);
}


function initImages(container) {
  images = new imagesLoaded(container, sliders);
  images.on('done', function () {
    gsap.to(document.getElementsByClassName("jsLoad_progress_item"), {
      x: 0,
      duration: 2
    });
    gsap.to(document.getElementsByClassName("jsLoad_progress_item_inner"), {
      x: 0,
      duration: 2,
      onComplete: function () {
        finishedLoading();
      }
    });
  })
}


function finishedLoading() {
  gsap.to(document.getElementsByClassName("jsLoad_inner_cover"), {
    scaleX: 1, scaleY: 1,
    duration: 1,
    delay: 0.6
  });
  gsap.to(document.getElementsByClassName("jsLoad_container"), {
    x: -100 + '%',
    duration: 1.1,
    delay: 0.7
  });
  gsap.to(document.getElementsByClassName("jsLoad"), {
    x: 100 + '%',
    duration: 1.1,
    delay: 0.7,
    onComplete: function () {
      $('body').addClass('load-complete');
      barba.init({
        timeout: 6000,
        debug: true,
        sync: true,
        transitions: [
          {
            name: "opacity-transition",
            once({ next }) {
              imagesLoad(next.container, smooth(next.container))
              gsap.to(next.container, {
                opacity: 1,
              });
            },
            beforeEnter() {
              images.off();
              scroll.destroy();
            },
            afterEnter({ next }) {
              imagesLoad(next.container, smooth(next.container))
            },
            leave(data) {
              $('body').addClass('reloading');
              return gsap.to(data.current.container, {
                opacity: 0,
              });
            },
            enter(data) {
              sliders()
              return gsap.from(data.next.container, {
                opacity: 0,
              });
            },
          },
        ],
      });

      barba.hooks.beforeLeave((data) => {
        window.scrollTo(0, 0);
      });

      function smooth(container) {
        scroll = new LocomotiveScroll({
          el: container.querySelector('[data-scroll-container]'),
          smooth: true,
          class: 'start',
          offset: ["25%", 0],
        });
        Cf7Init(container);
      }
      sleep(500).then(() => {
        document.getElementsByClassName("jsLoad")[0].remove();
      })
    }
  });
}

function Cf7Init(container) {
  var loader = $(container).find('.ajax-loader');
  if (!loader.length) {
    $('div.wpcf7 > form').each(function () {
      var $form = $(this);
      wpcf7.initForm($form);
      if (wpcf7.cached) {
        wpcf7.refill($form);
      }
    });
  }
}