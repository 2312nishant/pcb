setTimeout(
initialization
, 2000);

function initialization(){

	$("#BigNewsSlider").owlCarousel({
	nav : true, 
	singleItem:true,
	items:1,
	loop: true,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"],
});

$("#advtSlider").owlCarousel({
	nav : false, 
	singleItem:true,
	items:1,
	loop: true,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"]
});
$(".advtSlider2").owlCarousel({
	nav : false, 
	singleItem:true,
	items:1,
	loop: true,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"]
});

}

