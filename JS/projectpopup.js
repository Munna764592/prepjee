console.log('this is java tutorial');




// login popup view  
document.getElementById("show-login").addEventListener("click",function (){
    document.querySelector(".popup").classList.add("active");
    document.querySelector(".main").classList.add("active");
    });

document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
    document.querySelector(".main").classList.remove("active");
   });


// signup popup view  


document.getElementById("show-signup").addEventListener("click",function (){
    document.querySelector(".popup2").classList.add("active2");
    document.querySelector(".main").classList.add("active2");
   });

document.querySelector(".popup2 .close-btn2").addEventListener("click",function(){
    document.querySelector(".popup2").classList.remove("active2");
    document.querySelector(".main").classList.remove("active2");
       
});
// let plsignup = document.getElementById("sigupsubmit")

// plsignup.addEventListener('click',() =>{ plsignup.style.borderColor="white"
// });