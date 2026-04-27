function buscaCep() {
    let cep = document.getElementById("cepCadastro").value;
    let enderecoCompleto = document.getElementById("enderecoCompleto");
    let bairroCadastro = document.getElementById("bairroCadastro");
    let cidade = document.getElementById("cidade");

    if (cep !== "") {
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep;
        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        req.onload = function () {

            if (req.status === 200) {

                let endereco = JSON.parse(req.response);
                document.getElementById("enderecoCompleto").value = endereco.street;
                document.getElementById("varEndereco").value = endereco.street;
                document.getElementById("bairroCadastro").value = endereco.neighborhood;
                document.getElementById("varBairro").value = endereco.neighborhood;
                document.getElementById("cidade").value = endereco.city;
                document.getElementById("varMunicipio").value = endereco.city;

            }
        }

    }

    if (cepCadastro.value.trim() !== "") {
        // Desabilita o campo "enderecoCompleto"
        enderecoCompleto.disabled = true;
        bairroCadastro.disabled = true;
        cidade.disabled = true;
    }

}

window.onload = function () {
    let cepCadastro = document.getElementById("cepCadastro");
    cepCadastro.addEventListener("blur", buscaCep);

}

const handleZipCode = (event) => {
    let input = event.target
    input.value = zipCodeMask(input.value)
}

const zipCodeMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g, '')
    value = value.replace(/(\d{5})(\d)/, '$1-$2')
    return value
}


