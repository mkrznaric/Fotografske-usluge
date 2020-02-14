$(document).ready(function () {
    
    $('#ime').blur(function () {
        document.getElementById("pogreskaIme").style.color = "red";
        var ime = $('#ime').val();
        if (ime.length < 3 || ime.length > 15) {
            $('#pogreskaIme').text("Ime manje od 3 ili veće od 15!");
            $("#registrirajse").attr("disabled", true);
        } else {
            $('#pogreskaIme').text("");
            $("#registrirajse").attr("disabled", false);
        }
    });
    
    $('#prezime').blur(function () {
        document.getElementById("pogreskaPrezime").style.color = "red";
        var prezime = $('#prezime').val();
        if (prezime.length < 3 || prezime.length > 15) {
            $('#pogreskaPrezime').text("Prezime manje od 3 ili veće od 15!");
            $("#registrirajse").attr("disabled", true);
        } else {
            $('#pogreskaPrezime').text("");
            $("#registrirajse").attr("disabled", false);
        }
    });
    
    
    
    $('#korime').blur(function () {
        document.getElementById("pogreskaKorisnickoIme1").style.color = "red";
        var korime = $('#korime').val();
        if (korime.length < 5 || korime.length > 12) {
            $('#pogreskaKorisnickoIme1').text("Korisnicko ime manje od 5 ili veće od 12!");
            $("#registrirajse").attr("disabled", true);
        } else {
            $('#pogreskaKorisnickoIme1').text("");
            $("#registrirajse").attr("disabled", false);
        }
    });
 
 
    $('#email').blur(function () {
        document.getElementById("pogreskaEmail").style.color = "red";
        var email = $('#email').val();
        var regEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        var emailValjan = regEmail.test(email);

        if (!emailValjan) {
            $('#pogreskaEmail').text("Email nije ispravnog formata!");
            $("#registrirajse").attr("disabled", true);
        } else {
            $('#pogreskaEmail').text("");
            $("#registrirajse").attr("disabled", false);
        }
    });
    
    
    $('#lozinka1').blur(function () {
        document.getElementById("pogreskaLozinka1").style.color = "red";
        var lozinka = $('#lozinka1').val();
        if (lozinka.length < 6 || lozinka.length > 20) {
            $('#pogreskaLozinka1').text("Lozinka je manja od 6 ili veća od 20!");
            $("#registrirajse").attr("disabled", true);
        } else {
            $('#pogreskaLozinka1').text("");
            $("#registrirajse").attr("disabled", false);
        }
    });
    
    
});


