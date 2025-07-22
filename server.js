const http = require('http');
const fs = require('fs');
const path = require('path');
const { enviarMensagem } = require('./bot');

const PORT = 3000;

const server = http.createServer((req, res) => {
  if (req.method === 'GET') {
    // Servir o HTML
    let filePath = path.join(__dirname, 'public', req.url === '/' ? 'index.php' : req.url);
    const ext = path.extname(filePath);

    let contentType = 'text/html';
    if (ext === '.css') contentType = 'text/css';
    if (ext === '.js') contentType = 'application/javascript';

    fs.readFile(filePath, (err, content) => {
      if (err) {
        res.writeHead(404);
        res.end('Arquivo não encontrado');
      } else {
        res.writeHead(200, { 'Content-Type': contentType });
        res.end(content, 'utf-8');
      }
    });

  } else if (req.method === 'POST' && req.url === '/enviar') {
    // Receber JSON com número e mensagem
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', async () => {
      try {
        const { numero, mensagem } = JSON.parse(body);
        await enviarMensagem(numero, mensagem);
        res.writeHead(200, { 'Content-Type': 'text/plain' });
        res.end('Mensagem enviada com sucesso');
      } catch (err) {
        console.error(err);
        res.writeHead(500, { 'Content-Type': 'text/plain' });
        res.end('Erro ao enviar mensagem');
      }
    });
  } else {
    res.writeHead(404);
    res.end('Rota não encontrada');
  }
});

server.listen(PORT, () => {
  console.log(`Servidor rodando em http://localhost:${PORT}`);
});