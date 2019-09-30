# Email Queue

Este é um serviço de envio de e-mail que utiliza o conceito de software de fila.

O intuito desse é centralizar e padronizar todos os e-mails enviados pela Vegas Card.

## Quem usa

Alguns softwares da Vegas Card que utilizam este serviço:

- Site da Vegas Card (credenciamento)
- API do aplicativo
- API de convênio

## Tecnologias utilizadas

Este serviço utiliza algumas tecnologias, as quais estão listadas abaixo:

- Amazon SQS
- Amazon SES
- Laravel Queue

## Getting starting

Baixe as dependências através do composer

``composer install --no-dev``

Configure o arquivo ``.env``

Rode o queue do Laravel em background

``nohup php artisan queue:work --daemon > /dev/null 2>&1 &``

## Como adicionar um novo e-mail

Para configurar um novo e-mail siga os passos:

- Crie uma rota para ele
- Se for um novo serviço que irá consumir esta API, crie um Controller para ele através do exemplo na pasta 
    > ``app/Http/Controllers/ExampleController.php``
- Crie um novo Mailable 
    > ``php artisan make:mail ExampleMail``
- Crie uma view para o email

## Com dúvida?
- [Laravel Mail](https://laravel.com/docs/5.8/mail)
- [Laravel Queue](https://laravel.com/docs/5.8/queues)


## Desenvolvido por

[Rafael Hirooka Sgobin](https://github.com/rafaelhirooka).
