<div class="container push-padding" style="width: 520px; padding: 50px 20px;">

    <img src="assets/images/logo.png" class="img-fluid mx-auto d-block" alt="Logo" style="margin-bottom: 50px;">

    <form action="register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="Text" name="email" class="form-control" id="email" placeholder="Email" value="<?php if(isset($email)){echo $email;}?>" required>
        </div>
        <div class="form-group">
            <label for="surname">Voornaam</label>
            <input type="text" name="surname" class="form-control" id="surname" placeholder="Voornaam" value="<?php if(isset($surname)){echo $surname;}?>" required>
        </div>
        <div class="form-group">
          <label for="infix">Tussenvoegsels</label>
          <input type="text" name="infix" class="form-control" id="infix" placeholder="Tussenvoegsels" value="<?php if(isset($infix)){echo $infix;}?>">
        </div>
        <div class="form-group">
          <label for="last name">Achternaam</label>
          <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Achternaam" value="<?php if(isset($last_name)){echo $last_name;}?>" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="street">Straat</label>
            <input type="text" name="street" class="form-control" id="street" placeholder="Straat" value="<?php if(isset($street)){echo $street;}?>" required>
          </div>
          <div class="form-group col-md-4">
            <label for="housenumber">Huisnummer</label>
            <input type="text" name="housenumber" class="form-control" id="housenumber" placeholder="Huisnummer" value="<?php if(isset($housenumber)){echo $housenumber;}?>"required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="city">Woonplaats</label>
            <input type="text" name="city" class="form-control" id="city" placeholder="Woonplaats" value="<?php if(isset($city)){echo $city;}?>" required>
          </div>
          <div class="form-group col-md-4">
            <label for="postal code">Postcode</label>
            <input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Postcode" value="<?php if(isset($postal_code)){echo $postal_code;}?>"required>
          </div>
        </div>
        <div class="form-group">
          <label for="phonenumber">Telefoonnummer</label>
          <input type="text" name="phonenumber" class="form-control" id="phonenumber" placeholder="Telefoonnummer" value="<?php if(isset($phonenumber)){echo $phonenumber;}?>">
        </div><br><br>
        <div class="form-group">
          <label for="username">Gebruikersnaam</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Gebruikersnaam" required>
        </div>
        <div class="form-group">
          <label for="password">Wachtwoord</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Wachtwoord" required>
        </div>
        <div class="form-group">
          <label for="passwordCheck">Herhaal wachtwoord</label>
          <input type="password" name="passwordCheck" class="form-control" id="passwordCheck" placeholder="Herhaal wachtwoord" required>
        </div>
        <button type="submit" value="Submit" name="register" class="btn btn-primary">Registreren</button>
    </form>
    <?php
    if (count($errorMessages) >= 1) {
      foreach ($errorMessages as $value) {
        echo $value . "<br />";
      }
    }
    ?>
  </div>
