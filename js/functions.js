function checkSession(){
	if(sessionStorage.getItem('username') || localStorage.getItem('username')){
		window.location.href = "create_guide.html";
	}
}

function checkLogged(){
	if(!sessionStorage.getItem('username') && !localStorage.getItem('username')){
		window.location.href = "login_guide.html";
	}
}

function logOut(){
	sessionStorage.removeItem('username');
	localStorage.removeItem('username');
	window.location.href = "login_guide.html";
}

function getUrlVars(){
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++){
	    hash = hashes[i].split('=');
	    if($.inArray(hash[0], vars)>-1){
	        vars[hash[0]]+=","+hash[1];
	    }
	    else{
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	}
	return vars;
}