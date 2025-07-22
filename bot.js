const venom = require('venom-bot');

//const numero_zap = '55'+  +'@c.us';


let client;

async function iniciarBot() {
  if (!client) {
    client = await venom.create({
      session: 'zap-session',
      headless: true,
      browserPathExecutable: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe'
    });
  }
  return client;
}

async function enviarMensagem(numero_zap, msg) {
  const zap = await iniciarBot();
  await zap.sendText('55'+ numero_zap +'@c.us', msg);
}

module.exports = { enviarMensagem };