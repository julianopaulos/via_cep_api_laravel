## Viacep Api
projeto criado pela simples vontade de que tive de fazer um teste de um processo seletivo, mesmo sem seguir com o processo.

para rodar o projeto, siga os seguintes passos:

- rodar o comando composer install para instalar todas as dependências necessárias para rodar o projeto;
- Criar variável de ambiente com o nome `VIA_CEP_BASE_URL` com o valor de `"viacep.com.br/ws/`.;
- rode o projeto com o comando php artisan serve;
- pelo postman ou alguma outra ferramenta, chame a rota `api/search/local`, passando parâmetro `zip_codes` como query params, aonde deverão ser passados os códigos de ceps que desejam ser pesquisados pela api, passando eles em formato de string e separando cada um por vírgula, podendo seguir o segunte exemplo: `api/search/local?zip_codes=12345,5678`, caso seja passadoo cep com o `-` que geralmente é usado, também vai funcionar, caso tenha alguma letra, ela será desconsiderada. após chamada a rota, os ceps serão retornados em formato json, caso não encontre nada, um array vazio será retornado.
