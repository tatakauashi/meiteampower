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

    if (!navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
    	// iPod/iPhone/iPadでは上手く動作しないため、それ以外の場合にのみトップへ移動するボタンを配置する
	    // トップへ移動するボタン
	    $('section.detail section.content').append("<div class='go-top'><span>↑ページトップへ</span></div>");
    }

    // スクロールのオフセット値
    var offsetY = -10;
    // スクロールにかかる時間
    var moveAnimateTime = 500;

    // ページ内リンクのみを取得
    $('a[href^=#]').click(function() {
      // 移動先となる要素を取得
      var target = $(this.hash);
      if (!target.length) return ;
      // 移動先となる値
      var targetY = target.offset().top+offsetY;
      // スクロールアニメーション
      $('html,body').animate({scrollTop: targetY}, moveAnimateTime, 'swing');
      // ハッシュ書き換えとく
      window.history.pushState(null, null, this.hash);
      // デフォルトの処理はキャンセル
      return false;
    });

    // トップへ移動するボタン
    $('.go-top').click(function() {
    	$('html,body').animate({scrollTop: 0}, moveAnimateTime, 'swing');
    });
});