$(document).ready(function () {
    DohvatiOpremu();
    $("#pretrazi").click(function () {
        $("div[name=popisOpreme]").empty();
        DohvatiSelektiraniZapis();
    });
    PromijeniKonfiguraciju();
    DohvatiRegistriraneKorisnike();
    promijeniStatus();
    UnesiLokacijuUBazu();
    DohvatiLokacije();
    DohvatiModeratore();
    DodijeliModeratoraLokaciji();
    DodajOpremuUBazu();
    $('#table_id').DataTable({
        ordering: false
    });
});
function DohvatiOpremu() {
    $.ajax({
        url: 'ajaxskripte/dohvati_opremu.php',
        type: 'post',
        dataType: 'JSON',
        success: function (data) {
            var tablica = '<table class="popis"><tr><th class="zaglavlje">Naziv opreme</th><th class="zaglavlje">Lokacija</th></tr>';
            $.each(data, function (index, key) {
                tablica += '<tr>\n<td><a id="imeOpreme" href=oprema.php?naziv=' + data[index].id + '>' + data[index].naziv + '</a></td>\n<td><a id="imeLokacije" href=lokacija.php?id_lokacija=' + data[index].lokacija_id + '>' + data[index].lokacija + '</a></td>\n</tr>\n';
            });
            tablica += '</table>';
            $("div[name=popisOpreme]").append(tablica);
            PrikaziDetalnijeZapise();
        }


    });

}
function DohvatiSelektiraniZapis() {
    var nazivOpreme = $("#vrijednostPretrazi").val();
    var idLokacije = $('#combo').children('option:selected').val();
    event.preventDefault();
    $.ajax({
        url: 'ajaxskripte/selektiraj_opremu.php',
        type: 'post',
        data: {naziv: nazivOpreme, id: idLokacije},
        dataType: 'JSON',
        success: function (data) {

            if (data.length > 0) {

                var tablica = '<table class="popis"><tr><th class="zaglavlje">Naziv opreme</th><th class="zaglavlje">Lokacija</th></tr>';
                $.each(data, function (index, key) {
                    tablica += '<tr>\n<td><a id="imeOpreme" href=oprema.php?naziv=' + data[index].id + '>' + data[index].naziv + '</a></td>\n<td><a id="imeLokacije" href=lokacija.php?id_lokacija=' + data[index].lokacija_id + '>' + data[index].lokacija + '</a></td>\n</tr>\n';
                });
                tablica += '</table>';

                $("div[name=popisOpreme]").append(tablica);
                PrikaziDetalnijeZapise();
            } else {

                $("div[name=popisOpreme]").append("Nema rezultata");
            }

        },
        error: function (pom) {
            alert(pom);
        }

    });
}

function PrikaziDetalnijeZapise() {
    $("#popisOpreme > table > tbody > tr> td > a[id=imeLokacije]").click(function () {
        var link = $(this).attr('href');
        $.ajax({
            url: 'ajaxskripte/dohvati_pojedinacne_stavke.php',
            type: 'get',
            data: {link: link},
            dataType: 'json',
            success: function (data) {

                var tablica = '<table class="popis"><tr><th class="zaglavlje">Naziv</th><th class="zaglavlje">Zupanija</th><th>Dodatne informacije</th></tr>';
                $.each(data, function (index, key) {
                    tablica += '<tr>\n<td>' + data[index].naziv + '</td>\n<td>' + data[index].zupanija + '</td>\n<td>' + data[index].dodatneInformacije + '</td></tr>\n';
                });
                tablica += '</table>';
                $("#detalji").empty();
                $("#detalji").append(tablica);
            }


        });


        event.preventDefault();
    });

}

function PromijeniKonfiguraciju() {
    $("form[name=konf]").submit(function () {
        event.preventDefault();
        var trajanjeKolacicaPrijave = $("input[name=kolacic_prijava]").val();
        var trajanjekolacicaUvjeta = $("input[name=kolacic_uvjeti]").val();
        var duljinaNoveLozinke = $("input[name=nova_loz]").val();
        var TrajanjeAktivacijskogLinka = $("input[name=akt_trajanje]").val();
        var brojPokusaja = $("input[name=neus_prijava]").val();
        $.ajax({
            url: "ajaxskripte/UnosKonfiguracije.php",
            type: "POST",
            data: {kolacicPrijave: trajanjeKolacicaPrijave, kolacicUvjeta: trajanjekolacicaUvjeta, novaLozinka: duljinaNoveLozinke, aktivacijskiLink: TrajanjeAktivacijskogLinka, pokusaji: brojPokusaja},
            dataType: 'text',
            success: function (data) {
                alert(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

}
function promijeniStatus() {
    $("#promijeniUseruStatus").click(function () {

        var vrijednostComba = $("input[type=radio]:checked").val();
        $.ajax({
            url: "ajaxskripte/PromijeniStatusKorisnika.php",
            type: "post",
            data: {id: vrijednostComba},
            dataType: 'text',
            success: function (data) {
                alert(data);
            }

        });
    });

}

function DohvatiRegistriraneKorisnike() {

    $.ajax({
        url: "ajaxskripte/RegistriraniKorisnici.php",
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var options = '<select id="reguomd" name="registriranikorisnici">';
            $.each(data, function (index, key) {
                options += '<option value="' + data[index].id_korisnik + '">' + data[index].korime + '</option>';

            });
            options += '</select>';
            $("span[name=registriraniKorisnici]").append(options);

            $("input[name=prekvalificirajumoderatora]").click(function () {
                var userID = $("#reguomd").children("option:selected").val();
                
                $.ajax({
                    url: "ajaxskripte/PromijeniUModeratoraAjax.php",
                    type: "POST",
                    data: {id: userID},
                    dataType: 'text',
                    success: function (data) {
                        alert(data);
                        DohvatiRegistriraneKorisnike();
                    },
                    error: function (err) {
                        console.log(err);
                    }


                });

            });
        }



    });
}

function UnesiLokacijuUBazu() {
    
    $("#dodajnovulokacijuubazu").click(function () {
      
        var nazivLokacije=$("input[name=nazivLokacije]").val();
        var nazivZupanije=$("input[name=zupanija]").val();
        var dodatneInformacije=$("textarea[name=dodatneInformacije]").val();
        if(nazivLokacije.length>0 && nazivZupanije.length>0 && dodatneInformacije.length>0){
            $.ajax({
                url:"ajaxskripte/UnesiLokaciju.php",
                type:"post",
                data:{naziv:nazivLokacije,zupanija:nazivZupanije,info:dodatneInformacije},
                dataType:"text",
                success:function(data){
                    alert(data);
                },
                error:function (err) {
                    console.log(err);
                }
                
            });
        }else{
            alert("Morate popuniti sve elemente !");
        }
    });



}

function DohvatiLokacije(){
    $.ajax({
        url:"ajaxskripte/DohvatiPopisLokacije.php",
        type:"POST",
        dataType:"JSON",
        success:function (data){
            var options = '<select id="lokacijaZaModeratora" name="lokacijazaMod">';
            $.each(data, function (index, key) {
                options += '<option value="' + data[index].id + '">' + data[index].naziv + '</option>';

            });
            options += '</select>';
            $('#popisLokacija').html(options);
        }
    });
}

function DohvatiModeratore(){
    $.ajax({
        url:"ajaxskripte/DohvatiModeratore.php",
        type:"POST",
        dataType:"JSON",
        success:function (data){
            var options = '<select id="potencijalniModerator" name="potencijalniModerator">';
            $.each(data, function (index, key) {
                options += '<option value="' + data[index].id_korisnik + '">' + data[index].korime + '</option>';

            });
            options += '</select>';
            $('span[id=popisModeratoraLokacija]').html(options);
        },
        error:function(err){
            console.log(err);
        }
    });
    
}

function DodijeliModeratoraLokaciji(){
    $("#potvrdiModeratora").click(function(){
        $('#combo').children('option:selected').val();
        var moderatorID=$("#potencijalniModerator").children('option:selected').val();
        var lokacijaID=$("#lokacijaZaModeratora").children('option:selected').val();
       $.ajax({
           url:"ajaxskripte/DodajModeratoraLokaciji.php",
           type:"POST",
           data:{moderatorID:moderatorID,lokacijaID:lokacijaID},
           dataType:"text",
           success:function(data){
               alert(data);
           }
           
       });
        
    });
}

function DodajOpremuUBazu(){
    $("#dodajOpremu").click(function(){
        var naziv=$("#nazivOpreme").val();
        var opis= $("#detaljiOpreme").val();
        var lokacijaID=$("#lokacijaZaModeratora").children("option:selected").val();
        alert(lokacijaID);
        $.ajax({
            url:"ajaxskripte/DodajOpremu.php",
           type:"POST",
           data:{naziv:naziv,opis:opis,lokacijaID:lokacijaID},
           dataType:"text",
           success:function(data){
               alert(data);
           }
            
        });
        
    });
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


