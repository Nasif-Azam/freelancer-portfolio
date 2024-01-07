"use strict"

// ========================================
// Navigation 
// ========================================
const menu_toggler = document.querySelector(".menu_toggler");
const top_nav = document.querySelector(".top_nav");
const nav_link = document.querySelectorAll(".nav_link");

menu_toggler.addEventListener("click", () =>{
  menu_toggler.classList.toggle("open");
  top_nav.classList.toggle("open");  
});
// using forEach
nav_link.forEach((elem)=> elem.addEventListener("click", () =>{
  menu_toggler.classList.toggle("open");
  top_nav.classList.toggle('open');
}));
// ========================================
// End Navigation 
// ========================================

// ========================================
// Sticky Navigation 
// ========================================
window.addEventListener("scroll", ()=> {
  var nav = document.querySelector(".header");
  nav.classList.toggle("sticky", window.scrollY > 300);
});
// ========================================
// End Sticky Navigation 
// ========================================

// ========================================
// Portfolio Filter Component
// ========================================
const work_buttons = document.querySelector(".work-buttons");
const button = document.querySelectorAll(".p-btn");
const img_overlay = document.querySelectorAll(".img-overlay");
if (work_buttons){
  work_buttons.addEventListener("click", (e) => {
    const button_clicked = e.target;
    if (!button_clicked.classList.contains("p-btn")) {
      return;
    }

    button.forEach((currentEle) => currentEle.classList.remove("p-btn-active"));
    button_clicked.classList.add("p-btn-active");
    // To Find The Number in Data Attribute
    const btn_num = button_clicked.dataset.btnNum;
    const img_active = document.querySelectorAll(`.p-btn--${btn_num}`);

    img_overlay.forEach((currentEle) => currentEle.classList.add("img-overlay-not-active"));
    img_active.forEach((currentEle) => currentEle.classList.remove("img-overlay-not-active"));
  });
}

// ========================================
// End Portfolio Filter Component
// ========================================

// ========================================
//  Animate Number Counter
// ========================================
let hasAnimated = false;
window.addEventListener('scroll', function () {
  if (!hasAnimated && window.scrollY >= 3500 && window.scrollY <= 4050) {
    animateNumbers('num1', 0, 500, 1500);
    animateNumbers('num2', 0, 600, 1500);
    animateNumbers('num3', 0, 800, 1500);
    animateNumbers('num4', 0, 700, 1500);
    hasAnimated = true; // Set the flag to true once animation is triggered
  }
});

function animateNumbers(element, start, end, duration) {
  let current = start;
  const range = end - start;
  const increment = end > start ? 1 : -1;
  const stepTime = Math.abs(Math.floor(duration / range));
  const obj = document.getElementById(element);
  const timer = setInterval(function () {
    current += increment;
    obj.textContent = current;
    if (current === end) {
      clearInterval(timer);
    }
  }, stepTime);
}
// ========================================
//  End Animate Number Counter
// ========================================

// ========================================
//  Scroll to Top
// ========================================
const topbutton = document.querySelector(".scrolltop");
window.onscroll = () => {
  console.log(window.onscroll);
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    topbutton.style.display = "block";
  } else {
    topbutton.style.display = "none";
  }
  topbutton.addEventListener("click", () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  });
};
// ========================================
//  End Scroll to Top
// ========================================