{{-- The meta and title element of the website --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ isset($title) ? $title : 'BDE EXIA NANCY'}}</title>
<meta name="Description" content=
    @php
        echo '"Site officiel du Bureau Des Etudiants du campus Cesi Exia Nancy.';
        if(isset($description)){
            echo $description;
        }
        echo '"';
    @endphp
>
<meta name="Category" content="BDE, Nancy, Etudiant, association, Cesi, Exia, Evenementiel, Activité, e-commerce">
<meta name="Copyright" content="Cesi BDE 2019">
<meta name="Publisher" content="BDE Cesi Exia Nancy">
<link rel="shortcut icon" href="/images/incon.ico">
