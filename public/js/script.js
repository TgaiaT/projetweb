$(document).ready(function () {

    let script = {
        previousScrollTop: 0,
        currentScrollTop: $(window).scrollTop(),
        scrollLimit: 200,
        scrollState: "null",
    };

    $(window).scroll(function (e) {
        if (script.scrollState != "changing")
        {
            if (script.previousScrollTop > $(this).scrollTop())
            {
                if (script.scrollState == "down")
                {
                    script.currentScrollTop = $(this).scrollTop();
                    //console.log("ChangeState");
                }
                script.scrollState = "up";
            }
            else if (script.previousScrollTop < $(this).scrollTop())
            {
                if (script.scrollState == "up")
                {
                    script.currentScrollTop = $(this).scrollTop();
                    //console.log("ChangeState");
                }
                script.scrollState = "down";
            }
            script.previousScrollTop = $(this).scrollTop();
        }
    })

    $(window).scroll(function (e) {
        if (script.scrollState == "down")
        {
            if ($(this).scrollTop() > (script.currentScrollTop+script.scrollLimit))
            {
                script.scrollState = "changing";
                $("#navbar").slideUp(function () {
                    script.scrollState = "down";
                });
                console.log("down");
            }
        }
        else if (script.scrollState == "up")
        {
            if ($(this).scrollTop() < (script.currentScrollTop-script.scrollLimit))
            {
                script.scrollState = "changing";
                $("#navbar").slideDown(function () {
                    script.scrollState = "up";
                });
                console.log("up");
            }
        }
    })

    $("a").on('click', function () {
        script.previousScrollTop = $(window).scrollTop();
        script.currentScrollTop = $(window).scrollTop();
        script.scrollState = "null";
    })

});