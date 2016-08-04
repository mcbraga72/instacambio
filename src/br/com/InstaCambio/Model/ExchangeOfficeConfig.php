<?php

namespace br\com\InstaCambio\Model;

class ExchangeOfficeConfig
{

    const CURRENCY_CARD_PRODUCT = 1;

    const FOREIGN_CURRENCY_PRODUCT = 2;

    const IOF_FOREIGN_CURRENCY_TEXT = '\(\+ iof 1,1\%\)';

    public static $exchangeOffices = [
        'prime-cash' => [
            'nickname' => 'prime-cash',
            'name' => 'Prime Cash',
            'email' => 'atendimento@primecash.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.primecash.com.br/produtos.html?shop_cat=2',
                'selector' => 'div.produtos.fl',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano', 'USD'
                    ],
                    'EUR' => [
                        'Euro', 'EUR'
                    ],
                    'GBP' => [
                        'Libra Esterlina', 'GBP'
                    ],
                    'ARS' => [
                        'Peso Argentino', 'ARS'
                    ],
                    'CAD' => [
                        'Dólar Canadense', 'CAD'
                    ],
                    'AUD' => [
                        'Dólar Australiano', 'AUD'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês', 'NZD'
                    ],
                    'CLP' => [
                        'Peso Chileno', 'CLP'
                    ],
                    'MXN' => [
                        'Peso Mexicano', 'MXN'
                    ],
                    'UYU' => [
                        'Peso Uruguaio', 'UYU'
                    ],
                    'CHF' => [
                        'Franco Suiço', 'CHF'
                    ],
                    'JPY' => [
                        'Iene Japonês', 'JPY'
                    ],
                    'CNY' => [
                        'Yuan Renmimbi Chinês', 'CNY'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.primecash.com.br/produtos.html?shop_cat=1',
                'selector' => 'div.produtos.fl',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Visa Travel Money - Dólar \(USD\)'
                    ],
                    'EUR' => [
                        'Visa Travel Money - Euro'
                    ],
                    'GBP' => [
                        'Visa Travel Money - Libra'
                    ],
                    'CAD' => [
                        'Visa Travel Money - Dólar Canadense \(CAD\)'
                    ],
                    'AUD' => [
                        'Visa Travel Money - Dólar Australiano \(AUD\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                ],
            ],
        ],
        'fast-money' => [
            'nickname' => 'fast-money',
            'name' => 'Fast Money',
            'email' => 'contato@fastmoneytour.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.fastmoneytour.com.br/cotacao-de-moeda-fast-money-tour.php',
                'selector' => 'div.ticker ul li',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'CHF' => 1,
                    'GBP' => 1,
                    'CLP' => 1,
                    'MXN' => 1,
                    'UYU' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'ecoforte' => [
            'nickname' => 'ecoforte',
            'name' => 'Ecoforte',
            'email' => 'contato@ecofortecambioeturismo.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.ecofortecambioeturismo.com.br/',
                'selector' => 'div.row.moedas div.col-md-3.col-sm-4.col-em-6.col-xs-12',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO', 'USD'
                    ],
                    'AUD' => [
                        'DÓLAR AUSTRALIANO', 'AUD'
                    ],
                    'CAD' => [
                        'DÓLAR CANADENSE', 'CAD'
                    ],
                    'NZD' => [
                        'DÓLAR NEOZELANDÊS', 'NZD'
                    ],
                    'EUR' => [
                        'EURO', 'EUR'
                    ],
                    'CHF' => [
                        'FRANCO SUIÇO', 'CHF'
                    ],
                    'GBP' => [
                        'LIBRA ESTERLINA', 'GBP'
                    ],
                    'ARS' => [
                        'PESO ARGENTINO', 'ARS'
                    ],
                    'MXN' => [
                        'PESO MEXICANO', 'MXN'
                    ],
                    'CNY' => [
                        'YUAN RENMIMBI CHINÊS', 'CNY'
                    ],
                ],

                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'CHF' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'MXN' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.ecofortecambioeturismo.com.br/produtos/visa-travel-money',
                'selector' => 'div.row.produtos div.col-md-3.col-sm-4.col-em-6.col-xs-12',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO', 'USD'
                    ],
                    'AUD' => [
                        'DÓLAR AUSTRALIANO', 'AUD'
                    ],
                    'CAD' => [
                        'DÓLAR CANADENSE', 'CAD'
                    ],
                    'NZD' => [
                        'DÓLAR NEOZELANDÊS'
                    ],
                    'EUR' => [
                        'EURO', 'EUR'
                    ],
                    'GBP' => [
                        'LIBRA ESTERLINA', 'GBP'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'amazonia' => [
            'nickname' => 'amazonia',
            'name' => 'Amazônia',
            'email' => 'amazoniacambio@gmail.com',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.amazoniacambio.com.br/site_2013/',
                'selector' => 'div#right-home-area div.widget_conversormanual.widget table.custom_table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'D&oacutelar Americano'
                    ],
                    'CAD' => [
                        'D&oacutelar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CHF' => [
                        'Franco su&iacuteço'
                    ],
                    'JPY' => [
                        'Yene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'threeav' => [
            'nickname' => 'threeav',
            'name' => '3AV',
            'email' => 'contatos@3av.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.3av.com.br/index.php/produtos-de-cambio/moedas-em-destaque',
                'selector' => 'div#system article.item div.content.clearfix div.grid-block.pricing div.grid-box.width25',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro', 'EUR'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Neozelandês'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'COP' => [
                        'Peso Colombiano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                    'PEN' => [
                        'Novo Sol Peruano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'CHF' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'JPY' => 0,
                    'COP' => 0,
                    'UYU' => 0,
                    'MXN' => 0,
                    'CNY' => 0,
                    'PEN' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.3av.com.br/index.php/produtos-de-cambio/moedas-em-destaque',
                'selector' => 'div#system article.item div.content.clearfix div.grid-block.pricing div.grid-box.width25',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 1,
                    'ARS' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                ],
            ],
        ],
        'dibran' => [
            'nickname' => 'dibran',
            'name' => 'Dibran',
            'email' => 'comercial@dibran.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.cambiocorretora.com.br/',
                'selector' => '#element-132, #element-156, #element-131, #element-126',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'DÓLAR'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'torre' => [
            'nickname' => 'torre',
            'name' => 'Torre',
            'email' => 'ouvidoria@torrecorretora.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.torrecambio.com.br/MoedaEspecie.aspx',
                'selector' => 'div.conteudoPagina div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano', 'USD'
                    ],
                    'EUR' => [
                        'Euro', 'EUR'
                    ],
                    'GBP' => [
                        'Libra Esterlina', 'GBP'
                    ],
                    'JPY' => [
                        'Iene', 'JPY'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'JPY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.torrecambio.com.br/CartaoVisa.aspx',
                'selector' => 'div.conteudoPagina div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'start-trips' => [
            'nickname' => 'start-trips',
            'name' => 'Start Trips',
            'email' => 'cambio@startcambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://startcambio.com.br/comprar-moedas.html?limit=36',
                'selector' => 'div.category-products ul.products-grid.category-products-grid li',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro', 'EUR'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'NZD' => [
                        'Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'ARS' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'UYU' => 0,
                    'JPY' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'sagitur' => [
            'nickname' => 'sagitur',
            'name' => 'Sagitur',
            'email' => '',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.sagiturturismo.com.br/',
                'selector' => 'div#conversor form#form1 select#Moeda option',
                'iofIncluded' => true,
                'keywords' => [
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'JPY' => [
                        'Yen'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'USD' => [
                        'Dólar Americano',
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'ARS' => 0,
                    'CLP' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CHF' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'agk' => [
            'nickname' => 'agk',
            'name' => 'AGK Câmbio',
            'email' => 'turismo@agkcorretora.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://agkcorretora.com.br/pagina/cotacoes-e-simulador',
                'selector' => 'div.blocoMoeda',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dolar americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'AUD' => [
                        'Dollar Australiano'
                    ],
                    'CAD' => [
                        'Dollar Canadense'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'JPY' => [
                        'Yene Japones'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'NZD' => [
                        'Dollar Neozelandes'
                    ],
                    'CNY' => [
                        'China'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 6,
                    'EUR' => 6,
                    'GBP' => 6,
                    'ARS' => 1,
                    'AUD' => 6,
                    'CAD' => 6,
                    'CLP' => 2,
                    'JPY' => 2,
                    'MXN' => 2,
                    'UYU' => 2,
                    'NZD' => 2,
                    'CNY' => 2,
                    'CHF' => 2,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://agkcorretora.com.br/pagina/cotacoes-e-simulador',
                'selector' => 'div.blocoMoeda',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dolar americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'AUD' => [
                        'Dollar Australiano'
                    ],
                    'CAD' => [
                        'Dollar Canadense'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 2,
                    'ARS' => 1,
                    'AUD' => 2,
                    'CAD' => 2,
                ],
            ],
        ],
        'best-money' => [
            'nickname' => 'best-money',
            'name' => 'Best Money',
            'email' => 'contato@bestmoney.tur.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://bestmoney.tur.br/',
                'selector' => 'div.container div.row div.sixteen.columns table tr td',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'EUR' => 0,
                    'CHF' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'sp-mundi' => [
            'nickname' => 'sp-mundi',
            'name' => 'SP Mundi',
            'email' => 'cambio@spmundi.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://www.spmundi.com.br/moedas-em-especie',
                'selector' => 'div#content div.box-content div.product-block.clearfix a',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano - USD',
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'CHF' => [
                        'Franco Suiço - CHF[^ ]'
                    ],
                    'CNY' => [
                        'Yuan Renmimbi Chinês'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'JPY' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'USD' => 0,
                    'AUD' => 0,
                    'CNY' => 0,
                    'COP' => 0,
                    'PEN' => 0,
                    'CAD' => 0,
                    'CHF' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://www.spmundi.com.br/travel-card',
                'selector' => 'a.product-box',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar \(USD\)'
                    ],
                    'EUR' => [
                        'Euro \(EUR\)'
                    ],
                    'CAD' => [
                        'Dólar Canadense \(CAD\)'
                    ],
                    'GBP' => [
                        'Libra \(GBP\)'
                    ],
                    'AUD' => [
                        'Dólar Australiano \(AUD\)'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês \(NZD\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                ],
            ],
        ],
        'arrm' => [
            'nickname' => 'arrm',
            'name' => 'ARRM Câmbio',
            'email' => 'contato@arrmcambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://arrmcambio.com.br/?page_id=326',
                'selector' => 'div.main-body-wrapper section.main-content-wrapper div.woocommerce.columns-4 div.item-block-1._collection-item',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano – USD'
                    ],
                    'AUD' => [
                        'Dólar Australiano	- AUD'
                    ],
                    'CAD' => [
                        'Dólar Canadense – CAD'
                    ],
                    'EUR' => [
                        'Euro – EUR[^ ]'
                    ],
                    'GBP' => [
                        'Libra Esterlina – GBP[^ ]'
                    ],
                    'ARS' => [
                        'Peso Argentino – ARS'
                    ],
                    'CLP' => [
                        'Peso Chileno – CLP'
                    ],
                    'MXN' => [
                        'Peso Mexicano – MXN'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://arrmcambio.com.br/?page_id=326',
                'selector' => 'div.main-body-wrapper section.main-content-wrapper div.woocommerce.columns-4 div.item-block-1._collection-item',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar – USD \(Cartão\)'
                    ],
                    'EUR' => [
                        'Euro – EUR \(Cartão\)'
                    ],
                    'GBP' => [
                        'Libra Esterlina – GBP \(Cartão\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'maxima' => [
            'nickname' => 'maxima',
            'name' => 'Máxima',
            'email' => 'mesacambio@maximacctvm.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://lojavirtual.maximacambio.com.br/lojamaxima/carga.aspx',
                'selector' => 'form#form1 div#master div#conteudo_geral div.box_carga',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA ESTERLINA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://lojavirtual.maximacambio.com.br/lojamaxima/carga.aspx',
                'selector' => 'form#form1 div#master div#conteudo_geral div.box_carga',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'CARTÃO DÓLAR AMERICANO'
                    ],
                    'AUD' => [
                        'CARTÃO DÓLAR AUSTRALIANO'
                    ],
                    'EUR' => [
                        'CARTÃO EURO'
                    ],
                    'CAD' => [
                        'CARTÃO DÓLAR CANADENSE'
                    ],
                    'GBP' => [
                        'CARTÃO LIBRA'
                    ],
                    'ARS' => [
                        'CARTÃO PESO ARGENTINO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                ],
            ],

        ],
        'thaler' => [
            'nickname' => 'thaler',
            'name' => 'Thaler',
            'email' => 'atendimento@thalercambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'decode' => false,
            'delivery' => true,
            'foreignCurrency' => [
                'url' => 'http://thalercambio.com.br/cotacao.php',
                'selector' => 'div > table > tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar - USD'
                    ],
                    'EUR' => [
                        'Euro - EUR'
                    ],
                    'GBP' => [
                        'Libra - GBP'
                    ],
                    'CHF' => [
                        'Franco Suiço - CHF'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CHF' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'fox-cambio' => [
            'nickname' => 'fox-cambio',
            'name' => 'Fox Câmbio',
            'email' => '',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://foxcambio.com.br/',
                'selector' => 'div.container div.content div.fltlft table tr td table tr td table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro[^ ]'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'COP' => [
                        'Peso Colombiano'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rande Sul Africano'
                    ],
                    'ILS' => [
                        'Shekel \/ Israel'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'JPY' => 1,
                    'AUD' => 1,
                    'NZD' => 1,
                    'CHF' => 1,
                    'CNY' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'COP' => 1,
                    'MXN' => 1,
                    'UYU' => 1,
                    'ZAR' => 1,
                    'ILS' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://foxcambio.com.br/',
                'selector' => 'div.container div.content div.fltlft table tr td table tr td table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar - cartão pré-pago'
                    ],
                    'EUR' => [
                        'Euro - cartão pré-pago'
                    ],
                    'GBP' => [
                        'Libra - cartão pré-pago'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'gradual' => [
            'nickname' => 'gradual',
            'name' => 'Gradual',
            'email' => 'cambiosp@gradualinvestimentos.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://www.gradualinvestimentos.com.br/Investimentos/Cambio.aspx',
                'selector' => 'div[data-idconteudo="venda-cambio"] ul.ProdutosCambio li',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano', 'USD'
                    ],
                    'EUR' => [
                        'Euro', 'EUR'
                    ],
                    'GBP' => [
                        'Libra Esterlina', 'GBP'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ]
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0
                ],
            ],
            'currencyCard' => false
        ],
        'green' => [
            'nickname' => 'green',
            'name' => 'Green Câmbio',
            'email' => 'atendimento@greencambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://greencambio.com.br/',
                'selector' => 'div#main div.avada-row div.sidebar div.textwidget table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DOLAR'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'picchioni' => [
            'nickname' => 'picchioni',
            'name' => 'Picchioni Câmbio',
            'email' => 'mesa.cambio@picchioni.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'https://www.picchionicambiovirtual.com.br/',
                'selector' => 'div#ctl00_ContentPlaceHolder1_ctl00 div.espacoMoedaVitrine select.dropDownListMoeda option',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar \(USD\)'
                    ],
                    'EUR' => [
                        'Euro \(EUR\)'
                    ],
                    'CAD' => [
                        'Dólar Canadense \(CAD\)'
                    ],
                    'AUD' => [
                        'Dólar Australiano \(AUD\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://www.picchionicambiovirtual.com.br/',
                'selector' => 'div#ctl00_ContentPlaceHolder1_ctl01 div.espacoMoedaVitrine select.dropDownListMoeda option',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Mastercard Dólar Americano'
                    ],
                    'EUR' => [
                        'Mastercard Euro'
                    ],
                    'GBP' => [
                        'MasterCard Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'golden-money' => [
            'nickname' => 'golden-money',
            'name' => 'Golden Money',
            'email' => 'cambio@goldenmoney.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.goldenmoney.com.br/',
                'selector' => 'div.bloco-direita-header div.cotacoes div.texto marquee',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'europa' => [
            'nickname' => 'europa',
            'name' => 'Europa Câmbio',
            'email' => 'atendimento@europacambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'https://www.xchange.com.br/produtosInternos_moedas.html',
                'selector' => 'div#content-produto div[ng-repeat="moeda in MoedasEspecie"]',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dolar Nova Zelândia'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'JPY' => [
                        'Ien Japonês'
                    ],
                    'CNY' => [
                        'Iuan Renmimbi'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'CNY' => 1,
                    'CLP' => 1,
                    'MXN' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://www.xchange.com.br/produtosInternos_vtm.html',
                'selector' => 'div#content-produto div[ng-repeat="moeda in MoedasCartoes"]',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dolar Nova Zelândia'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                ],
            ],
        ],
        'graco' => [
            'nickname' => 'graco',
            'name' => 'Graco Exchange',
            'email' => 'cambio@graco.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://gracoexchange.com.br/Vitrine.aspx',
                'selector' => 'div.conteudoPagina div.espacoProduto > div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'ILS' => [
                        'Israeli New Shekel'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rande Sul Africano'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'ILS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'ZAR' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://gracoexchange.com.br/Vitrine.aspx',
                'selector' => 'div.espacoProdutosSeparadoBandeira > div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'TravelMoney Dolar \(USD\)'
                    ],
                    'EUR' => [
                        'TravelMoney Euro'
                    ],
                    'AUD' => [
                        'TravelMoney Dolar Australiano'
                    ],
                    'CAD' => [
                        'TravelMoney Dolar Canadense'
                    ],
                    'GBP' => [
                        'TravelMoney Libra'
                    ],
                    'ARS' => [
                        'TravelMoney Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                ],
            ],
        ],
        'conexion' => [
            'nickname' => 'conexion',
            'name' => 'Conexion Câmbio',
            'email' => 'ouvidoria@conexioncambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.conexioncambio.com.br/',
                'selector' => 'div#cotacoes table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Turismo'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ]
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1
                ],
            ],
            'currencyCard' => false
        ],
        'mondial-money' => [
            'nickname' => 'mondial-money',
            'name' => 'Mondial Money',
            'email' => 'contato@mondialmoney.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://mondialmoney.com.br/produtos.html?shop_cat=2',
                'selector' => 'div.content-interna.fl div.produtos.fl',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano - USD'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rand Sul-Africano'
                    ],
                    'CNY' => [
                        'Yuan Renmimbi Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'ZAR' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://mondialmoney.com.br/produtos.html?shop_cat=1',
                'selector' => 'div.produtos.fl',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Visa Travel Money - Dólar'
                    ],
                    'EUR' => [
                        'Visa Travel Money - Euro'
                    ],
                    'GBP' => [
                        'Visa Travel Money - Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'ourominas' => [
            'nickname' => 'ourominas',
            'name' => 'Ourominas',
            'email' => 'ourominas@ourominas.com',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.cambiorapido.com/tabelinha_wl.asp?filial=144%20CALLCENTER',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadá'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CNY' => [
                        'Iuan Chinês'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'COP' => [
                        'Peso Colombiano'
                    ],
                    'ZAR' => [
                        'Rande Sul Africano'
                    ],
                    'ILS' => [
                        'Shekel'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'COP' => 0,
                    'ZAR' => 0,
                    'ILS' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.cambiorapido.com/tabelinha_wl.asp?filial=144%20CALLCENTER',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar - cartão pré-pago'
                    ],
                    'EUR' => [
                        'Euro - cartão pré-pago'
                    ],
                    'GBP' => [
                        'Libra - cartão pré-pago'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'get-go' => [
            'nickname' => 'get-go',
            'name' => 'Get & Go',
            'email' => 'contato@ggcambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://ggcambio.com.br/home',
                'selector' => 'div#moedas',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CLP' => [
                        'Pesos Chilenos'
                    ],
                    'UYU' => [
                        'Pesos Uruguaios'
                    ],
                    'CNY' => [
                        'Renmimbi Iuan'
                    ],
                    'MXN' => [
                        'Pesos Mexicanos'
                    ],
                    'ZAR' => [
                        'Rande'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'CLP' => 0,
                    'UYU' => 0,
                    'CNY' => 0,
                    'MXN' => 0,
                    'ZAR' => 0,
                ],
            ],
            'currencyCard' => false
        ],
        'guitta' => [
            'nickname' => 'guitta',
            'name' => 'Guitta',
            'email' => 'contato@guitta.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => false,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.guitta.com.br/turismo.php',
                'selector' => 'body > ul.lista-moedas-small > li',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'USD'
                    ],
                    'EUR' => [
                        'EUR'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.guitta.com.br/turismo.php',
                'selector' => 'body > ul.lista-moedas-small > li',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'GTM \(USD\)'
                    ],
                    'EUR' => [
                        'GTM \(EUR\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
        ],
        'bee-cambio' => [
            'nickname' => 'bee-cambio',
            'name' => 'Bee Câmbio',
            'email' => 'contato@beecambio.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'https://www.beecambio.com.br/cotacao-turismo/preco',
                'selector' => 'table#tabela-cotacao tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rand Africa do Sul'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'JPY' => 1,
                    'DKK' => 1,
                    'NOK' => 1,
                    'SEK' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                    'CHF' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'MXN' => 1,
                    'UYU' => 1,
                    'ZAR' => 1,
                    'KRW' => 1,
                    'CNY' => 1,
                ],
            ],
            'currencyCard' => false
        ],
        'cambio-store' => [
            'nickname' => 'cambio-store',
            'name' => 'Câmbio Store',
            'email' => 'atendimento@cambiostore.com',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'https://cambiostore.com/aid=2?shop_cat=1',
                'selector' => 'div#mainBlock div.shop div.produtos-geral.fl div.lista-produtos.fl.pr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano',
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                    'COP' => [
                        'Peso Colombiano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rand Sul-Africano'
                    ],
                    'DKK' => [
                        'Coroa Dinamarquesa'
                    ],
                    'NOK' => [
                        'Coroa Norueguesa'
                    ],
                    'SEK' => [
                        'Coroa Sueca'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                    'COP' => 0,
                    'UYU' => 0,
                    'ZAR' => 0,
                    'DKK' => 0,
                    'NOK' => 0,
                    'SEK' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://cambiostore.com/aid=2?shop_cat=2',
                'selector' => 'div.produtos-geral div.lista-produtos.fl.pr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'carol' => [
            'nickname' => 'carol',
            'name' => 'Carol DTVM',
            'email' => 'cadastro@caroldtvm.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.caroldtvm.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano - USD'
                    ],
                    'EUR' => [
                        'Euro - EUR'
                    ],
                    'GBP' => [
                        'Libras Esterlinas - GBP'
                    ],
                    'CAD' => [
                        'Dólar Canadense - CAD'
                    ],
                    'AUD' => [
                        'Dólar Australiano - AUD'
                    ],
                    'CHF' => [
                        'Franco Suiço - CHF'
                    ],
                    'JPY' => [
                        'Iene - JPY'
                    ],
                    'ARS' => [
                        'Pesos Argentinos - ARS'
                    ],
                    'NZD' => [
                        'Nova Zelândia - NZD'
                    ],
                    'CLP' => [
                        'Pesos Chilenos - CLP'
                    ],
                    'MXN' => [
                        'Pesos Mexicanos - MXN'
                    ],
                    'UYU' => [
                        'Pesos Uruguaios - UYU'
                    ],
                    'ZAR' => [
                        'Rand - ZAR'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'ARS' => 1,
                    'NZD' => 1,
                    'CLP' => 1,
                    'MXN' => 1,
                    'UYU' => 1,
                    'ZAR' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.caroldtvm.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano[^ ]'
                    ],
                    'EUR' => [
                        'Euro[^ ]'
                    ],
                    'GBP' => [
                        'Libras Esterlinas[^ ]'
                    ],
                    'CAD' => [
                        'Dólar Canadense[^ ]'
                    ],
                    'AUD' => [
                        'Dólar Australiano[^ ]'
                    ],
                    'ARS' => [
                        'Pesos Argentinos[^ ]'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                ],
            ],
        ],
        'multi-money' => [
            'nickname' => 'multi-money',
            'name' => 'Multi Money',
            'email' => 'sac@multimoneycorretora.com.br',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.lojamultimoney.com.br/MoedasEspecie.aspx',
                'selector' => 'div#ctl00_MainContent_UpdatePanel1 div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'NOK' => [
                        'Coroa Norueguesa'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'NOK' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.lojamultimoney.com.br/CartaoViagem.aspx',
                'selector' => 'div#ctl00_MainContent_upProdutos div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                ],
            ],
        ],
        'alpha-cambio' => [
            'nickname' => 'alpha-cambio',
            'name' => 'Alpha Câmbio',
            'email' => 'contato@alphacambio.com',
            'state' => 'SP',
            'city' => 'sao-paulo',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://alphacambio.com/',
                'selector' => 'div.box-product div',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    /*'ARS' => [
                        'Peso Argentino'
                    ],*/
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'CNY' => [
                        'Yuan Renmimbi Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'GBP' => 0,
                    //'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://alphacambio.com/',
                'selector' => 'div.box-product div',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Visa TravelMoney - Dólar \(USD\)'
                    ],
                    'AUD' => [
                        'Visa TravelMoney - Dólar Australiano \(AUD\)'
                    ],
                    'CAD' => [
                        'Visa TravelMoney - Dólar Canadense \(CAD\)'
                    ],
                    'EUR' => [
                        'Visa TravelMoney - Euro \(EUR\)'
                    ],
                    'GBP' => [
                        'Visa TravelMoney - Libra \(GBP\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'casa-alianca' => [
            'nickname' => 'casa-alianca',
            'name' => 'Casa Aliança',
            'email' => 'viagens@casaalianca.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.casaalianca.com.br/novosite/',
                'selector' => 'body table table:nth-child(1) tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'US DOLAR'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA'
                    ],
                    'ARS' => [
                        'ARGENTINA'
                    ],
                    'AUD' => [
                        'AUSTRALIA'
                    ],
                    'CAD' => [
                        'CANADA'
                    ],
                    'CLP' => [
                        'CHILE'
                    ],
                    'JPY' => [
                        'JAPÃO'
                    ],
                    'CHF' => [
                        'SUIÇA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'CLP' => 1,
                    'JPY' => 1,
                    'CHF' => 1
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.casaalianca.com.br/novosite/',
                'selector' => 'body table table:nth-child(1) tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'VTM DOLAR'
                    ],
                    'EUR' => [
                        'VTM EURO'
                    ],
                    'GBP' => [
                        'VTM LIBRA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'premium-viagens' => [
            'nickname' => 'premium-viagens',
            'name' => 'Premium Viagens',
            'email' => 'premium@premiumviagens.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.premiumviagens.com.br/cotacao.asp',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DOLAR AMERICANO'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA ESTERLINA'
                    ],
                    'ARS' => [
                        'PESO ARGENTINO'
                    ],
                    'AUD' => [
                        'DOLAR AUSTRALIANO'
                    ],
                    'CAD' => [
                        'DOLAR CANADENSE'
                    ],
                    'CLP' => [
                        'PESO CHILENO'
                    ],
                    'JPY' => [
                        'IENE JAPONÊS'
                    ],
                    'CHF' => [
                        'FRANCO SUIÇO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'CLP' => 1,
                    'JPY' => 1,
                    'CHF' => 1
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.premiumviagens.com.br/cotacao.asp',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'VTM DOLAR AMERICANO'
                    ],
                    'EUR' => [
                        'VTM EURO'
                    ],
                    'GBP' => [
                        'VTM LIBRA ESTERLINA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'tempo-livre' => [
            'nickname' => 'tempo-livre',
            'name' => 'Tempo Livre',
            'email' => 'contato@tempolivretur.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://tempolivretur.com.br/',
                'selector' => 'table#cambioCotacao tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'GBP' => [
                        'Libra Inglesa'
                    ],
                    'JPY' => [
                        'Yen Japonês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'CLP' => 0,
                    'ARS' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'JPY' => 0,
                    'CHF' => 0
                ],
            ],
            'currencyCard' => [
                'url' => 'http://tempolivretur.com.br/',
                'selector' => 'table#cambioCotacao tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Inglesa'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'ARS' => 0,
                ],
            ],
        ],
        'amitur' => [
            'nickname' => 'amitur',
            'name' => 'Amitur',
            'email' => 'barra@amitur.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://local.casaalianca.com.br/teosys/cotacao_tabela_site.asp',
                'selector' => 'body table table:nth-child(1) tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'US DOLAR'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA'
                    ],
                    'ARS' => [
                        'ARGENTINA'
                    ],
                    'AUD' => [
                        'AUSTRALIA'
                    ],
                    'CAD' => [
                        'CANADA'
                    ],
                    'CLP' => [
                        'CHILE'
                    ],
                    'JPY' => [
                        'JAPÃO'
                    ],
                    'CHF' => [
                        'SUIÇA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'CLP' => 1,
                    'JPY' => 1,
                    'CHF' => 1
                ],
            ],
            'currencyCard' => [
                'url' => 'http://local.casaalianca.com.br/teosys/cotacao_tabela_site.asp',
                'selector' => 'body table table:nth-child(1) tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'VTM DOLAR'
                    ],
                    'EUR' => [
                        'VTM EURO'
                    ],
                    'GBP' => [
                        'VTM LIBRA'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'one-barra' => [
            'nickname' => 'one-barra',
            'name' => 'One Barra',
            'email' => 'atendimento@onebarra.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.onebarra.com.br/cambio.php',
                'selector' => 'table.table-striped tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Comercial'
                    ],
                    'EUR' => [
                        'Euro', 'Comunidade Europeia'
                    ],
                    'GBP' => [
                        'Libra Esterlina', 'Reino Unido'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'CLP' => 1,
                    'CHF' => 1
                ],
            ],
            'currencyCard' => false
        ],
        'dantur' => [
            'nickname' => 'dantur',
            'name' => 'Dantur',
            'email' => '',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.dantur.com.br/novo/cambio/',
                'selector' => 'div#tabela table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA'
                    ],
                    'CAD' => [
                        'DÓLAR CANADENSE'
                    ],
                    'AUD' => [
                        'DÓLAR AUSTRALIANO'
                    ],
                    'ARS' => [
                        'PESO ARGENTINO'
                    ],
                    'CHF' => [
                        'FRANCO SUIÇO'
                    ],
                    'CLP' => [
                        'PESO CHILENO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                    'CHF' => 1,
                    'CLP' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.dantur.com.br/novo/cambio/',
                'selector' => 'div#tabela table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'GBP' => [
                        'LIBRA'
                    ],
                    'CAD' => [
                        'DÓLAR CANADENSE'
                    ],
                    'AUD' => [
                        'DÓLAR AUSTRALIANO'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                ],
            ],
        ],
        'quatro-cantos' => [
            'nickname' => 'quatro-cantos',
            'name' => 'Quatro Cantos',
            'email' => 'lojavirtual@4cantosturismo.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.4cantoscambio.com.br/PapelMoeda.aspx',
                'selector' => 'div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CLP' => [
                        'Pesos Chilenos'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CHF' => 0,
                    'AUD' => 0,
                    'CLP' => 0,
                    'CAD' => 0,
                    'JPY' => 0,
                ],
            ],
            'currencyCard' => false
        ],
        'ipanema-exchange' => [
            'nickname' => 'ipanema-exchange',
            'name' => 'Ipanema Exchange',
            'email' => 'ipanemaexchange@gmail.com',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://ipanemaexchange.com.br/loja/pt/13-moedas',
                'selector' => 'ul.product_list li.ajax_block_product',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dolar Americano'
                    ],
                    'CAD' => [
                        'Dolar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dolar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'CAD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'ARS' => 0,
                    'CHF' => 0,
                ],
            ],
            'currencyCard' => false
        ],
        'ultramar' => [
            'nickname' => 'ultramar',
            'name' => 'Ultramar',
            'email' => 'ultramar@ultramarviagens.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.ultramarviagens.com.br/cambio',
                'selector' => 'table.tb tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dolar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'JPY' => [
                        'Yen'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.ultramarviagens.com.br/cambio',
                'selector' => 'table.tb tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dolar VTM'
                    ],
                    'EUR' => [
                        'Euro VTM'
                    ],
                    'GBP' => [
                        'Libra VTM'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'le-bon-voyage' => [
            'nickname' => 'le-bon-voyage',
            'name' => 'Le Bon Voyage',
            'email' => '',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.lebonvoyage.com.br/agencias/',
                'selector' => 'div.content-article table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'MXN' => [
                        'Novo Peso Mexicano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'JPY' => [
                        'Yene Japonês'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                    'ZAR' => [
                        'Rand Africano'
                    ],
                    'DKK' => [
                        'Coroa Dinamarquesa'
                    ],
                    'SEK' => [
                        'Coroa Sueca'
                    ],
                    'PEN' => [
                        'Novo Sol Peruano'
                    ],
                    'NOK' => [
                        'Coroa Norueguesa'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                    'CHF' => 1,
                    'GBP' => 1,
                    'MXN' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'UYU' => 1,
                    'JPY' => 1,
                    'CNY' => 1,
                    'ZAR' => 1,
                    'DKK' => 1,
                    'SEK' => 1,
                    'PEN' => 1,
                    'NOK' => 1,
                ],
            ],
            'currencyCard' => false
        ],
        'pm-turismo' => [
            'nickname' => 'pm-turismo',
            'name' => 'PM Turismo',
            'email' => 'atendimento@pmturismo.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.pmturismo.com.br/site_novo/moedas.php',
                'selector' => 'marquee',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'usa'
                    ],
                    'EUR' => [
                        'euro'
                    ],
                    'GBP' => [
                        'ReinoUnido'
                    ],
                    'ARS' => [
                        'argentina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 3,
                    'GBP' => 5,
                    'ARS' => 7,
                ],
            ],
            'currencyCard' => false
        ],
        'navegantes' => [
            'nickname' => 'navegantes',
            'name' => 'Navegantes',
            'email' => 'info@agencianavegantes.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://api.agencianavegantes.com.br/tabela.php',
                'selector' => 'body > table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'JPY' => [
                        'Yen'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'CHF' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'JPY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://api.agencianavegantes.com.br/tabela.php',
                'selector' => 'body > table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                ],
            ],
        ],
        'express-change' => [
            'nickname' => 'express-change',
            'name' => 'Express Change',
            'email' => 'expresschangetur@gmail.com',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.expresschange.tur.br/',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        "Dólar Americano " . self::IOF_FOREIGN_CURRENCY_TEXT
                    ],
                    'EUR' => [
                        "Euro " . self::IOF_FOREIGN_CURRENCY_TEXT
                    ],
                    'GBP' => [
                        "Libra " . self::IOF_FOREIGN_CURRENCY_TEXT
                    ],
                    'CAD' => [
                        "Dólar Canadense " . self::IOF_FOREIGN_CURRENCY_TEXT
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'MXN' => [
                        'Pesos Mexicanos'
                    ],
                    'CLP' => [
                        'Pesos Chilenos'
                    ],
                    'BOB' => [
                        'Pesos Bolivianos'
                    ],
                    'PEN' => [
                        'Soles Peruanos'
                    ],
                    'UYU' => [
                        'Pesos Uruguaios'
                    ],
                    'JPY' => [
                        'Yen Japonês'
                    ],
                    'CNY' => [
                        'Yuan'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                    'CHF' => 1,
                    'MXN' => 1,
                    'CLP' => 1,
                    'BOB' => 1,
                    'PEN' => 1,
                    'UYU' => 1,
                    'JPY' => 1,
                    'CNY' => 1,
                    'NZD' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.expresschange.tur.br/',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'VTM Dólar Americano'
                    ],
                    'EUR' => [
                        'VTM Euro'
                    ],
                    'GBP' => [
                        'VTM Libra'
                    ],
                    'CAD' => [
                        'VTM Dólar Canadense'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 2,
                    'CAD' => 2,
                ],
            ],
        ],
        'lygtur' => [
            'nickname' => 'lygtur',
            'name' => 'Lyg Tur',
            'email' => 'contato@lygtur.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => false,
            'currencyCard' => [
                'url' => 'http://lygtur.com.br/mag_lygtur/',
                'selector' => 'ol.grid-row li.item',
                'iofIncluded' => false,
                'keywords' => [
                    'ARS' => [
                        'Rendimento Visa TravelMoney Peso Argentino'
                    ],
                    'AUD' => [
                        'Rendimento Visa TravelMoney Dólar Australiano'
                    ],
                    'EUR' => [
                        'Rendimento Visa TravelMoney Euro'
                    ],
                    'CAD' => [
                        'Rendimento Visa TravelMoney Dólar Canadense'
                    ],
                    'GBP' => [
                        'Rendimento Visa TravelMoney Libra Esterlina'
                    ],
                    'USD' => [
                        'Rendimento Visa TravelMoney Dólar USD'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'ARS' => 0,
                    'AUD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                    'USD' => 0,
                ],
            ],
        ],
        'dg' => [
            'nickname' => 'dg',
            'name' => 'DG',
            'email' => 'atendimento@dgcambio.com.br',
            'state' => 'RJ',
            'city' => 'rio-de-janeiro',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://evtm.com.br/Vitrine.aspx?Moeda=Papel',
                'selector' => 'div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CLP' => [
                        'Pesos Chilenos'
                    ],
                    'UYU' => [
                        'Pesos Uruguaios'
                    ],
                    'CNY' => [
                        'Renmimbi Iuan'
                    ],
                    'MXN' => [
                        'Pesos Mexicanos'
                    ],
                    'ZAR' => [
                        'Rande'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'CLP' => 0,
                    'UYU' => 0,
                    'CNY' => 0,
                    'MXN' => 0,
                    'ZAR' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://evtm.com.br/Vitrine.aspx?Moeda=Visa',
                'selector' => 'div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Visa Travel Money \(USD\)'
                    ],
                    'EUR' => [
                        'Visa Travel Money \(EUR\)'
                    ],
                    'AUD' => [
                        'Visa Travel Money \(AUD\)'
                    ],
                    'CAD' => [
                        'Visa Travel Money \(CAD\)'
                    ],
                    'GBP' => [
                        'Visa Travel Money \(GBP\)'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'ds' => [
            'nickname' => 'ds',
            'name' => 'DS Câmbio',
            'email' => 'atendimento@cambioevistos.com.br',
            'state' => 'MG',
            'city' => 'belo-horizonte',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://cambioevistos.com.br/cotacoes-diarias/',
                'selector' => 'table#table-cambio tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://cambioevistos.com.br/cotacoes-diarias/',
                'selector' => 'table#table-cambio tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                ],
            ],
        ],
        'sita' => [
            'nickname' => 'sita',
            'name' => 'Sita',
            'email' => 'sita@sita.com.br',
            'state' => 'MG',
            'city' => 'belo-horizonte',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.sita.com.br/site/#',
                'selector' => 'table tr td table tr td table tr td table tr td table tr td table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Turismo'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'cambio-curitiba' => [
            'nickname' => 'cambio-curitiba',
            'name' => 'Câmbio Curitiba',
            'email' => 'contato@cambiocuritiba.com',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://cambiocuritiba.com/',
                'selector' => 'ul.currency-data li',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Turismo'
                    ],
                    'EUR' => [
                        'Euro Turismo'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
            'currencyCard' => false
        ],
        'sidney' => [
            'nickname' => 'sidney',
            'name' => 'Sidney',
            'email' => 'atendimento@sidney.com.br',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.sidney.com.br/cambio/cambio.aspx',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'UYU' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.sidney.com.br/cambio/cambio.aspx',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar  RTCM'
                    ],
                    'AUD' => [
                        'Dólar Australiano RVTM'
                    ],
                    'CAD' => [
                        'Dólar Canadense  RVTM'
                    ],
                    'EUR' => [
                        'Euro  RTCM'
                    ],
                    'GBP' => [
                        'Libra RTCM'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'ebadival' => [
            'nickname' => 'ebadival',
            'name' => 'Ebadival',
            'email' => 'ebadival@ebadival.com.br',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.ebadival.com.br/cambio',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar EUA'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.ebadival.com.br/cambio',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar EUA - VTM'
                    ],
                    'EUR' => [
                        'Euro - VTM'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                ],
            ],
        ],
        'avs' => [
            'nickname' => 'avs',
            'name' => 'AVS',
            'email' => 'contato@avsturismo.com.br',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'https://www.avsturismo.com.br/?view=cambio',
                'selector' => 'table.table-moeda tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar EUA'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'COP' => [
                        'Peso Colombiano'
                    ],
                    'PEN' => [
                        'Novo Sol Peruano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'UYU' => 1,
                    'MXN' => 1,
                    'CLP' => 1,
                    'COP' => 1,
                    'PEN' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                    'NZD' => 1,
                    'JPY' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://www.avsturismo.com.br/?view=cambio',
                'selector' => 'table.table-moeda tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano Cartão'
                    ],
                    'EUR' => [
                        'Euro Cartão'
                    ],
                    'GBP' => [
                        'Libra Cartão'
                    ],
                    'CAD' => [
                        'Dólar Canadense Cartão'
                    ],
                    'AUD' => [
                        'Dólar Australiano Cartão'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                ],
            ],
        ],
        'dourada' => [
            'nickname' => 'dourada',
            'name' => 'Dourada',
            'email' => 'sac@dourada.com.br',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.dourada.com.br/?/cotacao/',
                'selector' => 'div.parceiros-interna-espaco table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CAD' => [
                        'Dolar Canadense'
                    ],
                    'JPY' => [
                        'Iene Japonês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'AUD' => [
                        'Dolar Australiano'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'CAD' => 1,
                    'JPY' => 1,
                    'CHF' => 1,
                    'AUD' => 1,
                    'CLP' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'oliveira-franco' => [
            'nickname' => 'oliveira-franco',
            'name' => 'Oliveira Franco',
            'email' => 'sac@ofranco.com.br',
            'state' => 'PR',
            'city' => 'curitiba',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://ofranco.com.br/',
                'selector' => 'table.mtphr-dnt-grid tr td',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'USD'
                    ],
                    'EUR' => [
                        'EUR'
                    ],
                    'ARS' => [
                        'ARS'
                    ],
                    'GBP' => [
                        'GBP'
                    ],
                    'CAD' => [
                        'CAD'
                    ],
                    'AUD' => [
                        'AUD'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'ARS' => 2,
                    'GBP' => 2,
                    'CAD' => 1,
                    'AUD' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'fortur' => [
            'nickname' => 'fortur',
            'name' => 'Fortur',
            'email' => 'forturcambio@gmail.com',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.forturcambio.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CHF' => 1,
                    'CAD' => 1,
                    'ARS' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'sadoc' => [
            'nickname' => 'sadoc',
            'name' => 'Sadoc',
            'email' => 'sadoc@sadoc.com.br',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.sadoc.com.br/index.php?pag=pacote10',
                'selector' => 'div.inner div',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CAD' => [
                        'Dolar Canadense'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CHF' => 0,
                    'CAD' => 0,
                    'ARS' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'fair-cambio' => [
            'nickname' => 'fair-cambio',
            'name' => 'Fair Câmbio',
            'email' => 'fairfortaleza@faircambiofortaleza.com.br',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.faircambiofortaleza.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.faircambiofortaleza.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Cash Passport Dólar'
                    ],
                    'EUR' => [
                        'Cash Passport Euro'
                    ],
                    'GBP' => [
                        'Cash Passport Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'tour-star' => [
            'nickname' => 'tour-star',
            'name' => 'Tour Star',
            'email' => 'tourstar@tourstar.tur.br',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.tourstar.tur.br/',
                'selector' => 'div#est_cap_cot_moe div',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'CHF' => [
                        'Franco suíço'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'CAD' => 1,
                    'CHF' => 1,
                    'AUD' => 1,
                    'GBP' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'afetur' => [
            'nickname' => 'afetur',
            'name' => 'Afetur',
            'email' => 'contato@afetur.com.br',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.afetur.com.br/default.asp',
                'selector' => 'ul.travel-news li',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'toppingtur' => [
            'nickname' => 'toppingtur',
            'name' => 'Toppingtur',
            'email' => 'toppingtur@gmail.com',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.toppingtur.com.br/',
                'selector' => 'ul.x1 li',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CHF' => 1,
                    'CAD' => 1,
                    'ARS' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'euro-cambio' => [
            'nickname' => 'euro-cambio',
            'name' => 'Euro Câmbio',
            'email' => '',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://eurocambio.tur.br/',
                'selector' => 'table#wp-table-reloaded-id-4-no-1 tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dolar Canadense'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'ARS' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'ceara-travel' => [
            'nickname' => 'ceara-travel',
            'name' => 'Ceará Travel',
            'email' => '',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.cearatravel.com.br/site/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'U\$'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 3,
                    'EUR' => 6,
                ],
            ],
            'currencyCard' => false,
        ],
        'luza' => [
            'nickname' => 'luza',
            'name' => 'Luza',
            'email' => 'itamar@luzaturismo.com.br',
            'state' => 'CE',
            'city' => 'fortaleza',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.luzaturismo.com.br/',
                'selector' => 'body',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'US'
                    ],
                    'EUR' => [
                        '€'
                    ],
                    'GBP' => [
                        '£'
                    ],
                    'CAD' => [
                        'CAD'
                    ],
                    'NZD' => [
                        'NZD'
                    ],
                    'AUD' => [
                        'AUD'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'AUD' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'cambio-net' => [
            'nickname' => 'cambio-net',
            'name' => 'Câmbio Net',
            'email' => 'cambionet@cambionet.com',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://sistema.cambionet.com/lojavirtual/Carga.aspx',
                'selector' => 'div.box_especie div.box_carga',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'DOLARES AMERICANOS'
                    ],
                    'EUR' => [
                        'EUROS'
                    ],
                    'GBP' => [
                        'LIBRAS ESTERLINAS'
                    ],
                    'AUD' => [
                        'DOLARES AUSTRALIANOS'
                    ],
                    'CAD' => [
                        'DOLAR CANADENSES'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://sistema.cambionet.com/lojavirtual/Carga.aspx',
                'selector' => 'div.box_cartao div.box_carga',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'CARTÃO DOLAR'
                    ],
                    'EUR' => [
                        'CARTAO EURO'
                    ],
                    'GBP' => [
                        'CARTAO LIBRAS ESTERLINAS'
                    ],
                    'CAD' => [
                        'CARTAO DOLAR CANADENSE'
                    ],
                    'AUD' => [
                        'CARTÃO DOLARES AUSTRALIANOS'
                    ],

                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'AUD' => 1,
                ],
            ],
        ],
        'fair-cambio-poa' => [
            'nickname' => 'fair-cambio-poa',
            'name' => 'Fair Câmbio POA',
            'email' => 'fairpoa@faircambiopoa.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://faircambiopoa.com.br/cotacoes/',
                'selector' => 'table#tablepress-1 tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'MXN' => [
                        'Novo Peso Mexicano'
                    ],
                    'PEN' => [
                        'Novo Sol Peruano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'JPY' => [
                        'Yene Japonês'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'CHF' => 0,
                    'GBP' => 0,
                    'MXN' => 0,
                    'PEN' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'UYU' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://faircambiopoa.com.br/cotacoes/',
                'selector' => 'table#tablepress-1 tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 2,
                ],
            ],
        ],
        'ctr' => [
            'nickname' => 'ctr',
            'name' => 'CTR',
            'email' => 'romina@ctrcambio.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.ctrcambio.com.br/novo/?page_id=10',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                    'NZD' => 1,
                    'CAD' => 1,
                    'CHF' => 1,
                    'UYU' => 1,
                    'CLP' => 1,
                    'MXN' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.ctrcambio.com.br/novo/?page_id=10',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'VTM Dólar'
                    ],
                    'EUR' => [
                        'VTM Euro'
                    ],
                    'GBP' => [
                        'VTM Libra'
                    ],
                    'AUD' => [
                        'VTM Australiano'
                    ],
                    'ARS' => [
                        'VTM Argentino'
                    ],
                    'CAD' => [
                        'VTM Canadense'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'ARS' => 1,
                    'CAD' => 1,
                ],
            ],
        ],
        'ideal' => [
            'nickname' => 'ideal',
            'name' => 'Câmbio Ideal',
            'email' => 'contato@cambioideal.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://cambioideal.com.br/cotacoes/',
                'selector' => 'body > section.double-content > div > div.content-right table',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'PEN' => [
                        'Novo Sol Peruano'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'ZAR' => [
                        'Rande Africano'
                    ],
                    'JPY' => [
                        'Yen Japonês'
                    ],
                    'CNY' => [
                        'Yuan Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'PEN' => 0,
                    'ARS' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'ZAR' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://cambioideal.com.br/cotacoes/',
                'selector' => 'table',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'ARS' => 0,
                ],
            ],
        ],
        'montevideu' => [
            'nickname' => 'montevideu',
            'name' => 'Montevideu',
            'email' => 'contato@montevideucambio.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://montevideucambio.com.br/cotacao.php',
                'selector' => '#content > div > div > div.col-full > div > div > table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        '[^ ]Dólar Americano'
                    ],
                    'AUD' => [
                        '[^ ]Dólar Australiano'
                    ],
                    'CAD' => [
                        '[^ ]Dólar Canadense'
                    ],
                    'NZD' => [
                        '[^ ]Dólar Neozelandês'
                    ],
                    'EUR' => [
                        '[^ ]Euro'
                    ],
                    'CHF' => [
                        '[^ ]Franco Suíço'
                    ],
                    'GBP' => [
                        '[^ ]Libra Esterlina'
                    ],
                    'MXN' => [
                        '[^ ]Novo Peso Mexicano'
                    ],
                    'ARS' => [
                        '[^ ]Peso Argentino'
                    ],
                    'CLP' => [
                        '[^ ]Peso Chileno'
                    ],
                    'UYU' => [
                        '[^ ]Peso Uruguaio'
                    ],
                    'ZAR' => [
                        '[^ ]Rand Africano'
                    ],
                    'JPY' => [
                        '[^ ]Yene Japonês'
                    ],
                    'CNY' => [
                        '[^ ]Yuan Chinês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                    'EUR' => 1,
                    'CHF' => 1,
                    'GBP' => 1,
                    'MXN' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'UYU' => 1,
                    'ZAR' => 1,
                    'JPY' => 1,
                    'CNY' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://montevideucambio.com.br/cotacao.php',
                'selector' => '#content > div > div > div.col-full > div > div > table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'VTM \/ Mastercard Dólar Americano'
                    ],
                    'AUD' => [
                        'VTM \/ Dólar Australiano'
                    ],
                    'CAD' => [
                        'VTM \/ Dólar Canadense'
                    ],
                    'EUR' => [
                        'VTM \/ Mastercard Euro'
                    ],
                    'GBP' => [
                        'VTM \/ Mastercard Libra'
                    ],

                    'ARS' => [
                        'VTM \/ Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                ],
            ],
        ],
        'exim' => [
            'nickname' => 'exim',
            'name' => 'Exim',
            'email' => 'exim@exim.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.exim.com.br',
                'selector' => '#idTaxa > div > table:nth-child(9)',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Turismo'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'amazonia-am' => [
            'nickname' => 'amazonia-am',
            'name' => 'Amazônia',
            'email' => 'amazoniacambio@gmail.com',
            'state' => 'AM',
            'city' => 'manaus',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.amazoniacambio.com.br/site_2013/',
                'selector' => 'div#right-home-area div.widget_conversormanual.widget table.custom_table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'D&oacutelar Americano'
                    ],
                    'CAD' => [
                        'D&oacutelar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CHF' => [
                        'Franco su&iacuteço'
                    ],
                    'JPY' => [
                        'Yene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'shopping-tour' => [
            'nickname' => 'shopping-tour',
            'name' => 'Shopping Tour',
            'email' => 'shoppingtour@shoppingtourbahia.com.br',
            'state' => 'BA',
            'city' => 'salvador',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.shoppingtourbahia.com.br/',
                'selector' => 'div.list-wrap ul',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        '\$'
                    ],
                    'EUR' => [
                        '€'
                    ],
                    'GBP' => [
                        '£'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.shoppingtourbahia.com.br/',
                'selector' => '',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        '\$'
                    ],
                    'EUR' => [
                        '€'
                    ],
                    'GBP' => [
                        '£'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 3,
                    'EUR' => 3,
                    'GBP' => 3,
                ],
            ],
        ],
        'turvicam' => [
            'nickname' => 'turvicam',
            'name' => 'Turvicam',
            'email' => 'cambio@turvicam.com.br',
            'state' => 'PA',
            'city' => 'belem',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.turvicam.com.br/index.php',
                'selector' => 'table tr.linha_moeda',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra esterlina'
                    ],
                    'AUD' => [
                        'Dólar australiano'
                    ],
                    'CAD' => [
                        'Dólar canadense'
                    ],
                    'NZD' => [
                        'Dólar neozelandês'
                    ],
                    'CHF' => [
                        'Franco suíço'
                    ],
                    'JPY' => [
                        'Iene japonês'
                    ],
                    'ARS' => [
                        'Peso argentino'
                    ],
                    'CLP' => [
                        'Peso chileno'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.turvicam.com.br/index.php',
                'selector' => 'div#cotacaodemoedas table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra esterlina'
                    ],
                    'AUD' => [
                        'Dólar australiano'
                    ],
                    'CAD' => [
                        'Dólar canadense'
                    ],
                    'NZD' => [
                        'Dólar neozelandês'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'AUD' => 1,
                    'CAD' => 1,
                    'NZD' => 1,
                ],
            ],
        ],
        'monopolio' => [
            'nickname' => 'monopolio',
            'name' => 'Monopólio',
            'email' => 'gerencia@monopoliocambio.com.br',
            'state' => 'PA',
            'city' => 'belem',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.monopoliocambio.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'DÓLAR AMERICANO'
                    ],
                    'GBP' => [
                        'LIBRA ESTERLINA'
                    ],
                    'EUR' => [
                        'EURO'
                    ],
                    'ARS' => [
                        'PESO ARGENTINO'
                    ],
                    'CAD' => [
                        'DÓLAR CANADENSE'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'GBP' => 0,
                    'EUR' => 0,
                    'ARS' => 0,
                    'CAD' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'dinastur' => [
            'nickname' => 'dinastur',
            'name' => 'Dinastur',
            'email' => 'leandro@dinastur.com.br',
            'state' => 'PA',
            'city' => 'belem',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.dinastur.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Turismo'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 5,
                ],
            ],
            'currencyCard' => false,
        ],
        'lhx' => [
            'nickname' => 'lhx',
            'name' => 'LHX',
            'email' => 'atendimento@lhx.com.br',
            'state' => 'GO',
            'city' => 'goiania',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.lhx.com.br/#!casa-de-cambio/cms9',
                'selector' => 'div#idhbloqb p',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.lhx.com.br/#!casa-de-cambio/cms9',
                'selector' => 'div#idhbloqb p',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Cartão Pré-pago'
                    ],
                    'EUR' => [
                        'Euro Cartão Pré-pago'
                    ],
                    'GBP' => [
                        'Libra Cartão Pré-pago'
                    ],
                    'CAD' => [
                        'Canadense Cartão'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CAD' => 0,
                ],
            ],
        ],
        'voe-viagens' => [
            'nickname' => 'voe-viagens',
            'name' => 'Voe Viagens',
            'email' => '',
            'state' => 'MS',
            'city' => 'campo-grande',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.foxcambio.com.br/2013/tabelinha.asp?externo=sim&filialtaxa=campogrande%20i',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadá'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'JPY' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.foxcambio.com.br/2013/tabelinha.asp?externo=sim&filialtaxa=campogrande%20i',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar - cartão pré-pago'
                    ],
                    'EUR' => [
                        'Euro - cartão pré-pago'
                    ],
                    'GBP' => [
                        'Libra - cartão pré-pago'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'pontal-turismo' => [
            'nickname' => 'pontal-turismo',
            'name' => 'Pontal Turismo',
            'email' => 'sac@pontalturismo.com.br',
            'state' => 'SE',
            'city' => 'aracaju',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.pontalturismo.com.br/',
                'selector' => 'ul.dropdown-menu li',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'ivoramtur' => [
            'nickname' => 'ivoramtur',
            'name' => 'Ivoramtur',
            'email' => 'ivoramtur@ivoramtur.com.br',
            'state' => 'SC',
            'city' => 'florianopolis',
            'delivery' => false,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'https://docs.google.com/spreadsheets/d/1A6cThSvMoLK8DDY1a3fvFuE1MgO-B38bwzVmtxOKRAg/pubhtml/sheet?headers=false&gid=0',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],

                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                    'JPY' => [
                        'Iene \(Japão\)'
                    ],
                    'CNY' => [
                        'Yuan \(China\)'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'CHF' => 0,
                    'JPY' => 0,
                    'CNY' => 0,
                    'CLP' => 0,
                    'UYU' => 0,
                    'MXN' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'https://docs.google.com/spreadsheets/d/1A6cThSvMoLK8DDY1a3fvFuE1MgO-B38bwzVmtxOKRAg/pubhtml/sheet?headers=false&gid=0',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'VTM Dólar Americano'
                    ],
                    'CAD' => [
                        'VTM Dólar Canadense'
                    ],
                    'AUD' => [
                        'VTM Dólar Australiano'
                    ],
                    'NZD' => [
                        'VTM Dólar Neozelandês'
                    ],
                    'EUR' => [
                        'VTM Euro'
                    ],
                    'GBP' => [
                        'VTM Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'AUD' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                ],
            ],
        ],
        'acoriana' => [
            'nickname' => 'acoriana',
            'name' => 'Açoriana',
            'email' => 'contato@acorianacorretora.com.br',
            'state' => 'SC',
            'city' => 'florianopolis',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://acorianacorretora.com.br/home',
                'selector' => 'div.cotacao div',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://acorianacorretora.com.br/home',
                'selector' => 'div.cotacao div',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 2,
                ],
            ],
        ],
        'aloha-cambio' => [
            'nickname' => 'aloha-cambio',
            'name' => 'Aloha Câmbio',
            'email' => '',
            'state' => 'ES',
            'city' => 'vitoria',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.alohacambio.com.br/pg/26504/inicial/',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'turismo-dez' => [
            'nickname' => 'turismo-dez',
            'name' => 'Turismo Dez',
            'email' => 'viajarcom@turismodez.com.br',
            'state' => 'ES',
            'city' => 'vitoria',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.foxcambio.com.br/2013/tabelinha.asp?FilialTaxa=VILA%20VELHA&externo=sim',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'CAD' => [
                        'Dólar Canadá'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'JPY' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.foxcambio.com.br/2013/tabelinha.asp?FilialTaxa=VILA%20VELHA&externo=sim',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar - cartão pré-pago'
                    ],
                    'EUR' => [
                        'Euro - cartão pré-pago'
                    ],
                    'GBP' => [
                        'Libra - cartão pré-pago'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
        'lastro' => [
            'nickname' => 'lastro',
            'name' => 'Lastro',
            'email' => 'ouvidoria@lastro.com.br',
            'state' => 'SP',
            'city' => 'campinas',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => false,
            'currencyCard' => [
                'url' => 'https://www.lastro.com.br/produtos',
                'selector' => 'div.row div.col-md-4',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'CAD' => 0,
                    'NZD' => 0,
                    'AUD' => 0,
                    'GBP' => 0,
                ],
            ],
        ],
        'gmt' => [
            'nickname' => 'gmt',
            'name' => 'GMT Câmbio',
            'email' => 'comercial@gmtcambio.com.br',
            'state' => 'SP',
            'city' => 'sao-bernardo-do-campo',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.gmtcambio.com.br/',
                'selector' => 'table tr',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar \(USD\)'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'CAD' => [
                        'Dólar Canada'
                    ],
                    'CHF' => [
                        'Franco Suíço'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                    'CAD' => 1,
                    'CHF' => 1,
                ],
            ],
            'currencyCard' => false,
        ],
        'cagifin-abc' => [
            'nickname' => 'cagifin-abc',
            'name' => 'Cagifin ABC',
            'email' => 'cagifinabc@terra.com.br',
            'state' => 'SP',
            'city' => 'sao-bernardo-do-campo',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://www.cagifinabc.com.br/?page_id=1369',
                'selector' => 'div.entrytext p',
                'iofIncluded' => true,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                ],
            ],
            'currencyCard' => false,
        ],
        'numatur' => [
            'nickname' => 'numatur',
            'name' => 'Numatur',
            'email' => 'contato.abc@numatur.com.br',
            'state' => 'SP',
            'city' => 'santo-andre',
            'delivery' => false,
            'decode' => false,
            'foreignCurrency' => [
                'url' => 'http://numatur.com.br/ncc-cambio/',
                'selector' => 'table.table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'EUR' => 2,
                    'GBP' => 2,
                ],
            ],
            'currencyCard' => false,
        ],
        'interpolo' => [
            'nickname' => 'interpolo',
            'name' => 'Interpolo',
            'email' => 'interpolo@interpolo.com.br',
            'state' => 'SP',
            'city' => 'santo-andre',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://www.lojamultimoney.com.br/?interpolo',
                'selector' => '#ctl00_MainContent_UpdatePanel1 div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar Americano'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'GBP' => [
                        'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Pesos Argentinos'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'NZD' => [
                        'Dólar Neozelandês'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'MXN' => [
                        'Peso Mexicano'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                    'NOK' => [
                        'Coroa Norueguesa'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'JPY' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                    'NZD' => 0,
                    'CHF' => 0,
                    'CLP' => 0,
                    'MXN' => 0,
                    'UYU' => 0,
                    'NOK' => 0,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://www.lojamultimoney.com.br/?interpolo',
                'selector' => '#ctl00_MainContent_upProdutos div div.boxProduto',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Visa', 'Dólar Americano'
                    ],
                    'EUR' => [
                        'Visa', 'Euro'
                    ],
                    'GBP' => [
                        'Visa', 'Libra Esterlina'
                    ],
                    'ARS' => [
                        'Visa', 'Pesos Argentinos'
                    ],
                    'CAD' => [
                        'Visa', 'Dólar Canadense'
                    ],
                    'AUD' => [
                        'Visa', 'Dólar Australiano'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 0,
                    'EUR' => 0,
                    'GBP' => 0,
                    'ARS' => 0,
                    'CAD' => 0,
                    'AUD' => 0,
                ]
            ],
        ],
        'sidney-londrina' => [
            'nickname' => 'sidney-londrina',
            'name' => 'Sidney Londrina',
            'email' => 'atendimento@sidney.com.br',
            'state' => 'PR',
            'city' => 'londrina',
            'delivery' => true,
            'decode' => true,
            'foreignCurrency' => [
                'url' => 'http://sidney.com.br/cambio/cambio.aspx?c=2',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar'
                    ],
                    'AUD' => [
                        'Dólar Australiano'
                    ],
                    'CAD' => [
                        'Dólar Canadense'
                    ],
                    'EUR' => [
                        'Euro'
                    ],
                    'CHF' => [
                        'Franco Suiço'
                    ],
                    'JPY' => [
                        'Iene'
                    ],
                    'GBP' => [
                        'Libra'
                    ],
                    'ARS' => [
                        'Peso Argentino'
                    ],
                    'CLP' => [
                        'Peso Chileno'
                    ],
                    'UYU' => [
                        'Peso Uruguaio'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'CHF' => 1,
                    'JPY' => 1,
                    'GBP' => 1,
                    'ARS' => 1,
                    'CLP' => 1,
                    'UYU' => 1,
                ],
            ],
            'currencyCard' => [
                'url' => 'http://sidney.com.br/cambio/cambio.aspx?c=2',
                'selector' => 'table tr',
                'iofIncluded' => false,
                'keywords' => [
                    'USD' => [
                        'Dólar  RTCM'
                    ],
                    'AUD' => [
                        'Dólar Australiano RVTM'
                    ],
                    'CAD' => [
                        'Dólar Canadense  RVTM'
                    ],
                    'EUR' => [
                        'Euro  RTCM'
                    ],
                    'GBP' => [
                        'Libra RTCM'
                    ],
                ],
                'indexesByExchangeRate' => [
                    'USD' => 2,
                    'AUD' => 1,
                    'CAD' => 1,
                    'EUR' => 1,
                    'GBP' => 1,
                ],
            ],
        ],
    ];

    /**
     * @param string[] $nicknameOfTheExchangesOffices
     * @return ExchangeOffice[]
     */
    public static function getAll($nicknameOfTheExchangesOffices = [])
    {
        $exchangeOffices = new \ArrayObject();

        if (empty($nicknameOfTheExchangesOffices)) {
            $exchangeOfficesArrayCopy = (new \ArrayObject(self::$exchangeOffices))->getArrayCopy();
            array_pull($exchangeOfficesArrayCopy, 'get-go');
            array_pull($exchangeOfficesArrayCopy, 'multi-money');
            array_pull($exchangeOfficesArrayCopy, 'ourominas');
//            O site da Ceará Travel está fora do ar
            array_pull($exchangeOfficesArrayCopy, 'ceara-travel');
//            As cotações no site estão zeradas
            array_pull($exchangeOfficesArrayCopy, 'pm-turismo');
//            As cotações não são mais exibidas no site
            array_pull($exchangeOfficesArrayCopy, 'lygtur');
//            O site da Ipanema Exchange está fora do ar
            array_pull($exchangeOfficesArrayCopy, 'ipanema-exchange');
//            O site da Graco Exchange está fora do ar
            array_pull($exchangeOfficesArrayCopy, 'graco');
//            O site da Shiopping Tour não contém mais taxas de câmbio
            array_pull($exchangeOfficesArrayCopy, 'shopping-tour');
            foreach ($exchangeOfficesArrayCopy as $nickname => $exchangeOffice) {
                $exchangeOffices->append(self::get($nickname));
            }
        } else {
            foreach ($nicknameOfTheExchangesOffices as $nicknameOfTheExchangesOffice) {
                $exchangeOffices->append(self::get($nicknameOfTheExchangesOffice));
            }
        }
        return $exchangeOffices;

    }

    /**
     * @param $nickname
     * @return ExchangeOffice
     */
    public static function get($nickname)
    {
        $exchangeOffice = self::$exchangeOffices[$nickname];
        $exchangeOffice['currencyCard'] = ($exchangeOffice['currencyCard']) ? new CurrencyCard($exchangeOffice['currencyCard']) : null;
        $exchangeOffice['foreignCurrency'] = ($exchangeOffice['foreignCurrency']) ? new ForeignCurrency($exchangeOffice['foreignCurrency']) : null;
        return new ExchangeOffice($exchangeOffice);
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @param int $productType
     * @return ExchangeOfficeProduct|null
     */
    public static function getProductByType(ExchangeOffice $exchangeOffice, $productType)
    {
        if ($productType === ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT || $productType === 'foreignCurrency')
            return $exchangeOffice->getForeignCurrency();
        else
            return $exchangeOffice->getCurrencyCard();
    }

}
