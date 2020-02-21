// pour la page bâtiments

var selection_energie = document.getElementById("prodenergie");
var selection_militaire = document.getElementById("instmilitaire");
var selection_civil = document.getElementById("civilrechocc");

if (selection_energie && selection_militaire && selection_civil) {
    selection_energie.addEventListener("click", function (e) {
        e.preventDefault();
        if (document.getElementById("pe").style.display === "none") {
            document.getElementById("pe").style.display = ""
        } else {
            document.getElementById("pe").style.display = "none"
        }
        console.log("clickenergie");

    });

    selection_militaire.addEventListener("click", function (e) {
        e.preventDefault();
        if (document.getElementById("im").style.display === "none") {
            document.getElementById("im").style.display = ""
        } else {
            document.getElementById("im").style.display = "none"
        }
        console.log("clickmilitaire");
    });

    selection_civil.addEventListener("click", function (e) {
        e.preventDefault();
        if (document.getElementById("cro").style.display === "none") {
            document.getElementById("cro").style.display = ""
        } else {
            document.getElementById("cro").style.display = "none"
        }
        console.log("clickcivil");
    });

}
// Pour la page pré-requis

var selbat = document.getElementById("ongbat");
var seltech = document.getElementById("ongtech");
var selcomp = document.getElementById("ongcomp");
var seldef = document.getElementById("ongdef");
var selunit = document.getElementById("ongunit");

if (selbat && seltech && selcomp && seldef && selunit) {


    selbat.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selbat.classList.add("ongactif");
        document.getElementById("ongbat2").style.display = "block";
        document.getElementById("ongtech2").style.display = "none";
        document.getElementById("ongcomp2").style.display = "none";
        document.getElementById("ongdef2").style.display = "none";
        document.getElementById("ongunit2").style.display = "none";

    });

    seltech.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        seltech.classList.add("ongactif");
        document.getElementById("ongtech2").style.display = "block";
        document.getElementById("ongbat2").style.display = "none";
        document.getElementById("ongcomp2").style.display = "none";
        document.getElementById("ongdef2").style.display = "none";
        document.getElementById("ongunit2").style.display = "none";

    });

    selcomp.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selcomp.classList.add("ongactif");
        document.getElementById("ongcomp2").style.display = "block";
        document.getElementById("ongtech2").style.display = "none";
        document.getElementById("ongbat2").style.display = "none";
        document.getElementById("ongdef2").style.display = "none";
        document.getElementById("ongunit2").style.display = "none";

    });

    seldef.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        seldef.classList.add("ongactif");
        document.getElementById("ongdef2").style.display = "block";
        document.getElementById("ongtech2").style.display = "none";
        document.getElementById("ongcomp2").style.display = "none";
        document.getElementById("ongbat2").style.display = "none";
        document.getElementById("ongunit2").style.display = "none";

    });

    selunit.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selunit.classList.add("ongactif");
        document.getElementById("ongunit2").style.display = "block";
        document.getElementById("ongtech2").style.display = "none";
        document.getElementById("ongcomp2").style.display = "none";
        document.getElementById("ongdef2").style.display = "none";
        document.getElementById("ongbat2").style.display = "none";

    });
}

// pour la page Chantier spatial

var selvaiss = document.getElementById("ongvaisseaux");
var selcompos = document.getElementById("ongcomposants");
var selassbl = document.getElementById("ongassembler");

if (selvaiss && selassbl && selcompos) {
    selvaiss.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selvaiss.classList.add("ongactif");
        document.getElementById("ongvaisseaux2").style.display = "block";
        document.getElementById("ongcomposants2").style.display = "none";
        document.getElementById("ongassembler2").style.display = "none";
    });

    selcompos.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selcompos.classList.add("ongactif");
        document.getElementById("ongvaisseaux2").style.display = "none";
        document.getElementById("ongcomposants2").style.display = "block";
        document.getElementById("ongassembler2").style.display = "none";
    });

    selassbl.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactif");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactif");
        }
        selassbl.classList.add("ongactif");
        document.getElementById("ongvaisseaux2").style.display = "none";
        document.getElementById("ongcomposants2").style.display = "none";
        document.getElementById("ongassembler2").style.display = "block";
    });


}

// pour les onglets de compo dans la creation de vaisseaux

var selarmescv = document.getElementById("ongCVarmes");
var selblindcv = document.getElementById("ongCVblind");
var selboucv = document.getElementById("ongCVbou");
var selreaccv = document.getElementById("ongCVreac");
var selcaptcv = document.getElementById("ongCVcapt");
var selbroucv = document.getElementById("ongCVbrouill");
var selocccv = document.getElementById("ongCVocc");

if (selarmescv && selblindcv && selboucv && selreaccv && selcaptcv && selbroucv && selocccv) {
    selarmescv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selarmescv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "block";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selblindcv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selblindcv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "block";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selboucv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selboucv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "block";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selreaccv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selreaccv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "block";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selcaptcv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selcaptcv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "block";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selbroucv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selbroucv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "block";
        document.getElementById("ongCVocc2").style.display = "none";

    });

    selocccv.addEventListener("click", function (e) {
        e.preventDefault();
        var ongletsactifs = document.getElementsByClassName("ongactifCV");
        for (var i = 0; i < ongletsactifs.length; i++) {
            ongletsactifs[i].classList.remove("ongactifCV");
        }
        selocccv.classList.add("ongactifCV");
        document.getElementById("ongCVarmes2").style.display = "none";
        document.getElementById("ongCVblind2").style.display = "none";
        document.getElementById("ongCVbou2").style.display = "none";
        document.getElementById("ongCVreac2").style.display = "none";
        document.getElementById("ongCVcapt2").style.display = "none";
        document.getElementById("ongCVbrouill2").style.display = "none";
        document.getElementById("ongCVocc2").style.display = "block";

    });

}
