<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF_8">
    <meta name="viewport" content="width=device_width, initial_scale=1.0">
    <style>
        body {
            font-family: Arial, sans_serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #formontainer {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            width: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Formulário de Pergunta</title>
</head>

<body>
    <div id="formontainer">

        <div>
            <h1>Questionario RH - Plano de Saude.</h1>
            <p>Por favor, compartilhe sua opinião sobre o atual plano de saúde da prefeitura. Sua avaliação é
                fundamental para melhorias contínuas. Obrigado por sua participação! </p> <br>
        </div>

        <form method="POST" action="processar_login.php" name="form">
            <label for="pergunta1">1 _ Nos últimos 3 meses, você conseguiu ter atendimento em consultas, exames ou
                tratamentos por meio do plano de saúde quando necessitou?</label>
            <label for="opcao1"><input type="radio" name="opcao1" value="Sempre" id="opcao1">. Sempre. </label>
            <label for="opcao1"><input type="radio" name="opcao1" value="Maioria das Vezes" id="opcao1">. Maioria das
                vezes.</label>
            <label for="opcao1"><input type="radio" name="opcao1" value="As Vezes" id="opcao1">. As vezes.</label>
            <label for="opcao1"><input type="radio" name="opcao1" value="Nunca" id="opcao1">. Nunca.</label>
            <label for="opcao1"><input type="radio" name="opcao1" value="Nao se aplica" id="opcao1">. Não se
                Aplica.</label>
            <br>

            <label for="pergunta2">2_ Nos últimos 3 meses, quando necessitou de atendimento de urgência e emergência
                teve acesso com facilidade?</label>
            <label for="opcao2"><input type="radio" name="opcao2" value="Sempre" id="opcao2">. Sempre. </label>
            <label for="opcao2"><input type="radio" name="opcao2" value="Maioria das Vezes" id="opcao2">. Maioria das
                vezes.</label>
            <label for="opcao2"><input type="radio" name="opcao2" value="As Vezes" id="opcao2">. As vezes.</label>
            <label for="opcao2"><input type="radio" name="opcao2" value="Nunca" id="opcao2">. Nunca.</label>
            <label for="opcao2"><input type="radio" name="opcao2" value="Nao se aplica" id="opcao2">. Não se
                Aplica.</label>
            <br>

            <label for="pergunta3">3_ Quando acessou o plano pelos canais de atendimento (sac presencial,
                teleatendimento ou meio eletrônico) <br> Você recebeu o atendimento esperado?
            </label>
            <label for="opcao3"><input type="radio" name="opcao3" value="Sempre" id="opcao3">. Sempre. </label>
            <label for="opcao3"><input type="radio" name="opcao3" value="Maioria das vezes" id="opcao3">. Maioria das
                vezes.</label>
            <label for="opcao3"><input type="radio" name="opcao3" value="As Vezes" id="opcao3">. As vezes.</label>
            <label for="opcao3"><input type="radio" name="opcao3" value="Nunca" id="opcao3">. Nunca.</label>
            <label for="opcao3"><input type="radio" name="opcao3" value="Nao se Aplica" id="opcao3">. Não se
                Aplica.</label>
            <br>

            <label for="pergunta4">4_ Nos últimos 3 meses quando fez uma reclamação para o seu plano teve sua demanda
                atendida?
            </label>
            <label for="opcao4"><input type="radio" name="opcao4" value="Sempre" id="opcao4">. Sempre. </label>
            <label for="opcao4"><input type="radio" name="opcao4" value="Maioria das Vezes" id="opcao4">. Maioria das
                vezes.</label>
            <label for="opcao4"><input type="radio" name="opcao4" value="As Vezes" id="opcao4">. As vezes.</label>
            <label for="opcao4"><input type="radio" name="opcao4" value="Nunca" id="opcao4">. Nunca.</label>
            <label for="opcao4"><input type="radio" name="opcao4" value="Nao se aplica" id="opcao4">. Não se
                Aplica.</label>
            <br>

            <label for="pergunta5">5_ Como você avalia o seu plano de saúde?
            </label>
            <label for="opcao5"><input type="radio" name="opcao5" value="Muito Bom" id="opcao5">. Muito Bom. </label>
            <label for="opcao5"><input type="radio" name="opcao5" value="Bom" id="opcao5">. Bom.</label>
            <label for="opcao5"><input type="radio" name="opcao5" value="Regular" id="opcao5">. Regular.</label>
            <label for="opcao5"><input type="radio" name="opcao5" value="Ruim" id="opcao5">. Ruim.</label>
            <label for="opcao5"><input type="radio" name="opcao5" value="Muito Ruim" id="opcao5">. Muito Ruim.</label>
            <br>

            <label for="pergunta6">6_ Quanto ao tempo de espera para uma autorização de exames que são auditáveis
                (fisioterapia e exames de alta complexidade) o que você acha?
            </label>
            <label for="opcao6"><input type="radio" name="opcao6" value="Muito Bom" id="opcao6">. Muito Bom. </label>
            <label for="opcao6"><input type="radio" name="opcao6" value="Bom" id="opcao6">. Bom.</label>
            <label for="opcao6"><input type="radio" name="opcao6" value="Regular" id="opcao6">. Regular.</label>
            <label for="opcao6"><input type="radio" name="opcao6" value="Ruim" id="opcao6">. Ruim.</label>
            <label for="opcao6"><input type="radio" name="opcao6" value="Muito Ruim" id="opcao6">. Muito Ruim.</label>
            <br>

            <label for="pergunta7">7_ Qual a sua satisfação ao número de hospitais credenciados?</label>
            <label for="opcao7"><input type="radio" name="opcao7" value="Muito Bom" id="opcao7">. Muito Bom. </label>
            <label for="opcao7"><input type="radio" name="opcao7" value="Bom" id="opcao7">. Bom.</label>
            <label for="opcao7"><input type="radio" name="opcao7" value="Regular" id="opcao7">. Regular.</label>
            <label for="opcao7"><input type="radio" name="opcao7" value="Ruim" id="opcao7">. Ruim.</label>
            <label for="opcao7"><input type="radio" name="opcao7" value="Muito Bom" id="opcao7">. Muito Ruim.</label>
            <br>

            <label for="pergunta8">8_ Qual a sua satisfação ao número de médicos especialistas credenciados?</label>
            <label for="opcao8"><input type="radio" name="opcao8" value="Muito Bom" id="opcao8">. Muito Bom. </label>
            <label for="opcao8"><input type="radio" name="opcao8" value="Bom" id="opcao8">. Bom.</label>
            <label for="opcao8"><input type="radio" name="opcao8" value="Regular" id="opcao8">. Regular.</label>
            <label for="opcao8"><input type="radio" name="opcao8" value="Ruim" id="opcao8">. Ruim.</label>
            <label for="opcao8"><input type="radio" name="opcao8" value="Muito Bom" id="opcao8">. Muito Ruim.</label>
            <br>

            <label for="pergunta9">9_ Como você avalia a facilidade de acesso a lista de prestadores de serviços
                credenciados?</label>
            <label for="opcao9"><input type="radio" name="opcao9" value="Muito Bom" id="opcao9">. Muito Bom. </label>
            <label for="opcao9"><input type="radio" name="opcao9" value="Bom" id="opcao9">. Bom.</label>
            <label for="opcao9"><input type="radio" name="opcao9" value="Regular" id="opcao9">. Regular.</label>
            <label for="opcao9"><input type="radio" name="opcao9" value="Ruim" id="opcao9">. Ruim.</label>
            <label for="opcao9"><input type="radio" name="opcao9" value="Muito Ruim" id="opcao9">. Muito Ruim.</label>
            <br>

            <label for="pergunta10">10_ Se você precisou de procedimento cirúrgico nos últimos 3 meses. Conseguiu
                realizar com brevidade?</label>
            <label for="opcao10"><input type="radio" name="opcao10" value="Muito Bom" id="opcao10">. Muito Bom. </label>
            <label for="opcao10"><input type="radio" name="opcao10" value="Bom" id="opcao10">. Bom.</label>
            <label for="opcao10"><input type="radio" name="opcao10" value="Regular" id="opcao10">. Regular.</label>
            <label for="opcao10"><input type="radio" name="opcao10" value="Ruim" id="opcao10">. Ruim.</label>
            <label for="opcao10"><input type="radio" name="opcao10" value="Muito Ruim" id="opcao10">. Muito
                Ruim.</label>
            <br>

            <br>

            <label for="comentarios">Deixe seu Comentario:</label>

            <textarea name="comentarios" id="comentarios" cols="50" rows="10" maxlength="501"></textarea>

            <input type="hidden" name="matricula" id="matricula" value="<?php print $_POST['matriculaLogin']; ?>" />
            <br><br>
            <input type="button" onclick='validarFormulario();' value="Enviar Resposta">
        </form>
    </div>

</body>

</html>

<script>
    function validarFormulario() {
        if (form.opcao1.value == "") {
            alert("Informe a resposta da pergunta 1 !");
            form.pergunta1.focus();
        }
        if (form.opcao2.value == "") {
            alert("Informe a resposta da pergunta 2 !");
            form.pergunta2.focus();
        }
        if (form.opcao3.value == "") {
            alert("Informe a resposta da pergunta 3 !");
            form.pergunta3.focus();
        }
        if (form.opcao4.value == "") {
            alert("Informe a resposta da pergunta 4 !");
            form.pergunta4.focus();
        }
        if (form.opcao5.value == "") {
            alert("Informe a resposta da pergunta 5 !");
            form.pergunta5.focus();
        }
        if (form.opcao6.value == "") {
            alert("Informe a resposta da pergunta 6 !");
            form.pergunta6.focus();
        }
        if (form.opcao7.value == "") {
            alert("Informe a resposta da pergunta 7 !");
            form.pergunta7.focus();
        }
        if (form.opcao8.value == "") {
            alert("Informe a resposta da pergunta 8 !");
            form.pergunta8.focus();
        }
        if (form.opcao9.value == "") {
            alert("Informe a resposta da pergunta 9 !");
            form.pergunta9.focus();
        }
        if (form.opcao10.value == "") {
            alert("Informe a resposta da pergunta 10 !");
            form.pergunta10.focus();
        }
        if (form.matricula.value == "") {
            alert("Informe a matricula !");
        } else {
            if (confirm('Esta ciente das respostas preenchidas ?')) {
                form.submit();
            }
        };

    }
</script>