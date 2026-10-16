const offreAPI = "../backend/api/GestionOffre.php";
const domaineAPI = "../backend/api/GestionDomaine.php";
const form = document.getElementById("form");
const tbody = document.getElementById("tbody");
const select = document.getElementById("domaineSelect");

document.getElementById("btnAdd").onclick = () => form.classList.remove("hidden");
document.getElementById("btnCancel").onclick = () => form.classList.add("hidden");

fetch(domaineAPI)
  .then(response => response.json())
  .then(domaines => {
    select.innerHTML = domaines
      .map(domaine => `<option value="${domaine.id}">${domaine.nom}</option>`)
      .join("");

    fetch(offreAPI)
      .then(response => response.json())
      .then(offres => {
        tbody.innerHTML = offres.map(offre => {
          const domaine = domaines.find(d => d.id == offre.domaine_id);
          return `<tr class="border-t">
          <td class="p-3">${offre.titre}</td>
          <td class="p-3">${domaine ? domaine.nom : "-"}</td>
          <td class="p-3">${offre.salaire} DH</td>
          </tr>`;
        }).join("");
      });
  });

form.onsubmit = event => {
  const offre = {
    titre: form.elements.titre.value,
    salaire: form.elements.salaire.value,
    domaine_id: form.elements.domaine_id.value
  };

  event.preventDefault();
  fetch(offreAPI, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(offre)
  }).then(() => location.reload());
};
