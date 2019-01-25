$(document).ready(function () {

    function actualise(){ /*Cette fonction permet de changer les composant pour s'adapter a l'écran de l'uttilisateur*/
        if($(window).width() < 860 ){/*Si l'écran est plus petit qu'une tablette*/
            $('#buttonMenu').show(); /*alors on affiche le menu dérroullant, on cache les liens et on rend le logo plus gros*/
            $('.submenu').css('display', 'none');
            $('#logo').css('width','60%');
            $('#logo').css('height','60%');
        } else {/*Sinon on cache le menu dérroullant, on affiche la navbar et le logo prend ca taille habituelle*/
            $('#buttonMenu').hide();
            $('.submenu').css('display', 'block');
            $('#logo').css('width','15%');
            $('#logo').css('height','15%');
        }
    }

    actualise();/*Au commencement du code, on actualise l'affichage*/

    $('#buttonMenu').click(function(){ /*Si on clique sur le bouton du menu déroullant*/
        if($('.submenu').css('display') == 'none'){/*Alors on inverse l'état des liens de la navbar*/
            $('.submenu').css('display', 'block');
        } else {
            $('.submenu').css('display', 'none');
        }
    });

    $(window).resize(function(){/*Si la page est redimmensionné, on l'actualise*/
        actualise();
    });

    /*
     *  Affichage/masquage de la navbar
     */
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
                $("#null").slideUp(function () {
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
                $("#null").slideDown(function () {
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
