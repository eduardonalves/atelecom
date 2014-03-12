
<?php
/**
 *  Inclui a interface iCharset
 */
include_once( 'class.Accents.iCharset.php' );
/**
 *  Classe para remoção de acentos
 *  Created on 2011-07-17
 *  PHP version 5.3.0 and later
 *  @author Carlos Coelho <coelhoduda@hotmail.com>
 *  @version 0.1
 */
final class Accents implements iCharset
{
    /**
     *  Uso de TRANSLIT
     *  Os caracteres que não podem ser representados
     *  pelo charset alvo serão substituidos por um caracter aproximado
     */
    const TRANSLIT    = '//TRANSLIT';
    /**
     *  Uso de IGNORE
     *  Os caracteres que não podem ser representados
     *  na charset alvo são descartados
     */
    const IGNORE      = '//IGNORE';
    /**
     *  @var string Armazena a constante
     *  que possui o charset de entrada
     *  @access private
     */
    private $inCharset;
    /**
     *  @var string Armazena a constante
     *  que possui o charset de saida
     *  @access private
     */
    private $outCharset;
    /**
     *  @var string Armazena a constante
     *  para a transliteração
     *  @access private
     */
    private $trans;
    /**
     *  @var array Armazena todas as string tratadas
     *  @access private
     */
    private $storage;
    /**
     *  O construtor da classe Accents
     *  @param string $in_charset opcional A codificação de entrada
     *  @param string $out_charset opcional A codificação de saida
     *  @param string $trans opcional O tipo de transliteração
     *  @access public
     *  @return void
     */
    public function __construct( $in_charset = self::UTF_8, $out_charset = self::ASCII, $trans = self::TRANSLIT )
    {
        $this->inCharset  = $in_charset;
        $this->outCharset = $out_charset;
        $this->trans      = $trans;
    }
    /**
     *  Remove todos os acentos de uma determinada string
     *  @param string $string A string que será tratada
     *  @access public
     *  @return void
     */
    public function clear( $string )
    {
        return preg_replace( '/[`^~\'"]/', null, iconv( $this->inCharset, sprintf( '%s%s', $this->outCharset, $this->trans ), $string ) );
    }
    /**
     *  Armazena todos os textos que forem
     *  inseridos e remove os acentos
     *  @param mixed $text O conteúdo que será tratado e armazenado
     *  @access public
     *  @return Accents Referência ao próprio objeto
     */
    public function addText( $text )
    {
        if( is_array( $text ) )
        {
            foreach( $text as $key => $value )
            {
                $storage[ $key ] = self::clear( $value );
            }
            $this->storage[ ] = $storage;
        }
        else
        {
            $this->storage[ ] = self::clear( $text );
        }
        return $this;
    }
    /**
    *  Conta o número de textos armazenados
    *  @access public
    *  @return integer
    */
    public function count( )
    {
        return count( $this->storage );
    }
    /**
    *  Converte o objeto para sua representação em array
    *  @access public
    *  @return array
    */
    public function __toArray( )
    {
        foreach( $this->storage as $key => $value )
        {
            $array[ $key ] = $value;
        }
        return $array;
    }
}
?>
