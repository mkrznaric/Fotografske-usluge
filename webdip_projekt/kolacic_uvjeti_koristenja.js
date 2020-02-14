//addEventListener("load", function () {
//    provjeriKolacic();
//});
//
//function dohvatiKolacic(cname) {
//    var name = cname + "=";
//    var ca = document.cookie.split(';');
//    for (var i = 0; i < ca.length; i++) {
//        var c = ca[i];
//        while (c.charAt(0) === ' ') {
//            c = c.substring(1);
//        }
//        if (c.indexOf(name) === 0) {
//            return c.substring(name.length, c.length);
//        }
//    }
//    return "";
//}
//
//function postaviKolacic(exdays, cname, cvalue) {
//    var d = new Date();
//    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
//    var expires = "expires=" + d.toUTCString();
//    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
//}
//
//function provjeriKolacic() {
//    if (dohvatiKolacic("prvi dolazak") === "") {
//        alert("Klikom na 'U redu' prihvacate uvjete koristenja!");
//        postaviKolacic(365, "prvi dolazak", "prvi dolazak");
//    }
//}
//
//
