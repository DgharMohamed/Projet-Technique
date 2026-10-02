const apiOffre = "../backend/api/GestionOffre.php";
const apiDomaine = "../backend/api/GestionDomaine.php";

const form = document.getElementById("form");
const formSection = document.getElementById("formSection");
const tbody = document.getElementById("tbody");
const domaineSelect = document.getElementById("domaineSelect");

let domaines = [];

document.getElementById("btnAdd").onclick = () => formSection.classList.remove("hidden");
document.getElementById("btnCancel").onclick = () => formSection.classList.add("hidden");

fetch(apiDomaine)
  .then((response) => response.json())
  .then((data) => {
    domaines = data;
    domaineSelect.innerHTML = domaines
      .map((d) => `<option value="${d.id}">${d.nom}</option>`)
      .join("");
    loadOffres();
  });

function loadOffres() {
  fetch(apiOffre)
    .then((response) => response.json())
    .then((offres) => {
      tbody.innerHTML = offres
        .map((o) => {
          const d = domaines.find((x) => x.id == o.domaine_id);
          return `
            <tr>
                <td class="p-3">${o.titre}</td>
                <td class="p-3">${d?.nom || "-"}</td>
                <td class="p-3">${o.salaire} DH</td>
            </tr>`;
        })
        .join("");
    });
}

form.onsubmit = (e) => {
  e.preventDefault();

  fetch(apiOffre, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(Object.fromEntries(new FormData(form))),
  })
    .then((response) => response.json())
    .then(() => {
      form.reset();
      formSection.classList.add("hidden");
      loadOffres();
    });
};
