console.log("hello from form validation.");

const form_signup = document.getElementById('form_signup');
const stud_name = document.getElementById('stud_name');
const stud_class = document.getElementById('stud_class');
const phone_no = document.getElementById('phone_no');
const email_id = document.getElementById('email_id');
const pass = document.getElementById('pass');
const c_pass = document.getElementById('c_pass');


form_signup.addEventListener('submit', (event) => {
    // event.preventDefault();
    validate();
});



// more email validate   

const isEmail = (email_idval) => {
    var atSymbol = email_idval.indexOf('@');
    if (atSymbol < 1) return false;
    var dot = email_idval.lastIndexOf(".");
    if (dot <= atSymbol + 3) return false;

    if (dot === email_idval.length - 1) return false;
    return true;

}


// define the validate function

const validate = () => {
        const stud_nameval = stud_name.value.trim();
        const stud_classval = stud_class.value.trim();
        const phone_noval = phone_no.value.trim();
        const email_idval = email_id.value.trim();
        const passval = pass.value.trim();
        const c_passval = c_pass.value.trim();

        if (stud_nameval.length <= 3) {
            setErrorMsg(stud_name, 'student name must min 3 character');
        } else {
            setsuccessMsg(stud_name);
        }
        // validate student class 

        if (stud_classval > 13 || stud_classval < 5) {
            setErrorMsg(stud_class, 'Incorrect class');
        } else {
            setsuccessMsg(stud_class);
        }

        // validate phone number  

        if (phone_noval.length != 10) {
            setErrorMsg(phone_no, 'Not a valid phone no.');

        } else {
            setsuccessMsg(phone_no);
        }

        // validate email id 

        if (!isEmail(email_idval)) {
            setErrorMsg(email_id, 'Not a valid email');
        } else {
            setsuccessMsg(email_id);
        }

        // validate password 

        if (passval.length < 7) {
            setErrorMsg(pass, 'password should at least 8 character');
        } else {
            setsuccessMsg(pass);
        }

        // validate cpassword  

        if (c_passval !== passval) {
            setErrorMsg(c_pass, 'password are not matching.')
        } else {
            setsuccessMsg(c_pass);
        }
        successMsg(stud_nameval);
    }
    //  send data to php 


function successMsg(stud_nameval) {

    let formCon = document.getElementsByClassName('form_control');
    var count = formCon.length - 1;
    for (var i = 0; i < formCon.length; i++) {
        if (formCon[i].className === "form_control succ_signup") {
            var sRate = 0 + i;
            console.log(sRate);
            sendData(stud_nameval, sRate, count);

        } else {
            return false;
        }
    }
}

const sendData = (stud_nameval, sRate, count) => {
    if (sRate === count) {
        alert(stud_nameval);
        // location.href = `signup.php?stud_name= ${stud_nameval}`
        var signup_valid = true;
    } else {
        var signup_valid = false;
    }

}

function setErrorMsg(input, errormsgs) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    small.innerHTML = `<i id='faserror' class='fas fa-exclamation-circle'></i> ${errormsgs} `

}

function setsuccessMsg(input) {
    const formControl = input.parentElement;
    formControl.className = "form_control succ_signup";
}