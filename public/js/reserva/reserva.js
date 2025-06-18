
// Variável global para armazenar os dados da reserva
window.reserva = {
    data_inicio: null,
    data_fim: null,
    tarifa_base: 0,
    quantidade_dias: 0,
    estacao_retirada_id: null,
    estacao_retirada_nome: null,
    estacao_devolucao_id: null,
    estacao_devolucao_nome: null,
    grupo_frota_id: null,
    grupo_frota_nome: null,
    modelo_id: null,
    modelo_nome: null,
    user_id: null,
    user_nome: null,
    opcionais: [],
    cupom_desconto: null
};
window.opcionais = [];

function getOpcionais(){
    return window.opcionais;
}

function addOpcional(opcional){
    window.opcionais.push(opcional);
}

function removeAllOpcional(){
    window.opcionais = [];
}

// Funções para manipular os dados da reserva
function getDataInicio(){
    return window.reserva.data_inicio;
}

function getDataFim(){
    return window.reserva.data_fim;
}

function setDataInicio(data) {
    window.reserva.data_inicio = data;
}

function setDataFim(data) {
    window.reserva.data_fim = data;
}

function setTarifaBase(tarifa) {
    window.reserva.tarifa_base = tarifa;
}

function calculaQuantidadeDias(data_inicio, data_fim){
    return Math.ceil((new Date(data_fim) - new Date(data_inicio)) / (1000 * 60 * 60 * 24));
}

function setQuantidadeDias(dias) {
    window.reserva.quantidade_dias = dias;
}

function setEstacaoRetirada(id, nome) {
    window.reserva.estacao_retirada_id = id;
    window.reserva.estacao_retirada_nome = nome;
}

function setEstacaoDevolucao(id, nome) {
    window.reserva.estacao_devolucao_id = id;
    window.reserva.estacao_devolucao_nome = nome;
}

function setGrupoFrota(id, nome) {
    window.reserva.grupo_frota_id = id;
    window.reserva.grupo_frota_nome = nome;
}

function setModelo(id, nome) {
    window.reserva.modelo_id = id;
    window.reserva.modelo_nome = nome;
}

function setUser(id, nome) {
    window.reserva.user_id = id;
    window.reserva.user_nome = nome;
}

function addOpcionalReserva(opcional_id, opcional_nome) {
    var  quantidade = 1;
    const opcionaisReserva = getOpcionaisReserva();
    const opcionalExistente = opcionaisReserva.find(op => op.id == opcional_id);

    if (opcionalExistente) {
        opcionalExistente.quantidade += quantidade;
    } else {
        if(getOpcionais().length > 0){
            var opcional = getOpcionais().find(op => {
                return op.id == opcional_id;
            });
            opcional.quantidade = 1;
            window.reserva.opcionais.push(opcional);
        }
    }

    atualizarQuantidadeOpcional(opcional_id, quantidade);
}

function removeOpcionalReserva(opcional_id){
    const opcionaisReserva = getOpcionaisReserva();
    const opcionalIndex = opcionaisReserva.findIndex(op => op.id == opcional_id);
    if (opcionalIndex !== -1) {
        if (opcionaisReserva[opcionalIndex].quantidade > 1) {
            opcionaisReserva[opcionalIndex].quantidade--;
        } else {
            opcionaisReserva.splice(opcionalIndex, 1);
        }
    }
    setOpcionaisReserva(opcionaisReserva);
}


function removeAllOpcionalReserva(){
    window.reserva.opcionais = [];
}

function setOpcionaisReserva(opcionais) {
    window.reserva.opcionais = opcionais.map(opcional => ({
        id: opcional.id,
        nome: opcional.nome,
        preco_por_dia: opcional.preco_por_dia,
        preco_integral: opcional.preco_integral,
        tipo_cobranca: opcional.tipo_cobranca,
        preco_total: opcional.preco_total,
        quantidade: opcional.quantidade || 0
    }));
}


function setCupomDesconto(cupom) {
    window.reserva.cupom_desconto = cupom;
}

function getMinhaReserva() {
    return reserva;
}

function getTarifaBase() {
    return window.reserva.tarifa_base;
}

function getQuantidadeDias() {
    return isNaN(window.reserva.quantidade_dias) ? 0 : window.reserva.quantidade_dias;
}

function getOpcionaisReserva() {
    return window.reserva.opcionais;
}

function getCupomDescontoValor() {
    return window.reserva.cupom_desconto ? window.reserva.cupom_desconto.valor : 0;
}

function getEstacaoRetirada(){
    return window.reserva.estacao_retirada_id;
}

function getEstacaoDevolucao(){
    return window.reserva.estacao_devolucao_id;
}


function setEstacaoDevolucao(id, nome){
    window.reserva.estacao_devolucao_id = id;
    window.reserva.estacao_devolucao_nome = nome;
}

function calcularValorTotal() {
    let valorTotal = 0;
    let valorTotalOpcionais = 0;
    const quantidadeDias = getQuantidadeDias();



    getOpcionaisReserva().forEach(opcional => {
        if(opcional.tipo_cobranca == "por_dia"){
            valorTotalOpcionais += opcional.preco_por_dia * quantidadeDias * opcional.quantidade;
        }else{
            valorTotalOpcionais += opcional.preco_integral * opcional.quantidade;
        }
    });

    valorTotal = (getTarifaBase() * quantidadeDias) + valorTotalOpcionais;


    const valorCupomDesconto = getCupomDescontoValor();
    let valorDesconto = 0;
    if (valorCupomDesconto > 0) {
        valorDesconto = (valorTotal * valorCupomDesconto  / 100);
    }

    return (valorTotal - valorDesconto).toFixed(2);
}

// Função para calcular o valor total da reserva
// function calcularValorTotal() {
//     let valorTotal = getTarifaBase() * getQuantidadeDias();

//     // Aplicar desconto do cupom, se houver
//     const descontoCupom = getCupomDescontoValor();
//     if (descontoCupom > 0) {
//         valorTotal -= (valorTotal * descontoCupom / 100);
//     }

//     // Adicionar valor dos opcionais
//     const opcionais = getOpcionaisReserva();
//     if(opcionais.length > 0){
//         opcionais.forEach(opcional => {
//             if (opcional.tipo_cobranca === "por_dia") {
//                 valorTotal += opcional.preco_por_dia * getQuantidadeDias() * opcional.quantidade;
//             } else {
//                 valorTotal += opcional.preco_integral * opcional.quantidade;
//             }
//         });
//     }

//     return valorTotal.toFixed(2);
// }

// Atualizar a função getValorTotal para usar o novo cálculo
function getValorTotal() {
    return calcularValorTotal() == NaN ? 0 : calcularValorTotal();
}

// Atualizar a função getValorDiario
function getValorDiario() {
    const valorTotal = parseFloat(getValorTotal());
    const quantidadeDias = getQuantidadeDias();

    const valorDiario = (valorTotal / quantidadeDias).toFixed(2);
    return isNaN(valorDiario) ? 0 : valorDiario;
}

// Atualizar a função atualizarMinhaReserva para usar a formatação de moeda
function atualizarMinhaReserva() {
    $('#tarifa_base').text(formatarMoeda(getTarifaBase()));
    $('#desconto').text(getCupomDescontoValor() + "%");
    $('#quantidade_dias').text(getQuantidadeDias());

    $('#minhaReserva_opcionals_ul').empty();

    getOpcionaisReserva().forEach(opcional => {
        const valorOpcional = opcional.tipo_cobranca === "por_dia" ? opcional.preco_por_dia : opcional.preco_integral;
        adicionarOpcionalNoHtmlDaMinhaReserva(opcional.nome, opcional.quantidade, formatarMoeda(valorOpcional));
    });

    $('#valor_total_reserva').text(formatarMoeda(getValorTotal()));
    $('#quantidade_dias').text(`/ ${getQuantidadeDias()} dias`);
    $('#valor_diario_reserva').text(formatarMoeda(getValorDiario()));
}

// Função para atualizar a quantidade de um opcional
function atualizarQuantidadeOpcional(opcionalId, novaQuantidade) {
    const opcionais = getOpcionaisReserva();
    const opcionalIndex = opcionais.findIndex(op => op.id === opcionalId);

    if (opcionalIndex !== -1) {
        opcionais[opcionalIndex].quantidade = novaQuantidade;
        setOpcionais(opcionais);
        atualizarMinhaReserva();
    }
}

// Função para incrementar a quantidade de um opcional
function incrementarOpcional(opcionalId) {
    const opcionais = getOpcionaisReserva();
    const opcional = opcionais.find(op => op.id === opcionalId);

    if (opcional) {
        atualizarQuantidadeOpcional(opcionalId, opcional.quantidade + 1);
    }
}

// Função para decrementar a quantidade de um opcional
function decrementarOpcional(opcionalId) {
    const opcionais = getOpcionaisReserva();
    const opcional = opcionais.find(op => op.id === opcionalId);

    if (opcional && opcional.quantidade > 0) {
        atualizarQuantidadeOpcional(opcionalId, opcional.quantidade - 1);
    }
}

// Atualizar a função generateOpcionalHtml para incluir os botões de incremento e decremento
function generateOpcionalHtml(opcional) {
    return `
        <div class="border p-2 mx-1">
            <label class="m-0" for="btn-check-${opcional.id}-outlined">${opcional.nome}</label><br>
            <span>${formatarMoeda(opcional.preco_por_dia)}</span>
            <br>
            <span><strong style="font-size:0.7rem">Quantidade:</strong><br>
                <button class='btn btn-xs btn-dark' onclick="decrementarOpcional(${opcional.id})">-</button>
                <span id="quantidade-${opcional.id}">${opcional.quantidade || 0}</span>
                <button class='btn btn-xs btn-dark' onclick="incrementarOpcional(${opcional.id})">+</button>
            </span>
        </div>
    `;
}

// Atualizar a função adicionarOpcionalNoHtmlDaMinhaReserva para usar a formatação de moeda
function adicionarOpcionalNoHtmlDaMinhaReserva(nome, quantidade, valor) {
    let novaQuantidade = quantidade;
    if (quantidade === true) {
        novaQuantidade = 1;
    }

    const html = `
        <li class="d-flex px-3" style="border-bottom: 1px solid #9d9c9c4d;">
            <div class="col d-flex align-items-center" style="justify-content:left">
                <strong>${nome}</strong>
                <span class="badge badge-secondary" style="padding:3px;font-size:8px;background:#7f8c8d">
                    ${novaQuantidade ? novaQuantidade + 'x' : '0x'}
                </span>
            </div>
            <div class="col-md-6 d-flex align-items-center" style="justify-content:right">
                ${formatarMoeda(valor)}
            </div>
        </li>
    `;

    $('#minhaReserva_opcionals_ul').append(html);
}

// Função para formatar valores monetários
function formatarMoeda(valor) {
    return valor;
    // return new Intl.NumberFormat(  'pt-BR', {
    return new Intl.NumberFormat('pt-PT', { // Exibir em formato de euro
        style: 'currency',
        currency: 'EUR'
    }).format(valor);
}

// Função para atualizar a quantidade de um opcional na interface
function atualizarQuantidadeOpcionalInterface(opcionalId, quantidade) {
    const elementoQuantidade = document.getElementById(`quantidade-${opcionalId}`);
    if (elementoQuantidade) {
        elementoQuantidade.textContent = quantidade;
    }
}

// Função para incrementar a quantidade de um opcional
function incrementarOpcional(opcionalId) {
    const opcionais = getOpcionaisReserva();
    const opcional = opcionais.find(op => op.id === opcionalId);

    if (opcional) {
        const novaQuantidade = (opcional.quantidade || 0) + 1;
        atualizarQuantidadeOpcional(opcionalId, novaQuantidade);
        atualizarQuantidadeOpcionalInterface(opcionalId, novaQuantidade);
        atualizarMinhaReserva();
    }
}

// Atualizar a função decrementarOpcional
function decrementarOpcional(opcionalId) {
    const opcionais = getOpcionaisReserva();
    const opcional = opcionais.find(op => op.id === opcionalId);

    if (opcional && opcional.quantidade > 0) {
        const novaQuantidade = opcional.quantidade - 1;
        atualizarQuantidadeOpcional(opcionalId, novaQuantidade);
        atualizarQuantidadeOpcionalInterface(opcionalId, novaQuantidade);
        atualizarMinhaReserva();
    }
}

// Atualizar a função atualizarMinhaReserva para usar a formatação de moeda
function atualizarMinhaReserva() {
    $('#tarifa_base').text(formatarMoeda(getTarifaBase()));
    $('#desconto').text(getCupomDescontoValor() + "%");
    $('#quantidade_dias').text(getQuantidadeDias());

    $('#minhaReserva_opcionals_ul').empty();

    getOpcionaisReserva().forEach(opcional => {
        if(opcional && opcional.quantidade > 0){
            const valor = opcional.tipo_cobranca == "por_dia" ? opcional.preco_por_dia : opcional.preco_integral;
            adicionarOpcionalNoHtmlDaMinhaReserva(opcional.nome, opcional.quantidade, valor);
        }
    });

    $('#valor_total_reserva').text(formatarMoeda(getValorTotal()));
    $('#quantidade_dias').text(`/ ${getQuantidadeDias()} dias`);
    $('#valor_diario_reserva').text(formatarMoeda(getValorDiario()));
}
function faltaPreencherEstacoesEDatas(){
    return window.reserva.estacao_retirada_id == null || window.reserva.estacao_devolucao_id == null || window.reserva.data_inicio == null || window.reserva.data_fim == null;
}
