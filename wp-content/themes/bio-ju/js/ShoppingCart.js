let produktet = document.querySelectorAll('.produkte-oferte');
let shoppingCartContent = document.querySelector('#cart-content tbody');
let nrProdukteve = document.querySelector('.primary-nav__navigation2--shoppingcart--count span h6');
let cmimiTotal = document.querySelector('.primary-nav__navigation2--shoppingcart-text h6');


events();

function events() {
    for (let i = 0; i < produktet.length; i++) {
        produktet[i].addEventListener('click',shtoProdukt);
    }

    shoppingCartContent.addEventListener('click',hiqProdukt);

    document.addEventListener('DOMContentLoaded',getLocalStorage);
}

let count = 0;
let totali = 0;

//Funksionet
function shtoProdukt(e) {

    if (e.target.classList.contains('produkte-oferte__produkte--btn')) {
        count++;

        let produkt = e.target.parentElement;
        
        //Marrim infon e produktit
        getProduktInfo(produkt);
    }
}



function getProduktInfo(produkt) {
    const produktInfo = {
        emri : produkt.querySelector('h2').textContent,
        imazhi : produkt.querySelector('.produkte-oferte__produkte--image').src,
        cmimi : produkt.querySelector('.produkte-oferte__produkte--priceinfo-price').textContent,
        id : produkt.querySelector('button').getAttribute('data-id')
    }
    //Shtojme produktin te shporta
    shtoTekShporta(produktInfo);
}



function shtoTekShporta(produktInfo) {
    //Shtojme cmimin total te produkteve
    let cmimi = parseInt(produktInfo.cmimi);
    totali+=cmimi;
    cmimiTotal.innerHTML=totali+' L';

    //Shtojme numrin total te produkteve
    nrProdukteve.innerHTML=count;

    //Shtojme produktet ne tabele
    const row = document.createElement('tr');

    row.innerHTML=`
            <td>
                <img src="${produktInfo.imazhi}">
            </td>
            <td>${produktInfo.emri}</td>
            <td id="cmimi" data-cmimi="${produktInfo.cmimi}">${produktInfo.cmimi}</td>
            <td>
                <span class="remove" data-id="${produktInfo.id}">X</span>
            </td>
    `;
    //Shtojme te shporta
    shoppingCartContent.appendChild(row);

    

    ruajNeLocalStorage(produktInfo);
}



//Shtojme produktet ne local storage
function ruajNeLocalStorage(produktInfo) {
    let produkte = getProduktetLocalStorage();


    //Shtojme kursin ne array
    produkte.push(produktInfo);

    //Konvertojme JSON ne String
    localStorage.setItem('produkte',JSON.stringify(produkte));
    localStorage.setItem('cmimiProdukteve',totali);
    localStorage.setItem('nrTotalProdukteve',count);
}



function getProduktetLocalStorage() {
    let produkte;

    if (localStorage.getItem('produkte') === null ) {
        produkte = [];
    } else {
        produkte = JSON.parse(localStorage.getItem('produkte'));
    }

    return produkte;
}

//Cmimi total i produkteve ne LS
function getCmimiProdukteveLocalStorage() {
    let cmimiProdukteve;

    if (localStorage.getItem('cmimiProdukteve') == null) {
        cmimiProdukteve = null;
    } else {
        cmimiProdukteve = localStorage.getItem('cmimiProdukteve');
    }

    return cmimiProdukteve;
}

//Nr total i produkteve ne LS
function getnrTotalProdukteveLocalStorage() {
    let nrTotalProdukteve;

    if (localStorage.getItem('nrTotalProdukteve') == null) {
        nrTotalProdukteve = null;
    } else {
        nrTotalProdukteve = localStorage.getItem('nrTotalProdukteve');
    }

    return nrTotalProdukteve;
}




function getLocalStorage() {
    let produkte = getProduktetLocalStorage();
    let cmimiProdukteve = getCmimiProdukteveLocalStorage();
    let nrTotalProdukteve = getnrTotalProdukteveLocalStorage();

    produkte.forEach(function (produkt) {
        const row = document.createElement('tr');

        row.innerHTML=`
                <td>
                    <img src="${produkt.imazhi}">
                </td>
                <td>${produkt.emri}</td>
                <td id="cmimi" data-cmimi="${produkt.cmimi}">${produkt.cmimi}</td>
                <td>
                    <span class="remove" data-id="${produkt.id}">X</span>
                </td>
        `;

        //Shtojme te shporta
        shoppingCartContent.appendChild(row);
    });


    //Shtojme cmimin total te produkteve
    if (cmimiProdukteve==null) {
        cmimiTotal.innerHTML=0+' L';
        totali=0;
    }else{
        cmimiTotal.innerHTML=cmimiProdukteve+' L';
        totali=parseInt(cmimiProdukteve);
    }

    //Shtojme numrin total te produkteve
    if (nrTotalProdukteve==null) {
        nrProdukteve.innerHTML=0;
        count=0;
    }else{
        nrProdukteve.innerHTML=nrTotalProdukteve;
        count=nrTotalProdukteve;
    }

}


/* Hiq nga shporta  */
function hiqProdukt(e) {

    let produkt, produktId, cmimi;

     // Heqim from the dom
     if(e.target.classList.contains('remove')) {
          e.target.parentElement.parentElement.remove();
          produkt = e.target.parentElement.parentElement;
          produktId = produkt.querySelector('span').getAttribute('data-id');

          cmimi = parseInt(produkt.querySelector('#cmimi').getAttribute('data-cmimi'));

          //Zbresim me nje nr total te produkteve
          count--;

          //Zbresim cmimin total
          totali-=cmimi;

          //I bejme update vlerave
          cmimiTotal.innerHTML=totali+' L';
          nrProdukteve.innerHTML=count;
        }

     
     localStorage.setItem('cmimiProdukteve',totali);
     localStorage.setItem('nrTotalProdukteve',count);

     // heqim nga local storage
     hiqProduktLocalStorage(produktId);
}

function hiqProduktLocalStorage(produktId) {
    // get the local storage data
    let produkteLS = getProduktetLocalStorage();

    // loop through the array and find the index to remove
    produkteLS.forEach(function(produktLS, index) {
         if(produktLS.id === produktId) {
            produkteLS.splice(index, 1);
         }
    });

    // Add the rest of the array
    localStorage.setItem('produkte', JSON.stringify(produkteLS));
}