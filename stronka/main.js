$(document).ready(function()
{
	var NavY = $('nav').offset().top;
 
	var stickyNav = function(){
		var ScrollY = $(window).scrollTop();
	  
		if (ScrollY > NavY) { 
			$('nav').addClass('sticky');
		} else {
			$('nav').removeClass('sticky'); 
		}
	};
	
 
	stickyNav();
 
	$(window).scroll(function() {
		stickyNav();
	});
			
});

var slideIndex = 1;
showDivs(slideIndex);
	

function plusDivs(n) {
  	showDivs(slideIndex += n);
}

function currentDiv(n) {
  	showDivs(slideIndex = n);
}

function showDivs(n) {
  	var i;
  	var x = document.getElementsByClassName("mySlides");
  	var dots = document.getElementsByClassName("demo");
  	if (n > x.length) {slideIndex = 1}    
  	if (n < 1) {slideIndex = x.length}
  	for (i = 0; i < x.length; i++) {
     	x[i].style.display = "none";  
  	}
  	for (i = 0; i < dots.length; i++) {
    	dots[i].className = dots[i].className.replace(" w3-white", "");
  	}
  	x[slideIndex-1].style.display = "block";  
  	dots[slideIndex-1].className += " w3-white";
}
			
		
function openRec() {
    var i;
    var x = document.getElementsByClassName("sort");
    var a = "slider";
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    var y=document.getElementById("pomoc").value;
    document.getElementById(y).style.display = "block";
    if (y == a) {
		document.getElementById("ocena1").style.display = "none";
		document.getElementById("komentarze1").style.display = "none";
   }

}

	function Dzien() {
		$('body').addClass('dzien');
		document.getElementById("logo").style.color = "black";
		$('footer').addClass('dzien');
		
	}	
	
	function Noc() {
		$('body').removeClass('dzien');
		document.getElementById("logo").style.color = "#ddd";
		$('footer').removeClass('dzien');
	}	
	
		
	function DoDruku() {
		$('iframe').addClass('znikniecie');
		$('body').addClass('dodruku');
		$('div').addClass('dodruku');
	}	



