/*terminall.js*/
$(document).ready(function() {  
	$(document).on("click", ".terminal-card .info-item .right", function () {
		if($(this).hasClass("up")) {
			$(this).removeClass("up");
			$(this).parent().next().slideUp();
		}
		else {
			$(this).addClass("up");
			$(this).parent().next().slideDown();
		}
	});
	makeCardsColumns();
	$(window).resize(makeCardsColumns);
});

function makeCardsColumns() {
	var cols = 3;
	switch($(".cards-inner").width()) {
		case 940:
			cols = 3;
			break;
		case 620:
			cols = 2;
			break;
		default:
			cols = 1;
			break;
	}
	var i = 0;
	var cards = $(".terminal-card");
	cards.sort(function (a, b) {
      var contentA = parseInt( $(a).attr('data-sort')) || 0;
      var contentB = parseInt( $(b).attr('data-sort')) || 0;
	  if (contentA == 0) contentA = 999999;
	  if (contentB == 0) contentB = 999999;
      return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
	});
	var j = 1;
	for(i = 0; i < cards.length; i++) {
		$(".cards-col.ccol-"+j).append($(cards[i]));
		$(cards[i]).attr('data-sort', i+1);
		j++;
		if(j > cols) j = 1;
	}
}