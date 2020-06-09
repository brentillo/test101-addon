jQuery(window).on("hashchange", function () {
	var winW = jQuery( window ).width();
	var stickhead = jQuery( '.fusion-header-sticky-height').height();
    window.scrollTo(window.scrollX, window.scrollY - stickhead - 35);
});

jQuery(window).load(function() {
	adjustColumnBlocksH();
	jQuery("#flippanel").removeClass("hidepanelonload");
	adjustBlogTabH();
	adjustHeightTesti();
});
jQuery(window).resize(function() {
	adjustColumnBlocksH();
	adjustHeightTesti();
});
function adjustColumnBlocksH(){
	var winW = jQuery( window ).width();
		var maxHeight = -1;
	jQuery( ".content-blk" ).each(function() {
		jQuery(this).css({'height': 'auto'});
	});
	jQuery( ".content-blk" ).each(function() {
		if (jQuery(this).outerHeight() > maxHeight)
				maxHeight = jQuery(this).height();
	});
	jQuery('.a2q2-flip-blk .content-blk, .a2q2-flip-blk .back').each(function() {
			jQuery(this).css({'height': maxHeight});
	});
	jQuery('.a2q2-flip-blk').each(function() {
			jQuery(this).css({'height': maxHeight + 2});
	});
}
function adjustHeightTesti(){
	var maxHeight = 0;
	jQuery( ".netsuite-testi .review" ).each(function() {
		jQuery(this).css({'min-height': 'auto','height': 'auto'});
	});
	jQuery( ".netsuite-testi .review" ).each(function() {
		if (jQuery(this).outerHeight() > maxHeight)
				maxHeight = jQuery(this).height();
	});
	jQuery('.netsuite-testi .review').each(function() {
			jQuery(this).css({'min-height': maxHeight + 10});
	});
}

function adjustBlogTabH(){
	var maxHeight = -1;
	jQuery( ".blog-tabbing .tab-link" ).each(function() {
		jQuery(this).css({'height': 'auto'});
	});
	jQuery( ".blog-tabbing .tab-link" ).each(function() {
		if (jQuery(this).outerHeight() > maxHeight)
				maxHeight = jQuery(this).height();
	});
	jQuery('.blog-tabbing .tab-link').each(function() {
			jQuery(this).css({'height': maxHeight + 18});
	});
}

jQuery(function() {
  var moveLeft = 0;
  var moveDown = -50;

  jQuery('a.a2q2-trigger, div.a2q2-popup').hover(function(e) {
    jQuery('div.a2q2-popup').show()
      .css('top', e.pageY + moveDown)
      .css('left', e.pageX + moveLeft)
      .appendTo('body');
  }, function() {
    jQuery('div.a2q2-popup').hide();
  });
  jQuery('a.a2q2-trigger2, div.a2q2-popup2').hover(function(e) {
    jQuery('div.a2q2-popup').show()
      .css('top', e.pageY + moveDown)
      .css('left', e.pageX + moveLeft)
      .appendTo('body');
  }, function() {
    jQuery('div.a2q2-popup2').hide();
  });
  jQuery('a.a2q2-trigger3, div.a2q2-popup3').hover(function(e) {
    jQuery('div.a2q2-popup').show()
      .css('top', e.pageY + moveDown)
      .css('left', e.pageX + moveLeft)
      .appendTo('body');
  }, function() {
    jQuery('div.a2q2-popup2').hide();
  });
  jQuery('a#trigger').mousemove(function(e) {
    //jQuery("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
  });

});
