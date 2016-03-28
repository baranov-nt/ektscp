$(document).ready(function(){
	/*Верхний*/
	$('#slider-open').on('click', function(){
		$('.overlay').show();
		$('.times').show();
		$('.banner-slider').attr('style', 'display: block !important;');
		$('.banner-slider').slick({
			adaptiveHeight: true,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1,
		});
		$('.slick-arrow').remove();
	});
	$('.times').click(function(){
		$('.overlay').hide();
		$('.times').hide();
		$('.banner-slider').attr('style', 'display: none !important;');
	});
	/*Нижний*/
	$('.slider').slick({
		adaptiveHeight: true,
		dots: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	$('.slick-arrow').remove();
});

function next_slide() {
	$('.banner-slider').slick('slickNext');
}