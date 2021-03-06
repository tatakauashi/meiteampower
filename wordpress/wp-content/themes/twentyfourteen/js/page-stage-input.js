jQuery(function($) {
    $('#stage_team').change(function() {
        var p = $('#stage_program');
        var teamId = parseInt($(this).val());
        switch (teamId) {
            case 1:
                p.val(14);
                break;
            case 2:
                p.val(13);
                break;
            case 3:
                p.val(15);
                break;
            case 4:
                p.val(1);
                break;
        };
    });

    function changeStageDate()
    {
        var stageDate = $('#stage_date');
        if (stageDate !== undefined && stageDate.val() != "") {
            var d = new Date(stageDate.val());
            var span = document.getElementById('stageDay');
            while( span.firstChild ) {
                span.removeChild( span.firstChild );
            }
            span.appendChild( document.createTextNode("(" + [ "日", "月", "火", "水", "木", "金", "土" ][d.getDay()] + ")") );
        }
    }

    $('#stage_date').change(function() {
        changeStageDate();
    });
    changeStageDate();

    if ($('#revision').val() == '0') {
    	$('#stage_team').change();
    }

    $('textarea').keydown(function(e) {
        if (e.keyCode == 13) {
            var thiz = $(this);
            thiz.attr('rows', parseInt(thiz.attr('rows')) + 2);
        }
    });
});
