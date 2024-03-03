/*===== MENU SHOW =====*/
const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId);

  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      nav.classList.toggle("show");
    });
  }
};
showMenu("nav-toggle", "nav-menu");

/*===== REMOVE MENU MOBILE =====*/
const navLink = document.querySelectorAll(".nav__link");

function linkAction() {
  const navMenu = document.getElementById("nav-menu");
  navMenu.classList.remove("show");
}
navLink.forEach((n) => n.addEventListener("click", linkAction));

/*===== SCROLL SECTIONS ACTIVE LINK =====*/
const sections = document.querySelectorAll("section[id]");

window.addEventListener("scroll", scrollActive);

function scrollActive() {
  const scrollY = window.pageYOffset;

  sections.forEach((current) => {
    const sectionHeight = current.offsetHeight;
    const sectionTop = current.offsetTop - 50;
    sectionId = current.getAttribute("id");

    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      document
        .querySelector(".nav__menu a[href*=" + sectionId + "]")
        .classList.add("active");
    } else {
      document
        .querySelector(".nav__menu a[href*=" + sectionId + "]")
        .classList.remove("active");
    }
  });
}

/*===== SCROLL REVEAL ANIMATION =====*/
const sr = ScrollReveal({
  origin: "top",
  distance: "80px",
  duration: 2000,
  reset: true,
});

/*SCROLL HOME*/
sr.reveal(".home__title", {});
sr.reveal(".home__scroll", { delay: 200 });
sr.reveal(".home__img", { origin: "right", delay: 400 });

/*SCROLL ABOUT*/
sr.reveal(".about__img", { delay: 500 });
sr.reveal(".about__subtitle", { delay: 300 });
sr.reveal(".about__profession", { delay: 400 });
sr.reveal(".about__text", { delay: 500 });
sr.reveal(".about__social-icon", { delay: 600, interval: 200 });

/*SCROLL PORTFOLIO*/
sr.reveal(".portfolio__img", { interval: 200 });

/*SCROLL CONTACT*/
sr.reveal(".contact__subtitle", {});
sr.reveal(".contact__text", { interval: 200 });
sr.reveal(".contact__input", { delay: 400 });
sr.reveal(".contact__button", { delay: 600 });

/*COMPUTER GRAPHIC JAVASCRIPT IMPPLEMENTATION*/

var myCanv7 = document.getElementById("myCanvas");
var context7 = myCanv7.getContext("2d");

context7.beginPath();
context7.moveTo(180, 170);
context7.lineTo(140, 60);
context7.lineTo(205, 125);
context7.fillStyle = "#F02B72";
context7.fill();

context7.beginPath();
context7.moveTo(105, 115);
context7.lineTo(85, 185);
context7.lineTo(205, 125);
context7.fillStyle = "#F02B72";
context7.fill();

context7.beginPath();
context7.moveTo(140, 60);
context7.lineTo(65, 145);
context7.lineTo(205, 170);
context7.fillStyle = "#F49092";
context7.fill();

context7.beginPath();
context7.moveTo(85, 185);
context7.lineTo(65, 145);
context7.lineTo(205, 170);
context7.fillStyle = "#2A3B47";
context7.fill();

context7.beginPath();
context7.moveTo(85, 185);
context7.lineTo(105, 115);
context7.lineTo(205, 170);
context7.fillStyle = "#F02B72";
context7.fill();

// by
// abubakersaeed.netlify.com | @AbubakerSaeed96
// ============================================

// Inspiration:
// Tilt.js: https://gijsroge.github.io/tilt.js/
// Andy Merskin's parallax depth cards pen: https://codepen.io/andymerskin/full/XNMWvQ/

// Thank You for Viewing

class parallaxTiltEffect {
  constructor({ element, tiltEffect }) {
    this.element = element;
    this.container = this.element.querySelector(".container");
    this.size = [300, 360];
    [this.w, this.h] = this.size;

    this.tiltEffect = tiltEffect;

    this.mouseOnComponent = false;

    this.handleMouseMove = this.handleMouseMove.bind(this);
    this.handleMouseEnter = this.handleMouseEnter.bind(this);
    this.handleMouseLeave = this.handleMouseLeave.bind(this);
    this.defaultStates = this.defaultStates.bind(this);
    this.setProperty = this.setProperty.bind(this);
    this.init = this.init.bind(this);

    this.init();
  }

  handleMouseMove(event) {
    const { offsetX, offsetY } = event;

    let X;
    let Y;

    if (this.tiltEffect === "reverse") {
      X = (offsetX - this.w / 2) / 3 / 3;
      Y = -(offsetY - this.h / 2) / 3 / 3;
    } else if (this.tiltEffect === "normal") {
      X = -(offsetX - this.w / 2) / 3 / 3;
      Y = (offsetY - this.h / 2) / 3 / 3;
    }

    this.setProperty("--rY", X.toFixed(2));
    this.setProperty("--rX", Y.toFixed(2));

    this.setProperty("--bY", 80 - (X / 4).toFixed(2) + "%");
    this.setProperty("--bX", 50 - (Y / 4).toFixed(2) + "%");
  }

  handleMouseEnter() {
    this.mouseOnComponent = true;
    this.container.classList.add("container--active");
  }

  handleMouseLeave() {
    this.mouseOnComponent = false;
    this.defaultStates();
  }

  defaultStates() {
    this.container.classList.remove("container--active");
    this.setProperty("--rY", 0);
    this.setProperty("--rX", 0);
    this.setProperty("--bY", "80%");
    this.setProperty("--bX", "50%");
  }

  setProperty(p, v) {
    return this.container.style.setProperty(p, v);
  }

  init() {
    this.element.addEventListener("mousemove", this.handleMouseMove);
    this.element.addEventListener("mouseenter", this.handleMouseEnter);
    this.element.addEventListener("mouseleave", this.handleMouseLeave);
  }
}

const $ = (e) => document.querySelector(e);

const wrap1 = new parallaxTiltEffect({
  element: $(".wrap--1"),
  tiltEffect: "reverse",
});

const wrap2 = new parallaxTiltEffect({
  element: $(".wrap--2"),
  tiltEffect: "normal",
});

const wrap3 = new parallaxTiltEffect({
  element: $(".wrap--3"),
  tiltEffect: "reverse",
});

// CHROME PLS :| Everything else is just ridiculously slow (mostly because of the shadowBlur prop)
(function () {
  var regular_stars = [],
    falling_star;

  var R = Math.PI / 5;
  var G = 1.3;
  var TOTAL = 25;
  var SIZE = 3.5;
  var CURVE = 0.25;
  var ENERGY = 0.01;
  var FALLING_CHANCE = 0.2;

  var canvas = document.querySelector("canvas");
  var cx = canvas.getContext("2d");
  //canvas.style.backgroundColor = '#000822';
  resizeViewport();

  function Star() {
    this.r = Math.random() * SIZE * SIZE + SIZE;
    this.rp = Math.PI / Math.random();
    this.rd = Math.random() * 2 - 1;
    this.c = Math.random() * (CURVE * 2 - CURVE) + CURVE;
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;
    this.e = 0;
    this.d = false;
  }

  function FallingStar() {
    Star.call(this);
    this.y = (Math.random() * canvas.height) / 2;
    this.r = Math.random() * SIZE * SIZE + SIZE * 3;
    this.falling = false;
  }

  function setShape(p) {
    var o = p.o;
    cx.save();
    cx.beginPath();
    cx.translate(o.x, o.y);
    cx.rotate(o.rp);
    o.rp += o.rd * 0.01;
    cx.moveTo(0, 0 - o.r);
    for (var i = 0; i < 5; i++) {
      cx.rotate(R);
      cx.lineTo(0, 0 - o.r * o.c);
      cx.rotate(R);
      cx.lineTo(0, 0 - o.r);
    }
  }

  function drawShape() {
    cx.stroke();
    cx.fill();
    cx.restore();
  }

  Star.prototype.shine = function () {
    this.d ? (this.e -= (ENERGY * this.r) / 50) : (this.e += ENERGY);
    if (this.e > 1 - ENERGY && this.d === false) {
      this.d = true;
    }
    setShape({
      o: this,
    });
    cx.strokeStyle = "rgba(255, 209, 143, " + this.e + ")";
    cx.shadowColor = "rgba(255, 209, 143, " + this.e + ")";
    cx.fillStyle = "rgba(255, 209, 143, " + this.e + ")";
    cx.lineWidth = this.c * 2;
    cx.shadowBlur = this.r / SIZE;
    cx.shadowOffsetX = 0;
    cx.shadowOffsetY = 0;
    drawShape();
  };

  FallingStar.prototype.shine = function () {
    this.d ? (this.e -= (ENERGY * this.r) / 25) : (this.e += ENERGY * 5);
    if (this.e > 1 - ENERGY && this.d === false) {
      this.d = true;
    }
    setShape({
      o: this,
    });
    cx.strokeStyle = "rgba(221, 19, 255, " + this.e * 2 + ")";
    cx.shadowColor = "rgba(221, 19, 255, " + this.e * 2 + ")";
    cx.fillStyle = "rgba(221, 19, 255, " + this.e * 2 + ")";
    cx.lineWidth = this.c * 2;
    cx.shadowBlur = 50;
    cx.shadowOffsetX = 0;
    cx.shadowOffsetY = 0;
    drawShape();
  };

  FallingStar.prototype.fall = function () {
    this.e -= ENERGY * 0.5;
    this.r -= this.r * ENERGY;
    cx.save();
    cx.translate(this.x + this.vx, this.y + this.vy);
    cx.scale(1, Math.pow(this.e, 2));
    cx.beginPath();
    cx.rotate(this.rp);
    this.rp += 0.1;
    cx.moveTo(0, 0 - this.r);
    for (var i = 0; i < 5; i++) {
      cx.rotate(R);
      cx.lineTo(0, 0 - this.r * this.c);
      cx.rotate(R);
      cx.lineTo(0, 0 - this.r);
    }
    this.vx += this.vx;
    this.vy += this.vy * G;
    cx.strokeStyle = "rgba(255, 210, 93, " + 1 / this.e + ")";
    cx.shadowColor = "rgba(255, 210, 93, " + 1 / this.e + ")";
    cx.fillStyle = "rgba(255, 210, 93, " + 1 / this.e + ")";
    cx.shadowBlur = 100;
    drawShape();
  };

  function redrawWorld() {
    resizeViewport();
    cx.clearRect(0, 0, canvas.width, canvas.height);
    if (regular_stars.length < TOTAL) regular_stars.push(new Star());
    for (var i = 0; i < regular_stars.length; i++) {
      regular_stars[i].shine();
      if (regular_stars[i].d === true && regular_stars[i].e < 0) {
        regular_stars.splice(i, 1);
      }
    }
    if (!falling_star && FALLING_CHANCE > Math.random()) {
      falling_star = new FallingStar();
    }
    if (falling_star) {
      falling_star.falling ? falling_star.fall() : falling_star.shine();
      if (falling_star.e < ENERGY) {
        falling_star = null;
      }
    }
    requestAnimationFrame(redrawWorld, canvas);
  }

  function resizeViewport() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function mouseMove(e) {
    if (falling_star) {
      if (
        e.clientX > falling_star.x - 2 * falling_star.r &&
        e.clientX < falling_star.x + 2 * falling_star.r &&
        e.clientY > falling_star.y - 2 * falling_star.r &&
        e.clientY < falling_star.y + 2 * falling_star.r
      ) {
        if (!falling_star.falling) {
          falling_star.falling = true;
          falling_star.e = 1;
          falling_star.r *= 2;
          falling_star.vy = 0.001;
          if (e.clientX > canvas.width / 2) {
            falling_star.vx = -(Math.random() * 0.01 + 0.01);
          } else {
            falling_star.vx = Math.random() * 0.01 + 0.01;
          }
        }
      }
    }
  }

  document.addEventListener("resize", resizeViewport, false);
  canvas.addEventListener("mousemove", mouseMove, false);
  canvas.addEventListener("touchstart", mouseMove, false);
  redrawWorld();
})();


