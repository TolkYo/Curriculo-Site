<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cláudio Manoel - Currículo Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="jquery-3.7.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <style>
    body {
      scroll-behavior: smooth;
    }
    section {
      padding: 60px 0;
    }
    .navbar {
      background-color:rgb(61, 75, 95);
    }
    .navbar a {
      color: white !important;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand text-white" href="#">Cláudio Manoel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#habilidades">Habilidades</a></li>
          <li class="nav-item"><a class="nav-link" href="#experiencia">Experiência</a></li>
          <li class="nav-item"><a class="nav-link" href="#formacao">Formação</a></li>
          <li class="nav-item"><a class="nav-link" href="#projetos">Projetos</a></li>
          <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="sobre" class="bg-light">
    <div class="container">
      <h2>Sobre Mim</h2>
      <p>Busco oportunidade na área de desenvolvimento para aprimorar minhas habilidades e contribuir para os resultados da organização. Sou comunicativo, adaptável e gosto de trabalhar em equipe.</p>
    </div>
  </section>
      <form id="zap-form">
        <div class="container">
          <div class="row">
            <div class="col-sm">
              <section id="habilidades">
                <div class="container">
                  <h2>Habilidades Técnicas</h2>
                  <ul>
                    <li>PHP, JavaScript, HTML, Bootstrap, SQL, Linux - Intermediário</li>
                    <li>Java, C#, C++, Kotlin - Básico</li>
                    <li>Inglês - Avançado</li>
                    <li>Boa comunicação, aprendizado rápido</li>
                  </ul>
                </div>
              </section>
            </div>
      
        <div class="col-sm">
          <section id="bot-teste">
            <label class="col-form-label"><b>Quer testar o meu bot de Whatsapp?</b></label>
            <div class="form-input d-flex">
              <input type="text" id="numero_zap" class="ms-2 me-2" placeholder="Digite seu Numero com DDD">
              <button id="btn-entrar" class="btn btn-primary btn-sm" type="button" onclick="enviaMensagem();">Testar</button>
            </div>
            <div id="status-mensagem" class="mt-2">
              
            </div>        
          </section>
        </div>
      </form>
      
    </div>
  </div>    

  <section id="experiencia" class="bg-light">
    <div class="container">
      <h2>Experiência</h2>
      <ul>
        <li>Estágio em Desenvolvimento - SES-AM (2 anos)</li>
        <li>Suporte Técnico - 3ª Conferência Estadual de Saúde do Trabalhador</li>
        <li>Suporte Técnico - Oficina de Transformação Digital na Saúde (AM)</li>
      </ul>
    </div>
  </section>

  <section id="formacao">
    <div class="container">
      <h2>Formação Acadêmica</h2>
      <p><strong>Faculdade Fametro:</strong> Análise e Desenvolvimento de Sistemas (3º período)</p>
      <p><strong>Escola Raimundo Gomes Nogueira:</strong> Concluído em 2021</p>
    </div>
  </section>

  <section id="projetos" class="bg-light">
    <div class="container">
      <h2>Projetos e Cursos</h2>
      <ul>
        <li><b>Git:</b> <a href="https://github.com/TolkYo">https://github.com/TolkYo</a></li>
        <li>Curso Kotlin para Android - Udemy</li>
        <li>Curso de Informática Básica - Senac</li>
        <li>Curso de Criação de jogos eletrônicos</li>
      </ul>
    </div>
  </section>

  <section id="contato">
    <div class="container">
      <h2>Contato</h2>
      <p><strong>Telefone:</strong> (92) 9 9331-4699</p>
      <p><strong>Email:</strong> claudiomacouto@gmail.com</p>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="index.js"></script>

  <script>
    const enviaMensagem = () => {
      const numero = $('#numero_zap').val();
      const msg = 'Mensagem Automatica';

      if (!numero) {
        alert('Por favor, digite seu número com DDD');
        return;
      }

      const numeroLimpo = numero.replace(/\D/g, '');
      
      if (numeroLimpo.length < 10 || numeroLimpo.length > 11) {
        alert('Número deve ter 10 ou 11 dígitos (com DDD)');
        return;
      }

      const dados = {
        numero: numeroLimpo,
        msg: msg,
        timestamp: new Date().toISOString()
      };
      localStorage.setItem('ultimoTeste', JSON.stringify(dados));

      const statusDiv = $('#status-mensagem');
      const btnTestar = $('#btn-entrar');
      
      statusDiv.html('<div class="alert alert-info">Enviando mensagem... ⏳</div>');
      btnTestar.prop('disabled', true).text('Enviando...');

      $.ajax({
        url: 'http://localhost:3000/enviar-whatsapp',
        type: 'POST',
        data: {
          numero: numeroLimpo,
          mensagem: msg
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            statusDiv.html('<div class="alert alert-success">✅ Mensagem enviada com sucesso! Verifique seu WhatsApp.</div>');
            $('#numero_zap').val('');
          } else {
            statusDiv.html(`<div class="alert alert-danger">❌ Erro: ${response.message}</div>`);
          }
        },
        error: function(xhr, status, error) {
          console.error('Erro na requisição:', error);
          let mensagemErro = 'Erro ao conectar com o servidor. ';
          
          if (xhr.status === 0) {
            mensagemErro += 'Verifique se o servidor Node.js está rodando na porta 3000.';
          } else {
            mensagemErro += `Código do erro: ${xhr.status}`;
          }
          
          statusDiv.html(`<div class="alert alert-danger">❌ ${mensagemErro}</div>`);
        },
        complete: function() {
          btnTestar.prop('disabled', false).text('Testar');
          
          setTimeout(() => {
            statusDiv.fadeOut(() => statusDiv.html(''));
          }, 10000);
        }
      });
    };
  </script>

</body>
</html>