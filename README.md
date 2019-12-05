# P7Tools¹ 
IN   DEVELOPMENT -    not production ready

<pre>

P7Tools/
├── Bootstrap.php
├── Documentation
│   └── ExampleClass.phps
├── index.php
├── LICENSE.md
├── phpunit.xml
├── post.html
├── README.md
├── SOURCE_CODE_CONVENTION.md
├── src
│   ├── curr.txt
│   └── P7Tools
│       ├── Base
│       │   ├── Data
│       │   │   ├── ArrayFilter.php
│       │   │   ├── ArrayHandler.php
│       │   │   ├── ArrayHelper.php
│       │   │   ├── ArrayObject.php
│       │   │   ├── ArraySorter.php
│       │   │   ├── ArrayValidator.php
│       │   │   ├── BitFlag.php
│       │   │   ├── BitMask.php
│       │   │   ├── Container.php
│       │   │   ├── Guid.php
│       │   │   ├── MultiArrayObject.php
│       │   │   ├── NetStringList.php
│       │   │   ├── NetStringParser.php
│       │   │   ├── NetString.php
│       │   │   ├── README.yml
│       │   │   ├── ScalarHelper.php
│       │   │   ├── StringNameTransformer.php
│       │   │   ├── Symbol.php
│       │   │   ├── Transformer.php
│       │   │   ├── TypeValidator.php
│       │   │   └── ValueValidator.php
│       │   ├── File
│       │   │   ├── Config.php
│       │   │   ├── Exception.php
│       │   │   └── Logger.php
│       │   └── Type
│       │       ├── AbstractType.php
│       │       ├── FloatClass.php
│       │       ├── IntClass.php
│       │       └── StringClass.php
│       ├── Business
│       │   └── AbstractCurrency.php
│       ├── Cache
│       │   ├── CacheInterface.php
│       │   ├── Filecache.php
│       │   └── Memcache.php
│       ├── Cli
│       │   └── Helper.php
│       ├── Communication
│       │   ├── MailAgentInterface.php
│       │   ├── Mail.php
│       │   └── PhpMail.php
│       ├── Database
│       │   ├── Adapter.php
│       │   ├── ExampleAdapter.php
│       │   ├── MysqlAdapter.php
│       │   └── Sql
│       │       ├── Insert.php
│       │       ├── Query.php
│       │       ├── Select.php
│       │       ├── SqlException.php
│       │       ├── Update.php
│       │       └── Where.php
│       ├── DateTime
│       │   └── DateTimeHelper.php
│       ├── Dev
│       │   ├── CodeCreator.php
│       │   ├── Expression.php
│       │   ├── Helper.php
│       │   └── Mock.php
│       ├── Game
│       │   ├── Card.php
│       │   ├── Cards
│       │   ├── Deck.php
│       │   └── Hand.php
│       ├── Html
│       │   ├── Common.php
│       │   ├── Element.php
│       │   ├── Factory.php
│       │   ├── Form.php
│       │   └── Html5Spec.php
│       ├── Http
│       │   ├── Client.php
│       │   ├── CurlClient.php
│       │   ├── Message.php
│       │   ├── Parser.php
│       │   ├── Protocol.php
│       │   ├── Request.php
│       │   └── Response.php
│       ├── Math
│       │   └── Number
│       │       └── PrimeNumberFactory.php
│       ├── Meta.php
│       ├── Mime
│       │   └── Type.php
│       ├── Mvc
│       │   ├── ApplicationException.php
│       │   ├── Application.php
│       │   ├── Application.php.depr
│       │   ├── FrontController.php
│       │   ├── Router.php
│       │   ├── TemplateView.php
│       │   └── ViewInterface.php
│       ├── Net
│       │   └── Client.php
│       ├── Pattern
│       │   ├── Behavior
│       │   │   ├── Observable.php
│       │   │   └── Observer.php
│       │   ├── Creation
│       │   │   └── Singleton.php
│       │   └── Structure
│       ├── Tools
│       │   ├── DocBlockMaker.php
│       │   ├── Mock
│       │   │   ├── Context
│       │   │   │   └── Http.php
│       │   │   └── README.md
│       │   ├── README.md
│       │   ├── ReverseEngineering
│       │   │   ├── MysqlStructure.php
│       │   │   └── README.md
│       │   ├── SourceTemplate.php
│       │   ├── Validator
│       │   │   └── RegEx.php
│       │   └── ValidatorInterface.php
│       └── Xml
│           ├── ElementFactory.php
│           ├── Element.php
│           └── Validator.php
├── tests
│   ├── FooTest.php
│   └── P7Tools
│       ├── Base
│       │   ├── Data
│       │   │   ├── ArrayFilterTest.php
│       │   │   ├── ArrayHandlerTest.php
│       │   │   ├── ArrayHelperTest.php
│       │   │   ├── ArraySorterTest.php
│       │   │   ├── ContainerTest.php
│       │   │   ├── GuidTest.php
│       │   │   ├── mcTest.php
│       │   │   ├── StringNameTransformerTest.php
│       │   │   ├── TransformerTest.php
│       │   │   └── ValueValidatorTest.php
│       │   ├── File
│       │   └── Type
│       │       ├── IntClassTest.php
│       │       └── StringClassTest.php
│       ├── Cache
│       │   └── FileCacheTest_deprecated_.php.depr
│       ├── Cli
│       ├── Communication
│       ├── Database
│       │   └── Sql
│       │       └── QueryTest.php
│       ├── DateTime
│       ├── Dev
│       │   └── MockTest.php
│       ├── Game
│       │   ├── Cards
│       │   └── CardsTest.php
│       ├── Html
│       ├── Http
│       │   ├── ClientTest.php
│       │   ├── CooperationTest.php
│       │   ├── ProtocolTest.php
│       │   ├── RequestTest.php
│       │   └── ResponseTest.php
│       ├── Math
│       │   └── Number
│       │       └── PrimeNumber.php
│       ├── MetaTest.php
│       ├── Mime
│       ├── Mvc
│       │   └── ApplicationTest.php
│       ├── Net
│       │   └── ClientTest.php
│       ├── Pattern
│       │   ├── Behavior
│       │   ├── Creation
│       │   └── Structure
│       └── Xml
│           └── ValidatorTest.php
├── tmp
│   ├── CodeGRube.php.depr
│   ├── extract_code_coverage_from_phpunit.xl.txt
│   ├── global_attr.txt
│   ├── html5_elements.txt
│   ├── tags.txt
│   └── t.php
├── TODO.md
└── vendor
    ├── autoload.php
    ├── composer
    │   ├── autoload_classmap.php
    │   ├── autoload_namespaces.php
    │   ├── autoload_psr4.php
    │   ├── autoload_real.php
    │   ├── autoload_static.php
    │   ├── ClassLoader.php
    │   ├── installed.json
    │   └── LICENSE
    └── phpunit
        └── php-invoker
            ├── build.xml
            ├── composer.json
            ├── LICENSE
            ├── phpunit.xml
            ├── README.md
            ├── src
            │   ├── Exception.php
            │   ├── Invoker.php
            │   └── TimeoutException.php
            └── tests
                ├── _fixture
                │   └── TestCallable.php
                └── InvokerTest.php

</pre>
Tiny web application framework and tool collection for PHP 7.2+

# @link https://github.com/svenschrodt/P7Tools
# @author Sven Schrodt<sven@schrodt-service.net>
# @package P7Tools
# @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
# @copyright Sven Schrodt<sven@schrodt-service.net>
# @version 0.1

--- 
¹ painless tools