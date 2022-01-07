console.log("hello from searchfilte js");

const searchpypFun = () => {
        let filter = document.getElementById('myInput').value.toUpperCase();


        let myTable = document.getElementById('myTable');
        let tr = myTable.getElementsByTagName('tr');


        for (var i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[1];

            if (td) {
                let textvalue = td.textContent || td.innerHTML;

                if (textvalue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        let myTablead = document.getElementById('myTablead');
        let trad = myTablead.getElementsByTagName('tr');

        for (var i = 0; i < trad.length; i++) {
            let td = trad[i].getElementsByTagName('td')[1];

            if (td) {
                let textvalue = td.textContent || td.innerHTML;

                if (textvalue.toUpperCase().indexOf(filter) > -1) {
                    trad[i].style.display = "";
                } else {
                    trad[i].style.display = "none";
                }
            }
        }

    }
    // physics page search result 

const searchphyFun = () => {
    let filter = document.getElementById('phyInput').value.toUpperCase();
    let Cards = document.getElementsByClassName('cards');

    for (var i = 0; i < Cards.length; i++) {
        let h = Cards[i].getElementsByClassName('quslink')[0];

        if (h) {
            let textvalue = h.textContent || h.innerHTML;

            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                Cards[i].style.display = "";


            } else {
                Cards[i].style.display = "none";

            }
        }
    }
}

// chemistry page search result   

const searchchemFun = () => {
    let filter = document.getElementById('cheInput').value.toUpperCase();
    let Cards = document.getElementsByClassName('cards');

    for (var i = 0; i < Cards.length; i++) {
        let h = Cards[i].getElementsByClassName('quslink')[0];

        if (h) {
            let textvalue = h.textContent || h.innerHTML;

            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                Cards[i].style.display = "";


            } else {
                Cards[i].style.display = "none";

            }
        }
    }
}

// maths page search result  

const searchmathFun = () => {
    let filter = document.getElementById('mathInput').value.toUpperCase();
    let Cards = document.getElementsByClassName('cards');

    for (var i = 0; i < Cards.length; i++) {
        let h = Cards[i].getElementsByClassName('quslink')[0];

        if (h) {
            let textvalue = h.textContent || h.innerHTML;

            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                Cards[i].style.display = "";


            } else {
                Cards[i].style.display = "none";

            }
        }
    }
}

// browse questions search filter

const search_qus = () => {

    let filter = document.getElementById('qus_input').value.toUpperCase();
    let qus = document.getElementsByClassName('container browse');

    for (var i = 0; i < qus.length; i++) {

        let m = qus[i].getElementsByClassName('qus_asf')[0];

        if (m) {
            let textvalue = m.textContent || m.innerHTML;
            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                qus[i].style.display = "";
            } else {
                qus[i].style.display = "none";
            }
        }
    }
}