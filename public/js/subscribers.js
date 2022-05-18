
function changeAvatar(input){
    let name = document.getElementById(input.id).value;
    let avatarContainer = document.querySelector('#avatar-container');

    avatarContainer.style.backgroundImage = "url('https://avatars.dicebear.com/api/adventurer-neutral/"+name+".svg')";
}


// const modal = document.querySelector("#modal");
// const modalOverlay = document.querySelector("#modal-overlay");
// const openButton = document.querySelector("#open-button");
// const closeButton = document.querySelector("#close-button");

// openButton.addEventListener("click", () => {
//   modal.classList.toggle("closed");
//   modalOverlay.classList.toggle("closed");
// });

// function openModal(){
//   modal.classList.toggle("closed");
//   modalOverlay.classList.toggle("closed");
//   $.ajax({
//     url: "/dashboard/filtered",
//     type: "POST"
//   })
// }

// function closeModal(){
//   modal.classList.toggle("closed");
//   modalOverlay.classList.toggle("closed");
// }

// closeButton.addEventListener("click", () => {
//   modal.classList.toggle("closed");
//   modalOverlay.classList.toggle("closed");
// });
