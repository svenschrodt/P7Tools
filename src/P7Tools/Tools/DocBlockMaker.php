<?php declare(strict_types = 1);
/**
 * \P7Tools\Tools\DocBlockMaker
 *
 * Helping generating DocBlock comment(s) or part(s) from PHP data structures
 *
 *
 *
 * @todo !Do not use in production until it is stable!
 *      
 * @package P7Tools
 * @used-by \P7Tools\Tools\*
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-02
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Tools;

class DocBlockMaker
{

    /**
     * Indention for comments inside a class
     *
     * @todo - find ingenious solution for recursive usage!!
     *      
     * @var string
     */
    protected $insidCLassIndention = '    ';

    /**
     * List of valid doc block comment tags (e.g: @author)
     * ordered by P7Tools rulz;-)
     *
     * @todo - information about tags (e.g. usable once or several times per block)
     * @var array
     */
    protected $_validTags = [
        'fixme',
        'todo',
        'package',
        'used-by',
        'version',
        'author',
        'since',
        'link',
        'see',
        'copyright',
        'license',
        'example',
        'param',
        'return',
        'category',
        'deprecated',
        'filesource',
        'global',
        'ignore',
        'internal',
        'method',
        'property',
        'property-read',
        'property-write',
        'source',
        'subpackage',
        'throws',
        'uses',
        'var'
    ];
    
    protected $_enforceNewlineAfterTag = ['fixme', 'todo'];
    /**
     * Tags used in current instance
     * 
     * @var array
     */
    protected $_currentTags = [];

    
    /**
     * Getting start of a DocBlock commenet 
     * 
     * @param boolean | int  $idt
     * @return string
     */
    public function getStartBlock($idt = false) : string 
    {
        $idt = $this->_handleIndention($idt);
        return $idt . '/**';
    }

    /**
     * Getting end of a DocBlock comment 
     * 
     * @param idt bool | int
     */
    public function getEndBlock($idt = false) : string 
    {
        $idt = $this->_handleIndention($idt);
        return $idt . ' */';
    }

    /**
     * Creating lines of DocBlock tags from array
     *
     * @param array $tags
     */
    public function getTagList(array $tags, $idt = false)
    {
        if(count($tags)>0) {
            $tags = array_merge($tags, $this->_currentTags);
        }
        $idt = $this->_handleIndention($idt);
        $tmp = array();
        foreach ($this->_validTags as $tag) {
            if (isset($tags[$tag])) {
                if (is_array($tags[$tag])) {
                    foreach ($tags[$tag] as $item) {
                        $tmp[] = "@{$tag} {$item}";
                    }
                } else {
                    $tmp[] = "@{$tag} {$tags[$tag]}";
                }
            }
        }

        return $idt . ' * ' . implode(PHP_EOL . $idt . ' * ', $tmp);
    }

    /**
     * Adding named tag to DocBlock comment 
     * 
     * @param string $key
     * @param mixed $value
     * @return \P7Tools\Tools\DocBlockMaker
     */
    public function addTag(string $key, $value) : DocBlockMaker
    {
        $this->_currentTags[$key] = value;
        return $this;
    }
    
    /**
     * Adding list of tags to current instance of DocBlock comment 
     * 
     * @param array $tags
     * @return \P7Tools\Tools\DocBlockMaker
     */
    public function addTags(array $tags) : DocBlockMaker
    {
        $this->_currentTags = array_merge($this->_currentTags, $tags);
        return $this;
    }
    
    protected function _handleIndention($idt)
    {
        // @TODO $idt=
        return ($idt === false) ? ' ' : $idt;
    }
}
