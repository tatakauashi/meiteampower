jQuery(function($) {
    $('#stage_date_specify_duration').click(function() {
    	setStageDateSpecifyDurationReadOnly(false);
    });
    $('#stage_date_specify_one_day').click(function() {
    	setStageDateSpecifyDurationReadOnly(true);
    });
    $('#stage_date_specify_none').click(function() {
        setStageDateSpecifyNone();
    });

    // onload時
    if ($("#stage_date_specify_duration").prop("checked")) {
    	setStageDateSpecifyDurationReadOnly(false);
    } else if ($("#stage_date_specify_one_day").prop("checked")) {
    	setStageDateSpecifyDurationReadOnly(true);
    } else {
        // 指定なし（過去１か月の場合）は、期間指定、日付指定ともreadonly＆グレイ
        setStageDateSpecifyNone();
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

    function setStageDateSpecifyNone() {
        $("#stage_date_from").attr("readonly", true);
        $("#stage_date_to").attr("readonly", true);
        $("#stage_date_one_day").attr("readonly", true);
        $("#stage_date_from").css("background-color", "lightgray");
        $("#stage_date_to").css("background-color", "lightgray");
        $("#stage_date_one_day").css("background-color", "lightgray");
    }

    // 「出演する」に選択しているメンバーを、出演しないメンバーのSELECTボックスにコピーする。
    $('#member_cond_copy').click(function() {
        $('#idStageMembers option:selected').each(function() {
            $('#idStageMembers2 option[value=' + $(this).val() + ']').prop('selected', true);
        });
        return false;
    });
    // 「出演する」に選択しているメンバーをクリアする。
    $('#member_cond_clear').click(function() {
        $('#idStageMembers option:selected').each(function() {
            $(this).prop('selected', false);
        });
        $('#idStageMembers option:first').prop('selected', false);
        return false;
    });

    // 「出演しない」に選択しているメンバーを、出演するメンバーのSELECTボックスにコピーする。
    $('#member_cond2_copy').click(function() {
        $('#idStageMembers2 option:selected').each(function() {
            $('#idStageMembers option[value=' + $(this).val() + ']').prop('selected', true);
        });
        return false;
    });
    // 「出演しない」に選択しているメンバーをクリアする。
    $('#member_cond2_clear').click(function() {
        $('#idStageMembers2 option:selected').each(function() {
            $(this).prop('selected', false);
        });
        $('#idStageMembers2 option:first').prop('selected', false);
        return false;
    });
    //$('#idStageMembers2').change(function() {
    //    $('#idStageMembers2 option:first').prop('selected', false);
    //});
});
