const form=document.getElementById("form-domaine")
const sectionForm=document.getElementById("section-form")
const btnAjouter=document.getElementById("btn-show-form")
const btnAnnuler=document.getElementById("btn-cancel-form")
const tbody=document.getElementById("table-domaines-body")
const btnEnregister=document.getElementById("enregister")
const api="http://localhost:8000/backend/api/api.php"


function Loading(isloading){
    if(isloading){
        btnEnregister.disabled=true
        btnEnregister.textContent="En cours ..."
    }
    else{
        btnEnregister.disabled=false
        btnEnregister.textContent="Enregistrer"
    }
}

function Toast(message,type="success"){
    const toastContainer=document.getElementById("toast-container")
    const toast=document.createElement("div")
    const color=type=="success"?'bg-green-500':'bg-red-500'

    toast.className=`
        ${color} px-5 py-4 text-white transition-opacity duration-500
    `

    toast.textContent=`${message}`
    toastContainer.appendChild(toast)
    setTimeout(()=>{
        toast.style.opacity=0
        setTimeout(()=>{
            toast.remove()
        },500)
    },3000)
}

function AfficherDomaines(){
    fetch(api).then(response=>
        response.json()
    )
    .then(data=>{
        console.log(data)
        tbody.innerHTML=""
        data.forEach(domaine=>{
            const tr=document.createElement("tr")
            tr.innerHTML=`
                <td class="px-4 py-3">${domaine["nom"]}</td>
                <td class="px-4 py-3">${domaine["description"]}</td>
            `
            tbody.appendChild(tr)
        })
    })
    .catch(error=>{
        Loading(false)
        console.error(error)
    })
}


document.addEventListener("DOMContentLoaded",()=>{
    AfficherDomaines()
    form.addEventListener("submit",(e)=>{
        e.preventDefault()
        Loading(true)
        fetch(api,{
            method:"POST",
            headers:{"Content-Type":"application/json"},
            body:JSON.stringify({
                nom:document.getElementById("nom").value,
                description:document.getElementById("description").value
            })
        }).then(response=>response.json())
        .then(data=>{
            Loading(false)
            Toast(data["message"])
            form.reset()
            AfficherDomaines()
        })
    })
})


btnAjouter.addEventListener("click",()=>sectionForm.classList.remove("hidden"))
btnAnnuler.addEventListener("click",()=>{
    sectionForm.classList.add("hidden")
    form.reset()
})
