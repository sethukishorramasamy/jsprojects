// let notes = []
// const inputEl = document.getElementById("input-el")
// const inputBtn = document.getElementById("input-btn")
// const ulEl = document.getElementById("ul-el")
// const deleteBtn = document.getElementById("delete-btn")
// let notesFromLocalStorage = JSON.parse(localStorage.getItem("notes"))

// if (notesFromLocalStorage) {
//     notes = notesFromLocalStorage
//     rendernotes()
// }

// function rendernotes() {
//     let listItems = ""
//     for (let i = 0; i < notes.length; i++) {
//         listItems += `
//         <li class='checked'>
//         <a target='_blank' href='${notes[i]}'>
//         ${notes[i]}
//         </a>
//         <span class='delete-icon' onclick='deleteNote(${i})' style=''>x</span>
//         </li>
//         `
//     }
//     ulEl.innerHTML = listItems
// }
// function deleteNote(index) {
//     notes.splice(index, 1);
//     localStorage.setItem("notes", JSON.stringify(notes));
//     rendernotes();
// }



// inputBtn.addEventListener("click", function () {
//     notes.push(inputEl.value)
//     inputEl.value = ""
//     localStorage.setItem("notes", JSON.stringify(notes))
//     rendernotes()
// })


let notes = [];
const inputEl = document.getElementById("input-el");
const inputBtn = document.getElementById("input-btn");
const ulEl = document.getElementById("ul-el");
const deleteBtn = document.getElementById("delete-btn");
let notesFromLocalStorage = JSON.parse(localStorage.getItem("notes"));

if (notesFromLocalStorage) {
    notes = notesFromLocalStorage;
    rendernotes();
}

function rendernotes() {
    ulEl.innerHTML = ""; // Clear the existing list
    notes.forEach((note, index) => {
        const li = document.createElement("li");
        li.className = 'checked';
        const a = document.createElement("a");
        a.target = '_blank';
        a.href = note;
        a.textContent = note;

        const deleteSpan = document.createElement("span");
        deleteSpan.className = 'delete-icon';
        deleteSpan.textContent = 'x';
        deleteSpan.addEventListener("click", () => deleteNote(index));

        li.appendChild(a);
        li.appendChild(deleteSpan);

        ulEl.appendChild(li);
    });
}

function deleteNote(index) {
    notes.splice(index, 1);
    localStorage.setItem("notes", JSON.stringify(notes));
    rendernotes();
}
deleteBtn.addEventListener("dblclick", function () {
    localStorage.clear()
    notes = []
    rendernotes()
})

inputBtn.addEventListener("click", function () {
    notes.push(inputEl.value);
    inputEl.value = "";
    localStorage.setItem("notes", JSON.stringify(notes));
    rendernotes();
});
