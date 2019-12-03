<?php declare(strict_types = 1);
/**
 *  \P7Tools\Tools\SourceTemplate
 *
 * Class for generating source code templates dynamically for applications based on 
 * P7Tools framework  
 *
 *
 * !UNSTABLE - do not use in production until it is stable!
 *      
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-02
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Tools;

class SourceTemplate
{

    /**
     * Template string for source code snippet of new SPL autoloader function 
     * for  given name space and base path
     * 
     * @var string
     */
    protected $_splAutoloader = "spl_autoload_register(function (\$className) {
    
    // Getting parts of (sub) namespaces from URI    
    \$parts = explode('\\', \$className);
    
    // Check if namespace of class to be instantiated is belonging to current namespace ({NEW_NAMESPACE})
    if (substr(\$className, 0, 7) === {NEW_NAMESPACE}) {
        \$file = '{NEW_BASE_DIRECTORY}/' . str_replace('\\', '/', \$className) . '.php';
        
        // Check if destination class file exists
        if (file_exists(\$file)) {
            require_once \$file;
        } else { // throw exception if not
            throw new FileException(sprintf(FileException::NO_SUCH_FILE_OR_DIRECTORY, \$className));
        }
    }
});";

    /**
     * Template for line in DocBlock comment 
     * 
     * @var string
     */
    protected $_docBlockLine = " * @{KEY} {VALUE}";
    
    /**
     * Constructor function 
     * 
     */
    public function __construct()
    {
//         echo $this->_splAutoloader;
    }
    
    /**
     * Getting source code for SPL autoloader function for given namespace and base path in file 
     * system, that will generate the source code for an autoloader function for a give namespace
     * and a base file path
     * 
     * Example invocation:
     * <code>
     * $foo->getAutoLoaderSource('MyNewApplication', '/var/www/html/MyNewApplication');
     * </code>
     * 
     * This is generating source code for an auto loading mechanism that will:
     *  
     *  - load (require_once) file '/var/www/html/MyNewApplication/Foo.php'
     *      - if class \MyNewApplication\Foo will be instantiated
     *      
     *  - load (require_once) file '/var/www/html/MyNewApplication/BarSubSpace/Freak.php'
     *      - if class \MyNewApplication\BarSubSpace\Freak will be instantiated
     * 
     * @param string $namespace
     * @param string $basePath
     * @return string
     */
    public function getAutoLoaderSource(string $namespace, string $basePath) : string
    {
        // array with place holders to be replaced 
        $find = ['{NEW_NAMESPACE}', '{NEW_BASE_DIRECTORY}'];
        
        // array with current name space and base path to replace place holders with
        $repl = [$namespace, $basePath];
        
        // returning replaced string
        return str_replace($find, $repl, $this->_splAutoloader);
     }
    
}
