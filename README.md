Loja Virtual.<br/>
1-Utilize um servidor local para teste.<br/>
2-Crie um novo schema no mysql workbench com o nome de loja.<br/>
3-Execute o script, dentro desse novo schema loja.<br/>
Feito isso copie a pasta raiz para o seu diretorio local e execute o projeto. a url fica assim http://localhost/teste/loja/.<br/>

Dados do Projeto <br/>
define('APP_HOST'       , $_SERVER['HTTP_HOST'] . "/teste/loja"); <b/r>
define('PATH'           , realpath('./'));
define('DB_HOST'        , "localhost");
define('DB_USER'        , "root");
define('DB_PASSWORD'    , "");
define('DB_NAME'        , "loja");
define('DB_DRIVER'      , "mysql");

