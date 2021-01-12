if(document.getElementById("NotLogged") != null) {
	var modal = document.getElementById("loginModal");

	var btn = document.getElementById("modalButton");

	var span = document.getElementsByClassName("close")[0];

	btn.onclick = function() {
		modal.style.display = "block";
	}

	span.onclick = function() {
		modal.style.display = "none";
	}
	
	var modal2 = document.getElementById("registerModal");
	
	var btn2 = document.getElementById("modalButton2");
	
	var span2 = document.getElementsByClassName("close")[1];
	
	btn2.onclick = function() {
		modal2.style.display = "block";
	}
	
	span2.onclick = function() {
		modal2.style.display = "none";
	}

	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
		if (event.target == modal2) {
			modal2.style.display = "none";
		}
	}

	// var usernameSpec =  document.getElementById("usernameSpec");
	// var passwordSpec =  document.getElementById("passwordSpec");
	// var emailSpec =  document.getElementById("emailSpec");

	// var passwordReg = document.getElementById("passwordReg");
	
	// passwordReg.onblur = function(){
	// 	//document.getElementById("passwordSpec").display = "block";
	// 	console.log('Test' + passwordReg);
	// }
}