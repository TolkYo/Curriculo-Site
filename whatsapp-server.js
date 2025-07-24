const express = require('express');
const venom = require('venom-bot');
const cors = require('cors');

const app = express();
const PORT = 3000;

// Middlewares
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors());

let client;

async function start() {
  if (!client) {
    try {
      console.log('🔄 Iniciando WhatsApp...');
      client = await venom.create({
        session: 'zap-session',
        headless: true,
        browserPathExecutable: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        // Adicione essas opções para melhor estabilidade
        browserArgs: [
          '--no-sandbox',
          '--disable-setuid-sandbox',
          '--disable-dev-shm-usage',
          '--disable-accelerated-2d-canvas',
          '--no-first-run',
          '--no-zygote',
          '--disable-gpu'
        ]
      });
      console.log('✅ WhatsApp conectado com sucesso!');
    } catch (error) {
      console.error('❌ Erro ao conectar WhatsApp:', error);
      client = null;
    }
  }
  return client;
}

async function sendMsg(numero, mensagem) {
  try {
    if (!client) {
      await start();
    }
    
    if (!client) {
      throw new Error('WhatsApp não está conectado');
    }

    const numero_formatado = '55' + numero + '@c.us';
    console.log(`📱 Enviando mensagem para: ${numero_formatado}`);
    
    await client.sendText(numero_formatado, mensagem);
    
    console.log('✅ Mensagem enviada com sucesso!');
    return { 
      success: true, 
      message: 'Mensagem enviada com sucesso!',
      numero: numero,
      timestamp: new Date().toISOString()
    };
    
  } catch (error) {
    console.error('❌ Erro ao enviar mensagem:', error);
    return { 
      success: false, 
      message: `Erro ao enviar mensagem: ${error.message}` 
    };
  }
}

// Rota principal para enviar mensagem
app.post('/enviar-whatsapp', async (req, res) => {
  try {
    const { numero, mensagem } = req.body;
    
    console.log(`🔄 Nova solicitação recebida - Número: ${numero}`);
    
    // Validações
    if (!numero || !mensagem) {
      return res.status(400).json({
        success: false,
        message: 'Número e mensagem são obrigatórios'
      });
    }
    
    // Validar formato do número
    const numeroLimpo = numero.replace(/\D/g, '');
    if (numeroLimpo.length < 10 || numeroLimpo.length > 11) {
      return res.status(400).json({
        success: false,
        message: 'Número deve ter 10 ou 11 dígitos'
      });
    }
    
    // Enviar mensagem
    const resultado = await sendMsg(numeroLimpo, mensagem);
    
    // Log do resultado
    if (resultado.success) {
      console.log(`✅ Sucesso - Mensagem enviada para ${numeroLimpo}`);
    } else {
      console.log(`❌ Falha - ${resultado.message}`);
    }
    
    res.json(resultado);
    
  } catch (error) {
    console.error('❌ Erro no servidor:', error);
    res.status(500).json({
      success: false,
      message: 'Erro interno do servidor'
    });
  }
});

// Rota de status
app.get('/status', (req, res) => {
  res.json({ 
    status: 'Servidor rodando',
    porta: PORT,
    whatsapp: client ? 'Conectado' : 'Desconectado',
    timestamp: new Date().toISOString()
  });
});

// Rota de teste
app.get('/', (req, res) => {
  res.send(`
    <h1>🤖 Servidor WhatsApp Bot</h1>
    <p><strong>Status:</strong> Rodando na porta ${PORT}</p>
    <p><strong>WhatsApp:</strong> ${client ? 'Conectado ✅' : 'Desconectado ❌'}</p>
    <p><strong>Endpoints:</strong></p>
    <ul>
      <li>POST /enviar-whatsapp - Enviar mensagem</li>
      <li>GET /status - Status do servidor</li>
    </ul>
  `);
});

// Tratamento de erros
process.on('unhandledRejection', (reason, promise) => {
  console.error('❌ Erro não tratado:', reason);
});

process.on('uncaughtException', (error) => {
  console.error('❌ Exceção não capturada:', error);
});

// Inicializar servidor
app.listen(PORT, () => {
  console.log(`🚀 Servidor rodando na porta ${PORT}`);
  console.log(`🌐 Acesse: http://localhost:${PORT}`);
  console.log(`📊 Status: http://localhost:${PORT}/status`);
  console.log('─'.repeat(50));
});

// Inicializar WhatsApp quando o servidor iniciar
console.log('🔄 Iniciando servidor e WhatsApp...');
start().catch(console.error);