const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");

form.onsubmit = (e)=> {
    e.preventDefault();
}

continueBtn.onclick = () => {
    //ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/signup.php",true);
    xhr.onload = ()=> {

    }
    xhr.send();
};
