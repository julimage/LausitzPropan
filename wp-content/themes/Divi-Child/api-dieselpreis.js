// Dieselpreis via Tankerkönig API abfragen

( function($) {
	
	$(document).ready(function(){
		var dieselpreis = $("#api-dieselpreis");
	
		$.ajax({
		url: "https://creativecommons.tankerkoenig.de/json/prices.php?ids=134139b7-92d0-4066-ba13-b556cf4a1f0a&apikey=11862a1c-5d7a-5d30-7863-6253eae65692"
	
		}).done(function(data) {
			if (!data.ok) {
			console.error(response.message);
			} else {
				var diesel = data.prices['134139b7-92d0-4066-ba13-b556cf4a1f0a'].diesel;
				dieselpreis.html(diesel);
			} 
		});
	});
	
} ) ( jQuery );