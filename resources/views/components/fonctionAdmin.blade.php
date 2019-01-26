@php
	if (isset($_SESSION['userloged']) && isset($_SESSION['grade']) && $_SESSION['grade']>= 4) {
		echo '<button type="button" class="btn btn-ban btn-danger"<i class="fas fa-ban"></i></button>';
		if ($_SESSION['grade']>= 5) {
			echo '<button type="button" class="btn btn-modify btn-warning"><i class="fas fa-wrench"></i></button>';
			echo '<button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button>';
		}
	}
	/*A REFAIRE EN PHP AU PROPRE AVEC GENERATION DE 3 ARTICLES*/
@endphp
				
{{-- A SUPPRIMER UNE FOIS LE PHP FINIT --}}
<button type="button" alt="ban" class="btn btn-ban btn-danger"><i class="fas fa-ban"></i></button>
<button type="button" alt="modify" class="btn btn-modify btn-warning"><i class="fas fa-wrench"></i></button>
<button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button>