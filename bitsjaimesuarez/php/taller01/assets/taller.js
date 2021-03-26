$(function() {

  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $('#back-to-top').fadeIn();
    } else {
      $('#back-to-top').fadeOut();
    }
  });
  // scroll body to 0px on click
  $('#back-to-top').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 400);
    return false;
  });


  $('ul li a').click(function(e){
    console.log('click');
		e.preventDefault();

		var strAncla=$(this).attr('href');
			$('body,html').stop(true,true).animate({
				scrollTop: $(strAncla).offset().top
			},1000);
	});




});




