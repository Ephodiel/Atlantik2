<html>
<body>
<?php
    echo form_open('chutelibre');
    /* 'bonjournom' entrée routée vers 'Test::bonjourNom', en POST =  
    Méthode bonjourNom de Test appelée pour traitement formulaire */
    echo csrf_field(); // Pour sécurité

    echo form_label('Champ de pesanteur (g en m/s2)','txtpesanteur');
    echo form_input('txtpesanteur','');

    echo form_label('instant (t en seconde)','txttemps');
    echo form_input('txttemps',''); 

    echo form_submit('btnEnvoyer','envoyer');   
    echo form_close();
    ?>
</body>
</html>