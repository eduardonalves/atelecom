<?php
/**
 *  Interface que contém as
 *  constantes para a codificação
 *  de textos
 *  Created on 2011-07-20
 *  PHP version 5.3.0 and later
 *  @author Carlos Coelho <coelhoduda@hotmail.com>
 *  @version 0.1
 */
interface iCharset
{
    /**
     *  Uso de ISO_8859_1
     *  Western European, Latin-1
     */
    const ISO_8859_1  = 'ISO-8859-1';
    /**
     *  Uso de ISO_8859_15
     *  Western European, Latin-9.
     *  Adiciona o símbolo do Euro, letras Francesas
     *  e Filandesas faltando no Latin-1(ISO-8859-1).
     */
    const ISO_8859_15 = 'ISO-8859-15';
    /**
     *  Uso de UTF_8
     *  Código de multi-byte 8-bit Unicode
     *  compatível com ASCII.
     */
    const UTF_8       = 'UTF-8';
    /**
     *  Uso de ASCII
     *  Conjunto de caracteres de 8-bit baseado no alfabeto inglês.
     */
    const ASCII       = 'ASCII';
    /**
     *  Uso de cp866
     *  Conjunto de caracteres do DOS específico
     *  para o Russo. Este conjunto de caracteres
     *  é suportado no 4.3.2.
     */
    const cp866       = 'cp866';
    /**
     *  Uso de cp1251
     *  Conjunto de caracteres do Windows específico para o Russo.
     *  Este conjunto de caracteres é suportado no 4.3.2.
     */
    const cp1251      = 'cp1251';
    /**
     *  Uso de cp1252
     *  Conjunto de caracteres do Windows
     *  específico para a Europa Ocidental.
     */
    const cp1252      = 'cp1252';
    /**
     *  Uso de KOI8_R
     *  Russo. Este conjunto de caracteres é suportado no 4.3.2.
     */
    const KOI8_R      = 'KOI8-R';
    /**
     *  Uso de BIG5
     *  Chinês Tradicional, usado principalmente em Taiwan.
     */
    const BIG5        = 'BIG5';
    /**
     *  Uso de GB2312
     *  Chinês Simplificado, conjunto de caracteres padrão nacional.
     */
    const GB2312      = 'GB2312';
    /**
     *  Uso de BIG5_HKSCS
     *  BIG5 com extenções de Hong Kong, Chinês Tradicional.
     */
    const BIG5_HKSCS  = 'IG5-HKSCS';
    /**
     *  Uso de Shift_JIS
     *  Japonês
     */
    const Shift_JIS   = 'Shift_JIS';
    /**
     *  Uso de EUC_JP
     *  Japonês
     */
    const EUC_JP      = 'EUC-JP';    
}
?>


