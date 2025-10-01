// script.js - validações e UI helpers
document.addEventListener("DOMContentLoaded", () => {
  // Mostrar/ocultar formulários de login/cadastro se existirem
  const showForm = (idToShow) => {
    document.querySelectorAll(".modal-form").forEach(m => m.style.display = "none");
    const el = document.getElementById(idToShow);
    if (el) el.style.display = "block";
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  document.querySelectorAll("[data-show]").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const target = btn.getAttribute("data-show");
      showForm(target);
    });
  });

  // simple validation
  window.validarFormulario = function(form){
    const campos = form.querySelectorAll("input[required], textarea[required], select[required]");
    for (let campo of campos) {
      if (campo.value.trim() === "") {
        alert("Por favor, preencha todos os campos obrigatórios.");
        campo.focus();
        return false;
      }
    }
    return true;
  };

  // font size helpers (controlados por botões caso use)
  window.aumentarFonte = function(){ document.body.style.fontSize = "18px"; }
  window.reduzirFonte = function(){ document.body.style.fontSize = "14px"; }

});
