


/* ===================
	Scripts && Jquery
=================== */

$(document).ready(function() {


/* === Default Settings === */

 	var curPage = location.href;
	var prevPage = sessionStorage.getItem('curPage');
	var hostPage = location.hostname;

	sessionStorage.setItem('curPage', curPage);
	sessionStorage.setItem('prevPage', prevPage);

	


});