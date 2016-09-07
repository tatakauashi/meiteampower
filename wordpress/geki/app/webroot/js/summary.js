$(function() {
	// 再計算
	function recalc() {
		$('#votesFromBudget').val(
				Math.floor(parseInt($('#bulkBudgetsMoney').val()) / parseInt($('#unit').val())));

		var calcsum = 
			parseInt($('#allocatesCount').val())
			+ parseInt($('#myAllocatedVotesMobile').val())
			* parseInt($('#myAllocatedVotesMobileUnit').val())
			+ parseInt($('#myAllocatedVotesOther').val())
			+ parseInt($('#friendsVotesMobile').val())
			* parseInt($('#friendsVotesMobileUnit').val())
			+ parseInt($('#friendsVotesOther').val())
			+ parseInt($('#votesFromBudget').val())
			;
		$('#calcResult').text(calcsum);
	}
	
	//クリックしたときのファンクションをまとめて指定
	$('#calc').click(function() {
		recalc();
	});

	recalc();
});
