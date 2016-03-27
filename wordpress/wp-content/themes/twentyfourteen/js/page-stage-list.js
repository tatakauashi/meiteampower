jQuery(function($) {
    $('#stage_date_specify_duration').click(function() {
    	setStageDateSpecifyDurationReadOnly(false);
    });
    $('#stage_date_specify_one_day').click(function() {
    	setStageDateSpecifyDurationReadOnly(true);
    });

    // onload時
    if ($("#stage_date_specify_duration").prop("checked")) {
    	setStageDateSpecifyDurationReadOnly(false);
    } else {
    	setStageDateSpecifyDurationReadOnly(true);
    }

    // 期間指定させるかどうかを設定する
    function setStageDateSpecifyDurationReadOnly(flag) {
    	$("#stage_date_from").attr("readonly", flag);
    	$("#stage_date_to").attr("readonly", flag);
    	$("#stage_date_one_day").attr("readonly", !flag);
    	
    	setStageDateSpecifyDurationGray(flag);
    }
    
    // 期間指定・日付指定の背景色をグレイにする
    function setStageDateSpecifyDurationGray(flag) {
    	var durationColor = flag ? "lightgray" : "white";
    	var oneDayColor = !flag ? "lightgray" : "white";
    	$("#stage_date_from").css("background-color", durationColor);
    	$("#stage_date_to").css("background-color", durationColor);
    	$("#stage_date_one_day").css("background-color", oneDayColor);
    }
});
