$(function(){ /*Si le DOM est bien chargé alors:*/

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
});