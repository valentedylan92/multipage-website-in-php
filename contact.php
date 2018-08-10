<?php
    include('includes/header.php');
    if(isset($_GET['messageStatus'])){
        $status = "<p class=''>Votre message à bien été envoyé ! Merci !</p>";
    }else {
        $status = "";
    }
    function addAuthFields() {
        if(!file_exists('includes/auth.php')){
            echo '<label for="contact-title">Adresse mail SMTP</label>
            <input type="text" name="username" id="username">
            <label for="contact-title">Mot de passe mail SMTP</label>
            <input type="password" name="password" id="password">';
        }
    }
?>

<div id="mainContent" class="container">
    <!-- <h2>Contact</h2> -->
    <h1 class="main__title">Contact</h1>

    <div class="row">
        <div class="col-12">
            <?= $status ?>
            <form enctype="multipart/form-data" method="post" action="contact-treatment.php">
                <label for="contact-title">Titre</label>
                <input type="radio" name="contact-title" value="Ms"> Mme
                <input type="radio" name="contact-title" value="Mrs"> Melle
                <input type="radio" name="contact-title" value="Mr"> M.
                <label for="contact-first-name">Prénom</label>
                <input type="text" name="contact-first-name" id="contact-first-name">
                <label for="contact-surname">Nom</label>
                <input type="text" name="contact-surname" id="contact-surname">
                <label for="contact-email">Email</label>
                <input type="email" name="contact-email" id="contact-email" required>
                <label for="contact-subject">Objet</label>
                <select name="contact-subject" id="contact-subject">
                    <option value="-" selected></option>
                    <option value="Infos">Demande d'informations</option>
                    <option value="Appointment">Prise de rendez-vous</option>
                </select>
                <label for="contact-message">Message</label>
                <textarea name="contact-message" id="contact-message" cols="30" rows="10" required></textarea>
                <label for="contact-format">Format de réponse souhaité</label>
                <input type="radio" name="contact-format" value="html"> HTML
                <input type="radio" name="contact-format" value="txt"> Texte
                <label for="contact-picture">Photo</label>
                <input type="file" size="32" id="contact-picture" name="contact-picture">
                <?php addAuthFields(); ?>
                <input type="submit" name="submit" value="Envoyer">
            </form>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php')
?>
