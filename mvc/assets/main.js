//đếm ngược giờ sale
(function () {
    const second = 1000,
          minute = second * 60,
          hour = minute * 60,
          day = hour * 24;

    let today = new Date(),
        dd = String(today.getDate()).padStart(2, "0"),
        mm = String(today.getMonth() + 1).padStart(2, "0"),
        yyyy = today.getFullYear(),
        nextYear = yyyy + 1,
        dayMonth = "10/30/",
        birthday = dayMonth + yyyy;
    
    today = mm + "/" + dd + "/" + yyyy;
    if (today > birthday) {
      birthday = dayMonth + nextYear;
    }
    
    const countDown = new Date(birthday).getTime(),
        x = setInterval(function() {    
  
          const now = new Date().getTime(),
                distance = countDown - now;
  
             document.getElementById("days").innerText = Math.floor(distance / (day)),
            document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
            document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
  
          if (distance < 0) {
            
            clearInterval(x);
          }

        }, 1000)
    }());

//fixed header
var header = document.querySelector('.header');
var headerTop = document.querySelector('.header-top');
var headerBottom = document.querySelector('.header-bottom');


window.addEventListener('scroll', function() {
 
  var scrollY = window.scrollY || window.pageYOffset;

  if (scrollY >= 100) {
    headerTop.classList.add('header-hidden');
    headerBottom.classList.add('header-sticky');
  } else {
    headerTop.classList.remove('header-hidden');
    headerBottom.classList.remove('header-sticky');
  }
});
//

//back to top
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if(document.documentElement.scrollTop > 400) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.documentElement.scrollTop = 0;
}

//ẩn hiển password
function hiddenPassword(show, fieldId, showIconId, hiddenIconId) {
  let passwordField = document.getElementById(fieldId);
  let showPassword = document.getElementById(showIconId);
  let hiddenPassword = document.getElementById(hiddenIconId);

  if(show) {
      passwordField.type = "text";
      showPassword.style.display = "none";
      hiddenPassword.style.display = "inline-block";
  } else {
      passwordField.type = "password";
      showPassword.style.display = "inline-block";
      hiddenPassword.style.display = "none";
  }
}

//lấy thời gian hiện hành
function displayCurrentTime() {
  const currentTime = new Date();

  const daysOfWeek = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
  const dayOfWeek = daysOfWeek[currentTime.getDay()];

  function addZero(number) {
    if(number < 10) {
      return `0${number}`;
    }
    return `${number}`;
  }

  const dayOfMonth = addZero(currentTime.getDate());
  const month = addZero(currentTime.getMonth() + 1);
  const year = currentTime.getFullYear();

  //const hours = currentTime.getHours();
 // const minutes = currentTime.getMinutes();
 //const seconds = currentTime.getSeconds();

  const currentTimeElement = document.getElementById('current-time');
  currentTimeElement.innerHTML = `${dayOfWeek}, Ngày ${dayOfMonth} Tháng ${month} Năm ${year}`;
}

function resetForm() {
  window.location.reload();
}

//show slide
let slideIndex = 1;
showSlides(slideIndex);

setInterval(function() {
  plusSlides(1);
}, 8000);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  
}

//carousel slide
$(document).ready(function(){
  $('.filtering').slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    draggable: false,
    prevArrow:`<button type='button' class='slick-prev pull-left'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
    nextArrow:`<button type='button' class='slick-next pull-right'><ion-icon name="arrow-forward-outline"></ion-icon></button>`
  });
});

//tab panel
function openPanel(panelName) {
  let i;
  let x = document.getElementsByClassName("tab-panel");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  document.getElementById(panelName).style.display = "block"; 

  if (panelName === "jordan1") {
    $('.tab-jordan1.filtering').slick('unslick'); // Xóa thư viện cũ
    $('.tab-jordan1.filtering').slick({ // Khởi tạo lại thư viện
      slidesToShow: 5,
      slidesToScroll: 5,
      draggable: false,
      prevArrow: `<button type='button' class='slick-prev pull-left'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><ion-icon name="arrow-forward-outline"></ion-icon></button>`
    });
  } else if (panelName === "jordan4") {
    $('.tab-jordan4.filtering').slick('unslick'); // Xóa thư viện cũ
    $('.tab-jordan4.filtering').slick({ // Khởi tạo lại thư viện
      slidesToShow: 5,
      slidesToScroll: 5,
      draggable: false,
      prevArrow: `<button type='button' class='slick-prev pull-left'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><ion-icon name="arrow-forward-outline"></ion-icon></button>`
    });
  }
}

//click Category
function toggleChildCategory(button) {
  var parentListItem = button.closest('li'); // Tìm phần tử li cha gần nhất
  var childCategory = parentListItem.querySelector('.child-category'); // Tìm div "child-category" trong phần tử li cha

  if (childCategory.style.display === "none" || childCategory.style.display === "") {
      childCategory.style.display = "block";
      button.querySelector('i').classList.remove('initial-icon');
      button.querySelector('i').classList.add('bx-flip-vertical');
  } else {
      childCategory.style.display = "none";
      button.querySelector('i').classList.remove('bx-flip-vertical');
      button.querySelector('i').classList.add('initial-icon');
  }
}








