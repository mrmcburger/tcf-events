$(function() {
	// INITIAL STATE
	$("#modalLogin").hide();
	$("#modalPhoto .modalPicture").hide();
	$("#modalPhoto .icon-remove").hide();
	$(".modal-backdrop").hide();

	// LOGIN
	$("#displayLogin").click(function() {
		$("#modalLogin").slideToggle();
		$("#displayLogin").toggleClass('open');
	});

	// PAGINATION LISTS
	var len = document.getElementById('modalGallery').getElementsByTagName('img').length,
		pageNumber = len / 20,
		pageNumberInt = Math.floor(pageNumber);

	$('.pag-objects').pajinate({
		items_per_page: 20,
		start_page: pageNumberInt
	});

	// MODAL PHOTO
	// $("#modalGallery .picture").on('click', function() {
	// 	var tab = $(this),
	// 		index = tab.index(),
	// 		content = $("#modalPhoto .modalPicture").eq(index),
	// 		contents = content.siblings();

	// 	var xWidth =  content.width();
	// 	$("#modalPhoto").width(xWidth);

	// 	content.fadeIn();
	// 	$("#modalPhoto .icon-remove").fadeIn();
	// 	$(".modal-backdrop").fadeIn();
	// });

	// $("#modalPhoto .icon-remove").on('click', function() {
	// 	$("#modalPhoto .modalPicture").hide();
	// 	$("#modalPhoto .icon-remove").hide();
	// 	$(".modal-backdrop").fadeOut();
	// });

	// $(document).on('keydown', function (e) {
	//     if (e.keyCode === 27) {
	//         $("#modalPhoto .modalPicture").hide();
	// 		$("#modalPhoto .icon-remove").hide();
	// 		$(".modal-backdrop").fadeOut();
	//     }
	// });
});