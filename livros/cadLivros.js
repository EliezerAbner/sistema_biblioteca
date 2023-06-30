let contadorAutor = 1
let contadorExemplar = 1

function inserirAutor()
{
    let autor = document.getElementById("autor")
    let div = document.createElement("div")
    let textBox = '<label>Autor</label> <input type="text" name="txtAutor_'+contadorAutor+'" class="form-control" id="exampleFormControlInput1" placeholder="Nome do autor">'

    div.setAttribute("class","mb-3")
    div.innerHTML = textBox
    autor.appendChild(div)

    contadorAutor++;
}

function inserirExemplar()
{
    let exemplar = document.getElementById("exemplar")
    let div = document.createElement("div")
    let textBox = '<label>Código do Exemplar</label> <input type="text" class="form-control" id="exampleFormControlInput1" name="txtCod_'+contadorExemplar+'" placeholder="Cod. Barras">'

    div.setAttribute("class","mb-3")
    div.innerHTML = textBox
    exemplar.appendChild(div)

    contadorExemplar++
}