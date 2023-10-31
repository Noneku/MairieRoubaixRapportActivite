document.addEventListener("DOMContentLoaded", function() {
    // Désactiver le formulaire au chargement de la page
    const form = document.querySelector(".form");
    form.querySelectorAll("input, textarea").forEach(function(input) {
        input.setAttribute("disabled", true);
    });

    // Activer le formulaire lorsque le bouton "Editer" est cliqué
    const editerButton = document.getElementById("editer");
    const validerButton = document.getElementById("valider");
    editerButton.addEventListener("click", function() {
        form.querySelectorAll("input, textarea:not(.textRH):not(.textFinance)").forEach(function(input) {

            input.removeAttribute("disabled");
        });
        editerButton.setAttribute("disabled", true);
        validerButton.removeAttribute("disabled");
    });
});
