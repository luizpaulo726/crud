Loja Virtual.
1-Utilize um servidor local para teste.
2-Crie um novo schema no mysql workbench com o nome de loja.
3-Execute o script, dentro desse novo schema loja.
Feito isso copie a pasta raiz para o seu diretorio local e execute o projeto. a url fica assim http://localhost/teste/loja/.

Dados do Projeto
define('APP_HOST'       , $_SERVER['HTTP_HOST'] . "/teste/loja");
define('PATH'           , realpath('./'));
define('DB_HOST'        , "localhost");
define('DB_USER'        , "root");
define('DB_PASSWORD'    , "");
define('DB_NAME'        , "loja");
define('DB_DRIVER'      , "mysql");

