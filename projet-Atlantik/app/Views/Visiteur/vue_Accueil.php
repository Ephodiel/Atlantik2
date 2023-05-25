<?php
return view('Templates/Header')
            . view('Visiteur/vue_VoirDetailUneReservations', $data)
            . view('Templates/Footer');
?>