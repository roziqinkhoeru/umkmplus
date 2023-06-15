"use strict";

//Notify
$.notify({
	icon: 'flaticon-alarm-1',
	title: 'Atlantis',
	message: 'Premium Bootstrap 4 Admin Dashboard',
},{
	type: 'secondary',
	placement: {
		from: "bottom",
		align: "right"
	},
	time: 1000,
});

//Chart

$("#activeUsersChart").sparkline([112,109,120,107,110,85,87,90,102,109,120,99,110,85,87,94], {
	type: 'bar',
	height: '100',
	barWidth: 9,
	barSpacing: 10,
	barColor: 'rgba(255,255,255,.3)'
});

// Owl Carousel 

$(document).ready(function(){
	$("#products").owlCarousel({
		autoplaySpeed:300,
		navSpeed:400,
		autoWidth:true,
		dots:false
	});
})