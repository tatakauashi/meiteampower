jQuery(function($) {
    function changeMessageColor(messageColor) {
        var col = "black";
        switch (messageColor) {
            case "2":
                col = "red";
                break;
            case "3":
                col = "blue";
                break;
            case "4":
                col = "yellow";
                break;
            case "5":
                col = "green";
                break;
            case "6":
                col = "orange";
                break;
            case "7":
                col = "purple";
                break;
            case "8":
                col = "brown";
                break;
        }
        $("#txtareaMessage").css("color", col);
    }
    changeMessageColor($("#messageColor").val());

    $("#messageColor").change(function(event) {
        changeMessageColor(event.currentTarget.value);
    });

    function setClassSafety(identity, clazz) {
        var retVal = false;
        var $obj = $(identity);
        if ($obj != null) {
            $obj.addClass(clazz);
            retVal = true;
        }
        return retVal;
    }

    function setHtmlSafety(identity, h) {
        var retVal = false;
        var $obj = $(identity);
        if ($obj != null) {
            $obj.html(h);
            retVal = true;
        }
        return retVal;
    }

    function setValSafety(identity, v) {
        var retVal = false;
        var $obj = $(identity);
        if ($obj != null) {
            $obj.val(v);
            retVal = true;
        }
        return retVal;
    }

    // 言語切り替え用フロートボックス
    var setBoxId = '#float-box';
    var initOffsetTop = null;
    var $window = $(window),
        $document = $(document),
        $setBox = $(setBoxId);
    initOffsetTop = $setBox.offset().top;

    $window.scroll(function() {
        scrollBox();
    });

    function scrollBox() {
        if (initOffsetTop == null) return;
        var scrollTop = $document.scrollTop();
        if (initOffsetTop < scrollTop) {
            $setBox.css('position', 'fixed');
            $setBox.animate({top: '10'}, {duration: 0});
        } else {
            $setBox.css('position', 'absolute');
            $setBox.animate({top: initOffsetTop}, {duration: 0});
        }
    }

    $("input[type='text']").on("keydown", function(e) {
//    $("input").on("keydown", function(e) {
        if ((e.which && e.which === 13 || e.keyCode && e.keyCode === 13)) {
            return false;
        } else {
            return true;
        }
    });

    var $meimeiLoad = $("#meimei_load");
    if ($meimeiLoad != null) {
        $meimeiLoad.val("1");
    }
});
