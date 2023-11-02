document.addEventListener("DOMContentLoaded", function() {
    let submitButton = document.querySelector('#submitButton');
});

submitButton.addEventListener("click", (event) => {
    setTimeout(function() {
        window.location.href = "{{ path('app_rapport_activite_edit', {'id': rapportActivite.getId(), 'url': url}) }}";
    }, 2000);
});