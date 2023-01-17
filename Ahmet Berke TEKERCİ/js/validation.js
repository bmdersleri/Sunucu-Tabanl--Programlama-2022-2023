document.querySelector(".btn-register").addEventListener("click",function(){
    document.querySelector(".register").classList.add("register-active");
    document.querySelector(".bg").classList.add("bg-show");
})

document.querySelector(".bg").addEventListener("click",function(){
    document.querySelector(".register").classList.remove("register-active");
    document.querySelector(".bg").classList.remove("bg-show");
})

// form validation sign up

let formSignUp = document.getElementById("signUp");
let error = document.querySelectorAll(".valid");

formSignUp.addEventListener("submit",function(e){
    let userName = formSignUp.username.value;
    let email = formSignUp.email.value;
    let pass = formSignUp.pass.value;
    let conPass = formSignUp.conPass.value;


    function validName(Name){
        let userNameReg = /^[a-zA-Z][0-9a-zA-Z_]{2,23}[0-9a-zA-Z]$/;
        if(userNameReg.test(Name)){
            error[0].innerHTML = "";
        }
        else{
            error[0].innerHTML = "Kullanici Adi Gecerli Degil";
            e.preventDefault();
        }
    }
    function validEmail(Email){
        let emailReg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        if(emailReg.test(Email)){
            error[1].innerHTML = "";
        }
        else{
            error[1].innerHTML = "Email Gecerli Degil";
            e.preventDefault();
        }
    }
    function validPass(Pass){
        let passReg = /^([A-Za-z0-9]{8,16})$/;
        if(passReg.test(Pass)){
            error[2].innerHTML = "";
        }
        else{     
            error[2].innerHTML = "Sifre Gecerli Degil";
            e.preventDefault();
        }
    }
    validName(userName);
    validEmail(email);
    validPass(pass);
    if(!(pass == conPass)){
        error[3].innerHTML = "Sifreler Eslesmiyor";
        e.preventDefault();
    }
    else{
        error[3].innerHTML = "";
    }
});