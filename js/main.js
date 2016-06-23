$(function(){ //JQUERY WRAPPER

//Adds icon next to item list article titles
elem = $("section article h2");
for(a = 0, b = elem.length; a < b; a++){	
	elemValue = $(elem[a]).text().replace(/\ /g, "_");
	$(elem[a]).css({
		"background-image": "url(../images/tabs/"+elemValue+".png)",
		"background-repeat": "no-repeat",
		"background-size": "contain",
		"padding": "10px 10px 10px 55px"
	})
}

//Apply outline fn
applyOutline = function(elem, value){
	$(elem).before("<span>"+value+"</span>");
	$(elem).prev().css({
		"position": "absolute",
		"-webkit-text-stroke": "4px black",
		"z-index":"1"
	});	
}

applyOutline($("#materials div:last-child .outline"), 2);
applyOutline($("#values li .outline"),"+100");

/* SEARCH fn
$("#search_query").keyup(function(){
			console.log($("#search_query").val());
			
	$.ajax({
		type: "GET",
		url: "js/search.php",             
		dataType: "html",
		data: { query: $("#search_query").val() },
		success: function(response){             
			$("#itemlist").html(response); 
			//alert(response);
		}
	})
})
*/
}); //JQUERY WRAPPER END