$( document ).ready(function() { 

    /*$(window).scroll(function() {
        var menu = $("#container > nav");
        //var top_menu = menu.height();
        var menu_hide = "menu-hidden";

        if($(this).scrollTop() !== 0.0)
            menu.addClass(menu_hide);
        else
            menu.removeClass(menu_hide);
    
        time_banner = $("#time-banner");
        var menu_hide = "menu-bar";
        //when the time banner start to disappears behind the title
        if(time_banner.offset().top- $(window).scrollTop() - $("#nav-bar").height() < 0)
            menu.addClass(menu_hide);
        else
            menu.removeClass(menu_hide);
    });*/

    var pub_priv_btn = $("#public-private > .clickable");
    var public_btn = $("#public-private > span:nth-child(1)");
    var private_btn = $("#public-private > span:nth-child(2)");
    var button_actions = $("#button-actions");

    var freeze_or_not_state = true;
    var freeze_or_not = $("#radio-wrapper");

    //pub_priv_btn.hide();
    var insert_state = true;
    $("#insert-btn").click(function() {
        if(insert_state) $(this).toggleClass("is-clicked");

        if(insert_state)
        {
            insert_state = false;

            freeze_or_not.animate({
                opacity: 1
            }, 400 );
             $(freeze_or_not.find(".radio")[0]).animate({
                right: 0
            }, 400 );
            $(freeze_or_not.find(".radio")[1]).animate({
                left: 0
            }, 400 );

           /*
            $(freeze_or_not[0]).animate({
                marginTop: '+=4rem'
            }, 400 );
            freeze_or_not.animate({
                opacity: 1
            }, 400 );
            freeze_or_not.find("span").animate({
                marginTop: '+=1rem',
                marginBottom: '+=1rem'
            }, 400 );
        */}
    });


    //toggleRadio($(freeze_or_not.find("input"))[1]);
    var toggle = false;
    $(freeze_or_not.find(".radio")[0]).click(function() {

        $(freeze_or_not.find("input"))[0].checked = true;
        $(freeze_or_not.find("input"))[1].checked = false;
        /*if(public_btn.is(this))
        {
           public_btn.addClass("is-clicked");
           private_btn.removeClass("is-clicked");
        } else
        {
           private_btn.addClass("is-clicked");
           public_btn.removeClass("is-clicked");
        }*/

        if(freeze_or_not_state)
        {
            freeze_or_not_state = false;
            pub_priv_btn.animate({
                opacity: 1,
                marginTop: '+=4rem'
            }, 400 );
            public_btn.animate({
                marginRight: '+=4rem'
            }, 400 );
        }

        pub_priv_btn.animate({
            opacity: 1,
        }, 200 );             
    });

    $(freeze_or_not.find(".radio")[1]).click(function() {
        $(freeze_or_not.find("input"))[1].checked = true;
        $(freeze_or_not.find("input"))[0].checked = false;


        pub_priv_btn.animate({
            opacity: 0,
        }, 200 );

        button_actions.animate({
                opacity: 0
            }, 200 );
    });


    //Radio
    pub_priv_btn.click(function() {
        if(public_btn.is(this))
        {console.log("public");
           public_btn.addClass("is-clicked");
           private_btn.removeClass("is-clicked");
        } else
        {console.log("private");
           private_btn.addClass("is-clicked");
           public_btn.removeClass("is-clicked");
        }

        //button_actions.show("slow"); doesn't work?
        button_actions.animate({
                opacity: 1
            }, 400 );
    });

 
});
