jQuery(function($) {
	// dd要素の内容をタブでそろえる
    $('dl[lining]').each(function(index1, elem1) {
    	var dl = $(elem1);
    	var headWidth = dl.attr('lining');
    	$.each(dl.children('dd'), function(index2, elem2) {
    		var dd = $(elem2);
    		var text = dd.html();
    		var texts = text.split("\t", 2);
    		if (texts.length == 2) {
    			dd.html('<span style="display:inline-block; width: ' + headWidth + ';">' + texts[0] + '</span>' + texts[1]);
    		}
    	});
    });
});