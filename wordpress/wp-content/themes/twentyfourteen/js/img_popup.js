//(function($) {	// 無名関数（$の競合を回避）
$(function() {
	// ポップアップ用のタグを消す
//	$('#popup-background').hide();
//	$('#popup-item').hide();

	// class「popupimg」のリンクがクリックされたときのイベントを定義する
	$('.popupimg').bind('click', function(e) {
		// aタグでデフォルト動作を無効にする
		e.preventDefault();

		// 画像の読み込み
		var img = new Image();
		// クリックされた a タグの href を取得する
		var imgsrc = this.href;

		// Image()のロードイベントを定義する
		$(img).load(function() {
			$('#popup-item').attr('src', imgsrc);
			// ポップアップで表示するための img タグに画像が読み込まれているかチェックする
			$('#popup-item').each(function() {
				// 読み込み済みならばポップアップ表示用の関数を呼び出す
				if (this.complete) {
					imgload(img);
					return;
				}
			});
			// imgタグのロードイベントを定義
			$('#popup-item').bind('load', function() {
				// 画像がロードされたらポップアップ表示用の関数を呼び出す
				imgload(img);
			});
		});
		// Image()に画像を読み込ませる
		img.src = imgsrc;
	});

	// ポップアップされた領域のクリックイベント
	$('#popup-background, #popup-item').bind('click', function() {
		// ポップアップを消すため、タグをフェードアウトさせる
		$('#popup-background').fadeOut();
		$('#popup-item').fadeOut();
	});

	// ポップアップ表示用関数
	function imgload(imgsource) {
		// ポップアップの背景部分を表示する
		$('#popup-background').fadeIn(function() {

            var innerWidth  = window.innerWidth  || document.documentElement.clientWidth  || document.body.clientWidth;
            var innerHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
            // 表示画像のサイズを決める
            var ratio = .9;
            var ratioWidth  = innerWidth  / imgsource.width;
            var ratioHeight = innerHeight / imgsource.height;
            var imgWidth  = imgsource.width;
            var imgHeight = imgsource.height;
            if (ratioWidth < ratioHeight && ratioWidth < 1.) {
                imgWidth  *= ratioWidth;
                imgHeight *= ratioWidth;
            } else if (ratioHeight < ratioWidth && ratioHeight < 1.) {
                imgWidth  *= ratioHeight;
                imgHeight *= ratioHeight;
            }
/*
            if (imgWidth > imgHeight) {
                if (innerWidth < imgWidth) {
                    imgHeight = imgHeight * (innerWidth / imgWidth) * ratio;
                    imgWidth = innerWidth * ratio;
                }
            } else {
                if (innerHeight < imgHeight) {
                    imgWidth = imgWidth * (innerHeight / imgHeight) * ratio;
                    imgHeight = innerHeight * ratio;
                }
            }
*/
			// 画像を中心に表示させるため、画像の半分のサイズを取得
			/*
			 * 画像を表示するimgタグ「popup-item」はCSSで画面の中心に
			 * 表示するようにしているため、そのまま表示すると画像の左上の端が
			 * 中心に来る。
			 * そのため、マイナスのマージンを画像の半分のサイズだけ設定する。
			 */
//			var item_height_margin = (imgsource.height / 2) * -1;
//			var item_width_margin  = (imgsource.width  / 2) * -1;
			var item_height_margin = (imgHeight / 2) * -1;
			var item_width_margin  = (imgWidth  / 2) * -1;

			// 取得したマージンと画像ファイルをCSSで定義する
			var cssObj = {
				marginTop: item_height_margin,
				marginLeft: item_width_margin,
//				width: imgsource.width,
//				height: imgsource.height
				width: imgWidth,
				height: imgHeight
			};
			// 画像の表示用タグにCSSを当て、表示を行う
			$('#popup-item').css(cssObj).fadeIn(100);
		});
	}
//})(jQuery);
});
