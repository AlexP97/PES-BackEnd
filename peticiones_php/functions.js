function checkSession(){
	if(sessionStorage.getItem('username')){
		window.location.href = "create_guide.html";
	}
	if(localStorage.getItem('username')){
		window.location.href = "create_guide.html";
	}
}

function checkLogged(){
	if(!sessionStorage.getItem('username')){
		window.location.href = "login_guide.html";
	}
	if(!localStorage.getItem('username')){
		window.location.href = "login_guide.html";
	}
}

function logOut(){
	sessionStorage.removeItem('username');
	localStorage.removeItem('username');
	window.location.href = "login_guide.html";
}