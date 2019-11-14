var requestAjax=function(options){

	var object = {
		url:"server/comment_upload.php",
		type:"POST",
		datatype:'jsonp'
	};

	$.extend(object,options);

	$.ajax(object).done(function(data){
		console.log(data);

		data = JSON.parse(data);

		for(var i in data["data"]){
			$('.comment_load').append(data["data"][i]["comment"]+" "+data["data"][i]["at_pos"]+'\n');
		}

	}).fail(function( jqXHR, textStatus, errorThrown ) {
		console.log(jqXHR);
	  	alert(jqXHR.statusText);
	});
}
