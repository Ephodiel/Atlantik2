<html>
<body>
<?php
    echo form_open('bonjournom');
    /* 'bonjournom' entrée routée vers 'Test::bonjourNom', en POST =  
    Méthode bonjourNom de Test appelée pour traitement formulaire */
    echo csrf_field(); // Pour sécurité
    echo form_label('Entrez votre nom ','txtNom');
    echo form_input('txtNom','');  
    echo form_submit('btnOK','OK');
    echo form_close();
?>
</body>
</html>