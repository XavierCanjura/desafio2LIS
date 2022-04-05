(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form){
            form.addEventListener('submit', function (event) {
            if (!form.checkValidity())
            {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated')
            }, false);
        });
})();

//CONSTANTES
const modal = document.getElementById('modal');
var codigo = "";
const nameProduct = document.getElementById('nameProduct');
const description = document.getElementById('description');
const category = document.getElementById('category');
const price = document.getElementById('price');
const stock = document.getElementById('stock');
const imagen = document.getElementById('imagen');
const btnAddCart = document.getElementById('addCart');
const btnBuy = document.getElementById('buy');
const btnShop = document.getElementById('shop');


//EVENT LISTENERS
if(btnAddCart != null)
{
    btnAddCart.addEventListener('click', addCart);
}

if(btnShop != null)
{
    btnShop.addEventListener('click', () => $("#modalCard").modal('show'));
}

if(btnBuy != null)
{
    btnBuy.addEventListener('click', (e) => {
        e.preventDefault();
        buy();
    });
}

//FUNCTIONS
async function details(id)
{
    // e.preventDefault();
    const response = await fetch(`/desafio2/public/show/${id}`);
    const json = response.json();
    json.then( data => {
        if(data)
        {
            imagen.src = `../app/views/assets/img/${data.imagen}`;
            codigo = data.codigo_producto;
            nameProduct.innerText = data.nombre;
            description.innerText = data.descripcion;
            category.innerHTML = data.categoria;
            price.innerText = data.precio;
            stock.innerText = data.existencias;
            if(data.existencias > 0)
            {
                document.getElementById('cantidad').value = 1;
                document.getElementById('selectCant').style.display = 'block';
                btnAddCart.style.display = 'block';
            }
            else
            {
                document.getElementById('selectCant').style.display = 'none';
                btnAddCart.style.display = 'none';
            }
            $("#modal").modal('show');
        }
    });
}

async function addCart()
{
    request = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            codigo,
            cantidad: document.getElementById('cantidad').value
        })
    }
    const response = await fetch(`/desafio2/public/addCart`, request);
    const json = response.json();
    json.then( data => {
        if(data.error)
        {
            swal({title: `Advertencia`, text: `${data.error}`, icon: `warning`, button: 'Aceptar', closeOnClickOutside: false, closeOnEsc: false})
        }
        else
        {
            document.getElementById('countCart').innerText = `(${data.count})`;
            $("#modal").modal('hide');
            swal({title: `Exito`, text: 'El producto fue agregado al carrito', icon: `success`, button: 'Aceptar', closeOnClickOutside: false, closeOnEsc: false})
        }
    })
    .catch( error => console.log(error));
}

async function buy()
{
    const response = await fetch(`/desafio2/public/buy`);
    const json = response.json();
    json.then( info => {
        if(info.error)
        {
            swal({title: `Advertencia`, text: `${data.error}`, icon: `warning`, button: 'Aceptar', closeOnClickOutside: false, closeOnEsc: false})
        }
        else
        {
            window.open('/desafio2/factura/', '_blank');
        }
    })
    .catch( error => console.log(error));
}