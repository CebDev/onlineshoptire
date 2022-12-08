console.log("js connecte");

function loadLogin(){
    document.getElementById('login-container').style.display = 'flex';
}

function loadPaiement(){
    document.getElementById('paiement-container').style.display = 'flex';
}

function menuManufacturierAppear(){
    var element = document.getElementById("menu-manufacturier");
    element.classList.remove("menu-manufacturier-hidden");   
}

function menuManufacturierDisappear(){
    var element = document.getElementById("menu-manufacturier");
    element.classList.add("menu-manufacturier-hidden");  
}

function setActiveLink(){
    var elements = document.getElementsByClassName("nav_link");
    console.log(elements);
    elements.forEach(element => {
        element.classList.remove("nav_link_active");
        
    });
}

function newPwdSet(){
    var newPassword = document.getElementById("newPassword").value;
    if(newPassword.length>0){
        document.getElementById('btnModifCompte').className = "btn btnDisabled";
    } else {
        document.getElementById('btnModifCompte').className = "btn btnAble";
    }
}


function checkConfirmPassword(){
    var newPassword = document.getElementById("newPassword").value;
    document.getElementById('newPasswordConfirmation').addEventListener('keyup', function(){
        
           if(newPassword == document.getElementById('newPasswordConfirmation').value){
             console.log("same");
             document.getElementById('btnModifCompte').className = "btn btnAble";
           }         
        });
}

function checkLengthPassword(){
    var pwd = document.getElementById('password').value;
        console.log(pwd);
           if(pwd.length >= 8){
             console.log("8");
             document.getElementById('btnLogin').className = "btn btnAble";
           }         
}
