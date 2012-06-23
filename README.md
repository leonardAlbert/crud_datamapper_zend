# Finalidade do projeto
Promover a padronização de desenvolvimento dos projetos da *Fundação Casper Líbero* utilizando o *Zend Framework* de modo que os projetos possuam um alto padrão de qualidade, seja facilmente escalável, possua uma fácil manutenibilidade, trabalhe com orientação a objetos de maneira correta e utilize o padrão de projeto [DataMapper](http://martinfowler.com/eaaCatalog/dataMapper.html) para trabalhar com as models do sistema.

## Versão do Zend Framework
Este exemplo tem como base de uso o *Zend Framework 1.11.11*.

## Criar o projeto.
`zf create project datamapper`

## Library Zend Framework
Copiar a biblioteca do *Zend Framework* para dentro da pasta library de seu projeto.

## VirtualHost
Criar um virtualhost seguindo o exemplo existente em datamapper *datamapper/docs/READ.txt*.

## Criar uma entrada em /etc/hosts
`127.0.0.1 datamapper.local`
No browser verificar se ao digitar a url `http://datamapper.local` é retornada a mensagem padrão do Zend Framework, na qual, este encontra-se pronto para o uso.

## Configurar o Banco de dados
`zf configure dbadapter "adapter=Pdo_MySQL&host=localhost&username=root&password=root&dbname=exemplo"`

## Importação da estrutura do banco de dados
`mysql -u root -p  < docs/exemplo.sql`

## Criar as models
`zf create model Categoria`
`zf create model Produto`

## Criar os mappers
`zf create model CategoriaMapper`
`zf create model ProdutoMapper`

## Criar as DbTables
`zf create dbtable Categoria categorias`
`zf create dbtable Produto produtos`

## Criar os controladores
`zf create controller Categoria`
`zf create controller Produto`

## Criar os formulários
`zf create form Categoria`
`zf create form Produto`

## Carregar automaticamente as bibliotecas abstratas
No bootstrap, dentro do método initAutoloader deve conter a chamada para o método `registerNamespace('MeuProjeto')` para que ele possa carregar automaticamente as bibliotecas abstradas, como o controlador, form, model e o mapper.


