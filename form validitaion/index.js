// const firstName = document.getElementById("firstname");
// const lastName = document.getElementById("lastname");
// const email = document.getElementById("email");
// const password = document.getElementById("password");
// const submit = document.getElementById("submit");
// const reset = document.getElementById("reset");

// // new Window
// const newWindow = (arr) => {
//   const newWindow = window.open("", "", "width=300,height=400");
//   // create div for showing data
//   const newDivForNewWindow = document.createElement("div");
//   // added styled on new created div
//   newDivForNewWindow.style.border = "1px solid black";
//   newDivForNewWindow.style.padding = "1rem";
//   newDivForNewWindow.style.margin = "1rem";
//   newDivForNewWindow.style.textAlign = "center";
//   // added new html and append data on new div
//   for (const el of arr) {
//     const h6 = document.createElement("h6");
//     h6.innerText = `
//    ${el[0]} : ${el[1]}
//     `;
//     newDivForNewWindow.appendChild(h6);
//   }
//   // append new div in new window as child
//   newWindow.document.body.appendChild(newDivForNewWindow);
// };

// // Submit Handle
// const handleSubmit = () => {
//   newWindow([
//     ["Name", `${firstName.value} ${lastName.value}`],
//     ["Email", email.value],
//     ["Password", password.value],
//   ]);
// };
// submit.addEventListener("click", () => handleSubmit());

class FormHandler {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.submitButton = document.getElementById('submit');
        this.submitButton.addEventListener('click', this.handleSubmit.bind(this));
    }
    handleSubmit() {
        const formData = this.getFormData();
        this.showFormDataInNewWindow(formData);
    } 
    getFormData() {
        const formData = {};
        const formElements = this.form.elements;
        for (const element of formElements) {     
            if (element.name) {
                formData[element.name] = element.value;
            }
        }
        return formData;
    }
    showFormDataInNewWindow(formData) {
        const newWindow = window.open("", "", "width=300,height=400");
        //   create new element for add on new window
        const shownData=document.createElement("pre") 
        for (const data in formData) {
            shownData.innerHTML=`${shownData.innerHTML+data} : ${formData[data]}</br>`
        }
    newWindow.document.body.appendChild(shownData)
}
}
const formHandler = new FormHandler('registrationForm');

