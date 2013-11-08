jQuery(document).ready(function ($) {
	$('ul.nav-menu a').hover(
		function () {
			$(this).data('en', $(this).attr('title'));
			$(this).data('zh', $(this).html());
		    $(this).html($(this).data('en'));
		},
		function () {
		    $(this).html($(this).data('zh'));
		}
	);

	$('li[id^="menu-item"]').find('a[title="SPECIAL"]').parent().append("<i class='unread radius_20px'>1</i>");

});

