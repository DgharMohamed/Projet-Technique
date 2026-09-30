const api = "../backend/api/GestionOffre.php"
const apiDomaines = "../backend/api/GestionDomaine.php"

const bodyTable = document.getElementById("bodyTable")
const form = document.getElementById("form")
const messageDiv = document.getElementById("message")
const domaineSelect = document.getElementById("domaine_id")

let offres = []
let domaines = []

// GET : charger les domaines (pour le menu déroulant)
function chargerDomaines() {
    return fetch(apiDomaines).then(response => response.json())
        .then(data => {
            domaines = data
            data.forEach(d => {
                domaineSelect.insertAdjacentHTML("beforeEnd", `<option value="${d.id}">${d.nom}</option>`)
            })
        }).catch(error => console.error(error))
}

// GET : charger les offres puis remplir le tableau
function afficherOffres() {
    return fetch(api).then(response => response.json())
        .then(data => {
            offres = data
            bodyTable.innerHTML = ""
            offres.forEach(offre => {
                bodyTable.insertAdjacentHTML("beforeEnd", `
                <tr>
                    <td class="p-4">${offre.titre}</td>
                    <td class="p-4">${nomDomaine(offre.domaine_id)}</td>
                    <td class="p-4">${offre.salaire} DH</td>
                    <td class="p-4">
                        <button class="bg-red-500 text-white px-3 py-1" onclick="supprimerOffre(${offre.id})">Supprimer</button>
                    </td>
                </tr>
                `)
            })
        }).catch(error => console.error(error))
}

// Retourne le nom d'un domaine à partir de son id
function nomDomaine(id) {
    const domaine = domaines.find(d => d.id == id)
    return domaine ? domaine.nom : "-"
}

// POST : ajouter une offre
function ajouterOffre(event) {
    event.preventDefault()

    fetch(api, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            titre: document.getElementById("titre").value,
            description: document.getElementById("description").value,
            salaire: document.getElementById("salaire").value,
            domaine_id: domaineSelect.value
        })
    }).then(response => response.json())
        .then(data => {
            afficherMessage(data.message, data.success)
            form.reset()
            afficherOffres()
        }).catch(error => console.error(error))
}

// DELETE : supprimer une offre
function supprimerOffre(id) {
    if (!confirm("Supprimer cette offre ?")) return

    fetch(api + "?id=" + id, { method: "DELETE" })
        .then(response => response.json())
        .then(data => {
            afficherMessage(data.message, data.success)
            afficherOffres()
        }).catch(error => console.error(error))
}

function afficherMessage(texte, succes) {
    messageDiv.textContent = texte
    messageDiv.className = succes
        ? "p-3 mb-4 bg-green-100 text-green-800"
        : "p-3 mb-4 bg-red-100 text-red-800"
}

document.getElementById("btnAjouter").addEventListener("click", () => {
    document.getElementById("sectionForm").classList.remove("hidden")
})

document.getElementById("annulerBtn").addEventListener("click", () => {
    document.getElementById("sectionForm").classList.add("hidden")
})

form.addEventListener("submit", ajouterOffre)

chargerDomaines().then(afficherOffres)
