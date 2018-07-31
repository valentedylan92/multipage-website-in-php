<?php
    include('includes/header.php');
    if(isset($_GET['messageStatus'])){
        $status = "<p class=''>Votre message à bien été envoyé ! Merci !</p>";
    }else {
        $status = "";
    }
?>

<div id="mainContent" class="container">
    <h2>Contact</h2>
    <!-- <div class="row">
        <div class="col-4">First</div>
        <div class="col-4">Second</div>
        <div class="col-4">Third</div>
    </div> -->
    <div class="row">
        <div class="col-12">
            <?= $status ?>
            <form enctype="multipart/form-data" method="post" action="contact-treatment.php">
                <label for="contact-title">Titre</label>
                <input type="radio" name="contact-title" value="Ms"> Mme
                <input type="radio" name="contact-title" value="Mrs"> Melle
                <input type="radio" name="contact-title" value="Mr"> M.<br>
                <label for="contact-first-name">Prénom</label>
                <input type="text" name="contact-first-name" id="contact-first-name"><br>
                <label for="contact-surname">Nom</label>
                <input type="text" name="contact-surname" id="contact-surname"><br>
                <label for="contact-email">Email</label>
                <input type="email" name="contact-email" id="contact-email" required><br>
                <label for="contact-subject">Objet</label>
                <select name="contact-subject" id="contact-subject">
                    <option value="-" selected></option>
                    <option value="Infos">Demande d'informations</option>
                    <option value="Appointment">Prise de rendez-vous</option>
                </select><br>
                <label for="contact-message">Message</label>
                <textarea name="contact-message" id="contact-message" cols="30" rows="10" required></textarea><br>
                <label for="contact-format">Format de réponse souhaité</label>
                <input type="radio" name="contact-format" value="html"> HTML
                <input type="radio" name="contact-format" value="txt"> Texte
                <input type="file" size="32" name="contact-picture"><br>
                <input type="submit" name="submit" value="Envoyer">
            </form>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php')
?>