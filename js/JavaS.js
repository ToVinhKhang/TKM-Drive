
function CheckInput(){
	let emailTemp = document.getElementById('email');
	let passTemp  = document.getElementById('pwd');
	let errorTemp = document.getElementById('ErrorMess');

	let email = emailTemp.value;
	let password = passTemp.value;

	if(email === ""){
		errorTemp.innerHTML='Please enter your email';
		emailTemp.focus();
		return false;
	}
	else if(!email.includes("@")){
		errorTemp.innerHTML='Your email is not valid';
		emailTemp.focus();
		return false;
	}
	else if(password === ""){
		errorTemp.innerHTML='Please enter your password';
		passTemp.focus();
		return false;
	}
	else if(password.length < 6){
		errorTemp.innerHTML='Your password must be between 6 to 20 characters';
		passTemp.focus();
		return false;
	}
	errorTemp.innerHTML="";
	return true;
}
function ClearErrorMess(){
	let errorTemp = document.getElementById('ErrorMess').innerHTML="";
}



