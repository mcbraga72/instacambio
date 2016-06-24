<?php

namespace br\com\InstaCambio\Stub;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testCrawlerAsReturnedValue()
    {
        $stubClient = new StubClient();
        $this->assertInstanceOf('\Symfony\Component\DomCrawler\Crawler', $stubClient->request('get', 'http://www.primecash.com.br/produtos.html?shop_cat=2'));
    }

    public function testCrawlerForAmazonia()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.amazoniacambio.com.br/site_2013/');
        $this->assertContains('D&oacutelar Americano', $crawler->text());
    }

    public function testCrawlerForThreeAV()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.3av.com.br/index.php/produtos-de-cambio/moedas-em-destaque');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForDibran()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.cambiocorretora.com.br/');
        $this->assertContains('Dólar', $crawler->text());
    }

    public function testCrawlerForTorre()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.torrecambio.com.br/MoedaEspecie.aspx');
        $this->assertContains('USD', $crawler->text());
    }

    public function testCrawlerForStartTrips()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://startcambio.com.br/comprar-moedas.html?limit=36');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForSagitur()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.sagiturturismo.com.br/');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForOurominas()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.cambiorapido.com/tabelinha_wl.asp?filial=144%20CALLCENTER');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForAGK()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://agkcorretora.com.br/pagina/cotacoes-e-simulador');
        $this->assertContains('Dolar americano', $crawler->text());
        $this->assertContains('USD', $crawler->text());
    }

    public function testCrawlerForBestMoney()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://bestmoney.tur.br/');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForSPMundi()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://www.spmundi.com.br/moedas-em-especie');
        $this->assertContains('Dólar Americano', utf8_decode($crawler->text()));
        $this->assertContains('USD', $crawler->text());
    }

    public function testCrawlerForARRM()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://arrmcambio.com.br/?page_id=326');
        $this->assertContains('Dólar Americano', $crawler->text());
        $this->assertContains('USD', $crawler->text());
    }

    public function testCrawlerForFoxCambio()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://foxcambio.com.br/');
        $this->assertContains('Dólar Americano', $crawler->text());
    }

    public function testCrawlerForGradual()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://www.gradualinvestimentos.com.br/Investimentos/Cambio.aspx');
        $this->assertContains('Dólar Americano', utf8_decode($crawler->text()));
        $this->assertContains('USD', $crawler->text());
    }

    public function testCrawlerForGreen()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://greencambio.com.br/');
        $this->assertContains('Dolar', $crawler->text(), '', true);
    }

    public function testCrawlerForMaxima()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://lojavirtual.maximacambio.com.br/lojamaxima/carga.aspx');
        $this->assertContains('DÓLAR AMERICANO', utf8_decode($crawler->text()), '', true);
    }

    public function testCrawlerForPicchioni()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://www.picchionicambiovirtual.com.br/');
        $this->assertContains('USD', $crawler->text());
        $this->assertContains('Dólar', $crawler->text(), '', true);
    }

    public function testCrawlerForGoldenMoney()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.goldenmoney.com.br/');
        $this->assertContains('Dólar', $crawler->text(), '', true);
    }

    public function testCrawlerForEuropa()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://www.xchange.com.br/produtosInternos_moedas.html');
        $this->assertContains('dólar americano', $crawler->text(), '', true);
    }

    public function testCrawlerForGraco()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://gracoexchange.com.br/Vitrine.aspx');
        $this->assertContains('Dólar Americano', utf8_decode($crawler->text()), '', true);
        $this->assertContains('USD', $crawler->text(), '', true);
    }

    public function testCrawlerForConexion()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.conexioncambio.com.br/');
        $this->assertContains('Dólar Turismo', $crawler->text(), '', true);
    }

    public function testCrawlerForCambioStore()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'https://cambiostore.com/aid=2?shop_cat=1');
        $this->assertContains('Dólar Americano', $crawler->text(), '', true);
        $this->assertContains('USD', $crawler->text(), '', true);
    }

    public function testCrawlerFromCurrencyCardPageForEcoForte()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.ecofortecambioeturismo.com.br/produtos/visa-travel-money');
        $this->assertContains('VISA TRAVEL MONEY (VTM)', $crawler->text(), '', true);
    }

    public function testCrawlerForPrimeCash()
    {
        $client = new StubClient();
        $crawler = $client->request('get', 'http://www.primecash.com.br/produtos.html?shop_cat=2');
        $this->assertContains('Dólar Americano', $crawler->text(), '', true);
        $this->assertContains('USD', $crawler->text(), '', true);
    }
}
