# instaCâmbio WebService Restful

Este projeto é responsável pelo WebService Restful e as tasks background da plataforma instaCâmbio.

## Instalação

### Clone o repositório.
```
$ git clone https://bitbucket.org/instacambio/webservice
$ cd webservice/
```

### Construa o projeto.
```
$ composer buildDevEnv
```

## Done! Run and Dev!

### Executando testes.
```
$ composer test # Roda os testes unitários
$ composer integratedUnitTest # Roda os testes unitários integrados (rodar eventualmente)
$ composer heavyTest # Roda os testes pesados (rodar eventualmente)
$ composer allTests # Roda todos os testes acima, respectivamente
```