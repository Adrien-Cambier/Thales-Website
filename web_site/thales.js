const open = document.querySelector(".hamburger_menu");
const ul = document.querySelector("ul");
const close = document.querySelector(".close");

open.addEventListener('click',()=>ul.classList.add("on"));
close.addEventListener('click',()=>ul.classList.remove("on"));