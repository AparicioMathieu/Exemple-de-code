if (classautiliser) {

    var compteurElt = document.getElementById(classautiliser);
    console.log(classautiliser);

    function CleanDuration(nombre) {

        if (nombre < 60) {
            return nombre.toString() + " sec";
        } else if (nombre < 3600) {
            let minutes = Math.floor(nombre / 60);
            let secondes = Math.floor(nombre % 60);
            return minutes.toString() + " min " + secondes.toString() + " sec";
        } else if (nombre < 86400) {
            let heures = Math.floor(nombre / 3600);
            let minutes = Math.floor(nombre / 60) - heures * 60;
            let secondes = Math.floor(nombre % 60);
            return heures.toString() + " h " + minutes.toString() + " min " + secondes.toString() + " sec";
        } else {
            let jours = Math.floor(nombre / 86400);
            let heures = Math.floor(nombre / 3600) - jours * 24;
            let minutes = Math.floor(nombre / 60) - jours * 1440 - heures * 60;
            let secondes = Math.floor(nombre % 60);
            return jours.toString() + " j " +
                heures.toString() + " h " +
                minutes.toString() + " min " +
                secondes.toString() + " sec";
        }


    }

    function diminuerCompteur() {
        if (decompte > 1) {
            decompte = decompte - 1;
            compteurElt.textContent = CleanDuration(decompte);
        } else {
            clearInterval(Jeanjimmy);
            compteurElt.textContent = "Terminé";
            var annuleravirer = document.getElementsByClassName('bat_annuler');
            for (var i = 0; i < annuleravirer.length; i++) {
                annuleravirer[i].style.display = "none";
            }
        }

    }
    var decompte = value_initiale;
    var Jeanjimmy = setInterval(diminuerCompteur, 1000);
    document.getElementById(divenglobante).style.display = "";
}
