const menubar = document.getElementById("menu_bar");
const dropdown = document.getElementById("dropdown");

if(menubar){
    menubar.addEventListener("click",()=>{
        dropdown.classList.toggle("show_dropdown_1");
    })
}
if(menubar){
    menubar.addEventListener("click",()=>{
        setTimeout(()=>{
            dropdown.classList.toggle("show_dropdown_2");
        })
    })
}

document.addEventListener("click",(e)=>{
    if(!menubar.contains(e.target)){
        dropdown.classList.remove("show_dropdown_1");
    }
})
document.addEventListener("click",(e)=>{
    if(!menubar.contains(e.target)){
        dropdown.classList.remove("show_dropdown_2");
    }
})

const word=document.getElementById("changetext");
 const words=["fastest","simplest","free","easiest"];
let currentIndex=0;

 function changeText(){
    word.innerText = words[currentIndex];
    currentIndex=(currentIndex+1)%words.length;
}
setInterval(changeText,3000);

const number=document.getElementById("people_number");

let counter = 0;
const limit = 200;

const interval = setInterval(()=>{
    if(counter<=limit){
        number.innerHTML = counter;
        counter++;
    }
    else{
        clearInterval(interval);
    }
},20);

 