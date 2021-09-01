;(function () {
  const footerForm = document.querySelector("form.form-horizontal")
  const submitButton = footerForm.querySelector("button.submit-button")
  const loadingImg = document.createElement("img")
  const nameInput = document.getElementById("nombre")
  const emailInput = document.getElementById("correo-electronico")

  loadingImg.setAttribute("src", orquidea_obj.image_path + "/loading.svg")

  footerForm.addEventListener("submit", function (event) {
    event.preventDefault()
    if (nameInput.value == "" || emailInput.value == "") {
      alert("Por favor, complete todos los campos")
    } else {
      submitButton.innerText = ""
      submitButton.appendChild(loadingImg)
      const formData = new FormData(footerForm)
      formData.append("action", "moi_sender_contact_form")
      formData.append("orquidea_nonce", orquidea_obj.security)
      axios
        .post(orquidea_obj.ajaxurl, formData)
        .then(function (response) {
          if (response.data.success) {
            submitButton.innerText = "Su mensaje ha sido enviado exitosamente."
            footerForm.reset()
          }
        })
        .catch(function (error) {
          submitButton.innerText = "Disculpe, ha ocurrido un error."
          console.error(error)
        })
    }
  })
})()
