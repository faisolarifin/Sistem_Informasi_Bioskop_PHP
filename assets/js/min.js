let index = 0;

function slider(){
	let gambar = document.getElementsByClassName('slide');
	for(let i=0;i<gambar.length;i++){
		gambar[i].style.display = "none";
	}
	index++;
	if(index > gambar.length){
		index = 1
	}
	gambar[index-1].style.display = "block";
	setTimeout(slider, 5000);
}

function fxform(chekbox,textbox){
	let checklogin = document.getElementById(chekbox);
	let formpass = document.getElementsByName(textbox);
	checklogin.onclick = function(){
		if(checklogin.checked){
			formpass[0].type = "text";
		}
		else{
			formpass[0].type = "password";
		}
	}
}

let i = 0;
let txt = ['Selamat Datang','di','Sistem UKM','Batik Madura','Selamat Datang di Sistem UKM Batik Madura'];
let speed = 50;
let itext = 0;
let h1 = document.getElementById("typed2");

function typeWriter() {
	
	if(i==txt[itext].length-1)
	{
		speed = 2000;
	}
	else if(i==txt[itext].length)
	{
		h1.innerHTML= '';
		i=0;
		speed = 50;
		itext++;
		if(itext==txt.length){
			itext=0;
		}
	}
	if (i < txt[itext].length) 
	{
		h1.innerHTML += txt[itext].charAt(i);
		i++;
		setTimeout(typeWriter, speed);
	}

}

function whenScroll(top){
	let header =document.getElementsByClassName('header-top')[0];
	if(document.body.scrollTop > top || document.documentElement.scrollTop > top){
		header.style.background = 'linear-gradient(to right, #0572b5, #1feaed, #0572b5)';
		header.style.opacity = '0.9';
		header.style.boxShadow = '0 1px 3px 0 rgba(27,27,27,.1),0 4px 8px 0 rgba(27,27,27,.1)';

	} else {
		header.style.background = 'linear-gradient(to right, transparent, #8fa9fe)';
		header.style.boxShadow = 'none';
	}

}

let users = [
				['faisol','member','member'],
				['aduhay','member','member'],
				['faisol','beli','customer'],
				['jokibalap','lingkartimur','customer']
		];
function login(user,pass,akses){
	var i=0;
	while (i<users.length){
		if(user==users[i][0] && pass==users[i][1] && akses==users[i][2]){
			i=users.length;
			return true;
		}else{
			i++;
		}
	}
	return false;
}
