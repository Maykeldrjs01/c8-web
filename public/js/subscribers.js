
function changeAvatar(input){
    let name = document.getElementById(input.id).value;
    let avatarContainer = document.querySelector('#avatar-container');

    avatarContainer.style.backgroundImage = "url('https://avatars.dicebear.com/api/adventurer-neutral/"+name+".svg')";
}