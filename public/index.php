<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cláudio Manoel - Currículo Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <!-- <li class="nav-item"><a class="nav-link" href="#contato">Portfolio</a></li> -->
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
              <input type="text" id="numero_zap" class="ms-2 me-2" placeholder="Digite seu Numero">
              <button id="btn-entrar" class="btn btn-primary btn-sm" type="submit">Testar</button>
            </div>
            <div>
              
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
</body>
</html>

  <script>
    $('#zap-form').submit(function (e) {
      e.preventDefault();
      const numero = $('#numero_zap').val();
      const msg = 'Mensagem Automática';

      $.ajax({
      url: 'http://localhost:3000/enviar',
      type: 'POST',
      data: JSON.stringify({ numero, msg}),
      contentType: 'application/json; charset=utf-8',
      success: function (res) {
        alert('Mensagem enviada com sucesso!');
      },
      error: function (err) {
        alert('Erro ao enviar mensagem');
        console.error(err);
      }
    });
  });
  </script>

