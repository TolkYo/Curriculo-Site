const venom = require('venom-bot');

const numero = JSON.parse(localStorage.getItem('numero'));
const mensagem = JSON.parse(localStorage.getItem('mensagem'));

const numero_zap = '55'+ numero +'@c.us'

let client;

async function start() {
  if (!client) {
    client = await venom.create({
      session: 'zap-session',
      headless: true,
      browserPathExecutable: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe'
    });
  }
  return client;
}

async function sendMsg(numero_zap, mensagem) {
  const zap = await start();
  await zap.sendMsg(numero_zap, mensagem);
}