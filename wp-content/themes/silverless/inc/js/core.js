'use strict';
jQuery(document).ready(function ($) {
  var navHeight = $('.main-nav').outerHeight();

  /* ADD CLASS ON SCROLL DOWN nPX */
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
      $('body').addClass('scrolled');
      $('.main-nav').css('top', '-' + navHeight + 'px');
    } else {
      $('body').removeClass('scrolled');
      $('.main-nav').css('top', '0');
    }
  });
  /* ADD CLASS ON SCROLL UP */
  var c,
    currentScrollTop = 0,
    navbar = $('.main-nav');

  $(window).scroll(function () {
    var a = $(window).scrollTop();
    var b = navbar.height();
    currentScrollTop = a;
    if (c < currentScrollTop && a > b + b) {
      navbar.css('top', '-' + navHeight + 'px');
      navbar.removeClass('solid');
    } else if (c > currentScrollTop && !(a <= b)) {
      navbar.css('top', '0');
      navbar.addClass('solid');
    }
    c = currentScrollTop;
  });

  /* INITIATE SLIDERS */
  $('.hero__slider').slick({
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    prevArrow: $('.hero__navigation__previous'),
    nextArrow: $('.hero__navigation__next')
  });

  $('.card__slider__slick').each(function (index, slider) {
    var prev = $(slider)
      .closest('.card__slider')
      .find('.card__navigation__previous');
    var next = $(slider)
      .closest('.card__slider')
      .find('.card__navigation__next');
    $(slider).slick({
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      prevArrow: $(prev),
      nextArrow: $(next)
    });
  });

  $('.section-carousel .carousel__slider.carousel__card').each(
    function (index, slider) {
      var prev = $(slider)
        .closest('.section-carousel')
        .find('.navigation__previous');
      var next = $(slider)
        .closest('.section-carousel')
        .find('.navigation__next');
      var args = {
        infinite: true,
        speed: 500,
        fade: false,
        slidesToShow: 3,
        cssEase: 'linear',
        prevArrow: $(prev),
        nextArrow: $(next),
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 1
            }
          }
        ]
      };

      $(slider).slick(args);
    }
  );

  $(
    '.section-carousel:not(.sidebar__content__extended) .carousel__slider.carousel__images'
  ).each(function (index, slider) {
    var prev = $(slider)
      .closest('.section-carousel')
      .find('.navigation__previous');
    var next = $(slider).closest('.section-carousel').find('.navigation__next');
    var args = {
      infinite: true,
      speed: 500,
      fade: false,
      centerMode: true,
      centerPadding: 'calc((100vw - 65.625rem) / 2 )',
      slidesToShow: 1,
      cssEase: 'linear',
      prevArrow: $(prev),
      nextArrow: $(next),
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 1
          }
        },
        {
          breakpoint: 900,
          settings: {
            slidesToShow: 1,
            centerPadding: '0'
          }
        }
      ]
    };

    $(slider).slick(args);
  });

  $(
    '.section-carousel.sidebar__content__extended .carousel__slider.carousel__images'
  ).each(function (index, slider) {
    var prev = $(slider)
      .closest('.section-carousel')
      .find('.navigation__previous');
    var next = $(slider).closest('.section-carousel').find('.navigation__next');
    var args = {
      infinite: false,
      speed: 500,
      fade: false,
      slidesToShow: 1.5,
      cssEase: 'linear',
      prevArrow: $(prev),
      nextArrow: $(next),
      responsive: [
        {
          breakpoint: 900,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    };

    $(slider).slick(args);
  });

  $('.testimonials__slider').each(function (index, slider) {
    var prev = $(slider)
      .closest('.section-testimonials')
      .find('.navigation__previous');
    var next = $(slider)
      .closest('.section-testimonials')
      .find('.navigation__next');
    $(slider).slick({
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      prevArrow: $(prev),
      nextArrow: $(next)
    });
  });

  $('.section-image .image__grid .navigation__previous').on(
    'click',
    function () {
      var parent = $(this).closest('.image__grid');
      updateActiveItem(-1, parent, 'a');
    }
  );

  $('.section-image .image__grid .navigation__next').on('click', function () {
    var parent = $(this).closest('.image__grid');
    updateActiveItem(1, parent, 'a');
  });

  function updateActiveItem(update, container, childSelector) {
    var items = $(container).find(childSelector);
    var max = $(items).length - 1;
    var current = $(container).find('.active').index();
    var index = current + update;
    if (index < 0) {
      index = max;
    }
    if (index > max) {
      index = 0;
    }

    $(container).find('a.active').removeClass('active');
    $(items).eq(index).addClass('active');
  }

  /* READ MORE BLOCKS */
  $('.js-read-more-button').on('click', function () {
    var block = $(this).closest('.read-more-block');
    var showing = $(block).hasClass('show');
    if (showing) {
      $(this).text('Read more');
      $(block).find('.ellipsis').show();
      $(block).find('.read-more-content').slideUp();
    } else {
      $(this).text('Read less');
      $(block).find('.ellipsis').hide();
      $(block).find('.read-more-content').slideDown();
    }
    $(block).toggleClass('show');
  });

  /* LOAD MORE IMAGES */
  $('.js-load-more').on('click', function () {
    $(this).closest('.section-image-gallery').find('.additional').slideDown();
    $(this).hide();
  });

  /* VIDEOS */
  $('.section-video').on('click', '.play-button .play', function () {
    var video = $(this).closest('.section-video').find('video');
    video.get(0).play();
    $(video).attr('controls', '');
    $(video).removeClass('fade');
    $(this).parent().hide();
  });

  /* SCROLL TO NEXT SECTION */
  $('body').on('click', '.js_scroll-next-section', function (e) {
    e.preventDefault();
    var $currentSection = $(this).closest('section');
    var $nextSection = $currentSection.next('section');
    var $nextdiv = $currentSection.next('div');
    if ($nextSection.length > 0) {
      $nextSection[0].scrollIntoView({ behavior: 'smooth' });
    }
    if ($nextdiv.length > 0) {
      $nextdiv[0].scrollIntoView({ behavior: 'smooth' });
    }
  });

  /* MENU */
  $('header').on('click', '.mobile-burger', function () {
    $('header').addClass('mobile-menu-open');
  });

  $('header').on('click', '.menu-close svg', function () {
    $('header').removeClass('mobile-menu-open');
    $('.sub-menu').removeClass('show');
    $('.offcanvas-menu--pre').removeClass('active');
    $('.offcanvas-menu--pre-prep').removeClass('active');
  });

  $('header .menu-item.menu-item-has-children').each(function () {
    var self = $(this);
    var clone = $(self).clone();
    $(clone).removeClass(
      'menu-item-has-children current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor'
    );
    $(clone).attr('id', `sub-${$(clone).attr('id')}`);
    $(clone).find('.sub-menu').remove();
    $(self).find('.sub-menu').prepend(clone);
  });

  $('header').on('click', '.menu-item a', function (e) {
    var menuItem = $(this).closest('.menu-item');
    if ($(menuItem).hasClass('menu-item-has-children')) {
      e.preventDefault();
      $('.sub-menu').removeClass('show');
      $('.menu-item a').removeClass('show');
      $(this).addClass('show');
      $(this).next('.sub-menu').addClass('show');
    }
  });

  /* TIMELINE */
  $('.timeline-wrapper').on(
    'click',
    '.timeline-event__details .label',
    function () {
      var self = this;
      $(self)
        .closest('.timeline-wrapper')
        .find('.expanded')
        .removeClass('expanded')
        .next()
        .slideUp(500);
      $(self).toggleClass('expanded');
      $(self)
        .next()
        .slideToggle(500, function () {
          $('html,body').animate(
            {
              scrollTop: $(self).offset().top - 130
            },
            500
          );
        });
    }
  );

  /* ACCORDION */
  $('.section-accordion').on(
    'click',
    '.accordion__heading:not(.expanded)',
    function () {
      var self = this;
      $(self)
        .closest('.section-accordion')
        .find('.expanded')
        .removeClass('expanded')
        .next()
        .slideUp(500);
      $(self).toggleClass('expanded');
      $(self)
        .next()
        .slideToggle(500, function () {
          $('html,body').animate(
            {
              scrollTop: $(self).offset().top - 130
            },
            500
          );
        });
    }
  );

  /* TABBED CONTENT */
  $('.tabbed-content').on('click', '.tabbed-content__tab', function (e) {
    if (window.outerWidth <= 900) {
      e.preventDefault();
      var tabs = $(this).closest('.tabbed-content__tabs');
      if ($(tabs).hasClass('expanded')) {
        $(tabs).removeClass('expanded');
        $(tabs).find('.tabbed-content__tab').not($(this)).slideUp(300);
        setTimeout(() => selectTab(this), 320);
      } else {
        $(tabs)
          .find('.tabbed-content__tab')
          .slideDown({
            start: function () {
              $(this).css('display', 'grid');
            }
          });
        $(tabs).addClass('expanded');
      }
    } else {
      selectTab(this);
    }
  });

  function selectTab(self) {
    if (!$(self).hasClass('active')) {
      var parent = $(self).closest('.tabbed-content');
      var index = $(self).data('tab');
      $(parent).find('.tabbed-content__tab').removeClass('active');
      $(self).addClass('active');
      $(parent).find('.tabbed-content__content').slideUp();
      $(parent)
        .find(`.tabbed-content__content[data-tab="${index}"]`)
        .slideDown();
      $(parent)
        .find(`.tabbed-content__content-container`)
        .get(0)
        .scrollIntoView({ behavior: 'smooth' });
    }
  }

  /* SIDEBAR MOBILE NAVIGATION */
  $('.sidebar__navigation').on('click', '.current-menu-item', function (e) {
    if (window.outerWidth <= 900) {
      e.preventDefault();
      var parent = $(this).closest('.sidebar__navigation');
      $(parent).find('.menu-item').not($(this)).slideToggle();
    }
  });

  /* ANIMATIONS */
  $('body').addClass('js-on');

  function handleIntersection(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        $(entry.target).removeClass('hidden').addClass('visible');
      } else {
        $(entry.target).removeClass('visible').addClass('hidden');
      }
    });
  }

  // Create an Intersection Observer
  const observer = new IntersectionObserver(handleIntersection, {
    threshold: 0.5
  });

  // Target elements to observe
  const targetElements = $('.fm-above, .fm-left, .fm-right');

  // Start observing each target element
  targetElements.each(function (index, element) {
    observer.observe(element);
  });

  /* SIDEBAR FILTERS */

  var containerEl = document.querySelector('.card__posts');
  var checkboxGroup = document.querySelector('.sidebar__filter');

  if (containerEl && checkboxGroup) {
    var checkboxes = checkboxGroup.querySelectorAll('input[type="checkbox"]');

    var paginationData = containerEl.dataset.pagination;

    var settings = {};

    if (paginationData) {
      settings = {
        pagination: {
          limit: paginationData
        },
        templates: {
          pagerPrev:
            '<button type="button" class="${classNames}" data-page="prev">Prev</button>',
          pagerNext:
            '<button type="button" class="${classNames}" data-page="next">Next</button>'
        }
      };
    }

    // eslint-disable-next-line no-undef
    var mixer = mixitup(containerEl, settings);

    checkboxGroup.addEventListener('change', function () {
      var selectors = [];

      for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];

        if (checkbox.checked) selectors.push(`.${checkbox.value}`);
      }

      var selectorString = selectors.length > 0 ? selectors.join(',') : 'all';

      mixer.filter(selectorString);
    });
  }

  function getTimeRemaining(targetDate) {
    const now = new Date();
    const diff = targetDate - now;

    const days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(
      2,
      '0'
    );
    const hours = String(Math.floor((diff / (1000 * 60 * 60)) % 24)).padStart(
      2,
      '0'
    );
    const minutes = String(Math.floor((diff / 1000 / 60) % 60)).padStart(
      2,
      '0'
    );

    return {
      diff,
      days,
      hours,
      minutes
    };
  }

  function initializeClock(targetDate, display) {
    function updateClock() {
      const t = getTimeRemaining(targetDate);
      $(display).find('.countdown__display__days .value').html(t.days);
      $(display).find('.countdown__display__hours .value').html(t.hours);
      $(display).find('.countdown__display__minutes .value').html(t.minutes);

      if (t.diff <= 0 && timeinterval) {
        clearInterval(timeinterval);
        $(display).find('.countdown__display__days .value').html('00');
        $(display).find('.countdown__display__hours .value').html('00');
        $(display).find('.countdown__display__minutes .value').html('00');
      }
    }

    updateClock();
    const timeinterval = setInterval(updateClock, 1 * 60 * 1000);
  }

  /* COUNTDOWN */
  $('.section-countdown').each(function () {
    var section = $(this);
    var display = $(section).find('.countdown__display');
    if (display) {
      var target = $(display).data('target');
      var targetDate = new Date(target);
      initializeClock(targetDate, display);
    }
  });

  $('.hero .play-container > *').on('click', function (e) {
    e.preventDefault();
    const video_id = $(this).closest('.play-container').data('video-id');
    $(`.hero-video-modal[data-video-id='${video_id}']`).addClass('show');
    $(`.hero-video-modal[data-video-id='${video_id}'] > video`).trigger('play');
  });

  $('.hero-video-modal .close').on('click', function (e) {
    e.preventDefault();
    $(this).closest('.hero-video-modal').removeClass('show');
    $(this).closest('.hero-video-modal').find('video').trigger('pause');
    $(this).closest('.hero-video-modal').find('video').get(0).currentTime = 0;
  });
});

// Select all elements with class 'heading'
const headings = document.querySelectorAll('.heading__xxl, .heading__xl');

// Callback function to handle intersection
function handleIntersection(entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('in-view');
    } else {
      //entry.target.classList.remove('in-view');
    }
  });
}

// Intersection Observer instance
const observer = new IntersectionObserver(handleIntersection, {
  root: null, // Use the viewport as the root
  threshold: 0.5 // Trigger when 50% of the element is visible
});

// Observe each heading element
headings.forEach((heading) => {
  observer.observe(heading);
});

document.addEventListener('DOMContentLoaded', function () {
  // Get the trigger elements
  var preTriggers = document.querySelectorAll('.pre-trigger');
  var prepTrigger = document.querySelector('.prep-trigger');
  var contactTrigger = document.querySelector('.contact-trigger');
  var aboutTrigger = document.querySelector('.about-trigger');

  // Get the off-canvas elements
  var offCanvas = document.querySelector('.offcanvas-menu--pre');
  var offCanvasPrep = document.querySelector('.offcanvas-menu--pre-prep');
  var offCanvasContact = document.querySelector('.offcanvas-menu--contact');
  var offCanvasAbout = document.querySelector('.offcanvas-menu--about');
  // Get the menu-close-sub elements
  var menuCloseSubs = document.querySelectorAll('.menu-close-sub');

  // Function to remove 'active' class from all off-canvas menus
  function removeActiveClass() {
    offCanvas.classList.remove('active');
    offCanvasPrep.classList.remove('active');
    offCanvasContact.classList.remove('active');
    offCanvasAbout.classList.remove('active');
  }

  // Add click event listener to the pre-trigger elements
  preTriggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      // Prevent the default action of the link

      // Add the 'active' class to the off-canvas element
      offCanvas.classList.add('active');

      // Remove 'active' class from other off-canvas menu
      offCanvasPrep.classList.remove('active');
    });
  });

  // Add click event listener to the prep-trigger element
  prepTrigger.addEventListener('click', function () {
    // Prevent the default action of the link

    // Add the 'active' class to the off-canvas prep element
    offCanvasPrep.classList.add('active');

    // Remove 'active' class from other off-canvas menu
    offCanvas.classList.remove('active');
  });

  // // Add click event listener to the contact-trigger element
  // contactTrigger.addEventListener('click', function () {
  //   // Prevent the default action of the link

  //   // Add the 'active' class to the off-canvas contact element
  //   offCanvasContact.classList.add('active');

  //   // Remove 'active' class from other off-canvas menu
  //   offCanvas.classList.remove('active');
  // });

  // // Add click event listener to the about-trigger element
  // aboutTrigger.addEventListener('click', function () {
  //   // Prevent the default action of the link

  //   // Add the 'active' class to the off-canvas contact element
  //   offCanvasAbout.classList.add('active');

  //   // Remove 'active' class from other off-canvas menu
  //   offCanvas.classList.remove('active');
  // });

  // Add click event listener to the menu-close-sub elements
  menuCloseSubs.forEach(function (menuCloseSub) {
    menuCloseSub.addEventListener('click', function (event) {
      // Prevent the default action of the link
      event.preventDefault();
      // Remove 'active' class from all off-canvas menus
      removeActiveClass();
    });
  });
});
