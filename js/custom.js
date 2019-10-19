



$(window).scroll(function() {
   if ($(this).scrollTop() > 350){
      $('.site-header').addClass("header-fixed");
   } else {
      $('.site-header').removeClass("header-fixed");
   }
});


document.querySelector('.site-header').scrollIntoView({ 
  behavior: 'smooth' 
});



function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}



