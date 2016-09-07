$(function() {
	//クリックしたときのファンクションをまとめて指定
	$('.tab li').click(function() {

		//.index()を使いクリックされたタブが何番目かを調べ、
		//indexという変数に代入します。
		var index = $('.tab li').index(this);
		//alert("index=" + index);

		//コンテンツを一度すべて非表示にし、
		/*$('.tab_content div').css('display','none');*/
		$('.tab_content div').addClass('hide');

		//クリックされたタブと同じ順番のコンテンツを表示します。
		/*$('.tab_content div').eq(index).css('display','block');*/
		$('.tab_content div').eq(index).removeClass('hide');

		//一度タブについているクラスselectを消し、
		$('.tab li').removeClass('select');

		//クリックされたタブのみにクラスselectをつけます。
		$(this).addClass('select')
	});

	var changeItems = new Array();
	$('input[type=text], input[type=number], input[type=checkbox]').change(function() {
		if (changeItems.length <= 0) {
			$(window).on('beforeunload', beforeUnloadFunction);
		}
		changeItems.push(this);

		summaryGekiCount();
	});
	$('input[type=submit]').click(function() {
		$(window).off('beforeunload');
	});

	function setBackgroundRed(item) {
		var obj = $(item);
		var typ = obj.prop('type');
		if (typ == 'checkbox') {
			obj = obj.closest('label');
		}
		obj.css('background-color', 'red');
	}

	function beforeUnloadFunction() {
		changeItems.forEach(setBackgroundRed);
		return '数量が変更されていますが、移動してよろしいですか？';
	}

	function summaryGekiCount() {
		var gekisum = $('#gekisum');
		gekisum.val(0);
		var sumGeki = 0;
		$('section#idGeki input[type=number]').each(function(index, elem) {
			if (elem.value != "") {
				sumGeki += parseInt(elem.value);
			}
		});
		gekisum.val(sumGeki);
	}
	summaryGekiCount();
});
function save(action, drawId) {
	document.getElementById('action').value = action;
	document.getElementById('drawId').value = drawId;
	document.getElementById('f').submit();
}