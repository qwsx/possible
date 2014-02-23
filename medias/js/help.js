// JavaScript Document
Document.getElementById('aaa').onMouseOver= function() { alert('Hello world') }
function gogo() { 
	document.getElementById('bbb').innerHTML = document.getElementById('aaa').getElementsByTagName('a')[0].title;
}
function outout() {
		document.getElementById('bbb').innerHTML = "roll sur les rubs";
}